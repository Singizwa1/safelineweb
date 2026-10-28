<?php
$current_page = 'mission';
include 'includes/config.php';
$page_title = t('nav_about_vision');
$meta_description = t('mission_meta_description');
include 'includes/header.php';
?>
<section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/newcar.jpeg);"></div>
            <?php include 'includes/road.php'; ?>
            <!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title"><?php te('nav_about_vision'); ?></h2>
                    <ul class="cityride-breadcrumb list-unstyled">
                        <li><span class="cityride-breadcrumb__icon"><i class="icon-home"></i></span><a href="/home"><?php te('nav_home'); ?></a></li>
                        <li><span><?php te('nav_about_vision'); ?></span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
            <div class="page-header__element-one">
                <img src="assets/images/shapes/pagination-left.png" alt loading="lazy" decoding="async" width="113" height="181">
            </div><!-- /.page-header__element-one -->
            <div class="page-header__element-two">
                <img src="assets/images/shapes/pagination-right.png" alt loading="lazy" decoding="async" width="85" height="99">
            </div><!-- /.page-header__element-two -->
        </section><!-- /.page-header -->
         <section class="driver-details section-space-top">
            <div class="container">
                <div class="driver-details__section-intro wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="00ms">
                    <span class="driver-details__section-eyebrow"><?php te('mission_eyebrow'); ?></span>
                    <h2 class="driver-details__section-title"><?php te('nav_about_vision'); ?></h2>
                    <p class="driver-details__section-text"><?php te('mission_intro_text'); ?></p>
                </div><!-- /.driver-details__section-intro -->
                <div class="driver-details__inner driver-details__inner--pillars">
                    <img class="mission-pillars-car" aria-hidden="true" alt=""
                         src="assets/images/safeline-cruze-side-r.png"
                         loading="lazy" decoding="async" width="1000" height="365">
                    <div class="driver-details__content wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="00ms">
                        <span class="driver-details__pillar-icon" aria-hidden="true"><i class="fas fa-eye"></i></span>
                        <h4 class="driver-details__name"><?php te('mission_vision_title'); ?></h4><!-- /.driver-details__name -->
                        <div class="driver-details__description">
                            <p class="driver-details__text"><?php te('mission_vision_text'); ?></p>
                            <!-- /.driver-details__text -->
                        </div><!-- /.driver-details__description -->
                    </div><!-- /.driver-details__content -->
                    <div class="driver-details__content wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="150ms">
                        <span class="driver-details__pillar-icon" aria-hidden="true"><i class="fas fa-bullseye"></i></span>
                        <h4 class="driver-details__name"><?php te('mission_mission_title'); ?></h4><!-- /.driver-details__name -->
                        <div class="driver-details__description">
                            <p class="driver-details__text"><?php te('mission_mission_text'); ?></p>
                            <!-- /.driver-details__text -->
                        </div><!-- /.driver-details__description -->
                    </div><!-- /.driver-details__content -->
                </div><!-- /.driver-details__inner -->

                <div class="driver-details__values wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="00ms">
                    <span class="driver-details__section-eyebrow"><?php te('mission_values_eyebrow'); ?></span>
                    <ul class="driver-details__highlights driver-details__highlights--values">
                        <li>
                            <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            <span class="value-body">
                                <strong><?php te('mission_value1_title'); ?></strong>
                                <?php te('mission_value1_text'); ?>
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-couch" aria-hidden="true"></i>
                            <span class="value-body">
                                <strong><?php te('mission_value2_title'); ?></strong>
                                <?php te('mission_value2_text'); ?>
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-clock" aria-hidden="true"></i>
                            <span class="value-body">
                                <strong><?php te('mission_value3_title'); ?></strong>
                                <?php te('mission_value3_text'); ?>
                            </span>
                        </li>
                    </ul><!-- /.driver-details__highlights -->
                </div><!-- /.driver-details__values -->


                <div class="mission-fleet wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="00ms">
                    <div class="mission-fleet__media">
                        <img class="mission-fleet__photo"
                             src="assets/images/safeline-fleet-side-branded.jpg"
                             alt="<?php te('mission_fleet_photo_alt'); ?>"
                             loading="lazy" decoding="async" width="1600" height="1200">
                        <img class="mission-fleet__inset"
                             src="assets/images/safeline-interior.jpg"
                             alt="<?php te('mission_fleet_inset_alt'); ?>"
                             loading="lazy" decoding="async" width="720" height="540">
                    </div>

                    <div class="mission-fleet__body">
                        <span class="driver-details__section-eyebrow"><?php te('mission_fleet_eyebrow'); ?></span>
                        <h2 class="driver-details__section-title"><?php te('mission_fleet_title'); ?></h2>
                        <p class="driver-details__section-text"><?php te('mission_fleet_text'); ?></p>
                        <ul class="mission-fleet__points list-unstyled">
                            <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('mission_fleet_point1'); ?></li>
                            <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('mission_fleet_point2'); ?></li>
                            <li><i class="fas fa-check" aria-hidden="true"></i> <?php te('mission_fleet_point3'); ?></li>
                        </ul>
                        <a href="/taxi" class="cityride-btn cityride-btn--primary mission-fleet__btn">
                            <span><?php te('mission_fleet_btn'); ?></span>
                        </a>
                    </div>
                </div>

                <div class="mission-practice wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="00ms">
                    <div class="mission-practice__head">
                        <span class="driver-details__section-eyebrow"><?php te('mission_practice_eyebrow'); ?></span>
                        <h2 class="driver-details__section-title"><?php te('mission_practice_title'); ?></h2>
                        <p class="driver-details__section-text"><?php te('mission_practice_text'); ?></p>
                    </div>

                    <div class="mission-practice__grid">
                        <div class="mission-practice__item">
                            <span class="mission-practice__num">01</span>
                            <h4><?php te('mission_practice1_title'); ?></h4>
                            <p><?php te('mission_practice1_text'); ?></p>
                        </div>
                        <div class="mission-practice__item">
                            <span class="mission-practice__num">02</span>
                            <h4><?php te('mission_practice2_title'); ?></h4>
                            <p><?php te('mission_practice2_text'); ?></p>
                        </div>
                        <div class="mission-practice__item">
                            <span class="mission-practice__num">03</span>
                            <h4><?php te('mission_practice3_title'); ?></h4>
                            <p><?php te('mission_practice3_text'); ?></p>
                        </div>
                        <div class="mission-practice__item">
                            <span class="mission-practice__num">04</span>
                            <h4><?php te('mission_practice4_title'); ?></h4>
                            <p><?php te('mission_practice4_text'); ?></p>
                        </div>
                    </div>

                    <p class="mission-practice__foot">
                        <?php te('mission_practice_foot_lead'); ?>
                        <a href="/contact"><?php te('mission_practice_foot_link'); ?></a> <?php te('mission_practice_foot_or_call'); ?>
                        <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php echo $contact_phone; ?></a>.
                    </p>
                </div>
            </div><!-- /.container -->
        </section><!-- /.driver-details section-space-top -->

        <section class="cta-one">
            <div class="container">
                <div class="cta-one__inner">
                    <div class="cta-one__inner__bg" style="background-image: url(assets/images/backgrounds/main-slider-bg-1-1.jpg);"></div><!-- /.cta-one__inner__bg -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cta-one__content">
                                <div class="sec-title ">
                                    <div class="sec-title__top wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                        <div class="sec-title__shape"></div><!-- /.sec-title__shape -->
                                        <h6 class="sec-title__tagline"><?php te('mission_cta_tagline'); ?></h6><!-- /.sec-title__tagline -->
                                    </div><!-- /.sec-title__top -->
                                    <h3 class="sec-title__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms"><?php te('mission_cta_title'); ?></h3><!-- /.sec-title__title -->
                                </div><!-- /.sec-title -->
                                <div class="cta-one__content__btn wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="150ms">
                                    <a href="/#download-app" class="cityride-btn cityride-btn--border">
                                        <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                        <span><?php te('mission_cta_book_now'); ?></span>
                                    </a>
                                </div><!-- /.cta-one__content__btn -->
                            </div><!-- /.cta-one__content -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    <div class="cta-one__inner__image">
                        <img src="assets/images/safeline-cruze-side-r.png" alt="" loading="lazy" decoding="async" width="360" height="176">
                    </div><!-- /.cta-one__inner__image -->
                    <div class="cta-one__inner__box">
                        <div class="cta-one__inner__box__bg" style="background-image: url(assets/images/shapes/ta-shape-2-1.png);"></div><!-- /.cta-one__inner__box__bg -->
                        <div class="cta-one__inner__box__one"></div><!-- /.cta-one__inner__box__one -->
                        <div class="cta-one__inner__box__two"></div><!-- /.cta-one__inner__box__two -->
                    </div><!-- /.cta-one__inner__box -->
                    <div class="cta-one__inner__item-one"></div><!-- /.cta-one__inner__item -->
                    <div class="cta-one__inner__item-two"></div><!-- /.cta-one__inner__item -->
                </div><!-- /.cta-one__inner -->
            </div><!-- /.container -->
        </section><!-- /.cta-one -->

<?php include 'includes/footer.php'?>
