<x-app-layout>
<x-slot name="header">Order {{ $commande->numero }}</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.cms-hero { position:relative; overflow:hidden; padding:50px 10% 80px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.cms-hero-pattern { position:absolute; inset:0; background-image:radial-gradient(circle at 20% 50%,rgba(255,255,255,0.08) 0%,transparent 40%), radial-gradient(circle at 80% 30%,rgba(255,255,255,0.06) 0%,transparent 40%); }
.cms-hero-content { position:relative; z-index:2; display:flex; align-items:flex-start; justify-content:space-between; gap:20px; flex-wrap:wrap; }
.cms-back { display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border-radius:20px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s; margin-bottom:16px; }
.cms-back:hover { background:rgba(255,255,255,0.3); }
.cms-hero-num   { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.75); margin-bottom:8px; }
.cms-hero-title { font-family:'Playfair Display',serif; font-size:32px; font-weight:800; color:white; margin-bottom:6px; text-shadow:0 2px 16px rgba(0,0,0,0.2); }
.cms-hero-date  { font-size:13px; color:rgba(255,255,255,0.85); display:flex; align-items:center; gap:6px; }
.cms-hero-date i { color:rgba(255,255,255,0.7); }
.cms-status-badge { display:inline-flex; align-items:center; gap:6px; padding:8px 18px; border-radius:20px; font-size:13px; font-weight:700; background:rgba(255,255,255,0.2); color:white; }
.cms-wave { position:absolute; bottom:-2px; left:0; right:0; height:60px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23faf8ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.cms-body { max-width:760px; margin:0 auto; padding:32px 24px 80px; }
.cms-grid { display:grid; grid-template-columns:1fr 280px; gap:20px; align-items:start; }

.cms-card { background:white; border-radius:24px; padding:24px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); margin-bottom:18px; opacity:0; animation:fadeUp 0.5s forwards; transition:all 0.3s; }
.cms-card:nth-child(1){animation-delay:.05s} .cms-card:nth-child(2){animation-delay:.1s} .cms-card:nth-child(3){animation-delay:.15s}
.cms-card:hover { box-shadow:0 10px 32px rgba(180,128,255,0.1); transform:translateY(-2px); }
@keyframes fadeUp { from{opacity:0;transform:translateY(16px);} to{opacity:1;transform:translateY(0);} }
.cms-card-title { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:10px; }
.cms-card-icon  { width:32px; height:32px; border-radius:9px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0; }

