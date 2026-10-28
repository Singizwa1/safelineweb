<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'includes/config.php';

$current_page     = 'contact';
$page_title       = t('contact_page_title');
$meta_description = t('contact_meta_description');

/* ---------------------------------------------------------------------------
 * Contact form handling
 * Uses POST/Redirect/GET so a browser refresh never re-sends the message.
 * ------------------------------------------------------------------------- */

$contact_feedback       = '';
$contact_feedback_class = '';
$old                    = ['name' => '', 'email' => '', 'phone' => '', 'topic' => '', 'message' => ''];

// One CSRF token per session, reused across submissions.
if (empty($_SESSION['contact_csrf'])) {
    $_SESSION['contact_csrf'] = bin2hex(random_bytes(32));
}
$contact_csrf = $_SESSION['contact_csrf'];

// The English text is the stable value stored/validated/emailed (staff read English);
// only the label shown to the visitor is translated. Keeps the round-trip through
// $_POST/$_SESSION untouched by the visitor's chosen language.
$contact_topics = [
    'Book a ride',
    'Airport transfer',
    'Corporate transport',
    'Partnership enquiry',
    'Feedback or complaint',
    'Lost item',
    'Driver application',
];
$contact_topic_labels = [
    'Book a ride' => t('contact_topic_book_ride'),
    'Airport transfer' => t('contact_topic_airport_transfer'),
    'Corporate transport' => t('contact_topic_corporate_transport'),
    'Partnership enquiry' => t('contact_topic_partnership'),
    'Feedback or complaint' => t('contact_topic_feedback'),
    'Lost item' => t('contact_topic_lost_item'),
    'Driver application' => t('contact_topic_driver_application'),
];

// Strips CR/LF so user input can never inject extra mail headers.
function safeline_header_safe($value) {
    return trim(str_replace(["\r", "\n", "%0a", "%0d", "%0A", "%0D"], '', (string) $value));
}

// Pick up the flash message left by a previous POST, then clear it.
if (!empty($_SESSION['contact_flash'])) {
    $contact_feedback       = $_SESSION['contact_flash']['text'];
    $contact_feedback_class = $_SESSION['contact_flash']['class'];
    unset($_SESSION['contact_flash']);
}

