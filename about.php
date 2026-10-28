<?php
$current_page = 'about';
include 'includes/config.php';
$page_title = t('about_page_title');
$meta_description = t('about_meta_description');
include 'includes/header.php';
?>

<style>
/* =========================================================
   SafeLine — ABOUT PAGE READABILITY ENHANCEMENTS
   ========================================================= */

/* ---------- General readable text ---------- */
.about-four__top__text,
.about-four__list li,
.download-app-two__item__text,
.testimonial-card__text {
    line-height: 1.8;
}

/* =========================================================
   DARK-BACKGROUND CONTRAST FIX — scoped to .about-four only
   Only the About section has a dark background image behind
   it; testimonials and the benefits section are on a light
   background and already read fine with normal dark text.
   Because .sec-title__tagline / .sec-title__title are reused
   by BOTH light and dark sections, these overrides are scoped
   with the .about-four ancestor so they don't leak into the
   light sections below. !important wins over the external
   stylesheet's default (near-black-on-dark) colors.
   ========================================================= */

/* CORRECTED: this section renders on a WHITE background, not a dark one.
   The previous rules forced #ffffff / #e6e6e6 with !important, which put
   white text on white and made the whole section unreadable. */
.about-four .sec-title__title,
.about-four__author__title {
    color: #001832 !important;
    opacity: 1 !important;
}
.about-four__top__text,
.about-four__list li,
.about-four__author__dec {
    color: #1A2233 !important;
    opacity: 1 !important;
}
.about-four__list li span {
    color: #1A2233 !important;
}

/* Brand accent on this tagline, but the readable variant: #63C51F on white
   measures 2.20:1, well under AA. --color-primary-text (#3B760D) is the
   token that exists for green text on light backgrounds - 7.2:1. */
.about-four .sec-title__tagline {
    color: var(--color-primary-text, #3B760D) !important;
}

/* Emergency phone number needs to be the most prominent
   element in that block — pure white, no opacity fade. */
.about-four__author__title {
    color: #001832 !important;
    text-shadow: none;
    font-weight: 700;
}


.about-four__bottom:hover,
.about-four__author:hover,
.about-four__author__content:hover {
    background: transparent !important;
}

.about-four__bottom:hover .about-four__author__title,
.about-four__author:hover .about-four__author__title {
    color: #63C51F !important;
}
.about-four__bottom:hover .about-four__author__dec,
.about-four__author:hover .about-four__author__dec {
    color: #1A2233 !important;
}


.about-four__image__text {
    position: static !important;
    top: auto !important;
    left: auto !important;
    right: auto !important;
    bottom: auto !important;
    transform: none !important;
    display: inline-flex !important;
    align-items: center;
    gap: 8px;
    margin: 16px 0 0 !important;
}
.about-four__mini-stats {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-top: 20px;
}

.about-four__mini-stat {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: #F8F9FB;
    border: 1px solid #E5E9F0;
    border-radius: 10px;
    flex: 1 1 150px;
}

.about-four__mini-stat i {
    color: #63C51F;
    font-size: 18px;
    flex-shrink: 0;
}

.about-four__mini-stat span {
    color: #001832 !important;
    font-size: 14px;
    font-weight: 600;
}

@media (max-width: 575px) {
    .about-four__mini-stat {
        flex: 1 1 100%;
    }
}

/* =========================================================
   REMOVE DECORATIVE SQUIGGLE / SHAPE OVERLAYS
   The theme drops decorative shape/line graphics (route
   squiggle, signature doodle, floating blob, dots, vertical
   divider bar) into this section via classes like
   .about-four__shape-left, .about-four__signeture and
   .about-four__element. On this page they overlap real text
   and eat up space around the vehicle photo, so everything
   decorative in this section is hidden. The wildcard rule
   below also catches any similarly-named shape element that
   isn't explicitly listed, scoped only to .about-four so
   nothing outside this section is affected.
   ========================================================= */
.about-four__shape-left,
.about-four__shape-left__one,
.about-four__shape-left__two,
.about-four__signeture,
.about-four__element,
.about-four [class*="shape"],
.about-four [class*="signeture"],
.about-four [class*="dot"] {
    display: none !important;
}

/* The image column was vertically centered against the taller
   text column, which is what created the empty space above
   (and effectively around) the vehicle photo. Aligning both
   columns to the top removes that gap. */
.about-four .row.align-items-center {
    align-items: flex-start !important;
}

/* Pull the image flush to the top of its column now that the
   shape that was pushing it down is gone. */
.about-four__image,
.about-four__image__item {
    margin-top: 0 !important;
    padding-top: 0 !important;
}

/* ---------- About section ---------- */
.about-four__top__text {
    max-width: 680px;
    font-size: 16px;
    color: #555;
    margin-bottom: 25px;
}

.about-four__list {
    margin: 0 0 30px;
    padding: 0;
}

.about-four__list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
    font-size: 15px;
    color: #333;
}

