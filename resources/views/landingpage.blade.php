<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $institut->nom ?? 'Glow Institute' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <div class="logo">
        <a href="{{ route('landingpage') }}">
            <img src="{{ asset('images/Glow.png') }}" alt="logo">
            <h2>{{ $institut->nom ?? 'Glow Institute' }}</h2>
        </a>
    </div>

    <ul class="nav-links" id="navLinks">
        <li><a href="#home" onclick="scrollToHome(event)">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="#reviews">Reviews</a></li>
        <li><a href="#about">About</a></li>
    </ul>

    <div class="right-section">
    @if(Auth::check())
        @if(Auth::user()->isClient())
           @php
               $nbNotifs     = Auth::user()->notifications()->whereNull('read_at')->count();
               $clientNotifs = Auth::user()->notifications()->latest()->take(8)->get();
               $nbFavoris    = Auth::user()->produitsFavoris()->count();
               $nbPanier     = session('panier') ? array_sum(array_column(session('panier'), 'quantite')) : 0;
           @endphp
            {{-- ✅ NOTIFICATION BELL WITH DROPDOWN --}}
            <div style="position:relative;" x-data="{ open: false }">
                <button class="nav-icon-btn" @click="open = !open" title="Notifications"
                        style="border:none; cursor:pointer; font-family:inherit;">
                    <i class="fa-solid fa-bell"></i>
                    @if($nbNotifs > 0)
                        <span class="nav-icon-badge">{{ $nbNotifs > 9 ? '9+' : $nbNotifs }}</span>
                    @endif
                </button>
                <div x-show="open" @click.outside="open = false" x-transition class="client-notif-drop" style="display:none;">
                    <div class="client-notif-head">
                        <span class="client-notif-title">
                            <i class="fa-solid fa-bell" style="font-size:11px;"></i> Notifications
                        </span>
                        @if($nbNotifs > 0)
                            <form method="POST" action="{{ route('notifications.marquer-lues') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="client-notif-mark-all">Mark all read</button>
                            </form>
                        @endif
                    </div>
                    <div class="client-notif-list">
                        @forelse($clientNotifs as $n)
                            @php $d = json_decode($n->data, true); @endphp
                            <div class="client-notif-item">
                                <div class="client-notif-dot"></div>
                                <div style="flex:1;min-width:0;">
                                    <div class="client-notif-msg">{{ $d['message'] ?? 'New notification' }}</div>
                                    <div class="client-notif-ago">{{ $n->created_at->diffForHumans() }}</div>
                                </div>
                                <form method="POST" action="{{ route('notifications.marquer-lue', $n->id) }}" style="flex-shrink:0;">
                                    @csrf
                                    <button type="submit" class="client-notif-check" title="Mark as read">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="client-notif-empty">
                                <i class="fa-regular fa-bell-slash" style="font-size:28px;color:#e9d8fd;margin-bottom:8px;display:block;"></i>
                                No new notifications
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <a href="{{ route('client.favoris.index') }}" class="nav-icon-btn">
                <i class="fa-regular fa-heart"></i>
                @if($nbFavoris > 0)<span class="nav-icon-badge fav" id="fav-badge">{{ $nbFavoris }}</span>
                @else
    <span class="nav-icon-badge fav" id="fav-badge" style="display:none;">0</span>
@endif
            </a>
            <a href="{{ route('client.panier.index') }}" class="nav-icon-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                @if($nbPanier > 0)<span class="nav-icon-badge cart">{{ $nbPanier }}</span>@endif
            </a>
        @endif

        {{-- AVATAR DROPDOWN — seulement Profile + Logout --}}
        <div class="nav-avatar-wrap" onclick="toggleUserMenu()" id="avatarBtn">
            @if(Auth::user()->photo)
                <img src="{{ asset('storage/'.Auth::user()->photo) }}" class="nav-avatar-img" alt="">
            @else
                <div class="nav-avatar-init">{{ strtoupper(substr(Auth::user()->prenom,0,1)) }}</div>
            @endif
            <span class="nav-avatar-name">{{ Auth::user()->prenom }}</span>
            <i class="fa-solid fa-chevron-down nav-avatar-arrow" id="avatarArrow"></i>
        </div>

        <div class="nav-dropdown" id="userDropdown">
    <div class="nav-dropdown-header">
        <p class="nav-dropdown-name">{{ Auth::user()->fullName() }}</p>
        <p class="nav-dropdown-email">{{ Auth::user()->email }}</p>
    </div>
    <div class="nav-dropdown-body">
        <a href="{{ route('profile.edit') }}" class="nav-dropdown-item">
            <i class="fa-solid fa-user"></i> My Profile
        </a>
        @if(Auth::user()->isClient())
            <a href="{{ route('client.rendez-vous.index') }}" class="nav-dropdown-item">
                <i class="fa-regular fa-calendar-check"></i> My Appointments
            </a>
            <a href="{{ route('client.commandes.index') }}" class="nav-dropdown-item">
                <i class="fa-solid fa-box"></i> My Orders
            </a>
            <a href="{{ route('client.factures.index') }}" class="nav-dropdown-item">
                <i class="fa-solid fa-file-invoice"></i> My Invoices
            </a>
            <a href="{{ route('client.avis.index') }}" class="nav-dropdown-item">
                <i class="fa-regular fa-star"></i> My Reviews
            </a>
            <a href="{{ route('client.fidelite.index') }}" class="nav-dropdown-item">
                <i class="fa-solid fa-gift"></i> Loyalty Points
            </a>
            <a href="{{ route('client.panier.index') }}" class="nav-dropdown-item">
                <i class="fa-solid fa-cart-shopping"></i> My Cart
            </a>
            <a href="{{ route('client.favoris.index') }}" class="nav-dropdown-item">
                <i class="fa-regular fa-heart"></i> Wishlist
            </a>
            <a href="{{ url('/client/contact') }}" class="nav-dropdown-item">
                <i class="fa-solid fa-envelope"></i> Contact Support
           </a>
        @endif
    </div>
    <div class="nav-dropdown-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-dropdown-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</div>

    @else
        <a href="{{ route('login') }}"><button class="signin">Sign In</button></a>
        <a href="{{ route('register') }}"><button class="signup">Sign Up</button></a>
    @endif
    </div>

    <div class="hamburger" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
    </div>
