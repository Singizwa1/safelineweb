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
.intercity-trip-card__footer { margin-top: auto; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding-top: 10px; }
.intercity-trip-card__price { font-weight: 800; color: #001832; }
.intercity-trip-card__price small { font-weight: 500; color: var(--color-text-secondary, #5A6577); }

.phone-input-group { display: flex; align-items: stretch; }
.phone-input-group__prefix { display: flex; align-items: center; padding: 0 14px; border: 1px solid rgba(0, 24, 50, 0.12); border-right: none; border-radius: 12px 0 0 12px; background: rgba(0, 24, 50, 0.04); color: #001832; font-weight: 600; font-size: 15px; }
.phone-input-group__field { border-radius: 0 12px 12px 0 !important; }
.form-error-text { color: #C62828; font-size: 12.5px; margin: 6px 0 0; }
</style>

    <section class="main-slider-one" id="home">
            <!-- Outer carousel: holds ONE static shell item by default (bg,
                 car, buttons - identical across the 3 copy variants below,
                 so there is nothing to slide at this level). home-intercity.js
                 swaps this whole carousel's contents for a dedicated
                 Intercity promo slide via its Owl API when a trip is
                 published - that full-slide takeover is unaffected by the
                 text rotator nested inside the static item below. -->
            <div class="main-slider-one__carousel cityride-owl__carousel cityride-owl__carousel--basic-nav owl-carousel" data-owl-options='{
            "loop": true,
            "items": 1,
            "autoplay": true,
            "smartSpeed": 1000,
            "nav": false,
            "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
            "dots": true,
            "margin": 0
	    }'>
                <div class="item">
                    <div class="main-slider-one__item">
                        <div class="main-slider-one__bg" style="background-image: url(assets/images/backgrounds/main-slider-bg-1-1.jpg);"></div>
                        <div class="container">
                            <div class="row gutter-y-50">
                                <div class="main-slider-one__col-content">
                                    <div class="main-slider-one__content">
                                        <!-- Inner carousel: only this text rotates. No dots/nav - it is
                                             a passive rotator, not something a visitor steers. -->
                                        <div class="hero-text-carousel cityride-owl__carousel owl-carousel" data-owl-options='{
                                        "loop": true,
                                        "items": 1,
                                        "autoplay": true,
                                        "autoplayTimeout": 4500,
                                        "smartSpeed": 700,
                                        "nav": false,
                                        "dots": false,
                                        "margin": 0
                                        }'>
                                            <div class="item">
                                                <div class="main-slider-one__top">
                                                    <p class="main-slider-one__sub-title"><span class="main-slider-one__sub-title__icon"><i class="fas fa-shield-alt" aria-hidden="true"></i></span><span class="main-slider-one__sub-title__text"><?php te('home_hero1_kicker'); ?></span></p>
                                                </div>
                                                <h2 class="main-slider-one__title"><?php te('home_hero1_title'); ?></h2>
                                                <p class="main-slider-one__text"><?php te('home_hero1_text'); ?></p>
                                            </div>
                                            <div class="item">
                                                <div class="main-slider-one__top">
                                                    <p class="main-slider-one__sub-title"><span class="main-slider-one__sub-title__icon"><i class="fas fa-tag" aria-hidden="true"></i></span><span class="main-slider-one__sub-title__text"><?php te('home_hero2_kicker'); ?></span></p>
                                                </div>
                                                <h2 class="main-slider-one__title"><?php te('home_hero2_title'); ?></h2>
                                                <p class="main-slider-one__text"><?php te('home_hero2_text'); ?></p>
                                            </div>
                                            <div class="item">
                                                <div class="main-slider-one__top">
                                                    <p class="main-slider-one__sub-title"><span class="main-slider-one__sub-title__icon"><i class="fas fa-headset" aria-hidden="true"></i></span><span class="main-slider-one__sub-title__text"><?php te('home_hero3_kicker'); ?></span></p>
                                                </div>
                                                <h2 class="main-slider-one__title"><?php te('home_hero3_title'); ?></h2>
                                                <p class="main-slider-one__text"><?php te('home_hero3_text'); ?></p>
                                            </div>
                                        </div>
                                        <div class="main-slider-one__button">
                                            <a href="#download-app" class="js-ride-cta main-slider-one__btn cityride-btn cityride-btn--primary"><span><?php te('primary_cta_text'); ?></span></a>
                                            <a href="/taxi" class="main-slider-one__btn cityride-btn cityride-btn--border"><span><?php te('home_explore_fleet'); ?></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-slider-one__col-aside">
                                    <div class="hero-lane" aria-hidden="true">
                                        <img class="hero-lane__car" src="assets/images/safeline-rav4-side.png" alt="" decoding="async">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-slider-one__pattern" style="background-image: url(assets/images/shapes/main-slider-pattern-1-1.png);"></div>
                        <div class="main-slider-one__shape">
                            <div class="main-slider-one__shape__one"></div>
                            <div class="main-slider-one__shape__two"></div>
                        </div>
                        <div class="main-slider-one__shape-two">
                            <div class="main-slider-one__shape-two__one"></div>
                        </div>
                        <div class="main-slider-one__shape-line">
                            <div class="main-slider-one__shape-line__one"></div>
                            <div class="main-slider-one__shape-line__two"></div>
                        </div>
                    </div>
                </div>
            </div><!-- /.main-slider-one__carousel -->

            <!-- Background traffic: one car. Decorative only, so
                 aria-hidden and empty alt. Sits above the slides
                 (z-index 4) but is pointer-events:none. -->
            <div class="sl-road" aria-hidden="true">
                <span class="sl-road__surface"></span>
                <span class="sl-road__dashes"></span>
                <img class="sl-car" src="assets/images/safeline-cruze-side-r.png" alt="" decoding="async">
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
                        <div class="stats-bar__number">24/7</div>
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

        <!-- Booking CTA Feature Showcase Section -->
        <section class="booking-cta-section" id="booking-cta">
            <div class="container">
                <div class="booking-cta-card">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="booking-cta-card__content">
                                <div class="booking-cta-card__badge">
                                    <i class="fas fa-shield-alt"></i> <?php te('home_cta_badge'); ?>
                                </div>
                                <h2 class="booking-cta-card__title"><?php te('home_cta_title'); ?> <br><span><?php te('home_cta_subtitle'); ?></span></h2>
                                <p class="booking-cta-card__text"><?php te('home_cta_text'); ?></p>
                                <div class="booking-cta-card__features">
                                    <div class="cta-feature-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?php te('home_cta_feature1'); ?></span>
                                    </div>
                                    <div class="cta-feature-item">
                                        <i class="fas fa-tags"></i>
                                        <span><?php te('home_cta_feature2'); ?></span>
                                    </div>
                                    <div class="cta-feature-item">
                                        <i class="fas fa-user-shield"></i>
                                        <span><?php te('home_cta_feature3'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 text-lg-end text-center mt-4 mt-lg-0">
                            <div class="booking-cta-card__actions">
                                <img class="booking-cta-card__car" aria-hidden="true" alt=""
                                     src="assets/images/safeline-cruze-side-r.png"
                                     loading="lazy" decoding="async" width="1000" height="365">
                                <a href="#download-app" class="js-ride-cta cityride-btn cityride-btn--primary booking-cta-btn">
                                    <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                    <span><?php te('primary_cta_text'); ?></span>
                                </a>
                                <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>" class="booking-cta-call-link">
                                    <i class="fas fa-phone-alt"></i> <?php te('home_call_prefix', ['phone' => $contact_phone]); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="services-one section-space" id="services">
            <div class="services-one__bg" style="background-image: url(assets/images/shapes/services-bg-1-1.webp);"></div>
            <!-- /.services-one__bg -->
            <div class="container">
                <div class="cityride-info">
                    <div class="cityride-info__inner">
                        <div class="row align-items-center gutter-y-30">
                            <div class="col-lg-7">
                                <div class="cityride-info__head">
                                    <p class="cityride-info__eyebrow"><?php te('home_simple_eyebrow'); ?></p>
                                    <h3 class="cityride-info__heading"><?php te('home_simple_title'); ?></h3>
                                    <p class="cityride-info__lead">
                                        <?php te('home_simple_text'); ?>
                                    </p>
                                </div>

                                <div class="cityride-info__feature-grid row gutter-y-20">
                                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                                        <div class="cityride-info__item">
                                            <div class="cityride-info__item__icon">
                                                <i class="icon-booking"></i>
                                            </div>
                                            <div class="cityride-info__item__body">
                                                <h4 class="cityride-info__item__title"><?php te('home_item1_title'); ?></h4>
                                                <p class="cityride-info__item__text"><?php te('home_item1_text'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                                        <div class="cityride-info__item">
                                            <div class="cityride-info__item__icon">
                                                <i class="icon-map"></i>
                                            </div>
                                            <div class="cityride-info__item__body">
                                                <h4 class="cityride-info__item__title"><?php te('home_item2_title'); ?></h4>
                                                <p class="cityride-info__item__text"><?php te('home_item2_text'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                                        <div class="cityride-info__item">
                                            <div class="cityride-info__item__icon">
                                                <i class="icon-costumer"></i>
                                            </div>
                                            <div class="cityride-info__item__body">
                                                <h4 class="cityride-info__item__title"><?php te('home_item3_title'); ?></h4>
                                                <p class="cityride-info__item__text"><?php te('home_item3_text'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.cityride-info__feature-grid -->

                                <div class="cityride-info__cta">
                                    <a href="#download-app" class="js-ride-cta cityride-btn cityride-btn--primary">
                                        <span><?php te('primary_cta_text'); ?></span>
                                    </a>
                                    <a class="cityride-info__cta__call" href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>">
                                        <i class="fas fa-phone-alt" aria-hidden="true"></i>
                                        <span><?php te('home_or_call', ['phone' => $contact_phone]); ?></span>
                                    </a>
                                </div>
                            </div><!-- /.col-lg-7 -->

                            <div class="col-lg-5">
                                <div class="cityride-info__image-wrap wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="300ms">
                                    <img src="assets/images/safeline-car-04.jpeg" alt="A SafeLine taxi on the road in Kigali" class="cityride-info__image-new" loading="lazy" decoding="async" width="720" height="540">
                                    <p class="cityride-info__image-caption">
                                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                                        <?php te('home_image_caption'); ?>
                                    </p>
                                </div>
                            </div><!-- /.col-lg-5 -->
                        </div><!-- /.row -->
                    </div><!-- /.cityride-info__inner -->
                </div><!-- /.cityride-info -->
            </div><!-- /.container -->
            <div class="container">
                <div class="services-one__top">
                    <div class="row gutter-y-50 align-items-center">
                        <div class="col-md-8">
                            <div class="sec-title ">
                                <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                    <div class="sec-title__shape"></div><!-- /.sec-title__shape -->
                                    <h6 class="sec-title__tagline"><?php te('home_services_tagline'); ?></h6><!-- /.sec-title__tagline -->
                                </div><!-- /.sec-title__top -->
                                <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_services_title_line1'); ?> <br><?php te('home_services_title_line2'); ?></h3><!-- /.sec-title__title -->
                            </div><!-- /.sec-title -->
                        </div><!-- /.col-md-8 -->
                        <div class="col-md-4">
                            <div class="services-one__custome-navs"></div><!-- /.services-one__custom-navs -->
                        </div><!-- /.col-md-4 -->
                    </div><!-- /.row gutter-y-40 -->
                </div><!-- /.services-one__top -->
                <div class="services-one__carousel cityride-owl__carousel cityride-owl__carousel--basic-nav owl-carousel owl-theme" data-owl-options='{
            "items": 1,
            "margin": 10,
            "loop": true,
            "smartSpeed": 700,
            "navContainer": ".services-one__custome-navs",
            "nav": true,
            "dots": false,
            "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
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
                }
            }
        }'>
                    <div class="item">
                        <div class="service-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='200ms'>
                            <div class="service-card__image">
                                <img src="assets/images/fleet-07-branded.jpg" alt="cityride image" loading="lazy" decoding="async" width="720" height="540">
                            </div><!-- /.service-card__image -->
                            <div class="service-card__middle">
                                <div class="service-card__icon">
                                    <div class="service-card__icon__inner"><i class="icon-car-1"></i></div><!-- /.service-card__icon__inner -->
                                    <h3 class="service-card__title"><a href="/#download-app" class="js-ride-cta"><?php te('home_service1'); ?></a></h3>
                                </div><!-- /.service-card__icon -->
                                <div class="service-card__middle__element"><img src="assets/images/shapes/service-element.png" alt loading="lazy" decoding="async" width="24" height="44"></div><!-- /.service-card__middle__element -->
                            </div><!-- /.service-card__content -->
                            <div class="service-card__btn">
                                <a href="/#download-app" class="js-ride-cta service-card__link"><?php te('home_explore_more'); ?> <i class="fas fa-arrow-right"></i></a><!-- /.service-card__link -->
                            </div><!-- /.service-card__btn -->
                        </div><!-- /.service-card -->
                    </div><!-- /.item -->
                    <div class="item">
                        <div class="service-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            <div class="service-card__image">
                                <img src="assets/images/safeline-fleet-side-branded.jpg" alt="A SafeLine driver waiting beside the car on a corporate transfer" loading="lazy" decoding="async" width="720" height="540">
                            </div><!-- /.service-card__image -->
                            <div class="service-card__middle">
                                <div class="service-card__icon">
                                    <div class="service-card__icon__inner"><i class="icon-car-2"></i></div><!-- /.service-card__icon__inner -->
                                    <h3 class="service-card__title"><a href="/#download-app" class="js-ride-cta"><?php te('home_service2'); ?></a></h3>
                                </div><!-- /.service-card__icon -->
                                <div class="service-card__middle__element"><img src="assets/images/shapes/service-element.png" alt loading="lazy" decoding="async" width="24" height="44"></div><!-- /.service-card__middle__element -->
                            </div><!-- /.service-card__content -->
                            <div class="service-card__btn">
                                <a href="/#download-app" class="js-ride-cta service-card__link"><?php te('home_explore_more'); ?> <i class="fas fa-arrow-right"></i></a><!-- /.service-card__link -->
                            </div><!-- /.service-card__btn -->
                        </div><!-- /.service-card -->
                    </div><!-- /.item -->
                    <div class="item">
                        <div class="service-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                            <div class="service-card__image">
                                <img src="assets/images/safeline-car-03.jpeg" alt="A SafeLine taxi waiting at Kigali International Airport" loading="lazy" decoding="async" width="1600" height="1200">
                            </div><!-- /.service-card__image -->
                            <div class="service-card__middle">
                                <div class="service-card__icon">
                                    <div class="service-card__icon__inner"><i class="icon-car-3"></i></div><!-- /.service-card__icon__inner -->
                                    <h3 class="service-card__title"><a href="/#download-app" class="js-ride-cta"><?php te('home_service3'); ?></a></h3>
                                </div><!-- /.service-card__icon -->
                                <div class="service-card__middle__element"><img src="assets/images/shapes/service-element.png" alt loading="lazy" decoding="async" width="24" height="44"></div><!-- /.service-card__middle__element -->
                            </div><!-- /.service-card__content -->
                            <div class="service-card__btn">
                                <a href="/#download-app" class="js-ride-cta service-card__link"><?php te('home_explore_more'); ?> <i class="fas fa-arrow-right"></i></a><!-- /.service-card__link -->
                            </div><!-- /.service-card__btn -->
                        </div><!-- /.service-card -->
                    </div><!-- /.item -->
                </div><!-- /.services-one__carousel -->
            </div><!-- /.container -->
            <div class="services-one__inner-bg"></div><!-- /.services-one__inner-bg -->
        </section><!-- /.services-one section-space -->

        <section class="why-choose-one section-space-bottom">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                        <div class="sec-title__shape"></div><!-- /.sec-title__shape -->
                        <h6 class="sec-title__tagline"><?php te('home_why_tagline'); ?></h6><!-- /.sec-title__tagline -->
                        <div class="sec-title__shape"></div><!-- /.sec-title__shape -->
                    </div><!-- /.sec-title__top -->
                    <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_why_title_line1'); ?> <br><?php te('home_why_title_line2'); ?></h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <div class="tabs-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                    <div class="tab-buttons">
                        <button data-tab="#itemOne" class="tab-btn active-btn"><span></span> <?php te('home_tab1'); ?> </button>
                        <button data-tab="#itemTwo" class="tab-btn"><span></span> <?php te('home_tab2'); ?> </button>
                        <button data-tab="#itemThree" class="tab-btn"><span></span> <?php te('home_tab3'); ?> </button>
                        <button data-tab="#itemFour" class="tab-btn"><span></span> <?php te('home_tab4'); ?> </button>
                    </div><!-- /.tab-box-buttons -->
                    <div class="tabs-content">
                        <div class="why-choose-one__item tab active-tab fadeInUp" data-wow-delay="200ms" id="itemOne">
                            <div class="why-choose-one__item__bg" style="background-image: url(assets/images/shapes/contact-bg-1-1.png);"></div><!-- /.why-choose-one__item__bg -->
                            <div class="row gutter-y-40 align-items-center">
                                <div class="col-lg-7">
                                    <div class="why-choose-one__left">
                                        <h2 class="why-choose-one__title"><?php te('home_tab1_title'); ?></h2>
                                        <p class="why-choose-one__text"><?php te('home_tab1_text'); ?></p><!-- /.why-choose-one__text -->
                                        <ul class="why-choose-one__list">
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab1_item1'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab1_item2'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab1_item3'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab1_item4'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab1_item5'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab1_item6'); ?></li>
                                        </ul>
                                        <div class="why-choose-one__btn-box">
                                            <a href="#download-app" class="js-ride-cta why-choose-one__btn cityride-btn cityride-btn--secondary">
                                                <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                                <span><?php te('home_get_started'); ?></span>
                                            </a><!-- /.why-choose-one__btn -->
                                            <div class="why-choose-one__btn__border"></div><!-- /.why-choose-one__btn__border -->
                                        </div><!-- /.why-choose-one__btn-box -->
                                    </div><!-- /.why-choose-one__left -->
                                </div><!-- /.col-lg-7 -->
                                <div class="col-lg-5">
                                    <div class="why-choose-one__thumb">
                                        <img src="assets/images/safeline-car-06.jpeg" alt="A SafeLine vehicle being checked before a trip" loading="lazy" decoding="async" width="720" height="540">
                                    </div><!-- /.why-choose-one__thumb -->
                                </div><!-- /.col-lg-5 -->
                            </div><!-- /.row gutter-y-40 -->
                        </div><!-- /.item -->
                        <div class="why-choose-one__item tab fadeInUp" data-wow-delay="200ms" id="itemTwo">
                            <div class="why-choose-one__item__bg" style="background-image: url(assets/images/shapes/contact-bg-1-1.png);"></div><!-- /.why-choose-one__item__bg -->
                            <div class="row gutter-y-40 align-items-center">
                                <div class="col-lg-7">
                                    <div class="why-choose-one__left">
                                        <h2 class="why-choose-one__title"><?php te('home_tab2_title'); ?></h2>
                                        <p class="why-choose-one__text"><?php te('home_tab2_text'); ?></p><!-- /.why-choose-one__text -->
                                        <ul class="why-choose-one__list">
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab2_item1'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab2_item2'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab2_item3'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab2_item4'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab2_item5'); ?></li>
                                            <li class="why-choose-one__list__item"> <i class="icon-check-mark"></i><?php te('home_tab2_item6'); ?></li>
                                        </ul>
                                        <div class="why-choose-one__btn-box">
                                            <a href="#download-app" class="js-ride-cta why-choose-one__btn cityride-btn cityride-btn--secondary">
                                                <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                                <span><?php te('home_get_started'); ?></span>
                                            </a><!-- /.why-choose-one__btn -->
                                            <div class="why-choose-one__btn__border"></div><!-- /.why-choose-one__btn__border -->
                                        </div><!-- /.why-choose-one__btn-box -->
                                    </div><!-- /.why-choose-one__left -->
                                </div><!-- /.col-lg-7 -->
                                <div class="col-lg-5">
                                    <div class="why-choose-one__thumb">
                                        <img src="assets/images/safeline-car-05.jpeg" alt="SafeLine cars lined up in the fleet yard" loading="lazy" decoding="async" width="720" height="540">
                                    </div><!-- /.why-choose-one__thumb -->
                                </div><!-- /.col-lg-5 -->
                            </div><!-- /.row gutter-y-40 -->
                        </div><!-- /.item -->
                        <div class="why-choose-one__item tab fadeInUp" data-wow-delay="200ms" id="itemThree">
                            <div class="why-choose-one__item__bg" style="background-image: url(assets/images/shapes/contact-bg-1-1.png);"></div><!-- /.why-choose-one__item__bg -->
                            <div class="row gutter-y-40 align-items-center">
                                <div class="col-lg-7">
                                    <div class="why-choose-one__left">
                                        <h2 class="why-choose-one__title"><?php te('home_tab3_title'); ?></h2>
                                        <p class="why-choose-one__text"><?php te('home_tab3_text'); ?></p><!-- /.why-choose-one__text -->
                                        <ul class="why-choose-one__list">
                                        <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab3_item1'); ?></li>
                                        <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab3_item2'); ?></li>
                                        <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab3_item3'); ?></li>
                                        <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab3_item4'); ?></li>
                                        <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab3_item5'); ?></li>
                                        <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab3_item6'); ?></li>
                                    </ul>
                                        <div class="why-choose-one__btn-box">
                                            <a href="#download-app" class="js-ride-cta why-choose-one__btn cityride-btn cityride-btn--secondary">
                                                <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                                <span><?php te('home_get_started'); ?></span>
                                            </a><!-- /.why-choose-one__btn -->
                                            <div class="why-choose-one__btn__border"></div><!-- /.why-choose-one__btn__border -->
                                        </div><!-- /.why-choose-one__btn-box -->
                                    </div><!-- /.why-choose-one__left -->
                                </div><!-- /.col-lg-7 -->
                                <div class="col-lg-5">
                                    <div class="why-choose-one__thumb">
                                        <img src="assets/images/fleet-07-branded.jpg" alt="A SafeLine taxi on a Kigali city street" loading="lazy" decoding="async" width="720" height="540">
                                    </div><!-- /.why-choose-one__thumb -->
                                </div><!-- /.col-lg-5 -->
                            </div><!-- /.row gutter-y-40 -->
                        </div><!-- /.item -->
                        <div class="why-choose-one__item tab fadeInUp" data-wow-delay="200ms" id="itemFour">
                            <div class="why-choose-one__item__bg" style="background-image: url(assets/images/shapes/contact-bg-1-1.png);"></div><!-- /.why-choose-one__item__bg -->
                            <div class="row gutter-y-40 align-items-center">
                                <div class="col-lg-7">
                                    <div class="why-choose-one__left">
                                        <h2 class="why-choose-one__title"><?php te('home_tab4_title'); ?></h2>
                                        <p class="why-choose-one__text"><?php te('home_tab4_text'); ?></p><!-- /.why-choose-one__text -->
                                        <ul class="why-choose-one__list">
                                            <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab4_item1'); ?></li>
                                            <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab4_item2'); ?></li>
                                            <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab4_item3'); ?></li>
                                            <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab4_item4'); ?></li>
                                            <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab4_item5'); ?></li>
                                            <li class="why-choose-one__list__item"><i class="icon-check-mark"></i><?php te('home_tab4_item6'); ?></li>
                                        </ul>
                                        <div class="why-choose-one__btn-box">
                                            <a href="#download-app" class="js-ride-cta why-choose-one__btn cityride-btn cityride-btn--secondary">
                                                <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                                <span><?php te('home_get_started'); ?></span>
                                            </a>
                                            <!-- /.why-choose-one__btn -->
                                            <div class="why-choose-one__btn__border"></div>
                                            <!-- /.why-choose-one__btn__border -->
                                        </div><!-- /.why-choose-one__btn-box -->
                                    </div><!-- /.why-choose-one__left -->
                                </div><!-- /.col-lg-7 -->
                                <div class="col-lg-5">
                                    <div class="why-choose-one__thumb">
                                        <img src="assets/images/safeline-car-03.jpeg" alt="A SafeLine taxi waiting at Kigali International Airport" loading="lazy" decoding="async" width="1600" height="1200">
                                    </div><!-- /.why-choose-one__thumb -->
                                </div><!-- /.col-lg-5 -->
                            </div><!-- /.row gutter-y-40 -->
                        </div><!-- /.item -->
                    </div><!-- /.tabs-content -->
                </div><!-- /.tab-box -->

            </div><!-- /.container -->
            <div class="why-choose-one__shape-left">
                <div class="why-choose-one__shape-left__one"></div><!-- /.why-choose-one__shape-left__one -->
                <div class="why-choose-one__shape-left__two"></div><!-- /.why-choose-one__shape-left__two -->
            </div><!-- /.why-choose-one__shape-left -->
            <div class="why-choose-one__shape-right">
                <div class="why-choose-one__shape-right__one"></div><!-- /.why-choose-one__shape-right__one -->
                <div class="why-choose-one__shape-right__two"></div><!-- /.why-choose-one__shape-right__two -->
            </div><!-- /.why-choose-one__shape-right -->
        </section>
        <!-- /.why-choose-one section-space-bottom -->

        <div class="about-four about-four--one section-space" id="about">
            <div class="about-four__bg" style="background-image: url(assets/images/shapes/about-bg.webp);"></div><!-- /.about-four__bg -->
            <div class="container">
                <div class="row gutter-y-40 align-items-center">
                    <div class="col-lg-6">
                        <div class="about-four__image wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="150ms">
                            <div class="about-four__image__item"> <img src="assets/images/safeline-car-03.jpeg" alt="A SafeLine taxi waiting at Kigali International Airport" loading="lazy" decoding="async" width="1600" height="929"> </div><!-- /.about-four__image__item -->
                            <div class="about-four__image__small">
                                <!--<img src="assets/images/about/about-s-1-1.jpg" alt="" loading="lazy" decoding="async" width="262" height="221">-->
                                <!-- The template's play button was wired to magnificPopup with
                                     href="#", so clicking it opened an empty lightbox. Removed
                                     until there is a real video to point it at. -->
                            </div><!-- /.about-four__image__small -->
                            <div class="about-four__funfact">
                                <div class="about-four__funfact__icon">
                                    <i class="icon-hand-wall"></i>
                                </div><!-- /.about-four__funfact__icon -->
                                <div class="about-four__funfact__content">
                                    <h4 class="about-four__funfact__number count-box">
                                        <span class="count-text" data-stop="6561" data-speed="1500">6,561</span>
                                        <span>+</span>
                                    </h4>
                                    <p class="about-four__funfact__text"><?php te('home_funfact_label'); ?></p><!-- /.about-four__funfact__title -->
                                </div><!-- /.about-four__funfact__content -->
                            </div><!-- /.about-four__funfact -->
                        </div><!-- /.about-four__image -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="about-four__right">
                            <div class="sec-title ">
                                <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                    <div class="sec-title__shape"></div><!-- /.sec-title__shape -->
                                    <h6 class="sec-title__tagline"><?php te('home_about_tagline'); ?></h6><!-- /.sec-title__tagline -->
                                </div><!-- /.sec-title__top -->
                                <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_about_title'); ?></h3>
                            </div><!-- /.sec-title -->
                            <p class="about-four__top__text wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                <?php te('home_about_text'); ?>
                            </p>

                            <ul class="about-four__points list-unstyled wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                                <li>
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <span><strong><?php te('home_about_point1_title'); ?></strong> <?php te('home_about_point1_text'); ?></span>
                                </li>
                                <li>
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <span><strong><?php te('home_about_point2_title'); ?></strong> <?php te('home_about_point2_text'); ?></span>
                                </li>
                                <li>
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <span><strong><?php te('home_about_point3_title'); ?></strong> <?php te('home_about_point3_text'); ?></span>
                                </li>
                            </ul>
                            <div class="about-four__bottom wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                <div class="emargency-call">
                                    <div class="emargency-call__image">
                                        <img src="assets/images/vanessa.jpg" style="height:80px" alt="Person" loading="lazy" decoding="async" width="864" height="864">
                                        <div class="emargency-call__icon">
                                            <i class="icon-telephone-call"></i>
                                        </div>
                                    </div>
                                    <div class="emargency-call__content">
                                        <h4 class="emargency-call__title"><?php te('about_emergency_call_us'); ?></h4>
                                        <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>" class="emargency-call__number">+250 788 471 117</a>
                                        <!--<a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>" class="emargency-call__number">+250 788 471 117</a>-->
                                    </div>
                                </div><!-- /.emargency-call -->
                                <div class="about-four__btn-box">
                                    <a href="/about" class="about-four__btn cityride-btn cityride-btn--secondary">
                                        <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                        <span><?php te('home_about_more'); ?></span>
                                    </a><!-- /.about-four__btn -->
                                    <div class="about-four__btn__border"></div><!-- /.about-four__btn__border -->
                                </div><!-- /.about-four__btn__box -->
                            </div><!-- /.about-four__author -->
                        </div><!-- /.about-four__right -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="about-four__element">
                <img src="assets/images/shapes/download-app-shape-2-1.png" alt loading="lazy" decoding="async" width="145" height="111">
            </div><!-- /.about-four__element -->
        </div><!-- /.about-four -->

        <div class="pattern-bg" style="background-image: url(assets/images/shapes/pattern.png);"></div><!-- /.pattern-bg -->

        <!-- FLEET SHOWCASE -->
        <section class="fleet-strip section-space" id="fleet">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('home_fleet_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                    <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_fleet_title'); ?></h3>
                </div>

                <div class="fleet-strip__grid">
                    <article class="fleet-card wow fadeInUp" data-wow-delay="100ms">
                        <div class="fleet-card__media">
                            <img src="assets/images/fleet-07-branded.jpg" alt="A liveried SafeLine Cruze, rear three-quarter view" loading="lazy" decoding="async">
                        </div>
                        <div class="fleet-card__body">
                            <span class="fleet-card__badge"><?php te('home_fleet1_badge'); ?></span>
                            <h4 class="fleet-card__title">Voiture Économique</h4>
                            <p class="fleet-card__text"><?php te('home_fleet1_text'); ?></p>
                            <ul class="fleet-card__specs">
                                <li><i class="fas fa-shield-alt" aria-hidden="true"></i> <?php te('home_fleet_spec_driver'); ?></li>
                                <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?php te('home_fleet_spec_gps'); ?></li>
                            </ul>
                        </div>
                    </article>

                    <article class="fleet-card wow fadeInUp" data-wow-delay="200ms">
                        <div class="fleet-card__media">
                            <img src="assets/images/safeline-fleet-side-branded.jpg" alt="The SafeLine decal on a fleet Cruze" loading="lazy" decoding="async">
                        </div>
                        <div class="fleet-card__body">
                            <span class="fleet-card__badge"><?php te('home_fleet2_badge'); ?></span>
                            <h4 class="fleet-card__title">Course Standard</h4>
                            <p class="fleet-card__text"><?php te('home_fleet2_text'); ?></p>
                            <ul class="fleet-card__specs">
                                <li><i class="fas fa-shield-alt" aria-hidden="true"></i> <?php te('home_fleet_spec_driver'); ?></li>
                                <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?php te('home_fleet_spec_gps'); ?></li>
                            </ul>
                        </div>
                    </article>

                    <article class="fleet-card wow fadeInUp" data-wow-delay="300ms">
                        <div class="fleet-card__media">
                            <img src="assets/images/safeline-car-04.jpeg" alt="A SafeLine Cruze ready in the fleet bay" loading="lazy" decoding="async">
                        </div>
                        <div class="fleet-card__body">
                            <span class="fleet-card__badge"><?php te('home_fleet3_badge'); ?></span>
                            <h4 class="fleet-card__title">Course Premium</h4>
                            <p class="fleet-card__text"><?php te('home_fleet3_text'); ?></p>
                            <ul class="fleet-card__specs">
                                <li><i class="fas fa-shield-alt" aria-hidden="true"></i> <?php te('home_fleet_spec_driver'); ?></li>
                                <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?php te('home_fleet_spec_gps'); ?></li>
                            </ul>
                        </div>
                    </article>
                </div>

                <div class="fleet-strip__foot wow fadeInUp" data-wow-delay="200ms">
                    <p class="fleet-strip__note"><i class="fas fa-shield-alt" aria-hidden="true"></i> <?php te('home_fleet_foot_note'); ?></p>
                    <a href="/taxi" class="cityride-btn cityride-btn--primary"><span><?php te('home_fleet_foot_btn'); ?></span></a>
                </div>
            </div>
        </section>

        <section class="ride-rates-one section-space ride-rates-one--home-3" id="ride-rates">
            <div class="ride-rates-one__bg" style="background-image: url(assets/images/shapes/taxi-rates-bg-1-1.webp);"></div>
            <div class="ride-rates-one__main-tab-box tabs-box">
                <div class="container">
                    <div class="ride-rates-one__top">
                        <div class="row gutter-y-40 align-items-center">
                            <div class="col-lg-6">
                                <div class="sec-title">
                                    <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                        <div class="sec-title__shape"></div>
                                        <h6 class="sec-title__tagline"><?php te('home_rates_tagline'); ?></h6>
                                    </div>
                                    <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('home_rates_title_line1'); ?> <br><?php te('home_rates_title_line2'); ?></h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Ride now and self-drive rental are app-only features -
                                     point those visitors at the app instead of implying
                                     either works on this site. Intercity travel is the one
                                     booking this site actually takes (see #intercity below). -->

                                <div class="ride-rates-one__app-note wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                    <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                                    <span><?php te('home_rates_app_note_lead'); ?> <strong><?php te('home_rates_app_note_now'); ?></strong> <?php te('home_rates_app_note_mid'); ?> <strong><?php te('home_rates_app_note_rent'); ?></strong> <?php te('home_rates_app_note_tail'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-content" id="ride-rates-content">
                    <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms" id="loading-tab">
                        <div class="container position-relative">
                            <div class="ride-rates-one__inner-bg">
                                <div class="ride-rates-one__inner-bg__bg" style="background-image: url(assets/images/shapes/taxi-rates-inner-bg-1-1.png);"></div>
                            </div>
                        </div>
                        <div class="ride-rates-one__tab-container container">
                            <div class="row gutter-y-30">
                                <div class="col-12 text-center py-5">
                                    <i class="fas fa-spinner fa-spin fa-3x" style="color: #63C51F;"></i>
                                    <p class="mt-3" style="color: #556677; font-size: 18px;"><?php te('home_rates_loading'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?php echo asset_url('assets/js/home-ride-rates.js'); ?>"></script>

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
                                            <div class="fare-info-row" id="intercity_pending_row" hidden><span class="fare-label"><?php te('home_intercity_held'); ?></span><span class="fare-value" id="intercity_pending_text"></span></div>
                                            <div class="fare-info-row"><span class="fare-label" id="intercity_total_label"><?php te('home_intercity_total'); ?></span><span class="fare-value fare-total" id="intercity_total_amount">0 RWF</span></div>
                                        </div>
                                        <div class="form-row" id="intercity_pickup_row" hidden>
                                            <div class="form-group-enhanced">
                                                <label for="intercity_pickup_point"><?php te('home_intercity_pickup_point'); ?></label>
                                                <select class="form-control-enhanced" id="intercity_pickup_point" name="pickup_point_id"></select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group-enhanced">
                                                <label for="intercity_seat_count"><?php te('home_intercity_seat_count'); ?></label>
                                                <input class="form-control-enhanced" id="intercity_seat_count" name="seat_count" type="number" inputmode="numeric" min="1" value="1" required>
                                                <p class="form-error-text" id="intercity_seat_count_error" hidden></p>
                                            </div>
                                        </div>
                                        <div class="form-row" id="intercity_payment_option_row">
                                            <div class="form-group-enhanced">
                                                <label for="intercity_payment_option"><?php te('home_intercity_payment'); ?></label>
                                                <select class="form-control-enhanced" id="intercity_payment_option" name="payment_option">
                                                    <option value="now"><?php te('home_intercity_pay_now'); ?></option>
                                                    <option value="later"><?php te('home_intercity_pay_later'); ?></option>
                                                </select>
                                            </div>
                                        </div>
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
                                        <button class="submit-btn-enhanced" type="submit"><?php te('home_intercity_submit'); ?></button>
                                        <p class="booking-assurance"><?php te('home_intercity_assurance'); ?></p>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo asset_url('assets/js/home-intercity.js'); ?>"></script>

        <!-- Coverage + FAQ -->
        <section class="safeline-coverage section-space" id="coverage">
            <div class="container">

                <div class="sec-title sec-title--center">
                    <div class="sec-title__top">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('home_coverage_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                    <h3 class="sec-title__title"><?php te('home_coverage_title'); ?></h3>
                </div>

                <p class="safeline-coverage__lead">
                    <?php te('home_coverage_lead'); ?>
                </p>

                <ul class="safeline-coverage__areas list-unstyled">
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Remera</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Kacyiru</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Kimihurura</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Nyarutarama</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Kicukiro</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Gikondo</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Nyamirambo</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Gisozi</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Kigali Airport</li>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> City Centre</li>
                </ul>

                <p class="safeline-coverage__more">
                    <?php te('home_coverage_more_lead'); ?>
                    <a href="/contact#faq"><?php te('home_coverage_more_link'); ?></a>.
                </p>

            </div>
        </section>

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
                                <div class="download-app-three__button wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                    <a href="https://www.apple.com/app-store/" class="download-app-three__btn store-badge" target="_blank" rel="noopener" aria-label="Download SafeLine on the App Store">
                                        <div class="download-app-three__btn__icon"><svg class="store-badge__mark" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill="#FFFFFF" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/></svg></div>
                                        <div class="download-app-three__btn__content">
                                            <span class="download-app-three__btn__title"><?php te('home_download_on_the'); ?></span>
                                            <span class="download-app-three__btn__text">App Store</span>
                                        </div>
                                    </a>
                                    <a href="https://play.google.com/" class="download-app-three__btn store-badge" target="_blank" rel="noopener" aria-label="Get SafeLine on Google Play">
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
                            <img src="assets/images/resources/download-app-1-1.png" alt="The SafeLine app shown on a phone" loading="lazy" decoding="async" width="370" height="370">
                        </div><!-- /.download-app-three__image__inner -->
                        <div class="download-app-three__image__item">
                            <img src="assets/images/resources/download-app-taxi-mockup-3-1.png" alt="The SafeLine booking screen on a phone" loading="lazy" decoding="async" width="398" height="453">
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

<?php include 'includes/footer.php'?>
