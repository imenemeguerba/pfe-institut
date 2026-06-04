<x-app-layout>
<x-slot name="header">Appointments</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.rdv-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.btn-cal-hero { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:13px; font-weight:700; text-decoration:none; transition:background 0.2s; }
.btn-cal-hero:hover { background:rgba(255,255,255,0.3); }

/* ── TABS ── */
.rdv-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.rdv-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:13px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
.rdv-tab:last-child { border-right:none; }
.rdv-tab:hover { background:#fdf9ff; color:#b480ff; }
.rdv-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.rdv-tab-count { font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.rdv-tab.active .rdv-tab-count { background:#b480ff; color:white; }

/* ── FILTERS ── */
.rdv-filters { display:flex; align-items:flex-end; gap:12px; flex-wrap:wrap; background:white; border-radius:14px; padding:16px 20px; border:1px solid #ede9fe; margin-bottom:16px; }
.f-group label { display:block; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:6px; }
.f-input { padding:9px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; }
.f-input-search { min-width:260px; }
.btn-filter { padding:9px 20px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:600; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; display:inline-flex; align-items:center; gap:6px; }
.btn-filter:hover { opacity:0.88; }
.btn-reset { padding:9px 16px; border-radius:10px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; text-decoration:none; font-family:'Plus Jakarta Sans',sans-serif; }
.btn-reset:hover { border-color:#b480ff; color:#b480ff; }

/* ── TABLE ── */
.rdv-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.rdv-table { width:100%; border-collapse:collapse; }
.rdv-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.rdv-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.rdv-table tbody tr:last-child { border-bottom:none; }
.rdv-table tbody tr:hover { background:#fdf9ff; }
.rdv-table tbody tr.today-row { background:rgba(180,128,255,0.03); }
.rdv-table td { padding:14px 16px; vertical-align:middle; }
.rdv-date-day  { font-size:13px; font-weight:700; color:#1a1a2e; text-transform:capitalize; }
.rdv-date-time { font-size:11px; color:#9ca3af; margin-top:2px; }
.rdv-grouped   { font-size:10px; color:#b480ff; margin-top:2px; font-weight:600; }
.rdv-person    { font-size:13px; font-weight:600; color:#1a1a2e; text-decoration:none; transition:color 0.15s; }
.rdv-person:hover { color:#b480ff; }
.rdv-services  { display:flex; flex-wrap:wrap; gap:4px; }
.rdv-service-tag { font-size:10px; padding:3px 8px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; font-weight:500; }
.rdv-duration  { font-size:13px; color:#6b7280; }
.rdv-price     { font-size:13px; font-weight:700; color:#b480ff; }
.rdv-status    { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.rdv-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.rdv-status.confirme   { background:rgba(16,185,129,0.1); color:#059669; }
.rdv-status.termine    { background:rgba(96,165,250,0.1); color:#2563eb; }
.rdv-status.annule     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-status.refuse     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-status.reporte    { background:rgba(234,179,8,0.1); color:#ca8a04; }
.rdv-detail-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; white-space:nowrap; }
.rdv-detail-link:hover { color:#9333ea; }
.rdv-empty { text-align:center; padding:64px 24px; }
.rdv-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; }
.rdv-empty p { font-size:14px; color:#d1d5db; }
.rdv-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="rdv-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Appointments</div>
                <div class="adm-hero-sub">Overview of all scheduled and past appointments</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $counts['aujourd_hui'] }}</span> Today
                </div>
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $counts['a_venir'] }}</span> Upcoming
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $counts['tous'] }}</span> Total
                </div>
            </div>
            <a href="{{ route('admin.rendez-vous.calendrier') }}" class="btn-cal-hero">
                <i class="fa-regular fa-calendar"></i> View Calendar
            </a>
        </div>
    </div>

    {{-- TABS --}}
    <div class="rdv-tabs">
        @foreach([
            'tous'        => ['label'=>'All',      'icon'=>'fa-list'],
            'aujourd_hui' => ['label'=>'Today',    'icon'=>'fa-location-dot'],
            'a_venir'     => ['label'=>'Upcoming', 'icon'=>'fa-clock'],
            'passes'      => ['label'=>'Past',     'icon'=>'fa-rotate-left'],
        ] as $val => $info)
            <a href="{{ route('admin.rendez-vous.index', array_merge(request()->query(), ['filtre' => $val])) }}"
               class="rdv-tab {{ $filtre === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="rdv-tab-count">{{ $counts[$val] }}</span>
            </a>
        @endforeach
    </div>

    {{-- FILTERS --}}
    <form method="GET" action="{{ route('admin.rendez-vous.index') }}">
        <input type="hidden" name="filtre" value="{{ $filtre }}">
        <div class="rdv-filters">
            <div class="f-group" style="flex:1;">
                <label>Search</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Client, expert, service..." class="f-input f-input-search" style="width:100%;">
            </div>
            <div class="f-group">
                <label>Status</label>
                <select name="statut" class="f-input">
                    <option value="">All statuses</option>
                    @foreach(['en_attente'=>'Pending','confirme'=>'Confirmed','termine'=>'Done','annule'=>'Cancelled','refuse'=>'Refused','reporte'=>'Rescheduled'] as $val => $label)
                        <option value="{{ $val }}" {{ $statut === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-filter"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
            @if($search || $statut)
                <a href="{{ route('admin.rendez-vous.index', ['filtre' => $filtre]) }}" class="btn-reset">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @endif
        </div>
    </form>

    {{-- TABLE --}}
    <div class="rdv-table-card">
        @if($rdvs->isEmpty())
            <div class="rdv-empty">
                <i class="fa-solid fa-calendar-xmark"></i>
                <p>No appointments found.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="rdv-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th><th>Client</th><th>Expert</th>
                            <th>Services</th><th>Duration</th><th>Price</th><th>Status</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rdvs as $rdv)
                            <tr class="{{ $rdv->date_debut->isToday() ? 'today-row' : '' }}">
                                <td>
                                    <div class="rdv-date-day">{{ $rdv->date_debut->isoFormat('ddd D MMM YYYY') }}</div>
                                    <div class="rdv-date-time">
                                        <i class="fa-regular fa-clock" style="font-size:10px;"></i>
                                        {{ $rdv->date_debut->format('H:i') }} → {{ $rdv->date_fin->format('H:i') }}
                                    </div>
                                    @if($rdv->groupe_reservation)
                                        <div class="rdv-grouped"><i class="fa-solid fa-link" style="font-size:9px;"></i> Grouped</div>
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.clients.show', $rdv->client) }}" class="rdv-person">{{ $rdv->client->fullName() }}</a></td>
                                <td><a href="{{ route('admin.estheticiennes.show', $rdv->estheticienne) }}" class="rdv-person">{{ $rdv->estheticienne->fullName() }}</a></td>
                                <td>
                                    <div class="rdv-services">
                                        @foreach($rdv->services as $s)
                                            <span class="rdv-service-tag">{{ $s->nom }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td><div class="rdv-duration">{{ $rdv->duree_totale }} min</div></td>
                                <td><div class="rdv-price">{{ number_format($rdv->prix_final, 0, ',', ' ') }} DA</div></td>
                                <td>
                                    <span class="rdv-status {{ $rdv->statut }}">
                                        {{ ['en_attente'=>'Pending','confirme'=>'Confirmed','termine'=>'Done','annule'=>'Cancelled','refuse'=>'Refused','reporte'=>'Rescheduled'][$rdv->statut] ?? $rdv->statut }}
                                    </span>
                                </td>
                                <td><a href="{{ route('admin.rendez-vous.show', $rdv) }}" class="rdv-detail-link">View <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rdv-pagination">{{ $rdvs->links() }}</div>
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