</nav>



{{-- HERO --}}
<section class="hero" id="home">
    <div class="hero-text">
        <h1>
            Discover Your <br>
            <span class="animated-gradient">Perfect Beauty</span><br>
            Experience
        </h1>
        <p>{{ $institut->description ?? 'Experience world-class beauty treatments managed with precision. Book appointments and shop premium products online.' }}</p>
        <div class="hero-buttons">
            @auth
                <a href="{{ route('client.reservation.create') }}" class="btn primary">Book Now</a>
                <a href="{{ route('client.produits.index') }}" class="btn secondary">Shop Products</a>
            @else
                <a href="{{ route('register') }}" class="btn primary">Book Now</a>
                <a href="{{ route('register') }}" class="btn secondary">Shop Products</a>
            @endauth
        </div>
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-number">{{ $nbEsthes }}+</span>
                <span class="stat-label">Experts</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-number">{{ $nbServices }}+</span>
                <span class="stat-label">Services</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-number">{{ number_format($noteMoyenne, 1) }}★</span>
                <span class="stat-label">Rating</span>
            </div>
            @auth
    @if(Auth::user()->isClient() && isset($affluence))
        <div class="stat-divider"></div>
        <div class="stat">
            @php
    $afStyle = $affluence['niveau'] === 'faible'
        ? 'background:rgba(16,185,129,0.15);color:#059669 !important;'
        : ($affluence['niveau'] === 'moyen'
            ? 'background:rgba(245,158,11,0.15);color:#d97706 !important;'
            : 'background:rgba(239,68,68,0.15);color:#ef4444 !important;');
    $afText = $affluence['niveau'] === 'faible' ? '🟢 Quiet'
        : ($affluence['niveau'] === 'moyen' ? '🟡 Moderate' : '🔴 Busy');
@endphp
            <span class="stat-number affluence-pill" style="font-size:13px;padding:5px 14px;border-radius:20px;font-weight:700;white-space:nowrap;display:inline-block;{{ $afStyle }}">
                {{ $afText }}
            </span>
            <span class="stat-label">Institute Today</span>
        </div>
    @endif
