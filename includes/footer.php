<?php include_once 'config.php'; ?>
        <footer class="main-footer main-footer--two">
            <div class="main-footer__top main-footer__top--two">
                <div class="container">
                    <div class="row">

                        <!-- COLUMN 1: Brand + Social -->
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget footer-widget--about">
                                <a href="/" class="footer-widget__logo logo-retina">
                                    <img src="images/safelinelogo/safelinelogo.png" width="130" height="130" alt="<?php echo $brand_name; ?>" loading="lazy">
                                </a>
                                <p class="footer-widget__about-text"><?php te('footer_about_text'); ?></p>
                                <div class="footer-widget__social">
                                    <?php foreach($social_links as $platform => $url): if ($url === '' || $url === '#') { continue; } ?>
                                        <a href="<?php echo $url; ?>" class="footer-widget__social__<?php echo $platform; ?>" aria-label="<?php echo ucfirst($platform); ?>">
                                            <?php if ($platform === 'x'): ?>
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                            <?php else: ?>
                                                <i class="fab fa-<?php echo $platform; ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMN 2: Quick Links -->
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget footer-widget--links">
                                <h4 class="footer-widget__title"><?php te('footer_quick_links'); ?></h4>
                                <ul class="list-unstyled footer-widget__links">
                                    <li><a href="/about"><i class="fas fa-chevron-right"></i> <?php te('footer_link_about'); ?></a></li>
                                    <li><a href="/taxi"><i class="fas fa-chevron-right"></i> <?php te('footer_link_fleet'); ?></a></li>
                                    <li><a href="/how-it-works"><i class="fas fa-chevron-right"></i> <?php te('footer_link_how_it_works'); ?></a></li>
                                    <li><a href="/mission"><i class="fas fa-chevron-right"></i> <?php te('footer_link_mission'); ?></a></li>
                                    <li><a href="/safety"><i class="fas fa-chevron-right"></i> <?php te('footer_link_safety'); ?></a></li>
                                    <li><a href="/contact"><i class="fas fa-chevron-right"></i> <?php te('footer_link_contact'); ?></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- COLUMN 3: Contact Info -->
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget footer-widget--contact">
                                <h4 class="footer-widget__title"><?php te('footer_link_contact'); ?></h4>
                                <ul class="list-unstyled footer-widget__info">
                                    <li>
                                        <div class="footer-widget__info__icon"><i class="fas fa-phone-alt"></i></div>
                                        <div class="footer-widget__info__phones">
                                            <a href="tel:<?php echo str_replace(' ', '', $contact_phone); ?>"><?php echo $contact_phone; ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-widget__info__icon"><i class="fas fa-envelope"></i></div>
                                        <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                                    </li>
                                    <li>
                                        <div class="footer-widget__info__icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <span><?php echo $contact_address; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- COLUMN 4: Map -->
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                            <div class="footer-widget footer-widget--map">
                                <h4 class="footer-widget__title"><?php te('footer_our_location'); ?></h4>
                                <div class="footer-widget__map-wrap">
                                    <iframe title="<?php te('footer_map_title'); ?>"
                                            src="https://www.google.com/maps?q=Kigali%2C%20Rwanda&amp;output=embed&amp;z=12"
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="main-footer__bottom">
                <div class="container">
                    <div class="main-footer__bottom__inner">
                        <p class="main-footer__copyright">&copy; <?php echo date('Y'); ?> <?php echo $brand_name; ?>. <?php te('footer_rights_reserved'); ?></p>
                        <ul class="list-unstyled main-footer__bottom__list">
                            <?php /* Privacy Policy and Terms pages do not exist yet, so these
                                      linked to "#". Rendering them only once real pages are in
                                      place - a legal link that goes nowhere is worse than none.
                                      See DEPLOY-CPANEL.md. */ ?>
                        </ul>
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
                <a href="/" aria-label="logo image"><img src="images/safelinelogo/safelinelogo.png" width="76" height="76" alt="<?php echo $brand_name; ?>" /></a>
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
            '.hiw-tab', '.contact-strip__item', '.footer-widget',
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