// Values carried across the redirect when the send failed, so the form comes
// back filled in rather than blank.
if (!empty($_SESSION['contact_old'])) {
    $old = array_merge($old, $_SESSION['contact_old']);
    unset($_SESSION['contact_old']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = safeline_header_safe($_POST['name'] ?? '');
    $email    = safeline_header_safe($_POST['email'] ?? '');
    $phone    = safeline_header_safe($_POST['phone'] ?? '');
    $topic    = safeline_header_safe($_POST['topic'] ?? '');
    $message  = trim((string) ($_POST['message'] ?? ''));
    $honeypot = trim((string) ($_POST['website'] ?? ''));   // hidden from real users
    $token    = (string) ($_POST['csrf'] ?? '');

    $old = compact('name', 'email', 'phone', 'topic', 'message');

    $errors = [];

    if (!hash_equals($contact_csrf, $token)) {
        $errors[] = t('contact_error_session_expired');
    }

    if ($honeypot !== '') {
        // A bot filled the hidden field. Show the normal success message and drop it.
        $_SESSION['contact_flash'] = [
            'text'  => t('contact_success_generic'),
            'class' => 'is-success',
        ];
        header('Location: /contact#contact-form', true, 303);
        exit;
    }

    if ($name === '' || mb_strlen($name) < 2) {
        $errors[] = t('contact_error_name');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = t('contact_error_email');
    }
    if ($phone !== '' && !preg_match('/^[0-9+()\s.-]{7,20}$/', $phone)) {
        $errors[] = t('contact_error_phone');
    }
    if (!in_array($topic, $contact_topics, true)) {
        $errors[] = t('contact_error_topic');
    }
    if (mb_strlen($message) < 10) {
        $errors[] = t('contact_error_message_short');
    }
    if (mb_strlen($message) > 4000) {
        $errors[] = t('contact_error_message_long');
    }

    if ($errors) {
        $contact_feedback       = implode(' ', $errors);
        $contact_feedback_class = 'is-error';
    } else {
        $subject = 'SafeLine contact request: ' . $topic;
        $body    = "Name: {$name}\n"
                 . "Email: {$email}\n"
                 . "Phone: " . ($phone !== '' ? $phone : 'not supplied') . "\n"
                 . "Topic: {$topic}\n"
                 . "Sent: " . date('Y-m-d H:i:s') . "\n\n"
                 . $message . "\n";

        // From stays on our own domain (SPF/DMARC); the visitor's address goes in Reply-To.
        $from    = 'no-reply@' . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'] ?? 'safeline.com');
        // Branded HTML with a plain-text alternative, so the message carries
        // the SafeLine logo instead of arriving as anonymous plain text.
        require_once __DIR__ . '/includes/mail-template.php';
        $mail_rows = [
            'Name'    => $name,
            'Email'   => $email,
            'Phone'   => ($phone !== '' ? $phone : 'not supplied'),
            'Topic'   => $topic,
            'Message' => $message,
        ];
        $mail_html = safeline_mail_html('New message from the website', $mail_rows,
            'Reply directly to this email to answer ' . $name . '.');
        $mail_text = safeline_mail_text('New message from the website', $mail_rows);
        list($body, $headers) = safeline_mail_build(
            "SafeLine Website <{$from}>", $email, $mail_html, $mail_text);

        // Delivered to $form_delivery_email (see includes/config.php), NOT to
        // $contact_email - that one is the public address shown on the site.
        $deliver_to = $contact_form_to ?? $contact_email;
        $sent = function_exists('mail') && @mail($deliver_to, $subject, $body, $headers);

        $_SESSION['contact_flash'] = $sent
            ? ['text' => t('contact_success_named', ['name' => $name]), 'class' => 'is-success']
            : ['text' => t('contact_error_send_failed', ['email' => $contact_email, 'phone' => $contact_phone]), 'class' => 'is-error'];

        // The redirect would otherwise wipe the box the visitor just typed
        // into, and the failure message asks them to send it somewhere else -
        // they need the text still in front of them to copy.
        if (!$sent) {
            $_SESSION['contact_old'] = $old;
        }

        header('Location: /contact#contact-form', true, 303);
        exit;
    }
}

// WhatsApp deep link built from the configured phone number.
$contact_whatsapp = preg_replace('/[^0-9]/', '', $contact_phone);

include 'includes/header.php';
?>

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(assets/images/newcar.jpeg);"></div>
            <?php include 'includes/road.php'; ?>
    <div class="container">
        <div class="page-header__content">
            <h1 class="page-header__title"><?php te('contact_hero_title'); ?></h1>
            <p class="page-header__subtitle" style="color: rgba(255,255,255,0.7); font-size: 17px; margin-top: 10px; max-width: 540px;"><?php te('contact_hero_text'); ?></p>
            <ul class="cityride-breadcrumb list-unstyled">
                <li><span class="cityride-breadcrumb__icon"><i class="icon-home"></i></span><a href="/home"><?php te('nav_home'); ?></a></li>
                <li><span><?php te('nav_contact'); ?></span></li>
            </ul>
        </div>
    </div>
</section>


<!-- QUICK CONTACT STRIP -->
<section class="contact-strip">
    <div class="container">
        <div class="contact-strip__grid">

            <a class="contact-strip__item" href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>">
                <div class="contact-strip__icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="contact-strip__text">
                    <span class="contact-strip__label"><?php te('topbar_call_us'); ?></span>
                    <strong><?php echo $contact_phone; ?></strong>
                </div>
            </a>

            <a class="contact-strip__item" href="mailto:<?php echo $contact_email; ?>">
                <div class="contact-strip__icon">
                    <i class="far fa-envelope"></i>
                </div>
                <div class="contact-strip__text">
                    <span class="contact-strip__label"><?php te('contact_strip_email_label'); ?></span>
                    <strong><?php echo $contact_email; ?></strong>
                </div>
            </a>

            <a class="contact-strip__item contact-strip__item--whatsapp" href="https://wa.me/<?php echo $contact_whatsapp; ?>" target="_blank" rel="noopener">
                <div class="contact-strip__icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div class="contact-strip__text">
                    <span class="contact-strip__label"><?php te('contact_strip_whatsapp_label'); ?></span>
                    <strong><?php te('contact_strip_whatsapp_note'); ?></strong>
                </div>
            </a>

            <a class="contact-strip__item" href="<?php echo $contact_maps_url; ?>" target="_blank" rel="noopener">
                <div class="contact-strip__icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contact-strip__text">
                    <span class="contact-strip__label"><?php te('contact_strip_location_label'); ?></span>
                    <strong><?php echo htmlspecialchars($contact_address, ENT_QUOTES, 'UTF-8'); ?></strong>
                </div>
            </a>

        </div>
    </div>
</section>


<!-- MAIN CONTENT: FORM + SIDEBAR -->
<section class="section-space contact-main">
    <div class="container">
        <div class="row gutter-y-40">

            <!-- LEFT COLUMN: CONTACT FORM -->
            <div class="col-lg-7">
                <div class="contact-form-card" id="contact-form">

                    <div class="contact-form-card__header">
                        <div class="contact-form-card__number">01</div>
                        <div>
                            <h2><?php te('contact_form_title'); ?></h2>
                            <p><?php te('contact_form_subtitle'); ?></p>
                        </div>
                    </div>

                    <?php if ($contact_feedback !== ''): ?>
                        <div class="contact-form-card__feedback <?php echo $contact_feedback_class; ?>"
                             id="contact-feedback"
                             role="<?php echo $contact_feedback_class === 'is-error' ? 'alert' : 'status'; ?>"
                             tabindex="-1">
                            <i class="fas <?php echo $contact_feedback_class === 'is-success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>" aria-hidden="true"></i>
                            <span><?php echo htmlspecialchars($contact_feedback, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" action="/contact" method="post" novalidate>
                        <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($contact_csrf, ENT_QUOTES, 'UTF-8'); ?>">

                        <!-- Honeypot: hidden from people, tempting to bots -->
                        <div class="contact-form__hp" aria-hidden="true">
                            <label for="contact_website"><?php te('contact_hp_label'); ?></label>
                            <input type="text" name="website" id="contact_website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="contact_name"><?php te('contact_field_name'); ?> <span>*</span></label>
                                <div class="contact-form__field">
                                    <i class="far fa-user" aria-hidden="true"></i>
                                    <input type="text" name="name" id="contact_name" autocomplete="name"
                                           placeholder="<?php te('contact_field_name_placeholder'); ?>" required minlength="2" maxlength="80"
                                           value="<?php echo htmlspecialchars($old['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_email_f"><?php te('contact_field_email'); ?> <span>*</span></label>
                                <div class="contact-form__field">
                                    <i class="far fa-envelope" aria-hidden="true"></i>
                                    <input type="email" name="email" id="contact_email_f" autocomplete="email"
                                           placeholder="you@example.com" required maxlength="180"
                                           value="<?php echo htmlspecialchars($old['email'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_phone_f"><?php te('contact_field_phone'); ?> <small>(<?php te('contact_field_optional'); ?>)</small></label>
                                <div class="contact-form__field">
                                    <i class="fas fa-phone-alt" aria-hidden="true"></i>
                                    <input type="tel" name="phone" id="contact_phone_f" autocomplete="tel"
                                           placeholder="+250 788 471 117" maxlength="20"
                                           value="<?php echo htmlspecialchars($old['phone'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_topic"><?php te('contact_field_topic'); ?> <span>*</span></label>
                                <div class="contact-form__field">
                                    <i class="far fa-comment-dots" aria-hidden="true"></i>
                                    <select name="topic" id="contact_topic" required>
                                        <option value="" <?php echo $old['topic'] === '' ? 'selected' : ''; ?> disabled><?php te('contact_field_topic_select'); ?></option>
                                        <?php foreach ($contact_topics as $t): ?>
                                            <option value="<?php echo htmlspecialchars($t, ENT_QUOTES, 'UTF-8'); ?>"
                                                <?php echo $old['topic'] === $t ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($contact_topic_labels[$t], ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="contact_message"><?php te('contact_field_message'); ?> <span>*</span></label>
                                <div class="contact-form__field contact-form__field--message">
                                    <i class="far fa-edit" aria-hidden="true"></i>
                                    <textarea name="message" id="contact_message" required minlength="10" maxlength="4000"
                                              placeholder="<?php te('contact_field_message_placeholder'); ?>"
                                              aria-describedby="contact_message_count"><?php echo htmlspecialchars($old['message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>
                                <p class="contact-form__count" id="contact_message_count">
                                    <span data-count>0</span> <?php te('contact_field_message_count_of', ['max' => '4000']); ?>
                                </p>
                            </div>
                        </div>

                        <div class="contact-form__footer">
                            <p><i class="fas fa-lock" aria-hidden="true"></i> <?php te('contact_form_privacy_note'); ?></p>
                            <button type="submit" class="cityride-btn cityride-btn--primary contact-form__submit">
                                <span class="contact-form__submit-label"><?php te('contact_form_submit'); ?></span>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>

                
                <!-- Fills the left column: the sidebar beside it runs ~200px
                     taller than the form, which left this space empty. -->
                <div class="contact-next">
                    <h3 class="contact-next__title"><?php te('contact_next_title'); ?></h3>
                    <ol class="contact-next__list list-unstyled">
                        <li>
                            <span class="contact-next__step">1</span>
                            <span class="contact-next__body">
                                <strong><?php te('contact_next1_title'); ?></strong>
                                <?php te('contact_next1_text'); ?>
                            </span>
                        </li>
                        <li>
                            <span class="contact-next__step">2</span>
                            <span class="contact-next__body">
                                <strong><?php te('contact_next2_title'); ?></strong>
                                <?php te('contact_next2_text'); ?>
                            </span>
                        </li>
                        <li>
                            <span class="contact-next__step">3</span>
                            <span class="contact-next__body">
                                <strong><?php te('contact_next3_title'); ?></strong>
                                <a href="/#download-app"><?php te('contact_next3_link'); ?></a> <?php te('contact_next3_text'); ?>
                            </span>
                        </li>
                    </ol>
                </div>
</div>
            </div>

            <!-- RIGHT COLUMN: SIDEBAR -->
            <div class="col-lg-5">
                <aside class="contact-sidebar">

                    <div class="contact-sidebar__photo">
                        <img src="assets/images/safeline-fleet-side.jpg" alt="<?php te('contact_sidebar_photo_alt'); ?>" loading="lazy" width="720" height="540">
                    </div>

                    <div class="contact-sidebar__header">
                        <span class="contact-sidebar__kicker"><?php te('contact_sidebar_kicker'); ?></span>
                        <h3><?php te('contact_sidebar_title'); ?></h3>
                        <p><?php te('contact_sidebar_text'); ?></p>
                    </div>

                    <div class="contact-sidebar__links">
                        <a class="contact-sidebar__link" href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>">
                            <span class="contact-sidebar__link-icon"><i class="fas fa-phone-alt"></i></span>
                            <span>
                                <small><?php te('topbar_call_us'); ?></small>
                                <strong><?php echo $contact_phone; ?></strong>
                            </span>
                        </a>
                        <a class="contact-sidebar__link" href="mailto:<?php echo $contact_email; ?>">
                            <span class="contact-sidebar__link-icon"><i class="fas fa-envelope"></i></span>
                            <span>
                                <small><?php te('contact_strip_email_label'); ?></small>
                                <strong><?php echo $contact_email; ?></strong>
                            </span>
                        </a>
                        <a class="contact-sidebar__link" href="https://wa.me/<?php echo $contact_whatsapp; ?>" target="_blank" rel="noopener">
                            <span class="contact-sidebar__link-icon"><i class="fab fa-whatsapp"></i></span>
                            <span>
                                <small><?php te('contact_strip_whatsapp_label'); ?></small>
                                <strong><?php echo $contact_phone; ?></strong>
                            </span>
                        </a>
                        <a class="contact-sidebar__link" href="<?php echo $contact_maps_url; ?>" target="_blank" rel="noopener">
                            <span class="contact-sidebar__link-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <span>
                                <small><?php te('contact_sidebar_area_label'); ?></small>
                                <strong><?php echo htmlspecialchars($contact_address, ENT_QUOTES, 'UTF-8'); ?></strong>
                            </span>
                        </a>
                    </div>

                    <div class="contact-sidebar__hours">
                        <h4><i class="far fa-clock"></i> <?php te('contact_sidebar_hours_title'); ?></h4>
                        <div class="contact-sidebar__hours-grid">
                            <span><?php te('contact_sidebar_hours_weekdays'); ?></span><strong><?php te('contact_sidebar_hours_value'); ?></strong>
                            <span><?php te('contact_sidebar_hours_saturday'); ?></span><strong><?php te('contact_sidebar_hours_value'); ?></strong>
                            <span><?php te('contact_sidebar_hours_sunday'); ?></span><strong><?php te('contact_sidebar_hours_value'); ?></strong>
                            <span><?php te('contact_sidebar_hours_holidays'); ?></span><strong><?php te('contact_sidebar_hours_value'); ?></strong>
                        </div>
                    </div>

                    <div class="contact-sidebar__status">
                        <i class="fas fa-circle"></i>
                        <?php te('contact_sidebar_status'); ?>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</section>


<!-- WHY CONTACT US - 3 TABS -->
<section class="section-space contact-features">
    <div class="container">
        <div class="sec-title sec-title--center">
            <div class="sec-title__top">
                <div class="sec-title__shape"></div>
                <h6 class="sec-title__tagline"><?php te('contact_why_tagline'); ?></h6>
                <div class="sec-title__shape"></div>
            </div>
            <h3 class="sec-title__title"><?php te('contact_why_title'); ?></h3>
        </div>

        <div class="contact-features__tabs" role="tablist" aria-label="<?php te('contact_why_tagline'); ?>">
            <button type="button" class="contact-features__tab active" id="tabbtn-booking" role="tab"
                    aria-selected="true" aria-controls="tab-booking" data-contact-tab="tab-booking">
                <i class="fas fa-mobile-alt" aria-hidden="true"></i><span><?php te('contact_tab_booking'); ?></span>
            </button>
            <button type="button" class="contact-features__tab" id="tabbtn-safety" role="tab"
                    aria-selected="false" aria-controls="tab-safety" tabindex="-1" data-contact-tab="tab-safety">
                <i class="fas fa-shield-alt" aria-hidden="true"></i><span><?php te('contact_tab_safety'); ?></span>
            </button>
            <button type="button" class="contact-features__tab" id="tabbtn-support" role="tab"
                    aria-selected="false" aria-controls="tab-support" tabindex="-1" data-contact-tab="tab-support">
                <i class="fas fa-headset" aria-hidden="true"></i><span><?php te('contact_tab_support'); ?></span>
            </button>
        </div>

        <div class="contact-features__panels">
            <div class="contact-features__panel active" id="tab-booking" role="tabpanel" aria-labelledby="tabbtn-booking">
                <div class="contact-features__panel-grid">
                    <div class="contact-features__panel-content">
                        <h3><?php te('contact_panel1_title'); ?></h3>
                        <p><?php te('contact_panel1_text'); ?></p>
                        <ul class="contact-features__list">
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel1_item1'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel1_item2'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel1_item3'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel1_item4'); ?></li>
                        </ul>
                        <a href="/#download-app" class="cityride-btn cityride-btn--primary">
                            <span><?php te('primary_cta_text'); ?></span>
                        </a>
                    </div>
                    <div class="contact-features__panel-image">
                        <img src="assets/images/safeline-showroom.jpg" alt="<?php te('contact_panel1_image_alt'); ?>" loading="lazy" width="720" height="540">
                    </div>
                </div>
            </div>

            <div class="contact-features__panel" id="tab-safety" role="tabpanel" aria-labelledby="tabbtn-safety" hidden>
                <div class="contact-features__panel-grid">
                    <div class="contact-features__panel-content">
                        <h3><?php te('contact_panel2_title'); ?></h3>
                        <p><?php te('contact_panel2_text'); ?></p>
                        <ul class="contact-features__list">
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel2_item1'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel2_item2'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel2_item3'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel2_item4'); ?></li>
                        </ul>
                        <a href="/safety" class="cityride-btn cityride-btn--border">
                            <span><?php te('contact_panel2_btn'); ?></span>
                        </a>
                    </div>
                    <div class="contact-features__panel-image">
                        <img src="assets/images/safeline-interior.jpg" alt="<?php te('contact_panel2_image_alt'); ?>" loading="lazy" width="720" height="540">
                    </div>
                </div>
            </div>

            <div class="contact-features__panel" id="tab-support" role="tabpanel" aria-labelledby="tabbtn-support" hidden>
                <div class="contact-features__panel-grid">
                    <div class="contact-features__panel-content">
                        <h3><?php te('contact_panel3_title'); ?></h3>
                        <p><?php te('contact_panel3_text'); ?></p>
                        <ul class="contact-features__list">
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel3_item1', ['phone' => '+250 788 471 117']); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel3_item2'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel3_item3'); ?></li>
                            <li><i class="fas fa-check-circle"></i><?php te('contact_panel3_item4'); ?></li>
                        </ul>
                        <a href="tel:+250788471117" class="cityride-btn cityride-btn--primary">
                            <span><?php te('contact_panel3_btn'); ?></span>
                        </a>
                    </div>
                    <div class="contact-features__panel-image">
                        <img src="assets/images/safeline-fleet-rear.jpg" alt="<?php te('contact_panel3_image_alt'); ?>" loading="lazy" width="720" height="540">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    "use strict";

    // This block sits above the FAQ markup, so defer until the DOM is parsed.
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {

    /* ---------- Accessible tabs (click + arrow keys + Home/End) ---------- */
    var tabs   = Array.prototype.slice.call(document.querySelectorAll('.contact-features__tab'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('.contact-features__panel'));

    function selectTab(tab, setFocus) {
        tabs.forEach(function (t) {
            var on = t === tab;
            t.classList.toggle('active', on);
            t.setAttribute('aria-selected', on ? 'true' : 'false');
            t.tabIndex = on ? 0 : -1;
        });
        panels.forEach(function (p) {
            var on = p.id === tab.getAttribute('data-contact-tab');
            p.classList.toggle('active', on);
            if (on) { p.removeAttribute('hidden'); } else { p.setAttribute('hidden', ''); }
        });
        if (setFocus) { tab.focus(); }
    }

    tabs.forEach(function (tab, i) {
        tab.addEventListener('click', function () { selectTab(tab, false); });
        tab.addEventListener('keydown', function (e) {
            var next = null;
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') { next = tabs[(i + 1) % tabs.length]; }
            else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') { next = tabs[(i - 1 + tabs.length) % tabs.length]; }
            else if (e.key === 'Home') { next = tabs[0]; }
            else if (e.key === 'End') { next = tabs[tabs.length - 1]; }
            if (next) { e.preventDefault(); selectTab(next, true); }
        });
    });

    /* ---------- Message character counter ---------- */
    var msg = document.getElementById('contact_message');
    var box = document.getElementById('contact_message_count');
    if (msg && box) {
        var out = box.querySelector('[data-count]');
        var max = parseInt(msg.getAttribute('maxlength'), 10) || 4000;
        var sync = function () {
            var n = msg.value.length;
            out.textContent = n;
            box.classList.toggle('is-near-limit', n > max * 0.9);
        };
        msg.addEventListener('input', sync);
        sync();
    }

    /* ---------- Submit state: stops double-sends ---------- */
    var form = document.querySelector('.contact-form');
    if (form) {
        form.addEventListener('submit', function () {
            if (!form.checkValidity()) { return; }   // let the browser show its own messages
            var btn = form.querySelector('.contact-form__submit');
            if (!btn) { return; }
            btn.disabled = true;
            btn.classList.add('is-sending');
            var label = btn.querySelector('.contact-form__submit-label');
            if (label) { label.textContent = <?php echo json_encode(t('contact_form_sending')); ?>; }
        });
    }

    /* ---------- Move focus to the result banner after a redirect ---------- */
    // Focusing here alone did not hold: the template's preloader teardown runs
    // on window load and hands focus back to <body>, so the visitor landed at
    // the top of the page with the result of their submission below the fold.
    // Re-assert once after that has finished.
    var banner = document.getElementById('contact-feedback');
    if (banner) {
        var showResult = function () {
            banner.focus({ preventScroll: true });
            banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };
        showResult();
        window.addEventListener('load', function () { setTimeout(showResult, 350); });
    }

    /* ---------- FAQ accordion ---------- */
    Array.prototype.forEach.call(document.querySelectorAll('.contact-faq__q'), function (q) {
        q.addEventListener('click', function () {
            var open = q.getAttribute('aria-expanded') === 'true';
            q.setAttribute('aria-expanded', open ? 'false' : 'true');
            var a = document.getElementById(q.getAttribute('aria-controls'));
            if (a) { a.hidden = open; }
        });
    });
    }
}());
</script>


<!-- FAQ -->
<section class="section-space contact-faq" id="faq">
    <div class="container">
        <div class="sec-title sec-title--center">
            <div class="sec-title__top">
                <div class="sec-title__shape"></div>
                <h6 class="sec-title__tagline"><?php te('contact_faq_kicker'); ?></h6>
                <div class="sec-title__shape"></div>
            </div>
            <h3 class="sec-title__title"><?php te('contact_faq_title'); ?></h3>
        </div>

        <div class="contact-faq__list">
            <div class="contact-faq__item">
                <h3 class="contact-faq__heading">
                    <button type="button" class="contact-faq__q" id="faq-q-1"
                            aria-expanded="true" aria-controls="faq-a-1">
                        <span><?php te('contact_faq1_q'); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                </h3>
                <div class="contact-faq__a" id="faq-a-1" role="region" aria-labelledby="faq-q-1">
                    <p><?php te('contact_faq1_a', ['phone' => $contact_phone]); ?></p>
                </div>
            </div>
            <div class="contact-faq__item">
                <h3 class="contact-faq__heading">
                    <button type="button" class="contact-faq__q" id="faq-q-2"
                            aria-expanded="false" aria-controls="faq-a-2">
                        <span><?php te('contact_faq2_q'); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                </h3>
                <div class="contact-faq__a" id="faq-a-2" role="region" aria-labelledby="faq-q-2" hidden>
                    <p><?php te('contact_faq2_a_lead'); ?> <strong><?php te('contact_topic_book_ride'); ?></strong> <?php te('contact_faq2_a_mid'); ?> <a href="/#download-app"><?php te('primary_cta_text'); ?></a> <?php te('contact_faq2_a_tail'); ?></p>
                </div>
            </div>
            <div class="contact-faq__item">
                <h3 class="contact-faq__heading">
                    <button type="button" class="contact-faq__q" id="faq-q-3"
                            aria-expanded="false" aria-controls="faq-a-3">
                        <span><?php te('contact_faq3_q'); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                </h3>
                <div class="contact-faq__a" id="faq-a-3" role="region" aria-labelledby="faq-q-3" hidden>
                    <p><?php te('contact_faq3_a'); ?></p>
                </div>
            </div>
            <div class="contact-faq__item">
                <h3 class="contact-faq__heading">
                    <button type="button" class="contact-faq__q" id="faq-q-4"
                            aria-expanded="false" aria-controls="faq-a-4">
                        <span><?php te('contact_faq4_q'); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                </h3>
                <div class="contact-faq__a" id="faq-a-4" role="region" aria-labelledby="faq-q-4" hidden>
                    <p><?php te('contact_faq4_a_lead'); ?> <strong><?php te('contact_topic_corporate_transport'); ?></strong> <?php te('contact_faq4_a_tail'); ?></p>
                </div>
            </div>
            <div class="contact-faq__item">
                <h3 class="contact-faq__heading">
                    <button type="button" class="contact-faq__q" id="faq-q-5"
                            aria-expanded="false" aria-controls="faq-a-5">
                        <span><?php te('contact_faq5_q'); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                </h3>
                <div class="contact-faq__a" id="faq-a-5" role="region" aria-labelledby="faq-q-5" hidden>
                    <p><?php te('contact_faq5_a_lead'); ?> <strong><?php te('contact_topic_lost_item'); ?></strong> <?php te('contact_faq5_a_tail'); ?></p>
                </div>
            </div>
            <div class="contact-faq__item">
                <h3 class="contact-faq__heading">
                    <button type="button" class="contact-faq__q" id="faq-q-6"
                            aria-expanded="false" aria-controls="faq-a-6">
                        <span><?php te('contact_faq6_q'); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                </h3>
                <div class="contact-faq__a" id="faq-a-6" role="region" aria-labelledby="faq-q-6" hidden>
                    <p><?php te('contact_faq6_a_lead'); ?> <strong><?php te('contact_topic_driver_application'); ?></strong> <?php te('contact_faq6_a_tail'); ?></p>
                </div>
            </div>
        </div>

        <p class="contact-faq__foot">
            <?php te('contact_faq_foot_lead'); ?> <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php te('contact_faq_foot_call', ['phone' => $contact_phone]); ?></a>
            <?php te('contact_faq_foot_or'); ?> <a href="https://wa.me/<?php echo $contact_whatsapp; ?>" target="_blank" rel="noopener"><?php te('contact_faq_foot_whatsapp'); ?></a>.
        </p>
    </div>
</section>


<!-- MAP -->
<?php include 'includes/stay-in-touch.php'; ?>

<section class="contact-map" aria-label="<?php te('footer_map_title'); ?>">
    <iframe title="<?php te('footer_map_title'); ?>"
            src="https://www.google.com/maps?q=Kigali%2C%20Rwanda&amp;output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>


<!-- CONTACT PAGE STYLES -->
<style>
/* ---- Quick contact strip ---- */
.contact-strip {
    background: #001832;
    margin-top: -36px;
    position: relative;
    z-index: 10;
    border-radius: 20px;
    max-width: 960px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 20px;
}
.contact-strip__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
}
.contact-strip__item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 28px 24px;
    text-decoration: none;
    color: #fff;
    transition: background 0.25s ease;
    border-right: 1px solid rgba(255,255,255,0.08);
}
.contact-strip__item:last-child { border-right: none; }
.contact-strip__item:hover { background: rgba(99,197,31,0.1); }
.contact-strip__icon {
    width: 48px; height: 48px;
    background: rgba(99,197,31,0.12);
    color: #63C51F;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.contact-strip__label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: rgba(255,255,255,0.5);
    margin-bottom: 2px;
}
.contact-strip__text strong {
    font-size: 15px;
    font-weight: 700;
    color: #fff;
}
@media (max-width: 767px) {
    .contact-strip { margin-top: -20px; border-radius: 14px; }
    .contact-strip__grid { grid-template-columns: 1fr; }
    .contact-strip__item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.06); padding: 20px; }
    .contact-strip__item:last-child { border-bottom: none; }
}

