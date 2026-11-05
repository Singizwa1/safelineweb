<?php
$current_page = 'intercity-trips';
include __DIR__ . '/../includes/config.php';
$page_title = t('ic_all_trips_page_title');
$meta_description = t('ic_all_trips_meta_description');
include __DIR__ . '/../includes/header.php';
?>

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
                <div class="photo-gallery__card">
                    <button class="photo-gallery__close" type="button" aria-label="<?php te('ic_gallery_close'); ?>" data-gallery-close>&times;</button>
                    <button class="photo-gallery__arrow photo-gallery__arrow--prev" type="button" data-gallery-step="-1" aria-label="<?php te('ic_gallery_prev'); ?>"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
                    <img class="photo-gallery__image" id="intercity-photo-gallery-img" src="" alt="">
                    <button class="photo-gallery__arrow photo-gallery__arrow--next" type="button" data-gallery-step="1" aria-label="<?php te('ic_gallery_next'); ?>"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
                </div>
                <div class="photo-gallery__footer">
                    <div class="photo-gallery__dots" id="intercity-photo-gallery-dots"></div>
                </div>
            </div>
        </div>

        <script>
            // This page always renders the full published list - no
            // first-3 teaser, no "View More" button (home-intercity.js).
            window.SL_SHOW_ALL_TRIPS = true;
        </script>
        <script src="<?php echo asset_url('assets/js/home-intercity.js'); ?>"></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
