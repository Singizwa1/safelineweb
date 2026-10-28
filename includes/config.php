<?php
/**
 * SafeLine - Central Configuration
 * This file centralizes all brand and site-wide information for easy maintenance.
 */

/* ---------------------------------------------------------------------------
 * .env loader - this site has no Composer/vendor, so rather than pull in
 * vlucas/phpdotenv for two values, a few lines does the same job: read
 * KEY=VALUE lines from .env (gitignored - real values never reach GitHub)
 * into getenv()/$_ENV, skipping blanks and #-comments. Silently no-ops if
 * .env is missing, since every value below still has a hardcoded fallback.
 * ------------------------------------------------------------------------- */
(function () {
    $path = dirname(__DIR__) . '/.env';
    if (!is_file($path)) {
        return;
    }
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
    }
})();

// Brand Information
$brand_name = "SafeLine"; // Brand name is not translated - it's a proper noun.

/* ---------------------------------------------------------------------------
 * Languages offered in the top-bar switcher.
 * `hreflang` is the value written to <html lang="…">.
 * NOTE: this stores and advertises the visitor's choice; the page copy itself
 * is still English until translation files exist for each locale.
 * ------------------------------------------------------------------------- */
/* Flags are inline SVG rather than emoji: Windows renders regional-indicator
 * pairs as bare letters, so flag emoji would read as "GB" / "RW".
 *
 * Only English is enabled for now - the page copy itself has no translated
 * versions yet, so offering the others would switch the flag/label but show
 * untranslated English content underneath. Uncomment a language below once
 * its content is actually translated. */
$languages = [
    'en' => ['name' => 'English',    'hreflang' => 'en', 'flag' => '<svg viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="60" height="30" fill="#012169"/><path d="M0,0 60,30 M60,0 0,30" stroke="#fff" stroke-width="6"/><path d="M0,0 60,30 M60,0 0,30" stroke="#C8102E" stroke-width="3"/><path d="M30,0 V30 M0,15 H60" stroke="#fff" stroke-width="10"/><path d="M30,0 V30 M0,15 H60" stroke="#C8102E" stroke-width="6"/></svg>'],
    'rw' => ['name' => 'Kinyarwanda','hreflang' => 'rw', 'flag' => '<svg viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="60" height="20" fill="#00A1DE"/><rect y="20" width="60" height="10" fill="#FAD201"/><rect y="30" width="60" height="10" fill="#20603D"/><circle cx="45" cy="10" r="4.2" fill="#E5BE01"/></svg>'],
    // 'fr' => ['name' => 'Français',   'hreflang' => 'fr', 'flag' => '<svg viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="20" height="40" fill="#002395"/><rect x="20" width="20" height="40" fill="#FFFFFF"/><rect x="40" width="20" height="40" fill="#ED2939"/></svg>'],
    // 'sw' => ['name' => 'Kiswahili',  'hreflang' => 'sw', 'flag' => '<svg viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="60" height="40" fill="#1EB53A"/><path d="M0,40 60,0 60,40Z" fill="#00A3DD"/><path d="M0,40 60,0" stroke="#FCD116" stroke-width="13"/><path d="M0,40 60,0" stroke="#000000" stroke-width="8"/></svg>'],
    // 'ar' => ['name' => 'العربية',     'hreflang' => 'ar', 'flag' => '<svg viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="60" height="40" fill="#165D31"/><path d="M11,17 H49" stroke="#fff" stroke-width="3.4" stroke-linecap="round"/><path d="M13,26 H43" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><path d="M43,26 l5,-2.4" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg>'],
];

$current_lang = 'en';
if (isset($_GET['lang']) && isset($languages[$_GET['lang']])) {
    $current_lang = $_GET['lang'];
    setcookie('safeline_lang', $current_lang, time() + 60 * 60 * 24 * 365, '/');
} elseif (isset($_COOKIE['safeline_lang']) && isset($languages[$_COOKIE['safeline_lang']])) {
    $current_lang = $_COOKIE['safeline_lang'];
}
$current_lang_name = $languages[$current_lang]['name'];

// Loads t()/te() and the string dictionary for $current_lang - must come after
// $current_lang is resolved above, and before anything below uses t().
require_once __DIR__ . '/i18n.php';

$site_tagline = t('site_tagline'); // fallback <title> text on pages with no $page_title set

/* ---------------------------------------------------------------------------
 * TWO DIFFERENT THINGS - do not confuse them.
 *
 * 1. $form_delivery_email - the INBOX that actually receives submissions.
 *    The contact form (/contact) is emailed here with PHP mail(). If mail()
 *    is unavailable, the copy is appended to storage/bookings.log instead.
 *    (The old home-page reservation form/modal is gone - the only booking
 *    that happens on this site now is an Intercity seat, which pays and
 *    confirms through safeLine-api directly with no email step.)
 *
 * 2. $contact_email - the PUBLIC address shown to visitors. It appears in the
 *    top bar, the footer and twice on the contact page as a mailto: link, so
 *    people can write to you directly. Nothing is delivered to it by the site.
 *
 * Note on deliverability: mail() sends through the cPanel server's MTA. Gmail
 * judges that mail by the SENDING domain's SPF/DKIM records, not by the
 * recipient - so if submissions do not arrive, check spam first and then ask
 * your host to confirm SPF and DKIM are set for the domain.
 * ------------------------------------------------------------------------- */