.cms-prd-item { display:flex; align-items:center; gap:14px; padding:12px; background:#fdf9ff; border-radius:14px; border:1px solid #ede9fe; margin-bottom:10px; transition:all 0.2s; }
.cms-prd-item:last-child { margin-bottom:0; }
.cms-prd-item:hover { border-color:#b480ff; }
.cms-prd-img    { width:52px; height:52px; border-radius:12px; object-fit:cover; flex-shrink:0; }
.cms-prd-img-ph { width:52px; height:52px; border-radius:12px; background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.cms-prd-name  { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:3px; }
.cms-prd-qty   { font-size:11px; color:#9ca3af; }
.cms-prd-price { font-size:15px; font-weight:900; color:#b480ff; margin-left:auto; flex-shrink:0; }

.cms-promo-badge { display:flex; align-items:center; gap:8px; padding:10px 14px; border-radius:12px; background:rgba(16,185,129,0.06); border:1px solid rgba(16,185,129,0.2); font-size:13px; color:#059669; font-weight:600; margin:12px 0; }
.cms-total-row   { display:flex; justify-content:space-between; align-items:center; padding-top:14px; margin-top:12px; border-top:1px solid #ede9fe; }
.cms-total-label { font-size:15px; font-weight:700; color:#1a1a2e; }
.cms-total-value { font-size:26px; font-weight:900; color:#b480ff; }

.cms-facture-row { display:flex; align-items:center; justify-content:space-between; gap:10px; }
.cms-facture-num { font-size:14px; font-weight:700; color:#1a1a2e; font-family:monospace; }
.cms-facture-sub { font-size:12px; color:#9ca3af; margin-top:2px; }
.cms-facture-actions { display:flex; gap:8px; }
.cms-btn-view { padding:8px 16px; border-radius:20px; font-size:12px; font-weight:700; background:#f5f0ff; color:#7c3aed; text-decoration:none; border:1.5px solid #ede9fe; transition:all 0.2s; }
.cms-btn-view:hover { background:#7c3aed; color:white; border-color:#7c3aed; }
.cms-btn-pdf  { padding:8px 16px; border-radius:20px; font-size:12px; font-weight:700; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; text-decoration:none; transition:all 0.2s; }
.cms-btn-pdf:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(180,128,255,0.4); }

.cms-sticky   { position:sticky; top:90px; }
.cms-sum-card { background:white; border-radius:24px; padding:22px; border:1px solid #ede9fe; box-shadow:0 8px 30px rgba(180,128,255,0.1); margin-bottom:14px; opacity:0; animation:fadeUp 0.5s 0.2s forwards; }
.cms-sum-title { font-size:14px; font-weight:800; color:#1a1a2e; margin-bottom:14px; }
.cms-timeline-item { display:flex; gap:12px; margin-bottom:14px; }
.cms-timeline-item:last-child { margin-bottom:0; }
.cms-timeline-dot { width:10px; height:10px; border-radius:50%; background:#b480ff; margin-top:4px; flex-shrink:0; position:relative; }
.cms-timeline-dot::after { content:''; position:absolute; top:10px; left:4px; width:2px; height:calc(100% + 4px); background:rgba(180,128,255,0.15); }
.cms-timeline-item:last-child .cms-timeline-dot::after { display:none; }
.cms-timeline-text { font-size:12px; color:#6b7280; line-height:1.6; }
.cms-timeline-text strong { color:#1a1a2e; display:block; font-size:13px; }

.cms-cancel-card { background:white; border-radius:20px; padding:18px; border:1.5px solid rgba(239,68,68,0.15); opacity:0; animation:fadeUp 0.5s 0.3s forwards; }
.cms-cancel-note { font-size:12px; color:#9ca3af; margin-bottom:12px; line-height:1.6; }
.btn-cancel-full { width:100%; padding:11px; border-radius:30px; background:rgba(239,68,68,0.06); color:#ef4444; font-size:13px; font-weight:700; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px; transition:all 0.2s; }
.btn-cancel-full:hover { background:rgba(239,68,68,0.12); }

@media(max-width:768px){ .cms-grid{grid-template-columns:1fr;} .cms-sticky{position:static;} }
</style>

{{-- HERO --}}
<div class="cms-hero">
    <div class="cms-hero-pattern"></div>
    <div class="cms-hero-content">
        <div>
            <a href="{{ route('client.commandes.index') }}" class="cms-back">
                <i class="fa-solid fa-arrow-left"></i> My Orders
            </a>
            <div class="cms-hero-num">Order</div>
            <div class="cms-hero-title">{{ $commande->numero }}</div>
            <div class="cms-hero-date">
                <i class="fa-regular fa-calendar"></i>
                {{ $commande->created_at->format('d/m/Y at H:i') }}
            </div>
        </div>
        @php
            $statusClass = match($commande->statut) { 'en_attente'=>'waiting','confirmee'=>'confirmed',default=>'cancelled' };
            $statusLabel = match($commande->statut) { 'en_attente'=>'⏳ Pending','confirmee'=>'✅ Confirmed',default=>'❌ Cancelled' };
        @endphp
        <div style="padding-top:40px;">
            <span class="cms-status-badge">{{ $statusLabel }}</span>
        </div>
    </div>
    <div class="cms-wave"></div>
</div>

<div class="cms-body">

    <div class="cms-grid">
        {{-- LEFT --}}
        <div>
            <div class="cms-card">
                <div class="cms-card-title">
                    <div class="cms-card-icon"><i class="fa-solid fa-box"></i></div> Products
                </div>
                @foreach($commande->produits as $produit)
                    <div class="cms-prd-item">
                        @if($produit->image)
                            <img src="{{ asset('storage/'.$produit->image) }}" class="cms-prd-img" alt="{{ $produit->nom }}">
                        @else
                            <div class="cms-prd-img-ph">
                                <i class="fa-solid fa-bottle-droplet" style="font-size:22px;color:#b480ff;opacity:0.5;"></i>
                            </div>
                        @endif
                        <div style="flex:1;">
                            <div class="cms-prd-name">{{ $produit->nom }}</div>
                            <div class="cms-prd-qty">{{ $produit->pivot->quantite }} × {{ number_format($produit->pivot->prix_au_moment,0,',',' ') }} DA</div>
                        </div>
                        <div class="cms-prd-price">{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite,0,',',' ') }} DA</div>
                    </div>
                @endforeach
                @if($commande->reductionAppliquee() > 0)
                    <div class="cms-promo-badge">
                        <i class="fa-solid fa-tag"></i>
                        Promo code <strong>{{ $commande->codePromo?->code }}</strong> applied — {{ number_format($commande->reductionAppliquee(),0,',',' ') }} DA saved!
                    </div>
                @endif
                <div class="cms-total-row">
                    <div class="cms-total-label">Total</div>
                    <div class="cms-total-value">{{ number_format($commande->prix_final,0,',',' ') }} DA</div>
                </div>
            </div>

            @if($commande->facture)
            <div class="cms-card">
                <div class="cms-card-title">
                    <div class="cms-card-icon"><i class="fa-solid fa-file-invoice"></i></div> Invoice Available
                </div>
                <div class="cms-facture-row">
                    <div>
                        <div class="cms-facture-num">{{ $commande->facture->numero }}</div>
                        <div class="cms-facture-sub">{{ $commande->facture->date_emission->format('d/m/Y') }}</div>
                    </div>
                    <div class="cms-facture-actions">
                        <a href="{{ route('client.factures.show', $commande->facture) }}" class="cms-btn-view">
                            <i class="fa-solid fa-eye"></i> View
                        </a>
                        <a href="{{ route('client.factures.telecharger', $commande->facture) }}" class="cms-btn-pdf">
                            <i class="fa-solid fa-download"></i> PDF
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- RIGHT --}}
        <div class="cms-sticky">
            <div class="cms-sum-card">
                <div class="cms-sum-title">Order Summary</div>
                <div class="cms-timeline-item">
                    <div class="cms-timeline-dot"></div>
                    <div class="cms-timeline-text"><strong>Order Number</strong>{{ $commande->numero }}</div>
                </div>
                <div class="cms-timeline-item">
                    <div class="cms-timeline-dot"></div>
                    <div class="cms-timeline-text"><strong>Date</strong>{{ $commande->created_at->format('d/m/Y at H:i') }}</div>
                </div>
                <div class="cms-timeline-item">
                    <div class="cms-timeline-dot"></div>
                    <div class="cms-timeline-text"><strong>Items</strong>{{ $commande->produits->count() }} product(s)</div>
                </div>
                <div class="cms-timeline-item">
                    <div class="cms-timeline-dot" style="background:{{ match($commande->statut){ 'confirmee'=>'#10b981','annulee'=>'#ef4444',default=>'#f97316' } }};"></div>
                    <div class="cms-timeline-text"><strong>Status</strong>{{ $statusLabel }}</div>
                </div>
                <div class="cms-timeline-item">
                    <div class="cms-timeline-dot" style="background:#b480ff;"></div>
                    <div class="cms-timeline-text"><strong>Total</strong>{{ number_format($commande->prix_final,0,',',' ') }} DA</div>
                </div>
            </div>

            @if($commande->statut==='en_attente')
                <div class="cms-cancel-card">
                    <div class="cms-cancel-note">Want to cancel? Please do so before the order is confirmed.</div>
                    <form action="{{ route('client.commandes.annuler', $commande) }}" method="POST" id="cancelOrderForm">
                        @csrf @method('PATCH')
                        <button type="button" class="btn-cancel-full"
                            onclick="glowConfirm(
                                'Cancel this order?',
                                'Order {{ $commande->numero }} will be cancelled. This cannot be undone.',
                                'Yes, cancel',
                                'fa-xmark',
                                'red',
                                function(){ document.getElementById('cancelOrderForm').submit(); }
                            )">
                            <i class="fa-solid fa-xmark"></i> Cancel Order
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- TOAST --}}
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

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
