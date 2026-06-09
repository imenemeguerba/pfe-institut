<x-app-layout>
<x-slot name="header">Shop</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.sh-hero { position:relative; overflow:hidden; padding:60px 10% 110px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.sh-orb { position:absolute; border-radius:50%; animation:orbPulse ease-in-out infinite alternate; }
.sh-orb-1 { width:350px; height:350px; top:-100px; right:-80px; background:radial-gradient(circle,rgba(255,255,255,0.08),transparent 70%); animation-duration:5s; }
.sh-orb-2 { width:250px; height:250px; bottom:-60px; left:-40px; background:radial-gradient(circle,rgba(255,255,255,0.06),transparent 70%); animation-duration:7s; animation-delay:1s; }
@keyframes orbPulse { from{transform:scale(1);} to{transform:scale(1.2);} }
.sh-hero-content { position:relative; z-index:2; text-align:center; }
.sh-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.sh-hero-title { font-family:'Playfair Display',serif; font-size:46px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:12px; line-height:1.2; }
.sh-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.sh-hero-sub { font-size:15px; color:rgba(255,255,255,0.92); margin-bottom:28px; }
.sh-hero-actions { display:flex; justify-content:center; gap:12px; flex-wrap:wrap; }
.sh-hero-btn { display:inline-flex; align-items:center; gap:6px; padding:10px 22px; border-radius:30px; font-size:13px; font-weight:700; text-decoration:none; transition:all 0.2s; }
.sh-hero-btn.cart { background:white; color:#7c3aed; box-shadow:0 4px 20px rgba(0,0,0,0.15); }
.sh-hero-btn.cart:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(180,128,255,0.5); }
.sh-hero-btn.fav  { background:rgba(255,255,255,0.15); border:1.5px solid rgba(255,255,255,0.35); color:white; }
.sh-hero-btn.fav:hover { background:rgba(255,255,255,0.25); }
.sh-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.sh-body { max-width:1200px; margin:0 auto; padding:40px 24px 80px; }

/* FILTER */
.sh-filter { background:white; border-radius:20px; padding:20px 24px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.07); margin-bottom:20px; }
.sh-filter-row { display:flex; gap:10px; flex-wrap:wrap; align-items:center; }
.sh-f-input { padding:10px 14px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; outline:none; font-family:'Plus Jakarta Sans',sans-serif; transition:border-color 0.2s; }
.sh-f-input:focus { border-color:#b480ff; background:white; }
.sh-f-search { flex:1; min-width:200px; }
.sh-f-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 10px center; background-size:14px; padding-right:30px; cursor:pointer; }
.btn-filter-sh { padding:10px 20px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; white-space:nowrap; }
.btn-filter-sh:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(180,128,255,0.4); }
/* ✅ reset button - toujours présent mais visible seulement si actif */
.btn-reset-sh { padding:8px 12px; border-radius:30px; background:white; color:#9ca3af; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px; }
.btn-reset-sh:hover { border-color:#ef4444; color:#ef4444; }
.btn-reset-sh.hidden { visibility:hidden; pointer-events:none; }

/* CAT PILLS */
.sh-cat-pills { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:24px; }
.sh-cat-pill { padding:7px 16px; border-radius:30px; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; color:#6b7280; text-decoration:none; transition:all 0.2s; background:white; display:inline-flex; align-items:center; gap:5px; cursor:pointer; }
.sh-cat-pill:hover { border-color:#b480ff; color:#b480ff; background:#fdf9ff; }
.sh-cat-pill.active { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.3); }

.sh-count { font-size:13px; color:#9ca3af; margin-bottom:20px; }
.sh-count strong { color:#1a1a2e; }
.sh-loading { text-align:center; padding:60px; color:#b480ff; font-size:13px; font-weight:600; }
.sh-loading i { font-size:28px; margin-bottom:10px; display:block; animation:spin 1s linear infinite; }
@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

/* GRID */
.sh-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; }
.sh-card { background:white; border-radius:20px; overflow:hidden; border:1px solid #ede9fe; box-shadow:0 4px 16px rgba(180,128,255,0.06); transition:all 0.4s cubic-bezier(0.175,0.885,0.32,1.275); opacity:0; animation:cardIn 0.5s forwards; }
.sh-card:nth-child(1){animation-delay:0s} .sh-card:nth-child(2){animation-delay:.05s} .sh-card:nth-child(3){animation-delay:.1s} .sh-card:nth-child(4){animation-delay:.15s}
.sh-card:nth-child(5){animation-delay:.2s} .sh-card:nth-child(6){animation-delay:.25s} .sh-card:nth-child(7){animation-delay:.3s} .sh-card:nth-child(8){animation-delay:.35s}
@keyframes cardIn { from{opacity:0;transform:translateY(24px) scale(0.96);} to{opacity:1;transform:translateY(0) scale(1);} }
.sh-card:hover { transform:translateY(-8px) scale(1.01); box-shadow:0 20px 50px rgba(180,128,255,0.15); border-color:#c4b5fd; }

.sh-card-img { position:relative; height:260px; overflow:hidden; }
.sh-card-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.5s; }
.sh-card:hover .sh-card-img img { transform:scale(1.08); }
.sh-card-img-ph { width:100%; height:100%; background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; }

/* ✅ Overlay: pointer-events:none par défaut pour laisser passer les clics sur le cœur */
.sh-card-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(26,10,53,0.6),transparent); opacity:0; transition:opacity 0.3s; display:flex; align-items:flex-end; padding:12px; pointer-events:none; z-index:1; }
.sh-card:hover .sh-card-overlay { opacity:1; pointer-events:auto; }
/* ✅ Fav form au-dessus de l'overlay via z-index */
.sh-fav-form { position:absolute; top:10px; right:10px; z-index:3; margin:0; padding:0; }
.sh-fav-btn { width:32px; height:32px; border-radius:50%; background:white; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:13px; color:#9ca3af; box-shadow:0 2px 8px rgba(0,0,0,0.12); transition:all 0.2s; }
.sh-fav-btn:hover { transform:scale(1.2); box-shadow:0 4px 14px rgba(236,72,153,0.3); color:#ef4444; }
.sh-fav-btn.active { color:#ef4444; background:#fff0f3; }

.sh-stock-badge { position:absolute; top:10px; left:10px; z-index:2; padding:3px 10px; border-radius:20px; font-size:10px; font-weight:700; }
.sh-stock-badge.low { background:rgba(239,68,68,0.9); color:white; }
.sh-panier-badge { position:absolute; bottom:10px; right:10px; z-index:2; padding:3px 10px; border-radius:20px; font-size:10px; font-weight:700; background:rgba(180,128,255,0.9); color:white; }
.sh-overlay-link { display:inline-flex; align-items:center; gap:5px; padding:7px 14px; border-radius:20px; background:rgba(255,255,255,0.9); color:#b480ff; font-size:11px; font-weight:700; text-decoration:none; }

.sh-card-body { padding:16px; }
.sh-card-cat  { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#b480ff; margin-bottom:4px; }
.sh-card-name { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:5px; }
.sh-card-desc { font-size:11px; color:#9ca3af; line-height:1.5; margin-bottom:12px; }
.sh-card-foot { display:flex; align-items:center; justify-content:space-between; }
.sh-card-price { font-size:18px; font-weight:900; color:#b480ff; }
.sh-card-stock { font-size:10px; color:#c4b5fd; margin-top:1px; }
.sh-add-btn { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); border:none; cursor:pointer; color:white; font-size:15px; transition:all 0.2s; }
.sh-add-btn:hover { transform:scale(1.15); box-shadow:0 4px 14px rgba(180,128,255,0.5); }

.sh-empty { text-align:center; padding:80px 24px; background:white; border-radius:24px; border:1px solid #ede9fe; }
.sh-empty i { font-size:48px; color:#e9d8fd; margin-bottom:16px; display:block; }
.sh-empty p { font-size:14px; color:#c4b5fd; }

/* ✅ PAGINATION CUSTOM */
.sh-pagination { margin-top:32px; display:flex; justify-content:center; }
.sh-pag-nav { display:flex; align-items:center; gap:6px; flex-wrap:wrap; justify-content:center; }
.sh-pag-btn { display:inline-flex; align-items:center; justify-content:center; min-width:38px; height:38px; padding:0 10px; border-radius:12px; font-size:13px; font-weight:700; text-decoration:none; transition:all 0.2s; border:1.5px solid #ede9fe; background:white; color:#6b7280; cursor:pointer; }
.sh-pag-btn:hover { border-color:#b480ff; color:#b480ff; background:#fdf9ff; transform:translateY(-1px); }
.sh-pag-btn.sh-pag-active { background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.35); cursor:default; }
.sh-pag-btn.sh-pag-disabled { color:#d1d5db; cursor:not-allowed; background:#f9fafb; }
.sh-pag-btn.sh-pag-disabled:hover { border-color:#ede9fe; color:#d1d5db; background:#f9fafb; transform:none; }
.sh-pag-btn.sh-pag-dots { cursor:default; border:none; background:none; }
.sh-pag-btn.sh-pag-dots:hover { transform:none; border:none; background:none; color:#9ca3af; }

@media(max-width:1024px){ .sh-grid{ grid-template-columns:repeat(3,1fr); } }
@media(max-width:768px) { .sh-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:480px) { .sh-grid{ grid-template-columns:1fr; } .sh-filter-row{ flex-direction:column; } .sh-f-search{ min-width:auto; width:100%; } }
</style>

{{-- HERO --}}
<div class="sh-hero">
    <div class="sh-orb sh-orb-1"></div>
    <div class="sh-orb sh-orb-2"></div>
    <div class="sh-hero-content">
        <div class="sh-hero-tag"><i class="fa-solid fa-bottle-droplet"></i> Beauty Shop</div>
        <h1 class="sh-hero-title">Premium <span>Products</span></h1>
        <p class="sh-hero-sub">Curated beauty products selected by our experts for your daily routine</p>
        <div class="sh-hero-actions">
            <a href="{{ route('client.panier.index') }}" class="sh-hero-btn cart">
                <i class="fa-solid fa-cart-shopping"></i> My Cart
            </a>
            <a href="{{ route('client.favoris.index') }}" class="sh-hero-btn fav">
                <i class="fa-regular fa-heart"></i> Favorites
            </a>
        </div>
    </div>
    <div class="sh-wave"></div>
</div>

<div class="sh-body">

    {{-- FILTER --}}
    <div class="sh-filter">
        <form id="filterForm" method="GET" action="{{ route('client.produits.index') }}">
            <div class="sh-filter-row">
                <input type="text" name="search" id="filterSearch" value="{{ $search }}" placeholder="Search a product..." class="sh-f-input sh-f-search">
                <select name="categorie" id="filterCat" class="sh-f-input sh-f-select">
                    <option value="">All categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categorieId==$cat->id?'selected':'' }}>{{ $cat->nom }}</option>
                    @endforeach
                </select>
                <input type="number" name="prix_max" id="filterPrix" value="{{ $prixMax }}" min="0" step="100" placeholder="Max price (DA)" class="sh-f-input" style="width:160px;">
                <select name="tri" id="filterTri" class="sh-f-input sh-f-select" style="width:140px;">
                    <option value="nom"       {{ $tri==='nom'?'selected':'' }}>Name A-Z</option>
                    <option value="prix_asc"  {{ $tri==='prix_asc'?'selected':'' }}>Price ↑</option>
                    <option value="prix_desc" {{ $tri==='prix_desc'?'selected':'' }}>Price ↓</option>
                </select>
                <button type="submit" class="btn-filter-sh"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
                {{-- ✅ reset button toujours présent --}}
                <button type="button" id="resetBtn" class="btn-reset-sh {{ (!$search && !$categorieId && !$prixMax) ? 'hidden' : '' }}" onclick="shReset()">
                    <i class="fa-solid fa-xmark"></i> Clear
                </button>
            </div>
        </form>
    </div>

    {{-- CAT PILLS --}}
    <div class="sh-cat-pills">
        <a href="{{ route('client.produits.index') }}" class="sh-cat-pill {{ !$categorieId?'active':'' }}" data-cat="">
            <i class="fa-solid fa-border-all"></i> All
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('client.produits.index', ['categorie'=>$cat->id]) }}"
               class="sh-cat-pill {{ $categorieId==$cat->id?'active':'' }}"
               data-cat="{{ $cat->id }}">{{ $cat->nom }}</a>
        @endforeach
    </div>

    {{-- CONTENT --}}
    <div id="sh-content">
        <div class="sh-count"><strong>{{ $produits->total() }}</strong> product(s) found</div>
        @if($produits->isEmpty())
            <div class="sh-empty">
                <i class="fa-solid fa-bottle-droplet"></i>
                <p>No products match your criteria.</p>
            </div>
        @else
            <div class="sh-grid">
                @foreach($produits as $produit)
                    <div class="sh-card">
                        <div class="sh-card-img">
                            @if($produit->image)
                                <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}">
                            @else
                                <div class="sh-card-img-ph">
                                    <i class="fa-solid fa-bottle-droplet" style="font-size:48px;color:#b480ff;opacity:0.4;"></i>
                                </div>
                            @endif
                            @if($produit->stock <= 5)
                                <span class="sh-stock-badge low">Low stock</span>
                            @endif
                            @if(isset($panierProduits[$produit->id]) && $panierProduits[$produit->id] > 0)
                                <span class="sh-panier-badge">{{ $panierProduits[$produit->id] }} in cart</span>
                            @endif
                            {{-- ✅ FIX fav: z-index:3 form, pointer-events:none overlay --}}
                            <form action="{{ route('client.favoris.toggle', $produit) }}" method="POST" class="sh-fav-form">
                                @csrf
                                <button type="submit" class="sh-fav-btn {{ in_array($produit->id,$favorisIds)?'active':'' }}" title="Favorite">
                                    <i class="fa-{{ in_array($produit->id,$favorisIds)?'solid':'regular' }} fa-heart"></i>
                                </button>
                            </form>
                            <div class="sh-card-overlay">
                                <a href="{{ route('client.produits.show', $produit) }}" class="sh-overlay-link">
                                    <i class="fa-solid fa-eye"></i> View Details
                                </a>
                            </div>
                        </div>
                        <div class="sh-card-body">
                            @if($produit->categorie)
                                <div class="sh-card-cat">{{ $produit->categorie->nom }}</div>
                            @endif
                            <div class="sh-card-name">{{ $produit->nom }}</div>
                            @if($produit->description)
                                <div class="sh-card-desc">{{ Str::limit($produit->description,60) }}</div>
                            @endif
                            <div class="sh-card-foot">
                                <div>
                                    <div class="sh-card-price">{{ number_format($produit->prix,0,',',' ') }} DA</div>
                                    <div class="sh-card-stock">{{ $produit->stock }} in stock</div>
                                </div>
                                <form action="{{ route('client.panier.ajouter', $produit) }}" method="POST" class="sh-cart-form">
                                    @csrf
                                    <button type="submit" class="sh-add-btn" title="Add to cart">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="sh-pagination">
                {{ $produits->links('vendor.pagination.glow') }}
            </div>
        @endif
    </div>

{{-- TOAST --}}
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
</div>

<script>
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid ' + (type==='error'?'fa-circle-xmark':'fa-circle-check') + '" style="font-size:14px;flex-shrink:0;"></i><span>' + msg + '</span>';
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex'; t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); }, 4000);
}

const BASE_URL = '{{ route("client.produits.index") }}';

// ─── BUILD PARAMS FROM CURRENT FORM ───────────────────────────────────────
function buildParams() {
    const params = new URLSearchParams();
    const s = document.getElementById('filterSearch').value.trim();
    const c = document.getElementById('filterCat').value;
    const p = document.getElementById('filterPrix').value;
    const t = document.getElementById('filterTri').value;
    if (s) params.set('search', s);
    if (c) params.set('categorie', c);
    if (p) params.set('prix_max', p);
    if (t && t !== 'nom') params.set('tri', t);
    return params;
}

// ─── AJAX LOAD ─────────────────────────────────────────────────────────────
function shLoad(url) {
    const content = document.getElementById('sh-content');
    content.innerHTML = '<div class="sh-loading"><i class="fa-solid fa-spinner"></i>Loading...</div>';
    history.pushState({}, '', url);
    updateResetBtn();
    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const nc  = doc.getElementById('sh-content');
            if (nc) {
                content.innerHTML = nc.innerHTML;
                attachPagination();
                attachFavForms();
                attachCartForms();
            }
        })
        .catch(() => { window.location.href = url; });
}

// ─── RESET BTN VISIBILITY ──────────────────────────────────────────────────
function updateResetBtn() {
    const btn = document.getElementById('resetBtn');
    if (!btn) return;
    const s = document.getElementById('filterSearch').value.trim();
    const c = document.getElementById('filterCat').value;
    const p = document.getElementById('filterPrix').value;
    btn.classList.toggle('hidden', !s && !c && !p);
}

function shReset() {
    document.getElementById('filterSearch').value = '';
    document.getElementById('filterCat').value    = '';
    document.getElementById('filterPrix').value   = '';
    document.getElementById('filterTri').value    = 'nom';
    document.querySelectorAll('.sh-cat-pill').forEach(p => p.classList.remove('active'));
    document.querySelector('.sh-cat-pill[data-cat=""]').classList.add('active');
    shLoad(BASE_URL);
}

// ─── FILTER FORM ──────────────────────────────────────────────────────────
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    shLoad(BASE_URL + '?' + buildParams().toString());
});

// ─── CATEGORY PILLS ───────────────────────────────────────────────────────
document.querySelectorAll('.sh-cat-pill').forEach(function(pill) {
    pill.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.sh-cat-pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('filterCat').value = this.dataset.cat || '';
        shLoad(BASE_URL + '?' + buildParams().toString());
    });
});

// ─── PAGINATION AJAX ──────────────────────────────────────────────────────
function attachPagination() {
    document.querySelectorAll('.sh-pag-nav a.sh-pag-btn').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            shLoad(this.href);
            window.scrollTo({ top: document.getElementById('sh-content').offsetTop - 20, behavior:'smooth' });
        });
    });
}
attachPagination();

// ─── ✅ FAVORITES AJAX (no page refresh) ──────────────────────────────────
function attachFavForms() {
    document.querySelectorAll('.sh-fav-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn  = form.querySelector('.sh-fav-btn');
            const icon = btn.querySelector('i');
            const isActive = btn.classList.contains('active');
            btn.classList.toggle('active', !isActive);
            icon.className = isActive ? 'fa-regular fa-heart' : 'fa-solid fa-heart';
            showToast(isActive ? 'Removed from favorites.' : 'Added to favorites!', 'success');
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form)
            }).catch(() => {
                btn.classList.toggle('active', isActive);
                icon.className = isActive ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
                showToast('An error occurred. Please try again.', 'error');
            });
        });
    });
}
attachFavForms();

// ─── ✅ ADD TO CART AJAX (no page refresh) ─────────────────────────────────
function attachCartForms() {
    document.querySelectorAll('.sh-cart-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn  = form.querySelector('.sh-add-btn');
            const icon = btn.querySelector('i');

            btn.style.transform = 'scale(0.85)';
            icon.className = 'fa-solid fa-check';
            btn.style.background = 'linear-gradient(135deg,#10b981,#059669)';
            showToast('Product added to cart!', 'success');
            setTimeout(function() {
                btn.style.transform = '';
                btn.style.background = '';
                icon.className = 'fa-solid fa-cart-plus';
            }, 1200);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form)
            }).catch(function() {
                form.submit();
            });
        });
    });
}
attachCartForms();

window.addEventListener('popstate', function() { window.location.reload(); });

@if(session('success'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('error')), 'error'); });
@endif
</script>

</x-app-layout>
