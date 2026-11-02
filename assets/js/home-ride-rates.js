            (function() {
                const FALLBACK_IMAGE = 'assets/images/safeline-cruze-side-r.png';

                // Labels are rendered server-side (index.php, data-labels) so
                // they follow the site language; English defaults keep the
                // cards readable if the attribute is ever missing.
                function getLabels() {
                    const defaults = {
                        baseFare: 'Base fare',
                        coversKm: 'Includes the first {km} km',
                        perKm: 'Each extra km',
                        perKmUnit: '/ km',
                        cta: 'Book in the app',
                        empty: 'Ride rates are not available right now.'
                    };
                    const el = document.getElementById('ride-rates-content');
                    try {
                        return Object.assign(defaults, JSON.parse(el.getAttribute('data-labels') || '{}'));
                    } catch (e) {
                        return defaults;
                    }
                }

                // API values go into innerHTML, so escape them.
                function esc(value) {
                    return String(value == null ? '' : value).replace(/[&<>"']/g, function (ch) {
                        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ch];
                    });
                }

                async function loadRideRates() {
                    const contentContainer = document.getElementById('ride-rates-content');
                    try {
                        const [catRes, priceRes] = await Promise.all([
                            fetch(`${SAFELINE_API_BASE}/public/vehicle-categories?limit=100`),
                            fetch(`${SAFELINE_API_BASE}/public/ride-prices?limit=100`),
                        ]);
                        const catResult = await catRes.json();
                        const priceResult = await priceRes.json();

                        if (!catResult.success || !catResult.data) {
                            renderNoCategories();
                            return;
                        }

                        const pricesByCategory = {};
                        (priceResult.data || []).forEach(function (p) {
                            if (p.status === 'active' && !pricesByCategory[p.category_id]) {
                                pricesByCategory[p.category_id] = p;
                            }
                        });

                        const categories = catResult.data
                            .filter(function (c) { return c.status === 'active'; })
                            .map(function (c) {
                                return Object.assign({}, c, { pricing: pricesByCategory[c.id] || null });
                            })
                            .filter(function (c) { return c.pricing; });

                        renderCategories(categories);
                    } catch (error) {
                        console.error('Error loading ride rates:', error);
                        renderNoCategories();
                    }
                }

                function renderCategories(categories) {
                    const contentContainer = document.getElementById('ride-rates-content');

                    if (categories.length === 0) {
                        renderNoCategories();
                        return;
                    }

                    const labels = getLabels();
                    let cardsHtml = '';
                    categories.forEach(function (category) {
                        const pricing = category.pricing;
                        const baseFare = parseFloat(pricing.base_fare || 0).toLocaleString();
                        const perKmRate = parseFloat(pricing.per_km_rate || 0).toLocaleString();
                        const baseKm = parseFloat(pricing.base_km || 0);
                        const imageUrl = category.image_key ? `${SAFELINE_API_BASE}/uploads/${category.image_key}` : FALLBACK_IMAGE;
                        const covers = labels.coversKm.split('{km}').join(baseKm);

                        cardsHtml += `
                            <article class="rate-card">
                                <div class="rate-card__media">
                                    <img src="${esc(imageUrl)}" alt="${esc(category.name)}" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='${FALLBACK_IMAGE}'">
                                </div>
                                <div class="rate-card__body">
                                    <h3 class="rate-card__title">${esc(category.name)}</h3>
                                    ${category.description ? `<p class="rate-card__desc">${esc(category.description)}</p>` : ''}
                                    <div class="rate-card__price">
                                        <span class="rate-card__label">${esc(labels.baseFare)}</span>
                                        <span class="rate-card__amount">${esc(baseFare)}<small>RWF</small></span>
                                        <span class="rate-card__note">${esc(covers)}</span>
                                    </div>
                                    <div class="rate-card__row">
                                        <span>${esc(labels.perKm)}</span>
                                        <strong>${esc(perKmRate)} RWF <small>${esc(labels.perKmUnit)}</small></strong>
                                    </div>
                                    <a href="#download-app" class="rate-card__btn cityride-btn cityride-btn--primary">
                                        <span>${esc(labels.cta)}</span>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </article>
                        `;
                    });

                    // One category reads better as a single wide card than as a
                    // lone narrow column.
                    const gridClass = categories.length === 1 ? 'rate-grid rate-grid--single' : 'rate-grid';
                    contentContainer.innerHTML = `
                        <div class="tab active-tab">
                            <div class="container">
                                <div class="${gridClass}">
                                    ${cardsHtml}
                                </div>
                            </div>
                        </div>
                    `;
                }

                function renderNoCategories() {
                    const contentContainer = document.getElementById('ride-rates-content');
                    contentContainer.innerHTML = `
                        <div class="tab active-tab">
                            <div class="container">
                                <div class="rate-state" role="status">
                                    <i class="fas fa-car" aria-hidden="true"></i>
                                    <span>${esc(getLabels().empty)}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }

                document.addEventListener('DOMContentLoaded', loadRideRates);
            })();
