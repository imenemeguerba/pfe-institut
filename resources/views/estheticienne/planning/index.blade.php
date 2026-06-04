<x-app-layout>
<x-slot name="header">My Planning</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.pl-wrap { margin:-24px; padding:0; background:#f8f5ff; }

/* ── HERO ── */
.pl-hero{position:relative;overflow:hidden;padding:44px 32px 90px;background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);}
.pl-hero-dots{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px);background-size:28px 28px;}
.pl-hero-orb1{position:absolute;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%);top:-80px;right:-60px;animation:orbF 7s ease-in-out infinite alternate;}
.pl-hero-orb2{position:absolute;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);bottom:-40px;left:80px;animation:orbF 10s ease-in-out 2s infinite alternate;}
@keyframes orbF{from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);}}
.pl-hero-content{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;}
.pl-hero-left .pl-hero-tag{display:inline-flex;align-items:center;gap:7px;padding:5px 16px;border-radius:30px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:14px;}
.pl-hero-title{font-family:'Playfair Display',serif;font-size:34px;font-weight:800;color:white;line-height:1.2;margin-bottom:4px;}
.pl-hero-title span{-webkit-text-fill-color:rgba(255,255,255,0.75);text-decoration:underline;text-decoration-color:rgba(255,255,255,0.35);text-underline-offset:4px;}
.pl-hero-week{font-size:13px;color:rgba(255,255,255,0.75);display:flex;align-items:center;gap:6px;}
.pl-hero-actions{display:flex;gap:10px;flex-wrap:wrap;}
.btn-hero-g{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:30px;font-size:12px;font-weight:700;text-decoration:none;transition:all 0.2s;background:white;color:#059669;}
.btn-hero-g:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(0,0,0,0.15);}
.btn-hero-r{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:30px;font-size:12px;font-weight:700;text-decoration:none;transition:all 0.2s;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);color:white;}
.btn-hero-r:hover{background:rgba(255,255,255,0.25);}
.pl-wave{position:absolute;bottom:-2px;left:0;right:0;height:60px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom;background-size:cover;}
.pl-body{padding:24px;}

