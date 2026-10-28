<?php
// Dev-only router for `php -S`, mirrors the .htaccess rewrite rule:
//   RewriteCond %{REQUEST_FILENAME}.php -f
//   RewriteRule ^([^/]+)$ $1.php [L]
// Not used in production (Apache reads .htaccess directly there).

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($uri, '/');

// Mirror the .htaccess canonical redirect: /page.php -> /page, GET only, so a
// POST to contact.php or booking-notify.php is never downgraded to a GET.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET'
    && preg_match('~^(.+)\.php$~', $path, $m)
    && file_exists(__DIR__ . '/' . $path)) {
    $target = ($m[1] === 'index') ? '/' : '/' . $m[1];
    $qs = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    if ($qs !== null && $qs !== '') { $target .= '?' . $qs; }
    header('Location: ' . $target, true, 301);
    return true;
}

// /welcome moved to /team (mirrors the .htaccess redirect)
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET'
    && ($path === 'welcome' || $path === 'welcome/')) {
    header('Location: /team', true, 301);
    return true;
}

// /home is an alias for the home page (mirrors the .htaccess rule)
if ($path === 'home' || $path === 'home/') {
    require __DIR__ . '/index.php';
    return true;
}

if ($path === '' || is_dir(__DIR__ . '/' . $path)) {
    return false; // let built-in server handle index/directory requests normally
}

if (file_exists(__DIR__ . '/' . $path)) {
    return false; // real file (css/js/image/etc.) - serve as-is
}

if (strpos($path, '.') === false && file_exists(__DIR__ . '/' . $path . '.php')) {
    require __DIR__ . '/' . $path . '.php';
    return true;
}

return false; // let built-in server 404 normally
