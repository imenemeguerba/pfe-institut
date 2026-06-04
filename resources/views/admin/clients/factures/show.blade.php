<x-app-layout>
<x-slot name="header">Invoice Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap  { margin:-24px; padding:24px; background:#faf8ff; }
.show-inner { max-width:680px; margin:0 auto; }

.show-top   { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.show-top h1 { font-size:17px; font-weight:800; color:#1a1a2e; }
.btn-back   { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }

.fac-card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:22px 24px; margin-bottom:14px; }
.fac-card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
.fac-card-title i { color:#b480ff; }

.fac-header-row { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:18px; }
.fac-num       { font-family:monospace; font-size:24px; font-weight:800; color:#b480ff; }
.fac-date-text { font-size:12px; color:#9ca3af; margin-top:4px; }
.fac-type-badge { font-size:12px; font-weight:700; padding:6px 16px; border-radius:20px; display:inline-block; flex-shrink:0; }
.fac-type-badge.rdv      { background:rgba(124,58,237,0.1); color:#7c3aed; }
.fac-type-badge.commande { background:rgba(249,115,22,0.1); color:#f97316; }

.item-row { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; border-radius:10px; background:#fdf9ff; border:1px solid #ede9fe; margin-bottom:8px; }
.item-row:last-child { margin-bottom:0; }
.item-name  { font-size:13px; font-weight:500; color:#374151; }
.item-price { font-size:13px; font-weight:700; color:#b480ff; }

.total-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; font-size:13px; color:#6b7280; }
.total-row.final { border-top:1px solid #ede9fe; margin-top:6px; padding-top:14px; font-size:16px; font-weight:800; color:#1a1a2e; }
.total-row.final .total-amount { color:#b480ff; font-size:20px; }

.action-bar { display:flex; gap:10px; flex-wrap:wrap; }
.btn-pdf   { padding:12px 28px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-pdf:hover { opacity:0.88; transform:translateY(-1px); box-shadow:0 6px 16px rgba(180,128,255,0.3); }
.btn-print { padding:12px 22px; border-radius:30px; background:white; color:#6b7280; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-print:hover { border-color:#b480ff; color:#b480ff; }

@media (max-width:640px) { .fac-header-row { flex-direction:column; } }
</style>

<div class="show-wrap">
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
<div class="show-inner">

    <div class="show-top">
        <h1>Invoice {{ $facture->numero }}</h1>
        <a href="{{ route('client.factures.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- HEADER --}}
    <div class="fac-card">
        <div class="fac-header-row">
            <div>
                <div class="fac-num">{{ $facture->numero }}</div>
                <div class="fac-date-text">Issued on {{ $facture->date_emission->format('d/m/Y at H:i') }}</div>
            </div>
            <span class="fac-type-badge {{ $facture->type === 'rendez_vous' ? 'rdv' : 'commande' }}">
                @if($facture->type === 'rendez_vous')
                    <i class="fa-solid fa-spa"></i> Appointment
                @else
                    <i class="fa-solid fa-cart-shopping"></i> Order
                @endif
            </span>
        </div>
    </div>

    {{-- RDV DETAILS --}}
    @if($facture->estDeRdv() && $facture->rendezVous)
        <div class="fac-card">
            <div class="fac-card-title"><i class="fa-solid fa-spa"></i> Appointment Details</div>
            <p style="font-size:13px;color:#6b7280;margin-bottom:14px;">
                {{ $facture->rendezVous->date_debut->format('d/m/Y at H:i') }}
                with <strong style="color:#1a1a2e;">{{ $facture->rendezVous->estheticienne->fullName() }}</strong>
            </p>
            @foreach($facture->rendezVous->services as $service)
                <div class="item-row">
                    <div class="item-name">{{ $service->nom }}</div>
                    <div class="item-price">{{ number_format($service->pivot->prix_au_moment, 0, ',', ' ') }} DA</div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ORDER DETAILS --}}
    @if($facture->estDeCommande() && $facture->commande)
        <div class="fac-card">
            <div class="fac-card-title"><i class="fa-solid fa-cart-shopping"></i> Order — {{ $facture->commande->numero }}</div>
            @foreach($facture->commande->produits as $produit)
                <div class="item-row">
                    <div class="item-name">{{ $produit->nom }} × {{ $produit->pivot->quantite }}</div>
                    <div class="item-price">{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite, 0, ',', ' ') }} DA</div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- TOTALS --}}
    <div class="fac-card">
        <div class="fac-card-title"><i class="fa-solid fa-receipt"></i> Summary</div>
        <div class="total-row">
            <span>Amount (excl. VAT)</span>
            <span>{{ number_format($facture->montant_ht, 0, ',', ' ') }} DA</span>
        </div>
        <div class="total-row">
            <span>VAT ({{ number_format($facture->taux_tva, 0) }}%)</span>
            <span>{{ number_format($facture->montant_tva, 0, ',', ' ') }} DA</span>
        </div>
        <div class="total-row final">
            <span>Total TTC</span>
            <span class="total-amount">{{ number_format($facture->montant_ttc, 0, ',', ' ') }} DA</span>
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="action-bar">
        <a href="{{ route('client.factures.telecharger', $facture) }}" class="btn-pdf">
            <i class="fa-solid fa-file-pdf"></i> Download PDF
        </a>
        <button type="button" class="btn-print" onclick="window.print()">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </div>

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
</script>
</x-app-layout>
