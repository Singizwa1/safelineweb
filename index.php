<?php
$current_page = 'home';
include 'includes/config.php';
$meta_description = t('home_meta_description');
include 'includes/header.php';
?>
<style>
/* Hero image sizing lives in safeline-theme.css (rule 15).
   The old transform: scale(1.3) made the image overflow its column
   instead of filling it, so it is intentionally gone. */

.intercity-one__lead { text-align: center; max-width: 640px; margin: 0 auto 40px; color: var(--color-text-secondary, #5A6577); font-size: 16px; }
.intercity-trip-card { background: #fff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,24,50,0.08); padding: 22px 24px; height: 100%; display: flex; flex-direction: column; gap: 10px; }
.intercity-trip-card__badge { align-self: flex-start; background: rgba(99,197,31,0.12); color: #2F6F0C; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
.intercity-trip-card__route { font-size: 19px; font-weight: 800; color: #001832; margin: 0; }
.intercity-trip-card__route i { color: #63C51F; margin: 0 4px; font-size: 14px; }
.intercity-trip-card__meta { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 6px; font-size: 13.5px; color: var(--color-text-secondary, #5A6577); }
.intercity-trip-card__meta i { width: 16px; color: #63C51F; margin-right: 6px; }
.intercity-trip-card__footer { margin-top: auto; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px 12px; padding-top: 10px; }
.intercity-trip-card__price { font-weight: 800; color: #001832; white-space: nowrap; }
.intercity-trip-card__price small { font-weight: 500; color: var(--color-text-secondary, #5A6577); }
.intercity-trip-card__actions { display: flex; gap: 8px; flex-wrap: wrap; }
.intercity-trip-card__actions .cityride-btn { flex: 1; }

.photo-gallery { position: fixed; inset: 0; z-index: 1200; }
.photo-gallery[hidden] { display: none; }
.photo-gallery__backdrop { position: absolute; inset: 0; background: rgba(0,10,20,0.88); }
.photo-gallery__dialog { position: relative; height: 100%; display: flex; align-items: center; justify-content: center; }
.photo-gallery__image { max-width: 88vw; max-height: 82vh; object-fit: contain; border-radius: 10px; }
.photo-gallery__close { position: absolute; top: 18px; right: 22px; background: none; border: none; color: #fff; font-size: 34px; line-height: 1; cursor: pointer; }
.photo-gallery__arrow { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.12); border: none; color: #fff; width: 44px; height: 44px; border-radius: 50%; cursor: pointer; font-size: 16px; }
.photo-gallery__arrow--prev { left: 18px; }
.photo-gallery__arrow--next { right: 18px; }
.photo-gallery__counter { position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%); color: #fff; font-size: 13px; opacity: 0.8; }

.phone-input-group { display: flex; align-items: stretch; }
.phone-input-group__prefix { display: flex; align-items: center; padding: 0 14px; border: 1px solid rgba(0, 24, 50, 0.12); border-right: none; border-radius: 12px 0 0 12px; background: rgba(0, 24, 50, 0.04); color: #001832; font-weight: 600; font-size: 15px; }
.phone-input-group__field { border-radius: 0 12px 12px 0 !important; }
.form-error-text { color: #C62828; font-size: 12.5px; margin: 6px 0 0; }
.network-toggle { display: flex; gap: 10px; margin: 0 0 8px; }
.network-toggle__pill { display: flex; align-items: center; gap: 6px; padding: 7px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; border: 1.5px solid; background: #fff; cursor: pointer; transition: all 0.15s ease; }
.network-toggle__pill[data-network="mtn"] { color: #C99A00; border-color: #FFCC08; }
.network-toggle__pill[data-network="airtel"] { color: #ED1C24; border-color: #ED1C24; }
.network-toggle__pill.is-active[data-network="mtn"] { background: #FFCC08; color: #11161F; }
.network-toggle__pill.is-active[data-network="airtel"] { background: #ED1C24; color: #fff; }
.form-help-text { color: var(--color-text-secondary, #5A6577); font-size: 12.5px; margin: 6px 0 0; }
.payment-step-intro { color: #001832; font-size: 14px; margin: 0 0 16px; }
.booking-back-btn { display: block; width: 100%; background: none; border: none; color: var(--color-text-secondary, #5A6577); font-size: 14px; font-weight: 600; text-align: center; padding: 12px 0 0; cursor: pointer; }
</style>

    <!-- HERO: full-bleed fleet photos that slide (autoplay, arrows, swipe,
         drag, keyboard) under one still sentence. Photos are decorative
         (aria-hidden). Carousel logic: assets/js/safeline-premium.js (2). -->
    <section class="sl-hero" id="home">
            <div class="sl-hero__slides" aria-hidden="true">
                <div class="sl-hero__slide is-active is-first"><img src="assets/images/safeline-fleet-side-branded.jpg" alt="" width="1600" height="1200" fetchpriority="high" decoding="async" draggable="false" style="--focus: 50% 45%"></div>
                <div class="sl-hero__slide"><img src="assets/images/safeline-road-01.jpg" alt="" width="1200" height="900" decoding="async" draggable="false" style="--focus: 50% 80%; --zoom: 1"></div>
                <div class="sl-hero__slide"><img src="assets/images/fleet-07-branded.jpg" alt="" width="1600" height="1200" decoding="async" draggable="false" style="--focus: 50% 66%"></div>
                <div class="sl-hero__slide"><img src="assets/images/safeline-road-02.jpg" alt="" width="1200" height="900" decoding="async" draggable="false" style="--focus: 50% 50%"></div>
            </div>
            <div class="sl-hero__shade" aria-hidden="true"></div>

            <div class="container sl-hero__inner">
                <div class="sl-hero__main">
                    <div class="sl-hero__copy">
                        <h1 class="sl-hero__title"><?php te('home_hero_title_a'); ?> <em><?php te('home_hero_title_b'); ?></em></h1>
                        <p class="sl-hero__lead"><?php te('home_hero_lead'); ?></p>
                        <div class="sl-hero__actions">
                            <a href="#download-app" class="js-ride-cta cityride-btn cityride-btn--primary sl-hero__btn"><span><?php te('primary_cta_text'); ?></span></a>
                            <a href="#services" class="sl-hero__link"><?php te('home_see_services'); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div class="sl-hero__controls">
                        <div class="sl-hero__nav">
                            <button type="button" class="sl-hero__arrow" data-step="-1" aria-label="<?php te('home_hero_prev'); ?>"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
                            <button type="button" class="sl-hero__arrow" data-step="1" aria-label="<?php te('home_hero_next'); ?>"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Static (non-sliding) Private VIP panel - the single
                     next-departing private car, independent of the shared
                     trips rotating on the left. Populated/shown by
                     renderPrivateHeroPanel() in home-intercity.js; stays
                     hidden while no private VIP trip is published. -->
                <div class="sl-hero__private" id="intercity-private-hero" hidden></div>
            </div>
        </section>

        <!-- Stats Counter Bar -->
        <section class="stats-bar" id="stats">
            <div class="container">
                <div class="stats-bar__grid">
                    <div class="stats-bar__item">
                        <div class="stats-bar__number"><span class="count-text" data-stop="6561" data-speed="1500">6,561</span>+</div>
                        <div class="stats-bar__label"><?php te('home_stat_riders'); ?></div>
                    </div>
                    <div class="stats-bar__divider"></div>
                    <div class="stats-bar__item">
                        <div class="stats-bar__number"><span class="count-text" data-stop="200" data-speed="1500">200</span>+</div>
                        <div class="stats-bar__label"><?php te('about_stat_verified_drivers'); ?></div>
                    </div>
                    <div class="stats-bar__divider"></div>
                    <div class="stats-bar__item">
                        <div class="stats-bar__number">24/6</div>
                        <div class="stats-bar__label"><?php te('home_stat_available'); ?></div>
                    </div>
                    <div class="stats-bar__divider"></div>
                    <div class="stats-bar__item">
                        <div class="stats-bar__number"><span class="count-text" data-stop="15000" data-speed="1500">15,000</span>+</div>
                        <div class="stats-bar__label"><?php te('home_stat_rides'); ?></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SERVICES: photo-led cards, one line each -->
        <section class="sl-services section-space" id="services">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top"><h6 class="sec-title__tagline"><?php te('home_services_tagline'); ?></h6></div>
                    <h3 class="sec-title__title"><?php te('home_services_title_line1'); ?> <?php te('home_services_title_line2'); ?></h3>
                </div>
                <div class="sl-services__grid">
                    <a class="sl-service" href="#download-app">
                        <span class="sl-service__media"><img src="assets/images/cards/card-city-rides.jpg" alt="" loading="lazy" decoding="async" width="720" height="540"></span>
                        <span class="sl-service__body">
                            <span class="sl-service__icon"><i class="fas fa-car-side" aria-hidden="true"></i></span>
                            <span class="sl-service__title"><?php te('home_service1'); ?></span>
                            <span class="sl-service__text"><?php te('home_service1_text'); ?></span>
                        </span>
                    </a>
                    <a class="sl-service" href="#download-app">
                        <span class="sl-service__media"><img src="assets/images/safeline-fleet-side-branded.jpg" alt="" loading="lazy" decoding="async" width="1600" height="1200"></span>
                        <span class="sl-service__body">
                            <span class="sl-service__icon"><i class="fas fa-route" aria-hidden="true"></i></span>
                            <span class="sl-service__title"><?php te('home_service3'); ?></span>
                            <span class="sl-service__text"><?php te('home_service3_text'); ?></span>
                        </span>
                    </a>
                    <a class="sl-service" href="#download-app">
                        <span class="sl-service__media"><img src="assets/images/cards/card-city-rides.jpg" alt="" loading="lazy" decoding="async" width="720" height="540"></span>
                        <span class="sl-service__body">
                            <span class="sl-service__icon"><i class="fas fa-box" aria-hidden="true"></i></span>
                            <span class="sl-service__title"><?php te('home_service2'); ?></span>
                            <span class="sl-service__text"><?php te('home_service2_text'); ?></span>
                        </span>
                    </a>
                    <a class="sl-service" href="#download-app">
                        <span class="sl-service__media"><img src="assets/images/cards/card-city-rides.jpg" alt="" loading="lazy" decoding="async" width="720" height="540"></span>
                        <span class="sl-service__body">
                            <span class="sl-service__icon"><i class="fas fa-key" aria-hidden="true"></i></span>
                            <span class="sl-service__title"><?php te('home_service4'); ?></span>
                            <span class="sl-service__text"><?php te('home_service4_text'); ?></span>
                        </span>
                    </a>
                </div>
            </div>
        </section>

        <!-- VISION & MISSION: two short statement cards on a navy band -->
        <section class="sl-purpose section-space" id="mission">

            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top"><h6 class="sec-title__tagline"><?php te('home_purpose_tagline'); ?></h6></div>
                    <h3 class="sec-title__title"><?php te('home_purpose_title'); ?></h3>
                </div>
                <p class="sl-purpose__lead"><?php te('home_purpose_lead'); ?></p>
                <div class="sl-purpose__grid">
                    <?php foreach (['vision' => 'fa-eye', 'mission' => 'fa-bullseye'] as $key => $icon): ?>
                    <article class="sl-purpose__card sl-purpose__card--<?php echo $key; ?>">
                        <div class="sl-purpose__head">
                            <span class="sl-purpose__icon"><i class="fas <?php echo $icon; ?>" aria-hidden="true"></i></span>
                            <div>
                                <h4 class="sl-purpose__title"><?php te('home_purpose_' . $key . '_title'); ?></h4>
                            </div>
                        </div>
                        <p class="sl-purpose__text"><?php te('home_purpose_' . $key . '_text'); ?></p>
                        <ul class="sl-purpose__tags list-unstyled">
                            <?php for ($i = 1; $i <= 3; $i++): ?>
                            <li><i class="fas fa-check" aria-hidden="true"></i><?php te('home_purpose_' . $key . '_tag' . $i); ?></li>
                            <?php endfor; ?>
                        </ul>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- HOW IT WORKS: one card per service; "View" opens a step-by-step
             pop-up (<dialog>). The header dropdown links to #hiw-ride,
             #hiw-intercity and #hiw-parcel, which open the same pop-ups
             (wired in safeline-premium.js). -->
        <?php
            $hiw_items = [
                'ride'     => ['icon' => 'fa-car-side', 'card' => 'home_step1', 'cta' => '#download-app'],
                'intercity'=> ['icon' => 'fa-route',    'card' => 'home_step2', 'cta' => '#intercity', 'key' => 'ic'],
                'parcel'   => ['icon' => 'fa-box',      'card' => 'home_step3', 'cta' => '#contact'],
            ];
        ?>
        <section class="sl-hiw section-space" id="how-it-works">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top"><h6 class="sec-title__tagline"><?php te('home_hiw_tagline'); ?></h6></div>
                    <h3 class="sec-title__title"><?php te('home_hiw_title'); ?></h3>
                </div>
                <p class="sl-hiw__lead"><?php te('home_hiw_lead'); ?></p>
                <div class="sl-hiw__grid">
                    <?php foreach ($hiw_items as $id => $item): ?>
                    <article class="sl-hiw-card">
                        <span class="sl-hiw-card__icon"><i class="fas <?php echo $item['icon']; ?>" aria-hidden="true"></i></span>
                        <h4 class="sl-hiw-card__title"><?php te($item['card'] . '_title'); ?></h4>
                        <p class="sl-hiw-card__text"><?php te($item['card'] . '_text'); ?></p>
                        <button type="button" class="sl-hiw-card__btn" data-hiw-open="<?php echo $id; ?>" aria-haspopup="dialog">
                            <span><?php te('home_hiw_view_btn'); ?></span><i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php foreach ($hiw_items as $id => $item): $k = 'hiw_' . ($item['key'] ?? $id); ?>
        <dialog class="sl-hiw-modal" id="hiw-modal-<?php echo $id; ?>" aria-labelledby="hiw-modal-<?php echo $id; ?>-title">
            <div class="sl-hiw-modal__box">
                <button type="button" class="sl-hiw-modal__close" data-hiw-close aria-label="<?php te('hiw_modal_close'); ?>"><i class="fas fa-times" aria-hidden="true"></i></button>
                <header class="sl-hiw-modal__head">
                    <span class="sl-hiw-card__icon"><i class="fas <?php echo $item['icon']; ?>" aria-hidden="true"></i></span>
                    <div>
                        <span class="sl-hiw-modal__where"><i class="fas fa-map-pin" aria-hidden="true"></i><?php te($k . '_where'); ?></span>
                        <h3 class="sl-hiw-modal__title" id="hiw-modal-<?php echo $id; ?>-title"><?php te($item['card'] . '_title'); ?></h3>
                    </div>
                </header>
                <h4 class="sl-hiw-modal__sub"><?php te('hiw_modal_steps'); ?></h4>
                <ol class="sl-hiw-modal__steps list-unstyled">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                    <li>
                        <span class="sl-hiw-modal__num"><?php echo $i; ?></span>
                        <div>
                            <strong><?php te($k . '_s' . $i . '_t'); ?></strong>
                            <p><?php te($k . '_s' . $i . '_d'); ?></p>
                        </div>
                    </li>
                    <?php endfor; ?>
                </ol>
                <h4 class="sl-hiw-modal__sub"><?php te('hiw_modal_good'); ?></h4>
                <ul class="sl-hiw-modal__good list-unstyled">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                    <li><i class="fas fa-check" aria-hidden="true"></i><?php te($k . '_g' . $i); ?></li>
                    <?php endfor; ?>
                </ul>
                <a class="sl-hiw-modal__cta cityride-btn cityride-btn--primary" href="<?php echo $item['cta']; ?>" data-hiw-cta="<?php echo $id; ?>">
                    <span><?php te($k . '_cta'); ?></span>
                </a>
            </div>
        </dialog>
        <?php endforeach; ?>

        <section class="intercity-one section-space" id="intercity" hidden>
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('home_intercity_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                    <h3 class="sec-title__title"><?php te('home_intercity_title'); ?></h3>
                </div>
                <p class="intercity-one__lead"><?php te('home_intercity_lead'); ?></p>
                <div class="row gutter-y-30" id="intercity-trip-list"></div>
            </div>
        </section>

        <div class="booking-modal" id="intercity-modal" aria-hidden="true">
            <div class="booking-modal__backdrop" data-intercity-close></div>
            <div class="booking-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="intercity-modal-title">
                <div class="booking-modal__content">
                    <header class="booking-modal__header">
                        <div class="booking-modal__title-box">
                            <span class="booking-modal__logo">
                                <img src="images/safelinelogo/safelinelogo.png" alt="SafeLine" width="120" height="120">
                            </span>
                            <div>
                                <h2 class="booking-modal__title" id="intercity-modal-title"><?php te('home_intercity_modal_title'); ?></h2>
                                <p class="booking-modal__subtitle" id="intercity-modal-subtitle"></p>
                            </div>
                        </div>
                        <button class="booking-modal__close" type="button" aria-label="<?php te('home_intercity_close'); ?>" data-intercity-close>&times;</button>
                    </header>
                    <div class="booking-modal__body">
                        <section class="booking-form-section">
                            <div class="container">
                                <div class="booking-form-container">
                                    <form id="intercity-booking-form" novalidate>
                                        <input type="hidden" id="intercity_trip_id" name="trip_id">
                                        <div class="form-banner" id="intercity-banner" role="status" aria-live="polite" hidden>
                                            <span class="form-banner__icon" aria-hidden="true"></span>
                                            <div class="form-banner__body">
                                                <strong class="form-banner__title"></strong>
                                                <p class="form-banner__text"></p>
                                            </div>
                                            <button type="button" class="form-banner__close" aria-label="<?php te('home_intercity_dismiss'); ?>">&times;</button>
                                        </div>
                                        <div class="fare-display-card" id="intercity_fare_display" aria-live="polite">
                                            <div class="fare-info-row"><span class="fare-label"><?php te('home_intercity_dropoff'); ?></span><span class="fare-value" id="intercity_dropoff_text"></span></div>
                                            <div class="fare-info-row"><span class="fare-label"><?php te('home_intercity_price_per_seat'); ?></span><span class="fare-value" id="intercity_price_amount">0</span></div>
                                            <div class="fare-info-row"><span class="fare-label" id="intercity_total_label"><?php te('home_intercity_total'); ?></span><span class="fare-value fare-total" id="intercity_total_amount">0 RWF</span></div>
                                        </div>
                                        <div id="intercity_step_details">
                                            <div class="form-row" id="intercity_pickup_row" hidden>
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_pickup_point"><?php te('home_intercity_pickup_point'); ?></label>
                                                    <select class="form-control-enhanced" id="intercity_pickup_point" name="pickup_point_id"></select>
                                                </div>
                                            </div>
                                            <div class="form-row" id="intercity_private_pickup_row" hidden>
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_private_pickup_text"><?php te('ic_private_pickup_label'); ?></label>
                                                    <input class="form-control-enhanced" id="intercity_private_pickup_text" name="pickup_location_text" type="text" maxlength="255" placeholder="<?php te('ic_private_pickup_placeholder'); ?>">
                                                    <p class="form-error-text" id="intercity_private_pickup_error" hidden><?php te('ic_private_pickup_required'); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row" id="intercity_private_departure_row" hidden>
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_private_departure"><?php te('ic_private_departure_label'); ?></label>
                                                    <input class="form-control-enhanced" id="intercity_private_departure" name="departure_datetime" type="datetime-local">
                                                    <p class="form-error-text" id="intercity_private_departure_error" hidden><?php te('ic_private_departure_required'); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row" id="intercity_seat_count_row">
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_seat_count"><?php te('home_intercity_seat_count'); ?></label>
                                                    <input class="form-control-enhanced" id="intercity_seat_count" name="seat_count" type="number" inputmode="numeric" min="1" value="1" required>
                                                    <p class="form-error-text" id="intercity_seat_count_error" hidden></p>
                                                </div>
                                            </div>
                                            <p class="payment-step-intro" id="intercity_private_seats_note" hidden></p>
                                            <div class="form-row">
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_guest_name"><?php te('home_intercity_your_name'); ?></label>
                                                    <input class="form-control-enhanced" id="intercity_guest_name" name="guest_name" type="text" autocomplete="name" placeholder="<?php te('home_intercity_name_placeholder'); ?>" required>
                                                </div>
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_phone_number"><?php te('contact_field_phone'); ?></label>
                                                    <div class="phone-input-group">
                                                        <span class="phone-input-group__prefix">+250</span>
                                                        <input class="form-control-enhanced phone-input-group__field" id="intercity_phone_number" name="phone_number" type="tel" inputmode="numeric" autocomplete="tel-national" maxlength="9" placeholder="788123456" required>
                                                    </div>
                                                    <p class="form-error-text" id="intercity_phone_error" hidden><?php te('home_intercity_phone_error'); ?></p>
                                                </div>
                                            </div>
                                            <button class="submit-btn-enhanced" type="button" id="intercity_continue_btn"><?php te('home_intercity_submit'); ?></button>
                                            <p class="booking-assurance"><?php te('home_intercity_assurance'); ?></p>
                                        </div>
                                        <div id="intercity_step_payment" hidden>
                                            <p class="payment-step-intro"><?php te('ic_payment_step_intro'); ?></p>
                                            <div class="form-row">
                                                <div class="form-group-enhanced">
                                                    <label for="intercity_payment_phone_number"><?php te('ic_payment_phone_label'); ?></label>
                                                    <div class="network-toggle" id="intercity_payment_phone_network">
                                                        <button type="button" class="network-toggle__pill is-active" data-network="mtn"><i class="fas fa-credit-card" aria-hidden="true"></i><?php te('ic_network_mtn'); ?></button>
                                                        <button type="button" class="network-toggle__pill" data-network="airtel"><i class="fas fa-credit-card" aria-hidden="true"></i><?php te('ic_network_airtel'); ?></button>
                                                    </div>
                                                    <div class="phone-input-group">
                                                        <span class="phone-input-group__prefix">+250</span>
                                                        <input class="form-control-enhanced phone-input-group__field" id="intercity_payment_phone_number" name="payment_phone_number" type="tel" inputmode="numeric" autocomplete="tel-national" maxlength="9" placeholder="788123456" required>
                                                    </div>
                                                    <p class="form-help-text"><?php te('ic_payment_phone_help'); ?></p>
                                                    <p class="form-error-text" id="intercity_payment_phone_error" hidden><?php te('home_intercity_phone_error'); ?></p>
                                                </div>
                                            </div>
                                            <button class="submit-btn-enhanced" type="submit" id="intercity_pay_btn"><?php te('home_intercity_submit'); ?></button>
                                            <button class="booking-back-btn" type="button" id="intercity_back_btn"><?php te('ic_btn_back'); ?></button>
                                            <p class="booking-assurance"><?php te('home_intercity_assurance'); ?></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- "View Car" photo gallery - populated/opened by openPhotoGallery()
             in home-intercity.js; hidden entirely while unused. -->
        <div class="photo-gallery" id="intercity-photo-gallery" aria-hidden="true" hidden>
            <div class="photo-gallery__backdrop" data-gallery-close></div>
            <div class="photo-gallery__dialog" role="dialog" aria-modal="true">
                <button class="photo-gallery__close" type="button" aria-label="<?php te('ic_gallery_close'); ?>" data-gallery-close>&times;</button>
                <button class="photo-gallery__arrow photo-gallery__arrow--prev" type="button" data-gallery-step="-1" aria-label="<?php te('ic_gallery_prev'); ?>"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
                <img class="photo-gallery__image" id="intercity-photo-gallery-img" src="" alt="">
                <button class="photo-gallery__arrow photo-gallery__arrow--next" type="button" data-gallery-step="1" aria-label="<?php te('ic_gallery_next'); ?>"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
                <span class="photo-gallery__counter" id="intercity-photo-gallery-counter"></span>
            </div>
        </div>

        <script src="<?php echo asset_url('assets/js/home-intercity.js'); ?>"></script>

        <section class="testimonials-one section-space" id="testimonials">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('about_testimonials_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                    <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_testimonials_title1'); ?> <br> <?php te('home_testimonials_title2'); ?></h3>
                </div>
            </div>
            <div class="testimonials-one__inner">
                <div class="container">
                    <div class="testimonials-one__carousel cityride-owl__carousel cityride-owl__carousel--basic-nav cityride-owl__carousel--with-shadow owl-carousel owl-theme" data-owl-options='{
                    "items": 1,
                    "margin": 10,
                    "loop": true,
                    "smartSpeed": 700,
                    "nav": true,
                    "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
                    "dots": false,
                    "autoplay": true,
                    "responsive": {
                        "0": {
                            "items": 1,
                            "margin": 10
                        },
                        "576": {
                            "items": 1,
                            "margin": 30
                        },
                        "768": {
                            "items": 2,
                            "margin": 30
                        },
                        "992": {
                            "items": 2,
                            "margin": 30
                        },
                        "1200": {
                            "items": 3,
                            "margin": 30
                        },
                        "1400": {
                            "items": 4,
                            "margin": 30
                        },
                        "1600": {
                            "items": 4,
                            "margin": 30
                        }
                    }
                }'>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-1.jpg" alt="Jean Claude Habimana" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Jean Claude Habimana</h4>
                                        <p class="testimonial-card__designation">Kimihurura, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial1_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-2.jpg" alt="Aline Uwase" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Aline Uwase</h4>
                                        <p class="testimonial-card__designation">Nyarutarama, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial2_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-3.jpg" alt="Patrick Nshimiyimana" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Patrick Nshimiyimana</h4>
                                        <p class="testimonial-card__designation">Remera, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial3_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-4.jpg" alt="Chantal Mukamana" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Chantal Mukamana</h4>
                                        <p class="testimonial-card__designation">Kacyiru, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial4_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-5.jpg" alt="Eric Nkurunziza" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Eric Nkurunziza</h4>
                                        <p class="testimonial-card__designation">Gikondo, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial5_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-6.jpg" alt="Diane Ingabire" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Diane Ingabire</h4>
                                        <p class="testimonial-card__designation">Kicukiro, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial6_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-7.jpg" alt="Olivier Rwema" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Olivier Rwema</h4>
                                        <p class="testimonial-card__designation">Nyamirambo, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial7_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__top">
                                    <div class="testimonial-card__author">
                                        <img src="assets/images/clients/client-8.jpg" alt="Solange Umutoni" loading="eager" decoding="async" width="70" height="70">
                                        <div class="testimonial-card__icon">
                                            <i class="icon-quite-1"></i>
                                        </div>
                                    </div>
                                    <div class="testimonial-card__top__content">
                                        <h4 class="testimonial-card__name">Solange Umutoni</h4>
                                        <p class="testimonial-card__designation">Gisozi, Kigali</p>
                                    </div>
                                </div>
                                <p class="testimonial-card__text"><?php te('home_testimonial8_text'); ?></p>
                                <div class="testimonial-card__bottom">
                                    <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonials-one__shape-right">
                <div class="testimonials-one__shape-right__one"></div>
                <div class="testimonials-one__shape-right__two"></div>
            </div>
        </section>

        <section class="download-app-three section-space" id="download-app">
            <div class="download-app-three__bg" style="background-image: url(assets/images/shapes/download-app-bg-2-1.webp);"></div><!-- /.download-app-three__bg -->
            <div class="container">
                <div class="download-app-three__inner">
                    <div class="row gutter-y-40">
                        <div class="col-lg-6 col-md-8">
                            <div class="download-app-three__top">
                                <div class="sec-title ">
                                    <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                        <div class="sec-title__shape"></div><!-- /.sec-title__shape -->
                                        <h6 class="sec-title__tagline"><?php te('home_download_tagline'); ?></h6><!-- /.sec-title__tagline -->
                                    </div><!-- /.sec-title__top -->
                                    <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_download_title1'); ?> <br> <?php te('home_download_title2'); ?></h3><!-- /.sec-title__title -->
                                </div><!-- /.sec-title -->
                                <p class="download-app-three__top__text wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms"><?php te('home_download_text'); ?></p><!-- /.download-app-three__top__text -->
                                <ul class="sl-app-feats list-unstyled">
                                    <li><i class="fas fa-tags" aria-hidden="true"></i><?php te('home_app_feat1'); ?></li>
                                    <li><i class="fas fa-location-arrow" aria-hidden="true"></i><?php te('home_app_feat2'); ?></li>
                                    <li><i class="fas fa-mobile-alt" aria-hidden="true"></i><?php te('home_app_feat3'); ?></li>
                                </ul>
                                <div class="download-app-three__button wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                    <a href="https://www.apple.com/app-store/" class="download-app-three__btn store-badge" target="_blank" rel="noopener" aria-label="<?php te('home_app_store_aria'); ?>">
                                        <div class="download-app-three__btn__icon"><svg class="store-badge__mark" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill="#FFFFFF" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/></svg></div>
                                        <div class="download-app-three__btn__content">
                                            <span class="download-app-three__btn__title"><?php te('home_download_on_the'); ?></span>
                                            <span class="download-app-three__btn__text">App Store</span>
                                        </div>
                                    </a>
                                    <a href="https://play.google.com/" class="download-app-three__btn store-badge" target="_blank" rel="noopener" aria-label="<?php te('home_play_store_aria'); ?>">
                                        <div class="download-app-three__btn__icon"><svg class="store-badge__mark" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill="#00A0FF" d="M23.2 12.2C16.9 18.9 13.2 29.2 13.2 42.6v426.9c0 13.4 3.7 23.7 10.2 30.1l1.4 1.3 239.2-239.2v-5.6L24.6 10.8l-1.4 1.4z"/><path fill="#FFCE00" d="M343.1 335.7l-79.7-79.8v-5.7l79.8-79.8 1.8 1L439.6 225c27 15.3 27 40.5 0 55.9l-94.6 53.7-1.9 1.1z"/><path fill="#FF3A44" d="M345 334.6L263.4 253 23.2 493.2c8.9 9.4 23.6 10.6 40.2 1.2L345 334.6z"/><path fill="#00C853" d="M345 171.4L63.4 11.6C46.8 2.2 32.1 3.4 23.2 12.8L263.4 253 345 171.4z"/></svg></div>
                                        <div class="download-app-three__btn__content">
                                            <span class="download-app-three__btn__title"><?php te('home_get_it_on'); ?></span>
                                            <span class="download-app-three__btn__text">Google Play</span>
                                        </div>
                                    </a>
                                </div><!-- /.download-app-three__button -->
                            </div><!-- /.download-app-three__top -->
                        </div><!-- /.col-lg-4 -->
                    </div><!-- /.row gutter-y-40 -->
                    <div class="download-app-three__image wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="150ms">
                        <div class="download-app-three__image__inner">
                            <img src="assets/images/resources/download-app-1-1.png" alt="<?php te('home_app_city_alt'); ?>" loading="lazy" decoding="async" width="370" height="370">
                        </div><!-- /.download-app-three__image__inner -->
                        <div class="download-app-three__image__item">
                            <!-- Was a template phone mockup branded "CITYCAR"; a real SafeLine car is shown instead until genuine app screenshots exist. -->
                            <img src="assets/images/safeline-cruze-side.png" alt="<?php te('home_app_car_alt'); ?>" loading="lazy" decoding="async" width="1000" height="365">
                        </div><!-- /.download-app-three__image__item -->
                    </div><!-- /.download-app-one__image -->
                </div><!-- /.download-app-three__inner -->
            </div><!-- /.container -->
            <div class="download-app-three__element">
                <img src="assets/images/shapes/download-app-shape-1-1.png" alt loading="lazy" decoding="async" width="145" height="111">
            </div><!-- /.download-app-three__element -->
            <div class="download-app-three__element-one">
                <img src="assets/images/shapes/book-shape-1-1-rtl.png" alt loading="lazy" decoding="async" width="100" height="69">
            </div><!-- /.download-app-three__element -->
        </section><!-- /.download-app-three section-space -->

        <!-- CONTACT: four tap targets, no form -->
        <section class="sl-contact section-space" id="contact">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top"><h6 class="sec-title__tagline"><?php te('nav_contact'); ?></h6></div>
                    <h3 class="sec-title__title"><?php te('home_contact_title'); ?></h3>
                </div>
                <div class="sl-contact__grid">
                    <a class="sl-contact__item" href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>">
                        <span class="sl-contact__icon"><i class="fas fa-phone-alt" aria-hidden="true"></i></span>
                        <span class="sl-contact__label"><?php te('topbar_call_us'); ?></span>
                        <strong class="sl-contact__value"><?php echo $contact_phone; ?></strong>
                    </a>
                    <a class="sl-contact__item sl-contact__item--whatsapp" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $contact_phone); ?>" target="_blank" rel="noopener">
                        <span class="sl-contact__icon"><i class="fab fa-whatsapp" aria-hidden="true"></i></span>
                        <span class="sl-contact__label">WhatsApp</span>
                        <strong class="sl-contact__value"><?php te('home_contact_whatsapp'); ?></strong>
                    </a>
                    <a class="sl-contact__item" href="mailto:<?php echo $contact_email; ?>">
                        <span class="sl-contact__icon"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                        <span class="sl-contact__label"><?php te('home_contact_email'); ?></span>
                        <strong class="sl-contact__value"><?php echo $contact_email; ?></strong>
                    </a>
                    <a class="sl-contact__item" href="<?php echo $contact_maps_url; ?>" target="_blank" rel="noopener">
                        <span class="sl-contact__icon"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span>
                        <span class="sl-contact__label"><?php te('home_contact_find'); ?></span>
                        <strong class="sl-contact__value"><?php echo $contact_address; ?></strong>
                    </a>
                </div>
            </div>
        </section>

<?php include 'includes/footer.php'?>