.about-four__list li i {
    flex-shrink: 0;
    margin-top: 5px;
    color: #2ecc71; /* consistent brand-check color */
}

/* ---------- Emergency contact ---------- */
.about-four__author__dec {
    display: block;
    margin-bottom: 5px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .6px;
}

.about-four__author__title {
    font-size: 22px;
    line-height: 1.3;
}

/* ---------- Download / benefits section ---------- */
.download-app-two__item {
    margin-bottom: 35px;
}

.download-app-two__item__content {
    min-width: 0;
}

.download-app-two__item__title {
    line-height: 1.35;
    margin-bottom: 10px;
    font-size: 21px;
}

.download-app-two__item__text {
    font-size: 15px;
    line-height: 1.75;
    color: #555;
    margin: 0;
}

/* Better readability when background image is present */
.download-app-two {
    position: relative;
    overflow: hidden;
}

.download-app-two__bg {
    opacity: .12;
}

/* ---------- Section headings ---------- */
.sec-title__tagline {
    letter-spacing: .8px;
}

.sec-title__title {
    line-height: 1.25;
}

/* ---------- Testimonials ---------- */
.testimonials-one {
    overflow: hidden;
}

.testimonial-card {
    height: 100%;
}

.testimonial-card__text {
    font-size: 15px;
    line-height: 1.8;
    color: #555;
    min-height: 115px;
}

.testimonial-card__name {
    line-height: 1.3;
}

/* Consistent card heights inside the carousel */
.testimonials-one__carousel .item {
    height: 100%;
}

.testimonials-one__carousel .testimonial-card {
    min-height: 310px;
}

/* Author avatars: keep circular, consistent size, no distortion */
.testimonial-card__author img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

/* ---------- Image sizing ---------- */
.about-four__image__item img {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
}

.about-four__author__man img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

/* ---------- Mobile readability ---------- */
@media (max-width: 991px) {

    .about-four__right {
        margin-top: 10px;
    }

    .about-four__top__text {
        font-size: 15px;
        line-height: 1.75;
    }

    .download-app-two__item__title {
        font-size: 20px;
    }

    .download-app-two__item__text {
        font-size: 15px;
        line-height: 1.75;
    }

    .testimonial-card__text {
        font-size: 15px;
        line-height: 1.75;
    }
}

@media (max-width: 575px) {

    .page-header__title {
        font-size: 34px;
        line-height: 1.2;
    }

    .about-four__top__text {
        font-size: 15px;
        line-height: 1.75;
    }

    .about-four__list li {
        font-size: 14px;
        line-height: 1.7;
    }

    .about-four__author__title {
        font-size: 20px;
    }

    .download-app-two__item {
        margin-bottom: 28px;
    }

    .download-app-two__item__title {
        font-size: 19px;
        line-height: 1.35;
    }

    .download-app-two__item__text {
        font-size: 14px;
        line-height: 1.75;
    }

    .testimonial-card__text {
        font-size: 14px;
        line-height: 1.75;
        min-height: auto;
    }

    .testimonials-one__carousel .testimonial-card {
        min-height: auto;
    }
}
</style>


<!-- =========================================================
     PAGE HEADER
     ========================================================= -->
