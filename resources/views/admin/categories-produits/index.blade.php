<x-app-layout>
<x-slot name="header">Product Categories</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.cat-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.adm-chip.green { background:rgba(16,185,129,0.25); border-color:rgba(16,185,129,0.4); }
.adm-hero-actions { display:flex; gap:8px; flex-wrap:wrap; }
.btn-hero-back { display:inline-flex; align-items:center; gap:6px; padding:9px 16px; border-radius:30px; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.25); color:rgba(255,255,255,0.85); font-size:12px; font-weight:600; text-decoration:none; }
.btn-hero-new { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:13px; font-weight:700; text-decoration:none; transition:background 0.2s; }
.btn-hero-new:hover { background:rgba(255,255,255,0.3); }

/* ── TABLE ── */
.cat-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.cat-table { width:100%; border-collapse:collapse; }
.cat-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.cat-table thead th.tc { text-align:center; }
.cat-table thead th.tr { text-align:right; }
.cat-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.cat-table tbody tr:last-child { border-bottom:none; }
.cat-table tbody tr:hover { background:#fdf9ff; }
.cat-table td { padding:14px 16px; vertical-align:middle; }
.cat-table td.tc { text-align:center; }
.cat-table td.tr { text-align:right; }
.cat-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
.cat-desc  { font-size:12px; color:#9ca3af; max-width:300px; }
.cat-count { font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; display:inline-block; }
.cat-status { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.cat-status.actif   { background:rgba(16,185,129,0.1); color:#059669; }
.cat-status.inactif { background:rgba(107,114,128,0.1); color:#6b7280; }
.cat-actions { display:flex; align-items:center; gap:6px; justify-content:flex-end; }
.act-btn { padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; cursor:pointer; border:none; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:opacity 0.2s; }
.act-btn:hover { opacity:0.8; }
.act-btn.toggle-on  { background:rgba(249,115,22,0.08); color:#f97316; border:1px solid rgba(249,115,22,0.2); }
.act-btn.toggle-off { background:rgba(16,185,129,0.08); color:#059669; border:1px solid rgba(16,185,129,0.2); }
.act-btn.edit   { background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; }
.act-btn.delete { background:white; color:#ef4444; border:1px solid rgba(239,68,68,0.2); }
.cat-empty { text-align:center; padding:64px 24px; }
.cat-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.cat-empty p { font-size:14px; color:#d1d5db; margin-bottom:12px; }
.cat-empty a { color:#b480ff; text-decoration:none; font-weight:600; }
</style>

@php
    $totalCats  = $categories->count();
    $activeCats = $categories->where('actif', true)->count();
@endphp

<div class="cat-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Product Categories</div>
                <div class="adm-hero-sub">Organise your cosmetics catalogue</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $activeCats }}</span> Active
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $totalCats }}</span> Total
                </div>
            </div>
            <div class="adm-hero-actions">
                <a href="{{ route('admin.produits.index') }}" class="btn-hero-back">
                    <i class="fa-solid fa-arrow-left"></i> Products
                </a>
                <a href="{{ route('admin.categories-produits.create') }}" class="btn-hero-new">
                    <i class="fa-solid fa-plus"></i> New Category
                </a>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="cat-table-card">
        @if($categories->isEmpty())
            <div class="cat-empty">
                <i class="fa-solid fa-folder-open"></i>
                <p>No categories yet.</p>
                <a href="{{ route('admin.categories-produits.create') }}">Create the first one →</a>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="cat-table">
                    <thead>
                        <tr>
                            <th>Name</th><th>Description</th>
                            <th class="tc">Products</th><th class="tc">Status</th>
                            <th class="tr">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                            <tr>
                                <td><div class="cat-name">{{ $cat->nom }}</div></td>
                                <td><div class="cat-desc">{{ Str::limit($cat->description, 80) ?: '—' }}</div></td>
                                <td class="tc"><span class="cat-count">{{ $cat->produits_count }}</span></td>
                                <td class="tc">
                                    <span class="cat-status {{ $cat->actif ? 'actif' : 'inactif' }}">
                                        {{ $cat->actif ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="tr">
                                    <div class="cat-actions">
                                        <form action="{{ route('admin.categories-produits.toggle', $cat) }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="act-btn {{ $cat->actif ? 'toggle-on' : 'toggle-off' }}">
                                                <i class="fa-solid {{ $cat->actif ? 'fa-pause' : 'fa-play' }}"></i>
                                                {{ $cat->actif ? 'Disable' : 'Enable' }}
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.categories-produits.edit', $cat) }}" class="act-btn edit">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        <form id="del-cat-prd-{{ $cat->id }}" action="{{ route('admin.categories-produits.destroy', $cat) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="button" class="act-btn delete"
                                                onclick="glowConfirm('Delete Category','Delete &laquo;{{ addslashes($cat->nom) }}&raquo;? Associated products will be unlinked.','Delete','fa-trash','#ef4444',function(){ document.getElementById('del-cat-prd-{{ $cat->id }}').submit(); })">
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
        @endif
    </div>
</div>

<script>
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid ' + (type === 'error' ? 'fa-circle-xmark' : 'fa-circle-check') + '" style="font-size:14px;flex-shrink:0;"></i><span>' + msg + '</span>';
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex'; t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function() { t.style.opacity = '0'; setTimeout(function() { t.style.display = 'none'; }, 300); }, 4000);
}
@if(session('success'))
document.addEventListener('DOMContentLoaded', function() { showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function() { showToast(@json(session('error')), 'error'); });
@endif
</script>

</x-app-layout>
