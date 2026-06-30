<x-app-layout>
<x-slot name="header">Invoice {{ $facture->numero }}</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.fcs-hero {
    position:relative; overflow:hidden; padding:50px 10% 80px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.fcs-hero-pattern {
    position:absolute; inset:0;
    background-image:radial-gradient(circle at 20% 50%, rgba(255,255,255,0.08) 0%, transparent 50%),
                     radial-gradient(circle at 80% 20%, rgba(255,255,255,0.06) 0%, transparent 40%);
}
.fcs-hero-content { position:relative; z-index:2; display:flex; align-items:flex-start; justify-content:space-between; gap:24px; flex-wrap:wrap; }
.fcs-back {
    display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border-radius:20px;
    background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35);
    color:white; font-size:12px; font-weight:600; text-decoration:none;
    transition:all 0.2s; margin-bottom:16px;
}
.fcs-back:hover { background:rgba(255,255,255,0.3); }
.fcs-hero-num { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.75); margin-bottom:8px; }
.fcs-hero-title { font-family:'Playfair Display',serif; font-size:32px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:8px; }
.fcs-hero-date { font-size:13px; color:rgba(255,255,255,0.85); display:flex; align-items:center; gap:6px; }
.fcs-wave { position:absolute; bottom:-2px; left:0; right:0; height:60px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23faf8ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* BODY */
.fcs-body { max-width:760px; margin:0 auto; padding:32px 24px 80px; }

/* INVOICE DOC */
.fcs-doc {
    background:white; border-radius:28px; overflow:hidden;
    box-shadow:0 20px 60px rgba(180,128,255,0.12);
    border:1px solid #ede9fe;
    opacity:0; animation:fadeUp 0.6s 0.1s forwards;
    margin-bottom:24px;
}
@keyframes fadeUp { from{ opacity:0; transform:translateY(20px); } to{ opacity:1; transform:translateY(0); } }

/* DOC HEADER */
.fcs-doc-header {
    background:linear-gradient(135deg,#b480ff,#d3aa95);
    padding:32px 36px;
    display:flex; align-items:flex-start; justify-content:space-between; gap:20px; flex-wrap:wrap;
    position:relative; overflow:hidden;
}
.fcs-doc-header::before { content:''; position:absolute; width:300px; height:300px; border-radius:50%; background:rgba(255,255,255,0.08); top:-100px; right:-60px; }
.fcs-doc-header-left { position:relative; z-index:2; }
.fcs-doc-logo { font-family:'Playfair Display',serif; font-size:24px; font-weight:800; color:white; margin-bottom:4px; }
.fcs-doc-logo-sub { font-size:11px; color:rgba(255,255,255,0.85); letter-spacing:1px; text-transform:uppercase; }
.fcs-doc-header-right { position:relative; z-index:2; text-align:right; }
.fcs-doc-num { font-size:28px; font-weight:900; color:white; font-family:monospace; margin-bottom:4px; }
.fcs-doc-date { font-size:12px; color:rgba(255,255,255,0.9); }
.fcs-doc-type-badge { display:inline-flex; align-items:center; gap:6px; margin-top:8px; padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700; }
.fcs-doc-type-badge.rdv   { background:rgba(255,255,255,0.2); color:white; }
.fcs-doc-type-badge.order { background:rgba(255,255,255,0.2); color:white; }

/* DOC BODY */
.fcs-doc-body { padding:32px 36px; }
.fcs-section-title { font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#c4b5fd; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.fcs-section-title i { color:#b480ff; }

/* CLIENT INFO */
.fcs-client-box { background:#fdf9ff; border-radius:14px; padding:16px 18px; border:1px solid #ede9fe; margin-bottom:24px; }
.fcs-client-name { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:3px; }
.fcs-client-email { font-size:12px; color:#9ca3af; }

/* RDV INFO */
.fcs-rdv-box { background:#fdf9ff; border-radius:14px; padding:16px 18px; border:1px solid #ede9fe; margin-bottom:24px; font-size:13px; color:#374151; }
.fcs-rdv-box strong { color:#1a1a2e; }

/* TABLE */
.fcs-table { width:100%; border-collapse:collapse; margin-bottom:24px; border-radius:14px; overflow:hidden; border:1px solid #ede9fe; }
.fcs-table thead tr { background:linear-gradient(135deg,#b480ff,#d3aa95); }
.fcs-table thead th { padding:12px 14px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:white; }
.fcs-table thead th.tr { text-align:right; }
.fcs-table tbody tr { border-bottom:1px solid #faf8ff; }
.fcs-table tbody tr:last-child { border-bottom:none; }
.fcs-table td { padding:12px 14px; font-size:13px; color:#374151; }
.fcs-table td.tr { text-align:right; font-weight:700; color:#b480ff; }
.fcs-table td.name { font-weight:600; color:#1a1a2e; }

/* TOTALS */
.fcs-totals { border-top:2px solid #ede9fe; padding-top:16px; }
.fcs-total-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
.fcs-total-row-label { font-size:13px; color:#6b7280; }
.fcs-total-row-value { font-size:13px; font-weight:600; color:#374151; }
.fcs-total-final { display:flex; justify-content:space-between; align-items:center; padding:16px 18px; border-radius:14px; background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.05)); border:1.5px solid rgba(180,128,255,0.15); margin-top:14px; }
.fcs-total-final-label { font-size:16px; font-weight:800; color:#1a1a2e; }
.fcs-total-final-value { font-size:28px; font-weight:900; color:#b480ff; }

/* DOC FOOTER */
.fcs-doc-footer { background:#fdf9ff; padding:20px 36px; border-top:1px solid #ede9fe; text-align:center; font-size:12px; color:#c4b5fd; }

/* ACTIONS */
.fcs-actions { display:flex; gap:12px; flex-wrap:wrap; opacity:0; animation:fadeUp 0.5s 0.3s forwards; }
.fcs-btn-pdf {
    display:inline-flex; align-items:center; gap:8px; padding:13px 28px;
    border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95);
    color:white; font-size:14px; font-weight:700; text-decoration:none;
    transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35);
}
.fcs-btn-pdf:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }
.fcs-btn-print {
    display:inline-flex; align-items:center; gap:8px; padding:13px 22px;
    border-radius:30px; background:white; color:#374151;
    font-size:14px; font-weight:700; border:1.5px solid #ede9fe; cursor:pointer;
    font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s;
}
.fcs-btn-print:hover { border-color:#b480ff; color:#b480ff; }

@media(max-width:640px){ .fcs-doc-header{ flex-direction:column; } .fcs-doc-header-right{ text-align:left; } .fcs-doc-body{ padding:24px 20px; } }
</style>

{{-- HERO --}}
<div class="fcs-hero">
    <div class="fcs-hero-pattern"></div>
    <div class="fcs-hero-content">
        <div>
            <a href="{{ route('client.factures.index') }}" class="fcs-back">
                <i class="fa-solid fa-arrow-left"></i> My Invoices
            </a>
            <div class="fcs-hero-num">Invoice #{{ $facture->numero }}</div>
            <div class="fcs-hero-title">
                @if($facture->type==='rendez_vous') Appointment Invoice
                @else Order Invoice
                @endif
            </div>
            <div class="fcs-hero-date">
                <i class="fa-regular fa-calendar"></i>
                Issued on {{ $facture->date_emission->format('d/m/Y at H:i') }}
            </div>
        </div>
        <div style="padding-top:40px;">
            @if($facture->type==='rendez_vous')
                <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 16px;border-radius:20px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:12px;font-weight:700;">
                    <i class="fa-solid fa-spa" style="font-size:10px;"></i> Appointment
                </span>
            @else
                <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 16px;border-radius:20px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:12px;font-weight:700;">
                    <i class="fa-solid fa-cart-shopping" style="font-size:10px;"></i> Order
                </span>
            @endif
        </div>
    </div>
    <div class="fcs-wave"></div>
</div>

<div class="fcs-body">

    {{-- INVOICE DOCUMENT --}}
    <div class="fcs-doc">

        {{-- HEADER --}}
        <div class="fcs-doc-header">
            <div class="fcs-doc-header-left">
                <div class="fcs-doc-logo">✨ Glow Institute</div>
                <div class="fcs-doc-logo-sub">Beauty & Wellness</div>
            </div>
            <div class="fcs-doc-header-right">
                <div class="fcs-doc-num">{{ $facture->numero }}</div>
                <div class="fcs-doc-date">Issued on {{ $facture->date_emission->format('d/m/Y at H:i') }}</div>
                <div>
                    @if($facture->type==='rendez_vous')
                        <span class="fcs-doc-type-badge rdv"><i class="fa-solid fa-spa" style="font-size:10px;"></i> Appointment</span>
                    @else
                        <span class="fcs-doc-type-badge order"><i class="fa-solid fa-cart-shopping" style="font-size:10px;"></i> Order</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="fcs-doc-body">

            {{-- CLIENT --}}
            <div class="fcs-section-title"><i class="fa-solid fa-user"></i> Bill To</div>
            <div class="fcs-client-box">
                <div class="fcs-client-name">{{ auth()->user()->fullName() }}</div>
                <div class="fcs-client-email">{{ auth()->user()->email }}</div>
            </div>

            {{-- APPOINTMENT DETAILS --}}
            @if($facture->estDeRdv() && $facture->rendezVous)
                <div class="fcs-section-title"><i class="fa-solid fa-spa"></i> Appointment Details</div>
                <div class="fcs-rdv-box">
                    <i class="fa-regular fa-calendar" style="color:#b480ff;margin-right:6px;"></i>
                    <strong>{{ $facture->rendezVous->date_debut->format('d/m/Y at H:i') }}</strong>
                    &nbsp;·&nbsp;
                    With <strong>{{ $facture->rendezVous->estheticienne->fullName() }}</strong>
                </div>
                <div class="fcs-section-title"><i class="fa-solid fa-list"></i> Services</div>
                <table class="fcs-table">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th class="tr">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facture->rendezVous->services as $service)
                            <tr>
                                <td class="name">{{ $service->nom }}</td>
                                <td class="tr">{{ number_format($service->pivot->prix_au_moment,0,',',' ') }} DA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- ORDER DETAILS --}}
            @if($facture->estDeCommande() && $facture->commande)
                <div class="fcs-section-title"><i class="fa-solid fa-box"></i> Order {{ $facture->commande->numero }}</div>
                <table class="fcs-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="tr">Qty</th>
                            <th class="tr">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facture->commande->produits as $produit)
                            <tr>
                                <td class="name">{{ $produit->nom }}</td>
                                <td class="tr" style="color:#6b7280;">×{{ $produit->pivot->quantite }}</td>
                                <td class="tr">{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite,0,',',' ') }} DA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- TOTALS --}}
            <div class="fcs-totals">
                @if($facture->estDeRdv() && $facture->reduction_fidelite > 0)
                    <div class="fcs-total-row">
                        <span class="fcs-total-row-label">Loyalty discount</span>
                        <span class="fcs-total-row-value">- {{ number_format($facture->reduction_fidelite,0,',',' ') }} DA</span>
                    </div>
                @endif
                <div class="fcs-total-row">
                    <span class="fcs-total-row-label">Subtotal (excl. VAT)</span>
                    <span class="fcs-total-row-value">{{ number_format($facture->montant_ht,0,',',' ') }} DA</span>
                </div>
                <div class="fcs-total-row">
                    <span class="fcs-total-row-label">VAT ({{ number_format($facture->taux_tva,0) }}%)</span>
                    <span class="fcs-total-row-value">{{ number_format($facture->montant_tva,0,',',' ') }} DA</span>
                </div>
                <div class="fcs-total-final">
                    <div class="fcs-total-final-label">Total (incl. VAT)</div>
                    <div class="fcs-total-final-value">{{ number_format($facture->montant_ttc,0,',',' ') }} DA</div>
                </div>
            </div>
        </div>

        <div class="fcs-doc-footer">
            Thank you for choosing Glow Institute — Your beauty, our passion 💜
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="fcs-actions">
        <a href="{{ route('client.factures.telecharger', $facture) }}" class="fcs-btn-pdf">
            <i class="fa-solid fa-download"></i> Download PDF
        </a>
        <button onclick="imprimerPDF()" class="fcs-btn-print">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </div>

</div>

<script>
function imprimerPDF() {
    fetch("{{ route('client.factures.telecharger', $facture) }}")
        .then(r => r.blob())
        .then(blob => {
            const url = URL.createObjectURL(blob);
            const w = window.open(url, '_blank');
            w.addEventListener('load', () => setTimeout(() => w.print(), 500));
        });
}
</script>

</x-app-layout>
