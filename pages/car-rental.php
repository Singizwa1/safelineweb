<?php
$current_page = 'car-rental';
include __DIR__ . '/../includes/config.php';
$page_title = t('car_rental_page_title');
$meta_description = t('car_rental_all_meta_description');
include __DIR__ . '/../includes/header.php';
?>

        <section class="car-rental-one section-space" id="car-rental" hidden>
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('car_rental_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                    <h3 class="sec-title__title"><?php te('car_rental_title'); ?></h3>
                </div>
                <p class="car-rental-one__lead"><?php te('car_rental_lead'); ?></p>
                <div class="row gutter-y-30" id="car-rental-list"></div>
            </div>
        </section>

        <div class="booking-modal" id="rental-modal" aria-hidden="true">
            <div class="booking-modal__backdrop" data-rental-close></div>
            <div class="booking-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="rental-modal-title">
                <div class="booking-modal__content">
                    <header class="booking-modal__header">
                        <div class="booking-modal__title-box">
                            <span class="booking-modal__logo">
                                <img src="images/safelinelogo/safelinelogo.png" alt="SafeLine" width="120" height="120">
                            </span>
                            <div>
                                <h2 class="booking-modal__title" id="rental-modal-title"></h2>
                                <p class="booking-modal__subtitle" id="rental-modal-title-step"></p>
                            </div>
                        </div>
                        <button class="booking-modal__close" type="button" aria-label="<?php te('home_intercity_close'); ?>" data-rental-close>&times;</button>
                    </header>
                    <div class="booking-modal__body">
                        <section class="booking-form-section">
                            <div class="container">
                                <div class="booking-form-container">
                                    <form id="rental-booking-form" novalidate>
                                        <div class="form-banner" id="rental-banner" role="status" aria-live="polite" hidden>
                                            <span class="form-banner__icon" aria-hidden="true"></span>
                                            <div class="form-banner__body">
                                                <strong class="form-banner__title"></strong>
                                                <p class="form-banner__text"></p>
                                            </div>
                                            <button type="button" class="form-banner__close" aria-label="<?php te('home_intercity_dismiss'); ?>">&times;</button>
                                        </div>
                                        <div class="fare-display-card" id="rental_fare_display" aria-live="polite">
                                            <div class="fare-info-row"><span class="fare-label"><?php te('car_rental_rate_label'); ?></span><span class="fare-value" id="rental_price_amount">0</span></div>
                                            <div class="fare-info-row"><span class="fare-label"><?php te('ic_total'); ?></span><span class="fare-value fare-total" id="rental_total_amount">0 RWF</span></div>
                                        </div>
                                        <div id="rental_step_details">
                                            <div class="form-row">
                                                <div class="form-group-enhanced">
                                                    <label for="rental_duration_unit"><?php te('car_rental_duration_unit_label'); ?></label>
                                                    <select class="form-control-enhanced" id="rental_duration_unit"></select>
                                                </div>
                                                <div class="form-group-enhanced">
                                                    <label for="rental_duration_count"><?php te('car_rental_duration_count_label'); ?></label>
                                                    <input class="form-control-enhanced" id="rental_duration_count" type="number" inputmode="numeric" min="1" value="1">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group-enhanced">
                                                    <label for="rental_pickup_datetime"><?php te('car_rental_pickup_datetime_label'); ?></label>
                                                    <input class="form-control-enhanced" id="rental_pickup_datetime" type="datetime-local" required>
                                                </div>
                                            </div>
                                            <div class="form-row" id="rental_pickup_location_row" hidden>
                                                <div class="form-group-enhanced">
                                                    <label for="rental_pickup_location"><?php te('car_rental_pickup_location_label'); ?></label>
                                                    <input class="form-control-enhanced" id="rental_pickup_location" type="text" maxlength="255" placeholder="<?php te('ic_private_pickup_placeholder'); ?>">
                                                    <p class="form-error-text" id="rental_pickup_location_error" hidden><?php te('car_rental_pickup_location_required'); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group-enhanced">
                                                    <label for="rental_guest_name"><?php te('home_intercity_your_name'); ?></label>
                                                    <input class="form-control-enhanced" id="rental_guest_name" type="text" autocomplete="name" placeholder="<?php te('home_intercity_name_placeholder'); ?>" required>
                                                </div>
                                                <div class="form-group-enhanced">
                                                    <label for="rental_phone_number"><?php te('contact_field_phone'); ?></label>
                                                    <div class="phone-input-group">
                                                        <span class="phone-input-group__prefix">+250</span>
                                                        <input class="form-control-enhanced phone-input-group__field" id="rental_phone_number" type="tel" inputmode="numeric" autocomplete="tel-national" maxlength="9" placeholder="788123456" required>
                                                    </div>
                                                    <p class="form-error-text" id="rental_phone_error" hidden><?php te('home_intercity_phone_error'); ?></p>
                                                </div>
                                            </div>
                                            <button class="submit-btn-enhanced" type="button" id="rental_continue_btn"><?php te('ic_btn_continue'); ?></button>
                                            <p class="booking-assurance"><?php te('home_intercity_assurance'); ?></p>
                                        </div>
                                        <div id="rental_step_payment" hidden>
                                            <p class="payment-step-intro"><?php te('ic_payment_step_intro'); ?></p>
                                            <div class="form-row">
                                                <div class="form-group-enhanced">
                                                    <label for="rental_payment_phone_number"><?php te('ic_payment_phone_label'); ?></label>
                                                    <div class="network-toggle" id="rental_payment_phone_network">
                                                        <button type="button" class="network-toggle__pill is-active" data-network="mtn"><i class="fas fa-credit-card" aria-hidden="true"></i><?php te('ic_network_mtn'); ?></button>
                                                        <button type="button" class="network-toggle__pill" data-network="airtel"><i class="fas fa-credit-card" aria-hidden="true"></i><?php te('ic_network_airtel'); ?></button>
                                                    </div>
                                                    <div class="phone-input-group">
                                                        <span class="phone-input-group__prefix">+250</span>
                                                        <input class="form-control-enhanced phone-input-group__field" id="rental_payment_phone_number" type="tel" inputmode="numeric" autocomplete="tel-national" maxlength="9" placeholder="788123456" required>
                                                    </div>
                                                    <p class="form-help-text"><?php te('ic_payment_phone_help'); ?></p>
                                                    <p class="form-error-text" id="rental_payment_phone_error" hidden><?php te('home_intercity_phone_error'); ?></p>
                                                </div>
                                            </div>
                                            <button class="submit-btn-enhanced" type="submit" id="rental_pay_btn"><?php te('home_intercity_submit'); ?></button>
                                            <button class="booking-back-btn" type="button" id="rental_back_btn"><?php te('ic_btn_back'); ?></button>
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

        <script>
            // This page always renders the full catalogue - no first-3
            // teaser, no "View More" button (home-car-rental.js).
            window.SL_SHOW_ALL_RENTALS = true;
        </script>
        <script src="<?php echo asset_url('assets/js/home-car-rental.js'); ?>"></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
