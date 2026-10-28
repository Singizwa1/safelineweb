<?php
$current_page = 'how-it-works';
include 'includes/config.php';
$page_title = t('hiw_page_title');
$meta_description = t('hiw_meta_description');
include 'includes/header.php';
?>
<main class="hiw-page">

    <!-- Hero -->
    <section class="page-header hiw-hero">
        <!-- Background traffic: one car. Decorative only, so aria-hidden
             and empty alt. -->
        <div class="sl-road" aria-hidden="true">
            <span class="sl-road__surface"></span>
            <span class="sl-road__dashes"></span>
            <img class="sl-car" src="assets/images/safeline-cruze-side-r.png" alt="" decoding="async">
        </div>
        <div class="container">
            <p class="hiw-hero__eyebrow"><?php te('hiw_hero_eyebrow'); ?></p>
            <h1 class="hiw-hero__title"><?php te('hiw_hero_title_line1'); ?> <br><?php te('hiw_hero_title_line2'); ?></h1>
            <p class="hiw-hero__text"><?php te('hiw_hero_text'); ?></p>
        </div>
    </section>

    <!-- Ways to travel -->
    <section class="hiw-channels section-space">
        <div class="container">
            <div class="hiw-features__header">
                <p class="hiw-features__eyebrow"><?php te('hiw_channels_eyebrow'); ?></p>
                <h2 class="hiw-features__title"><?php te('hiw_channels_title'); ?></h2>
            </div>
            <div class="hiw-channels__grid">
                <div class="hiw-channel-card">
                    <span class="hiw-channel-card__badge"><?php te('hiw_badge_in_app'); ?></span>
                    <div class="hiw-channel-card__icon"><i class="fas fa-bolt"></i></div>
                    <h3 class="hiw-channel-card__title"><?php te('hiw_ride_now_title'); ?></h3>
                    <p class="hiw-channel-card__text"><?php te('hiw_ride_now_text'); ?></p>
                    <a href="/#download-app" class="hiw-channel-card__link"><?php te('hiw_get_app_link'); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="hiw-channel-card">
                    <span class="hiw-channel-card__badge"><?php te('hiw_badge_in_app'); ?></span>
                    <div class="hiw-channel-card__icon"><i class="fas fa-car-side"></i></div>
                    <h3 class="hiw-channel-card__title"><?php te('hiw_rent_car_title'); ?></h3>
                    <p class="hiw-channel-card__text"><?php te('hiw_rent_car_text'); ?></p>
                    <a href="/#download-app" class="hiw-channel-card__link"><?php te('hiw_get_app_link'); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="hiw-channel-card hiw-channel-card--highlight">
                    <span class="hiw-channel-card__badge"><?php te('hiw_badge_on_website'); ?></span>
                    <div class="hiw-channel-card__icon"><i class="fas fa-route"></i></div>
                    <h3 class="hiw-channel-card__title"><?php te('hiw_intercity_title'); ?></h3>
                    <p class="hiw-channel-card__text"><?php te('hiw_intercity_text'); ?></p>
                    <a href="/#intercity" class="hiw-channel-card__link"><?php te('hiw_see_intercity_link'); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Tabs Section -->
    <section class="hiw-tabs section-space" id="hiw-steps">
        <div class="container">

            <div class="hiw-tabs__header">
                <p class="hiw-tabs__eyebrow"><?php te('hiw_tabs_eyebrow'); ?></p>
                <h2 class="hiw-tabs__title"><?php te('hiw_tabs_title'); ?></h2>
                <p class="hiw-tabs__subtitle"><?php te('hiw_tabs_subtitle'); ?></p>
            </div>

            <div class="hiw-tabs__controls" role="tablist" aria-label="Booking process steps">
                <button class="hiw-tab active" role="tab" aria-selected="true" aria-controls="step-1" id="tab-1" data-step="1">
                    <span class="hiw-tab__number">01</span>
                    <span class="hiw-tab__label"><?php te('hiw_tab1_label'); ?></span>
                    <span class="hiw-tab__bar"></span>
                </button>
                <button class="hiw-tab" role="tab" aria-selected="false" aria-controls="step-2" id="tab-2" data-step="2">
                    <span class="hiw-tab__number">02</span>
                    <span class="hiw-tab__label"><?php te('hiw_tab2_label'); ?></span>
                    <span class="hiw-tab__bar"></span>
                </button>
                <button class="hiw-tab" role="tab" aria-selected="false" aria-controls="step-3" id="tab-3" data-step="3">
                    <span class="hiw-tab__number">03</span>
                    <span class="hiw-tab__label"><?php te('hiw_tab3_label'); ?></span>
                    <span class="hiw-tab__bar"></span>
                </button>
            </div>

            <!-- Progress bar connecting the tabs -->
            <p class="hiw-sr-only" id="hiw-step-status" role="status" aria-live="polite"></p>
            <div class="hiw-tabs__progress" role="progressbar" aria-label="Booking process progress" aria-valuemin="1" aria-valuemax="3" aria-valuenow="1">
                <div class="hiw-tabs__progress-fill" id="hiw-progress-fill"></div>
            </div>

            <!-- Tab Panels -->
            <div class="hiw-tabs__panels">

                <!-- Step 1 -->
                <div class="hiw-panel active" role="tabpanel" id="step-1" aria-labelledby="tab-1">
                    <div class="hiw-panel__grid">
                        <div class="hiw-panel__content">
                            <span class="hiw-panel__step-badge"><?php te('hiw_step_badge', ['n' => '01']); ?></span>
                            <h3 class="hiw-panel__title"><?php te('hiw_step1_title'); ?></h3>
                            <p class="hiw-panel__text"><?php te('hiw_step1_text'); ?></p>
                            <ul class="hiw-panel__features">
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-route"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_fixed_route_title'); ?></strong>
                                        <span><?php te('hiw_feat_fixed_route_text'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-chair"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_only_available_title'); ?></strong>
                                        <span><?php te('hiw_feat_only_available_text'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-user"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_just_name_title'); ?></strong>
                                        <span><?php te('hiw_feat_just_name_text'); ?></span>
                                    </div>
                                </li>
                            </ul>
                            <a class="cityride-btn cityride-btn--primary hiw-panel__cta" href="/#intercity">
                                <span><i class="fas fa-route"></i>&nbsp; <?php te('hiw_see_intercity_trips_cta'); ?></span>
                            </a>
                        </div>
                        <div class="hiw-panel__visual">
                            <div class="hiw-mockup hiw-mockup--pickup">
                                <div class="hiw-mockup__screen">
                                    <div class="hiw-mockup__header-bar">
                                        <span class="hiw-mockup__dot"></span>
                                        <span class="hiw-mockup__dot"></span>
                                        <span class="hiw-mockup__dot"></span>
                                    </div>
                                    <div class="hiw-mockup__field">
                                        <i class="fas fa-location-arrow"></i>
                                        <div class="hiw-mockup__field-placeholder"></div>
                                    </div>
                                    <div class="hiw-mockup__field">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div class="hiw-mockup__field-placeholder hiw-mockup__field-placeholder--short"></div>
                                    </div>
                                    <div class="hiw-mockup__row">
                                        <div class="hiw-mockup__field hiw-mockup__field--half">
                                            <i class="fas fa-calendar"></i>
                                            <div class="hiw-mockup__field-placeholder hiw-mockup__field-placeholder--tiny"></div>
                                        </div>
                                        <div class="hiw-mockup__field hiw-mockup__field--half">
                                            <i class="fas fa-clock"></i>
                                            <div class="hiw-mockup__field-placeholder hiw-mockup__field-placeholder--tiny"></div>
                                        </div>
                                    </div>
                                    <div class="hiw-mockup__cta-btn"></div>
                                </div>
                                <div class="hiw-mockup__glow"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="hiw-panel" role="tabpanel" id="step-2" aria-labelledby="tab-2" hidden>
                    <div class="hiw-panel__grid">
                        <div class="hiw-panel__content">
                            <span class="hiw-panel__step-badge"><?php te('hiw_step_badge', ['n' => '02']); ?></span>
                            <h3 class="hiw-panel__title"><?php te('hiw_tab2_label'); ?></h3>
                            <p class="hiw-panel__text"><?php te('hiw_step2_text'); ?></p>
                            <ul class="hiw-panel__features">
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-tags"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_fixed_price_title'); ?></strong>
                                        <span><?php te('hiw_feat_fixed_price_text'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-mobile-alt"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_momo_title'); ?></strong>
                                        <span><?php te('hiw_feat_momo_text'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-shield-alt"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_vetted_title'); ?></strong>
                                        <span><?php te('hiw_feat_vetted_text'); ?></span>
                                    </div>
                                </li>
                            </ul>
                            <a class="cityride-btn cityride-btn--primary hiw-panel__cta" href="/#intercity">
                                <span><i class="fas fa-check-circle"></i>&nbsp; <?php te('hiw_book_a_seat_cta'); ?></span>
                            </a>
                        </div>
                        <div class="hiw-panel__visual">
                            <div class="hiw-mockup hiw-mockup--fare">
                                <div class="hiw-mockup__screen">
                                    <div class="hiw-mockup__header-bar">
                                        <span class="hiw-mockup__dot"></span>
                                        <span class="hiw-mockup__dot"></span>
                                        <span class="hiw-mockup__dot"></span>
                                    </div>
                                    <div class="hiw-mockup__fare-card">
                                        <div class="hiw-mockup__fare-row">
                                            <span class="hiw-mockup__fare-label"></span>
                                            <span class="hiw-mockup__fare-value"></span>
                                        </div>
                                        <div class="hiw-mockup__fare-row">
                                            <span class="hiw-mockup__fare-label hiw-mockup__fare-label--long"></span>
                                            <span class="hiw-mockup__fare-value hiw-mockup__fare-value--short"></span>
                                        </div>
                                        <div class="hiw-mockup__fare-divider"></div>
                                        <div class="hiw-mockup__fare-row hiw-mockup__fare-row--total">
                                            <span class="hiw-mockup__fare-label"></span>
                                            <span class="hiw-mockup__fare-total"></span>
                                        </div>
                                    </div>
                                    <div class="hiw-mockup__cta-btn"></div>
                                </div>
                                <div class="hiw-mockup__glow"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="hiw-panel" role="tabpanel" id="step-3" aria-labelledby="tab-3" hidden>
                    <div class="hiw-panel__grid">
                        <div class="hiw-panel__content">
                            <span class="hiw-panel__step-badge"><?php te('hiw_step_badge', ['n' => '03']); ?></span>
                            <h3 class="hiw-panel__title"><?php te('hiw_step3_title'); ?></h3>
                            <p class="hiw-panel__text"><?php te('hiw_step3_text'); ?></p>
                            <ul class="hiw-panel__features">
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-sms"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_sms_title'); ?></strong>
                                        <span><?php te('hiw_feat_sms_text'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_pickup_title'); ?></strong>
                                        <span><?php te('hiw_feat_pickup_text'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="hiw-panel__feature-icon"><i class="fas fa-phone-alt"></i></span>
                                    <div>
                                        <strong><?php te('hiw_feat_phone_booking_title'); ?></strong>
                                        <span><?php te('hiw_feat_phone_booking_text'); ?></span>
                                    </div>
                                </li>
                            </ul>
                            <a class="cityride-btn cityride-btn--primary hiw-panel__cta" href="/#intercity">
                                <span><i class="fas fa-route"></i>&nbsp; <?php te('hiw_book_now_cta'); ?></span>
                            </a>
                        </div>
                        <div class="hiw-panel__visual">
                            <div class="hiw-mockup hiw-mockup--track">
                                <div class="hiw-mockup__screen">
                                    <div class="hiw-mockup__header-bar">
                                        <span class="hiw-mockup__dot"></span>
                                        <span class="hiw-mockup__dot"></span>
                                        <span class="hiw-mockup__dot"></span>
                                    </div>
                                    <div class="hiw-mockup__map">
                                        <div class="hiw-mockup__map-route"></div>
                                        <div class="hiw-mockup__map-pin hiw-mockup__map-pin--pickup"></div>
                                        <div class="hiw-mockup__map-pin hiw-mockup__map-pin--dropoff"></div>
                                        <div class="hiw-mockup__map-car"><i class="fas fa-car"></i></div>
                                    </div>
                                    <div class="hiw-mockup__status-bar">
                                        <div class="hiw-mockup__status-dot"></div>
                                        <span class="hiw-mockup__status-text"></span>
                                    </div>
                                </div>
                                <div class="hiw-mockup__glow"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="hiw-features section-space">
        <div class="container">
            <div class="hiw-features__header">
                <p class="hiw-features__eyebrow"><?php te('hiw_features_eyebrow'); ?></p>
                <h2 class="hiw-features__title"><?php te('hiw_features_title'); ?></h2>
            </div>
            <div class="hiw-features__grid">
                <div class="hiw-feature-card">
                    <div class="hiw-feature-card__icon"><i class="fas fa-bolt"></i></div>
                    <h3 class="hiw-feature-card__title"><?php te('hiw_feature_instant_title'); ?></h3>
                    <p class="hiw-feature-card__text"><?php te('hiw_feature_instant_text'); ?></p>
                </div>
                <div class="hiw-feature-card">
                    <div class="hiw-feature-card__icon"><i class="fas fa-car-side"></i></div>
                    <h3 class="hiw-feature-card__title"><?php te('hiw_feature_rent_title'); ?></h3>
                    <p class="hiw-feature-card__text"><?php te('hiw_feature_rent_text'); ?></p>
                </div>
                <div class="hiw-feature-card">
                    <div class="hiw-feature-card__icon"><i class="fas fa-route"></i></div>
                    <h3 class="hiw-feature-card__title"><?php te('hiw_feature_intercity_title'); ?></h3>
                    <p class="hiw-feature-card__text"><?php te('hiw_feature_intercity_text'); ?></p>
                </div>
                <div class="hiw-feature-card">
                    <div class="hiw-feature-card__icon"><i class="fas fa-lock"></i></div>
                    <h3 class="hiw-feature-card__title"><?php te('hiw_feature_pricing_title'); ?></h3>
                    <p class="hiw-feature-card__text"><?php te('hiw_feature_pricing_text'); ?></p>
                </div>
                <div class="hiw-feature-card">
                    <div class="hiw-feature-card__icon"><i class="fas fa-user-shield"></i></div>
                    <h3 class="hiw-feature-card__title"><?php te('hiw_feature_verified_title'); ?></h3>
                    <p class="hiw-feature-card__text"><?php te('hiw_feature_verified_text'); ?></p>
                </div>
                <div class="hiw-feature-card">
                    <div class="hiw-feature-card__icon"><i class="fas fa-headset"></i></div>
                    <h3 class="hiw-feature-card__title"><?php te('hiw_feature_support_title'); ?></h3>
                    <p class="hiw-feature-card__text"><?php te('hiw_feature_support_text'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="hiw-faq section-space">
        <div class="container">
            <div class="hiw-faq__grid">
                <div class="hiw-faq__left">
                    <p class="hiw-faq__eyebrow"><?php te('hiw_faq_eyebrow'); ?></p>
                    <h2 class="hiw-faq__title"><?php te('hiw_faq_title'); ?></h2>
                    <p class="hiw-faq__text"><?php te('hiw_faq_prefix'); ?> <a href="/contact"><?php te('hiw_faq_link'); ?></a> <?php te('hiw_faq_suffix'); ?></p>
                </div>
                <div class="hiw-faq__right">
                    <details class="hiw-accordion" open>
                        <summary class="hiw-accordion__trigger"><?php te('hiw_faq1_q'); ?></summary>
                        <div class="hiw-accordion__body">
                            <p><?php te('hiw_faq1_a'); ?></p>
                        </div>
                    </details>
                    <details class="hiw-accordion">
                        <summary class="hiw-accordion__trigger"><?php te('hiw_faq2_q'); ?></summary>
                        <div class="hiw-accordion__body">
                            <p><?php te('hiw_faq2_a'); ?></p>
                        </div>
                    </details>
                    <details class="hiw-accordion">
                        <summary class="hiw-accordion__trigger"><?php te('hiw_faq3_q'); ?></summary>
                        <div class="hiw-accordion__body">
                            <p><?php te('hiw_faq3_a'); ?></p>
                        </div>
                    </details>
                    <details class="hiw-accordion">
                        <summary class="hiw-accordion__trigger"><?php te('hiw_faq4_q'); ?></summary>
                        <div class="hiw-accordion__body">
                            <p><?php te('hiw_faq4_a_prefix'); ?> <a href="/taxi"><?php te('hiw_faq4_a_link'); ?></a><?php te('hiw_faq4_a_suffix'); ?></p>
                        </div>
                    </details>
                    <details class="hiw-accordion">
                        <summary class="hiw-accordion__trigger"><?php te('hiw_faq5_q'); ?></summary>
                        <div class="hiw-accordion__body">
                            <p><?php te('hiw_faq5_a'); ?></p>
                        </div>
                    </details>
                    <details class="hiw-accordion">
                        <summary class="hiw-accordion__trigger"><?php te('hiw_faq6_q'); ?></summary>
                        <div class="hiw-accordion__body">
                            <p><?php te('hiw_faq6_a'); ?></p>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="hiw-cta">
        <div class="container">
            <div class="hiw-cta__card">
                <div class="hiw-cta__card-inner">
                    <p class="hiw-cta__eyebrow"><?php te('hiw_cta_eyebrow'); ?></p>
                    <h2 class="hiw-cta__title"><?php te('hiw_cta_title'); ?></h2>
                    <p class="hiw-cta__text"><?php te('hiw_cta_text'); ?></p>
                    <div class="hiw-cta__actions">
                        <a class="cityride-btn cityride-btn--primary hiw-cta__btn" href="/#intercity">
                            <span><i class="fas fa-route"></i>&nbsp; <?php te('hiw_cta_book_intercity'); ?></span>
                        </a>
                        <a class="cityride-btn cityride-btn--border hiw-cta__btn" href="/#download-app">
                            <span><i class="fas fa-mobile-alt"></i>&nbsp; <?php te('hiw_cta_get_app'); ?></span>
                        </a>
                        <a href="tel:+250788471117" class="hiw-cta__phone">
                            <i class="fas fa-phone-alt"></i> +250 788 471 117
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
(function () {
    "use strict";

    var tabs   = Array.prototype.slice.call(document.querySelectorAll('.hiw-tab'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('.hiw-panel'));
    var fill   = document.getElementById('hiw-progress-fill');
    var live   = document.getElementById('hiw-step-status');
    if (!tabs.length) { return; }

    var total = tabs.length;
    var current = 1;

    function panelFor(step) {
        return document.getElementById('step-' + step);
    }

    function activate(step, moveFocus, writeHash) {
        step = Math.min(Math.max(step, 1), total);
        current = step;

        tabs.forEach(function (t) {
            var on = parseInt(t.dataset.step, 10) === step;
            t.classList.toggle('active', on);
            t.setAttribute('aria-selected', on ? 'true' : 'false');
            // ARIA tabs pattern: only the selected tab sits in the tab order,
            // so Tab moves on into the panel instead of across the tabs.
            t.tabIndex = on ? 0 : -1;
        });

        panels.forEach(function (pnl) {
            var on = pnl.id === 'step-' + step;
            pnl.classList.toggle('active', on);
            if (on) { pnl.removeAttribute('hidden'); } else { pnl.setAttribute('hidden', ''); }
            pnl.tabIndex = on ? 0 : -1;
        });

        if (fill) {
            // the bar shows progress THROUGH the steps: 1/3, 2/3, 3/3.
            fill.style.width = ((step / total) * 100) + '%';
            fill.setAttribute('aria-valuenow', String(step));
        }
        if (live) {
            live.textContent = 'Step ' + step + ' of ' + total + ': ' +
                (tabs[step - 1].querySelector('.hiw-tab__label') || {}).textContent;
        }
        if (moveFocus) { tabs[step - 1].focus(); }

        // Keep the step shareable, but only once the visitor has actually
        // picked one: writing the hash on load makes a refresh jump straight
        // past the hero to the tab strip.
        if (writeHash && window.history && history.replaceState) {
            history.replaceState(null, '', '#step-' + step);
        }
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activate(parseInt(this.dataset.step, 10), false, true);
        });
        tab.addEventListener('keydown', function (e) {
            var next = null;
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') { next = current % total + 1; }
            else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') { next = (current - 2 + total) % total + 1; }
            else if (e.key === 'Home') { next = 1; }
            else if (e.key === 'End') { next = total; }
            if (next !== null) { e.preventDefault(); activate(next, true, true); }
        });
    });

    // deep link: /how-it-works.php#step-2 opens that step
    function fromHash() {
        var m = /^#step-([1-9]\d*)$/.exec(window.location.hash);
        if (m) {
            var n = parseInt(m[1], 10);
            if (n >= 1 && n <= total) { activate(n, false, false); return true; }
        }
        return false;
    }
    window.addEventListener('hashchange', fromHash);

    if (!fromHash()) { activate(1, false, false); }
}());
</script>

<?php include 'includes/footer.php'; ?>