// No real-address fallback here on purpose - this file is the one going to
// GitHub, so the actual inbox only ever lives in .env (gitignored). An empty
// value means contact-form submissions fall through to storage/bookings.log
// instead of emailing anyone, which is the safe failure mode if .env is
// ever missing on a deploy.
$form_delivery_email  = getenv('FORM_DELIVERY_EMAIL') ?: '';
$contact_form_to      = $form_delivery_email;   // contact form -> this inbox

// Contact Information
$contact_phone = "+250 788 471 117";
$contact_email = "info@safeline.com";
$contact_address = "Kigali, Rwanda";
$contact_maps_url = "https://www.google.com/maps/place/Kigali/data=!4m2!3m1!1s0x19dca4258ed8e797:0xf32b36a5411d0bc8?sa=X&ved=1t:242&ictx=111";

// Social Media Links
/* Social profiles. A '#' means "not set up yet" - anything left as '#' is
 * skipped by the Stay In Touch panel and the footer rather than rendered as a
 * dead link. Put the real URL and the public handle in and it appears. */
$social_links = [
    'facebook' => '#',
    'x' => '#',
    'instagram' => '#',
    'linkedin' => '#'
];

/* Handle shown beside each icon in the Stay In Touch panel, e.g. '@safeline'. */
$social_handles = [
    'linkedin'  => '',
    'x'         => '',
    'instagram' => '',
    'facebook'  => '',
];

/* Public website address printed in the Stay In Touch panel. */
$site_url_label = 'www.safeline.rw';
$site_url       = 'https://safeline.rw';

// Navigation Structure (items with 'children' render as dropdowns). Labels go
// through t() so the menu follows $current_lang; the array keys header.php
// reads as $name are therefore already-translated text, same as before.
$nav_items = [
    t('nav_home') => '/home',
    t('nav_about') => [
        'url'   => '/about',
        'children' => [
            t('nav_about_story')  => '/about',
            t('nav_about_vision') => '/mission',
            t('nav_about_team')   => '/team',
            t('nav_about_safety') => '/safety',
        ],
    ],
    t('nav_how_it_works') => [
        'url'   => '/how-it-works',
        'children' => [
            t('nav_how_booking')  => '/how-it-works',
            t('nav_how_fleet')    => '/taxi',
            t('nav_how_coverage') => '/#coverage',
            t('nav_how_faq')      => '/contact#faq',
        ],
    ],
    t('nav_contact') => '/contact',
];

// Action Configuration
$primary_cta_text = t('primary_cta_text');
$primary_cta_link = "/#download-app";

/* Cache-busting for CSS/JS/icon files: appends the file's own last-modified
 * time as ?v=, so editing a file changes its URL automatically the moment
 * it's saved - no manually-bumped version number to remember (and forget)
 * on every deploy. $path is site-root-relative, e.g. 'assets/js/app.js'. */
function asset_url($path)
{
    $fullPath = dirname(__DIR__) . '/' . ltrim($path, '/');
    $version = @filemtime($fullPath);
    return $path . '?v=' . ($version !== false ? $version : time());
}

/* ---------------------------------------------------------------------------
 * SafeLine API - single source of truth for every backend call this site
 * makes (vehicle categories, ride prices, public intercity trips, intercity
 * bookings). Change this one line when deploying; nothing else in the
 * codebase should hardcode a host. Mirrors the pattern already used by
 * Safeline-admin (assets/js/config.js window.API_BASE) and SafeLineApp
 * (lib/constants/api_constants.dart baseUrl).
 *
 * Local dev note: uses 127.0.0.1, not "localhost" - if a local PHP dev
 * server for safelineweb itself is also running on :8080 (e.g. `php -S
 * localhost:8080 router.php`), it binds the IPv6 loopback (::1), and most
 * browsers resolve "localhost" to ::1 first - so a fetch to
 * "localhost:8080/safeline-api" would silently hit that server instead of
 * XAMPP/Apache (which actually serves safeLine-api), and every category/
 * price/booking call fails with a generic "Error loading...". Pinning to
 * 127.0.0.1 forces IPv4, where only XAMPP is listening, regardless of
 * whatever else is running locally.
 * ------------------------------------------------------------------------- */
// Not a secret (it's embedded straight into page source below anyway, see
// header.php's SAFELINE_API_BASE) - still env-driven so local/demo/prod
// deploys don't need this file edited each time, matching FORM_DELIVERY_EMAIL
// above.
$safeline_api_base = getenv('SAFELINE_API_BASE') ?: 'https://demo.safeline.rw/safeLine-api';

// No Google Maps key here on purpose: nothing on this site uses it (the old
// reservation form that needed Places Autocomplete is gone; Intercity trips
// have fixed pickup/dropoff text set by staff, no map needed). A live key
// sitting unused in a config file is a billing risk with no upside - add one
// back only when a feature actually calls it.
