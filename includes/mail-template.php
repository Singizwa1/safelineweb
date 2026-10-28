<?php
/**
 * Branded HTML wrapper for outgoing mail.
 *
 * Both forms sent plain text, so the message arrived with no SafeLine
 * identity at all. This wraps the content in a simple table layout with the
 * logo at the top.
 *
 * Table layout and inline styles on purpose: Outlook's rendering engine
 * ignores most external and embedded CSS, and flexbox/grid entirely.
 *
 * The logo is referenced by absolute URL rather than embedded, so the message
 * stays small. Many clients block remote images until the reader allows them,
 * which is why the wordmark is also present as the alt text - a blocked image
 * still reads "SafeLine".
 */

/**
 * @param string $title    heading shown under the logo
 * @param array  $rows     [label => value] printed as a table
 * @param string $note     optional paragraph under the table
 * @param string $baseUrl  site origin, for the logo src
 */
function safeline_mail_html($title, array $rows, $note = '', $baseUrl = '')
{
    if ($baseUrl === '') {
        $scheme  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $baseUrl = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'safeline.rw');
    }
    $logo = $baseUrl . '/images/safelinelogo/safelinelogo.png';

    $esc = function ($v) {
        return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    };

    $body = '';
    foreach ($rows as $label => $value) {
        if ($value === '' || $value === null) {
            continue;
        }
        $body .= '<tr>'
               . '<td style="padding:9px 14px;border-bottom:1px solid #E1E8F0;'
               . 'font:600 13px/1.4 Arial,Helvetica,sans-serif;color:#5A6577;'
               . 'width:38%;vertical-align:top;">' . $esc($label) . '</td>'
               . '<td style="padding:9px 14px;border-bottom:1px solid #E1E8F0;'
               . 'font:400 14px/1.5 Arial,Helvetica,sans-serif;color:#001832;">'
               . nl2br($esc($value)) . '</td>'
               . '</tr>';
    }

    $noteHtml = $note !== ''
        ? '<p style="margin:18px 0 0;font:400 13px/1.6 Arial,Helvetica,sans-serif;color:#5A6577;">'
          . nl2br($esc($note)) . '</p>'
        : '';

    return '<!DOCTYPE html><html><head><meta charset="UTF-8">'
        . '<meta name="viewport" content="width=device-width,initial-scale=1"></head>'
        . '<body style="margin:0;padding:0;background:#F1F4F8;">'
        . '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" '
        . 'style="background:#F1F4F8;padding:24px 12px;">'
        . '<tr><td align="center">'
        . '<table role="presentation" width="600" cellpadding="0" cellspacing="0" '
        . 'style="max-width:600px;width:100%;background:#FFFFFF;border-radius:12px;overflow:hidden;'
        . 'border:1px solid #E1E8F0;">'

        // header: navy bar with the wordmark on a white chip
        . '<tr><td style="background:#001832;padding:20px 24px;">'
        . '<table role="presentation" cellpadding="0" cellspacing="0"><tr>'
        . '<td style="background:#FFFFFF;border-radius:8px;padding:8px 12px;">'
        . '<img src="' . $esc($logo) . '" alt="SafeLine" width="132" '
        . 'style="display:block;width:132px;height:auto;border:0;">'
        . '</td></tr></table>'
        . '</td></tr>'

        . '<tr><td style="padding:26px 24px 8px;">'
        . '<h1 style="margin:0 0 4px;font:700 20px/1.3 Arial,Helvetica,sans-serif;color:#001832;">'
        . $esc($title) . '</h1>'
        . '<p style="margin:0 0 18px;font:400 13px/1.5 Arial,Helvetica,sans-serif;color:#5A6577;">'
        . 'Received ' . $esc(date('j M Y \a\t H:i')) . '</p>'
        . '</td></tr>'

        . '<tr><td style="padding:0 24px 24px;">'
        . '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" '
        . 'style="border:1px solid #E1E8F0;border-radius:8px;border-collapse:separate;overflow:hidden;">'
        . $body
        . '</table>' . $noteHtml
        . '</td></tr>'

        . '<tr><td style="background:#F7FAFC;padding:16px 24px;border-top:1px solid #E1E8F0;">'
        . '<p style="margin:0;font:400 12px/1.6 Arial,Helvetica,sans-serif;color:#5A6577;">'
        . 'Sent automatically from the SafeLine website.'
        . '</p></td></tr>'

        . '</table></td></tr></table></body></html>';
}

/**
 * Plain-text fallback, sent as the other half of a multipart message so
 * text-only clients still get something readable.
 */
function safeline_mail_text($title, array $rows, $note = '')
{
    $out = $title . "\n" . str_repeat('=', strlen($title)) . "\n\n";
    foreach ($rows as $label => $value) {
        if ($value === '' || $value === null) {
            continue;
        }
        $out .= $label . ': ' . $value . "\n";
    }
    if ($note !== '') {
        $out .= "\n" . $note . "\n";
    }
    $out .= "\nSent automatically from the SafeLine website.\n";
    return $out;
}

/**
 * Headers for a multipart/alternative message, plus the boundary-joined body.
 * Returns [$body, $headers].
 */
function safeline_mail_build($from, $replyTo, $html, $text)
{
    $boundary = 'sl_' . bin2hex(random_bytes(12));

    $headers  = "From: {$from}\r\n";
    if ($replyTo !== '') {
        $headers .= "Reply-To: {$replyTo}\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n"
              . "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n"
              . 'X-Mailer: PHP/' . phpversion();

    $body = "--{$boundary}\r\n"
          . "Content-Type: text/plain; charset=UTF-8\r\n"
          . "Content-Transfer-Encoding: 8bit\r\n\r\n"
          . $text . "\r\n\r\n"
          . "--{$boundary}\r\n"
          . "Content-Type: text/html; charset=UTF-8\r\n"
          . "Content-Transfer-Encoding: 8bit\r\n\r\n"
          . $html . "\r\n\r\n"
          . "--{$boundary}--";

    return [$body, $headers];
}