@endauth

        </div>
    </div>

    <div class="hero-image">
        <img src="{{ asset('images/inst.png') }}" alt="Glow Institute">
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="section section-light">
    <div class="section-header">
        <h2>Why Choose <span class="animated-gradient">{{ $institut->nom ?? 'Glow Institute' }}?</span></h2>
        <p>Everything you need for your beauty journey, all in one place</p>
    </div>
    <div class="why-grid">
        <div class="why-card">
            <div class="why-icon"><i class="fa-regular fa-calendar-check"></i></div>
            <h3>Easy Booking</h3>
            <p>Book appointments instantly with your favorite beauty experts online, anytime.</p>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fa-regular fa-star"></i></div>
            <h3>Verified Reviews</h3>
            <p>Read authentic reviews from real clients before choosing your treatment.</p>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fa-solid fa-gift"></i></div>
            <h3>Loyalty Rewards</h3>
            <p>Earn points with every visit and unlock exclusive discounts and perks.</p>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fa-solid fa-bag-shopping"></i></div>
            <h3>Shop Products</h3>
            <p>Explore a curated selection of premium beauty products from top international brands.</p>
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="section how-section">
    <div class="section-header">
        <h2>How <span class="animated-gradient">It Works</span></h2>
        <p>Book your perfect beauty experience in just 3 simple steps</p>
    </div>
    <div class="how-grid">
        <div class="how-card">
            <div class="how-number">1</div>
            <div class="how-icon-wrap"><i class="fa-solid fa-magnifying-glass"></i></div>
            <h3>Browse & Discover</h3>
            <p>Explore a wide range of beauty services and discover the perfect treatment tailored to your needs.</p>
        </div>
        <div class="how-connector"><i class="fa-solid fa-arrow-right"></i></div>
        <div class="how-card">
            <div class="how-number">2</div>
            <div class="how-icon-wrap"><i class="fa-regular fa-calendar-check"></i></div>
            <h3>Book Instantly</h3>
            <p>Choose your preferred date, time, and beauty expert. Confirm your appointment in seconds.</p>
        </div>
        <div class="how-connector"><i class="fa-solid fa-arrow-right"></i></div>
        <div class="how-card">
            <div class="how-number">3</div>
            <div class="how-icon-wrap"><i class="fa-regular fa-star"></i></div>
            <h3>Enjoy & Review</h3>
            <p>Experience top-quality service, earn loyalty points and share your feedback with the community.</p>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section class="section" id="services">
    <div class="section-header">
        <h2>Popular <span class="animated-gradient">Services</span></h2>
        <p>Discover our most loved beauty treatments</p>
    </div>
    <div class="services-grid">
        @forelse($services as $service)
            <div class="service-card">
                @if($service->image)
                    <div class="service-img">
                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->nom }}">
                    </div>
                @else
                    <div class="service-img service-img-placeholder"><span>💄</span></div>
                @endif
                <div class="service-info">
                    @if($service->category)
                        <span class="service-category">{{ $service->category->nom }}</span>
                    @endif
                    <h3>{{ $service->nom }}</h3>
                    @if($service->description)
                        <p>{{ Str::limit($service->description, 80) }}</p>
                    @endif
                    <div class="service-footer">
                        <span class="service-price">{{ number_format($service->prix, 0, ',', ' ') }} DA</span>
                        <span class="service-duration"><i class="fa-regular fa-clock"></i> {{ $service->duree }} min</span>
                    </div>
                    <div style="display:flex; gap:102px; margin-top:10px;">
                      @auth
                         <a href="{{ route('client.reservation.create', ['service' => $service->id]) }}" class="btn primary btn-sm">Book Now</a>
                         <a href="{{ route('client.services.show', $service) }}" class="btn secondary btn-sm">Explore →</a>
                       @else
                          <a href="{{ route('login') }}" class="btn primary btn-sm">Book Now</a>
                       @endauth
                   </div>
                </div>
            </div>
        @empty
            <p class="empty-msg">No services available yet.</p>
        @endforelse
    </div>
    @if($services->count() > 0)
        <div class="section-btn">
            @auth
                <a href="{{ route('client.services.index') }}" class="btn secondary">View All Services</a>
            @else
                <a href="{{ route('login') }}" class="btn secondary">View All Services</a>
            @endauth
        </div>
    @endif
</section>

{{-- SKIN QUIZ --}}
<section class="section skin-quiz-section" id="skin-quiz">
    <div class="quiz-content">
        <div class="quiz-text">
            <h2>Discover Your <span class="animated-gradient">Skin Type</span></h2>
            <p>Answer 5 simple questions and get a personalized routine with services and products tailored to your unique skin needs.</p>
            @auth
                <a href="{{ route('client.questionnaire.index') }}" class="btn primary">Take the Quiz</a>
            @else
                <a href="{{ route('register') }}" class="btn primary">Take the Quiz</a>
            @endauth
        </div>
        <div class="quiz-icons">
            <div class="skin-icon">🌿<span>Normal</span></div>
            <div class="skin-icon">💧<span>Oily</span></div>
            <div class="skin-icon">🌵<span>Dry</span></div>
            <div class="skin-icon">☯️<span>Mix</span></div>
            <div class="skin-icon">🌸<span>Sensitive</span></div>
        </div>
    </div>
</section>

{{-- PRODUCTS --}}
<section class="section section-light" id="products">
    <div class="section-header">
        <h2>Featured <span class="animated-gradient">Products</span></h2>
        <p>Premium beauty products for your daily routine</p>
    </div>
    <div class="products-grid">
        @forelse($produits as $produit)
            <div class="product-card" style="position:relative;">

                {{-- FAVORIS AJAX --}}
                @auth
                    <button onclick="toggleFavori(this, {{ $produit->id }})"
                            style="position:absolute;top:10px;right:10px;z-index:2;background:white;border:none;cursor:pointer;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.12);font-size:15px;transition:transform 0.2s;">
                        {{ Auth::user()->produitsFavoris()->where('produit_id', $produit->id)->exists() ? '❤️' : '🤍' }}
                    </button>
                @endauth

                @if($produit->image)
                    <div class="product-img">
                        <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}">
                    </div>
                @else
                    <div class="product-img product-img-placeholder"><span>🧴</span></div>
                @endif

                <div class="product-info">
                    <h3>{{ $produit->nom }}</h3>
                    <div class="product-footer">
                        <span class="product-price">{{ number_format($produit->prix, 0, ',', ' ') }} DA</span>
                        @auth
                            <a href="{{ route('client.produits.show', $produit) }}" class="btn-icon">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-icon">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="empty-msg">No products available yet.</p>
        @endforelse
    </div>
    @if($produits->count() > 0)
        <div class="section-btn">
            @auth
                <a href="{{ route('client.produits.index') }}" class="btn secondary">Shop All Products</a>
            @else
                <a href="{{ route('login') }}" class="btn secondary">Shop All Products</a>
            @endauth
        </div>
    @endif
