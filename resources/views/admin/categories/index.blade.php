<x-app-layout>
<x-slot name="header">Categories</x-slot>

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
.btn-hero-new { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:13px; font-weight:700; text-decoration:none; transition:background 0.2s; }
.btn-hero-new:hover { background:rgba(255,255,255,0.3); }

/* ── SEARCH ── */
.cat-search { display:flex; gap:10px; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; align-items:center; }
.cat-search-input { flex:1; padding:9px 14px 9px 38px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:10px center; background-size:18px; }
.cat-search-input:focus { border-color:#b480ff; background-color:white; }
.btn-search { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; text-decoration:none; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.cat-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.cat-table { width:100%; border-collapse:collapse; }
.cat-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.cat-table thead th.tc { text-align:center; }
.cat-table thead th.tr { text-align:right; }
.cat-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.cat-table tbody tr:last-child { border-bottom:none; }
.cat-table tbody tr:hover { background:#fdf9ff; }
.cat-table td { padding:13px 16px; vertical-align:middle; }
.cat-table td.tc { text-align:center; }
.cat-table td.tr { text-align:right; }
.cat-img { width:44px; height:44px; border-radius:10px; object-fit:cover; border:1px solid #ede9fe; }
.cat-img-ph { width:44px; height:44px; border-radius:10px; background:#f5f0ff; display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:18px; }
.cat-name { font-size:13px; font-weight:600; color:#1a1a2e; }
.cat-desc { font-size:12px; color:#9ca3af; max-width:280px; }
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
.cat-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

@php
    $totalCats  = $categories->total();
    $activeCats = \App\Models\Category::where('actif', true)->count();
@endphp

<div class="cat-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Service Categories</div>
                <div class="adm-hero-sub">Organize your services into categories</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $activeCats }}</span> Active
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $totalCats }}</span> Total
                </div>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn-hero-new">
                <i class="fa-solid fa-plus"></i> New Category
            </a>
        </div>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.categories.index') }}">
        <div class="cat-search">
            <input type="text" name="search" value="{{ $search ?? '' }}"
                   placeholder="Search a category by name..." class="cat-search-input">
            @if(!empty($search))
                <span style="font-size:12px;color:#9ca3af;">{{ $categories->total() }} result(s)</span>
            @endif
            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            @if(!empty($search))
                <a href="{{ route('admin.categories.index') }}" class="btn-reset"><i class="fa-solid fa-xmark"></i> Clear</a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="cat-table-card">
        @if($categories->isEmpty())
            <div class="cat-empty">
                <i class="fa-solid fa-folder-open"></i>
                <p>No categories yet.</p>
                <a href="{{ route('admin.categories.create') }}">Create the first one →</a>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="cat-table">
                    <thead>
                        <tr>
                            <th>Image</th><th>Name</th><th>Description</th>
                            <th class="tc">Services</th><th class="tc">Status</th>
                            <th class="tr">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset('storage/'.$category->image) }}" class="cat-img" alt="">
                                    @else
                                        <div class="cat-img-ph"><i class="fa-solid fa-folder"></i></div>
                                    @endif
                                </td>
                                <td><div class="cat-name">{{ $category->nom }}</div></td>
                                <td><div class="cat-desc">{{ Str::limit($category->description, 80) ?: '—' }}</div></td>
                                <td class="tc"><span class="cat-count">{{ $category->services_count }}</span></td>
                                <td class="tc">
                                    <span class="cat-status {{ $category->actif ? 'actif' : 'inactif' }}">
                                        {{ $category->actif ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="tr">
                                    <div class="cat-actions">
                                        {{-- Toggle --}}
                                        <form action="{{ route('admin.categories.toggle', $category) }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="act-btn {{ $category->actif ? 'toggle-on' : 'toggle-off' }}">
                                                <i class="fa-solid {{ $category->actif ? 'fa-pause' : 'fa-play' }}"></i>
                                                {{ $category->actif ? 'Disable' : 'Enable' }}
                                            </button>
                                        </form>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="act-btn edit">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        {{-- Delete --}}
                                        <form id="form-del-cat-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="button" class="act-btn delete"
                                                onclick="glowConfirm('Delete Category','Delete &laquo;{{ addslashes($category->nom) }}&raquo;? Associated services will be unlinked.','Delete','fa-trash','#ef4444',function(){ document.getElementById('form-del-cat-{{ $category->id }}').submit(); })">
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
            <div class="cat-pagination">{{ $categories->links() }}</div>
        @endif
    </div>
</div>

<script>
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
