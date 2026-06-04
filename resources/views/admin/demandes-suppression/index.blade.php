<x-app-layout>
<x-slot name="header">Account Deletion Requests</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.del-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.del-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.del-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:12px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; }
.del-tab:last-child { border-right:none; }
.del-tab:hover { background:#fdf9ff; color:#b480ff; }
.del-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.del-tab-count { font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.del-tab.active .del-tab-count { background:#b480ff; color:white; }
.del-tab-count.orange { background:rgba(249,115,22,0.1); color:#f97316; }
.del-tab.pending.active .del-tab-count { background:#f97316; color:white; }

/* ── TABLE ── */
.del-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.del-table { width:100%; border-collapse:collapse; }
.del-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.del-table thead th.tc { text-align:center; }
.del-table thead th.tr { text-align:right; }
.del-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.del-table tbody tr:last-child { border-bottom:none; }
.del-table tbody tr:hover { background:#fdf9ff; }
.del-table td { padding:14px 16px; vertical-align:middle; }
.del-table td.tc { text-align:center; }
.del-table td.tr { text-align:right; }
.del-av { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:13px; font-weight:700; flex-shrink:0; }
.del-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
.del-email { font-size:11px; color:#9ca3af; margin-top:1px; }
.del-role  { font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; display:inline-block; }
.del-role.client { background:rgba(59,130,246,0.08); color:#2563eb; }
.del-role.esthe  { background:rgba(124,58,237,0.08); color:#7c3aed; }
.del-date   { font-size:12px; color:#6b7280; }
.del-status { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.del-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.del-status.acceptee   { background:rgba(16,185,129,0.1); color:#059669; }
.del-status.refusee    { background:rgba(239,68,68,0.1); color:#ef4444; }
.del-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; }
.del-link:hover { color:#9333ea; }
.del-empty { text-align:center; padding:64px 24px; }
.del-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.del-empty p { font-size:14px; color:#d1d5db; }
.del-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="del-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Deletion Requests</div>
                <div class="adm-hero-sub">Account deletion requests from clients and experts</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $compteurs['en_attente'] }}</span> Pending
                </div>
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $compteurs['acceptees'] }}</span> Accepted
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $compteurs['toutes'] }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="del-tabs">
        @foreach([
            'en_attente' => ['label'=>'Pending',  'icon'=>'fa-clock',        'class'=>'pending'],
            'acceptees'  => ['label'=>'Accepted', 'icon'=>'fa-circle-check', 'class'=>''],
            'refusees'   => ['label'=>'Refused',  'icon'=>'fa-xmark',        'class'=>''],
            'toutes'     => ['label'=>'All',       'icon'=>'fa-list',         'class'=>''],
        ] as $val => $info)
            <a href="{{ route('admin.demandes-suppression.index', ['filtre' => $val]) }}"
               class="del-tab {{ $info['class'] }} {{ $filtre === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="del-tab-count {{ ($val === 'en_attente' && $filtre !== 'en_attente') ? 'orange' : '' }}">
                    {{ $compteurs[$val] }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- TABLE --}}
    <div class="del-table-card">
        @if($demandes->isEmpty())
            <div class="del-empty">
                <i class="fa-solid fa-user-slash"></i>
                <p>No requests in this category.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="del-table">
                    <thead>
                        <tr>
                            <th>User</th><th>Role</th><th>Requested</th>
                            <th class="tc">Status</th><th class="tr"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="del-av">{{ strtoupper(substr($demande->user->prenom,0,1)) }}</div>
                                        <div>
                                            <div class="del-name">{{ $demande->user->fullName() }}</div>
                                            <div class="del-email">{{ $demande->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($demande->user->isClient())
                                        <span class="del-role client">Client</span>
                                    @else
                                        <span class="del-role esthe">Expert</span>
                                    @endif
                                </td>
                                <td><div class="del-date">{{ $demande->created_at->format('d/m/Y H:i') }}</div></td>
                                <td class="tc">
                                    <span class="del-status {{ $demande->statut }}">
                                        {{ ['en_attente'=>'Pending','acceptee'=>'Accepted','refusee'=>'Refused'][$demande->statut] ?? $demande->statut }}
                                    </span>
                                </td>
                                <td class="tr">
                                    <a href="{{ route('admin.demandes-suppression.show', $demande) }}" class="del-link">
                                        View <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="del-pagination">{{ $demandes->links() }}</div>
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
