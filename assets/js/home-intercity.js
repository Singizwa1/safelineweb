(function () {
    var heroInjected = false;
    var tripsById = {};

   
    function loadTrips(attempt) {
        fetch(SAFELINE_API_BASE + '/public/intercity-trips')
            .then(function (r) {
                if (!r.ok) throw new Error('bad status');
                return r.json();
            })
            .then(function (result) {
                var trips = (result && result.success && result.data) || [];
                trips.forEach(function (t) { tripsById[t.id] = t; });

                var section = document.getElementById('intercity');
                var list = document.getElementById('intercity-trip-list');
                section.hidden = !trips.length;
                if (trips.length) list.innerHTML = trips.map(renderCard).join('');

                updateRideCtas(trips.length > 0);
                if (trips.length && !heroInjected) {
                    injectHeroSlides(trips);
                    heroInjected = true;
                }
            })
            .catch(function () {
                if (attempt < 2) setTimeout(function () { loadTrips(attempt + 1); }, 1200);
            });
    }

    /** Every "Book a Taxi"/ride CTA on this page (tagged js-ride-cta) points
     * at the app when nothing is bookable here, and at the Intercity section
     * once a real seat is published - the site never implies a booking that
     * doesn't exist. */
    function updateRideCtas(hasTrips) {
        document.querySelectorAll('.js-ride-cta').forEach(function (el) {
            if (!el.dataset.defaultHref) el.dataset.defaultHref = el.getAttribute('href');
            el.setAttribute('href', hasTrips ? '#intercity' : el.dataset.defaultHref);
        });
    }

 
    function injectHeroSlides(trips) {
        if (typeof jQuery === 'undefined') return;
        var $hero = jQuery('.main-slider-one__carousel');
        if (!$hero.length) return;

        var owl = $hero.data('owl.carousel');
        var staticCount = owl ? owl.items().length : 0;
        for (var i = staticCount - 1; i >= 0; i--) {
            $hero.trigger('remove.owl.carousel', [i]);
        }

        trips.forEach(function (trip, i) {
            var departure = new Date(trip.departure_datetime.replace(' ', 'T'));
            var when = departure.toLocaleString('en-GB', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
            var price = parseFloat(trip.price_per_seat).toLocaleString();
            // Same waitlist detection as renderCard() below - a trip with 0
            // truly-free seats but a pending-payment hold still reaches this
            // slide (the API keeps it public so it's still joinable via the
            // waiting list), so the copy/button here has to say that instead
            // of implying a seat can be booked outright.
            var pending = trip.pending_seats || 0;
            var waitlistOnly = trip.seats_available === 0 && pending > 0;
            var subTitle = waitlistOnly ? jsT('ic_badge_fully_booked') : jsT('ic_badge_available');
            var seatsLine = waitlistOnly
                ? jsT(pending === 1 ? 'ic_fully_booked_pending_one' : 'ic_fully_booked_pending_many', { n: pending })
                : jsT(trip.seats_available === 1 ? 'ic_seats_left_one' : 'ic_seats_left_many', { n: trip.seats_available });
            var buttonClass = waitlistOnly ? 'intercity-waitlist-btn' : 'intercity-book-btn';
            var buttonLabel = waitlistOnly ? jsT('ic_btn_join_waitlist') : jsT('ic_btn_book_this_seat');
            var slide =
                '<div class="main-slider-one__item intercity-hero-slide" data-trip-id="' + trip.id + '">' +
                '<div class="main-slider-one__bg" style="background-image: url(assets/images/backgrounds/main-slider-bg-1-1.jpg);"></div>' +
                '<div class="container"><div class="row gutter-y-50"><div class="main-slider-one__col-content"><div class="main-slider-one__content">' +
                '<div class="main-slider-one__top"><p class="main-slider-one__sub-title"><span class="main-slider-one__sub-title__icon"><i class="fas fa-route" aria-hidden="true"></i></span><span class="main-slider-one__sub-title__text">' + subTitle + '</span></p><span class="intercity-seats-chip">' + seatsLine + '</span></div>' +
                '<h2 class="main-slider-one__title">' + trip.origin + ' &rarr; ' + trip.destination + '</h2>' +
                '<p class="main-slider-one__text">' + jsT('ic_departs', { when: when }) + ' &middot; ' + jsT('ic_price_per_seat', { price: price }) + '</p>' +
                '<div class="main-slider-one__button">' +
                '<button type="button" class="main-slider-one__btn cityride-btn cityride-btn--primary ' + buttonClass + '"><span>' + buttonLabel + '</span></button>' +
                '<a href="#intercity" class="main-slider-one__btn cityride-btn cityride-btn--border"><span>' + jsT('ic_btn_see_all_trips') + '</span></a>' +
                '</div></div></div>' +
                '<div class="main-slider-one__col-aside"><div class="hero-lane" aria-hidden="true"><img class="hero-lane__car" src="assets/images/safeline-rav4-side.png" alt="" decoding="async"></div></div>' +
                '</div></div></div>';
            $hero.trigger('add.owl.carousel', [jQuery(slide).get(0), i]);
        });
        $hero.trigger('refresh.owl.carousel');
    }

    function renderCard(trip) {
        var departure = new Date(trip.departure_datetime.replace(' ', 'T'));
        var when = departure.toLocaleString('en-GB', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
        var price = parseFloat(trip.price_per_seat).toLocaleString();
        var pickupPoints = trip.pickup_locations || [];
        var pickupLine = pickupPoints.length
            ? '<li><i class="fas fa-map-marker-alt"></i>' + jsT('ic_pickup', { places: pickupPoints.map(function (p) { return p.location; }).join(', ') }) + '</li>'
            : '';
        var pending = trip.pending_seats || 0;
        var waitlistOnly = trip.seats_available === 0 && pending > 0;
        var badgeText = waitlistOnly
            ? jsT(pending === 1 ? 'ic_badge_0left_pending_one' : 'ic_badge_0left_pending_many', { n: pending })
            : jsT(trip.seats_available === 1 ? 'ic_seats_left_one' : 'ic_seats_left_many', { n: trip.seats_available });
        var buttonHtml = waitlistOnly
            ? '<button type="button" class="cityride-btn cityride-btn--primary intercity-waitlist-btn">' + jsT('ic_btn_join_waitlist') + '</button>'
            : '<button type="button" class="cityride-btn cityride-btn--primary intercity-book-btn">' + jsT('ic_btn_book_seat') + '</button>';
        return '<div class="col-lg-4 col-md-6">' +
            '<div class="intercity-trip-card" data-trip-id="' + trip.id + '">' +
            '<span class="intercity-trip-card__badge">' + badgeText + '</span>' +
            '<h4 class="intercity-trip-card__route">' + trip.origin + ' <i class="fas fa-arrow-right"></i> ' + trip.destination + '</h4>' +
            '<ul class="intercity-trip-card__meta">' +
            pickupLine +
            '<li><i class="fas fa-flag-checkered"></i>' + jsT('ic_dropoff', { location: trip.dropoff_location }) + '</li>' +
            '<li><i class="fas fa-clock"></i>' + jsT('ic_departs', { when: when }) + '</li>' +
            '</ul>' +
            '<div class="intercity-trip-card__footer">' +
            '<span class="intercity-trip-card__price">' + price + ' RWF<small>/seat</small></span>' +
            buttonHtml +
            '</div></div></div>';
    }

    /** A booking can't claim more seats than this in one go, even when more are available (mirrors MAX_SEATS_PER_BOOKING server-side - the server still re-checks this, this is just so the picker doesn't offer more than it can accept). */
    var MAX_SEATS_PER_BOOKING = 8;

    /** 'book' (the normal pay-now/pay-later flow) or 'waitlist' (trip has no
     * truly-free seats left, only pending-payment ones that might still be
     * released) - set by openModal(), read by the submit handler to decide
     * which endpoint to call. */
    var modalMode = 'book';

    /** True while a pay-now charge is awaiting the guest's approval - the
     * modal is locked (no manual close, form disabled) so it isn't lost
     * mid-payment; watchPendingPayment() clears it once the charge
     * resolves one way or the other. */
    var paymentLocked = false;

    function setFormLocked(locked) {
        document.querySelectorAll('#intercity-booking-form input, #intercity-booking-form select, #intercity-booking-form button')
            .forEach(function (el) { el.disabled = locked; });
    }

    /** The passenger types the seat count directly (no dropdown) - this
     * reads it back clamped to a valid 1..max range, so a stray value
     * (blank, 0, way too many) never breaks the total display or slips
     * through to submit. Returns the clamped number and writes it back
     * into the field so what's displayed always matches what's used. */
    function clampedSeatCount() {
        var field = document.getElementById('intercity_seat_count');
        var max = parseInt(field.max, 10) || MAX_SEATS_PER_BOOKING;
        var raw = parseInt(field.value, 10);
        if (!raw || raw < 1) raw = 1;
        if (raw > max) raw = max;
        return raw;
    }

    function updateIntercityTotal() {
        var trip = tripsById[parseInt(document.getElementById('intercity_trip_id').value, 10)];
        if (!trip) return;
        var seats = clampedSeatCount();
        var perSeat = parseFloat(trip.price_per_seat);
        document.getElementById('intercity_price_amount').textContent = perSeat.toLocaleString() + ' RWF';

        var pendingRow = document.getElementById('intercity_pending_row');
        if (trip.pending_seats > 0) {
            pendingRow.hidden = false;
            document.getElementById('intercity_pending_text').textContent = jsT(trip.pending_seats === 1 ? 'ic_seats_left_one' : 'ic_seats_left_many', { n: trip.pending_seats });
        } else {
            pendingRow.hidden = true;
        }

        if (modalMode === 'waitlist') {
            document.getElementById('intercity_total_label').textContent = jsT('ic_price_per_seat_if_opens');
            document.getElementById('intercity_total_amount').textContent = perSeat.toLocaleString() + ' RWF';
        } else {
            document.getElementById('intercity_total_label').textContent = seats === 1 ? jsT('ic_total') : jsT('ic_total_n_seats', { n: seats });
            document.getElementById('intercity_total_amount').textContent = (perSeat * seats).toLocaleString() + ' RWF';
        }

        var max = parseInt(document.getElementById('intercity_seat_count').max, 10) || MAX_SEATS_PER_BOOKING;
        var errorEl = document.getElementById('intercity_seat_count_error');
        var typedValue = parseInt(document.getElementById('intercity_seat_count').value, 10);
        if (typedValue && typedValue > max) {
            errorEl.textContent = jsT(modalMode === 'waitlist' ? 'ic_only_n_seats_waitlist' : 'ic_only_n_seats_available', { max: max });
            errorEl.hidden = false;
        } else {
            errorEl.hidden = true;
        }
    }

    function openModal(tripId) {
        var trip = tripsById[tripId];
        if (!trip) return;
        var departure = new Date(trip.departure_datetime.replace(' ', 'T'));
        var when = departure.toLocaleString('en-GB', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });

        modalMode = (trip.seats_available === 0 && (trip.pending_seats || 0) > 0) ? 'waitlist' : 'book';

        document.getElementById('intercity-booking-form').reset();
        document.getElementById('intercity_phone_error').hidden = true;
        document.getElementById('intercity_seat_count_error').hidden = true;
        document.getElementById('intercity_trip_id').value = tripId;
        document.getElementById('intercity_dropoff_text').textContent = trip.dropoff_location;
        document.getElementById('intercity-modal-subtitle').textContent = jsT('ic_modal_subtitle', { origin: trip.origin, destination: trip.destination, when: when });
        document.getElementById('intercity-modal-title').textContent = modalMode === 'waitlist' ? jsT('ic_btn_join_waitlist') : jsT('ic_modal_title_book');
        document.getElementById('intercity_payment_option_row').hidden = modalMode === 'waitlist';
        document.querySelector('#intercity-booking-form .submit-btn-enhanced').textContent =
            modalMode === 'waitlist' ? jsT('ic_btn_join_waitlist') : jsT('ic_modal_submit_book');

        var maxSeats = modalMode === 'waitlist'
            ? MAX_SEATS_PER_BOOKING
            : Math.max(1, Math.min(trip.seats_available, MAX_SEATS_PER_BOOKING));
        var seatField = document.getElementById('intercity_seat_count');
        seatField.max = maxSeats;
        seatField.value = '1';
        updateIntercityTotal();

        var pickupPoints = trip.pickup_locations || [];
        var pickupSelect = document.getElementById('intercity_pickup_point');
        pickupSelect.innerHTML = pickupPoints.map(function (p) {
            return '<option value="' + p.id + '">' + p.location + '</option>';
        }).join('');
        pickupSelect.required = pickupPoints.length > 0;
        document.getElementById('intercity_pickup_row').hidden = pickupPoints.length === 0;

        hideBanner();
        document.getElementById('intercity-modal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('intercity-modal').classList.remove('active');
    }

    /** Success confirmation shown after the modal has already closed - unlike
     * showBanner() (inline, inside the still-open form), this floats over
     * the page so it's visible once the visitor is back looking at the
     * trip list. Auto-dismisses; also removable by re-triggering itself
     * (a second booking in quick succession replaces rather than stacks). */
    function showToast(title, text, persist) {
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
        updateToast(toast, title, text);
        document.body.appendChild(toast);

        requestAnimationFrame(function () { toast.classList.add('is-visible'); });
        // persist: used while a payment status poll is still running - the
        // toast stays up until the poll itself calls dismissToast(), rather
        // than vanishing after 4s while the rider is still mid-approval.
        if (!persist) dismissToast(toast, 4000);
        return toast;
    }

    function updateToast(toast, title, text) {
        toast.querySelector('.intercity-toast__title').textContent = title;
        toast.querySelector('.intercity-toast__text').textContent = text;
    }

    function dismissToast(toast, delay) {
        setTimeout(function () {
            toast.classList.remove('is-visible');
            setTimeout(function () { toast.remove(); }, 300);
        }, delay || 0);
    }

    /**
     * A pay-now booking returns 202 with the MoMo/Airtel prompt still open
     * on the guest's phone - nothing is booked yet. The card stays open and
     * locked (no manual close, form disabled) showing a waiting state
     * inline, and polls the public status endpoint (itself throttled
     * server-side, see settleIfPaid()) until the charge resolves. Once it
     * actually settles to paid, the card closes itself and the normal
     * "booked" toast takes over - the guest never has to tap anything to
     * dismiss it. A failure unlocks the card instead of closing it, so they
     * can see why and try again without resubmitting the whole form.
     */
    function watchPendingPayment(code, seatCount, deadlineAtIso) {
        paymentLocked = true;
        setFormLocked(true);
        showBanner(
            'pending',
            jsT('ic_status_waiting_title'),
            jsT(seatCount === 1 ? 'ic_status_waiting_text_one' : 'ic_status_waiting_text_many', { n: seatCount })
        );

        // A grace window past the hold's own deadline, so a reply that
        // lands right at the edge is still caught instead of the UI giving
        // up a moment too early.
        //
        // payment_deadline_at is computed server-side from PHP's time()
        // (i.e. true UTC, formatted with no timezone marker) - parsing it
        // as "T...", with no "Z", makes the browser read it as LOCAL time
        // instead. For a Rwanda browser (UTC+2) that misreads the deadline
        // as ~2 hours earlier than it really is, so giveUpAt was already in
        // the past on the very first tick - the 30s USSD hint below never
        // got a chance to show before the "still waiting" message took
        // over. The "Z" forces correct UTC parsing.
        var giveUpAt = deadlineAtIso
            ? new Date(deadlineAtIso.replace(' ', 'T') + 'Z').getTime() + 20000
            : Date.now() + 5 * 60000 + 20000;

        // If the MoMo prompt never actually reached the phone (missed push,
        // poor signal), the guest has no way to approve it at all - after
        // 30s, tell them they can pull it up manually instead of only ever
        // saying "wait".
        var shownAt = Date.now();
        var ussdHintShown = false;

        function unlock() {
            paymentLocked = false;
            setFormLocked(false);
        }

        function tick() {
            fetch(SAFELINE_API_BASE + '/public/intercity-bookings/' + code + '/status')
                .then(function (r) { return r.json(); })
                .then(function (res) {
                    var booking = res && res.success ? res.data : null;
                    if (!booking) {
                        // The endpoint itself failed (seen in production: a
                        // migration missing on the server made this 500 on
                        // every call, so the card sat on "waiting" forever
                        // with no visible error even after the booking had
                        // actually been paid via the gateway callback).
                        // Logged so a repeat is diagnosable from the console,
                        // and still subject to the same give-up deadline
                        // below rather than retrying silently forever.
                        console.error('intercity status check failed:', res && res.message);
                    } else if (booking.status === 'paid') {
                        unlock();
                        closeModal();
                        showToast(jsT('ic_toast_booked_title_' + (seatCount === 1 ? 'one' : 'many'), { n: seatCount }), jsT('ic_toast_booked_text', { code: code }));
                        loadTrips(0);
                        return;
                    } else if (booking.status !== 'pending_payment') {
                        // expired, failed, or cancelled - the hold is gone either way.
                        unlock();
                        showBanner('error', jsT('ic_status_failed_title'), jsT('ic_status_failed_text'));
                        loadTrips(0);
                        return;
                    }
                    if (Date.now() > giveUpAt) {
                        // Whether still genuinely pending at the gateway, or
                        // the status check itself keeps failing, don't leave
                        // the guest stuck on a locked card forever - unlock
                        // it and point them at the SMS / booking code instead
                        // of polling indefinitely.
                        unlock();
                        showBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_timeout_text', { code: code }));
                        return;
                    }
                    if (!ussdHintShown && Date.now() - shownAt > 30000) {
                        ussdHintShown = true;
                        showBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_ussd_hint'));
                    }
                    setTimeout(tick, 6000);
                })
                .catch(function (e) {
                    console.error('intercity status check network error:', e);
                    if (Date.now() > giveUpAt) {
                        unlock();
                        showBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_timeout_text', { code: code }));
                        return;
                    }
                    if (!ussdHintShown && Date.now() - shownAt > 30000) {
                        ussdHintShown = true;
                        showBanner('pending', jsT('ic_status_waiting_title'), jsT('ic_status_ussd_hint'));
                    }
                    setTimeout(tick, 6000);
                });
        }

        setTimeout(tick, 6000);
    }

    function showBanner(kind, title, text) {
        var banner = document.getElementById('intercity-banner');
        banner.className = 'form-banner is-' + kind;
        banner.hidden = false;
        banner.querySelector('.form-banner__title').textContent = title;
        banner.querySelector('.form-banner__text').textContent = text;
        // Not dismissible while actually locked - closing it would just
        // reopen on the next poll tick anyway, and hiding it mid-approval
        // only invites the guest to think nothing is happening.
        banner.querySelector('.form-banner__close').hidden = kind === 'pending';
    }

    function hideBanner() {
        document.getElementById('intercity-banner').hidden = true;
    }

    document.addEventListener('click', function (e) {
        var bookBtn = e.target.closest('.intercity-book-btn, .intercity-waitlist-btn');
        if (bookBtn) {
            var card = bookBtn.closest('[data-trip-id]');
            openModal(parseInt(card.dataset.tripId, 10));
        }
        if (e.target.closest('[data-intercity-close]') || e.target.closest('.form-banner__close')) {
            if (e.target.closest('.form-banner__close')) {
                hideBanner();
            } else if (!paymentLocked) {
                closeModal();
            }
        }
    });

    
    function localPhoneError(value) {
        var v = (value || '').trim();
        if (v === '') return jsT('ic_phone_required');
        if (!/^[0-9]+$/.test(v)) return jsT('ic_phone_numbers_only');
        if (v.length < 9) return jsT('ic_phone_too_short');
        if (v.length > 9) return jsT('ic_phone_too_long');
        if (v.charAt(0) !== '7') return jsT('ic_phone_must_start_7');
        return null;
    }

    function validatePhoneField(showIfEmpty) {
        var phoneField = document.getElementById('intercity_phone_number');
        var phoneError = document.getElementById('intercity_phone_error');
        if (!phoneField || !phoneError) return true;
        var value = phoneField.value.trim();
        var error = localPhoneError(value);
        if (error && (value !== '' || showIfEmpty)) {
            phoneError.textContent = error;
            phoneError.hidden = false;
            return false;
        }
        phoneError.hidden = true;
        return !error;
    }

    // Live validation as the user types/leaves the field, same as the app
    // login screen's AutovalidateMode.onUserInteraction - errors show up
    // immediately instead of waiting for submit.
    document.addEventListener('input', function (e) {
        if (e.target.id !== 'intercity_phone_number') return;
        e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 9);
        validatePhoneField(false);
    });
    document.addEventListener('blur', function (e) {
        if (e.target.id !== 'intercity_phone_number') return;
        validatePhoneField(true);
    }, true);

    document.addEventListener('input', function (e) {
        if (e.target.id !== 'intercity_seat_count') return;
        updateIntercityTotal();
    });

    document.addEventListener('submit', function (e) {
        if (e.target.id !== 'intercity-booking-form') return;
        e.preventDefault();
        hideBanner();

        var phoneField = document.getElementById('intercity_phone_number');
        var localPhone = phoneField.value.trim();
        if (!validatePhoneField(true)) {
            phoneField.focus();
            return;
        }

        var submitBtn = e.target.querySelector('.submit-btn-enhanced');
        submitBtn.disabled = true;

        var tripId = parseInt(document.getElementById('intercity_trip_id').value, 10);
        var pickupPointId = document.getElementById('intercity_pickup_point').value
            ? parseInt(document.getElementById('intercity_pickup_point').value, 10)
            : null;
        var guestName = document.getElementById('intercity_guest_name').value.trim();
        var phoneNumber = '+250' + localPhone;
        var seatCount = clampedSeatCount();

        var endpoint = modalMode === 'waitlist'
            ? SAFELINE_API_BASE + '/intercity-trips/' + tripId + '/waitlist'
            : SAFELINE_API_BASE + '/intercity-bookings';
        // language: the backend otherwise falls back to the browser/OS Accept-Language
        // header, which doesn't reflect this site's own language switch.
        var body = modalMode === 'waitlist'
            ? { pickup_point_id: pickupPointId, guest_name: guestName, phone_number: phoneNumber, seat_count: seatCount, language: SAFELINE_LANG }
            : {
                trip_id: tripId, pickup_point_id: pickupPointId, guest_name: guestName, phone_number: phoneNumber,
                seat_count: seatCount, pay_later: document.getElementById('intercity_payment_option').value === 'later',
                language: SAFELINE_LANG,
            };

        fetch(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
        })
            .then(function (r) { return r.json().then(function (data) { return { ok: r.ok, status: r.status, data: data }; }); })
            .then(function (res) {
                submitBtn.disabled = false;
                if (!res.ok || !res.data.success) {
                    // A known error carries a stable 'code' (see Response::error's
                    // 'code' extra in IntercityBookingController) that maps to a
                    // real translated message; anything without one (an
                    // unexpected 500, etc.) falls back to the generic text, since
                    // the backend's own raw message is never translated.
                    var code = res.data && res.data.code;
                    var errTitle = modalMode === 'waitlist' ? jsT('ic_err_waitlist_title') : jsT('ic_err_booking_title');
                    var errText = code && SAFELINE_I18N['ic_err_code_' + code]
                        ? jsT('ic_err_code_' + code, res.data)
                        : jsT('ic_err_please_try_again');
                    showBanner('error', errTitle, errText);
                    return;
                }

                if (res.status === 202) {
                    // Gateway-pending: the prompt is on the guest's phone right
                    // now, nothing is booked yet - this is the common case,
                    // since both MTN and Airtel return PENDING rather than
                    // settling synchronously. Card stays open, locked, until
                    // watchPendingPayment() itself closes it on actual payment.
                    watchPendingPayment(res.data.data.booking_code, res.data.data.seat_count || 1, res.data.data.payment_deadline_at);
                    loadTrips(0);
                    return;
                }

                // Every other success case is already final - closes the
                // modal and confirms via a toast instead of leaving the form
                // sitting open with an inline banner.
                closeModal();
                if (modalMode === 'waitlist') {
                    showToast(jsT('ic_toast_waitlisted_title'), jsT('ic_toast_waitlisted_text'));
                } else if (res.data.data.payment_deadline_at) {
                    var heldSeats = res.data.data.seat_count || 1;
                    showToast(jsT(heldSeats === 1 ? 'ic_toast_held_title_one' : 'ic_toast_held_title_many', { n: heldSeats }), jsT('ic_toast_held_text', { code: res.data.data.booking_code }));
                } else {
                    var bookedSeats = res.data.data.seat_count || 1;
                    showToast(jsT(bookedSeats === 1 ? 'ic_toast_booked_title_one' : 'ic_toast_booked_title_many', { n: bookedSeats }), jsT('ic_toast_booked_text', { code: res.data.data.booking_code }));
                }
                loadTrips(0);
            })
            .catch(function () {
                submitBtn.disabled = false;
                showBanner('error', jsT('ic_err_went_wrong_title'), jsT('ic_err_server_unreachable'));
            });
    });

    document.addEventListener('DOMContentLoaded', function () { loadTrips(0); });
})();
