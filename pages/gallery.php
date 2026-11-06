<?php
$current_page = 'gallery';
include __DIR__ . '/../includes/config.php';
$page_title = t('gallery_page_title');
$meta_description = t('gallery_meta_description');
include __DIR__ . '/../includes/header.php';
?>

        <!-- GALLERY: vehicle photos staff curate in the admin panel's
             Vehicle Photo Library (same ones picked from when publishing an
             intercity trip) - loaded from /public/vehicle-photos, see
             gallery.js. Empty/error states handled there. -->
        <section class="sl-gallery section-space" id="gallery">
            <div class="container">
                <div class="sec-title sec-title--center">
                    <div class="sec-title__top">
                        <div class="sec-title__shape"></div>
                        <h6 class="sec-title__tagline"><?php te('gallery_tagline'); ?></h6>
                        <div class="sec-title__shape"></div>
                    </div>
                </div>
                <div class="sl-gallery__grid" id="gallery-grid"></div>
                <p class="sl-gallery__empty" id="gallery-empty" hidden><?php te('gallery_empty'); ?></p>
            </div>
        </section>

        <script src="<?php echo asset_url('assets/js/gallery.js'); ?>"></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
