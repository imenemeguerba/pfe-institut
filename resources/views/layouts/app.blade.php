<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Glow Institute') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @auth
    @if(Auth::user()->isClient())
    <style>
    .navbar { position:fixed; top:0; left:0; right:0; z-index:100; background:white; box-shadow:0 2px 16px rgba(180,128,255,0.08); }
    .client-page-content { min-height:calc(100vh - 70px); background:#f8f5ff; padding:32px 24px; overflow-x:hidden; padding-top:calc(70px + 32px); }
    .nav-icon-btn { position:relative; display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; background:rgba(180,128,255,0.08); color:#b480ff; font-size:16px; text-decoration:none; transition:all 0.2s; border:1.5px solid rgba(180,128,255,0.15); }
    .nav-icon-btn:hover { background:rgba(180,128,255,0.18); transform:translateY(-1px); }
    .nav-icon-badge { position:absolute; top:-4px; right:-4px; min-width:17px; height:17px; border-radius:20px; background:#b480ff; color:white; font-size:9px; font-weight:800; display:flex; align-items:center; justify-content:center; padding:0 4px; border:2px solid white; }
    .nav-icon-badge.fav  { background:#ec4899; }
    .nav-icon-badge.cart { background:#d3aa95; }
    .nav-avatar-wrap { display:flex; align-items:center; gap:8px; cursor:pointer; padding:6px 12px; border-radius:30px; border:1.5px solid rgba(180,128,255,0.2); background:rgba(180,128,255,0.05); transition:all 0.2s; position:relative; user-select:none; }
    .nav-avatar-wrap:hover { border-color:#b480ff; background:rgba(180,128,255,0.1); }
    .nav-avatar-img  { width:30px; height:30px; border-radius:50%; object-fit:cover; }
    .nav-avatar-init { width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:700; display:flex; align-items:center; justify-content:center; }
    .nav-avatar-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
    .nav-avatar-arrow { font-size:10px; color:#b480ff; transition:transform 0.2s; }
    .nav-avatar-arrow.open { transform:rotate(180deg); }
    .nav-dropdown { position:absolute; top:58px; right:0; width:240px; background:white; border-radius:16px; border:1px solid #ede9fe; box-shadow:0 12px 40px rgba(180,128,255,0.15); display:none; z-index:999; overflow:hidden; }
    .nav-dropdown.open { display:block; animation:dropIn 0.2s ease; }
    @keyframes dropIn { from{opacity:0;transform:translateY(-8px);}to{opacity:1;transform:translateY(0);} }
    .nav-dropdown-header { padding:14px 16px; background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.06)); border-bottom:1px solid #ede9fe; }
    .nav-dropdown-name  { font-size:13px; font-weight:700; color:#1a1a2e; }
    .nav-dropdown-email { font-size:11px; color:#9ca3af; margin-top:2px; }
    .nav-dropdown-body  { padding:8px 0; }
    .nav-dropdown-item  { display:flex; align-items:center; gap:10px; padding:10px 16px; font-size:13px; color:#374151; text-decoration:none; transition:background 0.15s; font-weight:500; }
    .nav-dropdown-item i { color:#b480ff; width:16px; text-align:center; }
    .nav-dropdown-item:hover { background:#fdf9ff; color:#b480ff; }
    .nav-dropdown-footer { padding:8px 0; border-top:1px solid #ede9fe; }
    .nav-dropdown-logout { display:flex; align-items:center; gap:10px; width:100%; padding:10px 16px; font-size:13px; color:#ef4444; font-weight:500; background:none; border:none; cursor:pointer; font-family:inherit; transition:background 0.15s; }
    .nav-dropdown-logout:hover { background:#fff5f5; }
    .nav-links { display:flex; list-style:none; gap:28px; align-items:center; }
    .nav-links li a { font-size:16px; font-weight:500; color:#374151; text-decoration:none; transition:color 0.2s; }
    .nav-links li a:hover { color:#b480ff; }
    .client-notif-drop { position:absolute; top:48px; right:0; width:320px; background:white; border-radius:18px; border:1px solid #ede9fe; box-shadow:0 16px 48px rgba(180,128,255,0.18); z-index:9999; overflow:hidden; }
    .client-notif-head { display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-bottom:1px solid #f5f0ff; background:linear-gradient(135deg,rgba(180,128,255,0.06),rgba(211,170,149,0.04)); }
    .client-notif-title { font-size:13px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:6px; }
    .client-notif-mark-all { font-size:11px; font-weight:600; color:#b480ff; background:none; border:1.5px solid rgba(180,128,255,0.25); border-radius:20px; padding:4px 10px; cursor:pointer; font-family:inherit; transition:all 0.2s; }
    .client-notif-mark-all:hover { background:#b480ff; color:white; border-color:#b480ff; }
    .client-notif-list { max-height:340px; overflow-y:auto; }
    .client-notif-item { display:flex; align-items:flex-start; gap:10px; padding:12px 16px; border-bottom:1px solid #faf8ff; transition:background 0.15s; }
    .client-notif-item:last-child { border-bottom:none; }
    .client-notif-item:hover { background:#fdf9ff; }
    .client-notif-dot { width:8px; height:8px; border-radius:50%; background:#b480ff; flex-shrink:0; margin-top:5px; box-shadow:0 0 6px rgba(180,128,255,0.5); }
    .client-notif-msg { font-size:12px; font-weight:600; color:#1a1a2e; line-height:1.5; margin-bottom:3px; }
    .client-notif-ago { font-size:10px; color:#c4b5fd; }
    .client-notif-check { width:26px; height:26px; border-radius:50%; background:rgba(180,128,255,0.08); border:1.5px solid rgba(180,128,255,0.2); color:#b480ff; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:10px; transition:all 0.2s; font-family:inherit; flex-shrink:0; }
    .client-notif-check:hover { background:#b480ff; color:white; border-color:#b480ff; }
    .client-notif-empty { text-align:center; padding:32px 16px; font-size:12px; color:#c4b5fd; }
    </style>
    @endif
    @endauth

    {{-- ✅ GLOBAL CONFIRM MODAL CSS — all roles --}}
    <style>
    #glow-overlay { display:none; position:fixed; inset:0; background:rgba(26,10,53,0.5); z-index:99999; align-items:center; justify-content:center; backdrop-filter:blur(4px); }
    #glow-overlay.open { display:flex; }
    #glow-box { background:white; border-radius:22px; padding:32px 28px; max-width:380px; width:90%; text-align:center; box-shadow:0 20px 60px rgba(180,128,255,0.2); animation:glowBoxIn 0.25s ease; }
    @keyframes glowBoxIn { from{opacity:0;transform:scale(0.9) translateY(-10px);}to{opacity:1;transform:scale(1) translateY(0);} }
    #glow-box .gc-icon { width:54px; height:54px; border-radius:50%; margin:0 auto 16px; display:flex; align-items:center; justify-content:center; font-size:22px; }
    #glow-box .gc-icon.red    { background:rgba(239,68,68,0.1);   color:#ef4444; }
    #glow-box .gc-icon.orange { background:rgba(249,115,22,0.1);  color:#f97316; }
    #glow-box .gc-icon.purple { background:rgba(180,128,255,0.1); color:#b480ff; }
    #glow-box .gc-icon.green  { background:rgba(16,185,129,0.1);  color:#059669; }
    #glow-box h3 { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:8px; }
    #glow-box p  { font-size:13px; color:#6b7280; margin-bottom:24px; line-height:1.6; }
    #glow-box .gc-actions { display:flex; gap:10px; justify-content:center; }
    #glow-box .gc-cancel  { padding:10px 22px; border-radius:30px; border:1.5px solid #ede9fe; background:white; color:#6b7280; font-size:13px; font-weight:600; cursor:pointer; font-family:inherit; transition:all 0.2s; }
    #glow-box .gc-cancel:hover { border-color:#b480ff; color:#b480ff; }
    #glow-box .gc-confirm { padding:10px 22px; border-radius:30px; border:none; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; color:white; transition:all 0.2s; }
    </style>
</head>
<body x-data="{}">

@auth
@if(Auth::user()->isClient())

    {{-- CLIENT LAYOUT --}}
    @php
        $clientNotifs = Auth::user()->notifications()->whereNull('read_at')->latest()->take(8)->get();
        $nbNotifs     = $clientNotifs->count();
        $nbFavoris    = Auth::user()->produitsFavoris()->count();
        $nbPanier     = session('panier') ? array_sum(array_column(session('panier'), 'quantite')) : 0;
        $institut     = \App\Models\Institut::instance();
    @endphp

    <nav class="navbar">
        <div class="logo">
            <a href="{{ route('landingpage') }}">
                <img src="{{ asset('images/Glow.png') }}" alt="logo">
                <h2>{{ $institut->nom ?? 'Glow Institute' }}</h2>
            </a>
        </div>

        <ul class="nav-links" id="navLinksClient">
            <li><a href="{{ route('landingpage') }}">Home</a></li>
            <li><a href="{{ route('client.services.index') }}">Services</a></li>
            <li><a href="{{ route('client.produits.index') }}">Shop</a></li>
            <li><a href="{{ route('client.reservation.create') }}">Book Now</a></li>
        </ul>

        <div class="right-section">
            <div style="position:relative;" x-data="{ open: false }">
                <button class="nav-icon-btn" @click="open = !open" title="Notifications" style="border:none;cursor:pointer;font-family:inherit;">
                    <i class="fa-solid fa-bell"></i>
                    @if($nbNotifs > 0)<span class="nav-icon-badge">{{ $nbNotifs > 9 ? '9+' : $nbNotifs }}</span>@endif
                </button>
                <div x-show="open" @click.outside="open = false" x-transition class="client-notif-drop" style="display:none;">
                    <div class="client-notif-head">
                        <span class="client-notif-title"><i class="fa-solid fa-bell" style="font-size:11px;"></i> Notifications</span>
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
                                    <button type="submit" class="client-notif-check" title="Mark as read"><i class="fa-solid fa-check"></i></button>
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

            <a href="{{ route('client.favoris.index') }}" class="nav-icon-btn" title="Favorites">
                <i class="fa-regular fa-heart"></i>
                @if($nbFavoris > 0)<span class="nav-icon-badge fav">{{ $nbFavoris }}</span>@endif
            </a>
            <a href="{{ route('client.panier.index') }}" class="nav-icon-btn" title="Cart">
                <i class="fa-solid fa-cart-shopping"></i>
                @if($nbPanier > 0)<span class="nav-icon-badge cart">{{ $nbPanier }}</span>@endif
            </a>

            <div style="position:relative;">
                <div class="nav-avatar-wrap" onclick="toggleClientMenu()" id="clientAvatarBtn">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/'.Auth::user()->photo) }}" class="nav-avatar-img" alt="">
                    @else
                        <div class="nav-avatar-init">{{ strtoupper(substr(Auth::user()->prenom,0,1)) }}</div>
                    @endif
                    <span class="nav-avatar-name">{{ Auth::user()->prenom }}</span>
                    <i class="fa-solid fa-chevron-down nav-avatar-arrow" id="clientAvatarArrow"></i>
                </div>
                <div class="nav-dropdown" id="clientUserDropdown">
                    <div class="nav-dropdown-header">
                        <p class="nav-dropdown-name">{{ Auth::user()->fullName() }}</p>
                        <p class="nav-dropdown-email">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="nav-dropdown-body">
                        <a href="{{ route('profile.edit') }}" class="nav-dropdown-item"><i class="fa-solid fa-user"></i> My Profile</a>
                        <a href="{{ route('client.rendez-vous.index') }}" class="nav-dropdown-item"><i class="fa-regular fa-calendar-check"></i> My Appointments</a>
                        <a href="{{ route('client.commandes.index') }}" class="nav-dropdown-item"><i class="fa-solid fa-box"></i> My Orders</a>
                        <a href="{{ route('client.factures.index') }}" class="nav-dropdown-item"><i class="fa-solid fa-file-invoice"></i> My Invoices</a>
                        <a href="{{ route('client.avis.index') }}" class="nav-dropdown-item"><i class="fa-regular fa-star"></i> My Reviews</a>
                        <a href="{{ route('client.fidelite.index') }}" class="nav-dropdown-item"><i class="fa-solid fa-gift"></i> Loyalty Points</a>
                        <a href="{{ route('client.panier.index') }}" class="nav-dropdown-item">
                            <i class="fa-solid fa-cart-shopping"></i> My Cart
                            @if($nbPanier > 0)<span style="margin-left:auto;background:#d3aa95;color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $nbPanier }}</span>@endif
                        </a>
                        <a href="{{ route('client.favoris.index') }}" class="nav-dropdown-item">
                            <i class="fa-regular fa-heart"></i> Wishlist
                            @if($nbFavoris > 0)<span style="margin-left:auto;background:#ec4899;color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $nbFavoris }}</span>@endif
                        </a>
                        <a href="{{ url('/client/contact') }}" class="nav-dropdown-item"><i class="fa-solid fa-envelope"></i> Contact Us</a>
                    </div>
                    <div class="nav-dropdown-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-dropdown-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hamburger" onclick="toggleClientNav()"><i class="fa-solid fa-bars"></i></div>
        </div>
    </nav>

    <div class="client-page-content">{{ $slot }}</div>

@else

    {{-- ADMIN / ESTHÉTICIENNE LAYOUT --}}
    <div class="app-layout">
        <aside class="sidebar" id="sidebar">
            <a href="{{ route('dashboard') }}" class="sb-logo">
                <div class="sb-logo-text">
                    <div class="sb-logo-name">Glow Institute</div>
                </div>
            </a>

            <nav class="sb-nav" id="sidebarNav">
                @if(Auth::user()->role === 'admin')
                    <div class="sb-section">
                        <div class="sb-section-label">Overview</div>
                        <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
                        <a href="{{ route('admin.statistiques.index') }}" class="sb-link {{ request()->routeIs('admin.statistiques.*') ? 'active' : '' }}"><i class="fa-solid fa-chart-line"></i> Statistics</a>
                        <a href="{{ route('admin.rendez-vous.calendrier') }}" class="sb-link {{ request()->routeIs('admin.rendez-vous.calendrier') ? 'active' : '' }}"><i class="fa-regular fa-calendar"></i> Calendar</a>
                    </div>
                    @php
                        $sbOrders   = \App\Models\Commande::where('statut','en_attente')->count();
                        $sbExperts  = \App\Models\User::where('role','estheticienne')->where('statut_compte','en_attente_validation')->count();
                        $sbReviews  = \App\Models\Avis::where('statut','en_attente')->count();
                        $sbDel      = \App\Models\DemandeSuppression::where('statut','en_attente')->count();
                        $sbStock    = \App\Models\Produit::where('actif',true)->where('stock','<=',5)->count();
                        $sbMessages = \App\Models\MessageContact::where('lu',false)->count();
                        $sbRdv      = \App\Models\RendezVous::whereDate('date_debut', today())->count();
                    @endphp
                    <div class="sb-section">
                        <div class="sb-section-label">Management</div>
                        <a href="{{ route('admin.rendez-vous.index') }}" class="sb-link {{ request()->routeIs('admin.rendez-vous.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-calendar-check"></i> Appointments
                            @if($sbRdv > 0)<span class="sb-badge">{{ $sbRdv }}</span>@endif
                        </a>
                        <a href="{{ route('admin.commandes.index') }}" class="sb-link {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i> Orders
                            @if($sbOrders > 0)<span class="sb-badge">{{ $sbOrders }}</span>@endif
                        </a>
                        <a href="{{ route('admin.clients.index') }}" class="sb-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Clients</a>
                        <a href="{{ route('admin.estheticiennes.index') }}" class="sb-link {{ request()->routeIs('admin.estheticiennes.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-nurse"></i> Experts
                            @if($sbExperts > 0)<span class="sb-badge">{{ $sbExperts }}</span>@endif
                        </a>
                    </div>
                    <div class="sb-section">
                        <div class="sb-section-label">Catalogue</div>
                        <a href="{{ route('admin.services.index') }}" class="sb-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="fa-solid fa-spa"></i> Services</a>
                        <a href="{{ route('admin.produits.index') }}" class="sb-link {{ request()->routeIs('admin.produits.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-box"></i> Products
                            @if($sbStock > 0)<span class="sb-badge">{{ $sbStock }}</span>@endif
                        </a>
                        <a href="{{ route('admin.codes-promo.index') }}" class="sb-link {{ request()->routeIs('admin.codes-promo.*') ? 'active' : '' }}"><i class="fa-solid fa-tag"></i> Promo Codes</a>
                    </div>
                    <div class="sb-section">
                        <div class="sb-section-label">Content</div>
                        <a href="{{ route('admin.avis.index') }}" class="sb-link {{ request()->routeIs('admin.avis.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-star"></i> Reviews
                            @if($sbReviews > 0)<span class="sb-badge purple">{{ $sbReviews }}</span>@endif
                        </a>
                        <a href="{{ route('admin.messages-contact.index') }}" class="sb-link {{ request()->routeIs('admin.messages-contact.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-envelope"></i> Messages
                            @if($sbMessages > 0)<span class="sb-badge blue">{{ $sbMessages }}</span>@endif
                        </a>
                        <a href="{{ route('admin.factures.index') }}" class="sb-link {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}"><i class="fa-solid fa-file-invoice"></i> Invoices</a>
                        <a href="{{ route('admin.institut.edit') }}" class="sb-link {{ request()->routeIs('admin.institut.*') ? 'active' : '' }}"><i class="fa-solid fa-building"></i> Institut</a>
                        <a href="{{ route('admin.demandes-suppression.index') }}" class="sb-link {{ request()->routeIs('admin.demandes-suppression.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-trash"></i> Deletions
                            @if($sbDel > 0)<span class="sb-badge">{{ $sbDel }}</span>@endif
                        </a>
                    </div>

                @elseif(Auth::user()->role === 'estheticienne')
                    <div class="sb-section">
                        <div class="sb-section-label">Overview</div>
                        <a href="{{ route('estheticienne.dashboard') }}" class="sb-link {{ request()->routeIs('estheticienne.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
                        <a href="{{ route('estheticienne.performance.index') }}" class="sb-link {{ request()->routeIs('estheticienne.performance.*') ? 'active' : '' }}"><i class="fa-solid fa-chart-line"></i> Performance</a>
                    </div>
                    <div class="sb-section">
                        <div class="sb-section-label">Work</div>
                        <a href="{{ route('estheticienne.planning.index') }}" class="sb-link {{ request()->routeIs('estheticienne.planning.*') ? 'active' : '' }}"><i class="fa-regular fa-calendar"></i> Planning</a>
                        <a href="{{ route('estheticienne.rendez-vous.index') }}" class="sb-link {{ request()->routeIs('estheticienne.rendez-vous.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-calendar-check"></i> Appointments
                            @php $rdvEnAttente = Auth::user()->rendezVousAssignes()->where('statut','en_attente')->count(); @endphp
                            @if($rdvEnAttente > 0)<span class="sb-badge">{{ $rdvEnAttente }}</span>@endif
                        </a>
                        <a href="{{ route('estheticienne.avant-apres.index') }}" class="sb-link {{ request()->routeIs('estheticienne.avant-apres.*') ? 'active' : '' }}"><i class="fa-solid fa-images"></i> Before & After</a>
                        <a href="{{ route('estheticienne.avis.index') }}" class="sb-link {{ request()->routeIs('estheticienne.avis.*') ? 'active' : '' }}"><i class="fa-solid fa-star"></i> My Reviews</a>
                    </div>
                    <div class="sb-section">
                        <div class="sb-section-label">Account</div>
                        <a href="{{ route('profile.edit') }}" class="sb-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"><i class="fa-solid fa-user"></i> My Profile</a>
                        <a href="{{ route('estheticienne.contact.index') }}" class="sb-link {{ request()->routeIs('estheticienne.contact.*') ? 'active' : '' }}"><i class="fa-solid fa-envelope"></i> Contact</a>
                    </div>
                @endif
            </nav>

            <div class="sb-footer">
                <div class="sb-user">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/'.Auth::user()->photo) }}" class="sb-avatar" alt="">
                    @else
                        <div class="sb-avatar">{{ strtoupper(substr(Auth::user()->prenom,0,1)) }}</div>
                    @endif
                    <div>
                        <div class="sb-user-name">{{ Auth::user()->prenom }}</div>
                        <div class="sb-user-role">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Beauty Expert' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sb-logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>
                </form>
            </div>
        </aside>

        <div class="main-area" id="mainArea">
            <div class="topbar">
                <div class="topbar-left">
                    <button class="hamburger" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
                    @isset($header)<span class="topbar-title">{{ $header }}</span>@endisset
                </div>
                <div class="topbar-right">
                    @php
                        $notifs   = auth()->user()->notifications()->whereNull('read_at')->latest()->take(8)->get();
                        $nbNotifs = $notifs->count();
                    @endphp
                    <div class="relative" x-data="{ open: false }">
                        <button class="topbar-bell" @click="open = !open">
                            <i class="fa-solid fa-bell"></i>
                            @if($nbNotifs > 0)<span class="bell-badge">{{ $nbNotifs > 9 ? '9+' : $nbNotifs }}</span>@endif
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition class="notif-drop" style="display:none;">
                            <div class="notif-head">
                                <span>Notifications</span>
                                @if($nbNotifs > 0)
                                    <form method="POST" action="{{ route('notifications.marquer-lues') }}">
                                        @csrf <button type="submit" class="notif-mark-all">Mark all read</button>
                                    </form>
                                @endif
                            </div>
                            <div class="notif-list">
                                @forelse($notifs as $n)
                                    @php $d = json_decode($n->data, true); @endphp
                                    <div class="notif-item">
                                        <div class="notif-dot"></div>
                                        <div style="flex:1;">
                                            <div class="notif-msg">{{ $d['message'] ?? 'New notification' }}</div>
                                            <div class="notif-ago">{{ $n->created_at->diffForHumans() }}</div>
                                        </div>
                                        <form method="POST" action="{{ route('notifications.marquer-lue', $n->id) }}">
                                            @csrf
                                            <button type="submit" class="notif-check"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="notif-empty">No new notifications</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <div class="topbar-user" @click="open = !open">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/'.Auth::user()->photo) }}" class="topbar-av" alt="">
                            @else
                                <div class="topbar-av">{{ strtoupper(substr(Auth::user()->prenom,0,1)) }}</div>
                            @endif
                            <span class="topbar-name">{{ Auth::user()->prenom }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size:9px;color:#9ca3af;"></i>
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="user-drop" style="display:none;">
                            <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-user"></i> My Profile</a>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.institut.edit') }}"><i class="fa-solid fa-building"></i> Institut</a>
                            @endif
                            <div class="drop-sep"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="drop-logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content" id="pageContent">{{ $slot }}</div>
        </div>
    </div>

@endif

{{-- ✅ GLOBAL CONFIRM MODAL — all roles --}}
<div id="glow-overlay">
    <div id="glow-box">
        <div class="gc-icon red" id="gc-icon"><i class="fa-solid fa-triangle-exclamation" id="gc-icon-i"></i></div>
        <h3 id="gc-title">Are you sure?</h3>
        <p  id="gc-msg">This action cannot be undone.</p>
        <div class="gc-actions">
            <button class="gc-cancel" onclick="glowModalClose()">Cancel</button>
            <button class="gc-confirm red" id="gc-btn" onclick="glowModalConfirm()">Confirm</button>
        </div>
    </div>
</div>

@else
    <div class="page-content">{{ $slot }}</div>
@endauth

<script>
var _glowCb = null;
function glowConfirm(title, msg, btnText, iconType, btnColor, callback) {
    iconType = iconType || 'fa-triangle-exclamation';
    btnColor = btnColor || 'red';
    var iconCls = (btnColor === 'red' || btnColor === 'orange' || btnColor === 'purple' || btnColor === 'green') ? btnColor : 'red';
    document.getElementById('gc-icon').className   = 'gc-icon ' + iconCls;
    document.getElementById('gc-icon-i').className = 'fa-solid ' + iconType;
    document.getElementById('gc-title').textContent = title;
    document.getElementById('gc-msg').textContent   = msg;
    document.getElementById('gc-btn').textContent   = btnText;
    var colors = { red:'#ef4444', orange:'#f97316', purple:'linear-gradient(to right,#b480ff,#d3aa95)', green:'#059669' };
    var btn = document.getElementById('gc-btn');
    btn.style.background = colors[btnColor] || btnColor || '#ef4444';
    btn.className = 'gc-confirm';
    _glowCb = callback;
    var ov = document.getElementById('glow-overlay');
    if (ov) { ov.style.display = 'flex'; ov.classList.add('open'); }
}
function glowModalClose() {
    var ov = document.getElementById('glow-overlay');
    if (ov) { ov.classList.remove('open'); ov.style.display = 'none'; }
    _glowCb = null;
}
function glowModalConfirm() { var cb = _glowCb; glowModalClose(); if (cb) cb(); }
document.addEventListener('DOMContentLoaded', function() {
    var ov = document.getElementById('glow-overlay');
    if (ov) ov.addEventListener('click', function(e) { if (e.target === this) glowModalClose(); });
});

function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var main    = document.getElementById('mainArea');
    if (!sidebar) return;
    var isOpen = !sidebar.classList.contains('collapsed');
    sidebar.classList.toggle('collapsed');
    if (main) main.style.marginLeft = isOpen ? '0' : '248px';
}
var sidebar = document.getElementById('sidebar');
var SCROLL_KEY = 'sb_scroll';
var saved = sessionStorage.getItem(SCROLL_KEY);
if (saved && sidebar) sidebar.scrollTop = parseInt(saved);
if (sidebar) sidebar.addEventListener('scroll', function() { sessionStorage.setItem(SCROLL_KEY, sidebar.scrollTop); });

function toggleClientMenu() {
    var dropdown = document.getElementById('clientUserDropdown');
    var arrow    = document.getElementById('clientAvatarArrow');
    if (!dropdown) return;
    dropdown.classList.toggle('open');
    if (arrow) arrow.classList.toggle('open');
}
document.addEventListener('click', function(e) {
    var btn      = document.getElementById('clientAvatarBtn');
    var dropdown = document.getElementById('clientUserDropdown');
    if (btn && !btn.contains(e.target) && dropdown) {
        dropdown.classList.remove('open');
        var arrow = document.getElementById('clientAvatarArrow');
        if (arrow) arrow.classList.remove('open');
    }
});
function toggleClientNav() {
    var nav = document.getElementById('navLinksClient');
    if (nav) nav.classList.toggle('open');
}
</script>
</body>
</html>
