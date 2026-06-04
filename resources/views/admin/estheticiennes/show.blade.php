<x-app-layout>
<x-slot name="header">Expert Profile</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:1060px; margin:0 auto; }

/* HEADER */
.hdr { background:white; border-radius:16px; border:1px solid #ede9fe; padding:18px 22px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }
.hdr-left { display:flex; align-items:center; gap:14px; }
.hdr-av { width:52px; height:52px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:20px; font-weight:800; flex-shrink:0; object-fit:cover; }
.hdr-name  { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:3px; }
.hdr-email { font-size:12px; color:#9ca3af; margin-bottom:5px; }
.badge { font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block; }
.badge.actif                 { background:rgba(16,185,129,0.1); color:#059669; }
.badge.en_attente_validation { background:rgba(249,115,22,0.1); color:#f97316; }
.badge.desactive             { background:rgba(107,114,128,0.1); color:#6b7280; }
.hdr-motif { font-size:11px; color:#9ca3af; font-style:italic; margin-top:3px; }
.hdr-actions { display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
.abtn { padding:8px 16px; border-radius:30px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:5px; text-decoration:none; border:none; transition:opacity 0.2s; }
.abtn:hover { opacity:0.85; }
.abtn.back    { background:#fdf9ff; color:#b480ff; border:1.5px solid #ede9fe; }
.abtn.accept  { background:rgba(16,185,129,0.1); color:#059669; border:1.5px solid rgba(16,185,129,0.2); }
.abtn.refuse  { background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); }
.abtn.disable { background:rgba(249,115,22,0.08); color:#f97316; border:1.5px solid rgba(249,115,22,0.2); }
.abtn.enable  { background:rgba(16,185,129,0.08); color:#059669; border:1.5px solid rgba(16,185,129,0.2); }
.abtn.delete  { background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); }

/* INFO GRID */
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
.card { background:white; border-radius:14px; border:1px solid #ede9fe; padding:18px 20px; }
.card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.card-title i { color:#b480ff; }
.fi { margin-bottom:12px; } .fi:last-child { margin-bottom:0; }
.fi-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:3px; }
.fi-value { font-size:13px; font-weight:600; color:#1a1a2e; }
.spec-box { background:#fdf9ff; border-radius:10px; padding:10px 12px; font-size:13px; color:#374151; line-height:1.6; border:1px solid #ede9fe; }

/* SERVICES */
.srv-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin:12px 0 14px; }
.srv-item { display:flex; align-items:center; gap:8px; padding:9px 12px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; cursor:pointer; transition:border-color 0.2s; }
.srv-item:hover { border-color:#b480ff; }
.srv-item input { width:15px; height:15px; accent-color:#b480ff; cursor:pointer; flex-shrink:0; }
.srv-name { font-size:12px; font-weight:500; color:#374151; }
.srv-cat  { font-size:10px; color:#9ca3af; }
.btn-save { padding:9px 22px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:700; border:none; cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:6px; float:right; }

/* PLANNING */
.plan-card { background:white; border-radius:14px; border:1px solid #ede9fe; margin-bottom:14px; overflow:hidden; }
.plan-legend { display:flex; gap:20px; padding:10px 20px; background:white; border-bottom:1px solid #ede9fe; flex-wrap:wrap; }
.leg { display:flex; align-items:center; gap:6px; font-size:11px; color:#6b7280; }
.leg-dot { width:14px; height:14px; border-radius:4px; flex-shrink:0; }
.leg-dot.avail  { background:#34d399; }
.leg-dot.empty  { background:white; border:1px solid #d1d5db; }
.leg-dot.closed { background-image:repeating-linear-gradient(45deg,#f3f4f6,#f3f4f6 3px,#d1d5db 3px,#d1d5db 6px); }
.plan-table { width:100%; border-collapse:collapse; min-width:750px; }
.plan-table thead th { padding:10px 4px; text-align:center; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; background:#faf8ff; border-right:1px solid #f0ebff; border-bottom:1px solid #ede9fe; }
.plan-table thead th.th-day { text-align:left; padding-left:16px; min-width:120px; border-right:1px solid #ede9fe; }
.plan-table thead th:last-child { border-right:none; }
.plan-table tbody tr { border-bottom:1px solid #f0ebff; }
.plan-table tbody tr:last-child { border-bottom:none; }
.plan-table td.td-day { padding:10px 16px; background:#faf8ff; border-right:1px solid #ede9fe; min-width:120px; vertical-align:middle; }
.plan-table td.td-day .day-name { font-size:13px; font-weight:700; color:#374151; }
.plan-table td.td-day .day-name.closed-day { color:#d1d5db; text-decoration:line-through; }
.plan-table td.td-day .day-date { font-size:11px; color:#9ca3af; margin-top:2px; }
.plan-table td.td-day .day-date.today-d { color:#b480ff; font-weight:700; }
.plan-table td.td-hour { height:52px; border-right:1px solid #f0ebff; padding:0; }
.plan-table td.td-hour:last-child { border-right:none; }
.plan-table td.td-hour.h-avail  { background:#bbf7d0; }
.plan-table td.td-hour.h-closed { background-image:repeating-linear-gradient(45deg,#f9f8fc,#f9f8fc 3px,#ede9fe 3px,#ede9fe 6px); }
.plan-table td.td-hour.h-empty  { background:white; }

/* INDISPOS */
.indispo-item { padding:12px 14px; border-radius:12px; background:#fdf9ff; border:1px solid #ede9fe; border-left:3px solid #f97316; margin-bottom:8px; }
.ib { font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px; margin-bottom:4px; display:inline-block; }
.ib.conge     { background:rgba(59,130,246,0.1); color:#2563eb; }
.ib.maladie   { background:rgba(239,68,68,0.1); color:#ef4444; }
.ib.formation { background:rgba(124,58,237,0.1); color:#7c3aed; }
.ib.autre     { background:rgba(107,114,128,0.1); color:#6b7280; }
.id-dates { font-size:12px; font-weight:600; color:#1a1a2e; }
.id-motif { font-size:11px; color:#9ca3af; margin-top:2px; }

/* MODAL */
.modal-ov { display:none; position:fixed; inset:0; background:rgba(26,10,53,0.5); z-index:200; align-items:center; justify-content:center; }
.modal-ov.open { display:flex; }
.modal-box { background:white; border-radius:20px; padding:24px; max-width:400px; width:100%; margin:16px; }
.modal-t { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.modal-s { font-size:12px; color:#9ca3af; margin-bottom:14px; }
.modal-ta { width:100%; padding:11px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; resize:none; }
.modal-ta:focus { border-color:#b480ff; }
.modal-ft { display:flex; gap:10px; justify-content:flex-end; margin-top:14px; }
.modal-cancel  { padding:9px 18px; border-radius:30px; background:white; color:#6b7280; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:inherit; }
.modal-confirm { padding:9px 18px; border-radius:30px; background:linear-gradient(to right,#f97316,#fb923c); color:white; font-size:12px; font-weight:600; border:none; cursor:pointer; font-family:inherit; }

@media (max-width:768px) { .info-grid { grid-template-columns:1fr; } .srv-grid { grid-template-columns:1fr; } }
</style>

@php
    $jours   = [1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',7=>'Sunday'];
    $joursEn = [1=>'lundi',2=>'mardi',3=>'mercredi',4=>'jeudi',5=>'vendredi',6=>'samedi',7=>'dimanche'];
    $heures  = range(8, 19);
    $lundi   = now()->startOfWeek();
    if (!function_exists('estheShowPlage')) {
        function estheShowPlage($h, $plage) {
            if (empty($plage)) return false;
            $p = explode('-', $plage);
            if (count($p) !== 2) return false;
            $d = (int)substr(trim($p[0]),0,2)*60+(int)substr(trim($p[0]),3,2);
            $f = (int)substr(trim($p[1]),0,2)*60+(int)substr(trim($p[1]),3,2);
            return $h*60 >= $d && ($h+1)*60 <= $f;
        }
        function estheShowOuvert($h, $key, $horaires) {
            $hor = $horaires[$key] ?? null;
            if (!$hor || !($hor['ouvert'] ?? false)) return false;
            return (!empty($hor['matin']) && estheShowPlage($h,$hor['matin'])) ||
                   (!empty($hor['apres_midi']) && estheShowPlage($h,$hor['apres_midi']));
        }
        function estheShowDispo($h, $dispos) {
            foreach ($dispos as $d) {
                $dh = (int)substr($d->heure_debut,0,2)*60+(int)substr($d->heure_debut,3,2);
                $fh = (int)substr($d->heure_fin,0,2)*60+(int)substr($d->heure_fin,3,2);
                if ($h*60 >= $dh && ($h+1)*60 <= $fh) return true;
            }
            return false;
        }
    }
    $institut         = \App\Models\Institut::instance();
    $horairesInstitut = $institut->horaires_ouverture ?? [];
    $dispos           = $estheticienne->disponibilites()->orderBy('jour_semaine')->orderBy('heure_debut')->get()->groupBy('jour_semaine');
@endphp

<div class="show-wrap">
<div class="show-inner">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HEADER --}}
    <div class="hdr">
        <div class="hdr-left">
            @if($estheticienne->photo)
                <img src="{{ asset('storage/'.$estheticienne->photo) }}" class="hdr-av" alt="">
            @else
                <div class="hdr-av">{{ strtoupper(substr($estheticienne->prenom,0,1)) }}</div>
            @endif
            <div>
                <div class="hdr-name">{{ $estheticienne->fullName() }}</div>
                <div class="hdr-email">{{ $estheticienne->email }}</div>
                <span class="badge {{ $estheticienne->statut_compte }}">
                    {{ ['actif'=>'Active','en_attente_validation'=>'Pending','desactive'=>'Disabled'][$estheticienne->statut_compte] ?? $estheticienne->statut_compte }}
                </span>
                @if($estheticienne->motif_statut)
                    <div class="hdr-motif">{{ $estheticienne->motif_statut }}</div>
                @endif
            </div>
        </div>
        <div class="hdr-actions">
            <a href="{{ route('admin.estheticiennes.index') }}" class="abtn back">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>

            @if($estheticienne->estEnAttenteValidation())
                {{-- Accept --}}
                <form id="form-accept" action="{{ route('admin.estheticiennes.accepter', $estheticienne) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="button" class="abtn accept"
                        onclick="glowConfirm('Accept Application','Activate this expert account and send them a confirmation email?','Accept','fa-check','green',function(){ document.getElementById('form-accept').submit(); })">
                        <i class="fa-solid fa-check"></i> Accept
                    </button>
                </form>
                {{-- Refuse --}}
                <form id="form-refuse" action="{{ route('admin.estheticiennes.refuser', $estheticienne) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="button" class="abtn refuse"
                        onclick="glowConfirm('Refuse Application','Refuse and permanently reject this registration?','Refuse','fa-xmark','#ef4444',function(){ document.getElementById('form-refuse').submit(); })">
                        <i class="fa-solid fa-xmark"></i> Refuse
                    </button>
                </form>
            @endif

            @if($estheticienne->estActif())
                <button type="button" class="abtn disable" onclick="document.getElementById('modal-dis').classList.add('open')">
                    <i class="fa-solid fa-ban"></i> Disable
                </button>
            @endif

            @if($estheticienne->statut_compte === 'desactive')
                <form id="form-reactiver" action="{{ route('admin.estheticiennes.reactiver', $estheticienne) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="button" class="abtn enable"
                        onclick="glowConfirm('Reactivate Account','Reactivate this expert account?','Reactivate','fa-rotate-right','green',function(){ document.getElementById('form-reactiver').submit(); })">
                        <i class="fa-solid fa-rotate-right"></i> Reactivate
                    </button>
                </form>
            @endif

            @if(in_array($estheticienne->statut_compte, ['actif','desactive']))
                <form id="form-delete" action="{{ route('admin.estheticiennes.destroy', $estheticienne) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="button" class="abtn delete"
                        onclick="glowConfirm('Delete Account','Permanently delete this account? This action cannot be undone.','Delete','fa-trash','#ef4444',function(){ document.getElementById('form-delete').submit(); })">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- INFO --}}
    <div class="info-grid">
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-user"></i> Personal Information</div>
            <div class="fi"><div class="fi-label">Last Name</div><div class="fi-value">{{ $estheticienne->nom }}</div></div>
            <div class="fi"><div class="fi-label">First Name</div><div class="fi-value">{{ $estheticienne->prenom }}</div></div>
            <div class="fi"><div class="fi-label">Email</div><div class="fi-value">{{ $estheticienne->email }}</div></div>
            <div class="fi"><div class="fi-label">Phone</div><div class="fi-value">{{ $estheticienne->telephone ?? '—' }}</div></div>
            <div class="fi"><div class="fi-label">Registered</div><div class="fi-value">{{ $estheticienne->created_at->format('d/m/Y') }}</div></div>
        </div>
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-briefcase"></i> Professional Profile</div>
            <div class="fi"><div class="fi-label">Experience</div><div class="fi-value">{{ $estheticienne->experience }} year(s)</div></div>
            <div class="fi">
                <div class="fi-label">Specialties</div>
                <div class="spec-box">{{ $estheticienne->specialites ?? '—' }}</div>
            </div>
        </div>
    </div>

    {{-- SERVICES --}}
    @if($estheticienne->estActif())
        <div class="card" style="margin-bottom:14px;">
            <div class="card-title"><i class="fa-solid fa-spa"></i> Assigned Services</div>
            <p style="font-size:12px;color:#9ca3af;">Select the services this expert can perform:</p>
            <form action="{{ route('admin.estheticiennes.services', $estheticienne) }}" method="POST">
                @csrf @method('PATCH')
                @if($services->isEmpty())
                    <p style="font-size:13px;color:#d1d5db;margin-top:12px;">No services available. Create services first.</p>
                @else
                    <div class="srv-grid">
                        @foreach($services as $service)
                            <label class="srv-item">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                    {{ $estheticienne->servicesProposes->contains($service->id) ? 'checked' : '' }}>
                                <div>
                                    <div class="srv-name">{{ $service->nom }}</div>
                                    <div class="srv-cat">{{ $service->category->nom }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <div style="overflow:hidden;">
                        <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Save Services</button>
                    </div>
                @endif
            </form>
        </div>

        {{-- PLANNING --}}
        <div class="plan-card">
            <div class="plan-legend">
                <div class="leg"><div class="leg-dot avail"></div> Available</div>
                <div class="leg"><div class="leg-dot empty"></div> Not available</div>
                <div class="leg"><div class="leg-dot closed"></div> Institute closed</div>
            </div>
            <div style="overflow-x:auto;">
                <table class="plan-table">
                    <thead>
                        <tr>
                            <th class="th-day">DAY</th>
                            @foreach($heures as $h)<th>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}H</th>@endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jours as $num => $label)
                            @php
                                $key      = $joursEn[$num];
                                $dateJour = $lundi->copy()->addDays($num - 1);
                                $ferme    = !($horairesInstitut[$key]['ouvert'] ?? false);
                                $disJour  = $dispos[$num] ?? collect();
                                $isToday  = $dateJour->isToday();
                            @endphp
                            <tr>
                                <td class="td-day">
                                    <div class="day-name {{ $ferme ? 'closed-day' : '' }}">{{ $label }}</div>
                                    <div class="day-date {{ $isToday ? 'today-d' : '' }}">{{ $dateJour->format('d/m') }}{{ $isToday ? ' ●' : '' }}</div>
                                </td>
                                @foreach($heures as $h)
                                    @php
                                        $ouvert = estheShowOuvert($h, $key, $horairesInstitut);
                                        $dispo  = $ouvert && estheShowDispo($h, $disJour);
                                    @endphp
                                    @if(!$ouvert)
                                        <td class="td-hour h-closed"></td>
                                    @elseif($dispo)
                                        <td class="td-hour h-avail"></td>
                                    @else
                                        <td class="td-hour h-empty"></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($estheticienne->disponibilites()->count() === 0)
                <div style="padding:14px 20px;font-size:12px;color:#d1d5db;font-style:italic;">This expert has not configured their schedule yet.</div>
            @endif
        </div>

        {{-- INDISPOS --}}
        @php $indisponibilitesListe = $estheticienne->indisponibilites()->where('date_fin','>=',now())->orderBy('date_debut')->get(); @endphp
        <div class="card" style="margin-bottom:16px;">
            <div class="card-title"><i class="fa-solid fa-calendar-xmark"></i> Upcoming Absences</div>
            @if($indisponibilitesListe->isEmpty())
                <p style="font-size:13px;color:#d1d5db;">No planned absences.</p>
            @else
                @foreach($indisponibilitesListe as $indispo)
                    <div class="indispo-item">
                        <span class="ib {{ $indispo->type }}">
                            {{ ['conge'=>'Leave','maladie'=>'Sick','formation'=>'Training','autre'=>'Other'][$indispo->type] ?? $indispo->type }}
                        </span>
                        <div class="id-dates">{{ $indispo->date_debut->format('d/m/Y H:i') }} → {{ $indispo->date_fin->format('d/m/Y H:i') }}</div>
                        @if($indispo->motif)<div class="id-motif">{{ $indispo->motif }}</div>@endif
                    </div>
                @endforeach
            @endif
        </div>
    @endif

</div>
</div>

{{-- MODAL DISABLE --}}
@if($estheticienne->estActif())
<div class="modal-ov" id="modal-dis">
    <div class="modal-box">
        <div class="modal-t">Disable Account</div>
        <div class="modal-s">Please provide a reason for disabling this expert.</div>
        <form action="{{ route('admin.estheticiennes.desactiver', $estheticienne) }}" method="POST">
            @csrf @method('PATCH')
            <textarea name="motif" rows="3" required minlength="5" maxlength="500"
                class="modal-ta" placeholder="e.g. Prolonged absence..."></textarea>
            <div class="modal-ft">
                <button type="button" class="modal-cancel" onclick="document.getElementById('modal-dis').classList.remove('open')">Cancel</button>
                <button type="submit" class="modal-confirm">Confirm</button>
            </div>
        </form>
    </div>
</div>
@endif

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
