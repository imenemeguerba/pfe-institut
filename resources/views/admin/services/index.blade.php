<x-app-layout>
<x-slot name="header">Services</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.srv-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

/* ── HERO ── */
.adm-hero { background:linear-gradient(135deg,#b480ff 0%,#c99ae8 45%,#d3aa95 100%); border-radius:20px; padding:28px 32px; margin-bottom:20px; position:relative; overflow:hidden; }
.adm-hero::before { content:''; position:absolute; top:-40px; right:-20px; width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,0.07); }
.adm-hero::after  { content:''; position:absolute; bottom:-50px; left:30px; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,0.05); }
.adm-hero-inner { position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.adm-hero-title { font-family:'Playfair Display',serif; font-size:26px; font-weight:800; color:white; }
.adm-hero-sub   { font-size:13px; color:rgba(255,255,255,0.75); margin-top:4px; }
.adm-hero-chips { display:flex; gap:10px; flex-wrap:wrap; }
.adm-chip { background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25); border-radius:30px; padding:8px 16px; color:white; font-size:12px; font-weight:700; display:flex; align-items:center; gap:6px; }
.adm-chip-val { font-size:18px; font-weight:900; }
.adm-chip.green  { background:rgba(16,185,129,0.25); border-color:rgba(16,185,129,0.4); }
.adm-chip.gray   { background:rgba(107,114,128,0.25); border-color:rgba(107,114,128,0.4); }
.btn-hero-new { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:13px; font-weight:700; text-decoration:none; transition:background 0.2s; }
.btn-hero-new:hover { background:rgba(255,255,255,0.3); }