</section>

{{-- JS FAVORIS AJAX --}}
@auth
<script>
const csrfToken = '{{ csrf_token() }}';

function toggleFavori(btn, produitId) {
    btn.style.transform = 'scale(0.8)';
    setTimeout(() => btn.style.transform = 'scale(1)', 200);

    fetch(`/client/favoris/${produitId}/toggle`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        btn.textContent = data.estFavori ? '❤️' : '🤍';
        const badge = document.getElementById('fav-badge');
        if (badge) {
            const count = parseInt(badge.textContent || '0') + (data.estFavori ? 1 : -1);
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
        const msg = data.estFavori ? '❤️ Added to wishlist!' : '🤍 Removed from wishlist.';
        showToast(msg);
    })
    .catch(err => console.error(err));
}
</script>
@endauth

{{-- LOYALTY POINTS --}}
@auth
    @if(Auth::user()->isClient())
        @php
            $pointsClient = Auth::user()->pointsFidelite()->sum('points');
            $niveau = $pointsClient >= 300 ? 'Gold' : ($pointsClient >= 100 ? 'Silver' : 'Bronze');
            $couleur = $niveau === 'Gold' ? '#f59e0b' : ($niveau === 'Silver' ? '#6b7280' : '#cd7c2f');
            $prochainNiveau = $niveau === 'Bronze' ? 100 : ($niveau === 'Silver' ? 300 : null);
            $pointsRestants = $prochainNiveau ? $prochainNiveau - $pointsClient : 0;
        @endphp
        <section class="section section-light" id="loyalty">
            <div style="max-width:700px;margin:0 auto;text-align:center;">
                <div style="width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#b480ff,#d3aa95);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px;">🎁</div>
                <h2 style="font-size:28px;font-weight:800;color:#1a1a2e;margin-bottom:8px;">
                    Your Loyalty Status
                </h2>
                <p style="color:#6b7280;margin-bottom:24px;">Earn points with every appointment and order</p>

                <div style="display:inline-flex;align-items:center;gap:10px;background:white;border:2px solid;border-color:{{ $couleur }};border-radius:30px;padding:10px 24px;margin-bottom:20px;">
                    <span style="font-size:20px;">{{ $niveau === 'Gold' ? '🥇' : ($niveau === 'Silver' ? '🥈' : '🥉') }}</span>
                    <span style="font-size:18px;font-weight:800;color:{{ $couleur }};">{{ $niveau }} Member</span>
                    <span style="font-size:16px;font-weight:700;color:#b480ff;">{{ $pointsClient }} pts</span>
                </div>

                @if($prochainNiveau)
                    <p style="font-size:13px;color:#9ca3af;margin-bottom:20px;">
                        <strong style="color:#b480ff;">{{ $pointsRestants }} points</strong> until {{ $niveau === 'Bronze' ? 'Silver' : 'Gold' }} level
                    </p>
                @else
                    <p style="font-size:13px;color:#f59e0b;margin-bottom:20px;">🏆 You've reached the highest level!</p>
                @endif

                <a href="{{ route('client.fidelite.index') }}" class="btn primary">View My Rewards</a>
            </div>
        </section>
    @endif
