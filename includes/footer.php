<?php include_once 'config.php'; ?>
        <!-- FOOTER: brand, explore, contact (with a maps link instead of an
             embedded map), get the app; copyright and socials below. Navy in
             both themes - the brand frame. Styles: safeline-premium.css (14). -->
        <footer class="sl-footer">
            <div class="container">
                <div class="sl-footer__grid">
                    <div class="sl-footer__brand">
                        <a href="/" class="sl-footer__logo" aria-label="<?php echo $brand_name; ?>">
                            <img src="images/safelinelogo/safelinelogo-light.png" width="150" height="150" alt="<?php echo $brand_name; ?>" loading="lazy">
                        </a>
                        <p class="sl-footer__about"><?php te('footer_about_text'); ?></p>
                        <span class="sl-footer__badge"><?php te('footer_available'); ?></span>
                    </div>

                    <nav class="sl-footer__col" aria-label="<?php te('footer_explore'); ?>">
                        <h4 class="sl-footer__title"><?php te('footer_explore'); ?></h4>
                        <ul class="sl-footer__links">
                            <li><a href="/#services"><?php te('nav_services'); ?></a></li>
                            <li><a href="/#how-it-works"><?php te('nav_how_it_works'); ?></a></li>
                            <li><a href="/#testimonials"><?php te('nav_reviews'); ?></a></li>
                            <li><a href="/#download-app"><?php te('nav_get_app'); ?></a></li>
                            <li><a href="/#contact"><?php te('nav_contact'); ?></a></li>
                        </ul>
                    </nav>

                    <div class="sl-footer__col">
                        <h4 class="sl-footer__title"><?php te('footer_link_contact'); ?></h4>
                        <ul class="sl-footer__contact">
                            <li><a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i><span><?php echo $contact_phone; ?></span></a></li>
                            <li><a href="mailto:<?php echo $contact_email; ?>"><i class="fas fa-envelope" aria-hidden="true"></i><span><?php echo $contact_email; ?></span></a></li>
                            <li><a href="<?php echo $contact_maps_url; ?>" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt" aria-hidden="true"></i><span><?php echo $contact_address; ?><small><?php te('footer_open_maps'); ?> <i class="fas fa-external-link-alt" aria-hidden="true"></i></small></span></a></li>
                        </ul>
                    </div>

                    <div class="sl-footer__col">
                        <h4 class="sl-footer__title"><?php te('footer_get_app'); ?></h4>
                        <p class="sl-footer__app-text"><?php te('footer_app_text'); ?></p>
                        <div class="sl-footer__stores">
                            <a href="https://www.apple.com/app-store/" class="sl-footer__store" target="_blank" rel="noopener" aria-label="<?php te('home_app_store_aria'); ?>">
                                <svg class="store-badge__mark" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill="#FFFFFF" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/></svg>
                                <span><small><?php te('home_download_on_the'); ?></small><strong>App Store</strong></span>
                            </a>
                            <a href="https://play.google.com/" class="sl-footer__store" target="_blank" rel="noopener" aria-label="<?php te('home_play_store_aria'); ?>">
                                <svg class="store-badge__mark" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill="#00A0FF" d="M23.2 12.2C16.9 18.9 13.2 29.2 13.2 42.6v426.9c0 13.4 3.7 23.7 10.2 30.1l1.4 1.3 239.2-239.2v-5.6L24.6 10.8l-1.4 1.4z"/><path fill="#FFCE00" d="M343.1 335.7l-79.7-79.8v-5.7l79.8-79.8 1.8 1L439.6 225c27 15.3 27 40.5 0 55.9l-94.6 53.7-1.9 1.1z"/><path fill="#FF3A44" d="M345 334.6L263.4 253 23.2 493.2c8.9 9.4 23.6 10.6 40.2 1.2L345 334.6z"/><path fill="#00C853" d="M345 171.4L63.4 11.6C46.8 2.2 32.1 3.4 23.2 12.8L263.4 253 345 171.4z"/></svg>
                                <span><small><?php te('home_get_it_on'); ?></small><strong>Google Play</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-footer__bottom">
                <div class="container sl-footer__bottom-inner">
                    <p class="sl-footer__copy">&copy; <?php echo date('Y'); ?> <?php echo $brand_name; ?>. <?php te('footer_rights_reserved'); ?></p>
                    <?php /* Socials render only once real profile URLs are set in
                              config.php ($social_links); placeholders are skipped. */ ?>
                    <div class="sl-footer__social">
                        <?php foreach ($social_links as $platform => $url): if ($url === '' || $url === '#') { continue; } ?>
                            <a href="<?php echo $url; ?>" target="_blank" rel="noopener" aria-label="<?php echo ucfirst($platform); ?>"><i class="fab fa-<?php echo $platform === 'x' ? 'twitter' : $platform; ?>" aria-hidden="true"></i></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- /.page-wrapper -->

    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="/" aria-label="<?php echo $brand_name; ?>"><img src="images/safelinelogo/safelinelogo-light.png" width="76" height="76" alt="<?php echo $brand_name; ?>" /></a>
            </div>
            <div class="mobile-nav__container"></div>
            <ul class="mobile-nav__contact list-unstyled">
                <li><i class="fa fa-envelope"></i><a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></li>
                <li><i class="fa fa-phone-alt"></i><a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php echo $contact_phone; ?></a></li>
            </ul>
            <div class="mobile-nav__social">
                <?php foreach($social_links as $platform => $url): if ($url === '' || $url === '#') { continue; } ?>
                    <a href="<?php echo $url; ?>" <?php echo ($platform !== 'x') ? 'class="fab fa-' . $platform . '"' : ''; ?>>
                        <?php if ($platform === 'x'): ?>
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Page scroll control: jump to top / bottom -->
    <div class="safeline-scroll" id="safeline-scroll">
        <button type="button" class="safeline-scroll__btn" data-scroll="up" aria-label="<?php te('scroll_to_top'); ?>">
            <i class="fas fa-chevron-up" aria-hidden="true"></i>
        </button>
        <button type="button" class="safeline-scroll__btn" data-scroll="down" aria-label="<?php te('scroll_to_bottom'); ?>">
            <i class="fas fa-chevron-down" aria-hidden="true"></i>
        </button>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/imagesloaded/imagesloaded.min.js"></script>
    <script src="assets/vendors/isotope/isotope.js"></script>
