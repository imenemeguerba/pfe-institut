<x-app-layout>
<x-slot name="header">My Appointments</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.rdv-wrap { margin:-24px; padding:0; background:#f8f5ff; }
.rdv-body { padding:24px; }

/* ── HERO ── */
.rdv-hero{position:relative;overflow:hidden;padding:44px 32px 90px;background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);}
.rdv-hero-dots{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px);background-size:28px 28px;}
.rdv-hero-orb1{position:absolute;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%);top:-80px;right:-60px;animation:orbF 7s ease-in-out infinite alternate;}
.rdv-hero-orb2{position:absolute;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);bottom:-40px;left:80px;animation:orbF 10s ease-in-out 2s infinite alternate;}
@keyframes orbF{from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);}}
.rdv-hero-content{position:relative;z-index:2;}
.rdv-hero-tag{display:inline-flex;align-items:center;gap:7px;padding:5px 16px;border-radius:30px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:14px;}
.rdv-hero-title{font-family:'Playfair Display',serif;font-size:34px;font-weight:800;color:white;line-height:1.2;margin-bottom:8px;}
.rdv-hero-title span{-webkit-text-fill-color:rgba(255,255,255,0.75);text-decoration:underline;text-decoration-color:rgba(255,255,255,0.35);text-underline-offset:4px;}
.rdv-hero-sub{font-size:13px;color:rgba(255,255,255,0.8);}
.rdv-wave{position:absolute;bottom:-2px;left:0;right:0;height:60px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom;background-size:cover;}
.rdv-body{padding:24px;}