@endauth
{{-- REVIEWS --}}
<section class="section section-light" id="reviews">
    <div class="section-header">
        <h2>What Our <span class="animated-gradient">Clients Say</span></h2>
        <p>Real experiences from real people</p>
        @if($avis->isNotEmpty())
            <div class="rating-summary">
                <div class="stars-big">
                    @for($i=1;$i<=5;$i++)
                        <i class="fa-star {{ $i<=round($noteMoyenne)?'fa-solid':'fa-regular' }}"></i>
                    @endfor
                </div>
                <span>{{ number_format($noteMoyenne,1) }}/5 — {{ $avis->count() }} reviews</span>
            </div>
        @endif
    </div>
    <div class="reviews-grid">
        @forelse($avis as $av)
            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-avatar">
                        @if($av->client->photo)
                            <img src="{{ asset('storage/'.$av->client->photo) }}" alt="">
                        @else
                            <div class="avatar-initials">{{ strtoupper(substr($av->client->prenom,0,1)) }}</div>
                        @endif
                    </div>
                    <div>
                        <p class="reviewer-name">{{ $av->client->fullName() }}</p>
                        <div class="review-stars">
                            @for($i=1;$i<=5;$i++)
                                <i class="fa-star {{ $i<=$av->note?'fa-solid':'fa-regular' }}"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                @if($av->commentaire)
                    <p class="review-text">"{{ $av->commentaire }}"</p>
                @endif
                <p class="review-date">{{ $av->created_at->format('d M Y') }}</p>
            </div>
        @empty
            <div class="review-card">
                <div class="review-header">
                    <div class="avatar-initials">S</div>
                    <div><p class="reviewer-name">Sarah M.</p>
                        <div class="review-stars">@for($i=1;$i<=5;$i++)<i class="fa-solid fa-star"></i>@endfor</div>
                    </div>
                </div>
                <p class="review-text">"The best beauty institute I have ever visited. The staff is professional and the treatments are absolutely amazing!"</p>
                <p class="review-date">12 Apr 2025</p>
            </div>
            <div class="review-card">
                <div class="review-header">
                    <div class="avatar-initials">L</div>
                    <div><p class="reviewer-name">Lina K.</p>
                        <div class="review-stars">@for($i=1;$i<=5;$i++)<i class="fa-solid fa-star"></i>@endfor</div>
                    </div>
                </div>
                <p class="review-text">"I love the loyalty rewards system! Every visit feels special and the booking process is so easy and smooth."</p>
                <p class="review-date">28 Mar 2025</p>
            </div>
            <div class="review-card">
                <div class="review-header">
                    <div class="avatar-initials">A</div>
                    <div><p class="reviewer-name">Amira B.</p>
                        <div class="review-stars">@for($i=1;$i<=5;$i++)<i class="fa-solid fa-star"></i>@endfor</div>
                    </div>
                </div>
                <p class="review-text">"The skin quiz is genius! It recommended the perfect facial for my skin type. I can already see the difference."</p>
                <p class="review-date">05 Mar 2025</p>
            </div>
        @endforelse
    </div>
</section>

{{-- JOIN AS EXPERT --}}
@guest
<section class="section join-section">
    <div class="join-grid">
        <div class="join-text">
            <span class="join-label">For Professionals</span>
            <h2>Are You a Beauty <span class="animated-gradient">Expert?</span></h2>
            <p>Join our team of talented beauty professionals. Manage your appointments, grow your clientele and showcase your skills at {{ $institut->nom ?? 'Glow Institute' }}.</p>
            <ul class="join-list">
                <li><i class="fa-solid fa-check"></i> Manage your own schedule and availability</li>
                <li><i class="fa-solid fa-check"></i> Receive appointment requests directly</li>
                <li><i class="fa-solid fa-check"></i> Build your professional profile and reviews</li>
                <li><i class="fa-solid fa-check"></i> Track your performance and activity</li>
            </ul>
            <div class="join-stats-row">
                <div class="join-stat-item">
                    <strong>{{ $nbEsthes }}+</strong>
                    <span>Active Experts</span>
                </div>
                <div class="join-stat-item">
                    <strong>100%</strong>
                    <span>Online Booking</span>
                </div>
                <div class="join-stat-item">
                    <strong>24/7</strong>
                    <span>Platform Access</span>
                </div>
            </div>
            <a href="{{ route('register.estheticienne') }}" class="btn primary">Apply Now</a>
        </div>
        <div class="join-img-wrap">
            <img src="{{ asset('images/esth22.png') }}" alt="Beauty Expert">
        </div>
    </div>
</section>
@endguest

{{-- FAQ --}}
<section class="section section-light faq-section" id="faq">
    <div class="section-header">
        <h2>Frequently Asked <span class="animated-gradient">Questions</span></h2>
        <p>Everything you need to know about Glow Institute</p>
    </div>
    <div class="faq-list">
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>How do I book an appointment?</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Browse our services, choose your expert and select an available time slot. Once the esthetician accepts your request, you'll receive both an email confirmation and an in-app notification.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Can I cancel or reschedule my appointment?</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Yes, you can cancel your appointment directly from your dashboard. Please contact us as early as possible to allow us to accommodate other clients.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>How do loyalty points work?</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>You earn points with every completed appointment and order. Bronze members get started at 0 points, Silver at 100 points (5% discount) and Gold at 300 points (10% discount).</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Can I purchase products without booking a service?</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Absolutely! You can browse and order our premium beauty products directly from the shop section. Add them to your cart and place your order anytime.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>What is the skin type quiz?</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Our personalized skin analysis tool asks you 5 simple questions about your skin. Based on your answers, we recommend the most suitable services and products for your unique skin type.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to Transform Your Beauty Experience?</h2>
        <p>Join thousands of satisfied clients and discover your perfect beauty destination.</p>
        <div class="hero-buttons cta-buttons">
            @auth
                <a href="{{ route('client.reservation.create') }}" class="btn cta-btn-white">Book Now</a>
            @else
                <a href="{{ route('register') }}" class="btn cta-btn-white">Sign Up Now</a>
                <a href="{{ route('login') }}" class="btn cta-btn-outline">Sign In</a>
            @endauth
        </div>
    </div>
