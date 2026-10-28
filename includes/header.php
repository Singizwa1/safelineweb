<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $languages[$current_lang]['hreflang']; ?>"<?php echo $current_lang === 'ar' ? ' dir="rtl"' : ''; ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Escaped: two page titles carry an ampersand ("Vision & Mission",
         "Leadership & Team") and a bare & is not valid here. -->
    <title><?php
        echo htmlspecialchars($brand_name . ' - ' . ($page_title ?? $site_tagline), ENT_QUOTES, 'UTF-8');
    ?></title>

    <!-- Canonical: / and /home both serve the home page, and the .php paths
         still resolve, so name one address per page for search engines. -->
    <link rel="canonical" href="<?php
        $canon = ($current_page ?? '') === 'home' ? '/' : '/' . ($current_page ?? '');
        echo htmlspecialchars($canon, ENT_QUOTES, 'UTF-8');
    ?>">

    <!-- Meta SEO -->
    <meta name="description" content="<?php
        echo htmlspecialchars($meta_description ?? '', ENT_QUOTES, 'UTF-8');
    ?>">
    <!-- Favicons: square crops of the S mark. The full wordmark is 780x320 and
         browsers squashed it into an illegible 16px square. -->
    <link rel="icon" href="<?php echo asset_url('images/safelinelogo/favicon.ico'); ?>" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo asset_url('images/safelinelogo/favicon-32.png'); ?>">
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo asset_url('images/safelinelogo/favicon-48.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo asset_url('images/safelinelogo/apple-touch-icon.png'); ?>">
    <meta name="theme-color" content="#001832">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..800;1,14..32,400&family=Sora:wght@400..800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css">
    <link rel="stylesheet" href="assets/vendors/cityride-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css">

    <!-- Design System & Styles -->
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/parts/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/cityride.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/safeline-polish.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/safeline-theme.css'); ?>">
<?php if (($current_page ?? '') === 'taxi'): ?>
    <!-- taxi-only vendors: the fleet page uses range sliders and a tiny-slider
         carousel that no other page needs. -->
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css">
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css">
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.css">
<?php endif; ?>
<?php if (($current_page ?? '') === 'how-it-works'): ?>
    <link rel="stylesheet" href="<?php echo asset_url('assets/css/how-it-works.css'); ?>">
<?php endif; ?>
    <script>
        // Single source for every SafeLine API call any page makes - see
        // includes/config.php ($safeline_api_base). Defined here (head) so it
        // exists before any page-specific script that needs it runs.
        const SAFELINE_API_BASE = <?php echo json_encode($safeline_api_base); ?>;
        // Lets external .js files reference the support number without each
        // one needing to be a .php file just to interpolate it.
        const SAFELINE_CONTACT_PHONE = <?php echo json_encode($contact_phone); ?>;
        // The site's current language, so API calls (e.g. intercity booking)
        // can tell the backend which language to send SMS/confirmations in -
        // the Accept-Language header reflects the browser/OS locale, not this
        // site's own language switch, so it can't be relied on for that.
        const SAFELINE_LANG = <?php echo json_encode($current_lang); ?>;
        // Dynamically-built content (assets/js/home-intercity.js) can't go
        // through t()/te() since it never runs server-side - only the 'ic_'
        // subset of the dictionary is sent down, not the whole site, to
        // keep this small. jsT() mirrors t()'s {placeholder} substitution.
        const SAFELINE_I18N = <?php
            echo json_encode(array_filter(
                $GLOBALS['__safeline_strings'],
                fn($key) => str_starts_with($key, 'ic_'),
                ARRAY_FILTER_USE_KEY
            ));
        ?>;
        function jsT(key, params) {
            var text = SAFELINE_I18N[key] || key;
            for (var name in (params || {})) {
                text = text.split('{' + name + '}').join(params[name]);
            }
            return text;
        }
    </script>
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="container-fluid">
                <div class="topbar__inner">
                    <ul class="list-unstyled topbar__info">
                        <li>
                            <span class="topbar__info__icon"><i class="icon-paper-plane"></i></span>
                            <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                        </li>
                        <li>
                            <span class="topbar__info__icon topbar__info__icon--location"><i class="icon-maps-and-flags"></i></span>
                            <a href="<?php echo $contact_maps_url; ?>" target="_blank" rel="noopener"><?php echo $contact_address; ?></a>
                        </li>
                    </ul>

                    <div class="topbar__actions">
                        <a class="topbar__phone" href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>">
                            <span class="topbar__phone__icon"><i class="fas fa-phone-alt"></i></span>
                            <span class="topbar__phone__label"><?php te('topbar_call_us'); ?></span>
                            <strong class="topbar__phone__number"><?php echo $contact_phone; ?></strong>
                        </a>

                        <?php if (count($languages) > 1): ?>
                        <div class="lang-switch" id="lang-switch">
                            <button type="button" class="lang-switch__toggle" id="lang-switch-toggle"
                                    aria-haspopup="listbox" aria-expanded="false" aria-label="<?php te('topbar_choose_language'); ?>">
                                <span class="lang-switch__flag"><?php echo $languages[$current_lang]['flag']; ?></span>
                                <span class="lang-switch__current" data-lang-label><?php echo $current_lang_name; ?></span>
                                <i class="fas fa-chevron-down lang-switch__caret" aria-hidden="true"></i>
                            </button>
                            <ul class="lang-switch__menu" role="listbox" aria-labelledby="lang-switch-toggle" hidden>
                                <?php foreach ($languages as $code => $lang): ?>
                                    <li role="option"
                                        data-lang="<?php echo $code; ?>"
                                        aria-selected="<?php echo $code === $current_lang ? 'true' : 'false'; ?>"
                                        tabindex="-1">
                                        <span class="lang-switch__flag"><?php echo $lang['flag']; ?></span>
                                        <span class="lang-switch__name"><?php echo $lang['name']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php else: ?>
                        <!-- Only one language configured - a static label instead
                             of a dropdown with nothing to switch to. -->
                        <div class="lang-switch lang-switch--static" aria-hidden="false">
                            <span class="lang-switch__flag"><?php echo $languages[$current_lang]['flag']; ?></span>
                            <span class="lang-switch__current"><?php echo $current_lang_name; ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- HEADER -->
        <header class="main-header sticky-header sticky-header--normal">
            <div class="container-fluid">
                <div class="main-header__inner">

                    <!-- Logo -->
                    <div class="main-header__logo logo-retina">
                        <a href="/">
                            <img src="images/safelinelogo/safelinelogo.png" alt="<?php echo $brand_name; ?>" width="120" height="120">
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">
                            <?php foreach ($nav_items as $name => $item): ?>
                                <?php
                                    $is_dropdown = is_array($item);
                                    $link        = $is_dropdown ? $item['url'] : $item;
                                    $children    = $is_dropdown ? ($item['children'] ?? []) : [];
                                    $has_children = !empty($children);
                                    // Links are now clean paths ("/", "/about"), so the home
                                    // link no longer carries a filename to match on.
                                    $link_name   = trim(pathinfo($link, PATHINFO_FILENAME));
                                    $is_current  = ($link_name !== '' && ($current_page ?? '') === $link_name)
                                                || ($link === '/' && in_array(($current_page ?? ''), ['home', 'index'], true));
                                    // Also mark active if any child is the current page
                                    if ($has_children) {
                                        foreach ($children as $c_link) {
                                            if (($current_page ?? '') === pathinfo($c_link, PATHINFO_FILENAME)) {
                                                $is_current = true;
                                            }
                                        }
                                    }
                                ?>
                                <li class="<?php echo $is_current ? 'current' : ''; ?> <?php echo $has_children ? 'dropdown' : ''; ?>">
                                    <a href="<?php echo $link; ?>"><?php echo $name; ?></a>
                                    <?php if ($has_children): ?>
                                        <ul>
                                            <?php foreach ($children as $child_name => $child_link): ?>
                                                <li class="<?php echo (($current_page ?? '') === pathinfo($child_link, PATHINFO_FILENAME)) ? 'current' : ''; ?>">
                                                    <a href="<?php echo $child_link; ?>"><?php echo $child_name; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>

                    <!-- Mobile Toggle -->
                    <div class="mobile-nav__btn mobile-nav__toggler">
                        <span></span><span></span><span></span>
                    </div>

                    <!-- Right Actions -->
                    <div class="main-header__right__inner">
                        <div class="main-header__btn-box">
                            <a href="<?php echo ($current_page ?? '') === 'home' ? '#download-app' : $primary_cta_link; ?>" class="js-ride-cta main-header__btn cityride-btn cityride-btn--primary">
                                <span><?php echo $primary_cta_text; ?></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
