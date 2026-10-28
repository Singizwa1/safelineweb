<?php
$current_page = 'team';
include 'includes/config.php';
$page_title = t('team_page_title');
$meta_description = t('team_meta_description');
include 'includes/header.php';
?>
<section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/newcar.jpeg);"></div>
            <?php include 'includes/road.php'; ?>
            <!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title"><?php te('nav_about_team'); ?></h2>
                    <ul class="cityride-breadcrumb list-unstyled">
                        <li><span class="cityride-breadcrumb__icon"><i class="icon-home"></i></span><a href="/home"><?php te('nav_home'); ?></a></li>
                        <li><span><?php te('nav_about_team'); ?></span></li>
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
                    <span class="driver-details__section-eyebrow"><?php te('team_eyebrow'); ?></span>
                    <h2 class="driver-details__section-title"><?php te('team_section_title'); ?></h2>
                    <p class="driver-details__section-text"><?php te('team_section_text'); ?></p>
                </div><!-- /.driver-details__section-intro -->
                <div class="driver-details__inner">
                    <div class="driver-details__image wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="leader-card">
                            <!-- Monogram rather than a photograph: no portrait is needed and
                                 it stays sharp at any size. aria-hidden because the name is
                                 already the heading right below it. -->
                            <div class="leader-card__avatar" aria-hidden="true">RN</div>
                            <h4 class="driver-details__name">Rudodo NDIZEYE</h4>
                            <span class="driver-details__designation">SafeLine</span>
                            <p class="leader-card__note">
                                <i class="fas fa-quote-left" aria-hidden="true"></i>
                                <?php te('team_leader_quote'); ?>
                            </p>
                        </div>
                    </div><!-- /.driver-details__image -->
                    <div class="driver-details__content wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <span class="driver-details__eyebrow"><?php te('team_word_from', ['name' => 'Rudodo NDIZEYE']); ?></span>
                        <div class="driver-details__description">
                            <p class="driver-details__lead">
                                <i class="fas fa-quote-left driver-details__quote-icon" aria-hidden="true"></i>
                                <?php te('team_welcome'); ?>
                            </p>
                            <p class="driver-details__text"><?php te('team_body_text'); ?></p>
                            <!-- /.driver-details__text -->
                            <ul class="driver-details__highlights">
                                <li><i class="fas fa-shield-alt" aria-hidden="true"></i> <?php te('team_highlight_safety'); ?></li>
                                <li><i class="fas fa-couch" aria-hidden="true"></i> <?php te('team_highlight_comfort'); ?></li>
                                <li><i class="fas fa-clock" aria-hidden="true"></i> <?php te('team_highlight_ontime'); ?></li>
                            </ul><!-- /.driver-details__highlights -->
                            <p class="driver-details__text"><?php te('team_closing_text'); ?></p>
                            <p class="driver-details__signoff"><?php te('team_signoff'); ?></p>
                            <!-- /.driver-details__text -->
                        </div><!-- /.driver-details__description -->
                        <!--<img src="assets/images/shapes/driver-d-sign-1.png" alt="sign" loading="lazy" decoding="async" width="91" height="50">-->
                        <ul class="driver-details__info">
                            <li>
                                <span class="driver-details__info__icon">
                                    <i class="icon-telephone-call"></i>
                                </span><!-- /.driver-details__info__icon -->
                                <a href="tel:+250 788 471 117">+250 788 471 117</a>
                            </li>
                            <li>
                                <span class="driver-details__info__icon">
                                    <i class="icon-paper-plane"></i>
                                </span><!-- /.driver-details__info__icon -->
                                <a href="mailto:info@safeline.com">info@safeline.com</a>
                            </li>
                            <li>
                                <span class="driver-details__info__icon">
                                    <i class="icon-maps-and-flags"></i>
                                </span><!-- /.driver-details__info__icon -->
                                <a href="https://www.google.com/maps/@23.506657,90.3443647,7z?entry=ttu"><?php te('team_city_label'); ?></a>
                            </li>
                        </ul><!-- /.driver-detailsteam-details__info -->
                    </div><!-- /.driver-details__content -->
                </div><!-- /.driver-details__inner -->
            </div><!-- /.container -->
        </section><!-- /.driver-details section-space-top -->

<?php include 'includes/footer.php'?>