</section>
{{-- CONTACT --}}
@auth
<section class="section" id="contact-form">
    <div class="section-header">
        <h2>Need <span class="animated-gradient">Help?</span></h2>
        <p>Our team is here for you — send us a message anytime</p>
    </div>
    <div style="max-width:500px;margin:0 auto;text-align:center;">
        <div style="background:white;border-radius:24px;padding:40px 32px;border:1px solid #ede9fe;box-shadow:0 8px 30px rgba(180,128,255,0.08);">
            <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#b480ff,#d3aa95);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:26px;">
                💬
            </div>
            <h3 style="font-size:20px;font-weight:800;color:#1a1a2e;margin-bottom:10px;">Contact Us</h3>
            <p style="font-size:14px;color:#6b7280;margin-bottom:28px;line-height:1.7;">
                Have a question about your appointment, an order, or anything else?
                Send us a message and we'll get back to you as soon as possible.
            </p>
            <a href="{{ url('/client/contact') }}" class="btn primary" style="display:inline-flex;align-items:center;gap:8px;padding:14px 32px;font-size:15px;">
                <i class="fa-solid fa-paper-plane"></i> Send a Message
            </a>
        </div>
    </div>
</section>
@endauth

{{-- ABOUT + MAP --}}
<section class="section section-light" id="about">
    <div class="about-grid">
        <div class="about-text">
            <h2>About <span class="animated-gradient">{{ $institut->nom ?? 'Glow Institute' }}</span></h2>
            <p>{{ $institut->description ?? 'We are a premium beauty institute dedicated to enhancing your natural beauty with world-class treatments and personalized care.' }}</p>
            <div class="contact-info">
                @if($institut->adresse)
                    <div class="contact-item">
                      <i class="fa-solid fa-location-dot"></i>
                      <a href="https://www.google.com/maps/search/{{ urlencode(($institut->adresse ?? '').' '.($institut->ville ?? '')) }}" target="_blank" style="color:inherit;text-decoration:none;">
                          {{ $institut->adresse }}@if($institut->ville), {{ $institut->ville }}@endif
                       </a>
                   </div>
                @endif
                @if($institut->telephone)
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>{{ $institut->telephone }}</span>
                    </div>
                @endif
                @if($institut->email)
                    <div class="contact-item">
                      <i class="fa-solid fa-envelope"></i>
                      <a href="https://mail.google.com/mail/?view=cm&to={{ $institut->email }}" target="_blank" style="color:inherit;text-decoration:none;">{{ $institut->email }}</a>
                   </div>
                @endif
            </div>
            <div class="social-links footer-socials" style="display:flex;gap:10px;margin-top:12px;">
              <a href="{{ $institut->instagram ?? '#' }}" target="_blank" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#b480ff,#d3aa95);color:white;font-size:16px;text-decoration:none;">
                  <i class="fa-brands fa-instagram"></i>
              </a>
              <a href="{{ $institut->facebook ?? '#' }}" target="_blank" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#b480ff,#d3aa95);color:white;font-size:16px;text-decoration:none;">
                  <i class="fa-brands fa-facebook-f"></i>
              </a>
              <a href="{{ $institut->whatsapp ? 'https://wa.me/'.preg_replace('/[^0-9]/', '', $institut->whatsapp) : '#' }}" target="_blank" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#b480ff,#d3aa95);color:white;font-size:16px;text-decoration:none;">
                   <i class="fa-brands fa-whatsapp"></i>
              </a>
           </div>
        </div>
        <div class="map-container">
            @if($institut->latitude && $institut->longitude)
                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $institut->longitude-0.01 }},{{ $institut->latitude-0.01 }},{{ $institut->longitude+0.01 }},{{ $institut->latitude+0.01 }}&layer=mapnik&marker={{ $institut->latitude }},{{ $institut->longitude }}"
                    width="100%" height="350" style="border:0; border-radius:16px;" loading="lazy">
                </iframe>
            @else
                <div class="map-placeholder">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>Location coming soon</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="footer" id="contact">
    <div class="footer-grid">

        <div class="footer-brand">
            <h2>{{ $institut->nom ?? 'Glow Institute' }}</h2>
            <p>Your trusted partner in beauty and wellness.</p>
            <div class="social-links footer-socials">
                <a href="{{ $institut->instagram ?? '#' }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $institut->facebook ?? '#' }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ $institut->whatsapp ? 'https://wa.me/'.preg_replace('/[^0-9]/', '', $institut->whatsapp) : '#' }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        {{-- QUICK LINKS --}}
        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#home" onclick="scrollToHome(event)">Home</a></li>
                <li><a href="#services">Services</a></li>
                @auth
                    @if(Auth::user()->isClient())
                        <li><a href="#skin-quiz">Skin Quiz</a></li>
                    @endif
                @endauth
                <li><a href="#products">Products</a></li>
                @auth
                    @if(Auth::user()->isClient())
                        <li><a href="#loyalty">Loyalty Status</a></li>
                    @endif
                @endauth
                <li><a href="#reviews">Reviews</a></li>
                <li><a href="#faq">FAQ</a></li>
                @auth
                    <li><a href="#contact-form">Contact Us</a></li>
                @endauth
                <li><a href="#about">About Us</a></li>
            </ul>
        </div>

        {{-- ACCOUNT --}}
        <div class="footer-links">
            <h4>Account</h4>
            <ul>
                @auth
                    <li><a href="{{ route('profile.edit') }}">My Profile</a></li>
                    @if(Auth::user()->isClient())
                        <li><a href="{{ route('client.rendez-vous.index') }}">My Appointments</a></li>
                        <li><a href="{{ route('client.commandes.index') }}">My Orders</a></li>
                        <li><a href="{{ route('client.factures.index') }}">My Invoices</a></li>
                        <li><a href="{{ route('client.avis.index') }}">My Reviews</a></li>
                        <li><a href="{{ route('client.fidelite.index') }}">Loyalty Points</a></li>
                        <li><a href="{{ route('client.panier.index') }}">My Cart</a></li>
                        <li><a href="{{ route('client.favoris.index') }}">Wishlist</a></li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                    <li><a href="{{ route('register.estheticienne') }}">Join as Expert</a></li>
                @endauth
            </ul>
        </div>

        <div class="footer-contact">
            <h4>Contact Us</h4>
            @if($institut->adresse)
                <p><i class="fa-solid fa-location-dot"></i> {{ $institut->adresse }}@if($institut->ville), {{ $institut->ville }}@endif</p>
            @endif
            @if($institut->telephone)
                <p><i class="fa-solid fa-phone"></i> {{ $institut->telephone }}</p>
            @endif
            @if($institut->email)
                <p><i class="fa-solid fa-envelope"></i> {{ $institut->email }}</p>
            @endif
        </div>

    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} {{ $institut->nom ?? 'Glow Institute' }}. All rights reserved.</p>
    </div>
