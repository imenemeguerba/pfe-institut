<x-app-layout>
<x-slot name="header">Order Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:760px; margin:0 auto; }

.show-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.show-top h1 { font-size:17px; font-weight:800; color:#1a1a2e; }
.btn-back { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }

.card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:20px 24px; margin-bottom:14px; }
.card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.card-title i { color:#b480ff; }

.cmd-num  { font-family:monospace; font-size:22px; font-weight:800; color:#b480ff; margin-bottom:4px; }
.cmd-date { font-size:12px; color:#9ca3af; }
.cmd-header { display:flex; justify-content:space-between; align-items:flex-start; gap:12px; margin-bottom:18px; flex-wrap:wrap; }
.cmd-status { font-size:11px; font-weight:600; padding:5px 14px; border-radius:20px; display:inline-block; flex-shrink:0; }
.cmd-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.cmd-status.confirmee  { background:rgba(16,185,129,0.1); color:#059669; }
.cmd-status.annulee    { background:rgba(239,68,68,0.1); color:#ef4444; }

.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; padding-top:16px; border-top:1px solid #f0ebff; }
.fi-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:4px; }
.fi-value { font-size:13px; font-weight:600; color:#1a1a2e; }
.fi-sub   { font-size:11px; color:#9ca3af; margin-top:1px; }
.fi-link  { color:#b480ff; text-decoration:none; }

.product-row { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; border-radius:12px; background:#fdf9ff; border:1px solid #ede9fe; margin-bottom:8px; gap:12px; }
.product-row:last-child { margin-bottom:0; }
.product-img { width:48px; height:48px; border-radius:10px; object-fit:cover; flex-shrink:0; border:1px solid #ede9fe; }
.product-img-ph { width:48px; height:48px; border-radius:10px; background:#f5f0ff; display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:20px; flex-shrink:0; }
.product-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
.product-qty   { font-size:11px; color:#9ca3af; margin-top:2px; }
.product-total { font-size:13px; font-weight:700; color:#b480ff; white-space:nowrap; }
.promo-box { background:rgba(16,185,129,0.06); border:1px solid rgba(16,185,129,0.2); border-radius:10px; padding:10px 14px; margin-top:10px; font-size:13px; color:#059669; }
.total-row { display:flex; justify-content:space-between; align-items:center; padding-top:14px; margin-top:12px; border-top:1px solid #ede9fe; }
.total-label  { font-size:14px; font-weight:700; color:#1a1a2e; }
.total-amount { font-size:22px; font-weight:800; color:#b480ff; }

.note-box { background:#fdf9ff; border-radius:10px; padding:12px 14px; font-size:13px; color:#374151; border-left:3px solid rgba(239,68,68,0.4); }

.facture-row { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; }
.facture-num { font-family:monospace; font-size:14px; font-weight:700; color:#b480ff; }
.facture-actions { display:flex; gap:8px; }
.btn-view { padding:7px 14px; border-radius:20px; background:#f5f0ff; color:#7c3aed; font-size:12px; font-weight:600; text-decoration:none; border:1px solid #ede9fe; }
.btn-pdf  { padding:7px 14px; border-radius:20px; background:rgba(16,185,129,0.08); color:#059669; font-size:12px; font-weight:600; text-decoration:none; border:1px solid rgba(16,185,129,0.2); display:inline-flex; align-items:center; gap:5px; }

.actions-row { display:flex; gap:10px; flex-wrap:wrap; align-items:center; }
.btn-confirm { padding:10px 22px; border-radius:30px; background:rgba(16,185,129,0.1); color:#059669; font-size:13px; font-weight:700; border:1.5px solid rgba(16,185,129,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-confirm:hover { background:rgba(16,185,129,0.2); }
.cancel-form { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
.cancel-input { padding:10px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; min-width:180px; }
.cancel-input:focus { border-color:#ef4444; }
.btn-cancel-action { padding:10px 20px; border-radius:30px; background:rgba(239,68,68,0.06); color:#ef4444; font-size:13px; font-weight:700; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }

@media (max-width:640px) { .info-grid { grid-template-columns:1fr; } }
</style>

<div class="show-wrap">
<div class="show-inner">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    <div class="show-top">
        <h1>Order {{ $commande->numero }}</h1>
        <a href="{{ route('admin.commandes.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- MAIN INFO --}}
    <div class="card">
        <div class="cmd-header">
            <div>
                <div class="cmd-num">{{ $commande->numero }}</div>
                <div class="cmd-date">Placed on {{ $commande->created_at->format('d/m/Y at H:i') }}</div>
            </div>
            <span class="cmd-status {{ $commande->statut }}">
                {{ ['en_attente'=>'Pending','confirmee'=>'Confirmed','annulee'=>'Cancelled'][$commande->statut] ?? $commande->statut }}
            </span>
        </div>
        <div class="info-grid">
            <div>
                <div class="fi-label">Client</div>
                <div class="fi-value"><a href="{{ route('admin.clients.show', $commande->client) }}" class="fi-link">{{ $commande->client->fullName() }}</a></div>
                <div class="fi-sub">{{ $commande->client->email }}</div>
            </div>
            <div>
                <div class="fi-label">Phone</div>
                <div class="fi-value">{{ $commande->client->telephone ?? '—' }}</div>
            </div>
            @if($commande->date_confirmation)
                <div>
                    <div class="fi-label">Confirmed on</div>
                    <div class="fi-value">{{ $commande->date_confirmation->format('d/m/Y H:i') }}</div>
                </div>
            @endif
            @if($commande->date_annulation)
                <div>
                    <div class="fi-label">Cancelled on</div>
                    <div class="fi-value" style="color:#ef4444;">{{ $commande->date_annulation->format('d/m/Y H:i') }}</div>
                </div>
            @endif
        </div>
    </div>

    {{-- PRODUCTS --}}
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-box"></i> Ordered Products</div>
        @foreach($commande->produits as $produit)
            <div class="product-row">
                <div style="display:flex;align-items:center;gap:12px;flex:1;">
                    @if($produit->image)
                        <img src="{{ asset('storage/'.$produit->image) }}" class="product-img" alt="">
                    @else
                        <div class="product-img-ph"><i class="fa-solid fa-box"></i></div>
                    @endif
                    <div>
                        <div class="product-name">{{ $produit->nom }}</div>
                        <div class="product-qty">Qty: {{ $produit->pivot->quantite }} × {{ number_format($produit->pivot->prix_au_moment, 0, ',', ' ') }} DA</div>
                    </div>
                </div>
                <div class="product-total">{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite, 0, ',', ' ') }} DA</div>
            </div>
        @endforeach

        @php $reduction = $commande->reductionAppliquee(); @endphp
        @if($reduction > 0)
            <div class="promo-box">
                <i class="fa-solid fa-tag"></i>
                Promo code <strong>{{ $commande->codePromo?->code }}</strong> : -{{ number_format($reduction, 0, ',', ' ') }} DA
            </div>
        @endif
        <div class="total-row">
            <div class="total-label">Total</div>
            <div class="total-amount">{{ number_format($commande->prix_final, 0, ',', ' ') }} DA</div>
        </div>
    </div>

    {{-- MOTIF ANNULATION --}}
    @if($commande->motif_annulation)
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-circle-xmark"></i> Cancellation Reason</div>
            <div class="note-box">{{ $commande->motif_annulation }}</div>
        </div>
    @endif

    {{-- FACTURE --}}
    @if($commande->facture)
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-file-invoice"></i> Generated Invoice</div>
            <div class="facture-row">
                <div class="facture-num">{{ $commande->facture->numero }}</div>
                <div class="facture-actions">
                    <a href="{{ route('admin.factures.show', $commande->facture) }}" class="btn-view">
                        <i class="fa-solid fa-eye"></i> View
                    </a>
                    <a href="{{ route('admin.factures.telecharger', $commande->facture) }}" class="btn-pdf">
                        <i class="fa-solid fa-file-pdf"></i> PDF
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- ACTIONS --}}
    @if($commande->statut === 'en_attente')
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-gavel"></i> Actions</div>
            <div class="actions-row">
                {{-- Confirm --}}
                <form id="form-confirm" action="{{ route('admin.commandes.confirmer', $commande) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="button" class="btn-confirm"
                        onclick="glowConfirm('Confirm Order','Stock will be updated and invoice generated automatically.','Confirm','fa-check','green',function(){ document.getElementById('form-confirm').submit(); })">
                        <i class="fa-solid fa-check"></i> Confirm Order
                    </button>
                </form>
                {{-- Cancel --}}
                <form id="form-cancel" action="{{ route('admin.commandes.annuler', $commande) }}" method="POST" class="cancel-form">
                    @csrf @method('PATCH')
                    <input type="text" name="motif_annulation" id="cancel-motif"
                           placeholder="Cancellation reason (optional)" class="cancel-input">
                    <button type="button" class="btn-cancel-action"
                        onclick="glowConfirm('Cancel Order','Are you sure you want to cancel this order?','Cancel','fa-xmark','#ef4444',function(){ document.getElementById('form-cancel').submit(); })">
                        <i class="fa-solid fa-xmark"></i> Cancel
                    </button>
                </form>
            </div>
        </div>
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
