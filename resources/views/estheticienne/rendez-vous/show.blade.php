<x-app-layout>
<x-slot name="header">Appointment Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:800px; margin:0 auto; }
.card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:22px 24px; margin-bottom:16px; box-shadow:0 2px 12px rgba(180,128,255,0.05); opacity:0; animation:fadeUp 0.45s forwards; }
.card:nth-child(2){animation-delay:.05s} .card:nth-child(3){animation-delay:.1s}
.card:nth-child(4){animation-delay:.15s} .card:nth-child(5){animation-delay:.2s}
.card:nth-child(6){animation-delay:.25s} .card:nth-child(7){animation-delay:.3s}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}
.card-title { font-size:14px; font-weight:800; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
.card-title .ci { width:30px; height:30px; border-radius:9px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:13px; flex-shrink:0; }
.show-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; flex-wrap:wrap; gap:10px; opacity:0; animation:fadeUp 0.4s .01s forwards; }
.show-top h1 { font-size:18px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.show-top h1 i { color:#b480ff; }
.btn-back { font-size:12px; color:#6b7280; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 16px; border-radius:30px; border:1.5px solid #ede9fe; background:white; transition:all 0.2s; }
.btn-back:hover { border-color:#b480ff; color:#b480ff; }
.status-badge { font-size:12px; font-weight:700; padding:5px 14px; border-radius:20px; display:inline-flex; align-items:center; gap:5px; }
.status-badge.en_attente { background:rgba(234,179,8,0.1); color:#ca8a04; }
.status-badge.confirme   { background:rgba(16,185,129,0.1); color:#059669; }
.status-badge.refuse     { background:rgba(239,68,68,0.1);  color:#ef4444; }
.status-badge.annule     { background:rgba(107,114,128,0.1);color:#6b7280; }
.status-badge.termine    { background:rgba(37,99,235,0.1);  color:#2563eb; }
.status-badge.reporte    { background:rgba(249,115,22,0.1); color:#f97316; }
.client-row { display:flex; align-items:center; gap:14px; padding:14px 16px; background:#fdf9ff; border-radius:12px; border:1px solid #ede9fe; margin-bottom:18px; }
.client-av  { width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:16px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.client-name { font-size:14px; font-weight:700; color:#1a1a2e; }
.client-info { font-size:12px; color:#9ca3af; margin-top:2px; }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.fi-box { background:#fdf9ff; border-radius:12px; padding:14px 16px; border:1px solid #ede9fe; }
.fi-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#c4b5fd; margin-bottom:6px; }
.fi-value { font-size:14px; font-weight:700; color:#1a1a2e; }
.fi-sub   { font-size:11px; color:#9ca3af; margin-top:3px; display:flex; align-items:center; gap:4px; }
.fi-sub i { font-size:9px; color:#b480ff; }
.service-row { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; background:#fdf9ff; border-radius:10px; border:1px solid #ede9fe; margin-bottom:8px; transition:border-color 0.2s; }
.service-row:last-child { margin-bottom:0; }
.service-row:hover { border-color:#c4b5fd; }
.service-name  { font-size:13px; font-weight:600; color:#374151; }
.service-dur   { font-size:11px; color:#9ca3af; margin-top:2px; display:flex; align-items:center; gap:3px; }
.service-dur i { font-size:9px; color:#b480ff; }
.service-price { font-size:14px; font-weight:800; color:#b480ff; }
.total-row { display:flex; justify-content:space-between; align-items:center; padding-top:14px; margin-top:12px; border-top:1.5px solid #ede9fe; }
.total-label  { font-size:14px; font-weight:800; color:#1a1a2e; }
.total-amount { font-size:22px; font-weight:900; color:#b480ff; }
.promo-note   { display:flex; align-items:center; gap:5px; font-size:11px; color:#059669; margin-top:6px; justify-content:flex-end; }
.note-box  { background:#fdf9ff; border-radius:10px; padding:14px 16px; font-size:13px; color:#374151; border-left:3px solid rgba(180,128,255,0.4); line-height:1.7; }
.motif-box { border-radius:12px; padding:14px 16px; font-size:13px; line-height:1.7; }
.motif-box.red { background:rgba(239,68,68,0.04); border:1px solid rgba(239,68,68,0.2); border-left:3px solid #ef4444; color:#991b1b; }
.action-panel { border-radius:14px; padding:18px; }
.action-panel.accept { background:rgba(16,185,129,0.05); border:1.5px solid rgba(16,185,129,0.2); }
.action-panel.refuse { background:rgba(239,68,68,0.04);  border:1.5px solid rgba(239,68,68,0.2); }
.action-title { font-size:12px; font-weight:800; margin-bottom:12px; display:flex; align-items:center; gap:6px; }
.action-title.green { color:#059669; }
.action-title.red   { color:#ef4444; }
.action-ta { width:100%; padding:10px 12px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:12px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; resize:none; margin-bottom:10px; transition:border-color 0.2s; }
.action-ta:focus { border-color:#b480ff; background:white; }
.btn-action { width:100%; padding:11px; border-radius:30px; font-size:13px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center; gap:6px; transition:all 0.2s; }
.btn-action.green { background:rgba(16,185,129,0.12); color:#059669; }
.btn-action.green:hover { background:rgba(16,185,129,0.22); transform:translateY(-1px); }
.btn-action.red   { background:rgba(239,68,68,0.1);   color:#ef4444; }
.btn-action.red:hover   { background:rgba(239,68,68,0.2);   transform:translateY(-1px); }
.btn-terminer { padding:13px 30px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-terminer:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(180,128,255,0.35); }
@media(max-width:640px){ .info-grid{ grid-template-columns:1fr; } }
</style>

<div class="show-wrap">
<div class="show-inner">

    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    <div class="show-top">
        <h1><i class="fa-solid fa-calendar-check"></i> Appointment #{{ $rendezVous->id }}</h1>
        <a href="{{ route('estheticienne.rendez-vous.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div style="background:#fff5f5;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:12px;font-size:13px;margin-bottom:16px;">
            @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
        </div>
    @endif

    {{-- CLIENT + DETAILS --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
            <div class="card-title" style="margin-bottom:0;">
                <div class="ci"><i class="fa-solid fa-calendar-check"></i></div>
                Appointment Details
            </div>
            @php
                $sIcons  = ['en_attente'=>'fa-hourglass-half','confirme'=>'fa-check','refuse'=>'fa-xmark','annule'=>'fa-ban','termine'=>'fa-flag-checkered','reporte'=>'fa-rotate'];
                $sLabels = ['en_attente'=>'Pending','confirme'=>'Confirmed','refuse'=>'Refused','annule'=>'Cancelled','termine'=>'Done','reporte'=>'Rescheduled'];
            @endphp
            <span class="status-badge {{ $rendezVous->statut }}">
                <i class="fa-solid {{ $sIcons[$rendezVous->statut] ?? 'fa-circle' }}" style="font-size:9px;"></i>
                {{ $sLabels[$rendezVous->statut] ?? $rendezVous->statut }}
            </span>
        </div>
        <div class="client-row">
            <div class="client-av">{{ strtoupper(substr($rendezVous->client->prenom,0,1)) }}</div>
            <div>
                <div class="client-name">{{ $rendezVous->client->fullName() }}</div>
                <div class="client-info">{{ $rendezVous->client->email }}</div>
                @if($rendezVous->client->telephone)
                    <div class="client-info">{{ $rendezVous->client->telephone }}</div>
                @endif
            </div>
        </div>
        <div class="info-grid">
            <div class="fi-box">
                <div class="fi-label">Date</div>
                <div class="fi-value">{{ $rendezVous->date_debut->isoFormat('dddd D MMMM YYYY') }}</div>
            </div>
            <div class="fi-box">
                <div class="fi-label">Time & Duration</div>
                <div class="fi-value">{{ $rendezVous->date_debut->format('H:i') }} → {{ $rendezVous->date_fin->format('H:i') }}</div>
                <div class="fi-sub"><i class="fa-regular fa-clock"></i> {{ $rendezVous->duree_totale }} minutes</div>
            </div>
        </div>
    </div>

    {{-- SERVICES --}}
    <div class="card">
        <div class="card-title">
            <div class="ci"><i class="fa-solid fa-spa"></i></div>
            Services Requested
        </div>
        @foreach($rendezVous->services as $service)
            <div class="service-row">
                <div>
                    <div class="service-name">{{ $service->nom }}</div>
                    <div class="service-dur"><i class="fa-regular fa-clock"></i> {{ $service->pivot->duree_au_moment }} min</div>
                </div>
                <div class="service-price">{{ number_format($service->pivot->prix_au_moment,0,',',' ') }} DA</div>
            </div>
        @endforeach
        <div class="total-row">
            <div class="total-label">Total</div>
            <div class="total-amount">{{ number_format($rendezVous->prix_final,0,',',' ') }} DA</div>
        </div>
        @if($rendezVous->prix_final != $rendezVous->prix_original)
            <div class="promo-note">
                <i class="fa-solid fa-tag" style="font-size:10px;"></i>
                Promo applied — Original: {{ number_format($rendezVous->prix_original,0,',',' ') }} DA
            </div>
        @endif
    </div>

    {{-- CLIENT NOTE --}}
    @if($rendezVous->notes)
        <div class="card">
            <div class="card-title">
                <div class="ci"><i class="fa-solid fa-note-sticky"></i></div>
                Client Note
            </div>
            <div class="note-box">{{ $rendezVous->notes }}</div>
        </div>
    @endif

    {{-- MOTIF REFUS --}}
    @if($rendezVous->statut === 'refuse' && $rendezVous->motif_refus)
        <div class="card" style="border-color:rgba(239,68,68,0.2);">
            <div class="card-title">
                <div class="ci" style="background:rgba(239,68,68,0.1);color:#ef4444;"><i class="fa-solid fa-circle-xmark"></i></div>
                Reason for Refusal
            </div>
            <div class="motif-box red">{{ $rendezVous->motif_refus }}</div>
        </div>
    @endif

    {{-- ACTIONS : EN ATTENTE --}}
    @if($rendezVous->statut === 'en_attente')
        <div class="card">
            <div class="card-title">
                <div class="ci"><i class="fa-solid fa-gavel"></i></div>
                Process this Appointment
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="action-panel accept">
                    <div class="action-title green"><i class="fa-solid fa-check"></i> Accept</div>
                    <form action="{{ route('estheticienne.rendez-vous.accepter', $rendezVous) }}" method="POST" id="formAccept">
                        @csrf @method('PATCH')
                        <button type="button" class="btn-action green"
                            onclick="glowConfirm('Confirm this appointment?','The client will be notified by email.','Yes, confirm','fa-check','purple',function(){ document.getElementById('formAccept').submit(); })">
                            <i class="fa-solid fa-check"></i> Confirm Appointment
                        </button>
                    </form>
                </div>
                <div class="action-panel refuse">
                    <div class="action-title red"><i class="fa-solid fa-xmark"></i> Refuse</div>
                    <form action="{{ route('estheticienne.rendez-vous.refuser', $rendezVous) }}" method="POST" id="formRefuse">
                        @csrf @method('PATCH')
                        <textarea name="motif_refus" rows="3" required minlength="5" maxlength="500"
                                  class="action-ta" id="motifRefus"
                                  placeholder="Reason for refusal (required)..."></textarea>
                        <button type="button" class="btn-action red" onclick="handleRefuse()">
                            <i class="fa-solid fa-xmark"></i> Confirm Refusal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- TERMINER --}}
    @if($rendezVous->statut === 'confirme')
        <div class="card" style="border-color:rgba(37,99,235,0.2);">
            <div class="card-title">
                <div class="ci" style="background:rgba(37,99,235,0.1);color:#2563eb;"><i class="fa-solid fa-flag-checkered"></i></div>
                Close this Appointment
            </div>
            <p style="font-size:13px;color:#6b7280;margin-bottom:18px;line-height:1.7;">
                Service done? Mark it as completed so the client can leave a review on your work.
            </p>
            <form action="{{ route('estheticienne.rendez-vous.terminer', $rendezVous) }}" method="POST" id="formTerminer">
                @csrf @method('PATCH')
                {{-- ✅ date_fin stored for JS check --}}
                <span id="rdvDateFin" data-date="{{ $rendezVous->date_fin->toIso8601String() }}" style="display:none;"></span>
                <button type="button" class="btn-terminer" onclick="handleTerminer()">
                    <i class="fa-solid fa-flag-checkered"></i> Mark as Completed
                </button>
            </form>
        </div>
    @endif

</div>
</div>

<script>
// ── TOAST ──────────────────────────────────────────────────────────────────
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid ' + (type === 'error' ? 'fa-circle-xmark' : 'fa-circle-check') + '" style="font-size:14px;flex-shrink:0;"></i><span>' + msg + '</span>';
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex';
    t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function () {
        t.style.opacity = '0';
        setTimeout(function () { t.style.display = 'none'; }, 300);
    }, 4000);
}

// ── HANDLE REFUSE ──────────────────────────────────────────────────────────
function handleRefuse() {
    var m = document.getElementById('motifRefus').value.trim();
    if (!m || m.length < 5) {
        showToast('Please enter a refusal reason (min. 5 characters).', 'error');
        return;
    }
    glowConfirm(
        'Refuse this appointment?',
        'The client will be notified of the refusal.',
        'Yes, refuse',
        'fa-xmark',
        'red',
        function () { document.getElementById('formRefuse').submit(); }
    );
}

// ── HANDLE TERMINER ────────────────────────────────────────────────────────
// ✅ Une seule définition — pas d'apostrophe dans les strings JS
function handleTerminer() {
    var el = document.getElementById('rdvDateFin');
    if (el) {
        var rdvEnd = new Date(el.dataset.date);
        var now    = new Date();
        if (now < rdvEnd) {
            var diff  = rdvEnd - now;
            var hours = Math.floor(diff / 3600000);
            var mins  = Math.floor((diff % 3600000) / 60000);
            var msg   = hours > 0
                ? "This appointment ends in " + hours + "h " + mins + "min. Please wait until it is finished."
                : "This appointment ends in " + mins + " minute(s). Please wait until it is finished.";
            showToast(msg, 'error');
            return;
        }
    }
    glowConfirm(
        'Mark as completed?',
        'The client will be able to leave a review on your work.',
        'Mark as Done',
        'fa-flag-checkered',
        'purple',
        function () { document.getElementById('formTerminer').submit(); }
    );
}

// ── SESSION TOASTS ─────────────────────────────────────────────────────────
@if(session('success'))
document.addEventListener('DOMContentLoaded', function () { showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function () { showToast(@json(session('error')), 'error'); });
@endif
</script>

</x-app-layout>
