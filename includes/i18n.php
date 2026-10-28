<?php
/**
 * SafeLine website translations. Mirrors the app's currentL10n pattern: one
 * flat key => text array per language, loaded once per request based on
 * config.php's $current_lang, with English as the fallback for any key
 * missing from another language file (so a partial translation never shows
 * a blank string).
 */

$GLOBALS['__safeline_strings'] = require __DIR__ . '/../lang/en.php';

if ($current_lang !== 'en') {
    $translated = @include __DIR__ . '/../lang/' . $current_lang . '.php';
    if (is_array($translated)) {
        $GLOBALS['__safeline_strings'] = array_merge($GLOBALS['__safeline_strings'], $translated);
    }
}

/** Raw translated string for $key, with {placeholder} substitution. */
function t($key, $params = [])
{
    $text = $GLOBALS['__safeline_strings'][$key] ?? $key;
    foreach ($params as $name => $value) {
        $text = str_replace('{' . $name . '}', $value, $text);
    }
    return $text;
}

/** Echoes t() HTML-escaped - use for anything placed inside HTML text/attributes. */
function te($key, $params = [])
{
    echo htmlspecialchars(t($key, $params), ENT_QUOTES, 'UTF-8');
}
