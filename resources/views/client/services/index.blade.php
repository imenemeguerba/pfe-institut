<x-app-layout>
<x-slot name="header">Services</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }
.sv-hero { position:relative; overflow:hidden; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); padding:80px 10% 120px; min-height:320px; margin:-32px -24px 0; }
.sv-hero-particles { position:absolute; inset:0; overflow:hidden; }
.sv-particle { position:absolute; border-radius:50%; background:rgba(180,128,255,0.15); animation:floatParticle linear infinite; }
.sv-hero-content { position:relative; z-index:2; text-align:center; }
.sv-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.sv-hero-title { font-family:'Playfair Display',serif; font-size:52px; font-weight:800; color:white; line-height:1.2; margin-bottom:16px; }
.sv-hero-title span { background:none; -webkit-text-fill-color:rgba(255,255,255,0.7); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:5px; }
.sv-hero-sub { font-size:16px; color:rgba(255,255,255,0.92); margin-bottom:32px; }
.sv-hero-stats { display:flex; justify-content:center; gap:12px; flex-wrap:wrap; }
.sv-stat { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:30px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); backdrop-filter:blur(6px); }
.sv-stat-num { font-size:28px; font-weight:800; color:white; }
.sv-stat-lbl { font-size:11px; color:rgba(255,255,255,0.85); text-transform:uppercase; letter-spacing:0.5px; }
.sv-wave { position:absolute; bottom:-2px; left:0; right:0; height:80px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 80'%3E%3Cpath fill='%23faf8ff' d='M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }
.sv-body { max-width:1200px; margin:0 auto; padding:40px 24px 80px; }
.sv-filter { background:white; border-radius:24px; padding:24px 28px; box-shadow:0 8px 40px rgba(180,128,255,0.1); border:1px solid #ede9fe; margin-bottom:40px; }
.sv-filter-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
.sv-filter-title i { color:#b480ff; }
.sv-filter-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:12px; margin-bottom:14px; }
.sv-f-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#c4b5fd; margin-bottom:5px; display:block; }
.sv-f-input { width:100%; padding:10px 14px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; outline:none; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; }
.sv-f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.08); }
.sv-f-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 10px center; background-size:14px; padding-right:30px; cursor:pointer; }
.sv-filter-actions { display:flex; gap:8px; align-items:center; }
.btn-filter { padding:10px 22px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
.btn-filter:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(180,128,255,0.4); }
.btn-reset { padding:10px 16px; border-radius:30px; background:white; color:#9ca3af; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; transition:all 0.2s; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }
.cat-pills { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:32px; }
.cat-pill { padding:8px 18px; border-radius:30px; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; color:#6b7280; text-decoration:none; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px; background:white; cursor:pointer; }
.cat-pill:hover { border-color:#b480ff; color:#b480ff; background:#fdf9ff; }
.cat-pill.active { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.3); }
.sv-count { font-size:13px; color:#9ca3af; margin-bottom:24px; }
.sv-count strong { color:#1a1a2e; }
.sv-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
.sv-card { border-radius:24px; overflow:hidden; background:white; box-shadow:0 4px 20px rgba(180,128,255,0.06); border:1px solid #ede9fe; transition:all 0.4s cubic-bezier(0.175,0.885,0.32,1.275); opacity:0; animation:cardIn 0.6s forwards; }
.sv-card:hover { transform:translateY(-12px) scale(1.02); box-shadow:0 24px 60px rgba(180,128,255,0.2); border-color:#c4b5fd; }
.sv-card:nth-child(1){ animation-delay:0s; } .sv-card:nth-child(2){ animation-delay:0.08s; } .sv-card:nth-child(3){ animation-delay:0.16s; } .sv-card:nth-child(4){ animation-delay:0.24s; } .sv-card:nth-child(5){ animation-delay:0.32s; } .sv-card:nth-child(6){ animation-delay:0.4s; }
.sv-card-img { position:relative; height:200px; overflow:hidden; }
.sv-card-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.6s ease; }
.sv-card:hover .sv-card-img img { transform:scale(1.1); }
.sv-card-img-placeholder { width:100%; height:100%; background:linear-gradient(135deg,rgba(180,128,255,0.15),rgba(211,170,149,0.15)); display:flex; align-items:center; justify-content:center; font-size:64px; }
.sv-card-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(26,10,53,0.7),transparent); opacity:0; transition:opacity 0.3s; display:flex; align-items:flex-end; padding:16px; }
.sv-card:hover .sv-card-overlay { opacity:1; }
.sv-card-overlay-btn { display:inline-flex; align-items:center; gap:6px; padding:8px 18px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:700; text-decoration:none; }
.sv-card-cat { position:absolute; top:14px; left:14px; padding:4px 12px; border-radius:20px; background:rgba(255,255,255,0.9); backdrop-filter:blur(4px); font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#b480ff; }
.sv-card-body { padding:20px; }
.sv-card-name { font-size:16px; font-weight:700; color:#1a1a2e; margin-bottom:6px; }
.sv-card-desc { font-size:12px; color:#9ca3af; line-height:1.6; margin-bottom:14px; }
.sv-card-footer { display:flex; justify-content:space-between; align-items:center; padding-top:14px; border-top:1px solid #f3f0ff; }
.sv-card-price { font-size:20px; font-weight:800; color:#b480ff; }
.sv-card-price-sub { font-size:10px; color:#c4b5fd; }
.sv-card-action { display:inline-flex; align-items:center; gap:5px; padding:8px 16px; border-radius:30px; background:#fdf9ff; color:#b480ff; font-size:12px; font-weight:700; text-decoration:none; border:1.5px solid rgba(180,128,255,0.2); transition:all 0.2s; }
.sv-card-action:hover { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; }
.sv-empty { text-align:center; padding:80px 24px; }
.sv-empty i { font-size:48px; color:#e9d8fd; margin-bottom:16px; display:block; }
.sv-empty p { font-size:15px; color:#c4b5fd; }
.sv-pagination { margin-top:40px; display:flex; justify-content:center; }
.pag-wrap { display:flex; align-items:center; justify-content:center; gap:6px; flex-wrap:wrap; }
.pag-btn { display:inline-flex; align-items:center; gap:5px; padding:7px 14px; border-radius:20px; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; background:white; color:#6b7280; transition:all 0.2s; cursor:pointer; }
.pag-btn:hover { border-color:#b480ff; color:#b480ff; }
.pag-btn.active { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.3); }
.pag-btn.disabled { color:#d1d5db; cursor:default; background:#faf8ff; pointer-events:none; }
#sv-results.loading { opacity:0.5; pointer-events:none; transition:opacity 0.2s; }
@keyframes floatParticle { 0%{ transform:translateY(100vh) scale(0); opacity:0; } 10%{ opacity:1; } 90%{ opacity:0.5; } 100%{ transform:translateY(-100px) scale(1); opacity:0; } }
@keyframes cardIn { from{ opacity:0; transform:translateY(30px) scale(0.95); } to{ opacity:1; transform:translateY(0) scale(1); } }
@media(max-width:960px){ .sv-grid{ grid-template-columns:1fr 1fr; } .sv-filter-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:640px){ .sv-grid{ grid-template-columns:1fr; } .sv-filter-grid{ grid-template-columns:1fr; } .sv-hero-title{ font-size:32px; } }
</style>

{{-- HERO --}}
<div class="sv-hero">
    <div class="sv-hero-particles" id="particles"></div>
    <div class="sv-hero-content">
        <div class="sv-hero-tag"><i class="fa-solid fa-spa"></i> Our Services</div>
        <h1 class="sv-hero-title">Discover Your <span>Perfect Treatment</span></h1>
        <p class="sv-hero-sub">Expertly crafted beauty services tailored just for you</p>
        <div class="sv-hero-stats">
            <div class="sv-stat"><div class="sv-stat-num" id="hero-total">{{ $services->total() }}</div><div class="sv-stat-lbl">Services</div></div>
            <div class="sv-stat"><div class="sv-stat-num">{{ $categories->count() }}</div><div class="sv-stat-lbl">Categories</div></div>
            <div class="sv-stat"><div class="sv-stat-num">100%</div><div class="sv-stat-lbl">Satisfaction</div></div>
        </div>
    </div>
    <div class="sv-wave"></div>
</div>

<div class="sv-body">

    {{-- FILTER --}}
    <div class="sv-filter">
        <div class="sv-filter-title"><i class="fa-solid fa-sliders"></i> Find Your Service</div>
        <form id="filterForm">
            <div class="sv-filter-grid">
                <div>
                    <label class="sv-f-label">Search</label>
                    <input type="text" name="search" id="f-search" value="{{ $search }}" placeholder="Service name..." class="sv-f-input">
                </div>
                <div>
                    <label class="sv-f-label">Category</label>
                    <select name="categorie" id="f-categorie" class="sv-f-input sv-f-select">
                        <option value="">All categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="sv-f-label">Max Price (DA)</label>
                    <input type="number" name="prix_max" id="f-prix" value="{{ $prixMax }}" min="0" step="500" placeholder="e.g. 5000" class="sv-f-input">
                </div>
                <div>
                    <label class="sv-f-label">Duration</label>
                    <select name="duree_max" id="f-duree" class="sv-f-input sv-f-select">
                        <option value="">Any duration</option>
                        <option value="30"  {{ $dureeMax==30 ?'selected':'' }}>≤ 30 min</option>
                        <option value="60"  {{ $dureeMax==60 ?'selected':'' }}>≤ 1h</option>
                        <option value="90"  {{ $dureeMax==90 ?'selected':'' }}>≤ 1h30</option>
                        <option value="120" {{ $dureeMax==120?'selected':'' }}>≤ 2h</option>
                    </select>
                </div>
            </div>
            <div class="sv-filter-actions">
                <button type="submit" class="btn-filter"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                <button type="button" class="btn-reset" id="resetBtn" style="{{ ($search||$categoryId||$prixMax||$dureeMax)?'':'display:none;' }}">
                    <i class="fa-solid fa-xmark"></i> Reset
                </button>
            </div>
        </form>
    </div>

    {{-- CATEGORY PILLS --}}
    <div class="cat-pills" id="catPills">
        <span class="cat-pill {{ !$categoryId ? 'active' : '' }}" data-cat="">
            <i class="fa-solid fa-border-all"></i> All
        </span>
        @foreach($categories as $cat)
            <span class="cat-pill {{ $categoryId == $cat->id ? 'active' : '' }}" data-cat="{{ $cat->id }}">
                {{ $cat->nom }}
            </span>
        @endforeach
    </div>

    {{-- RESULTS --}}
    <div id="sv-results">
        <div class="sv-count" id="sv-count">
            <strong>{{ $services->total() }}</strong> service(s) found
        </div>

        <div id="sv-grid-wrap">
            @if($services->isEmpty())
                <div class="sv-empty">
                    <i class="fa-solid fa-spa"></i>
                    <p>No services match your criteria.</p>
                </div>
            @else
                <div class="sv-grid" id="sv-grid">
                    @foreach($services as $service)
                        <div class="sv-card">
                            <div class="sv-card-img">
                                @if($service->image)
                                    <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->nom }}">
                                @else
                                    <div class="sv-card-img-placeholder">💄</div>
                                @endif
                                <span class="sv-card-cat">{{ $service->category->nom }}</span>
                                <div class="sv-card-overlay">
                                    <a href="{{ route('client.services.show', $service) }}" class="sv-card-overlay-btn">
                                        <i class="fa-solid fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                            <div class="sv-card-body">
                                <div class="sv-card-name">{{ $service->nom }}</div>
                                @if($service->description)
                                    <div class="sv-card-desc">{{ Str::limit($service->description, 80) }}</div>
                                @endif
                                <div class="sv-card-footer">
                                    <div>
                                        <div class="sv-card-price">{{ number_format($service->prix,0,',',' ') }} DA</div>
                                        <div class="sv-card-price-sub"><i class="fa-regular fa-clock" style="font-size:9px;"></i> {{ $service->dureeFormatee() }}</div>
                                    </div>
                                    <a href="{{ route('client.services.show', $service) }}" class="sv-card-action">
                                        Explore <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="sv-pagination" id="sv-pagination"></div>
    </div>

</div>

<script>
const CSRF     = document.querySelector('meta[name="csrf-token"]').content;
const BASE_URL = '{{ route("client.services.index") }}';

// ── RENDER PAGINATION ─────────────────────────────────
function renderPagination(total, currentPage, lastPage) {
    var pag = document.getElementById('sv-pagination');
    if (lastPage <= 1) { pag.innerHTML = ''; return; }

    var html = '<div class="pag-wrap">';

    // Prev
    if (currentPage > 1) {
        html += '<span class="pag-btn" onclick="goPage('+(currentPage-1)+')"><i class="fa-solid fa-chevron-left"></i> Prev</span>';
    } else {
        html += '<span class="pag-btn disabled"><i class="fa-solid fa-chevron-left"></i> Prev</span>';
    }

    // Pages
    for (var p = 1; p <= lastPage; p++) {
        if (p === currentPage) {
            html += '<span class="pag-btn active">'+p+'</span>';
        } else {
            html += '<span class="pag-btn" onclick="goPage('+p+')">'+p+'</span>';
        }
    }

    // Next
    if (currentPage < lastPage) {
        html += '<span class="pag-btn" onclick="goPage('+(currentPage+1)+')">Next <i class="fa-solid fa-chevron-right"></i></span>';
    } else {
        html += '<span class="pag-btn disabled">Next <i class="fa-solid fa-chevron-right"></i></span>';
    }

    html += '</div>';
    pag.innerHTML = html;
}

// Init pagination on load
renderPagination({{ $services->total() }}, {{ $services->currentPage() }}, {{ $services->lastPage() }});

// ── GO TO PAGE ────────────────────────────────────────
function goPage(page) {
    loadResults(getParams(), page);
}

// ── GET PARAMS ────────────────────────────────────────
function getParams() {
    return {
        search:    document.getElementById('f-search').value.trim(),
        categorie: document.getElementById('f-categorie').value,
        prix_max:  document.getElementById('f-prix').value,
        duree_max: document.getElementById('f-duree').value,
    };
}

// ── LOAD RESULTS ──────────────────────────────────────
function loadResults(params, page) {
    page = page || 1;
    var results = document.getElementById('sv-results');
    results.classList.add('loading');

    var url = new URL(BASE_URL);
    if (params.search)    url.searchParams.set('search',    params.search);
    if (params.categorie) url.searchParams.set('categorie', params.categorie);
    if (params.prix_max)  url.searchParams.set('prix_max',  params.prix_max);
    if (params.duree_max) url.searchParams.set('duree_max', params.duree_max);
    url.searchParams.set('page', page);
    url.searchParams.set('ajax', '1');

    // Update browser URL
    var displayUrl = new URL(BASE_URL);
    if (params.search)    displayUrl.searchParams.set('search',    params.search);
    if (params.categorie) displayUrl.searchParams.set('categorie', params.categorie);
    if (params.prix_max)  displayUrl.searchParams.set('prix_max',  params.prix_max);
    if (params.duree_max) displayUrl.searchParams.set('duree_max', params.duree_max);
    if (page > 1)         displayUrl.searchParams.set('page', page);
    history.pushState({}, '', displayUrl.toString());

    fetch(url.toString(), {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
        }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        // Update count
        document.getElementById('sv-count').innerHTML = '<strong>'+data.total+'</strong> service(s) found';

        // Update hero
        var h = document.getElementById('hero-total');
        if (h) h.textContent = data.total;

        // Update grid
        document.getElementById('sv-grid-wrap').innerHTML = data.html;

        // Update pagination
        renderPagination(data.total, data.current_page, data.last_page);

        results.classList.remove('loading');
        attachTilt();
    })
    .catch(function() {
        results.classList.remove('loading');
    });
}

// ── FILTER FORM ───────────────────────────────────────
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    loadResults(getParams(), 1);
    updateResetBtn();
});

// ── RESET ─────────────────────────────────────────────
document.getElementById('resetBtn').addEventListener('click', function() {
    document.getElementById('f-search').value    = '';
    document.getElementById('f-categorie').value = '';
    document.getElementById('f-prix').value      = '';
    document.getElementById('f-duree').value     = '';
    document.querySelectorAll('.cat-pill').forEach(function(p) {
        p.classList.remove('active');
        if (p.dataset.cat === '') p.classList.add('active');
    });
    loadResults({}, 1);
    this.style.display = 'none';
});

function updateResetBtn() {
    var p = getParams();
    var btn = document.getElementById('resetBtn');
    btn.style.display = (p.search || p.categorie || p.prix_max || p.duree_max) ? '' : 'none';
}

// ── CATEGORY PILLS ────────────────────────────────────
document.getElementById('catPills').addEventListener('click', function(e) {
    var pill = e.target.closest('.cat-pill');
    if (!pill) return;
    document.querySelectorAll('.cat-pill').forEach(function(p) { p.classList.remove('active'); });
    pill.classList.add('active');
    document.getElementById('f-categorie').value = pill.dataset.cat;
    loadResults(getParams(), 1);
    updateResetBtn();
});

// ── TILT ──────────────────────────────────────────────
function attachTilt() {
    document.querySelectorAll('.sv-card').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left - rect.width/2;
            var y = e.clientY - rect.top - rect.height/2;
            card.style.transform = 'translateY(-12px) scale(1.02) perspective(1000px) rotateX('+(y/rect.height*8)+'deg) rotateY('+(x/rect.width*-8)+'deg)';
        });
        card.addEventListener('mouseleave', function() { card.style.transform = ''; });
    });
}
attachTilt();

// ── PARTICLES ─────────────────────────────────────────
var container = document.getElementById('particles');
if (container) {
    for (var i = 0; i < 20; i++) {
        var p = document.createElement('div');
        p.className = 'sv-particle';
        var size = Math.random() * 60 + 20;
        p.style.cssText = 'width:'+size+'px;height:'+size+'px;left:'+(Math.random()*100)+'%;animation-duration:'+(Math.random()*15+10)+'s;animation-delay:'+(Math.random()*10)+'s;opacity:'+(Math.random()*0.3)+';';
        container.appendChild(p);
    }
}
</script>

</x-app-layout>