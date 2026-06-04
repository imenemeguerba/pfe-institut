<x-app-layout>
<x-slot name="header">Promo Code Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
.show-wrap { margin: -24px; padding: 24px; background: #f8f5ff; }
.show-inner { max-width: 860px; margin: 0 auto; }

/* HEADER CARD */
.code-header {
    background: white; border-radius: 16px; border: 1px solid #ede9fe;
    padding: 22px 24px; margin-bottom: 16px;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;
}
.code-header-left { display: flex; align-items: center; gap: 16px; }
.code-icon { width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, #b480ff, #d3aa95); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; flex-shrink: 0; }
.code-badge { font-family: monospace; font-size: 22px; font-weight: 800; color: #7c3aed; letter-spacing: 2px; }
.code-desc { font-size: 12px; color: #9ca3af; margin-top: 3px; }
.code-status { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; display: inline-block; margin-top: 4px; }
.code-status.utilisable { background: rgba(16,185,129,0.1); color: #059669; }
.code-status.expire     { background: rgba(249,115,22,0.1); color: #f97316; }
.code-status.inactif    { background: rgba(107,114,128,0.1); color: #6b7280; }
.code-header-right { display: flex; gap: 8px; flex-wrap: wrap; }
.abtn { padding: 8px 16px; border-radius: 30px; font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit; display: inline-flex; align-items: center; gap: 5px; text-decoration: none; transition: opacity 0.2s; }
.abtn:hover { opacity: 0.85; }
.abtn.back { background: #fdf9ff; color: #b480ff; border: 1.5px solid #ede9fe; }
.abtn.edit { background: linear-gradient(to right, #b480ff, #d3aa95); color: white; border: none; }

/* INFO GRID */
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px; }
.card { background: white; border-radius: 14px; border: 1px solid #ede9fe; padding: 20px; }
.card-title { font-size: 13px; font-weight: 700; color: #1a1a2e; margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
.card-title i { color: #b480ff; }

/* Info items */
.fi { margin-bottom: 14px; }
.fi:last-child { margin-bottom: 0; }
.fi-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #9ca3af; margin-bottom: 4px; }
.fi-value { font-size: 13px; font-weight: 600; color: #1a1a2e; }
.fi-value.big { font-size: 20px; font-weight: 800; color: #b480ff; }
.applies-tag { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; background: #f5f0ff; color: #7c3aed; display: inline-block; }

/* USAGE LIST */
.usage-card { background: white; border-radius: 14px; border: 1px solid #ede9fe; margin-bottom: 14px; overflow: hidden; }
.usage-head { padding: 16px 20px; border-bottom: 1px solid #ede9fe; display: flex; align-items: center; justify-content: space-between; }
.usage-head h3 { font-size: 13px; font-weight: 700; color: #1a1a2e; display: flex; align-items: center; gap: 8px; }
.usage-head h3 i { color: #b480ff; }
.usage-count { font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; background: rgba(180,128,255,0.1); color: #b480ff; }
.usage-item { display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-bottom: 1px solid #faf8ff; transition: background 0.15s; }
.usage-item:last-child { border-bottom: none; }
.usage-item:hover { background: #fdf9ff; }
.usage-av { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #b480ff, #d3aa95); display: flex; align-items: center; justify-content: center; color: white; font-size: 11px; font-weight: 700; flex-shrink: 0; }
.usage-name { font-size: 13px; font-weight: 600; color: #1a1a2e; }
.usage-sub  { font-size: 11px; color: #9ca3af; }
.usage-empty { padding: 24px 20px; font-size: 13px; color: #d1d5db; font-style: italic; }

@media (max-width: 768px) { .info-grid { grid-template-columns: 1fr; } }
</style>

<div class="show-wrap">
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
<div class="show-inner">

    {{-- HEADER --}}
    <div class="code-header">
        <div class="code-header-left">
            <div class="code-icon"><i class="fa-solid fa-tag"></i></div>
            <div>
                <div class="code-badge">{{ $codePromo->code }}</div>
                @if($codePromo->description)
                    <div class="code-desc">{{ $codePromo->description }}</div>
                @endif
                @if($codePromo->estUtilisable())
                    <span class="code-status utilisable">Active</span>
                @elseif($codePromo->date_fin->isPast())
                    <span class="code-status expire">Expired</span>
                @else
                    <span class="code-status inactif">Inactive</span>
                @endif
            </div>
        </div>
        <div class="code-header-right">
            <a href="{{ route('admin.codes-promo.index') }}" class="abtn back">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('admin.codes-promo.edit', $codePromo) }}" class="abtn edit">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
        </div>
    </div>

    {{-- INFO GRID --}}
    <div class="info-grid">
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-percent"></i> Discount Details</div>
            <div class="fi">
                <div class="fi-label">Reduction</div>
                <div class="fi-value big">
                    @if($codePromo->type_reduction === 'pourcentage')
                        -{{ $codePromo->valeur }}%
                    @else
                        -{{ number_format($codePromo->valeur, 0, ',', ' ') }} DA
                    @endif
                </div>
            </div>
            <div class="fi">
                <div class="fi-label">Type</div>
                <div class="fi-value">{{ $codePromo->type_reduction === 'pourcentage' ? 'Percentage' : 'Fixed Amount' }}</div>
            </div>
            <div class="fi">
                <div class="fi-label">Applies To</div>
                <span class="applies-tag">
                    @if($codePromo->applicable_a === 'services') Services
                    @elseif($codePromo->applicable_a === 'produits') Products
                    @else Both
                    @endif
                </span>
            </div>
        </div>

        <div class="card">
            <div class="card-title"><i class="fa-regular fa-calendar"></i> Validity & Usage</div>
            <div class="fi">
                <div class="fi-label">Start Date</div>
                <div class="fi-value">{{ $codePromo->date_debut->format('d/m/Y H:i') }}</div>
            </div>
            <div class="fi">
                <div class="fi-label">End Date</div>
                <div class="fi-value">{{ $codePromo->date_fin->format('d/m/Y H:i') }}</div>
            </div>
            <div class="fi">
                <div class="fi-label">Usage</div>
                <div class="fi-value">
                    {{ $codePromo->nombre_utilisations }}
                    @if($codePromo->limite_utilisation)
                        / {{ $codePromo->limite_utilisation }}
                    @else
                        <span style="font-size:11px;color:#9ca3af;font-weight:400;">(unlimited)</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- APPOINTMENTS --}}
    <div class="usage-card">
        <div class="usage-head">
            <h3><i class="fa-solid fa-calendar-check"></i> Appointments using this code</h3>
            <span class="usage-count">{{ $codePromo->rendezVous->count() }}</span>
        </div>
        @if($codePromo->rendezVous->isEmpty())
            <div class="usage-empty">No appointments have used this code yet.</div>
        @else
            @foreach($codePromo->rendezVous as $rdv)
                <div class="usage-item">
                    <div class="usage-av">{{ strtoupper(substr($rdv->client->prenom,0,1)) }}</div>
                    <div>
                        <div class="usage-name">{{ $rdv->client->fullName() }}</div>
                        <div class="usage-sub">{{ $rdv->date_debut->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- ORDERS --}}
    <div class="usage-card">
        <div class="usage-head">
            <h3><i class="fa-solid fa-cart-shopping"></i> Orders using this code</h3>
            <span class="usage-count">{{ $codePromo->commandes->count() }}</span>
        </div>
        @if($codePromo->commandes->isEmpty())
            <div class="usage-empty">No orders have used this code yet.</div>
        @else
            @foreach($codePromo->commandes as $cmd)
                <div class="usage-item">
                    <div class="usage-av">{{ strtoupper(substr($cmd->client->prenom,0,1)) }}</div>
                    <div>
                        <div class="usage-name">{{ $cmd->client->fullName() }}</div>
                        <div class="usage-sub">Order #{{ $cmd->numero }}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

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
