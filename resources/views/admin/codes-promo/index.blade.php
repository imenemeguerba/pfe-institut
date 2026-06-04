<x-app-layout>
<x-slot name="header">Promo Codes</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.promo-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.adm-chip.orange { background:rgba(249,115,22,0.25); border-color:rgba(249,115,22,0.4); }
.btn-hero-new { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:13px; font-weight:700; text-decoration:none; transition:background 0.2s; }
.btn-hero-new:hover { background:rgba(255,255,255,0.3); }

/* ── TABS ── */
.promo-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.promo-tab { flex:1; padding:11px 12px; text-align:center; text-decoration:none; font-size:12px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; }
.promo-tab:last-child { border-right:none; }
.promo-tab:hover { background:#fdf9ff; color:#b480ff; }
.promo-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.promo-tab-count { font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.promo-tab.active .promo-tab-count { background:#b480ff; color:white; }

/* ── SEARCH ── */
.promo-search { display:flex; gap:10px; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; align-items:center; }
.promo-search-input { flex:1; padding:9px 14px 9px 38px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:10px center; background-size:18px; }
.promo-search-input:focus { border-color:#b480ff; background-color:white; }
.btn-search { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 14px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; text-decoration:none; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.promo-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.promo-table { width:100%; border-collapse:collapse; }
.promo-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.promo-table thead th.tc { text-align:center; }
.promo-table thead th.tr { text-align:right; }
.promo-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.promo-table tbody tr:last-child { border-bottom:none; }
.promo-table tbody tr:hover { background:#fdf9ff; }
.promo-table td { padding:14px 16px; vertical-align:middle; }
.promo-table td.tc { text-align:center; }
.promo-table td.tr { text-align:right; }
.code-badge { display:inline-flex; align-items:center; padding:5px 12px; border-radius:8px; background:linear-gradient(135deg,rgba(180,128,255,0.12),rgba(211,170,149,0.08)); border:1px solid rgba(180,128,255,0.2); font-family:monospace; font-size:13px; font-weight:800; color:#7c3aed; letter-spacing:1px; }
.reduction-value { font-size:15px; font-weight:800; color:#b480ff; }
.applies-tag { font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; background:#f5f0ff; color:#7c3aed; display:inline-block; }
.validity-text { font-size:11px; color:#6b7280; line-height:1.8; }
.usage-text  { font-size:13px; font-weight:600; color:#1a1a2e; }
.usage-limit { font-size:11px; color:#9ca3af; }
.promo-status { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.promo-status.utilisable { background:rgba(16,185,129,0.1); color:#059669; }
.promo-status.expire     { background:rgba(249,115,22,0.1); color:#f97316; }
.promo-status.inactif    { background:rgba(107,114,128,0.1); color:#6b7280; }
.promo-status.upcoming   { background:rgba(234,179,8,0.1); color:#ca8a04; }
.promo-actions { display:flex; align-items:center; gap:6px; justify-content:flex-end; flex-wrap:wrap; }
.act-btn { padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; cursor:pointer; border:none; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:opacity 0.2s; }
.act-btn:hover { opacity:0.8; }
.act-btn.details    { background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; }
.act-btn.toggle-on  { background:rgba(249,115,22,0.08); color:#f97316; border:1px solid rgba(249,115,22,0.2); }
.act-btn.toggle-off { background:rgba(16,185,129,0.08); color:#059669; border:1px solid rgba(16,185,129,0.2); }
.act-btn.edit       { background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; }
.act-btn.delete     { background:white; color:#ef4444; border:1px solid rgba(239,68,68,0.2); }
.promo-empty { text-align:center; padding:64px 24px; }
.promo-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.promo-empty p { font-size:14px; color:#d1d5db; margin-bottom:12px; }
.promo-empty a { color:#b480ff; text-decoration:none; font-weight:600; }
.promo-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="promo-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Promo Codes</div>
                <div class="adm-hero-sub">Manage discount codes for services and products</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $compteurs['actifs'] }}</span> Active
                </div>
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $compteurs['expires'] }}</span> Expired
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $compteurs['tous'] }}</span> Total
                </div>
            </div>
            <a href="{{ route('admin.codes-promo.create') }}" class="btn-hero-new">
                <i class="fa-solid fa-plus"></i> New Code
            </a>
        </div>
    </div>

    {{-- TABS --}}
    <div class="promo-tabs">
        @foreach([
            'tous'     => ['label'=>'All',      'icon'=>'fa-list'],
            'actifs'   => ['label'=>'Active',   'icon'=>'fa-circle-check'],
            'expires'  => ['label'=>'Expired',  'icon'=>'fa-clock'],
            'inactifs' => ['label'=>'Inactive', 'icon'=>'fa-ban'],
        ] as $val => $info)
            <a href="{{ route('admin.codes-promo.index', ['filtre' => $val]) }}"
               class="promo-tab {{ $filtre === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="promo-tab-count">{{ $compteurs[$val] }}</span>
            </a>
        @endforeach
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.codes-promo.index') }}">
        <input type="hidden" name="filtre" value="{{ $filtre }}">
        <div class="promo-search">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Search by code..." class="promo-search-input">
            @if($search)
                <span style="font-size:12px;color:#9ca3af;">{{ $codes->total() }} result(s)</span>
            @endif
            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            @if($search)
                <a href="{{ route('admin.codes-promo.index', ['filtre' => $filtre]) }}" class="btn-reset">
                    <i class="fa-solid fa-xmark"></i> Clear
                </a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="promo-table-card">
        @if($codes->isEmpty())
            <div class="promo-empty">
                <i class="fa-solid fa-tag"></i>
                <p>No promo codes yet.</p>
                <a href="{{ route('admin.codes-promo.create') }}">Create the first one →</a>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="promo-table">
                    <thead>
                        <tr>
                            <th>Code</th><th>Discount</th><th>Applies to</th>
                            <th class="tc">Validity</th><th class="tc">Usage</th>
                            <th class="tc">Status</th><th class="tr">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($codes as $code)
                            <tr>
                                <td><span class="code-badge">{{ $code->code }}</span></td>
                                <td>
                                    <div class="reduction-value">
                                        @if($code->type_reduction === 'pourcentage') -{{ $code->valeur }}%
                                        @else -{{ number_format($code->valeur, 0, ',', ' ') }} DA
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="applies-tag">
                                        @if($code->applicable_a === 'services') Services
                                        @elseif($code->applicable_a === 'produits') Products
                                        @else Both @endif
                                    </span>
                                </td>
                                <td class="tc">
                                    <div class="validity-text">
                                        {{ $code->date_debut->format('d/m/Y') }}<br>→ {{ $code->date_fin->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="tc">
                                    <div class="usage-text">{{ $code->nombre_utilisations }}</div>
                                    @if($code->limite_utilisation)
                                        <div class="usage-limit">/ {{ $code->limite_utilisation }}</div>
                                    @else
                                        <div class="usage-limit">unlimited</div>
                                    @endif
                                </td>
                                <td class="tc">
                                    @if($code->estUtilisable())
                                        <span class="promo-status utilisable">Active</span>
                                    @elseif($code->date_fin->isPast())
                                        <span class="promo-status expire">Expired</span>
                                    @elseif(!$code->actif)
                                        <span class="promo-status inactif">Inactive</span>
                                    @else
                                        <span class="promo-status upcoming">Upcoming</span>
                                    @endif
                                </td>
                                <td class="tr">
                                    <div class="promo-actions">
                                        <a href="{{ route('admin.codes-promo.show', $code) }}" class="act-btn details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.codes-promo.toggle', $code) }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="act-btn {{ $code->actif ? 'toggle-on' : 'toggle-off' }}">
                                                <i class="fa-solid {{ $code->actif ? 'fa-pause' : 'fa-play' }}"></i>
                                                {{ $code->actif ? 'Disable' : 'Enable' }}
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.codes-promo.edit', $code) }}" class="act-btn edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form id="del-promo-{{ $code->id }}" action="{{ route('admin.codes-promo.destroy', $code) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="button" class="act-btn delete"
                                                onclick="glowConfirm('Delete Promo Code','Delete code &laquo;{{ $code->code }}&raquo;? This cannot be undone.','Delete','fa-trash','#ef4444',function(){ document.getElementById('del-promo-{{ $code->id }}').submit(); })">
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
            <div class="promo-pagination">{{ $codes->links() }}</div>
        @endif
    </div>
</div>

<script>
// ── SCROLL PRESERVATION ───────────────────────────────────────────────────
(function() {
    var KEY = 'promo_index_scroll';
    document.addEventListener('DOMContentLoaded', function() {
        var y = sessionStorage.getItem(KEY);
        if (y !== null) {
            requestAnimationFrame(function() { window.scrollTo({ top: parseInt(y), behavior: 'instant' }); });
            sessionStorage.removeItem(KEY);
        }
    });
    document.addEventListener('submit', function() { sessionStorage.setItem(KEY, window.scrollY); }, true);
})();

// ── TOAST ─────────────────────────────────────────────────────────────────
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
