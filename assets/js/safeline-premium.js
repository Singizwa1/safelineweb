/* SafeLine - premium motion layer (loaded on every page).
 *
 * 1. Staggered group reveals: one IntersectionObserver for every target;
 *    each target is unobserved after it reveals, so the observer's work
 *    shrinks to nothing as the page is read.
 * 2. Hero carousel: autoplays every DWELL ms; arrows, swipe/drag and the
 *    keyboard move it by hand. Autoplay holds while a control has keyboard
 *    focus, the hero is off screen or the browser tab is hidden, and never
 *    runs under reduced motion.
 *
 * 0. The light / dark switch runs regardless of motion settings.
 *
 * Content is never hidden without JS: the hidden state (.hp-reveal) is only
 * added here, and only when motion is allowed and IntersectionObserver
 * exists. Purely visual - no booking, pricing or API code is touched.
 */
(function () {
    "use strict";

    /* 0. Light / dark switch --------------------------------------------- */
    // The head script (includes/header.php) applies the saved theme before
    // paint; this only handles clicks. Delegated, because the theme clones
    // the header for the sticky bar, so the button exists twice.
    var root = document.documentElement;
    function syncToggles() {
        var light = root.getAttribute('data-theme') === 'light';
        document.querySelectorAll('.hp-theme-toggle').forEach(function (btn) {
            var label = btn.getAttribute(light ? 'data-label-dark' : 'data-label-light');
            btn.setAttribute('aria-label', label);
            btn.setAttribute('title', label);
            btn.setAttribute('aria-pressed', light ? 'true' : 'false');
        });
    }
    document.addEventListener('click', function (e) {
        if (!e.target.closest || !e.target.closest('.hp-theme-toggle')) { return; }
        var next = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
        root.setAttribute('data-theme', next);
        try { localStorage.setItem('safeline-theme', next); } catch (err) {}
        syncToggles();
    });
    // cityride.js clones the header on its own ready handler; sync both copies.
    syncToggles();
    window.addEventListener('load', syncToggles);

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion) { return; }

    /* 1. Staggered reveals ------------------------------------------------ */
    // Groups whose children cascade in. Elements already handled by WOW.js
    // or the site-wide .reveal script (includes/footer.php) are left out.
    var GROUPS = [
        '.sl-services__grid',
        '.sl-hiw__grid',
        '.sl-app-feats',
        '.sl-contact__grid'
    ];
    var STEP_MS = 60;    // delay between siblings
    var MAX_STEPS = 8;   // cap so long lists do not trail off

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting) {
                    entries[i].target.classList.add('hp-in');
                    io.unobserve(entries[i].target);
                }
            }
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

        var viewportH = window.innerHeight;
        document.querySelectorAll(GROUPS.join(',')).forEach(function (group) {
            // Lists and card grids cascade item by item.
            var items = group.children;
            for (var i = 0; i < items.length; i++) {
                var el = items[i];
                // Anything already on screen stays visible - no flash.
                if (el.getBoundingClientRect().top < viewportH) { continue; }
                el.classList.add('hp-reveal');
                el.style.setProperty('--hp-delay', (Math.min(i, MAX_STEPS) * STEP_MS) + 'ms');
                io.observe(el);
            }
        });
    }

    /* 2. Hero carousel ------------------------------------------------ */
    var hero = document.querySelector('.sl-hero');
    if (!hero) { return; }
    var copyBox = hero.querySelector('.sl-hero__copy');
    // Restored whenever rotation moves off a slide that overrode it (see
    // home-intercity.js's injectHeroSlides(), which appends a promo slide
    // for a published trip after this script has already run).
    var defaultCopyHtml = copyBox ? copyBox.innerHTML : '';
    var current = 0;
    var DWELL = 5000;
    var timer = null;
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var focused = false, onScreen = true;

    function held() { return reduce || focused || !onScreen || document.hidden; }
    function schedule() {
        window.clearTimeout(timer);
        if (!held()) { timer = window.setTimeout(function () { go(1); }, DWELL); }
    }
    function syncHold() {
        hero.classList.toggle('is-held', held());
        schedule();
    }
    // Re-queries every call instead of caching the list once - a slide
    // appended later (the intercity promo slide) joins rotation on the
    // very next advance instead of needing a page reload.
    function go(step) {
        var slides = hero.querySelectorAll('.sl-hero__slide');
        var total = slides.length;
        // Only one published trip replaced every default slide (see
        // home-intercity.js) - nothing to rotate to, and forcing is-prev +
        // is-active onto the same lone slide would fire both transition
        // animations on it at once.
        if (total <= 1) { schedule(); return; }
        var next = (current + step + total) % total;
        hero.style.setProperty('--dir', step < 0 ? -1 : 1);
        slides.forEach(function (slide, n) {
            slide.classList.remove('is-first');
            slide.classList.toggle('is-prev', n === current);
            slide.classList.toggle('is-active', n === next);
        });
        current = next;
        if (copyBox) {
            copyBox.innerHTML = slides[next].getAttribute('data-copy-html') || defaultCopyHtml;
        }
        schedule();
    }

    hero.querySelectorAll('.sl-hero__arrow').forEach(function (btn) {
        btn.addEventListener('click', function () { go(parseInt(btn.getAttribute('data-step'), 10)); });
    });
    hero.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight') { go(1); }
        else if (e.key === 'ArrowLeft') { go(-1); }
    });

    // Swipe (touch) and drag (mouse): a mostly-horizontal move of 50px+.
    var startX = null, startY = 0;
    hero.addEventListener('pointerdown', function (e) {
        if (e.target.closest('a, button')) { return; }
        startX = e.clientX; startY = e.clientY;
    });
    hero.addEventListener('pointerup', function (e) {
        if (startX === null) { return; }
        var dx = e.clientX - startX, dy = e.clientY - startY;
        startX = null;
        if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) { go(dx < 0 ? 1 : -1); }
    });
    hero.addEventListener('pointercancel', function () { startX = null; });

    // Hold autoplay while a control has keyboard focus.
    hero.addEventListener('focusin', function () { focused = true; syncHold(); });
    hero.addEventListener('focusout', function (e) {
        if (!hero.contains(e.relatedTarget)) { focused = false; syncHold(); }
    });
    document.addEventListener('visibilitychange', syncHold);
    if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (entries) {
            onScreen = entries[0].isIntersecting;
            syncHold();
        }).observe(hero);
    }
    syncHold();
    if (reduce) { return; }

    // Depth: on a mouse, the photo drifts up to 10px against the pointer.
    var layer = hero.querySelector('.sl-hero__slides');
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        var queued = false, px = 0, py = 0;
        hero.addEventListener('pointermove', function (e) {
            var r = hero.getBoundingClientRect();
            px = ((e.clientX - r.left) / r.width - 0.5) * -20;
            py = ((e.clientY - r.top) / r.height - 0.5) * -12;
            if (!queued) {
                queued = true;
                window.requestAnimationFrame(function () {
                    queued = false;
                    layer.style.setProperty('--hp-px', px.toFixed(1) + 'px');
                    layer.style.setProperty('--hp-py', py.toFixed(1) + 'px');
                });
            }
        }, { passive: true });
        hero.addEventListener('pointerleave', function () {
            layer.style.setProperty('--hp-px', '0px');
            layer.style.setProperty('--hp-py', '0px');
        });
    }
}());

