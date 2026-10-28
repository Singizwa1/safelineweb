            
            (function() {
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

                    let cardsHtml = '';
                    categories.forEach(function (category) {
                        const pricing = category.pricing;
                        const baseFare = parseFloat(pricing.base_fare || 0).toLocaleString();
                        const perKmRate = parseFloat(pricing.per_km_rate || 0).toLocaleString();
                        const baseKm = parseFloat(pricing.base_km || 0);
                        const imageUrl = category.image_key ? `${SAFELINE_API_BASE}/uploads/${category.image_key}` : 'assets/images/safeline-cruze-side-r.png';

                        cardsHtml += `
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="ride-card">
                                    <div class="ride-card__bg" style="background-image: url(assets/images/shapes/taxi-card-bg-1-1.png);"></div>
                                    <div class="ride-card__inner">
                                        <div class="ride-card__image">
                                            <img src="${imageUrl}" alt="${category.name}" onerror="this.src='assets/images/safeline-cruze-side-r.png'">
                                            <h3 class="ride-card__price">starting ${baseFare} RWF</h3>
                                        </div>
                                        <div class="ride-card__content">
                                            <h3 class="ride-card__title">${category.name}</h3>
                                            <ul class="ride-card__list list-unstyled">
                                                <li>
                                                    <span>Base Fare (${baseKm} km)</span>
                                                    <span>${baseFare} RWF</span>
                                                </li>
                                                <li>
                                                    <span>Per Km Rate</span>
                                                    <span>${perKmRate} RWF</span>
                                                </li>
                                                ${category.description ? `
                                                <li>
                                                    <span>Details</span>
                                                    <span>${category.description}</span>
                                                </li>` : ''}
                                            </ul>
                                            <a href="#download-app" class="cityride-btn cityride-btn--border">
                                                <span class="cityride-btn__icon"><i class="icon-front-car"></i></span>
                                                <span>get the app</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    contentContainer.innerHTML = `
                        <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms">
                            <div class="container position-relative">
                                <div class="ride-rates-one__inner-bg">
                                    <div class="ride-rates-one__inner-bg__bg" style="background-image: url(assets/images/shapes/taxi-rates-inner-bg-1-1.png);"></div>
                                </div>
                            </div>
                            <div class="ride-rates-one__tab-container container">
                                <div class="row gutter-y-30">
                                    ${cardsHtml}
                                </div>
                            </div>
                        </div>
                    `;
                }

                function renderNoCategories() {
                    const contentContainer = document.getElementById('ride-rates-content');
                    contentContainer.innerHTML = `
                        <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms">
                            <div class="container position-relative">
                                <div class="ride-rates-one__inner-bg">
                                    <div class="ride-rates-one__inner-bg__bg" style="background-image: url(assets/images/shapes/taxi-rates-inner-bg-1-1.png);"></div>
                                </div>
                            </div>
                            <div class="ride-rates-one__tab-container container">
                                <div class="row gutter-y-30">
                                    <div class="col-12 text-center py-5">
                                        <i class="fas fa-car fa-3x" style="color: #63C51F; opacity: 0.5;"></i>
                                        <p class="mt-3" style="color: #556677; font-size: 18px;">Ride rates are not available right now.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                document.addEventListener('DOMContentLoaded', loadRideRates);
            })();
