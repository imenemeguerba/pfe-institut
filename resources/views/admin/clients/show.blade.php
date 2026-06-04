<x-app-layout>
<x-slot name="header">Client Profile</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap  { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:900px; margin:0 auto; }

.hdr { background:white; border-radius:16px; border:1px solid #ede9fe; padding:18px 22px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }
.hdr-left { display:flex; align-items:center; gap:14px; }
.hdr-av { width:52px; height:52px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:20px; font-weight:800; flex-shrink:0; object-fit:cover; }
.hdr-name  { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:3px; }
.hdr-email { font-size:12px; color:#9ca3af; margin-bottom:5px; }
.badge { font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block; }
.badge.actif  { background:rgba(16,185,129,0.1); color:#059669; }
.badge.bloque { background:rgba(239,68,68,0.1); color:#ef4444; }
.hdr-motif { font-size:11px; color:#9ca3af; font-style:italic; margin-top:3px; }
.hdr-actions { display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
.abtn { padding:8px 16px; border-radius:30px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:5px; text-decoration:none; transition:opacity 0.2s; border:none; }
.abtn:hover { opacity:0.85; }
.abtn.back    { background:#fdf9ff; color:#b480ff; border:1.5px solid #ede9fe; }
.abtn.block   { background:rgba(239,68,68,0.06); color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); }
.abtn.unblock { background:rgba(16,185,129,0.08); color:#059669; border:1.5px solid rgba(16,185,129,0.2); }
.abtn.delete  { background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); }

.stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:14px; }
.stat-card  { background:white; border-radius:14px; border:1px solid #ede9fe; padding:16px 18px; text-align:center; }
.stat-icon  { font-size:20px; color:#b480ff; margin-bottom:6px; }
.stat-value { font-size:28px; font-weight:800; color:#1a1a2e; line-height:1; margin-bottom:4px; }
.stat-label { font-size:11px; color:#9ca3af; font-weight:500; }

.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
.card { background:white; border-radius:14px; border:1px solid #ede9fe; padding:18px 20px; }
.card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.card-title i { color:#b480ff; }
.fi { margin-bottom:12px; } .fi:last-child { margin-bottom:0; }
.fi-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:3px; }
.fi-value { font-size:13px; font-weight:600; color:#1a1a2e; }
.rdv-item { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #f7f5ff; }
.rdv-item:last-child { border-bottom:none; padding-bottom:0; }
.rdv-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
.rdv-dot.future { background:#b480ff; }
.rdv-dot.past   { background:#d1d5db; }
.rdv-date  { font-size:12px; font-weight:600; color:#1a1a2e; }
.rdv-esthe { font-size:11px; color:#9ca3af; margin-top:1px; }
.rdv-statut { font-size:10px; color:#9ca3af; margin-left:auto; white-space:nowrap; }
.rdv-empty { font-size:13px; color:#d1d5db; font-style:italic; }

.modal-ov { display:none; position:fixed; inset:0; background:rgba(26,10,53,0.5); z-index:200; align-items:center; justify-content:center; }
.modal-ov.open { display:flex; }
.modal-box { background:white; border-radius:20px; padding:24px; max-width:420px; width:100%; margin:16px; }
.modal-t { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.modal-warn { font-size:12px; margin-bottom:14px; padding:10px 12px; background:#fff5f5; border-radius:10px; border-left:3px solid #ef4444; color:#991b1b; }
.modal-ta { width:100%; padding:11px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; resize:none; }
.modal-ta:focus { border-color:#ef4444; }
.modal-ft { display:flex; gap:10px; justify-content:flex-end; margin-top:14px; }
.modal-cancel  { padding:9px 18px; border-radius:30px; background:white; color:#6b7280; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:inherit; }
.modal-confirm { padding:9px 18px; border-radius:30px; background:linear-gradient(to right,#ef4444,#f87171); color:white; font-size:12px; font-weight:600; border:none; cursor:pointer; font-family:inherit; }

@media (max-width:768px) { .info-grid,.stats-grid { grid-template-columns:1fr; } }
</style>

<div class="show-wrap">
<div class="show-inner">

    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HEADER --}}
    <div class="hdr">
        <div class="hdr-left">
            @if($client->photo)
                <img src="{{ asset('storage/'.$client->photo) }}" class="hdr-av" alt="">
            @else
                <div class="hdr-av">{{ strtoupper(substr($client->prenom,0,1)) }}</div>
            @endif
            <div>
                <div class="hdr-name">{{ $client->fullName() }}</div>
                <div class="hdr-email">{{ $client->email }}</div>
                <span class="badge {{ $client->statut_compte }}">
                    {{ $client->statut_compte === 'actif' ? 'Active' : 'Blocked' }}
                </span>
                @if($client->motif_statut)
                    <div class="hdr-motif">{{ $client->motif_statut }}</div>
                @endif
            </div>
        </div>
        <div class="hdr-actions">
            <a href="{{ route('admin.clients.index') }}" class="abtn back">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            @if($client->estActif())
                <button type="button" class="abtn block"
                    onclick="document.getElementById('modal-bloquer').classList.add('open')">
                    <i class="fa-solid fa-ban"></i> Block
                </button>
                {{-- Delete — glowConfirm ✅ --}}
                <form id="form-del-client" action="{{ route('admin.clients.destroy', $client) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="button" class="abtn delete"
                        onclick="glowConfirm('Delete Account','Permanently delete this account? The email will be banned.','Delete','fa-trash','#ef4444',function(){ document.getElementById('form-del-client').submit(); })">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            @endif
            @if($client->estBloque())
                {{-- Unblock — glowConfirm ✅ --}}
                <form id="form-unblock" action="{{ route('admin.clients.debloquer', $client) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="button" class="abtn unblock"
                        onclick="glowConfirm('Unblock Client','Restore access for this client?','Unblock','fa-rotate-right','green',function(){ document.getElementById('form-unblock').submit(); })">
                        <i class="fa-solid fa-rotate-right"></i> Unblock
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
            <div class="stat-value">{{ $stats['total_rdv'] }}</div>
            <div class="stat-label">Appointments</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-cart-shopping"></i></div>
            <div class="stat-value">{{ $stats['total_commandes'] }}</div>
            <div class="stat-label">Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
            <div class="stat-value">{{ $stats['total_avis'] }}</div>
            <div class="stat-label">Reviews</div>
        </div>
    </div>

    {{-- INFO GRID --}}
    <div class="info-grid">
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-user"></i> Personal Information</div>
            <div class="fi"><div class="fi-label">Last Name</div><div class="fi-value">{{ $client->nom }}</div></div>
            <div class="fi"><div class="fi-label">First Name</div><div class="fi-value">{{ $client->prenom }}</div></div>
            <div class="fi"><div class="fi-label">Email</div><div class="fi-value">{{ $client->email }}</div></div>
            <div class="fi"><div class="fi-label">Phone</div><div class="fi-value">{{ $client->telephone ?? '—' }}</div></div>
            <div class="fi">
                <div class="fi-label">Date of Birth</div>
                <div class="fi-value">
                    @if($client->date_naissance)
                        {{ $client->date_naissance->format('d/m/Y') }} ({{ $client->date_naissance->age }} yrs)
                    @else —
                    @endif
                </div>
            </div>
            <div class="fi"><div class="fi-label">Registered</div><div class="fi-value">{{ $client->created_at->format('d/m/Y H:i') }}</div></div>
        </div>
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-calendar-check"></i> Upcoming Appointments ({{ $rdvFuturs->count() }})</div>
            @if($rdvFuturs->isEmpty())
                <div class="rdv-empty">No upcoming appointments.</div>
            @else
                @foreach($rdvFuturs as $rdv)
                    <div class="rdv-item">
                        <div class="rdv-dot future"></div>
                        <div>
                            <div class="rdv-date">{{ $rdv->date_debut->format('d/m/Y H:i') }}</div>
                            <div class="rdv-esthe">with {{ $rdv->estheticienne->fullName() }}</div>
                        </div>
                        <div class="rdv-statut">{{ $rdv->libelleStatut() }}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    {{-- PAST RDV --}}
    <div class="card" style="margin-bottom:14px;">
        <div class="card-title"><i class="fa-solid fa-clock-rotate-left"></i> Recent Appointments</div>
        @if($rdvPasses->isEmpty())
            <div class="rdv-empty">No past appointments.</div>
        @else
            @foreach($rdvPasses as $rdv)
                <div class="rdv-item">
                    <div class="rdv-dot past"></div>
                    <div>
                        <div class="rdv-date">{{ $rdv->date_debut->format('d/m/Y') }}</div>
                        <div class="rdv-esthe">with {{ $rdv->estheticienne->fullName() }}</div>
                    </div>
                    <div class="rdv-statut">{{ $rdv->libelleStatut() }}</div>
                </div>
            @endforeach
        @endif
    </div>

</div>
</div>

{{-- MODAL BLOCK --}}
@if($client->estActif())
    <div class="modal-ov" id="modal-bloquer">
        <div class="modal-box">
            <div class="modal-t">Block Client</div>
            <div class="modal-warn">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Blocking is permanent. The email will be banned — the client cannot re-register.
            </div>
            <form action="{{ route('admin.clients.bloquer', $client) }}" method="POST">
                @csrf @method('PATCH')
                <textarea name="motif" rows="3" required minlength="5" maxlength="500"
                    class="modal-ta" placeholder="e.g. Inappropriate behavior..."></textarea>
                <div class="modal-ft">
                    <button type="button" class="modal-cancel" onclick="document.getElementById('modal-bloquer').classList.remove('open')">Cancel</button>
                    <button type="submit" class="modal-confirm">Confirm Block</button>
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