<section class="page-header">

    <div class="page-header__bg"
         style="background-image: url(assets/images/newcar.jpeg);">
    </div>
    <?php include 'includes/road.php'; ?>

    <div class="container">
        <div class="page-header__content">

            <h2 class="page-header__title"><?php te('about_page_title'); ?></h2>

            <ul class="cityride-breadcrumb list-unstyled">
                <li>
                    <span class="cityride-breadcrumb__icon">
                        <i class="icon-home"></i>
                    </span>
                    <a href="/home"><?php te('nav_home'); ?></a>
                </li>

                <li>
                    <span><?php te('about_page_title'); ?></span>
                </li>
            </ul>

        </div>
    </div>

    <div class="page-header__element-one">
        <img src="assets/images/shapes/pagination-left.png"
             alt=""
             loading="lazy"
             decoding="async"
             width="113"
             height="181">
    </div>

    <div class="page-header__element-two">
        <img src="assets/images/shapes/pagination-right.png"
             alt=""
             loading="lazy"
             decoding="async"
             width="85"
             height="99">
    </div>

</section>


<!-- =========================================================
     About
     ========================================================= -->
<div class="about-four section-space" id="about">

    <div class="container">

        <div class="row gutter-y-40 align-items-center">

            <!-- IMAGE -->
            <div class="col-lg-6">

                <div class="about-four__image wow fadeInLeft"
                     data-wow-duration="1500ms"
                     data-wow-delay="150ms">

                    <div class="about-four__image__item">

                        <img src="assets/images/about.jpeg"
                             alt="<?php te('about_image_alt'); ?>"
                             loading="lazy"
                             decoding="async"
                             width="1600"
                             height="1200">

                    </div>

                    <p class="about-four__image__text">
                        <i class="fas fa-users" aria-hidden="true"></i>
                        <?php te('about_customers_worldwide'); ?>
                    </p>

                    <!-- MINI STATS: fills the space below the photo with
                         quick trust signals instead of leaving it empty -->
                    <div class="about-four__mini-stats">

                        <div class="about-four__mini-stat">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            <span><?php te('about_stat_verified_drivers'); ?></span>
                        </div>

                        <div class="about-four__mini-stat">
                            <i class="fas fa-star" aria-hidden="true"></i>
                            <span><?php te('about_stat_rating'); ?></span>
                        </div>

                        <div class="about-four__mini-stat">
                            <i class="fas fa-headset" aria-hidden="true"></i>
                            <span><?php te('about_stat_support'); ?></span>
                        </div>

                    </div>

                </div>

            </div>


            <!-- CONTENT -->
            <div class="col-lg-6">

                <div class="about-four__right">

                    <div class="sec-title">

                        <div class="sec-title__top wow fadeInUp"
                             data-wow-duration="1500ms"
                             data-wow-delay="150ms">

                            <div class="sec-title__shape"></div>

                            <h6 class="sec-title__tagline">
                                <?php te('about_company_tagline'); ?>
                            </h6>

                        </div>

                        <h3 class="sec-title__title wow fadeInUp"
                            data-wow-duration="1500ms"
                            data-wow-delay="200ms">

                            <?php te('about_hero_title'); ?>

                        </h3>

                    </div>


                    <p class="about-four__top__text wow fadeInUp"
                       data-wow-duration="1500ms"
                       data-wow-delay="150ms">

                        <?php te('about_intro_text1'); ?>

                    </p>

                    <p class="about-four__top__text wow fadeInUp"
                       data-wow-duration="1500ms"
                       data-wow-delay="150ms">

                        <?php te('about_intro_text2'); ?>

                    </p>


                    <ul class="about-four__list list-unstyled wow fadeInUp"
                        data-wow-duration="1500ms"
                        data-wow-delay="150ms">

                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>
                                <strong><?php te('about_list1_title'); ?></strong> –
                                <?php te('about_list1_text'); ?>
                            </span>
                        </li>

                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>
                                <strong><?php te('about_list2_title'); ?></strong> –
                                <?php te('about_list2_text'); ?>
                            </span>
                        </li>

                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>
                                <strong><?php te('about_list3_title'); ?></strong> –
                                <?php te('about_list3_text'); ?>
                            </span>
                        </li>

                    </ul>


                    <!-- EMERGENCY CONTACT -->
                    <div class="about-four__bottom wow fadeInUp"
                         data-wow-duration="1500ms"
                         data-wow-delay="150ms">

                        <div class="about-four__author">

                            <div class="about-four__author__man">

                                <!--
                                    NOTE: Replace assets/images/vanessa.jpg with
                                    a real support-team photo (or keep as-is).
                                -->
                                <img src="assets/images/vanessa.jpg"
                                     alt="<?php te('about_support_photo_alt'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="864"
                                     height="864">

                            </div>

                            <div class="about-four__author__content">

                                <span class="about-four__author__dec">
                                    <?php te('about_emergency_call_us'); ?>
                                </span>

                                <h4 class="about-four__author__title">
                                    +250 788 471 117
                                </h4>

                            </div>

                        </div>

                        <div class="about-four__signeture"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="about-four__element">

        <img src="assets/images/shapes/download-app-shape-2-1.png"
             alt=""
             loading="lazy"
             decoding="async"
             width="145"
             height="111">

    </div>


    <div class="about-four__shape-left">

        <div class="about-four__shape-left__one"></div>
        <div class="about-four__shape-left__two"></div>

    </div>

