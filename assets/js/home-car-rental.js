(function () {
    var categoriesById = {};
    /** ratesByCategory[categoryId][mode] = price row (hour/day/week/month, some null). */
    var ratesByCategory = {};

    function loadRentalRates(attempt) {
        Promise.all([
            fetch(SAFELINE_API_BASE + '/public/vehicle-categories?limit=100').then(function (r) { return r.json(); }),
            fetch(SAFELINE_API_BASE + '/public/rental-prices?limit=100').then(function (r) { return r.json(); }),
        ])
            .then(function (results) {
                var categories = (results[0] && results[0].success && results[0].data) || [];
                var prices = (results[1] && results[1].success && results[1].data) || [];

                ratesByCategory = {};
                prices.forEach(function (p) {
                    if (p.status !== 'active') return;
                    ratesByCategory[p.category_id] = ratesByCategory[p.category_id] || {};
                    ratesByCategory[p.category_id][p.mode] = p;
                });

                var eligible = categories.filter(function (c) {
                    return c.status === 'active' && Number(c.allow_rental) === 1 && ratesByCategory[c.id];
                });
                eligible.forEach(function (c) { categoriesById[c.id] = c; });

                // The homepage only teases the first few; the full catalogue
                // lives on its own page (window.SL_SHOW_ALL_RENTALS, set
                // inline by car-rental.php before this file loads).
                var showAll = window.SL_SHOW_ALL_RENTALS === true;
                var visible = showAll ? eligible : eligible.slice(0, 3);
                var cards = visible.map(renderCard).join('');

                var section = document.getElementById('car-rental');
                var list = document.getElementById('car-rental-list');
                section.hidden = !cards;
                if (cards) list.innerHTML = cards;
                var viewMoreBox = document.getElementById('car-rental-view-more');
                if (viewMoreBox) viewMoreBox.hidden = showAll || eligible.length <= 3;
            })
            .catch(function () {
                if (attempt < 2) setTimeout(function () { loadRentalRates(attempt + 1); }, 1200);
            });
    }

    function rateLine(label, price, suffix) {
        if (price === undefined || price === null) return '';
        return '<li class="rental-card__rate"><span>' + label + '</span>' +
            '<strong>' + parseFloat(price).toLocaleString() + ' RWF<small>' + suffix + '</small></strong></li>';
    }

    /** Every tier staff actually set (hour/day/week/month) - a category
     * isn't required to price all four, so each line only shows up when
     * that tier has a value. price_per_day is the only one guaranteed
     * non-null server-side (see RentalPricingController::store()). */
    function modeRatesHtml(categoryId, mode, price, isActive) {
        return '<div class="rental-card__mode" data-mode-panel="' + mode + '"' + (isActive ? '' : ' hidden') + '>' +
            '<ul class="rental-card__rates">' +
            rateLine(jsT('car_rental_hour_label'), price.price_per_hour, jsT('car_rental_per_hour_suffix')) +
            rateLine(jsT('car_rental_day_label'), price.price_per_day, jsT('car_rental_per_day_suffix')) +
            rateLine(jsT('car_rental_week_label'), price.price_per_week, jsT('car_rental_per_week_suffix')) +
            rateLine(jsT('car_rental_month_label'), price.price_per_month, jsT('car_rental_per_month_suffix')) +
            '</ul>' +
            '<button type="button" class="cityride-btn cityride-btn--primary rental-card__book-btn" data-category-id="' + categoryId + '" data-mode="' + mode + '">' + jsT('car_rental_cta') + '</button>' +
            '</div>';
    }

    function renderCard(category) {
        var rates = ratesByCategory[category.id];
        var imageHtml = category.image_key
            ? '<img class="rental-card__media" src="' + SAFELINE_API_BASE + '/uploads/' + category.image_key + '" alt="" loading="lazy">'
            : '';

        var modes = [];
        if (rates.self_drive) modes.push({ key: 'self_drive', label: jsT('car_rental_self_drive'), price: rates.self_drive });
        if (rates.with_driver) modes.push({ key: 'with_driver', label: jsT('car_rental_with_driver'), price: rates.with_driver });

        var togglesHtml = '';
        if (modes.length > 1) {
            togglesHtml = '<div class="rental-card__modes" role="tablist">' +
                modes.map(function (m, i) {
                    return '<button type="button" class="rental-card__mode-btn' + (i === 0 ? ' is-active' : '') + '" data-mode-toggle="' + m.key + '">' + m.label + '</button>';
                }).join('') +
                '</div>';
        }

        var panelsHtml = modes.map(function (m, i) {
            return modeRatesHtml(category.id, m.key, m.price, i === 0);
        }).join('');

        return '<div class="col-lg-4 col-md-6">' +
            '<div class="rental-card">' +
            imageHtml +
            '<h4 class="rental-card__title">' + category.name + '</h4>' +
            togglesHtml +
            panelsHtml +
            '</div></div>';
    }

    // ---------------------------------------------------------------
    // Booking modal - two steps (details, then payment), same shape as
    // the Intercity modal in home-intercity.js. Self-service, no app
    // account needed (POST /public/rentals).
    // ---------------------------------------------------------------

    var DURATION_UNITS = ['hour', 'day', 'week', 'month'];
    var currentCategoryId = null;
    var currentMode = null;
    var currentRate = null;

    function unitLabelKey(unit) { return 'car_rental_' + unit + '_label'; }
    function unitSuffixKey(unit) { return 'car_rental_per_' + unit + '_suffix'; }

    function updateRentalTotal() {
        var unit = document.getElementById('rental_duration_unit').value;
        var count = parseInt(document.getElementById('rental_duration_count').value, 10) || 1;
        var rate = parseFloat(currentRate[unit === 'hour' ? 'price_per_hour' : unit === 'day' ? 'price_per_day' : unit === 'week' ? 'price_per_week' : 'price_per_month']);
        var total = rate * count;
        document.getElementById('rental_price_amount').textContent = rate.toLocaleString() + ' RWF' + jsT(unitSuffixKey(unit));
        document.getElementById('rental_total_amount').textContent = total.toLocaleString() + ' RWF';
    }

    function openRentalModal(categoryId, mode) {
        var category = categoriesById[categoryId];
        var rate = ratesByCategory[categoryId] && ratesByCategory[categoryId][mode];
        if (!category || !rate) return;

        currentCategoryId = categoryId;
        currentMode = mode;
        currentRate = rate;

        document.getElementById('rental-booking-form').reset();
        document.getElementById('rental_phone_error').hidden = true;
        document.getElementById('rental_payment_phone_error').hidden = true;
        document.getElementById('rental_pickup_location_error').hidden = true;
        selectNetwork('rental_payment_phone_network', 'mtn');

        document.getElementById('rental-modal-title').textContent = category.name + ' – ' + jsT(mode === 'self_drive' ? 'car_rental_self_drive' : 'car_rental_with_driver');

        var unitSelect = document.getElementById('rental_duration_unit');
        var availableUnits = DURATION_UNITS.filter(function (u) {
            var col = u === 'hour' ? 'price_per_hour' : u === 'day' ? 'price_per_day' : u === 'week' ? 'price_per_week' : 'price_per_month';
            return rate[col] !== null && rate[col] !== undefined;
        });
        unitSelect.innerHTML = availableUnits.map(function (u) {
            return '<option value="' + u + '">' + jsT(unitLabelKey(u)) + '</option>';
        }).join('');
        document.getElementById('rental_duration_count').value = '1';
        updateRentalTotal();

        // Pickup location only matters for with_driver - self-drive pickup
        // location is settled with staff once the request is confirmed (see
        // RentalController::assignVehicle() server-side).
        var isWithDriver = mode === 'with_driver';
        document.getElementById('rental_pickup_location_row').hidden = !isWithDriver;
        document.getElementById('rental_pickup_location').required = isWithDriver;

        var minPickup = new Date(Date.now() + 60 * 60000);
        var pad2 = function (n) { return (n < 10 ? '0' : '') + n; };
        document.getElementById('rental_pickup_datetime').min = minPickup.getFullYear() + '-' + pad2(minPickup.getMonth() + 1) + '-' + pad2(minPickup.getDate()) +
            'T' + pad2(minPickup.getHours()) + ':' + pad2(minPickup.getMinutes());

        showRentalDetailsStep();
        hideRentalBanner();
        document.getElementById('rental-modal').classList.add('active');
    }

    function closeRentalModal() {
        document.getElementById('rental-modal').classList.remove('active');
    }

    function showRentalPaymentStep() {
        document.getElementById('rental_step_details').hidden = true;
        document.getElementById('rental_step_payment').hidden = false;
        document.getElementById('rental-modal-title-step').textContent = jsT('ic_payment_step_title');
        var paymentField = document.getElementById('rental_payment_phone_number');
        if (paymentField.value === '') {
            paymentField.value = document.getElementById('rental_phone_number').value.trim();
        }
        paymentField.focus();
    }

    function showRentalDetailsStep() {
        document.getElementById('rental_step_payment').hidden = true;
        document.getElementById('rental_step_details').hidden = false;
        document.getElementById('rental-modal-title-step').textContent = '';
    }

    var rentalPaymentLocked = false;
    function setRentalFormLocked(locked) {
        document.querySelectorAll('#rental-booking-form input, #rental-booking-form select, #rental-booking-form button')
            .forEach(function (el) { el.disabled = locked; });
    }

    function showRentalBanner(kind, title, text) {
        var banner = document.getElementById('rental-banner');
        banner.className = 'form-banner is-' + kind;
        banner.hidden = false;
        banner.querySelector('.form-banner__title').textContent = title;
        banner.querySelector('.form-banner__text').textContent = text;
        banner.querySelector('.form-banner__close').hidden = kind === 'pending';
    }
    function hideRentalBanner() { document.getElementById('rental-banner').hidden = true; }

    function watchRentalPayment(code) {
        rentalPaymentLocked = true;
        setRentalFormLocked(true);
        showRentalBanner('pending', jsT('ic_status_waiting_title'), jsT('car_rental_status_waiting_text'));

        var giveUpAt = Date.now() + 5 * 60000 + 20000;
        var shownAt = Date.now();
        var ussdHintShown = false;

        function unlock() {
            rentalPaymentLocked = false;
            setRentalFormLocked(false);
        }

        function tick() {
            fetch(SAFELINE_API_BASE + '/public/rentals/' + code + '/status')
                .then(function (r) { return r.json(); })
                .then(function (res) {
                    var charge = res && res.success ? res.data : null;
                    if (!charge) {
                        console.error('rental status check failed:', res && res.message);
                    } else if (charge.status === 'paid') {
                        unlock();
                        closeRentalModal();
                        showRentalToast(jsT('car_rental_toast_booked_title'), jsT('car_rental_toast_booked_text', { code: code }));
                        return;
                    } else if (charge.status !== 'pending') {
                        unlock();
                        showRentalBanner('error', jsT('ic_status_failed_title'), jsT('ic_status_failed_text'));
                        return;
                    }
                    if (Date.now() > giveUpAt) {
                        unlock();
                        showRentalBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_timeout_text', { code: code }));
                        return;
                    }
                    if (!ussdHintShown && Date.now() - shownAt > 30000) {
                        ussdHintShown = true;
                        showRentalBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_ussd_hint'));
                    }
                    setTimeout(tick, 6000);
                })
                .catch(function () {
                    if (Date.now() > giveUpAt) {
                        unlock();
                        showRentalBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_timeout_text', { code: code }));
                        return;
                    }
                    setTimeout(tick, 6000);
                });
        }

        setTimeout(tick, 6000);
    }

    function showRentalToast(title, text) {
        var existing = document.querySelector('.intercity-toast');
        if (existing) existing.remove();
        var toast = document.createElement('div');
        toast.className = 'intercity-toast';
        toast.innerHTML =
            '<span class="intercity-toast__icon" aria-hidden="true"></span>' +
            '<span class="intercity-toast__body">' +
            '<span class="intercity-toast__title"></span>' +
            '<p class="intercity-toast__text"></p>' +
            '</span>';
        toast.querySelector('.intercity-toast__title').textContent = title;
        toast.querySelector('.intercity-toast__text').textContent = text;
        document.body.appendChild(toast);
        requestAnimationFrame(function () { toast.classList.add('is-visible'); });
        setTimeout(function () {
            toast.classList.remove('is-visible');
            setTimeout(function () { toast.remove(); }, 300);
        }, 5000);
    }

    document.addEventListener('click', function (e) {
        var bookBtn = e.target.closest('.rental-card__book-btn');
        if (bookBtn) {
            openRentalModal(parseInt(bookBtn.dataset.categoryId, 10), bookBtn.dataset.mode);
        }
        var modeToggleBtn = e.target.closest('[data-mode-toggle]');
        if (modeToggleBtn) {
            var card = modeToggleBtn.closest('.rental-card');
            var mode = modeToggleBtn.dataset.modeToggle;
            card.querySelectorAll('.rental-card__mode-btn').forEach(function (btn) {
                btn.classList.toggle('is-active', btn === modeToggleBtn);
            });
            card.querySelectorAll('[data-mode-panel]').forEach(function (panel) {
                panel.hidden = panel.dataset.modePanel !== mode;
            });
        }
        if (e.target.closest('[data-rental-close]') || e.target.closest('#rental-banner .form-banner__close')) {
            if (e.target.closest('#rental-banner .form-banner__close')) {
                hideRentalBanner();
            } else if (!rentalPaymentLocked) {
                closeRentalModal();
            }
        }
        if (e.target.closest('#rental_continue_btn')) {
            hideRentalBanner();
            var nameField = document.getElementById('rental_guest_name');
            var contactField = document.getElementById('rental_phone_number');
            var contactOk = validatePhoneField('rental_phone_number', 'rental_phone_error', true);
            if (!nameField.value.trim()) { nameField.focus(); return; }
            if (!contactOk) { contactField.focus(); return; }
            if (!document.getElementById('rental_pickup_datetime').value) {
                document.getElementById('rental_pickup_datetime').focus();
                return;
            }
            if (currentMode === 'with_driver') {
                var locField = document.getElementById('rental_pickup_location');
                var locError = document.getElementById('rental_pickup_location_error');
                locError.hidden = !!locField.value.trim();
                if (!locField.value.trim()) { locField.focus(); return; }
            }
            showRentalPaymentStep();
        }
        if (e.target.closest('#rental_back_btn')) {
            hideRentalBanner();
            showRentalDetailsStep();
        }
        var pill = e.target.closest('#rental_payment_phone_network .network-toggle__pill');
        if (pill) {
            var toggle = pill.closest('.network-toggle');
            var network = pill.dataset.network;
            selectNetwork(toggle.id, network);
            validatePhoneField('rental_payment_phone_number', 'rental_payment_phone_error', false, network);
        }
    });

    document.addEventListener('change', function (e) {
        if (e.target.id === 'rental_duration_unit' || e.target.id === 'rental_duration_count') updateRentalTotal();
    });
    document.addEventListener('input', function (e) {
        if (e.target.id === 'rental_duration_count') updateRentalTotal();
        if (e.target.id === 'rental_phone_number') {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 9);
            validatePhoneField('rental_phone_number', 'rental_phone_error', false);
        }
        if (e.target.id === 'rental_payment_phone_number') {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 9);
            validatePhoneField('rental_payment_phone_number', 'rental_payment_phone_error', false, selectedNetwork('rental_payment_phone_network'));
        }
    });
    document.addEventListener('blur', function (e) {
        if (e.target.id === 'rental_phone_number') validatePhoneField('rental_phone_number', 'rental_phone_error', true);
        if (e.target.id === 'rental_payment_phone_number') validatePhoneField('rental_payment_phone_number', 'rental_payment_phone_error', true, selectedNetwork('rental_payment_phone_network'));
    }, true);

    document.addEventListener('submit', function (e) {
        if (e.target.id !== 'rental-booking-form') return;
        e.preventDefault();
        hideRentalBanner();

        var paymentField = document.getElementById('rental_payment_phone_number');
        var localPaymentPhone = paymentField.value.trim();
        if (!validatePhoneField('rental_payment_phone_number', 'rental_payment_phone_error', true, selectedNetwork('rental_payment_phone_network'))) {
            paymentField.focus();
            return;
        }

        var submitBtn = document.getElementById('rental_pay_btn');
        submitBtn.disabled = true;

        var body = {
            category_id: currentCategoryId,
            mode: currentMode,
            duration_unit: document.getElementById('rental_duration_unit').value,
            duration_count: parseInt(document.getElementById('rental_duration_count').value, 10) || 1,
            pickup_datetime: document.getElementById('rental_pickup_datetime').value.replace('T', ' ') + ':00',
            pickup_location: document.getElementById('rental_pickup_location').value.trim(),
            guest_name: document.getElementById('rental_guest_name').value.trim(),
            phone_number: '+250' + document.getElementById('rental_phone_number').value.trim(),
            payment_phone_number: '+250' + localPaymentPhone,
        };

        fetch(SAFELINE_API_BASE + '/public/rentals', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
        })
            .then(function (r) { return r.json().then(function (data) { return { ok: r.ok, status: r.status, data: data }; }); })
            .then(function (res) {
                submitBtn.disabled = false;
                if (!res.ok || !res.data.success) {
                    var code = res.data && res.data.code;
                    var errText = code && SAFELINE_I18N['car_rental_err_code_' + code]
                        ? jsT('car_rental_err_code_' + code)
                        : jsT('ic_err_please_try_again');
                    showRentalBanner('error', jsT('ic_err_booking_title'), errText);
                    return;
                }

                if (res.status === 202) {
                    watchRentalPayment(res.data.data.rental_code);
                    return;
                }

                closeRentalModal();
                showRentalToast(jsT('car_rental_toast_booked_title'), jsT('car_rental_toast_booked_text', { code: res.data.data.rental_code }));
            })
            .catch(function () {
                submitBtn.disabled = false;
                showRentalBanner('error', jsT('ic_err_went_wrong_title'), jsT('ic_err_server_unreachable'));
            });
    });

    document.addEventListener('DOMContentLoaded', function () { loadRentalRates(0); });
})();