/* How it works pop-ups ------------------------------------------------------
   Card buttons ([data-hiw-open]) and the header dropdown links (#hiw-ride,
   #hiw-intercity, #hiw-parcel) open the matching <dialog>. Esc, the close
   button and a click on the backdrop close it. */
(function () {
    var section = document.getElementById('how-it-works');
    if (!section || typeof HTMLDialogElement === 'undefined') { return; }
    var lastTrigger = null;

    function closeMobileNav() {
        var nav = document.querySelector('.mobile-nav__wrapper.expanded');
        if (nav) { nav.classList.remove('expanded'); document.body.classList.remove('locked'); }
    }
    function open(id, trigger) {
        var dlg = document.getElementById('hiw-modal-' + id);
        if (!dlg || dlg.open) { return; }
        lastTrigger = trigger || null;
        closeMobileNav();
        dlg.showModal();
        document.documentElement.classList.add('sl-hiw-lock');
    }

    document.querySelectorAll('.sl-hiw-modal').forEach(function (dlg) {
        dlg.addEventListener('close', function () {
            document.documentElement.classList.remove('sl-hiw-lock');
            if (lastTrigger && document.contains(lastTrigger)) { lastTrigger.focus(); }
        });
        // a click on the dimmed area (the <dialog> itself, outside the box) closes it
        dlg.addEventListener('click', function (e) { if (e.target === dlg) { dlg.close(); } });
    });

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-hiw-open]');
        if (btn) { open(btn.getAttribute('data-hiw-open'), btn); return; }

        if (e.target.closest('[data-hiw-close]')) { e.target.closest('dialog').close(); return; }

        // Intercity CTA: the trips list is hidden while no trips are published;
        // send people to the contact section instead.
        var cta = e.target.closest('[data-hiw-cta]');
        if (cta) {
            var dlg = cta.closest('dialog');
            if (cta.getAttribute('data-hiw-cta') === 'intercity') {
                var trips = document.getElementById('intercity');
                if (!trips || trips.hidden) { e.preventDefault(); dlg.close(); location.hash = 'contact'; return; }
            }
            if (cta.getAttribute('href').charAt(0) === '#') { document.documentElement.classList.remove('sl-hiw-lock'); dlg.close(); }
            return;
        }

        // header dropdown: /#hiw-ride etc.
        var link = e.target.closest('a[href*="#hiw-"]');
        if (link) {
            e.preventDefault();
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            open(link.getAttribute('href').split('#hiw-')[1], link);
        }
    });

    // arriving from another page with #hiw-... in the URL
    var m = location.hash.match(/^#hiw-(ride|intercity|parcel)$/);
    if (m) {
        section.scrollIntoView({ block: 'start' });
        open(m[1]);
    }
}());
