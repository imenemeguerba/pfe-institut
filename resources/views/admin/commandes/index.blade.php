<x-app-layout>
<x-slot name="header">Orders</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.cmd-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.cmd-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.cmd-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:13px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
.cmd-tab:last-child { border-right:none; }
.cmd-tab:hover { background:#fdf9ff; color:#b480ff; }
.cmd-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.cmd-tab-count { font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.cmd-tab.active .cmd-tab-count { background:#b480ff; color:white; }

/* ── FILTERS ── */
.cmd-filters { display:flex; align-items:flex-end; gap:12px; flex-wrap:wrap; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; }
.f-input { padding:9px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; }
.btn-filter { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; text-decoration:none; font-family:'Plus Jakarta Sans',sans-serif; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.cmd-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.cmd-table { width:100%; border-collapse:collapse; }
.cmd-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.cmd-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.cmd-table tbody tr:last-child { border-bottom:none; }
.cmd-table tbody tr:hover { background:#fdf9ff; }
.cmd-table td { padding:14px 16px; vertical-align:middle; }
.cmd-num   { font-size:12px; font-weight:700; color:#b480ff; font-family:monospace; }
.cmd-client { font-size:13px; font-weight:600; color:#1a1a2e; }
.cmd-products { display:flex; flex-wrap:wrap; gap:4px; }
.cmd-product-tag { font-size:10px; padding:3px 8px; border-radius:20px; background:#f5f0ff; color:#7c3aed; font-weight:500; }
.cmd-more  { font-size:11px; color:#9ca3af; }
.cmd-total { font-size:13px; font-weight:700; color:#b480ff; }
.cmd-date  { font-size:11px; color:#9ca3af; }
.cmd-status { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.cmd-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.cmd-status.confirmee  { background:rgba(16,185,129,0.1); color:#059669; }
.cmd-status.annulee    { background:rgba(239,68,68,0.1); color:#ef4444; }
.cmd-detail-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; white-space:nowrap; }
.cmd-detail-link:hover { color:#9333ea; }
.cmd-empty { text-align:center; padding:64px 24px; }
.cmd-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.cmd-empty p { font-size:14px; color:#d1d5db; }
.cmd-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="cmd-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Orders</div>
                <div class="adm-hero-sub">Track and manage all customer orders</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $counts['en_attente'] }}</span> Pending
                </div>
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $counts['confirmees'] }}</span> Confirmed
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $counts['tous'] }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="cmd-tabs">
        @foreach([
            'tous'       => ['label'=>'All',       'icon'=>'fa-list'],
            'en_attente' => ['label'=>'Pending',   'icon'=>'fa-clock'],
            'confirmees' => ['label'=>'Confirmed', 'icon'=>'fa-circle-check'],
            'annulees'   => ['label'=>'Cancelled', 'icon'=>'fa-xmark'],
        ] as $val => $info)
            <a href="{{ route('admin.commandes.index', array_merge(request()->query(), ['filtre' => $val])) }}"
               class="cmd-tab {{ $filtre === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="cmd-tab-count">{{ $counts[$val] }}</span>
            </a>
        @endforeach
    </div>

    {{-- FILTERS --}}
    <form method="GET" action="{{ route('admin.commandes.index') }}">
        <input type="hidden" name="filtre" value="{{ $filtre }}">
        <div class="cmd-filters">
            <input type="text" name="search" value="{{ $search }}" placeholder="Order number, client, product..." class="f-input" style="flex:1;min-width:200px;">
            <button type="submit" class="btn-filter"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
            @if($search)
                <a href="{{ route('admin.commandes.index', ['filtre' => $filtre]) }}" class="btn-reset"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="cmd-table-card">
        @if($commandes->isEmpty())
            <div class="cmd-empty">
                <i class="fa-solid fa-cart-xmark"></i>
                <p>No orders found.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="cmd-table">
                    <thead>
                        <tr>
                            <th>Order #</th><th>Client</th><th>Products</th>
                            <th>Total</th><th>Date</th><th>Status</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                            <tr>
                                <td><div class="cmd-num">{{ $commande->numero }}</div></td>
                                <td><div class="cmd-client">{{ $commande->client->fullName() }}</div></td>
                                <td>
                                    <div class="cmd-products">
                                        @foreach($commande->produits->take(2) as $p)
                                            <span class="cmd-product-tag">{{ $p->nom }}</span>
                                        @endforeach
                                        @if($commande->produits->count() > 2)
                                            <span class="cmd-more">+{{ $commande->produits->count() - 2 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td><div class="cmd-total">{{ number_format($commande->prix_final, 0, ',', ' ') }} DA</div></td>
                                <td><div class="cmd-date">{{ $commande->created_at->format('d/m/Y H:i') }}</div></td>
                                <td>
                                    <span class="cmd-status {{ $commande->statut }}">
                                        {{ ['en_attente'=>'Pending','confirmee'=>'Confirmed','annulee'=>'Cancelled'][$commande->statut] ?? $commande->statut }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.commandes.show', $commande) }}" class="cmd-detail-link">
                                        View <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="cmd-pagination">{{ $commandes->links() }}</div>
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
