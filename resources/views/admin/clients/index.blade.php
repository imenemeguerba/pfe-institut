<x-app-layout>
<x-slot name="header">Clients</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.cli-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.adm-chip.red   { background:rgba(239,68,68,0.25); border-color:rgba(239,68,68,0.4); }

/* ── TABS ── */
.cli-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.cli-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:13px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
.cli-tab:last-child { border-right:none; }
.cli-tab:hover { background:#fdf9ff; color:#b480ff; }
.cli-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.cli-tab-count { font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.cli-tab.active .cli-tab-count { background:#b480ff; color:white; }

/* ── SEARCH ── */
.cli-search { display:flex; gap:10px; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; align-items:center; }
.cli-search-input { flex:1; padding:9px 14px 9px 38px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:10px center; background-size:18px; }
.cli-search-input:focus { border-color:#b480ff; background-color:white; }
.btn-search { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; text-decoration:none; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }
.search-results { font-size:12px; color:#9ca3af; margin-left:4px; }

/* ── TABLE ── */
.cli-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.cli-table { width:100%; border-collapse:collapse; }
.cli-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.cli-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.cli-table tbody tr:last-child { border-bottom:none; }
.cli-table tbody tr:hover { background:#fdf9ff; }
.cli-table td { padding:14px 16px; vertical-align:middle; }
.cli-avatar { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:13px; font-weight:700; flex-shrink:0; }
.cli-name-wrap { display:flex; align-items:center; gap:10px; }
.cli-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
.cli-email { font-size:11px; color:#9ca3af; margin-top:1px; }
.cli-phone { font-size:13px; color:#6b7280; }
.cli-date  { font-size:12px; color:#9ca3af; }
.cli-status { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.cli-status.actif  { background:rgba(16,185,129,0.1); color:#059669; }
.cli-status.bloque { background:rgba(239,68,68,0.1); color:#ef4444; }
.cli-detail-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; white-space:nowrap; }
.cli-detail-link:hover { color:#9333ea; }
.cli-empty { text-align:center; padding:64px 24px; }
.cli-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.cli-empty p { font-size:14px; color:#d1d5db; }
.cli-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="cli-wrap">
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Clients</div>
                <div class="adm-hero-sub">Manage registered clients and their accounts</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $compteurs['actifs'] }}</span> Active
                </div>
                <div class="adm-chip red">
                    <span class="adm-chip-val">{{ $compteurs['bloques'] }}</span> Blocked
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $compteurs['tous'] }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="cli-tabs">
        @foreach([
            'tous'    => ['label'=>'All',     'icon'=>'fa-users'],
            'actifs'  => ['label'=>'Active',  'icon'=>'fa-circle-check'],
            'bloques' => ['label'=>'Blocked', 'icon'=>'fa-ban'],
        ] as $val => $info)
            <a href="{{ route('admin.clients.index', ['filtre' => $val]) }}"
               class="cli-tab {{ $filtre === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="cli-tab-count">{{ $compteurs[$val] }}</span>
            </a>
        @endforeach
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.clients.index') }}">
        <input type="hidden" name="filtre" value="{{ $filtre }}">
        <div class="cli-search">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Search by name, email or phone..." class="cli-search-input">
            @if($search)
                <span class="search-results">{{ $clients->total() }} result(s)</span>
            @endif
            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            @if($search)
                <a href="{{ route('admin.clients.index', ['filtre' => $filtre]) }}" class="btn-reset">
                    <i class="fa-solid fa-xmark"></i> Clear
                </a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="cli-table-card">
        @if($clients->isEmpty())
            <div class="cli-empty">
                <i class="fa-solid fa-users-slash"></i>
                <p>{{ $search ? 'No results for "'.$search.'"' : 'No clients in this category.' }}</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="cli-table">
                    <thead>
                        <tr><th>Client</th><th>Phone</th><th>Status</th><th>Registered</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <div class="cli-name-wrap">
                                        <div class="cli-avatar">{{ strtoupper(substr($client->prenom,0,1)) }}</div>
                                        <div>
                                            <div class="cli-name">{{ $client->fullName() }}</div>
                                            <div class="cli-email">{{ $client->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="cli-phone">{{ $client->telephone ?? '—' }}</div></td>
                                <td>
                                    <span class="cli-status {{ $client->statut_compte }}">
                                        {{ $client->statut_compte === 'actif' ? 'Active' : 'Blocked' }}
                                    </span>
                                </td>
                                <td><div class="cli-date">{{ $client->created_at->format('d/m/Y') }}</div></td>
                                <td>
                                    <a href="{{ route('admin.clients.show', $client) }}" class="cli-detail-link">
                                        View <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="cli-pagination">{{ $clients->links() }}</div>
        @endif
    </div>
</div>

<script>
(function() {
    var KEY = 'clients_index_scroll';
    document.addEventListener('DOMContentLoaded', function() {
        var y = sessionStorage.getItem(KEY);
        if (y !== null) { requestAnimationFrame(function() { window.scrollTo({ top: parseInt(y), behavior: 'instant' }); }); sessionStorage.removeItem(KEY); }
    });
    document.addEventListener('submit', function() { sessionStorage.setItem(KEY, window.scrollY); }, true);
})();
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