/* STATS */
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:16px; }
.stat-card {
    background:white; border-radius:14px; border:1.5px solid #ede9fe;
    padding:18px 18px; text-decoration:none; display:block;
    transition:all 0.25s; box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s forwards;
}
.stat-card:nth-child(1){animation-delay:.05s}
.stat-card:nth-child(2){animation-delay:.1s}
.stat-card:nth-child(3){animation-delay:.15s}
.stat-card:nth-child(4){animation-delay:.2s}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(180,128,255,0.12); }
.stat-card.active        { border-color:#b480ff; background:rgba(180,128,255,0.04); }
.stat-card.active-orange { border-color:#f97316; background:rgba(249,115,22,0.04); }
.stat-card.active-green  { border-color:#059669; background:rgba(16,185,129,0.04); }
.stat-card.active-blue   { border-color:#2563eb; background:rgba(37,99,235,0.04); }
.stat-ic { width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:15px; margin-bottom:12px; }
.stat-ic.orange { background:rgba(249,115,22,0.1); color:#f97316; }
.stat-ic.green  { background:rgba(16,185,129,0.1); color:#059669; }
.stat-ic.blue   { background:rgba(37,99,235,0.1);  color:#2563eb; }
.stat-ic.violet { background:rgba(180,128,255,0.1);color:#b480ff; }
.stat-label { font-size:11px; color:#9ca3af; margin-bottom:6px; font-weight:500; }
.stat-value { font-size:28px; font-weight:900; }
.stat-value.orange { color:#f97316; }
.stat-value.green  { color:#059669; }
.stat-value.blue   { color:#2563eb; }
.stat-value.gray   { color:#374151; }

/* FILTERS */
.rdv-filters {
    display:flex; flex-wrap:wrap; gap:8px;
    background:white; border-radius:14px; border:1px solid #ede9fe;
    padding:14px 20px; margin-bottom:16px;
    box-shadow:0 2px 10px rgba(180,128,255,0.04);
}
.filter-chip {
    padding:7px 16px; border-radius:30px; font-size:12px; font-weight:600;
    text-decoration:none; border:1.5px solid #ede9fe; color:#6b7280;
    background:white; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px;
}
.filter-chip:hover { border-color:#b480ff; color:#b480ff; background:#fdf9ff; }
.filter-chip.active {
    background:linear-gradient(to right,#b480ff,#d3aa95);
    color:white; border-color:transparent;
    box-shadow:0 4px 12px rgba(180,128,255,0.3);
}
.filter-chip.active i { color:white; }

/* TABLE */
.rdv-table-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    overflow:hidden; box-shadow:0 2px 12px rgba(180,128,255,0.05);
}
.rdv-table { width:100%; border-collapse:collapse; }
.rdv-table thead th {
    padding:13px 16px; text-align:left;
    font-size:10px; font-weight:700; text-transform:uppercase;
    letter-spacing:0.8px; color:#9ca3af;
    background:#fdf9ff; border-bottom:1px solid #ede9fe;
}
.rdv-table thead th.tr { text-align:right; }
.rdv-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.rdv-table tbody tr:last-child { border-bottom:none; }
.rdv-table tbody tr:hover { background:#fdf9ff; }
.rdv-table td { padding:14px 16px; vertical-align:middle; }
.rdv-table td.tr { text-align:right; }

.client-av   { width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.client-name { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:2px; }
.client-sub  { font-size:11px; color:#9ca3af; }
.rdv-date    { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:2px; }
.rdv-time    { font-size:11px; color:#9ca3af; display:flex; align-items:center; gap:4px; }
.rdv-time i  { font-size:9px; color:#b480ff; }
.rdv-tags    { display:flex; flex-wrap:wrap; gap:4px; }
.rdv-tag     { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; font-weight:600; }
.rdv-dur     { font-size:11px; color:#6b7280; margin-bottom:3px; display:flex; align-items:center; gap:3px; }
.rdv-dur i   { font-size:9px; color:#b480ff; }
.rdv-price   { font-size:14px; font-weight:800; color:#b480ff; }

.status-badge { font-size:11px; font-weight:700; padding:4px 12px; border-radius:20px; display:inline-flex; align-items:center; gap:4px; }
.status-badge.en_attente { background:rgba(234,179,8,0.1);   color:#ca8a04; }
.status-badge.confirme   { background:rgba(16,185,129,0.1);  color:#059669; }
.status-badge.refuse     { background:rgba(239,68,68,0.1);   color:#ef4444; }
.status-badge.annule     { background:rgba(107,114,128,0.1); color:#6b7280; }
.status-badge.termine    { background:rgba(37,99,235,0.1);   color:#2563eb; }
.status-badge.reporte    { background:rgba(249,115,22,0.1);  color:#f97316; }

.btn-view {
    padding:7px 14px; border-radius:20px; background:#f5f0ff; color:#7c3aed;
    font-size:11px; font-weight:700; text-decoration:none;
    display:inline-flex; align-items:center; gap:4px;
    border:1px solid #ede9fe; transition:all 0.2s;
}
.btn-view:hover { background:#ede9fe; transform:translateX(2px); }

.rdv-empty { text-align:center; padding:64px 24px; }
.rdv-empty i { font-size:48px; color:#e9d8fd; margin-bottom:14px; display:block; }
.rdv-empty p { font-size:14px; color:#d1d5db; }
.rdv-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }

@media(max-width:768px){ .stats-grid{ grid-template-columns:1fr 1fr; } }

/* ── HERO ── */
.page-hero{position:relative;overflow:hidden;padding:44px 32px 90px;background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);}
.ph-dots{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px);background-size:28px 28px;}
.ph-orb1{position:absolute;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%);top:-80px;right:-60px;animation:phOrb 7s ease-in-out infinite alternate;}
.ph-orb2{position:absolute;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);bottom:-40px;left:80px;animation:phOrb 10s ease-in-out 2s infinite alternate;}
@keyframes phOrb{from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);}}
.ph-content{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;}
.ph-tag{display:inline-flex;align-items:center;gap:7px;padding:5px 16px;border-radius:30px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:14px;}
.ph-title{font-family:'Playfair Display',serif;font-size:34px;font-weight:800;color:white;text-shadow:0 2px 16px rgba(0,0,0,0.15);line-height:1.2;margin-bottom:6px;}
.ph-title span{-webkit-text-fill-color:rgba(255,255,255,0.75);text-decoration:underline;text-decoration-color:rgba(255,255,255,0.35);text-underline-offset:4px;}
.ph-sub{font-size:13px;color:rgba(255,255,255,0.8);line-height:1.7;}
.ph-right{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
.ph-pill{display:flex;align-items:center;gap:10px;padding:11px 16px;border-radius:20px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);}
.ph-pill-ic{width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:12px;color:white;}
.ph-pill-num{font-size:20px;font-weight:900;color:white;line-height:1;}
.ph-pill-lbl{font-size:10px;color:rgba(255,255,255,0.7);}
.ph-wave{position:absolute;bottom:-2px;left:0;right:0;height:60px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom;background-size:cover;}

</style>

<div class="rdv-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="page-hero">
        <div class="ph-dots"></div>
        <div class="ph-orb1"></div>
        <div class="ph-orb2"></div>
        <div class="ph-content">
            <div>
                <div class="ph-tag"><i class="fa-solid fa-calendar-check"></i> Appointments</div>
                <h1 class="ph-title">My <span>Appointments</span></h1>
                <p class="ph-sub">Manage and track all your client appointments.</p>
            </div>
            <div class="ph-right">
                <div class="ph-pill">
                    <div class="ph-pill-ic"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div>
                        <div class="ph-pill-num">{{ $compteurs['en_attente'] }}</div>
                        <div class="ph-pill-lbl">Pending</div>
                    </div>
                </div>
                <div class="ph-pill">
                    <div class="ph-pill-ic"><i class="fa-solid fa-circle-check"></i></div>
                    <div>
                        <div class="ph-pill-num">{{ $compteurs['total'] }}</div>
                        <div class="ph-pill-lbl">Total</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ph-wave"></div>
    </div>

    <div class="rdv-body">

    {{-- STATS --}}
    <div class="stats-grid">
        <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>'en_attente']) }}"
           class="stat-card {{ $filtreActuel==='en_attente'?'active-orange':'' }}">
            <div class="stat-ic orange"><i class="fa-solid fa-hourglass-half"></i></div>
            <div class="stat-label">Pending Requests</div>
            <div class="stat-value orange">{{ $compteurs['en_attente'] }}</div>
        </a>
        <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>'confirme']) }}"
           class="stat-card {{ $filtreActuel==='confirme'?'active-green':'' }}">
            <div class="stat-ic green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-label">Confirmed</div>
            <div class="stat-value green">{{ $compteurs['confirme'] }}</div>
        </a>
        <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>'termine']) }}"
           class="stat-card {{ $filtreActuel==='termine'?'active-blue':'' }}">
            <div class="stat-ic blue"><i class="fa-solid fa-flag-checkered"></i></div>
            <div class="stat-label">Completed</div>
            <div class="stat-value blue">{{ $compteurs['termine'] }}</div>
        </a>
        <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>'tous']) }}"
           class="stat-card {{ $filtreActuel==='tous'?'active':'' }}">
            <div class="stat-ic violet"><i class="fa-solid fa-list"></i></div>
            <div class="stat-label">All</div>
            <div class="stat-value gray">{{ $compteurs['total'] }}</div>
        </a>
    </div>

    {{-- FILTERS --}}
    <div class="rdv-filters">
        @foreach([
            'tous'       => ['All',        'fa-list'],
            'en_attente' => ['Pending',    'fa-hourglass-half'],
            'confirme'   => ['Confirmed',  'fa-check'],
            'refuse'     => ['Refused',    'fa-xmark'],
            'annule'     => ['Cancelled',  'fa-ban'],
            'termine'    => ['Completed',  'fa-flag-checkered'],
        ] as $val => $info)
            <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>$val]) }}"
               class="filter-chip {{ $filtreActuel===$val?'active':'' }}">
                <i class="fa-solid {{ $info[1] }}" style="font-size:10px;"></i>
                {{ $info[0] }}
            </a>
        @endforeach
    </div>

    {{-- TABLE --}}
    <div class="rdv-table-card">
        @if($rendezVous->isEmpty())
            <div class="rdv-empty">
                <i class="fa-regular fa-calendar-xmark"></i>
                <p>No appointments found.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="rdv-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Date & Time</th>
                            <th>Services       &          category</th>
                            <th>Duration / Price</th>
                            <th>Status</th>
                            <th class="tr"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rendezVous as $rdv)
                        @php
                            $sIcons = ['en_attente'=>'fa-hourglass-half','confirme'=>'fa-check','refuse'=>'fa-xmark','annule'=>'fa-ban','termine'=>'fa-flag-checkered','reporte'=>'fa-rotate'];
                            $sLabels = ['en_attente'=>'Pending','confirme'=>'Confirmed','refuse'=>'Refused','annule'=>'Cancelled','termine'=>'Done','reporte'=>'Rescheduled'];
                        @endphp
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        @if($rdv->client->photo)
                                            <img src="{{ asset('storage/'.$rdv->client->photo) }}" class="client-av" style="object-fit:cover;" alt="">
                                        @else
                                            <div class="client-av">{{ strtoupper(substr($rdv->client->prenom,0,1)) }}</div>
                                        @endif
                                        <div>
                                            <div class="client-name">{{ $rdv->client->fullName() }}</div>
                                            <div class="client-sub">{{ $rdv->client->telephone ?? $rdv->client->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="rdv-date">{{ $rdv->date_debut->format('d/m/Y') }}</div>
                                    <div class="rdv-time">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $rdv->date_debut->format('H:i') }} → {{ $rdv->date_fin->format('H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="rdv-tags">
                                        @foreach($rdv->services->take(3) as $s)
                                            <span class="rdv-tag">{{ $s->nom }}</span>
                                        @endforeach
                                        @if($rdv->services->count() > 3)
                                            <span class="rdv-tag">+{{ $rdv->services->count()-3 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="rdv-dur">
                                        <i class="fa-regular fa-clock"></i> {{ $rdv->duree_totale }} min
                                    </div>
                                    <div class="rdv-price">{{ number_format($rdv->prix_final,0,',',' ') }} DA</div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $rdv->statut }}">
                                        <i class="fa-solid {{ $sIcons[$rdv->statut] ?? 'fa-circle' }}" style="font-size:9px;"></i>
                                        {{ $sLabels[$rdv->statut] ?? $rdv->statut }}
                                    </span>
                                </td>
                                <td class="tr">
                                    <a href="{{ route('estheticienne.rendez-vous.show', $rdv) }}" class="btn-view">
                                        View <i class="fa-solid fa-arrow-right" style="font-size:9px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="rdv-pagination">{{ $rendezVous->links() }}</div>
        @endif
    </div>

    </div>{{-- end rdv-body --}}
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

    </div>{{-- end rdv-body --}}
</x-app-layout>