/* TOP */
.pl-top {
    display:flex; align-items:center; justify-content:space-between;
    background:white; border-radius:14px; border:1px solid #ede9fe;
    padding:16px 20px; margin-bottom:12px; flex-wrap:wrap; gap:12px;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
}
.pl-top-info h2 { font-size:15px; font-weight:800; color:#1a1a2e; }
.pl-top-info p  { font-size:12px; color:#9ca3af; margin-top:2px; }
.pl-actions { display:flex; gap:8px; }
.btn-a { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:30px; font-size:12px; font-weight:700; text-decoration:none; transition:all 0.2s; }
.btn-a.green { background:rgba(16,185,129,0.08); color:#059669; border:1.5px solid rgba(16,185,129,0.2); }
.btn-a.green:hover { background:rgba(16,185,129,0.15); transform:translateY(-1px); }
.btn-a.red   { background:rgba(239,68,68,0.06); color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); }
.btn-a.red:hover   { background:rgba(239,68,68,0.12); transform:translateY(-1px); }

/* NAV */
.pl-nav {
    display:flex; align-items:center; justify-content:space-between;
    background:white; border-radius:14px; border:1px solid #ede9fe;
    padding:12px 20px; margin-bottom:12px;
    box-shadow:0 2px 10px rgba(180,128,255,0.04);
}
.nav-btn {
    display:inline-flex; align-items:center; gap:5px;
    padding:7px 16px; border-radius:30px; font-size:12px; font-weight:600;
    text-decoration:none; background:#f5f0ff; color:#b480ff;
    border:1.5px solid #ede9fe; transition:all 0.2s;
}
.nav-btn:hover { border-color:#b480ff; }
.nav-center { text-align:center; }
.nav-period { font-size:13px; font-weight:800; color:#1a1a2e; }
.nav-back { font-size:11px; color:#b480ff; text-decoration:none; display:block; margin-top:3px; }

/* LEGEND */
.legend {
    display:flex; flex-wrap:wrap; gap:16px;
    background:white; border-radius:14px; border:1px solid #ede9fe;
    padding:12px 20px; margin-bottom:14px;
    box-shadow:0 2px 10px rgba(180,128,255,0.04);
}
.legend-item { display:flex; align-items:center; gap:6px; font-size:11px; color:#6b7280; font-weight:500; }
.legend-dot { width:20px; height:20px; border-radius:6px; flex-shrink:0; }
.legend-dot.available { background:#10b981; }
.legend-dot.absence   { background:#ef4444; }
.legend-dot.closed    { background-image:repeating-linear-gradient(45deg,#f3f4f6,#f3f4f6 5px,#d1d5db 5px,#d1d5db 8px); border:1px solid #d1d5db; }
.legend-dot.off       { background:white; border:1px solid #e5e7eb; }

/* CALENDAR */
.cal-card {
    background:white; border-radius:14px; border:1px solid #ede9fe;
    overflow:hidden; margin-bottom:14px;
    box-shadow:0 2px 12px rgba(180,128,255,0.05);
}
.cal-table { width:100%; border-collapse:collapse; }
.cal-table thead tr { background:#fdf9ff; }
.cal-table thead th {
    padding:10px 6px; font-size:10px; font-weight:700;
    text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af;
    border-right:1px solid #ede9fe; border-bottom:1px solid #ede9fe;
    text-align:center; min-width:58px;
}
.cal-table thead th.day-col { text-align:left; padding:10px 14px; min-width:130px; }
.cal-table tbody tr { border-bottom:1px solid #faf8ff; }
.cal-table tbody tr:last-child { border-bottom:none; }
.cal-table td { height:52px; border-right:1px solid #faf8ff; }
.cal-table td.day-label { padding:10px 14px; border-right:1px solid #ede9fe; background:white; }
.day-name { font-size:13px; font-weight:700; color:#1a1a2e; }
.day-date { font-size:11px; color:#9ca3af; margin-top:1px; }
.day-today .day-name { color:#b480ff; }
.day-today .day-date { color:#b480ff; font-weight:700; }

/* CELLS */
.cell-available {
    background:rgba(16,185,129,0.18);
    cursor:pointer; position:relative;
    transition:background 0.15s;
}
.cell-available:hover { background:rgba(16,185,129,0.32); }
.cell-available .edit-overlay { display:none; position:absolute; inset:0; align-items:center; justify-content:center; }
.cell-available:hover .edit-overlay { display:flex; }
.edit-btn {
    font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px;
    background:rgba(255,255,255,0.9); color:#059669;
    box-shadow:0 2px 6px rgba(0,0,0,0.1); transition:all 0.15s;
}
.edit-btn:hover { background:white; }

/* ✅ closed = no interaction at all */
.cell-absence { background:rgba(239,68,68,0.25); cursor:not-allowed; }
.cell-closed  {
    background-image:repeating-linear-gradient(45deg,#f3f4f6,#f3f4f6 5px,#e5e7eb 5px,#e5e7eb 8px);
    cursor:not-allowed; pointer-events:none;
}
.cell-off { background:white; }
.row-ferme .day-label { opacity:0.4; }
/* ✅ Closed row — entire row non-interactive */
.row-ferme td:not(.day-label) {
    pointer-events:none;
    background-image:repeating-linear-gradient(45deg,#f3f4f6,#f3f4f6 5px,#e5e7eb 5px,#e5e7eb 8px) !important;
    background-color:transparent !important;
    cursor:not-allowed;
}

/* BOTTOM PANELS */
.bottom-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.panel {
    background:white; border-radius:14px; border:1px solid #ede9fe;
    overflow:hidden; box-shadow:0 2px 10px rgba(180,128,255,0.04);
}
.panel-head {
    padding:14px 18px; border-bottom:1px solid #faf8ff;
    display:flex; align-items:center; gap:8px;
    background:linear-gradient(135deg,rgba(180,128,255,0.04),rgba(211,170,149,0.02));
}
.panel-head h3 { font-size:14px; font-weight:800; color:#1a1a2e; }
.panel-head i  { color:#b480ff; }
.panel-body { padding:14px 18px; }

.slot-item {
    display:flex; align-items:center; justify-content:space-between;
    padding:10px 12px; background:#fdf9ff; border-radius:10px;
    border-left:3px solid #10b981; margin-bottom:8px;
    transition:border-color 0.2s;
}
.slot-item:last-child { margin-bottom:0; }
.slot-item:hover { border-left-color:#059669; }
.slot-day  { font-size:12px; font-weight:700; color:#1a1a2e; margin-bottom:2px; }
.slot-time { font-size:11px; font-family:monospace; color:#059669; font-weight:700; }
.slot-actions { display:flex; gap:6px; }
.sa {
    padding:5px 10px; border-radius:20px; font-size:10px; font-weight:700;
    cursor:pointer; font-family:inherit; text-decoration:none;
    display:inline-flex; align-items:center; gap:3px; border:none;
    transition:all 0.2s;
}
.sa.edit { background:#f5f0ff; color:#7c3aed; }
.sa.edit:hover { background:#ede9fe; }
.sa.del  { background:#fff5f5; color:#ef4444; }
.sa.del:hover  { background:#fee2e2; }

.indispo-item {
    padding:10px 12px; border-radius:10px;
    border-left:3px solid #f97316; background:#fffbeb;
    margin-bottom:8px; transition:border-color 0.2s;
}
.indispo-item:last-child { margin-bottom:0; }
.indispo-item:hover { border-left-color:#ea580c; }
.indispo-type  { font-size:10px; font-weight:700; color:#f97316; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:3px; }
.indispo-dates { font-size:12px; font-weight:700; color:#1a1a2e; }
.indispo-motif { font-size:11px; color:#9ca3af; margin-top:2px; }
.panel-empty   { font-size:12px; color:#d1d5db; font-style:italic; padding:8px 0; }

/* ── RDV PANEL ── */
.rdv-tabs { display:flex; gap:6px; margin-bottom:14px; flex-wrap:wrap; }
.rdv-tab-btn { padding:6px 14px; border-radius:20px; font-size:11px; font-weight:700; cursor:pointer; border:1.5px solid #ede9fe; background:white; color:#6b7280; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; }
.rdv-tab-btn:hover { border-color:#b480ff; color:#b480ff; }
.rdv-tab-btn.active { background:#b480ff; color:white; border-color:#b480ff; }
.rdv-tab-btn.t-confirme.active   { background:#059669; border-color:#059669; }
.rdv-tab-btn.t-en_attente.active { background:#f97316; border-color:#f97316; }
.rdv-tab-btn.t-termine.active    { background:#6b7280; border-color:#6b7280; }
.rdv-tab-btn.t-ferme.active      { background:#ef4444; border-color:#ef4444; }
.rdv-item { display:flex; align-items:center; gap:12px; padding:12px 14px; border-radius:10px; background:#fdf9ff; border:1px solid #ede9fe; margin-bottom:8px; border-left:3px solid #ede9fe; transition:all 0.15s; }
.rdv-item:last-child { margin-bottom:0; }
.rdv-item.s-confirme   { border-left-color:#059669; }
.rdv-item.s-en_attente { border-left-color:#f97316; }
.rdv-item.s-termine    { border-left-color:#6b7280; background:#f9f9f9; }
.rdv-item.s-ferme      { border-left-color:#ef4444; background:#fff8f8; }
.rdv-item.s-reporte    { border-left-color:#3b82f6; }
.rdv-time   { text-align:center; flex-shrink:0; min-width:56px; }
.rdv-time-h { font-size:14px; font-weight:800; color:#1a1a2e; font-family:monospace; }
.rdv-time-d { font-size:10px; color:#9ca3af; margin-top:1px; }
.rdv-divider{ width:1px; background:#ede9fe; align-self:stretch; flex-shrink:0; }
.rdv-info   { flex:1; min-width:0; }
.rdv-client { font-size:13px; font-weight:700; color:#1a1a2e; }
.rdv-svcs   { font-size:11px; color:#9ca3af; margin-top:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.rdv-badge  { font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px; flex-shrink:0; white-space:nowrap; }
.rdv-badge.b-confirme   { background:rgba(16,185,129,0.1); color:#059669; }
.rdv-badge.b-en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.rdv-badge.b-termine    { background:rgba(107,114,128,0.1); color:#6b7280; }
.rdv-badge.b-annule,
.rdv-badge.b-refuse     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-badge.b-reporte    { background:rgba(59,130,246,0.1); color:#3b82f6; }

@media(max-width:900px){ .bottom-grid{ grid-template-columns:1fr; } }
</style>

<div class="pl-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="pl-hero">
        <div class="pl-hero-dots"></div>
        <div class="pl-hero-orb1"></div>
        <div class="pl-hero-orb2"></div>
        <div class="pl-hero-content">
            <div class="pl-hero-left">
                <div class="pl-hero-tag"><i class="fa-regular fa-calendar"></i> Planning</div>
                <div class="pl-hero-title">My Weekly <span>Planning</span></div>
                <div class="pl-hero-week">
                    <i class="fa-regular fa-calendar" style="font-size:11px;"></i>
                    {{ $lundi->format('d/m/Y') }} → {{ $lundi->copy()->addDays(6)->format('d/m/Y') }}
                </div>
            </div>
            <div class="pl-hero-actions">
                <a href="{{ route('estheticienne.disponibilites.create') }}" class="btn-hero-g">
                    <i class="fa-solid fa-plus"></i> Availability
                </a>
                <a href="{{ route('estheticienne.indisponibilites.create') }}" class="btn-hero-r">
                    <i class="fa-solid fa-ban"></i> Absence
                </a>
            </div>
        </div>
        <div class="pl-wave"></div>
    </div>

    <div class="pl-body">

    {{-- NAVIGATION --}}
    <div class="pl-nav">
        <a href="{{ route('estheticienne.planning.index', ['semaine' => $semaineOffset - 1]) }}" class="nav-btn">
            <i class="fa-solid fa-arrow-left"></i> Previous
        </a>
        <div class="nav-center">
            <div class="nav-period">
                @if($semaineOffset === 0) Current Week
                @elseif($semaineOffset > 0) In {{ $semaineOffset }} week(s)
                @else {{ abs($semaineOffset) }} week(s) ago
                @endif
            </div>
            @if($semaineOffset !== 0)
                <a href="{{ route('estheticienne.planning.index') }}" class="nav-back">→ Back to today</a>
            @endif
        </div>
        <a href="{{ route('estheticienne.planning.index', ['semaine' => $semaineOffset + 1]) }}" class="nav-btn">
            Next <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    {{-- LEGEND --}}
    <div class="legend">
        <div class="legend-item"><div class="legend-dot available"></div> Available</div>
        <div class="legend-item"><div class="legend-dot absence"></div> Absence / Leave</div>
        <div class="legend-item"><div class="legend-dot closed"></div> Institute Closed</div>
        <div class="legend-item"><div class="legend-dot off"></div> Not Available</div>
    </div>

    {{-- CALENDAR --}}
    @php
        $jours   = [1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',7=>'Sunday'];
        $joursEn = [1=>'lundi',2=>'mardi',3=>'mercredi',4=>'jeudi',5=>'vendredi',6=>'samedi',7=>'dimanche'];

        if (!function_exists('heureDansPlageEsthe')) {
            function heureDansPlageEsthe($heure, $plage) {
                if (empty($plage)) return false;
                $parts = explode('-', $plage);
                if (count($parts) !== 2) return false;
                $debutTotal = (int)substr(trim($parts[0]),0,2)*60 + (int)substr(trim($parts[0]),3,2);
                $finTotal   = (int)substr(trim($parts[1]),0,2)*60 + (int)substr(trim($parts[1]),3,2);
                $heureDebut = $heure * 60;
                $heureFin   = ($heure + 1) * 60;
                return $heureDebut >= $debutTotal && $heureFin <= $finTotal;
            }
            function statutInstitutEsthe($heure, $jourKey, $horairesInstitut) {
                $horaire = $horairesInstitut[$jourKey] ?? null;
                if (!$horaire || !($horaire['ouvert'] ?? false)) return 'ferme';
                $matinOk     = !empty($horaire['matin'])      && heureDansPlageEsthe($heure, $horaire['matin']);
                $apresMidiOk = !empty($horaire['apres_midi']) && heureDansPlageEsthe($heure, $horaire['apres_midi']);
                return ($matinOk || $apresMidiOk) ? 'ouvert' : 'ferme';
            }
            function dispoActiveEsthe($heure, $disposJour) {
                foreach ($disposJour as $dispo) {
                    $debutTotal = (int)substr($dispo->heure_debut,0,2)*60+(int)substr($dispo->heure_debut,3,2);
                    $finTotal   = (int)substr($dispo->heure_fin,0,2)*60+(int)substr($dispo->heure_fin,3,2);
                    $heureDebut = $heure * 60;
                    $heureFin   = ($heure + 1) * 60;
                    if ($heureDebut >= $debutTotal && $heureFin <= $finTotal) return $dispo;
                }
                return null;
            }
            function indispoCouvreDateHeure($dateJour, $heure, $indispos) {
                $debutHeure = $dateJour->copy()->setTime($heure, 0);
                $finHeure   = $dateJour->copy()->setTime($heure, 0)->addHour();
                foreach ($indispos as $indispo) {
                    if ($debutHeure < $indispo->date_fin && $finHeure > $indispo->date_debut) return $indispo;
                }
                return null;
            }
        }
    @endphp

    <div class="cal-card">
        <div style="overflow-x:auto;">
            <table class="cal-table">
                <thead>
                    <tr>
                        <th class="day-col">Day</th>
                        @foreach($heures as $h)
                            <th>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}h</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($jours as $num => $label)
                        @php
                            $key           = $joursEn[$num];
                            $dateJour      = $datesSemaine[$num];
                            $ferme         = !($horairesInstitut[$key]['ouvert'] ?? true);
                            $disposJour    = $disponibilites[$num] ?? collect();
                            $estAujourdhui = $dateJour->isToday();
                        @endphp
                        <tr class="{{ $ferme ? 'row-ferme' : '' }}">
                            <td class="day-label {{ $estAujourdhui ? 'day-today' : '' }}">
                                <div class="day-name">
                                    {{ $label }}
                                    @if($estAujourdhui)
                                        <span style="color:#b480ff;font-size:10px;"> ● today</span>
                                    @endif
                                    @if($ferme)
                                        <span style="color:#9ca3af;font-size:10px;"> — Closed</span>
                                    @endif
                                </div>
                                <div class="day-date">{{ $dateJour->format('d/m') }}</div>
                            </td>
                            @foreach($heures as $h)
                                @php
                                    $si = statutInstitutEsthe($h, $key, $horairesInstitut);
                                    $indispoActive = null;
                                    $dispoActive   = null;
                                    if ($si === 'ouvert') {
                                        $indispoActive = indispoCouvreDateHeure($dateJour, $h, $indisponibilitesSemaine);
                                        if (!$indispoActive) $dispoActive = dispoActiveEsthe($h, $disposJour);
                                    }
                                @endphp
                                @if($ferme || $si === 'ferme')
                                    {{-- ✅ Institut fermé = aucune interaction possible --}}
                                    <td class="cell-closed" title="Institute closed at this time"></td>
                                @elseif($indispoActive)
                                    <td class="cell-absence"
                                        title="{{ ucfirst($indispoActive->type) }}: {{ $indispoActive->date_debut->format('d/m/Y') }} → {{ $indispoActive->date_fin->format('d/m/Y') }}">
                                    </td>
                                @elseif($dispoActive)
                                    <td class="cell-available"
                                        title="Available: {{ \Carbon\Carbon::parse($dispoActive->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($dispoActive->heure_fin)->format('H:i') }}">
                                        <div class="edit-overlay">
                                            <a href="{{ route('estheticienne.disponibilites.edit', $dispoActive) }}" class="edit-btn">
                                                <i class="fa-solid fa-pen" style="font-size:9px;margin-right:3px;"></i> Edit
                                            </a>
                                        </div>
                                    </td>
                                @else
                                    <td class="cell-off"></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- BOTTOM PANELS --}}
    <div class="bottom-grid">

        {{-- WEEKLY SLOTS --}}
        <div class="panel">
            <div class="panel-head">
                <i class="fa-solid fa-calendar-check"></i>
                <h3>Weekly Availability</h3>
            </div>
            <div class="panel-body">
                @if($disponibilites->isEmpty())
                    <div class="panel-empty">No availability configured.</div>
                @else
                    @foreach($jours as $num => $label)
                        @if(isset($disponibilites[$num]))
                            @foreach($disponibilites[$num] as $dispo)
                                <div class="slot-item">
                                    <div>
                                        <div class="slot-day">{{ $label }}</div>
                                        <div class="slot-time">
                                            {{ \Carbon\Carbon::parse($dispo->heure_debut)->format('H:i') }}
                                            →
                                            {{ \Carbon\Carbon::parse($dispo->heure_fin)->format('H:i') }}
                                        </div>
                                    </div>
                                    <div class="slot-actions">
                                        <a href="{{ route('estheticienne.disponibilites.edit', $dispo) }}" class="sa edit">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('estheticienne.disponibilites.destroy', $dispo) }}"
                                              method="POST" style="display:inline;" id="delDispo{{ $dispo->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" class="sa del"
                                                onclick="glowConfirm(
                                                    'Delete this slot?',
                                                    '{{ $label }} {{ \Carbon\Carbon::parse($dispo->heure_debut)->format("H:i") }} → {{ \Carbon\Carbon::parse($dispo->heure_fin)->format("H:i") }}',
                                                    'Delete',
                                                    'fa-trash',
                                                    'red',
                                                    function(){ document.getElementById('delDispo{{ $dispo->id }}').submit(); }
                                                )">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

        {{-- UPCOMING ABSENCES --}}
        <div class="panel">
            <div class="panel-head">
                <i class="fa-solid fa-ban"></i>
                <h3>Upcoming Absences</h3>
            </div>
            <div class="panel-body">
                @if($indisponibilites->isEmpty())
                    <div class="panel-empty">No planned absences.</div>
                @else
                    @php $labels=['conge'=>'🏖️ Vacation','maladie'=>'🤒 Sick','formation'=>'🎓 Training','autre'=>'📌 Other']; @endphp
                    @foreach($indisponibilites as $indispo)
                        <div class="indispo-item">
                            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
                                <div>
                                    <div class="indispo-type">{{ $labels[$indispo->type] ?? $indispo->type }}</div>
                                    <div class="indispo-dates">
                                        @if($indispo->date_debut->isSameDay($indispo->date_fin))
                                            {{ $indispo->date_debut->format('d/m/Y') }}
                                        @else
                                            {{ $indispo->date_debut->format('d/m/Y') }} → {{ $indispo->date_fin->format('d/m/Y') }}
                                        @endif
                                    </div>
                                    @if($indispo->motif)
                                        <div class="indispo-motif">{{ $indispo->motif }}</div>
                                    @endif
                                </div>
                                <div class="slot-actions">
                                    <a href="{{ route('estheticienne.indisponibilites.edit', $indispo) }}" class="sa edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('estheticienne.indisponibilites.destroy', $indispo) }}"
                                          method="POST" style="display:inline;" id="delIndispo{{ $indispo->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" class="sa del"
                                            onclick="glowConfirm(
                                                'Delete this absence?',
                                                '{{ $labels[$indispo->type] ?? $indispo->type }}: {{ $indispo->date_debut->format("d/m/Y") }}',
                                                'Delete',
                                                'fa-trash',
                                                'red',
                                                function(){ document.getElementById('delIndispo{{ $indispo->id }}').submit(); }
                                            )">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
    {{-- ── APPOINTMENTS PANEL ── --}}
    @php
        $rdvAll       = $rdvsSemaine;
        $rdvConfirmes = $rdvsSemaine->filter(function($r){ return $r->statut === 'confirme'; });
        $rdvEnAttente = $rdvsSemaine->filter(function($r){ return $r->statut === 'en_attente'; });
        $rdvTermines  = $rdvsSemaine->filter(function($r){ return $r->statut === 'termine'; });
        $rdvFermes    = $rdvsSemaine->filter(function($r){ return in_array($r->statut, ['annule','refuse','reporte']); });
        $fermeStatuts = ['annule','refuse','reporte'];
        $badgeLabels  = ['confirme'=>'Confirmed','en_attente'=>'Pending','termine'=>'Done','annule'=>'Cancelled','refuse'=>'Refused','reporte'=>'Postponed'];
    @endphp
    <div class="panel" style="margin-top:14px;">
        <div class="panel-head" style="justify-content:space-between;">
            <div style="display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-calendar-week"></i>
                <h3>This Week's Appointments</h3>
            </div>
            <span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:rgba(180,128,255,0.1);color:#b480ff;">
                {{ $rdvAll->count() }} total
            </span>
        </div>
        <div class="panel-body">
            <div class="rdv-tabs">
                <button type="button" class="rdv-tab-btn active" onclick="filterRdv('all',this)">All ({{ $rdvAll->count() }})</button>
                <button type="button" class="rdv-tab-btn t-confirme" onclick="filterRdv('s-confirme',this)">✅ Confirmed ({{ $rdvConfirmes->count() }})</button>
                <button type="button" class="rdv-tab-btn t-en_attente" onclick="filterRdv('s-en_attente',this)">⏳ Pending ({{ $rdvEnAttente->count() }})</button>
                <button type="button" class="rdv-tab-btn t-termine" onclick="filterRdv('s-termine',this)">✔ Done ({{ $rdvTermines->count() }})</button>
                <button type="button" class="rdv-tab-btn t-ferme" onclick="filterRdv('s-ferme',this)">✖ Cancelled ({{ $rdvFermes->count() }})</button>
            </div>
            <div id="rdv-list">
                @if($rdvAll->isEmpty())
                    <div class="panel-empty">No appointments this week.</div>
                @else
                    @foreach($rdvAll as $rdv)
                        @php
                            $isFerme   = in_array($rdv->statut, $fermeStatuts);
                            $statusCls = $isFerme ? 's-ferme' : 's-'.$rdv->statut;
                            $badgeCls  = 'b-'.$rdv->statut;
                            $svcNames  = $rdv->services->pluck('nom')->join(', ');
                        @endphp
                        <div class="rdv-item {{ $statusCls }}" data-status="{{ $statusCls }}">
                            <div class="rdv-time">
                                <div class="rdv-time-h">{{ $rdv->date_debut->format('H:i') }}</div>
                                <div class="rdv-time-d">{{ $rdv->date_debut->format('D d/m') }}</div>
                            </div>
                            <div class="rdv-divider"></div>
                            <div class="rdv-info">
                                <div class="rdv-client">{{ $rdv->client->fullName() }}</div>
                                @if($svcNames)
                                    <div class="rdv-svcs">{{ $svcNames }}</div>
                                @endif
                            </div>
                            <span class="rdv-badge {{ $badgeCls }}">{{ $badgeLabels[$rdv->statut] ?? $rdv->statut }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>{{-- end pl-body --}}
</div>

<script>
function filterRdv(status, btn) {
    var btns = document.querySelectorAll('.rdv-tab-btn');
    for (var i = 0; i < btns.length; i++) { btns[i].classList.remove('active'); }
    btn.classList.add('active');
    var items = document.querySelectorAll('#rdv-list .rdv-item');
    for (var j = 0; j < items.length; j++) {
        if (status === 'all' || items[j].getAttribute('data-status') === status) {
            items[j].style.display = 'flex';
        } else {
            items[j].style.display = 'none';
        }
    }
}
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