</footer>

{{-- CSS affluence bar --}}
<style>
.affluence-bar {
    background: white;
    border-bottom: 1px solid #ede9fe;
    padding: 8px 5%;
}
.affluence-inner {
    display: flex; align-items: center; gap: 10px;
    font-size: 13px; color: #6b7280;
    flex-wrap: wrap;
}
.affluence-inner i { color: #b480ff; }
.affluence-label { font-weight: 600; color: #1a1a2e; }
.affluence-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 700;
}
.affluence-dot {
    width: 8px; height: 8px; border-radius: 50%;
}
.affluence-faible  { background: rgba(16,185,129,0.1); color: #059669; }
.affluence-faible .affluence-dot { background: #059669; }
.affluence-moyen   { background: rgba(245,158,11,0.1); color: #d97706; }
.affluence-moyen .affluence-dot  { background: #d97706; animation: pulse 1.5s infinite; }
.affluence-eleve   { background: rgba(239,68,68,0.1); color: #ef4444; }
.affluence-eleve .affluence-dot  { background: #ef4444; animation: pulse 1s infinite; }
.affluence-hint { font-size: 12px; color: #9ca3af; }
@keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.4;} }
/* ── NOTIFICATION PANEL ── */
.nav-notif-wrap { position:relative; }
.nav-icon-btn { background:none; border:none; cursor:pointer; }
.notif-panel {
    display:none; position:absolute; top:calc(100% + 12px); right:0;
    width:320px; background:white; border-radius:16px;
    border:1px solid #ede9fe; box-shadow:0 8px 32px rgba(180,128,255,0.15);
    z-index:9999; overflow:hidden;
}
.notif-panel.open { display:block; animation:notifIn 0.2s ease; }
@keyframes notifIn { from{opacity:0;transform:translateY(-8px);} to{opacity:1;transform:translateY(0);} }
.notif-panel-head {
    display:flex; align-items:center; justify-content:space-between;
    padding:14px 16px; border-bottom:1px solid #f5f3ff;
}
.notif-panel-title { font-size:13px; font-weight:800; color:#1a1a2e; }
.notif-read-all {
    font-size:11px; font-weight:600; color:#b480ff;
    background:none; border:none; cursor:pointer; font-family:inherit;
}
.notif-read-all:hover { text-decoration:underline; }
.notif-panel-body { max-height:320px; overflow-y:auto; }
.notif-item {
    display:flex; align-items:flex-start; gap:10px;
    padding:12px 16px; border-bottom:1px solid #faf8ff;
    transition:background 0.15s; cursor:default;
}
.notif-item:last-child { border-bottom:none; }
.notif-item.unread { background:rgba(180,128,255,0.04); }
.notif-item:hover  { background:#fdf9ff; }
.notif-dot {
    width:8px; height:8px; border-radius:50%; flex-shrink:0; margin-top:5px;
    background:#e5e7eb;
}
.notif-item.unread .notif-dot { background:#b480ff; }
.notif-msg  { font-size:12px; color:#374151; line-height:1.6; margin-bottom:3px; font-weight:500; }
.notif-time { font-size:10px; color:#9ca3af; }
.notif-empty { text-align:center; padding:32px 16px; }
.notif-empty i { font-size:28px; color:#e9d8fd; display:block; margin-bottom:8px; }
.notif-empty p { font-size:12px; color:#d1d5db; }

/* ── NOTIFICATION DROPDOWN — identique app.blade.php ── */
.client-notif-drop {
    position:absolute; top:calc(100% + 10px); right:0;
    width:320px; background:white; border-radius:16px;
    border:1px solid #ede9fe;
    box-shadow:0 8px 32px rgba(180,128,255,0.15);
    z-index:9999; overflow:hidden;
}
.client-notif-head {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 16px; border-bottom:1px solid #f5f3ff;
}
.client-notif-title {
    font-size:13px; font-weight:800; color:#1a1a2e;
    display:flex; align-items:center; gap:6px;
}
.client-notif-mark-all {
    font-size:11px; font-weight:600; color:#b480ff;
    background:none; border:none; cursor:pointer; font-family:inherit;
}
.client-notif-mark-all:hover { text-decoration:underline; }
.client-notif-list { max-height:320px; overflow-y:auto; }
.client-notif-item {
    display:flex; align-items:flex-start; gap:10px;
    padding:12px 16px; border-bottom:1px solid #faf8ff;
    transition:background 0.15s;
}
.client-notif-item:last-child { border-bottom:none; }
.client-notif-item:hover { background:#fdf9ff; }
.client-notif-dot {
    width:8px; height:8px; border-radius:50%;
    background:#b480ff; flex-shrink:0; margin-top:5px;
}
.client-notif-msg  { font-size:12px; color:#374151; line-height:1.6; font-weight:500; }
.client-notif-ago  { font-size:10px; color:#9ca3af; margin-top:2px; }
.client-notif-check {
    width:24px; height:24px; border-radius:50%; border:none;
    background:rgba(180,128,255,0.1); color:#b480ff;
    display:flex; align-items:center; justify-content:center;
    font-size:10px; cursor:pointer; transition:all 0.2s;
}
.client-notif-check:hover { background:#b480ff; color:white; }
.client-notif-empty {
    text-align:center; padding:32px 16px;
    font-size:12px; color:#d1d5db;
}
/* ── SOCIAL ICONS FIX ── */
.footer-socials a {
    display:inline-flex !important;
    align-items:center !important;
    justify-content:center !important;
    width:40px !important;
    height:40px !important;
    border-radius:50% !important;
    background:linear-gradient(135deg,#b480ff,#d3aa95) !important;
    color:white !important;
    font-size:16px !important;
    text-decoration:none !important;
    opacity:1 !important;
    visibility:visible !important;
}
.footer-socials a i {
    color:white !important;
    opacity:1 !important;
    visibility:visible !important;
}
.footer-socials {
    display:flex !important;
    gap:10px !important;
    margin-top:12px !important;
}
</style>

<script>
function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('open');
}

function scrollToHome(e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.querySelectorAll('a[href^="#"]').forEach(a => {
    if (a.getAttribute('href') === '#home') return;
    a.addEventListener('click', e => {
        e.preventDefault();
        const t = document.querySelector(a.getAttribute('href'));
        if (t) {
            const offset = 80; // hauteur navbar
            const top = t.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    });
});

function toggleFaq(btn) {
    const answer = btn.nextElementSibling;
    const isOpen = answer.classList.contains('open');
    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-question').forEach(b => b.classList.remove('open'));
    if (!isOpen) { answer.classList.add('open'); btn.classList.add('open'); }
}

function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    const arrow = document.getElementById('avatarArrow');
    dropdown.classList.toggle('open');
    arrow.classList.toggle('open');
}

document.addEventListener('click', function(e) {
    const btn = document.getElementById('avatarBtn');
    const dropdown = document.getElementById('userDropdown');
    if (btn && !btn.contains(e.target)) {
        dropdown.classList.remove('open');
        const arrow = document.getElementById('avatarArrow');
        if (arrow) arrow.classList.remove('open');
    }
});
function showToast(msg) {
    let toast = document.getElementById('toast-msg');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast-msg';
        toast.style.cssText = 'position:fixed;bottom:30px;right:30px;background:#1a1a2e;color:white;padding:12px 20px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;opacity:0;transition:opacity 0.3s;box-shadow:0 8px 24px rgba(0,0,0,0.2);';
        document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    clearTimeout(toast._timeout);
    toast._timeout = setTimeout(() => toast.style.opacity = '0', 2500);
}
// ── NOTIFICATION PANEL ──────────────────────────────────────────────
function toggleNotifs(e) {
    e.stopPropagation();
    document.getElementById('notifPanel').classList.toggle('open');
}
document.addEventListener('click', function(e) {
    var wrap = document.getElementById('notifWrap');
    var panel = document.getElementById('notifPanel');
    if (panel && wrap && !wrap.contains(e.target)) {
        panel.classList.remove('open');
    }
});
function markAllRead() {
    fetch('/notifications/read-all', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}', 'Accept': 'application/json' }
    }).then(function() {
        document.querySelectorAll('.notif-item.unread').forEach(function(el) {
            el.classList.remove('unread');
        });
        var badge = document.getElementById('notifBadge');
        if (badge) badge.style.display = 'none';
    }).catch(console.error);
}
</script>

</body>
</html>
