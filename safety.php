<?php
$current_page = 'safety';
include 'includes/config.php';
$page_title = t('safety_page_title');
$meta_description = t('safety_meta_description');
include 'includes/header.php';
?>
<main class="safety-page">
    <section class="page-header">
        <?php include 'includes/road.php'; ?>
        <div class="container">
            <p class="safety-kicker"><?php te('safety_kicker'); ?></p>
            <h1><?php te('safety_hero_title'); ?></h1>
            <p><?php te('safety_hero_text'); ?></p>
        </div>
    </section>
    <section class="section-space safety-standards">
        <div class="container">
            <div class="safety-grid">
                <article class="safety-card"><span class="safety-card__icon"><i class="fas fa-id-card" aria-hidden="true"></i></span><h2><?php te('safety_card1_title'); ?></h2><p><?php te('safety_card1_text'); ?></p></article>
                <article class="safety-card"><span class="safety-card__icon"><i class="fas fa-car" aria-hidden="true"></i></span><h2><?php te('safety_card2_title'); ?></h2><p><?php te('safety_card2_text'); ?></p></article>
                <article class="safety-card"><span class="safety-card__icon"><i class="fas fa-location-arrow" aria-hidden="true"></i></span><h2><?php te('safety_card3_title'); ?></h2><p><?php te('safety_card3_text'); ?></p></article>
                <article class="safety-card"><span class="safety-card__icon"><i class="fas fa-receipt" aria-hidden="true"></i></span><h2><?php te('safety_card4_title'); ?></h2><p><?php te('safety_card4_text'); ?></p></article>
                <article class="safety-card"><span class="safety-card__icon"><i class="fas fa-headset" aria-hidden="true"></i></span><h2><?php te('safety_card5_title'); ?></h2><p><?php te('safety_card5_text'); ?></p></article>
            </div>
        </div>
    </section>
    <section class="safety-band">
        <div class="container">
            <div class="safety-band__inner">
                <div class="safety-band__media">
                    <img src="assets/images/safeline-fleet-side-branded.jpg"
                         alt="<?php te('safety_band_image_alt'); ?>"
                         loading="lazy" decoding="async">
                </div>
                <div class="safety-band__body">
                    <p class="safety-kicker"><?php te('safety_band_kicker'); ?></p>
                    <h2><?php te('safety_band_title'); ?></h2>
                    <p><?php te('safety_band_text'); ?></p>
                    <ul class="safety-band__list list-unstyled">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('safety_band_item1'); ?></li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('safety_band_item2'); ?></li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('safety_band_item3'); ?></li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('safety_band_item4'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space safety-rider">
        <div class="container">
            <div class="safety-rider__head">
                <p class="safety-kicker"><?php te('safety_rider_kicker'); ?></p>
                <h2><?php te('safety_rider_title'); ?></h2>
                <p><?php te('safety_rider_text'); ?></p>
            </div>
            <div class="safety-rider__grid">
                <article class="safety-rider__item">
                    <span class="safety-rider__num">01</span>
                    <h3><?php te('safety_rider1_title'); ?></h3>
                    <p><?php te('safety_rider1_text'); ?></p>
                </article>
                <article class="safety-rider__item">
                    <span class="safety-rider__num">02</span>
                    <h3><?php te('safety_rider2_title'); ?></h3>
                    <p><?php te('safety_rider2_text'); ?></p>
                </article>
                <article class="safety-rider__item">
                    <span class="safety-rider__num">03</span>
                    <h3><?php te('safety_rider3_title'); ?></h3>
                    <p><?php te('safety_rider3_text'); ?></p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-space safety-help">
        <div class="container safety-help__inner">
            <div>
                <p class="safety-kicker"><?php te('safety_help_kicker'); ?></p>
                <h2><?php te('safety_help_title'); ?></h2>
                <p><?php te('safety_help_text'); ?></p>
            </div>
            <div class="safety-help__actions">
                <a class="cityride-btn cityride-btn--secondary" href="/contact"><span><?php te('safety_help_contact_btn'); ?></span></a>
                <a class="safety-help__call" href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>">
                    <i class="fas fa-phone-alt" aria-hidden="true"></i>
                    <span><?php te('safety_help_call_text', ['phone' => $contact_phone]); ?></span>
                </a>
            </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
