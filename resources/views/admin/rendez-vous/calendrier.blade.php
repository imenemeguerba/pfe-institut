<x-app-layout>
<x-slot name="header">Calendar</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.cal-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

/* ── TOP NAV ── */
.cal-topnav { display:flex; align-items:center; justify-content:space-between; background:white; border-radius:14px; padding:14px 20px; border:1px solid #ede9fe; margin-bottom:16px; flex-wrap:wrap; gap:12px; }
.cal-nav-btn { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:30px; font-size:12px; font-weight:600; text-decoration:none; background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; transition:all 0.2s; }
.cal-nav-btn:hover { background:#b480ff; color:white; border-color:transparent; }
.cal-week-label { font-size:14px; font-weight:700; color:#1a1a2e; text-align:center; }
.cal-today-link { font-size:11px; color:#b480ff; text-decoration:none; display:block; text-align:center; margin-top:3px; }

/* ── FILTERS ── */
.cal-filters { display:flex; align-items:center; gap:12px; background:white; border-radius:14px; padding:12px 20px; border:1px solid #ede9fe; margin-bottom:16px; }
.cal-filters label { font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-right:6px; }
.cal-select { padding:8px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; cursor:pointer; transition:border-color 0.2s; }
.cal-select:focus { border-color:#b480ff; }

/* ── LEGEND ── */
.cal-legend { display:flex; flex-wrap:wrap; gap:16px; align-items:center; background:white; border-radius:14px; padding:12px 20px; border:1px solid #ede9fe; margin-bottom:16px; }
.legend-item { display:flex; align-items:center; gap:6px; font-size:11px; color:#6b7280; }
.legend-dot { width:14px; height:14px; border-radius:4px; flex-shrink:0; }
.legend-dot.confirmed { background:#b480ff; }
.legend-dot.pending   { background:#f97316; }
.legend-dot.done      { background:#60a5fa; }
.legend-dot.available { background:#34d399; }
.legend-dot.absence   { background:#f87171; }
.legend-dot.closed    { background-image:repeating-linear-gradient(45deg,#f3f4f6,#f3f4f6 3px,#d1d5db 3px,#d1d5db 6px); }

/* ── ESTHE BLOCK ── */
.esthe-block { background:white; border-radius:16px; border:1px solid #ede9fe; margin-bottom:20px; overflow:hidden; }
.esthe-header { display:flex; align-items:center; justify-content:space-between; padding:14px 20px; background:linear-gradient(to right,rgba(180,128,255,0.06),rgba(211,170,149,0.04)); border-bottom:1px solid #ede9fe; flex-wrap:wrap; gap:10px; }
.esthe-header-left { display:flex; align-items:center; gap:12px; }
.esthe-av { width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:13px; flex-shrink:0; }
.esthe-name { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:2px; }
.esthe-spec { font-size:11px; color:#9ca3af; }
.esthe-header-right { display:flex; align-items:center; gap:12px; }
.esthe-rdv-count { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.esthe-profile-link { font-size:11px; color:#b480ff; text-decoration:none; font-weight:600; }
.esthe-profile-link:hover { color:#9333ea; }

/* ── CALENDAR TABLE ── */
.cal-table-wrap { overflow-x:auto; }
.cal-table { width:100%; border-collapse:collapse; min-width:800px; }
.cal-table thead th { padding:8px 6px; text-align:center; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; border-right:1px solid #f3f0ff; background:#fdf9ff; }
.cal-table thead th.day-col { text-align:left; padding-left:16px; min-width:100px; }
.cal-table thead th:last-child { border-right:none; }
.cal-table tbody tr { border-top:1px solid #f3f0ff; }
.cal-table tbody tr.today-row { background:rgba(180,128,255,0.03); }
.day-cell { padding:8px 16px; border-right:1px solid #f3f0ff; min-width:100px; }
.day-name { font-size:12px; font-weight:600; color:#374151; }
.day-name.closed-day { color:#d1d5db; text-decoration:line-through; }
.day-date { font-size:10px; color:#9ca3af; margin-top:1px; }
.day-date.today-badge { color:#b480ff; font-weight:700; }
.hour-cell { height:44px; border-right:1px solid #f3f0ff; padding:0; position:relative; }
.hour-cell:last-child { border-right:none; }
.cell-closed   { height:44px; background-image:repeating-linear-gradient(45deg,#f9f8fc,#f9f8fc 3px,#ede9fe 3px,#ede9fe 6px); }
.cell-absence  { height:44px; background:#fecaca; }
.cell-available { height:44px; background:#bbf7d0; }
.cell-empty    { height:44px; background:white; }
.cell-rdv { height:44px; width:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; text-decoration:none; transition:opacity 0.15s; }
.cell-rdv:hover { opacity:0.85; }
.cell-rdv.confirmed { background:#b480ff; }
.cell-rdv.pending   { background:#f97316; }
.cell-rdv.done      { background:#60a5fa; }
.cell-rdv span { font-size:9px; font-weight:700; color:white; line-height:1.3; text-align:center; }

/* ── RDV LIST ── */
.rdv-list { border-top:1px solid #f3f0ff; }
.rdv-list-title { font-size:12px; font-weight:700; color:#1a1a2e; padding:14px 20px 10px; }
.rdv-row { display:flex; align-items:center; gap:16px; padding:10px 20px; border-top:1px solid #fdf9ff; transition:background 0.15s; flex-wrap:wrap; }
.rdv-row:hover { background:#fdf9ff; }
.rdv-row.today-rdv { background:rgba(180,128,255,0.03); }
.rdv-time { font-size:12px; font-weight:600; color:#1a1a2e; min-width:110px; }
.rdv-time-day { font-size:10px; color:#9ca3af; font-weight:400; }
.rdv-client { font-size:13px; font-weight:600; color:#b480ff; text-decoration:none; min-width:120px; }
.rdv-client:hover { color:#9333ea; }
.rdv-services { display:flex; flex-wrap:wrap; gap:4px; flex:1; }
.rdv-service-tag { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; font-weight:500; }
.rdv-duration { font-size:11px; color:#9ca3af; min-width:60px; }
.rdv-status { font-size:10px; font-weight:600; padding:3px 10px; border-radius:20px; }
.rdv-status.confirme   { background:rgba(180,128,255,0.1); color:#b480ff; }
.rdv-status.termine    { background:rgba(96,165,250,0.1); color:#2563eb; }
.rdv-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.rdv-status.annule     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-status.refuse     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-status.reporte    { background:rgba(234,179,8,0.1); color:#ca8a04; }
.rdv-detail-link { font-size:11px; color:#b480ff; text-decoration:none; font-weight:600; margin-left:auto; }
.rdv-detail-link:hover { color:#9333ea; }
.cal-empty { text-align:center; padding:48px; color:#d1d5db; font-size:14px; }
</style>

@php
    $jours   = [1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',7=>'Sunday'];
    $joursEn = [1=>'lundi',2=>'mardi',3=>'mercredi',4=>'jeudi',5=>'vendredi',6=>'samedi',7=>'dimanche'];
    if (!function_exists('adminHeureDansPlage')) {
        function adminHeureDansPlage($heure, $plage) {
            if (empty($plage)) return false;
            $parts = explode('-', $plage);
            if (count($parts) !== 2) return false;
            $dt = (int)substr(trim($parts[0]),0,2)*60 + (int)substr(trim($parts[0]),3,2);
            $ft = (int)substr(trim($parts[1]),0,2)*60 + (int)substr(trim($parts[1]),3,2);
            return ($heure*60) >= $dt && (($heure+1)*60) <= $ft;
        }
        function adminStatutInstitut($heure, $jourKey, $horaires) {
            $h = $horaires[$jourKey] ?? null;
            if (!$h || !($h['ouvert'] ?? false)) return 'ferme';
            if ((!empty($h['matin']) && adminHeureDansPlage($heure, $h['matin'])) ||
                (!empty($h['apres_midi']) && adminHeureDansPlage($heure, $h['apres_midi']))) return 'ouvert';
            return 'ferme';
        }
        function adminDispoActive($heure, $disposJour) {
            foreach ($disposJour as $d) {
                $dt = (int)substr($d->heure_debut,0,2)*60+(int)substr($d->heure_debut,3,2);
                $ft = (int)substr($d->heure_fin,0,2)*60+(int)substr($d->heure_fin,3,2);
                if ($heure*60 >= $dt && ($heure+1)*60 <= $ft) return true;
            }
            return false;
        }
        function adminIndispoActive($dateJour, $heure, $indispos) {
            $dh = $dateJour->copy()->setTime($heure, 0);
            $fh = $dateJour->copy()->setTime($heure, 0)->addHour();
            foreach ($indispos as $i) {
                if ($dh < $i->date_fin && $fh > $i->date_debut) return true;
            }
            return false;
        }
        function adminRdvActifs($dateJour, $heure, $rdvsEsthe) {
            $dh = $dateJour->copy()->setTime($heure, 0);
            $fh = $dateJour->copy()->setTime($heure, 0)->addHour();
            $res = [];
            foreach ($rdvsEsthe as $rdv) {
                if ($dh < $rdv->date_fin && $fh > $rdv->date_debut) $res[] = $rdv;
            }
            return $res;
        }
    }
@endphp

<div class="cal-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- TOP NAV --}}
    <div class="cal-topnav">
        <a href="{{ route('admin.rendez-vous.calendrier', ['semaine' => $semaineOffset - 1, 'estheticienne_id' => $estheId]) }}" class="cal-nav-btn">
            <i class="fa-solid fa-chevron-left"></i> Previous week
        </a>
        <div>
            <div class="cal-week-label">{{ $lundi->format('d M') }} – {{ $lundi->copy()->addDays(6)->format('d M Y') }}</div>
            @if($semaineOffset !== 0)
                <a href="{{ route('admin.rendez-vous.calendrier', ['estheticienne_id' => $estheId]) }}" class="cal-today-link">→ Back to today</a>
            @endif
        </div>
        <a href="{{ route('admin.rendez-vous.calendrier', ['semaine' => $semaineOffset + 1, 'estheticienne_id' => $estheId]) }}" class="cal-nav-btn">
            Next week <i class="fa-solid fa-chevron-right"></i>
        </a>
    </div>

    {{-- FILTERS --}}
    <div class="cal-filters">
        <i class="fa-solid fa-filter" style="color:#b480ff;font-size:13px;"></i>
        <label>Filter by expert</label>
        <form method="GET" action="{{ route('admin.rendez-vous.calendrier') }}">
            <input type="hidden" name="semaine" value="{{ $semaineOffset }}">
            <select name="estheticienne_id" class="cal-select" onchange="this.form.submit()">
                <option value="">All experts</option>
                @foreach($toutesEsthes as $esthe)
                    <option value="{{ $esthe->id }}" {{ $estheId == $esthe->id ? 'selected' : '' }}>{{ $esthe->fullName() }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.rendez-vous.index') }}" style="margin-left:auto;font-size:12px;color:#b480ff;text-decoration:none;font-weight:600;">
            <i class="fa-solid fa-list"></i> Appointments list
        </a>
    </div>

    {{-- LEGEND --}}
    <div class="cal-legend">
        <div class="legend-item"><div class="legend-dot confirmed"></div> Confirmed</div>
        <div class="legend-item"><div class="legend-dot pending"></div> Pending</div>
        <div class="legend-item"><div class="legend-dot done"></div> Done</div>
        <div class="legend-item"><div class="legend-dot available"></div> Available</div>
        <div class="legend-item"><div class="legend-dot absence"></div> Absence</div>
        <div class="legend-item"><div class="legend-dot closed"></div> Closed</div>
    </div>

    {{-- ESTHETICIENNES --}}
    @forelse($estheticiennes as $esthe)
        @php
            $rdvsEsthe     = $rdvsSemaine[$esthe->id] ?? collect();
            $disposEsthe   = $disponibilites[$esthe->id] ?? collect();
            $indisposEsthe = $indisponibilites[$esthe->id] ?? collect();
        @endphp
        <div class="esthe-block">
            <div class="esthe-header">
                <div class="esthe-header-left">
                    <div class="esthe-av">{{ strtoupper(substr($esthe->prenom,0,1)) }}</div>
                    <div>
                        <div class="esthe-name">{{ $esthe->fullName() }}</div>
                        @if($esthe->specialites)<div class="esthe-spec">{{ Str::limit($esthe->specialites, 60) }}</div>@endif
                    </div>
                </div>
                <div class="esthe-header-right">
                    @if($rdvsEsthe->count() > 0)
                        <span class="esthe-rdv-count"><i class="fa-solid fa-calendar-check"></i> {{ $rdvsEsthe->count() }} this week</span>
                    @else
                        <span style="font-size:11px;color:#d1d5db;">No appointments this week</span>
                    @endif
                    <a href="{{ route('admin.estheticiennes.show', $esthe) }}" class="esthe-profile-link">Profile →</a>
                </div>
            </div>
            <div class="cal-table-wrap">
                <table class="cal-table">
                    <thead>
                        <tr>
                            <th class="day-col">Day</th>
                            @foreach($heures as $h)<th>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}h</th>@endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jours as $num => $label)
                            @php
                                $key        = $joursEn[$num];
                                $dateJour   = $datesSemaine[$num];
                                $jourFerme  = !($horairesInstitut[$key]['ouvert'] ?? false);
                                $disposJour = $disposEsthe[$num] ?? collect();
                                $rdvsJour   = $rdvsEsthe->filter(fn($r) => $r->date_debut->dayOfWeekIso === $num);
                                $isToday    = $dateJour->isToday();
                            @endphp
                            <tr class="{{ $isToday ? 'today-row' : '' }}">
                                <td class="day-cell">
                                    <div class="day-name {{ $jourFerme ? 'closed-day' : '' }}">{{ $label }}</div>
                                    <div class="day-date {{ $isToday ? 'today-badge' : '' }}">{{ $dateJour->format('d/m') }}{{ $isToday ? ' ●' : '' }}</div>
                                </td>
                                @foreach($heures as $h)
                                    @php
                                        $statut    = adminStatutInstitut($h, $key, $horairesInstitut);
                                        $rdvsHeure = [];
                                        $indispo   = false;
                                        $dispo     = false;
                                        if ($statut === 'ouvert') {
                                            $indispo = adminIndispoActive($dateJour, $h, $indisposEsthe);
                                            if (!$indispo) {
                                                $rdvsHeure = adminRdvActifs($dateJour, $h, $rdvsJour);
                                                if (empty($rdvsHeure)) $dispo = adminDispoActive($h, $disposJour);
                                            }
                                        }
                                    @endphp
                                    @if($statut === 'ferme')
                                        <td class="cell-closed"></td>
                                    @elseif($indispo)
                                        <td class="cell-absence" title="Absence"></td>
                                    @elseif(!empty($rdvsHeure))
                                        <td class="hour-cell">
                                            @foreach($rdvsHeure as $rdv)
                                                <a href="{{ route('admin.rendez-vous.show', $rdv) }}"
                                                   class="cell-rdv {{ $rdv->statut === 'confirme' ? 'confirmed' : ($rdv->statut === 'termine' ? 'done' : 'pending') }}"
                                                   title="{{ $rdv->client->fullName() }} | {{ $rdv->date_debut->format('H:i') }}–{{ $rdv->date_fin->format('H:i') }}">
                                                    <span>{{ $rdv->date_debut->format('H:i') }}</span>
                                                    <span>{{ Str::limit($rdv->client->fullName(), 6) }}</span>
                                                </a>
                                            @endforeach
                                        </td>
                                    @elseif($dispo)
                                        <td class="cell-available" title="Available"></td>
                                    @else
                                        <td class="cell-empty"></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($rdvsEsthe->isNotEmpty())
                <div class="rdv-list">
                    <div class="rdv-list-title">Appointments this week</div>
                    @foreach($rdvsEsthe->sortBy('date_debut') as $rdv)
                        <div class="rdv-row {{ $rdv->date_debut->isToday() ? 'today-rdv' : '' }}">
                            <div class="rdv-time">
                                <div>{{ $rdv->date_debut->isoFormat('ddd D MMM') }}</div>
                                <div class="rdv-time-day">{{ $rdv->date_debut->format('H:i') }} → {{ $rdv->date_fin->format('H:i') }}</div>
                            </div>
                            <a href="{{ route('admin.clients.show', $rdv->client) }}" class="rdv-client">{{ $rdv->client->fullName() }}</a>
                            <div class="rdv-services">
                                @foreach($rdv->services as $s)<span class="rdv-service-tag">{{ $s->nom }}</span>@endforeach
                            </div>
                            <div class="rdv-duration">{{ $rdv->duree_totale }} min</div>
                            <span class="rdv-status {{ $rdv->statut }}">
                                {{ ['en_attente'=>'Pending','confirme'=>'Confirmed','termine'=>'Done','annule'=>'Cancelled','refuse'=>'Refused','reporte'=>'Rescheduled'][$rdv->statut] ?? $rdv->statut }}
                            </span>
                            <a href="{{ route('admin.rendez-vous.show', $rdv) }}" class="rdv-detail-link">View →</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div class="esthe-block">
            <div class="cal-empty">
                <i class="fa-solid fa-calendar-xmark" style="font-size:36px;color:#e9d8fd;margin-bottom:12px;display:block;"></i>
                No active experts found.
            </div>
        </div>
    @endforelse
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
