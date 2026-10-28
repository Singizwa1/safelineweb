<?php
/**
 * SafeLine - booking notification endpoint.
 *
 * The booking form posts to the dispatch API at mis.sangotaxi.com; this
 * endpoint additionally emails the booking to the operations address so a
 * request is never lost if nobody is watching the dispatch queue.
 *
 * Accepts JSON only, POST only, and treats every value as untrusted text:
 * anything that reaches a mail header is stripped of CR/LF first, otherwise a
 * crafted "name" could inject extra headers and turn this into an open relay.
 */

header('Content-Type: application/json; charset=utf-8');

// Where booking notifications are delivered - set in includes/config.php so
// both forms' destinations live in one file.
require_once __DIR__ . '/includes/config.php';
$booking_notify_to = $booking_notify_email ?? 'twagiramunguserge@gmail.com';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['success' => false, 'message' => 'POST required']);
    exit;
}

/** Strip CR/LF so a value can never inject additional mail headers. */
function safeline_header_safe($value) {
    return trim(str_replace(["\r", "\n", "%0a", "%0d", "%0A", "%0D"], '', (string) $value));
}

/** Plain-text body field: newlines are fine here, control characters are not. */
function safeline_body_safe($value) {
    $value = (string) $value;
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value);
    return trim($value);
}

$raw = file_get_contents('php://input');
if (strlen($raw) > 20000) {
    http_response_code(413);
    echo json_encode(['success' => false, 'message' => 'Payload too large']);
    exit;
}

$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
    exit;
}

$field = static function ($key) use ($data) {
    return safeline_body_safe($data[$key] ?? '');
};

$guest_name = $field('guest_name');
$phone      = $field('phone_number');
$pickup     = $field('pickup_location');
$dropoff    = $field('dropoff_location');
$when       = $field('pickup_datetime');

if ($guest_name === '' || $phone === '' || $pickup === '' || $dropoff === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Missing required booking fields']);
    exit;
}

$ride_type  = $field('booking_type_name');
$vehicle    = $field('category_name');
$passengers = $field('passengers');
$distance   = $field('estimated_km');
$duration   = $field('estimated_duration');
$fare       = $field('estimated_price');
$pickup_lat = $field('pickup_lat');
$pickup_lng = $field('pickup_long');
$drop_lat   = $field('dropoff_lat');
$drop_lng   = $field('dropoff_long');

$maps_link = '';
if ($pickup_lat !== '' && $pickup_lng !== '' && $drop_lat !== '' && $drop_lng !== '') {
    $maps_link = 'https://www.google.com/maps/dir/?api=1'
        . '&origin=' . rawurlencode($pickup_lat . ',' . $pickup_lng)
        . '&destination=' . rawurlencode($drop_lat . ',' . $drop_lng);
}

$lines = [
    'New taxi booking from the SafeLine website',
    str_repeat('=', 44),
    '',
    'Passenger : ' . $guest_name,
    'Phone     : ' . $phone,
    'Passengers: ' . ($passengers !== '' ? $passengers : '-'),
    '',
    'Pickup    : ' . $pickup,
    'Drop-off  : ' . $dropoff,
    'When      : ' . ($when !== '' ? $when : '-'),
    '',
    'Ride type : ' . ($ride_type !== '' ? $ride_type : '-'),
    'Vehicle   : ' . ($vehicle !== '' ? $vehicle : '-'),
    'Distance  : ' . ($distance !== '' ? $distance . ' km' : '-'),
    'Duration  : ' . ($duration !== '' ? $duration . ' min' : '-'),
    'Fare est. : ' . ($fare !== '' ? number_format((float) $fare) . ' RWF' : '-'),
];

if ($maps_link !== '') {
    $lines[] = '';
    $lines[] = 'Route     : ' . $maps_link;
}

$lines[] = '';
$lines[] = 'Received  : ' . date('D, d M Y H:i:s');
$lines[] = 'Source    : ' . safeline_header_safe($_SERVER['HTTP_HOST'] ?? 'safeline');

$body = implode("\n", $lines);

$host = safeline_header_safe($_SERVER['HTTP_HOST'] ?? 'safeline.com');
$host = preg_replace('/[^A-Za-z0-9.\-]/', '', $host);
if ($host === '') { $host = 'safeline.com'; }
$from = 'bookings@' . preg_replace('/^www\./', '', $host);

// From stays on our own domain so SPF/DMARC pass; the passenger's own details
// live in the body, never in a header.
$subject = safeline_header_safe('SafeLine booking - ' . $guest_name . ' - ' . ($when !== '' ? $when : 'now'));
// Branded HTML with a plain-text alternative, so a booking notification
// arrives looking like SafeLine rather than as anonymous plain text. The
// plain-text half is the exact body built above, so text-only clients lose
// nothing.
require_once __DIR__ . '/includes/mail-template.php';
$mail_rows = [
    'Guest name' => $guest_name,
    'Phone'      => $phone,
    'Pickup'     => $pickup,
    'Drop-off'   => $dropoff,
    'When'       => ($when !== '' ? $when : 'now'),
    'Ride type'  => $ride_type,
    'Vehicle'    => $vehicle,
    'Distance'   => ($distance !== '' ? $distance . ' km' : ''),
    'Duration'   => ($duration !== '' ? $duration . ' min' : ''),
    'Fare shown' => ($fare !== '' ? number_format((float) $fare) . ' RWF' : ''),
    'Route'      => $maps_link,
];
$mail_html = safeline_mail_html('New booking from the website', $mail_rows,
    'This booking also went to the dispatch system. Call the guest on ' . $phone . ' to confirm.');
$plain_body = $body;   // keep the readable version for the fallback log
list($body, $headers) = safeline_mail_build(
    "SafeLine Bookings <{$from}>", '', $mail_html, $plain_body);

$sent = function_exists('mail') && @mail($booking_notify_to, $subject, $body, $headers);

if (!$sent) {
    // Mail is not configured (common on local XAMPP). Keep a copy on disk so the
    // booking is still recoverable, and tell the caller plainly.
    $dir = __DIR__ . '/storage';
    if (!is_dir($dir)) { @mkdir($dir, 0775, true); }
    @file_put_contents(
        $dir . '/bookings.log',
        "\n----- " . date('c') . " -----\n" . $plain_body . "\n",
        FILE_APPEND | LOCK_EX
    );
    http_response_code(202);
    echo json_encode([
        'success' => false,
        'logged'  => true,
        'message' => 'Mail transport unavailable; booking written to storage/bookings.log',
    ]);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Booking emailed']);