</div>


<!-- =========================================================
     PATTERN BACKGROUND
     ========================================================= -->
<div class="pattern-bg"
     style="background-image: url(assets/images/shapes/pattern.png);">
</div>


<!-- =========================================================
     WHY CHOOSE SafeLine
     ========================================================= -->
<section class="download-app-two section-space">

    <div class="download-app-two__bg"
         style="background-image: url(assets/images/shapes/download-app-bg-2-1.webp);">
    </div>


    <div class="container">

        <div class="sec-title sec-title--center">

            <div class="sec-title__top wow fadeInUp"
                 data-wow-duration="1500ms"
                 data-wow-delay="150ms">

                <div class="sec-title__shape"></div>

                <h6 class="sec-title__tagline">
                    <?php te('about_why_choose_tagline'); ?>
                </h6>

                <div class="sec-title__shape"></div>

            </div>

            <h3 class="sec-title__title wow fadeInUp"
                data-wow-duration="1500ms"
                data-wow-delay="200ms">

                <?php te('about_benefits_title'); ?>

            </h3>

        </div>


        <div class="row gutter-y-40 align-items-center">


            <!-- LEFT FEATURES -->
            <div class="col-lg-4 wow fadeInLeft"
                 data-wow-duration="1500ms"
                 data-wow-delay="150ms">

                <div class="download-app-two__left">


                    <!-- FEATURE 1 -->
                    <div class="download-app-two__item wow fadeInUp"
                         data-wow-duration="1500ms"
                         data-wow-delay="200ms">

                        <div class="download-app-two__item__icon">
                            <i class="icon-right"></i>
                        </div>

                        <div class="download-app-two__item__content">

                            <h3 class="download-app-two__item__title">
                                <?php te('about_feature1_title'); ?>
                            </h3>

                            <p class="download-app-two__item__text">

                                <?php te('about_feature1_text'); ?>

                            </p>

                        </div>

                    </div>


                    <!-- FEATURE 2 -->
                    <div class="download-app-two__item wow fadeInUp"
                         data-wow-duration="1500ms"
                         data-wow-delay="200ms">

                        <div class="download-app-two__item__icon">
                            <i class="icon-right"></i>
                        </div>

                        <div class="download-app-two__item__content">

                            <h3 class="download-app-two__item__title">
                                <?php te('about_feature2_title'); ?>
                            </h3>

                            <p class="download-app-two__item__text">

                                <?php te('about_feature2_text'); ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CENTER IMAGE -->
            <div class="col-lg-4">

                <div class="download-app-two__image">

                    <div class="download-app-two__image__inner"
                         style="background-image: url(assets/images/resources/download-app-2-1.jpg);">
                    </div>

                    <img src="assets/images/resources/download-app-taxi-mockup-2-1.png"
                         alt="<?php te('about_app_mockup_alt'); ?>"
                         class="download-app-two__image__mockup"
                         loading="lazy"
                         decoding="async"
                         width="280"
                         height="310">

                </div>

            </div>


            <!-- RIGHT FEATURES -->
            <div class="col-lg-4 wow fadeInRight"
                 data-wow-duration="1500ms"
                 data-wow-delay="150ms">

                <div class="download-app-two__right">


                    <!-- FEATURE 3 -->
                    <div class="download-app-two__item wow fadeInUp"
                         data-wow-duration="1500ms"
                         data-wow-delay="200ms">

                        <div class="download-app-two__item__icon">
                            <i class="icon-right"></i>
                        </div>

                        <div class="download-app-two__item__content">

                            <h3 class="download-app-two__item__title">
                                <?php te('about_feature3_title'); ?>
                            </h3>

                            <p class="download-app-two__item__text">

                                <?php te('about_feature3_text'); ?>

                            </p>

                        </div>

                    </div>


                    <!-- FEATURE 4 -->
                    <div class="download-app-two__item wow fadeInUp"
                         data-wow-duration="1500ms"
                         data-wow-delay="200ms">

                        <div class="download-app-two__item__icon">
                            <i class="icon-right"></i>
                        </div>

                        <div class="download-app-two__item__content">

                            <h3 class="download-app-two__item__title">
                                <?php te('about_feature4_title'); ?>
                            </h3>

                            <p class="download-app-two__item__text">

                                <?php te('about_feature4_text'); ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <img src="assets/images/shapes/download-app-shape-2-1.png"
         alt=""
         class="download-app-two__shape"
         loading="lazy"
         decoding="async"
         width="145"
         height="111">

