<?php
$current_page = 'taxi';
include 'includes/config.php';
$page_title = t('taxi_page_title');
$meta_description = t('taxi_meta_description');
include 'includes/header.php';
?>

        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/main-slider-bg-1-1.jpg);"></div>
            <?php include 'includes/road.php'; ?>
            <!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title"><?php te('taxi_page_title'); ?></h2>
                    <ul class="cityride-breadcrumb list-unstyled">
                        <li><span class="cityride-breadcrumb__icon"><i class="icon-home"></i></span><a href="/home"><?php te('taxi_breadcrumb_home'); ?></a></li>
                        <li><span><?php te('taxi_page_title'); ?></span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
            <div class="page-header__element-one">
                <img src="assets/images/shapes/pagination-left.png" alt>
            </div><!-- /.page-header__element-one -->
            <div class="page-header__element-two">
                <img src="assets/images/shapes/pagination-right.png" alt>
            </div><!-- /.page-header__element-two -->
        </section><!-- /.page-header -->

        <section class="taxi-rates-page section-space">
            <div class="container">
                <div class="row gutter-y-30" id="fleet-grid" data-source="fallback">
                    <div class="col-xl-4 col-md-6">
                        <div class="taxi-card">
                            <div class="taxi-card__bg" style="background-image: url(assets/images/shapes/taxi-card-bg-1-1.png);"></div>
                            <div class="taxi-card__inner">
                                <div class="taxi-card__image">
                                    <img src="assets/images/safeline-cruze-side-r.png" alt="SafeLine Voiture Économique" loading="lazy">
                                    <h3 class="taxi-card__price"><?php te('taxi_from_prefix'); ?> 1,500 RWF</h3>
                                </div>
                                <div class="taxi-card__content">
                                    <h3 class="taxi-card__title">Voiture Économique</h3>
                                    <p class="taxi-card__company">SafeLine Fleet</p>
                                    <ul class="taxi-card__list list-unstyled">
                                        <li><span><?php te('taxi_label_base_fare'); ?></span><span>1,500 RWF</span></li>
                                        <li><span><?php te('taxi_label_per_km'); ?></span><span>1,000 RWF</span></li>
                                        <li><span><?php te('taxi_label_fare_shown'); ?></span><span><?php te('taxi_label_before_confirm'); ?></span></li>
                                    </ul>
                                    <a href="/#download-app" class="cityride-btn cityride-btn--border">
                                        <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                        <span><?php te('taxi_btn_book_now'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="taxi-card">
                            <div class="taxi-card__bg" style="background-image: url(assets/images/shapes/taxi-card-bg-1-1.png);"></div>
                            <div class="taxi-card__inner">
                                <div class="taxi-card__image">
                                    <img src="assets/images/safeline-cruze-side-r.png" alt="SafeLine Course Standard" loading="lazy">
                                    <h3 class="taxi-card__price"><?php te('taxi_from_prefix'); ?> 2,000 RWF</h3>
                                </div>
                                <div class="taxi-card__content">
                                    <h3 class="taxi-card__title">Course Standard</h3>
                                    <p class="taxi-card__company">SafeLine Fleet</p>
                                    <ul class="taxi-card__list list-unstyled">
                                        <li><span><?php te('taxi_label_base_fare'); ?></span><span>2,000 RWF</span></li>
                                        <li><span><?php te('taxi_label_per_km'); ?></span><span>2,500 RWF</span></li>
                                        <li><span><?php te('taxi_label_fare_shown'); ?></span><span><?php te('taxi_label_before_confirm'); ?></span></li>
                                    </ul>
                                    <a href="/#download-app" class="cityride-btn cityride-btn--border">
                                        <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                        <span><?php te('taxi_btn_book_now'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="taxi-card">
                            <div class="taxi-card__bg" style="background-image: url(assets/images/shapes/taxi-card-bg-1-1.png);"></div>
                            <div class="taxi-card__inner">
                                <div class="taxi-card__image">
                                    <img src="assets/images/safeline-cruze-side.png" alt="SafeLine Course Premium" loading="lazy">
                                    <h3 class="taxi-card__price"><?php te('taxi_from_prefix'); ?> 2,700 RWF</h3>
                                </div>
                                <div class="taxi-card__content">
                                    <h3 class="taxi-card__title">Course Premium</h3>
                                    <p class="taxi-card__company">SafeLine Fleet</p>
                                    <ul class="taxi-card__list list-unstyled">
                                        <li><span><?php te('taxi_label_base_fare'); ?></span><span>2,700 RWF</span></li>
                                        <li><span><?php te('taxi_label_per_km'); ?></span><span>3,000 RWF</span></li>
                                        <li><span><?php te('taxi_label_fare_shown'); ?></span><span><?php te('taxi_label_before_confirm'); ?></span></li>
                                    </ul>
                                    <a href="/#download-app" class="cityride-btn cityride-btn--border">
                                        <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                        <span><?php te('taxi_btn_book_now'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row gutter-y-30 -->

                <p class="fleet-note" id="fleet-note" hidden>
                    <?php te('taxi_fleet_note_prefix'); ?> <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php echo $contact_phone; ?></a>.
                </p>

                <p class="fleet-foot">
                    <?php te('taxi_fleet_foot_prefix'); ?>
                    <a href="/contact"><?php te('taxi_fleet_foot_link'); ?></a>.
                </p>
            </div><!-- /.container -->
        </section><!-- /.taxi-rates-page section-space -->


<script>
/* Fleet pricing comes from safeLine-api's own public reference data (see
   includes/config.php $safeline_api_base), so this page cannot drift away
   from what a ride is actually estimated at. The markup above is a
   fallback that mirrors typical values; if the fetch succeeds it is replaced
   wholesale. */
(function safelineFleet() {
    'use strict';
    var IMAGES = [
        'assets/images/safeline-cruze-side-r.png',
        'assets/images/safeline-cruze-side-r.png',
        'assets/images/safeline-cruze-side.png'
    ];
    var grid = document.getElementById('fleet-grid');
    var note = document.getElementById('fleet-note');
    if (!grid) { return; }

    // This block builds cards client-side from live pricing data, so the
    // labels can't go through te() like the fallback markup above - same
    // reasoning as home-intercity.js's SAFELINE_I18N, but inlined here
    // since these labels are only used on this one page.
    var LABELS = <?php echo json_encode([
        'baseFare' => t('taxi_label_base_fare'),
        'perKm' => t('taxi_label_per_km'),
        'fareShown' => t('taxi_label_fare_shown'),
        'beforeConfirm' => t('taxi_label_before_confirm'),
        'getTheApp' => t('taxi_btn_get_the_app'),
        'fromPrefix' => t('taxi_from_prefix'),
    ]); ?>;

    function rwf(v) {
        var n = Math.round(parseFloat(v) || 0);
        return n.toLocaleString('en-US');
    }
    function esc(t) {
        return String(t == null ? '' : t).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    var ctrl = new AbortController();
    var timer = window.setTimeout(function () { ctrl.abort(); }, 12000);

    Promise.all([
        fetch(SAFELINE_API_BASE + '/public/vehicle-categories?limit=100', { signal: ctrl.signal }).then(function (r) { return r.json(); }),
        fetch(SAFELINE_API_BASE + '/public/ride-prices?limit=100', { signal: ctrl.signal }).then(function (r) { return r.json(); }),
    ])
        .then(function (results) {
            var catRes = results[0], priceRes = results[1];
            if (!catRes || !catRes.success || !catRes.data || !catRes.data.length) { throw new Error('no data'); }

            var pricesByCategory = {};
            (priceRes.data || []).forEach(function (p) {
                if (p.status === 'active' && !pricesByCategory[p.category_id]) {
                    pricesByCategory[p.category_id] = p;
                }
            });

            var categories = catRes.data.filter(function (c) {
                return c.status === 'active' && pricesByCategory[c.id];
            });
            if (!categories.length) { throw new Error('no priced categories'); }

            var html = categories.map(function (c, i) {
                var p = pricesByCategory[c.id];
                return '<div class="col-xl-4 col-md-6">' +
                    '<div class="taxi-card">' +
                      '<div class="taxi-card__bg" style="background-image: url(assets/images/shapes/taxi-card-bg-1-1.png);"></div>' +
                      '<div class="taxi-card__inner">' +
                        '<div class="taxi-card__image">' +
                          '<img src="' + IMAGES[i % IMAGES.length] + '" alt="SafeLine ' + esc(c.name) + '" loading="lazy">' +
                          '<h3 class="taxi-card__price">' + esc(LABELS.fromPrefix) + ' ' + rwf(p.base_fare) + ' RWF</h3>' +
                        '</div>' +
                        '<div class="taxi-card__content">' +
                          '<h3 class="taxi-card__title">' + esc(c.name) + '</h3>' +
                          '<p class="taxi-card__company">SafeLine Fleet</p>' +
                          '<ul class="taxi-card__list list-unstyled">' +
                            '<li><span>' + esc(LABELS.baseFare) + '</span><span>' + rwf(p.base_fare) + ' RWF</span></li>' +
                            '<li><span>' + esc(LABELS.perKm) + '</span><span>' + rwf(p.per_km_rate) + ' RWF</span></li>' +
                            '<li><span>' + esc(LABELS.fareShown) + '</span><span>' + esc(LABELS.beforeConfirm) + '</span></li>' +
                          '</ul>' +
                          '<a href="/#download-app" class="cityride-btn cityride-btn--border">' +
                            '<span class="cityride-btn__icon"><i class="icon-front-car"></i></span>' +
                            '<span>' + esc(LABELS.getTheApp) + '</span>' +
                          '</a>' +
                        '</div>' +
                      '</div>' +
                    '</div>' +
                  '</div>';
            }).join('');
            grid.innerHTML = html;
            grid.setAttribute('data-source', 'live');
            if (note) { note.hidden = true; }
        })
        .catch(function (err) {
            // keep the fallback cards and say so rather than showing an empty grid
            console.warn('SafeLine: live fleet pricing unavailable, showing standard rates', err);
            if (note) { note.hidden = false; }
        })
        .then(function () { window.clearTimeout(timer); });
}());
</script>


        <section class="fleet-gallery section-space-bottom" id="fleet-gallery">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('taxi_gallery_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                    <h3 class="sec-title__title"><?php te('taxi_gallery_title'); ?></h3>
                </div>

                <p class="fleet-gallery__lead">
                    <?php te('taxi_gallery_lead'); ?>
                </p>

                <div class="fleet-gallery__grid">
                    <figure class="fleet-gallery__item is-wide">
                        <img src="assets/images/fleet-07-branded.jpg" alt="A SafeLine Cruze in SafeLine livery, rear three-quarter view" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/safeline-fleet-side-branded.jpg" alt="The SafeLine door decal on a fleet Cruze" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/safeline-car-04.jpeg" alt="A SafeLine Cruze ready in the fleet bay" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/safeline-interior.jpg" alt="Inside a SafeLine car" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/safeline-car-06.jpeg" alt="SafeLine cars parked in the fleet bay" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/safeline-car-03.jpeg" alt="A SafeLine Cruze, front view" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/fleet-01-branded.jpg" alt="A liveried SafeLine Cruze from the rear" loading="lazy" decoding="async">
                    </figure>
                    <figure class="fleet-gallery__item">
                        <img src="assets/images/safeline-car-05.jpeg" alt="SafeLine vehicles lined up before a shift" loading="lazy" decoding="async">
                    </figure>
                </div>

                <p class="fleet-gallery__foot">
                    <?php te('taxi_gallery_foot_prefix'); ?>
                    <a href="/#download-app"><?php te('taxi_gallery_foot_book'); ?></a> <?php te('taxi_gallery_foot_or_call'); ?>
                    <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php echo $contact_phone; ?></a>.
                </p>
            </div>
        </section>

<?php include 'includes/footer.php'; ?>