<?php if (($current_page ?? '') === 'taxi'): ?>
    <!-- taxi-only vendors -->
    <script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/tiny-slider/tiny-slider.js"></script>
    <script src="assets/vendors/jquery-lettering/jquery.lettering.min.js"></script>
<?php endif; ?>
    <script src="assets/js/cityride.js"></script>
    <!-- Premium layer, every page: theme switch, staggered reveals, hero pointer depth -->
    <script src="<?php echo asset_url('assets/js/safeline-premium.js'); ?>" defer></script>

    <!-- Language switcher -->
    <script>
    (function safelineLangSwitch() {
        "use strict";
        var box = document.getElementById('lang-switch');
        if (!box) { return; }
        var toggle = box.querySelector('.lang-switch__toggle');
        var menu = box.querySelector('.lang-switch__menu');
        var items = Array.prototype.slice.call(menu.querySelectorAll('[data-lang]'));

        function open() {
            menu.hidden = false;
            box.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
            var sel = menu.querySelector('[aria-selected="true"]') || items[0];
            if (sel) { sel.focus(); }
        }
        function close(focusToggle) {
            menu.hidden = true;
            box.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            if (focusToggle) { toggle.focus(); }
        }
        function choose(li) {
            var code = li.getAttribute('data-lang');
            var url = new URL(window.location.href);
            url.searchParams.set('lang', code);
            url.hash = '';
            window.location.href = url.toString();
        }

        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.hidden ? open() : close(false);
        });
        items.forEach(function (li, i) {
            li.addEventListener('click', function () { choose(li); });
            li.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); choose(li); }
                else if (e.key === 'ArrowDown') { e.preventDefault(); (items[i + 1] || items[0]).focus(); }
                else if (e.key === 'ArrowUp') { e.preventDefault(); (items[i - 1] || items[items.length - 1]).focus(); }
                else if (e.key === 'Escape') { e.preventDefault(); close(true); }
            });
        });
        document.addEventListener('click', function (e) {
            if (!box.contains(e.target)) { close(false); }
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !menu.hidden) { close(true); }
        });
    }());
    </script>

    <!-- Scroll reveal: sections ease in as they enter the viewport -->
    <script>
    (function safelineScrollReveal() {
        "use strict";
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.classList.add('reveal-off');
            return;
        }
        if (!('IntersectionObserver' in window)) {
            document.documentElement.classList.add('reveal-off');
            return;
        }
        var SEL = [
            '.sec-title', '.service-card', '.fleet-card', '.testimonial-card',
            '.stats-bar__item', '.cta-feature-item', '.hiw-feature-card',
            '.hiw-tab', '.contact-strip__item', '.sl-footer__grid > *',
            '.download-app-three__btn', '.booking-cta-card', '.about-four__image',
            '.about-four__right', '.contact-faq__item'
        ].join(',');

        var targets = Array.prototype.slice.call(document.querySelectorAll(SEL))
            .filter(function (el) { return !el.closest('.owl-item.cloned'); });

        targets.forEach(function (el, i) {
            el.classList.add('reveal');
            el.style.setProperty('--reveal-delay', ((i % 4) * 70) + 'ms');
        });

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

        targets.forEach(function (el) { io.observe(el); });

        // anything already on screen at load reveals immediately, no flash
        window.setTimeout(function () {
            targets.forEach(function (el) {
                var r = el.getBoundingClientRect();
                if (r.top < window.innerHeight && r.bottom > 0) { el.classList.add('is-revealed'); }
            });
        }, 60);
    }());
    </script>

    <!-- Scroll control: top / bottom, replaces the percentage counter -->
    <script>
    (function safelineScrollCtrl() {
        "use strict";
        var box = document.getElementById('safeline-scroll');
        if (!box) { return; }
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        box.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-scroll]');
            if (!btn) { return; }
            var toBottom = btn.getAttribute('data-scroll') === 'down';
            window.scrollTo({
                top: toBottom ? document.documentElement.scrollHeight : 0,
                behavior: reduce ? 'auto' : 'smooth'
            });
        });
        function sync() {
            var y = window.scrollY || document.documentElement.scrollTop;
            var max = document.documentElement.scrollHeight - window.innerHeight;
            box.classList.toggle('is-visible', y > 250);
            // Hide "up" at the very top and "down" at the very bottom.
            box.querySelector('[data-scroll="up"]').hidden = y < 250;
            box.querySelector('[data-scroll="down"]').hidden = (max - y) < 250;
        }
        window.addEventListener('scroll', sync, { passive: true });
        window.addEventListener('resize', sync);
        sync();
    }());
    </script>

    <!-- Reveal failsafe: WOW.js hides every .wow element until it scrolls into
         view. If that reveal never fires (script error, blocked vendor asset,
         throttled tab, odd viewport) the page renders as large blank bands.
         This rescues anything that is already past the fold but still hidden,
         so the scroll-in animation is kept for content further down. -->
    <script>
    (function () {
        "use strict";

        function rescue() {
            var nodes = document.querySelectorAll('.wow');
            var limit = window.innerHeight + 200;   // only what should already be shown
            for (var i = 0; i < nodes.length; i++) {
                var el = nodes[i];
                if (el.closest && el.closest('.owl-item')) { continue; }  // carousels manage their own slides
                if (el.getBoundingClientRect().top > limit) { continue; } // still below the fold, leave it animating
                var cs = getComputedStyle(el);
                if (cs.visibility === 'hidden' || parseFloat(cs.opacity) < 0.05) {
                    el.style.visibility = 'visible';
                    el.style.opacity = '1';
                    el.style.animationName = 'none';
                    el.classList.add('safeline-revealed');
                }
            }
        }

        function revealEverything() {          // printing or page-hide: no animation to wait for
            var nodes = document.querySelectorAll('.wow');
            for (var i = 0; i < nodes.length; i++) {
                nodes[i].style.visibility = 'visible';
                nodes[i].style.opacity = '1';
            }
        }

        // Deliberately a timer, not requestAnimationFrame: rAF is suspended in
        // background/non-compositing tabs, which is exactly when this failsafe
        // needs to work.
        var ticking = false;
        function onScroll() {
            if (ticking) { return; }
            ticking = true;
            setTimeout(function () { rescue(); ticking = false; }, 60);
        }

        if (document.readyState === 'complete') {
            setTimeout(rescue, 1200);
        } else {
            window.addEventListener('load', function () { setTimeout(rescue, 1200); });
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        window.addEventListener('beforeprint', revealEverything);
    }());
    </script>
</body>
</html>
