<x-app-layout>
<x-slot name="header">Deletion Request</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap  { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:760px; margin:0 auto; }

.show-top   { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.show-top h1 { font-size:17px; font-weight:800; color:#1a1a2e; }
.btn-back   { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }

.card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:20px 24px; margin-bottom:14px; }
.card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.card-title i { color:#b480ff; }

.status-card { border-radius:16px; padding:18px 22px; margin-bottom:14px; border:1px solid; }
.status-card.pending  { background:rgba(249,115,22,0.04); border-color:rgba(249,115,22,0.2); }
.status-card.accepted { background:rgba(16,185,129,0.04); border-color:rgba(16,185,129,0.2); }
.status-card.refused  { background:rgba(239,68,68,0.04);  border-color:rgba(239,68,68,0.2); }
.status-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; }
.status-value { font-size:18px; font-weight:800; }
.status-value.pending  { color:#f97316; }
.status-value.accepted { color:#059669; }
.status-value.refused  { color:#ef4444; }
.status-date  { font-size:12px; color:#9ca3af; margin-top:4px; }
.status-motif { font-size:13px; color:#374151; margin-top:8px; padding:10px 14px; background:rgba(239,68,68,0.06); border-radius:10px; }

.fi { margin-bottom:12px; } .fi:last-child { margin-bottom:0; }
.fi-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:4px; }
.fi-value { font-size:13px; font-weight:600; color:#1a1a2e; }
.motif-box { background:#fdf9ff; border-radius:10px; padding:12px 14px; font-size:13px; color:#374151; line-height:1.6; border-left:3px solid rgba(180,128,255,0.3); margin-top:8px; }

.rdv-ok   { background:rgba(16,185,129,0.06); border:1px solid rgba(16,185,129,0.2); border-left:3px solid #10b981; border-radius:12px; padding:14px 16px; font-size:13px; color:#059669; font-weight:600; }
.rdv-warn { background:rgba(239,68,68,0.04); border:1px solid rgba(239,68,68,0.2); border-left:3px solid #ef4444; border-radius:12px; padding:14px 16px; margin-bottom:12px; font-size:13px; color:#ef4444; font-weight:600; }
.rdv-item { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #f0ebff; font-size:12px; color:#374151; }
.rdv-item:last-child { border-bottom:none; }
.rdv-item strong { color:#1a1a2e; }

.decision-actions { display:flex; gap:10px; flex-wrap:wrap; }
.btn-accept { padding:11px 24px; border-radius:30px; background:rgba(16,185,129,0.1); color:#059669; font-size:13px; font-weight:700; border:1.5px solid rgba(16,185,129,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
.btn-accept:hover { background:rgba(16,185,129,0.2); }
.btn-accept:disabled { background:#f3f4f6; color:#9ca3af; border-color:#e5e7eb; cursor:not-allowed; }
.btn-refuse { padding:11px 24px; border-radius:30px; background:rgba(239,68,68,0.06); color:#ef4444; font-size:13px; font-weight:700; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
.btn-refuse:hover { background:rgba(239,68,68,0.12); }

.modal-ov { display:none; position:fixed; inset:0; background:rgba(26,10,53,0.5); z-index:200; align-items:center; justify-content:center; }
.modal-ov.open { display:flex; }
.modal-box { background:white; border-radius:20px; padding:24px; max-width:420px; width:100%; margin:16px; }
.modal-t { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.modal-s { font-size:12px; color:#9ca3af; margin-bottom:14px; }
.modal-ta { width:100%; padding:11px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; resize:none; }
.modal-ta:focus { border-color:#ef4444; }
.modal-ft { display:flex; gap:10px; justify-content:flex-end; margin-top:14px; }
.modal-cancel  { padding:9px 18px; border-radius:30px; background:white; color:#6b7280; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:inherit; }
.modal-confirm { padding:9px 18px; border-radius:30px; background:linear-gradient(to right,#ef4444,#f87171); color:white; font-size:12px; font-weight:600; border:none; cursor:pointer; font-family:inherit; }
</style>

<div class="show-wrap">
<div class="show-inner">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    <div class="show-top">
        <h1>Deletion Request — {{ $demande->user->fullName() }}</h1>
        <a href="{{ route('admin.demandes-suppression.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- STATUS --}}
    @php
        $sc = $demande->statut === 'en_attente' ? 'pending' : ($demande->statut === 'acceptee' ? 'accepted' : 'refused');
    @endphp
    <div class="status-card {{ $sc }}">
        <div class="status-label">Request Status</div>
        <div class="status-value {{ $sc }}">
            @if($demande->statut === 'en_attente') <i class="fa-solid fa-clock"></i> Pending
            @elseif($demande->statut === 'acceptee') <i class="fa-solid fa-check"></i> Accepted
            @else <i class="fa-solid fa-xmark"></i> Refused
            @endif
        </div>
        @if($demande->date_traitement)
            <div class="status-date">Processed on {{ $demande->date_traitement->format('d/m/Y at H:i') }}</div>
        @endif
        @if($demande->motif_refus)
            <div class="status-motif"><strong>Reason:</strong> {{ $demande->motif_refus }}</div>
        @endif
    </div>

    {{-- USER INFO --}}
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-user"></i> User Information</div>
        <div class="fi"><div class="fi-label">Full Name</div><div class="fi-value">{{ $demande->user->fullName() }}</div></div>
        <div class="fi"><div class="fi-label">Email</div><div class="fi-value">{{ $demande->user->email }}</div></div>
        <div class="fi"><div class="fi-label">Phone</div><div class="fi-value">{{ $demande->user->telephone ?? '—' }}</div></div>
        <div class="fi"><div class="fi-label">Role</div><div class="fi-value">{{ $demande->user->isClient() ? 'Client' : 'Expert' }}</div></div>
        <div class="fi"><div class="fi-label">Request submitted</div><div class="fi-value">{{ $demande->created_at->format('d/m/Y at H:i') }}</div></div>
        @if($demande->motif_demande)
            <div class="fi">
                <div class="fi-label">Reason given by user</div>
                <div class="motif-box">{{ $demande->motif_demande }}</div>
            </div>
        @endif
    </div>

    {{-- RDV CHECK --}}
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-calendar-check"></i> Upcoming Appointments Check</div>
        @if($rdvFuturs->isEmpty())
            <div class="rdv-ok">
                <i class="fa-solid fa-circle-check"></i> No upcoming appointments. Deletion is possible.
            </div>
        @else
            <div class="rdv-warn">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $rdvFuturs->count() }} upcoming appointment(s) — Deletion is not possible. Please refuse this request.
            </div>
            @foreach($rdvFuturs as $rdv)
                <div class="rdv-item">
                    <i class="fa-solid fa-calendar" style="color:#b480ff;font-size:12px;flex-shrink:0;"></i>
                    <div>
                        <strong>{{ $rdv->date_debut->format('d/m/Y at H:i') }}</strong>
                        @if($demande->user->isClient())
                            — with {{ $rdv->estheticienne->fullName() }}
                        @else
                            — for {{ $rdv->client->fullName() }}
                        @endif
                        <span style="font-size:11px;color:#9ca3af;"> ({{ $rdv->libelleStatut() }})</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- DECISION --}}
    @if($demande->estEnAttente())
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-gavel"></i> Decision</div>
            <div class="decision-actions">
                {{-- Accept — glowConfirm ✅ --}}
                <form id="form-accept-del" action="{{ route('admin.demandes-suppression.accepter', $demande) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="button" class="btn-accept" {{ $rdvFuturs->isNotEmpty() ? 'disabled' : '' }}
                        onclick="glowConfirm('Accept &amp; Delete','This will permanently delete the account. This action cannot be undone.','Delete Account','fa-check','green',function(){ document.getElementById(\'form-accept-del\').submit(); })">
                        <i class="fa-solid fa-check"></i> Accept &amp; Delete Account
                    </button>
                </form>
                {{-- Refuse — modal ✅ --}}
                <button type="button" class="btn-refuse" onclick="document.getElementById('modal-refuser').classList.add('open')">
                    <i class="fa-solid fa-xmark"></i> Refuse
                </button>
            </div>
        </div>
    @endif

</div>
</div>

{{-- MODAL REFUSE --}}
@if($demande->estEnAttente())
    <div class="modal-ov" id="modal-refuser">
        <div class="modal-box">
            <div class="modal-t">Refuse Request</div>
            <div class="modal-s">Please provide a reason for refusing this deletion request.</div>
            <form action="{{ route('admin.demandes-suppression.refuser', $demande) }}" method="POST">
                @csrf @method('PATCH')
                <textarea name="motif_refus" rows="3" required minlength="10" maxlength="500"
                    class="modal-ta"
                    placeholder="e.g. You have upcoming appointments. Please cancel them before submitting a new request."></textarea>
                <div class="modal-ft">
                    <button type="button" class="modal-cancel" onclick="document.getElementById('modal-refuser').classList.remove('open')">Cancel</button>
                    <button type="submit" class="modal-confirm">Confirm Refusal</button>
                </div>
            </form>
        </div>
    </div>
@endif

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
