<?php
/**
 * "Stay in touch" panel — SafeLine palette.
 *
 * Channels render only when they have a real value: any social link still set
 * to '#' in includes/config.php is skipped rather than shown as a dead link.
 */
$sl_socials = [
    'linkedin'  => ['icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
    'x'         => ['icon' => 'fab fa-x-twitter',   'label' => 'X'],
    'instagram' => ['icon' => 'fab fa-instagram',   'label' => 'Instagram'],
    'facebook'  => ['icon' => 'fab fa-facebook-f',  'label' => 'Facebook'],
];
$sl_active = [];
foreach ($sl_socials as $key => $meta) {
    $url = $social_links[$key] ?? '#';
    if ($url !== '' && $url !== '#') {
        $sl_active[$key] = $meta + ['url' => $url, 'handle' => $social_handles[$key] ?? ''];
    }
}
?>
<section class="stay-touch section-space" id="stay-in-touch">
    <div class="container">
        <div class="stay-touch__card">
            <div class="stay-touch__media">
                <img src="assets/images/safeline-cruze-side-r.png"
                     alt="A SafeLine taxi" loading="lazy" decoding="async">
            </div>

            <div class="stay-touch__body">
                <h2 class="stay-touch__title"><?php te('stay_touch_title'); ?></h2>
                <p class="stay-touch__lead"><?php te('stay_touch_lead'); ?></p>

                <ul class="stay-touch__list list-unstyled">
                    <li>
                        <span class="stay-touch__icon"><i class="fas fa-phone-alt" aria-hidden="true"></i></span>
                        <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php echo $contact_phone; ?></a>
                        <small><?php te('stay_touch_phone_note'); ?></small>
                    </li>
                    <li>
                        <span class="stay-touch__icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                        <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                        <small><?php te('stay_touch_email_note'); ?></small>
                    </li>
                    <li>
                        <span class="stay-touch__icon"><i class="fas fa-globe" aria-hidden="true"></i></span>
                        <a href="<?php echo $site_url; ?>"><?php echo $site_url_label; ?></a>
                        <small><?php te('stay_touch_web_note'); ?></small>
                    </li>
                    <li>
                        <span class="stay-touch__icon"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span>
                        <a href="<?php echo $contact_maps_url; ?>" target="_blank" rel="noopener"><?php echo $contact_address; ?></a>
                        <small><?php te('stay_touch_location_note'); ?></small>
                    </li>
                </ul>

                <?php if (!empty($sl_active)): ?>
                    <div class="stay-touch__social">
                        <?php foreach ($sl_active as $key => $s): ?>
                            <a class="stay-touch__social__item is-<?php echo $key; ?>"
                               href="<?php echo $s['url']; ?>" target="_blank" rel="noopener">
                                <i class="<?php echo $s['icon']; ?>" aria-hidden="true"></i>
                                <span><?php echo $s['handle'] !== '' ? $s['handle'] : $s['label']; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="stay-touch__cta">
                    <a href="/#download-app" class="cityride-btn cityride-btn--primary"><span><?php te('primary_cta_text'); ?></span></a>
                    <a href="/contact" class="stay-touch__cta__link"><?php te('stay_touch_send_message'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