/* ── TABS ── */
.srv-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.srv-tab { flex:1; padding:11px 12px; text-align:center; text-decoration:none; font-size:12px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; }
.srv-tab:last-child { border-right:none; }
.srv-tab:hover { background:#fdf9ff; color:#b480ff; }
.srv-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.srv-tab-count { font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.srv-tab.active .srv-tab-count { background:#b480ff; color:white; }

/* ── SEARCH ── */
.srv-search { display:flex; gap:10px; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; align-items:center; }
.srv-search-input { flex:1; padding:9px 14px 9px 38px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:10px center; background-size:18px; }
.srv-search-input:focus { border-color:#b480ff; background-color:white; }
.btn-search { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; text-decoration:none; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.srv-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.srv-table { width:100%; border-collapse:collapse; }
.srv-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.srv-table thead th.tc { text-align:center; }
.srv-table thead th.tr { text-align:right; }
.srv-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.srv-table tbody tr:last-child { border-bottom:none; }
.srv-table tbody tr:hover { background:#fdf9ff; }
.srv-table td { padding:14px 16px; vertical-align:middle; }
.srv-table td.tc { text-align:center; }
.srv-table td.tr { text-align:right; }
.srv-img { width:44px; height:44px; border-radius:10px; object-fit:cover; border:1px solid #ede9fe; }
.srv-img-placeholder { width:44px; height:44px; border-radius:10px; background:#f5f0ff; display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:18px; }
.srv-name { font-size:13px; font-weight:600; color:#1a1a2e; }
.srv-desc { font-size:11px; color:#9ca3af; margin-top:2px; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.srv-cat  { font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; display:inline-block; }
.srv-price    { font-size:13px; font-weight:700; color:#b480ff; }
.srv-duration { font-size:13px; color:#6b7280; }
.srv-esthe    { font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; display:inline-block; }
.srv-status   { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.srv-status.actif   { background:rgba(16,185,129,0.1); color:#059669; }
.srv-status.inactif { background:rgba(107,114,128,0.1); color:#6b7280; }
.srv-actions { display:flex; align-items:center; gap:6px; justify-content:flex-end; }
.act-btn { padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; cursor:pointer; border:none; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:all 0.2s; }
.act-btn:hover { opacity:0.8; }
.act-btn.toggle-on  { background:rgba(249,115,22,0.08); color:#f97316; border:1px solid rgba(249,115,22,0.2); }
.act-btn.toggle-off { background:rgba(16,185,129,0.08); color:#059669; border:1px solid rgba(16,185,129,0.2); }
.act-btn.edit   { background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; }
.act-btn.delete { background:white; color:#ef4444; border:1px solid rgba(239,68,68,0.2); }
.srv-empty { text-align:center; padding:64px 24px; }
.srv-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.srv-empty p { font-size:14px; color:#d1d5db; margin-bottom:12px; }
.srv-empty a { color:#b480ff; text-decoration:none; font-weight:600; }
.srv-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
.pag-wrap { display:flex; align-items:center; justify-content:center; gap:6px; flex-wrap:wrap; }
.pag-btn { display:inline-flex; align-items:center; gap:5px; padding:7px 14px; border-radius:20px; font-size:12px; font-weight:600; text-decoration:none; border:1.5px solid #ede9fe; background:white; color:#6b7280; transition:all 0.2s; cursor:pointer; }
.pag-btn:hover { border-color:#b480ff; color:#b480ff; }
.pag-btn.active   { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.3); }
.pag-btn.disabled { color:#d1d5db; cursor:default; background:#faf8ff; }
.pag-btn.disabled:hover { border-color:#ede9fe; color:#d1d5db; }
</style>

<div class="srv-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Services Catalog</div>
                <div class="adm-hero-sub">Manage your institute's service offerings</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $compteurs['actifs'] }}</span> Active
                </div>
                <div class="adm-chip gray">
                    <span class="adm-chip-val">{{ $compteurs['inactifs'] }}</span> Inactive
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $compteurs['tous'] }}</span> Total
                </div>
            </div>
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                <a href="{{ route('admin.categories.index') }}"
                   style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:30px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.25);color:rgba(255,255,255,0.85);font-size:12px;font-weight:600;text-decoration:none;">
                    <i class="fa-solid fa-folder" style="font-size:11px;"></i> Categories
                </a>
                <a href="{{ route('admin.services.create') }}" class="btn-hero-new">
                    <i class="fa-solid fa-plus"></i> New Service
                </a>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="srv-tabs">
        @foreach([
            'tous'     => ['label'=>'All',      'icon'=>'fa-list'],
            'actifs'   => ['label'=>'Active',   'icon'=>'fa-circle-check'],
            'inactifs' => ['label'=>'Inactive', 'icon'=>'fa-ban'],
        ] as $val => $info)
            <a href="{{ route('admin.services.index', ['filtre' => $val]) }}"
               class="srv-tab {{ ($filtre ?? 'tous') === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="srv-tab-count">{{ $compteurs[$val] }}</span>
            </a>
        @endforeach
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.services.index') }}">
        <input type="hidden" name="filtre" value="{{ $filtre ?? 'tous' }}">
        <div class="srv-search">
            <input type="text" name="search" value="{{ $search ?? '' }}"
                   placeholder="Search a service by name..." class="srv-search-input">
            @if(!empty($search))
                <span style="font-size:12px;color:#9ca3af;">{{ $services->total() }} result(s)</span>
            @endif
            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            @if(!empty($search))
                <a href="{{ route('admin.services.index') }}" class="btn-reset"><i class="fa-solid fa-xmark"></i> Clear</a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="srv-table-card" id="srv-table">
        @if($services->isEmpty())
            <div class="srv-empty">
                <i class="fa-solid fa-spa"></i>
                <p>No services yet.</p>
                <a href="{{ route('admin.services.create') }}">Create the first one →</a>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="srv-table">
                    <thead>
                        <tr>
                            <th>Image</th><th>Service</th><th>Category</th>
                            <th class="tc">Price</th><th class="tc">Duration</th>
                            <th class="tc">Experts</th><th class="tc">Status</th>
                            <th class="tr">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>
                                    @if($service->image)
                                        <img src="{{ asset('storage/'.$service->image) }}" class="srv-img" alt="">
                                    @else
                                        <div class="srv-img-placeholder"><i class="fa-solid fa-spa"></i></div>
                                    @endif
                                </td>
                                <td>
                                    <div class="srv-name">{{ $service->nom }}</div>
                                    @if($service->description)
                                        <div class="srv-desc">{{ $service->description }}</div>
                                    @endif
                                </td>
                                <td><span class="srv-cat">{{ $service->category->nom }}</span></td>
                                <td class="tc"><div class="srv-price">{{ number_format($service->prix, 0, ',', ' ') }} DA</div></td>
                                <td class="tc"><div class="srv-duration">{{ $service->dureeFormatee() }}</div></td>
                                <td class="tc"><span class="srv-esthe">{{ $service->estheticiennes->count() }}</span></td>
                                <td class="tc">
                                    <span class="srv-status {{ $service->actif ? 'actif' : 'inactif' }}">
                                        {{ $service->actif ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="tr">
                                    <div class="srv-actions">
                                        {{-- Toggle --}}
                                        <form id="form-tog-srv-{{ $service->id }}" action="{{ route('admin.services.toggle', $service) }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="act-btn {{ $service->actif ? 'toggle-on' : 'toggle-off' }}">
                                                <i class="fa-solid {{ $service->actif ? 'fa-pause' : 'fa-play' }}"></i>
                                                {{ $service->actif ? 'Disable' : 'Enable' }}
                                            </button>
                                        </form>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.services.edit', $service) }}" class="act-btn edit">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        {{-- Delete --}}
                                        <form id="form-del-srv-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="button" class="act-btn delete"
                                                onclick="glowConfirm('Delete Service','Delete &laquo;{{ addslashes($service->nom) }}&raquo;? This cannot be undone.','Delete','fa-trash','#ef4444',function(){ document.getElementById('form-del-srv-{{ $service->id }}').submit(); })">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="srv-pagination">
                <div class="pag-wrap">
                    @if($services->onFirstPage())
                        <span class="pag-btn disabled"><i class="fa-solid fa-chevron-left"></i> Prev</span>
                    @else
                        <a href="{{ $services->previousPageUrl() }}#srv-table" class="pag-btn"><i class="fa-solid fa-chevron-left"></i> Prev</a>
                    @endif
                    @foreach($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                        @if($page == $services->currentPage())
                            <span class="pag-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}#srv-table" class="pag-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if($services->hasMorePages())
                        <a href="{{ $services->nextPageUrl() }}#srv-table" class="pag-btn">Next <i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="pag-btn disabled">Next <i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<script>
// ── SCROLL PRESERVATION ───────────────────────────────────────────────────
(function() {
    var KEY = 'srv_index_scroll';
    // Restore scroll on page load
    document.addEventListener('DOMContentLoaded', function() {
        var y = sessionStorage.getItem(KEY);
        if (y !== null) {
            requestAnimationFrame(function() {
                window.scrollTo({ top: parseInt(y), behavior: 'instant' });
            });
            sessionStorage.removeItem(KEY);
        }
        // Attach save to pagination buttons
        document.querySelectorAll('.pag-btn:not(.disabled)').forEach(function(btn) {
            btn.addEventListener('click', function() {
                sessionStorage.setItem(KEY, window.scrollY);
            });
        });
    });
    // Save scroll before any form submit (toggle, etc.)
    document.addEventListener('submit', function() {
        sessionStorage.setItem(KEY, window.scrollY);
    }, true);
})();

// ── TOAST ─────────────────────────────────────────────────────────────────
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;flex-shrink:0;"></i><span>'+msg+'</span>';
    t.style.background = type==='error' ? '#ef4444' : '#1a1a2e';
    t.style.display='flex'; t.style.opacity='1';
    clearTimeout(t._x);
    t._x=setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); },4000);
}
@if(session('success'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('success')),'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('error')),'error'); });
@endif
</script>

</x-app-layout>
