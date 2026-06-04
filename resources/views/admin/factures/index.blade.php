<x-app-layout>
<x-slot name="header">Invoices</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.fac-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.adm-chip.purple { background:rgba(124,58,237,0.3); border-color:rgba(124,58,237,0.5); }
.adm-chip.orange { background:rgba(249,115,22,0.25); border-color:rgba(249,115,22,0.4); }

/* ── TABS ── */
.fac-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.fac-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:12px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; }
.fac-tab:last-child { border-right:none; }
.fac-tab:hover { background:#fdf9ff; color:#b480ff; }
.fac-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.fac-tab-count { font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.fac-tab.active .fac-tab-count { background:#b480ff; color:white; }

/* ── SEARCH ── */
.fac-search { display:flex; gap:10px; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; align-items:center; }
.fac-search-input { flex:1; padding:9px 14px 9px 38px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:10px center; background-size:18px; }
.fac-search-input:focus { border-color:#b480ff; background-color:white; }
.btn-search { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; text-decoration:none; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.fac-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.fac-table { width:100%; border-collapse:collapse; }
.fac-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.fac-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.fac-table tbody tr:last-child { border-bottom:none; }
.fac-table tbody tr:hover { background:#fdf9ff; }
.fac-table td { padding:14px 16px; vertical-align:middle; }
.fac-num    { font-family:monospace; font-size:12px; font-weight:700; color:#b480ff; }
.fac-client { font-size:13px; font-weight:600; color:#1a1a2e; }
.fac-type   { font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; display:inline-block; }
.fac-type.rdv      { background:rgba(124,58,237,0.08); color:#7c3aed; }
.fac-type.commande { background:rgba(249,115,22,0.08); color:#f97316; }
.fac-ref    { font-size:11px; font-family:monospace; color:#9ca3af; }
.fac-amount { font-size:13px; font-weight:700; color:#b480ff; }
.fac-date   { font-size:11px; color:#9ca3af; }
.fac-actions { display:flex; align-items:center; gap:8px; }
.act-btn { padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:opacity 0.2s; }
.act-btn:hover { opacity:0.8; }
.act-btn.view { background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; }
.act-btn.pdf  { background:rgba(16,185,129,0.08); color:#059669; border:1px solid rgba(16,185,129,0.2); }
.fac-empty { text-align:center; padding:64px 24px; }
.fac-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.fac-empty p { font-size:14px; color:#d1d5db; }
.fac-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="fac-wrap">
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Invoices</div>
                <div class="adm-hero-sub">Automatically generated invoices for appointments and orders</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip purple">
                    <span class="adm-chip-val">{{ $counts['rdv'] }}</span> Appointments
                </div>
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $counts['commandes'] }}</span> Orders
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $counts['toutes'] }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="fac-tabs">
        <a href="{{ route('admin.factures.index', array_merge(request()->query(), ['type' => ''])) }}"
           class="fac-tab {{ $type === '' ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i> All
            <span class="fac-tab-count">{{ $counts['toutes'] }}</span>
        </a>
        <a href="{{ route('admin.factures.index', array_merge(request()->query(), ['type' => 'rendez_vous'])) }}"
           class="fac-tab {{ $type === 'rendez_vous' ? 'active' : '' }}">
            <i class="fa-solid fa-spa"></i> Appointments
            <span class="fac-tab-count">{{ $counts['rdv'] }}</span>
        </a>
        <a href="{{ route('admin.factures.index', array_merge(request()->query(), ['type' => 'commande'])) }}"
           class="fac-tab {{ $type === 'commande' ? 'active' : '' }}">
            <i class="fa-solid fa-cart-shopping"></i> Orders
            <span class="fac-tab-count">{{ $counts['commandes'] }}</span>
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.factures.index') }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="fac-search">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Invoice number, client name..." class="fac-search-input">
            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            @if($search)
                <a href="{{ route('admin.factures.index', ['type' => $type]) }}" class="btn-reset">
                    <i class="fa-solid fa-xmark"></i> Clear
                </a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="fac-table-card">
        @if($factures->isEmpty())
            <div class="fac-empty">
                <i class="fa-solid fa-file-invoice"></i>
                <p>No invoices found.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="fac-table">
                    <thead>
                        <tr>
                            <th>Invoice #</th><th>Client</th><th>Type</th>
                            <th>Reference</th><th>Amount TTC</th><th>Date</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factures as $facture)
                            <tr>
                                <td><div class="fac-num">{{ $facture->numero }}</div></td>
                                <td><div class="fac-client">{{ $facture->client->fullName() }}</div></td>
                                <td>
                                    <span class="fac-type {{ $facture->type === 'rendez_vous' ? 'rdv' : 'commande' }}">
                                        @if($facture->type === 'rendez_vous')
                                            <i class="fa-solid fa-spa" style="font-size:9px;"></i> RDV
                                        @else
                                            <i class="fa-solid fa-cart-shopping" style="font-size:9px;"></i> Order
                                        @endif
                                    </span>
                                </td>
                                <td><div class="fac-ref">{{ $facture->commande?->numero ?? ($facture->rendezVous ? 'RDV #'.$facture->rendezVous->id : '—') }}</div></td>
                                <td><div class="fac-amount">{{ number_format($facture->montant_ttc, 0, ',', ' ') }} DA</div></td>
                                <td><div class="fac-date">{{ $facture->date_emission->format('d/m/Y H:i') }}</div></td>
                                <td>
                                    <div class="fac-actions">
                                        <a href="{{ route('admin.factures.show', $facture) }}" class="act-btn view">
                                            <i class="fa-solid fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.factures.telecharger', $facture) }}" class="act-btn pdf">
                                            <i class="fa-solid fa-file-pdf"></i> PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="fac-pagination">{{ $factures->links() }}</div>
        @endif
    </div>
</div>

<script>
(function() {
    var KEY = 'factures_index_scroll';
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
