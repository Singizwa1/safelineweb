<?php
// Routing shim: keeps /gallery working through the .htaccess rule
// that's already proven on this server (RewriteRule ^([^/]+)$ $1.php),
// while the real page lives in pages/ with the other standalone pages.
require __DIR__ . '/pages/gallery.php';
