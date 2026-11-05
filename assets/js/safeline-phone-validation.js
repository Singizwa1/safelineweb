/* Rwanda local-number validation + MTN/Airtel network toggle - shared by
 * every booking form on the site (home-intercity.js, home-car-rental.js).
 * Loaded once, ahead of those files, on every page that needs it.
 */
function localPhoneError(value, network) {
    var v = (value || '').trim();
    if (v === '') return jsT('ic_phone_required');
    if (!/^[0-9]+$/.test(v)) return jsT('ic_phone_numbers_only');
    if (v.length < 9) return jsT('ic_phone_too_short');
    if (v.length > 9) return jsT('ic_phone_too_long');
    if (v.charAt(0) !== '7') return jsT('ic_phone_must_start_7');
    var prefix = v.slice(0, 2);
    if (network === 'airtel' && prefix !== '72' && prefix !== '73') return jsT('ic_phone_wrong_network_airtel');
    if (network === 'mtn' && prefix !== '78' && prefix !== '79') return jsT('ic_phone_wrong_network_mtn');
    return null;
}

/** Shared by every contact-phone and payment-phone field across the
 * booking forms - same 9-digit local-number rules either way, checked
 * against whichever network (MTN/Airtel) is currently picked for that
 * field. */
function validatePhoneField(fieldId, errorId, showIfEmpty, network) {
    var phoneField = document.getElementById(fieldId);
    var phoneError = document.getElementById(errorId);
    if (!phoneField || !phoneError) return true;
    var value = phoneField.value.trim();
    var error = localPhoneError(value, network);
    if (error && (value !== '' || showIfEmpty)) {
        phoneError.textContent = error;
        phoneError.hidden = false;
        return false;
    }
    phoneError.hidden = true;
    return !error;
}

/** Which network (MTN/Airtel) is currently picked for a given phone
 * field's toggle - 'mtn' until the client taps Airtel. */
function selectedNetwork(hintId) {
    var toggle = document.getElementById(hintId);
    return (toggle && toggle.dataset.selected) || 'mtn';
}

function selectNetwork(hintId, network) {
    var toggle = document.getElementById(hintId);
    if (!toggle) return;
    toggle.dataset.selected = network;
    toggle.querySelectorAll('.network-toggle__pill').forEach(function (p) {
        p.classList.toggle('is-active', p.dataset.network === network);
    });
}