</section>


<!-- =========================================================
     TESTIMONIALS

     AVATARS: hotlinked directly from Unsplash (free license, no
     attribution required) so no local image files are needed.
     Mix used across the 6 cards:
       Ralph Edwards / Daniel Williams -> White man   (photo-1500648767791-00dcc994a43e)
       Esther Howard / Sophia Martin   -> Black woman (photo-1531123897727-8f129e1688ce)
       Leslie Alexander                -> White woman (photo-1699899657680-421c2c2d5064)
       Michael Johnson                 -> Black man   (photo-1522529599102-193c0d76b5b6)

     To swap any of these for your own photos later, just replace
     the img src with a path to a local file in assets/images/resources/.
     ========================================================= -->
<section class="testimonials-one section-space"
         id="testimonials">

    <div class="container">

        <div class="sec-title sec-title--center">

            <div class="sec-title__top wow fadeInUp"
                 data-wow-duration="1500ms"
                 data-wow-delay="150ms">

                <div class="sec-title__shape"></div>

                <h6 class="sec-title__tagline">
                    <?php te('about_testimonials_tagline'); ?>
                </h6>

                <div class="sec-title__shape"></div>

            </div>

            <h3 class="sec-title__title wow fadeInUp"
                data-wow-duration="1500ms"
                data-wow-delay="200ms">

                <?php te('about_testimonials_title_line1'); ?><br>
                <?php te('about_testimonials_title_line2'); ?>

            </h3>

        </div>

    </div>


    <div class="testimonials-one__inner">

        <div class="container">

            <div class="testimonials-one__carousel cityride-owl__carousel cityride-owl__carousel--basic-nav cityride-owl__carousel--with-shadow owl-carousel owl-theme"
                 data-owl-options='{
                    "items": 1,
                    "margin": 10,
                    "loop": true,
                    "smartSpeed": 700,
                    "nav": true,
                    "navText": [
                        "<span class=\"icon-arrow-left\"></span>",
                        "<span class=\"icon-arrow-right\"></span>"
                    ],
                    "dots": false,
                    "autoplay": true,
                    "autoplayTimeout": 5000,
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


                <!-- TESTIMONIAL 1 : White man -->
                <div class="item">

                    <div class="testimonial-card">

                        <div class="testimonial-card__top">

                            <div class="testimonial-card__author">

                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=140&h=140&fit=crop&crop=faces&q=80"
                                     alt="Ralph Edwards, <?php te('about_testimonial_role'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="70"
                                     height="70">

                                <div class="testimonial-card__icon">
                                    <i class="icon-quite-1"></i>
                                </div>

                            </div>

                            <div class="testimonial-card__top__content">

                                <h4 class="testimonial-card__name">
                                    Ralph Edwards
                                </h4>

                            </div>

                        </div>

                        <p class="testimonial-card__text">

                            <?php te('about_testimonial1_text'); ?>

                        </p>

                        <div class="testimonial-card__bottom">

                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>

                        </div>

                    </div>

                </div>


                <!-- TESTIMONIAL 2 : Black woman -->
                <div class="item">

                    <div class="testimonial-card">

                        <div class="testimonial-card__top">

                            <div class="testimonial-card__author">

                                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=140&h=140&fit=crop&crop=faces&q=80"
                                     alt="Esther Howard, <?php te('about_testimonial_role'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="70"
                                     height="70">

                                <div class="testimonial-card__icon">
                                    <i class="icon-quite-1"></i>
                                </div>

                            </div>

                            <div class="testimonial-card__top__content">

                                <h4 class="testimonial-card__name">
                                    Esther Howard
                                </h4>

                            </div>

                        </div>

                        <p class="testimonial-card__text">

                            <?php te('about_testimonial2_text'); ?>

                        </p>

                        <div class="testimonial-card__bottom">

                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>

                        </div>

                    </div>

                </div>


                <!-- TESTIMONIAL 3 : White woman -->
                <div class="item">

                    <div class="testimonial-card">

                        <div class="testimonial-card__top">

                            <div class="testimonial-card__author">

                                <img src="https://images.unsplash.com/photo-1699899657680-421c2c2d5064?w=140&h=140&fit=crop&crop=faces&q=80"
                                     alt="Leslie Alexander, <?php te('about_testimonial_role'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="70"
                                     height="70">

                                <div class="testimonial-card__icon">
                                    <i class="icon-quite-1"></i>
                                </div>

                            </div>

                            <div class="testimonial-card__top__content">

                                <h4 class="testimonial-card__name">
                                    Leslie Alexander
                                </h4>

                            </div>

                        </div>

                        <p class="testimonial-card__text">

                            <?php te('about_testimonial3_text'); ?>

                        </p>

                        <div class="testimonial-card__bottom">

                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>

                        </div>

                    </div>

                </div>


                <!-- TESTIMONIAL 4 : Black man -->
                <div class="item">

                    <div class="testimonial-card">

                        <div class="testimonial-card__top">

                            <div class="testimonial-card__author">

                                <img src="https://images.unsplash.com/photo-1522529599102-193c0d76b5b6?w=140&h=140&fit=crop&crop=faces&q=80"
                                     alt="Michael Johnson, <?php te('about_testimonial_role'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="70"
                                     height="70">

                                <div class="testimonial-card__icon">
                                    <i class="icon-quite-1"></i>
                                </div>

                            </div>

                            <div class="testimonial-card__top__content">

                                <h4 class="testimonial-card__name">
                                    Michael Johnson
                                </h4>

                            </div>

                        </div>

                        <p class="testimonial-card__text">

                            <?php te('about_testimonial4_text'); ?>

                        </p>

                        <div class="testimonial-card__bottom">

                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>

                        </div>

                    </div>

                </div>


                <!-- TESTIMONIAL 5 : White man (reused) -->
                <div class="item">

                    <div class="testimonial-card">

                        <div class="testimonial-card__top">

                            <div class="testimonial-card__author">

                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=140&h=140&fit=crop&crop=faces&q=80"
                                     alt="Daniel Williams, <?php te('about_testimonial_role'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="70"
                                     height="70">

                                <div class="testimonial-card__icon">
                                    <i class="icon-quite-1"></i>
                                </div>

                            </div>

                            <div class="testimonial-card__top__content">

                                <h4 class="testimonial-card__name">
                                    Daniel Williams
                                </h4>

                            </div>

                        </div>

                        <p class="testimonial-card__text">

                            <?php te('about_testimonial5_text'); ?>

                        </p>

                        <div class="testimonial-card__bottom">

                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>

                        </div>

                    </div>

                </div>


                <!-- TESTIMONIAL 6 : Black woman (reused) -->
                <div class="item">

                    <div class="testimonial-card">

                        <div class="testimonial-card__top">

                            <div class="testimonial-card__author">

                                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=140&h=140&fit=crop&crop=faces&q=80"
                                     alt="Sophia Martin, <?php te('about_testimonial_role'); ?>"
                                     loading="lazy"
                                     decoding="async"
                                     width="70"
                                     height="70">

                                <div class="testimonial-card__icon">
                                    <i class="icon-quite-1"></i>
                                </div>

                            </div>

                            <div class="testimonial-card__top__content">

                                <h4 class="testimonial-card__name">
                                    Sophia Martin
                                </h4>

                            </div>

                        </div>

                        <p class="testimonial-card__text">

                            <?php te('about_testimonial6_text'); ?>

                        </p>

                        <div class="testimonial-card__bottom">

                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>

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


<?php
include 'includes/footer.php';
?>