/* ---- Main contact section ---- */
.contact-main { background: #f8f9fb; }

/* ---- Contact form card ---- */
.contact-form-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px;
    box-shadow: 0 2px 12px rgba(0,24,50,0.04);
    border: 1px solid rgba(0,24,50,0.06);
}
.contact-form-card__header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 28px;
}
.contact-form-card__number {
    font-size: 32px;
    font-weight: 800;
    color: rgba(99,197,31,0.15);
    font-family: var(--font-mono, 'JetBrains Mono', ui-monospace, monospace);
    line-height: 1;
}
.contact-form-card__header h2 {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 4px;
}
.contact-form-card__header p {
    color: #1A2233;
    font-size: 14px;
}
.contact-form-card__feedback {
    margin-bottom: 20px;
    padding: 14px 20px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
}
.contact-form-card__feedback.is-success {
    background: rgba(99,197,31,0.08);
    color: #2F6F0C;
    border: 1px solid rgba(99,197,31,0.2);
}
.contact-form-card__feedback.is-error {
    background: rgba(239,68,68,0.08);
    /* #dc2626 measured 4.35:1 against this wash - just under AA. */
    color: #B91C1C;
    border: 1px solid rgba(239,68,68,0.2);
}
.contact-form label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #1A2233;
    margin-bottom: 6px;
}
.contact-form label span { color: #C62828; }
.contact-form__field {
    position: relative;
}
.contact-form__field i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #63C51F;
    font-size: 16px;
    pointer-events: none;
}
.contact-form__field input,
.contact-form__field select,
.contact-form__field textarea {
    width: 100%;
    padding: 12px 16px 12px 42px;
    border: 1px solid rgba(0,24,50,0.12);
    border-radius: 12px;
    font-family: var(--font-ui, 'Inter', system-ui, sans-serif);
    font-size: 15px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.contact-form__field input:focus,
.contact-form__field select:focus,
.contact-form__field textarea:focus {
    border-color: #63C51F;
    box-shadow: 0 0 0 3px rgba(99,197,31,0.1);
    outline: none;
}
.contact-form__field--message textarea { min-height: 130px; resize: vertical; }
.contact-form__field--message i { top: 18px; transform: none; }
.contact-form__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 24px;
    gap: 16px;
    flex-wrap: wrap;
}
.contact-form__footer p {
    color: #1A2233;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.contact-form__footer p i { color: #63C51F; }
@media (max-width: 767px) {
    .contact-form-card { padding: 24px; }
    .contact-form__footer { flex-direction: column; align-items: stretch; text-align: center; }
}

/* ---- Sidebar ---- */
.contact-sidebar {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,24,50,0.04);
    border: 1px solid rgba(0,24,50,0.06);
}
.contact-sidebar__photo {
    height: 180px;
    overflow: hidden;
}
.contact-sidebar__photo img {
    width: 100%; height: 100%; object-fit: cover;
}
.contact-sidebar__header {
    padding: 24px 24px 16px;
}
.contact-sidebar__kicker {
    color: #63C51F;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    display: block;
    margin-bottom: 6px;
}
.contact-sidebar__header h3 { font-size: 20px; font-weight: 800; margin-bottom: 6px; }
.contact-sidebar__header p { color: #1A2233; font-size: 14px; line-height: 1.6; }
.contact-sidebar__links { padding: 0 24px; }
.contact-sidebar__link {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 0;
    border-bottom: 1px solid rgba(0,24,50,0.06);
    text-decoration: none;
    transition: all 0.2s ease;
}
.contact-sidebar__link:last-child { border-bottom: none; }
.contact-sidebar__link:hover { padding-left: 4px; }
.contact-sidebar__link-icon {
    width: 40px; height: 40px;
    background: rgba(99,197,31,0.08);
    color: #63C51F;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
}
.contact-sidebar__link small { display: block; color: #1A2233; font-size: 12px; font-weight: 500; }
.contact-sidebar__link strong { display: block; color: #001832; font-size: 14px; font-weight: 600; }

/* ---- Working hours ---- */
.contact-sidebar__hours {
    margin: 16px 24px;
    padding: 20px;
    background: #f8f9fb;
    border-radius: 14px;
}
.contact-sidebar__hours h4 {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #001832;
    margin-bottom: 14px;
}
.contact-sidebar__hours h4 i { color: #63C51F; }
.contact-sidebar__hours-grid {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 8px 16px;
    font-size: 13px;
}
.contact-sidebar__hours-grid span { color: #1A2233; }
.contact-sidebar__hours-grid strong { color: #001832; font-weight: 600; text-align: right; }

.contact-sidebar__status {
    margin: 0 24px 24px;
    padding: 14px;
    background: rgba(99,197,31,0.06);
    border-radius: 12px;
    color: #2F6F0C;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}
.contact-sidebar__status i { color: #63C51F; font-size: 8px; }

/* ---- Contact features (3 tabs) ---- */
.contact-features { background: #f8f9fb; }
.contact-features__tabs {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 40px 0 0;
    flex-wrap: wrap;
}
.contact-features__tab {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    border: 2px solid rgba(0,24,50,0.1);
    border-radius: 12px;
    background: #fff;
    color: #001832;
    font-family: var(--font-ui, 'Inter', system-ui, sans-serif);
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
}
.contact-features__tab i {
    font-size: 18px;
    color: #63C51F;
}
.contact-features__tab:hover {
    border-color: #63C51F;
    color: #63C51F;
    background: rgba(99,197,31,0.04);
}
.contact-features__tab.active {
    background: #001832;
    border-color: #001832;
    color: #fff;
    box-shadow: 0 4px 16px rgba(0,24,50,0.2);
}
.contact-features__tab.active i { color: #63C51F; }

.contact-features__panels {
    margin-top: 32px;
}
.contact-features__panel {
    display: none;
    animation: fadeInPanel 0.4s ease;
}
.contact-features__panel.active { display: block; }
@keyframes fadeInPanel {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

.contact-features__panel-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 2px 12px rgba(0,24,50,0.04);
    border: 1px solid rgba(0,24,50,0.06);
}
.contact-features__panel-content h3 {
    font-size: 24px;
    font-weight: 800;
    color: #001832;
    margin-bottom: 12px;
    line-height: 1.2;
}
.contact-features__panel-content p {
    color: #1A2233;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 20px;
}
.contact-features__list {
    list-style: none;
    padding: 0;
    margin: 0 0 28px 0;
}
.contact-features__list li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    font-size: 14px;
    font-weight: 600;
    color: #1A2233;
}
.contact-features__list li i {
    color: #63C51F;
    font-size: 16px;
    flex-shrink: 0;
}
.contact-features__panel-image {
    border-radius: 16px;
    overflow: hidden;
}
.contact-features__panel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    min-height: 280px;
}

@media (max-width: 991px) {
    .contact-features__panel-grid { grid-template-columns: 1fr; padding: 28px; }
    .contact-features__panel-image { order: -1; max-height: 240px; }
    .contact-features__panel-image img { min-height: 200px; }
}
@media (max-width: 575px) {
    .contact-features__tab { padding: 12px 18px; font-size: 13px; }
    .contact-features__tab span { display: none; }
    .contact-features__tab i { font-size: 20px; }
}

/* ---- Map ---- */
.contact-map { height: 380px; }
.contact-map iframe { width: 100%; height: 100%; border: 0; }
@media (max-width: 767px) { .contact-map { height: 260px; } }


/* ==========================================================================
   SafeLine contact page - enhancement layer
   ========================================================================== */

/* ---- Quick strip now carries four channels ---- */
.contact-strip { max-width: 1180px; }
.contact-strip__grid { grid-template-columns: repeat(4, 1fr); }
.contact-strip__item--whatsapp .contact-strip__icon { background: rgba(37, 211, 102, 0.14); color: #25D366; }
.contact-strip__item--whatsapp:hover { background: rgba(37, 211, 102, 0.10); }
.contact-strip__item:focus-visible {
    outline: 2px solid var(--color-primary, #63C51F);
    outline-offset: -2px;
    border-radius: 14px;
}
@media (max-width: 991px) {
    .contact-strip__grid { grid-template-columns: repeat(2, 1fr); }
    .contact-strip__item:nth-child(2n) { border-right: none; }
    .contact-strip__item:nth-child(-n+2) { border-bottom: 1px solid rgba(255,255,255,0.08); }
}
@media (max-width: 575px) {
    .contact-strip__grid { grid-template-columns: 1fr; }
    .contact-strip__item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); padding: 20px; }
    .contact-strip__item:last-child { border-bottom: none; }
}

/* ---- Feedback banner ---- */
.contact-form-card__feedback {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    line-height: 1.55;
}
.contact-form-card__feedback i { font-size: 18px; margin-top: 1px; flex-shrink: 0; }
.contact-form-card__feedback:focus { outline: none; }
.contact-form-card__feedback.is-success i { color: #2E9E1F; }
.contact-form-card__feedback.is-error i { color: #C2410C; }

/* ---- Honeypot: off-screen for people, present for bots ---- */
.contact-form__hp {
    position: absolute !important;
    left: -9999px !important;
    width: 1px; height: 1px;
    overflow: hidden;
}

/* ---- Field polish ---- */
.contact-form label small { font-weight: 500; color: var(--color-text-muted, #5A6577); text-transform: none; letter-spacing: 0; }
.contact-form__field:focus-within {
    border-color: var(--color-primary, #63C51F);
    box-shadow: 0 0 0 3px rgba(99, 197, 31, 0.14);
}
.contact-form input:focus-visible,
.contact-form select:focus-visible,
.contact-form textarea:focus-visible { outline: none; }
.contact-form input:user-invalid,
.contact-form textarea:user-invalid { border-color: transparent; }
.contact-form__field:has(input:user-invalid),
.contact-form__field:has(textarea:user-invalid) {
    border-color: #C2410C;
    box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.12);
}

/* ---- Character counter ---- */
.contact-form__count {
    margin: 8px 2px 0;
    font-size: 12.5px;
    font-weight: 500;
    color: var(--color-text-muted, #5A6577);
    text-align: right;
}
.contact-form__count.is-near-limit { color: #C2410C; font-weight: 600; }

/* ---- Submit button sending state ---- */
.contact-form__submit.is-sending { opacity: 0.75; cursor: progress; }
.contact-form__submit.is-sending i { animation: safelineSpin 0.9s linear infinite; }
@keyframes safelineSpin { to { transform: rotate(360deg); } }

/* ---- Tabs ---- */
.contact-features__tab { display: inline-flex; align-items: center; gap: 9px; }
.contact-features__tab i { font-size: 15px; opacity: 0.85; }
.contact-features__tab:focus-visible {
    outline: 2px solid var(--color-primary, #63C51F);
    outline-offset: 3px;
}
.contact-features__panel[hidden] { display: none; }

/* ---- FAQ accordion ---- */
.contact-faq { background: var(--color-bg, #F8F9FB); }
.contact-faq__list {
    max-width: 860px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.contact-faq__item {
    background: #fff;
    border: 1px solid var(--color-border, #E5E9F0);
    border-radius: 14px;
    overflow: hidden;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.contact-faq__item:has(.contact-faq__q[aria-expanded="true"]) {
    border-color: rgba(99, 197, 31, 0.45);
    box-shadow: 0 4px 18px rgba(0, 24, 50, 0.06);
}
.contact-faq__heading { margin: 0; font-size: inherit; }
.contact-faq__q {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 22px;
    background: none;
    border: 0;
    text-align: left;
    cursor: pointer;
    font-family: var(--font-ui, 'Inter', system-ui, sans-serif);
    font-size: 16px;
    font-weight: 700;
    color: #001832;
    line-height: 1.45;
}
.contact-faq__q:hover { color: var(--color-primary, #63C51F); }
.contact-faq__q:focus-visible { outline: 2px solid var(--color-primary, #63C51F); outline-offset: -2px; }
.contact-faq__q i {
    flex-shrink: 0;
    font-size: 13px;
    color: var(--color-primary, #63C51F);
    transition: transform 0.25s ease;
}
.contact-faq__q[aria-expanded="true"] i { transform: rotate(180deg); }
.contact-faq__a { padding: 0 22px 20px; }
.contact-faq__a p {
    margin: 0;
    color: var(--color-text-secondary, #5A6577);
    font-size: 15px;
    line-height: 1.75;
}
.contact-faq__a a { color: var(--color-primary, #63C51F); font-weight: 600; text-decoration: underline; }
.contact-faq__foot {
    margin: 28px auto 0;
    text-align: center;
    color: var(--color-text-secondary, #5A6577);
    font-size: 15px;
}
.contact-faq__foot a { color: var(--color-primary, #63C51F); font-weight: 700; }
@media (max-width: 575px) {
    .contact-faq__q { padding: 16px 18px; font-size: 15px; }
    .contact-faq__a { padding: 0 18px 18px; }
}

/* ---- Respect reduced-motion ---- */
@media (prefers-reduced-motion: reduce) {
    .contact-faq__q i,
    .contact-form__submit.is-sending i { transition: none; animation: none; }
}
</style>

<?php include 'includes/footer.php'; ?>
