(function () {
    function render(photos) {
        var grid = document.getElementById('gallery-grid');
        var empty = document.getElementById('gallery-empty');
        if (!photos.length) {
            empty.hidden = false;
            return;
        }
        grid.innerHTML = photos.map(function (p) {
            var alt = p.label ? p.label.replace(/"/g, '&quot;') : '';
            return '<div class="sl-gallery__item"><img src="' + p.url + '" alt="' + alt + '" loading="lazy" decoding="async"></div>';
        }).join('');
    }

    function load(attempt) {
        fetch(SAFELINE_API_BASE + '/public/vehicle-photos')
            .then(function (r) {
                if (!r.ok) throw new Error('bad status');
                return r.json();
            })
            .then(function (result) {
                render((result && result.success && result.data) || []);
            })
            .catch(function () {
                if (attempt < 2) setTimeout(function () { load(attempt + 1); }, 1200);
            });
    }

    load(0);
})();
