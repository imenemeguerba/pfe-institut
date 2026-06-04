<x-app-layout>
<x-slot name="header">Experts</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.exp-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.adm-chip.orange { background:rgba(249,115,22,0.25); border-color:rgba(249,115,22,0.4); }
.adm-chip.green  { background:rgba(16,185,129,0.25); border-color:rgba(16,185,129,0.4); }

/* ── TABS ── */
.exp-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.exp-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:13px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
.exp-tab:last-child { border-right:none; }
.exp-tab:hover { background:#fdf9ff; color:#b480ff; }
.exp-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.exp-tab-count { font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.exp-tab.active .exp-tab-count { background:#b480ff; color:white; }
.exp-tab-count.orange { background:rgba(249,115,22,0.1); color:#f97316; }
.exp-tab.pending-tab.active .exp-tab-count { background:#f97316; color:white; }

/* ── SEARCH ── */
.exp-search { display:flex; gap:10px; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; align-items:center; }
.exp-search-input { flex:1; padding:9px 14px 9px 38px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:10px center; background-size:18px; }
.exp-search-input:focus { border-color:#b480ff; background-color:white; }
.btn-search { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; text-decoration:none; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.exp-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.exp-table { width:100%; border-collapse:collapse; }
.exp-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.exp-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.exp-table tbody tr:last-child { border-bottom:none; }
.exp-table tbody tr:hover { background:#fdf9ff; }
.exp-table td { padding:14px 16px; vertical-align:middle; }
.exp-avatar { width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:14px; font-weight:700; flex-shrink:0; object-fit:cover; }
.exp-name-wrap { display:flex; align-items:center; gap:10px; }
.exp-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
.exp-email { font-size:11px; color:#9ca3af; margin-top:1px; }
.exp-phone { font-size:13px; color:#6b7280; }
.exp-exp   { font-size:13px; color:#6b7280; font-weight:500; }
.exp-date  { font-size:12px; color:#9ca3af; }
.exp-specialites { font-size:11px; color:#9ca3af; margin-top:2px; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.exp-status { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.exp-status.actif                 { background:rgba(16,185,129,0.1); color:#059669; }
.exp-status.en_attente_validation { background:rgba(249,115,22,0.1); color:#f97316; }
.exp-status.desactive             { background:rgba(107,114,128,0.1); color:#6b7280; }
.exp-status.bloque                { background:rgba(239,68,68,0.1); color:#ef4444; }
.exp-detail-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; white-space:nowrap; }
.exp-detail-link:hover { color:#9333ea; }
.exp-empty { text-align:center; padding:64px 24px; }
.exp-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.exp-empty p { font-size:14px; color:#d1d5db; }
.exp-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="exp-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Beauty Experts</div>
                <div class="adm-hero-sub">Manage and monitor all registered experts</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $compteurs['en_attente'] }}</span> Pending
                </div>
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $compteurs['actives'] }}</span> Active
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $compteurs['toutes'] }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="exp-tabs">
        <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'en_attente']) }}"
           class="exp-tab pending-tab {{ $filtre === 'en_attente' ? 'active' : '' }}">
            <i class="fa-solid fa-clock"></i> Pending
            <span class="exp-tab-count {{ $filtre !== 'en_attente' ? 'orange' : '' }}">{{ $compteurs['en_attente'] }}</span>
        </a>
        <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'actives']) }}"
           class="exp-tab {{ $filtre === 'actives' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-check"></i> Active
            <span class="exp-tab-count">{{ $compteurs['actives'] }}</span>
        </a>
        <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'desactives']) }}"
           class="exp-tab {{ $filtre === 'desactives' ? 'active' : '' }}">
            <i class="fa-solid fa-ban"></i> Disabled
            <span class="exp-tab-count">{{ $compteurs['desactives'] }}</span>
        </a>
        <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'toutes']) }}"
           class="exp-tab {{ $filtre === 'toutes' ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i> All
            <span class="exp-tab-count">{{ $compteurs['toutes'] }}</span>
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.estheticiennes.index') }}">
        <input type="hidden" name="filtre" value="{{ $filtre }}">
        <div class="exp-search">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name, email or phone..." class="exp-search-input">
            @if(!empty($search))
                <span style="font-size:12px;color:#9ca3af;">{{ $estheticiennes->total() }} result(s)</span>
            @endif
            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            @if(!empty($search))
                <a href="{{ route('admin.estheticiennes.index', ['filtre' => $filtre]) }}" class="btn-reset"><i class="fa-solid fa-xmark"></i> Clear</a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="exp-table-card">
        @if($estheticiennes->isEmpty())
            <div class="exp-empty">
                <i class="fa-solid fa-user-slash"></i>
                <p>No experts in this category.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="exp-table">
                    <thead>
                        <tr>
                            <th>Expert</th><th>Phone</th><th>Experience</th>
                            <th>Status</th><th>Registered</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estheticiennes as $esthe)
                            <tr>
                                <td>
                                    <div class="exp-name-wrap">
                                        @if($esthe->photo)
                                            <img src="{{ asset('storage/'.$esthe->photo) }}" class="exp-avatar" alt="">
                                        @else
                                            <div class="exp-avatar">{{ strtoupper(substr($esthe->prenom,0,1)) }}</div>
                                        @endif
                                        <div>
                                            <div class="exp-name">{{ $esthe->fullName() }}</div>
                                            <div class="exp-email">{{ $esthe->email }}</div>
                                            @if($esthe->specialites)
                                                <div class="exp-specialites">{{ $esthe->specialites }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td><div class="exp-phone">{{ $esthe->telephone ?? '—' }}</div></td>
                                <td><div class="exp-exp">{{ $esthe->experience }} yr(s)</div></td>
                                <td>
                                    <span class="exp-status {{ $esthe->statut_compte }}">
                                        {{ ['actif'=>'Active','en_attente_validation'=>'Pending','desactive'=>'Disabled','bloque'=>'Blocked'][$esthe->statut_compte] ?? $esthe->statut_compte }}
                                    </span>
                                </td>
                                <td><div class="exp-date">{{ $esthe->created_at->format('d/m/Y') }}</div></td>
                                <td>
                                    <a href="{{ route('admin.estheticiennes.show', $esthe) }}" class="exp-detail-link">
                                        View <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="exp-pagination">{{ $estheticiennes->links() }}</div>
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
