<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Facture {{ $facture->numero }}</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: DejaVu Sans, sans-serif; font-size:10px; color:#1a1a2e; background:white; }
@page { margin: 0; }

/* ── HEADER ── */
.header {
    background: #b480ff;
    padding: 32px 36px 28px;
    position: relative;
    overflow: hidden;
}
.header-glow-1 {
    position: absolute; top:-40px; right:80px;
    width:180px; height:180px; border-radius:50%;
    background: rgba(255,255,255,0.1);
}
.header-glow-2 {
    position: absolute; bottom:-60px; left:40px;
    width:140px; height:140px; border-radius:50%;
    background: rgba(255,255,255,0.08);
}
.header-inner { position:relative; z-index:1; display:table; width:100%; }
.header-left  { display:table-cell; vertical-align:middle; width:60%; }
.header-right { display:table-cell; vertical-align:middle; text-align:right; }

.logo-name { font-size:22px; font-weight:bold; color:white; letter-spacing:1px; }
.logo-sub  { font-size:9px; color:rgba(255,255,255,0.85); letter-spacing:2px; text-transform:uppercase; margin-top:2px; }
.header-contact { font-size:9px; color:rgba(255,255,255,0.9); margin-top:12px; line-height:2; }

.facture-label { font-size:11px; font-weight:bold; letter-spacing:3px; text-transform:uppercase; color:rgba(255,255,255,0.85); }
.facture-num   { font-size:20px; font-weight:bold; color:white; margin-top:4px; font-family: 'Courier New', monospace; letter-spacing:1px; }
.facture-date  { font-size:9px; color:rgba(255,255,255,0.85); margin-top:6px; }

/* ── GRADIENT BAND ── */
.grad-band {
    height:4px;
    background: #b480ff;
}

/* ── STATUS BAR ── */
.status-bar {
    background: #fdf9ff;
    padding: 12px 36px;
    display: table; width: 100%;
    border-bottom: 1px solid #ede9fe;
}
.status-bar-left  { display: table-cell; vertical-align:middle; }
.status-bar-right { display: table-cell; vertical-align:middle; text-align:right; }
.status-badge { display:inline-block; padding:4px 14px; border-radius:20px; background:rgba(180,128,255,0.12); color:#7c3aed; font-size:9px; font-weight:bold; letter-spacing:0.5px; border:1px solid rgba(180,128,255,0.25); }
.status-meta { font-size:9px; color:#9ca3af; line-height:2; }
.status-meta strong { color:#1a1a2e; }

/* ── PARTIES ── */
.parties { display:table; width:100%; padding: 22px 36px; background:white; }
.partie-cell { display:table-cell; width:50%; vertical-align:top; padding-right:20px; }
.partie-cell:last-child { padding-right:0; padding-left:20px; }
.partie-box { padding:16px 18px; border-radius:8px; }
.partie-box.left  { background:#fdf9ff; border-left:3px solid #b480ff; }
.partie-box.right { background:#fdf9ff; border-left:3px solid #d3aa95; }
.partie-title { font-size:8px; text-transform:uppercase; letter-spacing:1.5px; color:#9ca3af; font-weight:bold; margin-bottom:10px; }
.partie-name  { font-size:13px; font-weight:bold; color:#1a1a2e; margin-bottom:4px; }
.partie-info  { font-size:9.5px; color:#6b7280; line-height:2; }

/* ── SECTION TITLE ── */
.section-title-wrap { padding: 0 36px 10px; }
.section-title {
    font-size:9px; font-weight:bold; text-transform:uppercase; letter-spacing:1.5px;
    color:#b480ff; padding-bottom:6px; border-bottom:1px solid #ede9fe;
    display:flex; align-items:center; gap:6px;
}

/* ── TABLE ── */
.table-wrap { padding: 0 36px 20px; }
table { width:100%; border-collapse:collapse; }
table thead tr { background: #b480ff; }
table thead th {
    padding: 9px 12px; color:white; font-size:8.5px;
    font-weight:bold; text-transform:uppercase; letter-spacing:0.5px;
}
table thead th:last-child { text-align:right; }
table tbody tr { border-bottom:1px solid #f5f0ff; }
table tbody tr:nth-child(even) { background:#fdfbff; }
table tbody td { padding: 9px 12px; font-size:10px; color:#374151; }
table tbody td:last-child { text-align:right; font-weight:bold; color:#b480ff; }
.td-center { text-align:center; }
.td-right  { text-align:right; }

/* ── PROMO BOX ── */
.promo-wrap { padding: 0 36px 14px; }
.promo-box { background:#f0fdf4; border:1px solid rgba(16,185,129,0.2); border-left:3px solid #10b981; border-radius:6px; padding:10px 14px; font-size:9.5px; color:#065f46; }

/* ── TOTAUX ── */
.totaux-wrap { padding: 0 36px 24px; }
.totaux-inner { width:42%; margin-left:auto; border:1px solid #ede9fe; border-radius:8px; overflow:hidden; }
.total-row { display:table; width:100%; }
.total-row-label { display:table-cell; padding:9px 14px; font-size:10px; color:#6b7280; }
.total-row-value { display:table-cell; padding:9px 14px; font-size:10px; text-align:right; font-weight:bold; color:#1a1a2e; }
.total-row.ht    { background:white; border-bottom:1px solid #f5f0ff; }
.total-row.tva   { background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.total-row.ttc   { background: #b480ff; }
.total-row.ttc .total-row-label { color:white; font-size:11px; font-weight:bold; }
.total-row.ttc .total-row-value { color:white; font-size:14px; }

/* ── NOTE / MERCI ── */
.thank-wrap { padding: 0 36px 24px; }
.thank-box { background:#fdf9ff; border-radius:8px; padding:14px 18px; text-align:center; border:1px solid #ede9fe; }
.thank-title { font-size:12px; font-weight:bold; color:#1a1a2e; margin-bottom:4px; }
.thank-sub   { font-size:9px; color:#9ca3af; }

/* ── FOOTER ── */
.footer {
    background: #b480ff; padding:14px 36px;
    display:table; width:100%;
}
.footer-left  { display:table-cell; vertical-align:middle; color:rgba(255,255,255,0.9); font-size:8.5px; }
.footer-right { display:table-cell; vertical-align:middle; text-align:right; color:rgba(255,255,255,0.9); font-size:8.5px; }
.footer-right span { color:white; font-weight:bold; }

/* separator */
.sep { height:1px; background:#ede9fe; margin: 0 36px 18px; }
</style>
</head>
<body>

{{-- ══ HEADER ══ --}}
<div class="header">
    <div class="header-glow-1"></div>
    <div class="header-glow-2"></div>
    <div class="header-inner">
        <div class="header-left">
            <div class="logo-name">{{ strtoupper($institut->nom ?? 'Glow Institute') }}</div>
            <div class="logo-sub">Beauty & Wellness</div>
            <div class="header-contact">
                {{ $institut->adresse ?? '' }}<br>
                {{ $institut->telephone ?? '' }}
                @if($institut->telephone && $institut->email) &nbsp;·&nbsp; @endif
                {{ $institut->email ?? '' }}
            </div>
        </div>
        <div class="header-right">
            <div class="facture-label">Inovice</div>
            <div class="facture-num">{{ $facture->numero }}</div>
            <div class="facture-date">Issued on {{ $facture->date_emission->format('d/m/Y') }}</div>
        </div>
    </div>
</div>

<div class="grad-band"></div>

{{-- ══ STATUS BAR ══ --}}
<div class="status-bar">
    <div class="status-bar-left">
        <span class="status-badge">✓ OFFICIAL INVOICE</span>
    </div>
    <div class="status-bar-right">
        <div class="status-meta">
            Issue date: <strong>{{ $facture->date_emission->format('d/m/Y à H:i') }}</strong>
            &nbsp;·&nbsp;
            VAT : <strong>{{ number_format($facture->taux_tva, 0) }}%</strong>
            &nbsp;·&nbsp;
            Type : <strong>{{ $facture->type === 'rendez_vous' ? 'Appointment' : 'Order' }}</strong>
        </div>
    </div>
</div>

{{-- ══ PARTIES ══ --}}
<div class="parties">
    <div class="partie-cell">
        <div class="partie-box left">
            <div class="partie-title">Provider</div>
            <div class="partie-name">{{ $institut->nom ?? 'Glow Institute' }}</div>
            <div class="partie-info">
                {{ $institut->adresse ?? 'Address not provided' }}<br>
                Phone: {{ $institut->telephone ?? '—' }}<br>
                Email : {{ $institut->email ?? '—' }}
            </div>
        </div>
    </div>
    <div class="partie-cell">
        <div class="partie-box right">
            <div class="partie-title">Client</div>
            <div class="partie-name">{{ $facture->client->fullName() }}</div>
            <div class="partie-info">
                {{ $facture->client->email }}<br>
                Phone: {{ $facture->client->telephone ?? '—' }}
            </div>
        </div>
    </div>
</div>

<div class="sep"></div>

{{-- ══ DÉTAILS RDV ══ --}}
@if($facture->estDeRdv() && isset($rdv))
    <div class="section-title-wrap">
        <div class="section-title">Appointment Details</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Expert</th>
                    <th>Date & Time</th>
                    <th>Price (DA)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rdv->services as $service)
                    <tr>
                        <td>{{ $service->nom }}</td>
                        <td>{{ $rdv->estheticienne->fullName() }}</td>
                        <td>{{ $rdv->date_debut->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($service->pivot->prix_au_moment, 0, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- LOYALTY DISCOUNT --}}

@endif

{{-- ══ DÉTAILS COMMANDE ══ --}}
@if($facture->estDeCommande() && isset($commande))
    <div class="section-title-wrap">
        <div class="section-title">Order Details — {{ $commande->numero }}</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="td-center">Quantity</th>
                    <th class="td-right">Unit Price (DA)</th>
                    <th>Total (DA)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td class="td-center">{{ $produit->pivot->quantite }}</td>
                        <td class="td-right" style="color:#6b7280;font-weight:normal;">{{ number_format($produit->pivot->prix_au_moment, 0, ',', ' ') }}</td>
                        <td>{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite, 0, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PROMO CODE --}}
    @if($commande->codePromo)
        <div class="promo-wrap">
            <div class="promo-box">
                Promo code <strong>{{ $commande->codePromo->code }}</strong> appliqué —
                applied — Discount: : <strong>{{ number_format($commande->reductionAppliquee(), 0, ',', ' ') }} DA</strong>
            </div>
        </div>
    @endif
@endif

{{-- ══ TOTAUX ══ --}}
<div class="totaux-wrap">
    <div class="totaux-inner">
        @if($facture->estDeRdv() && $facture->reduction_fidelite > 0)
            <div class="total-row tva">
                <div class="total-row-label">Loyalty discount</div>
                <div class="total-row-value">- {{ number_format($facture->reduction_fidelite, 0, ',', ' ') }} DA</div>
            </div>
        @endif
        <div class="total-row ht">
            <div class="total-row-label">Amount excl. VAT</div>
            <div class="total-row-value">{{ number_format($facture->montant_ht, 0, ',', ' ') }} DA</div>
        </div>
        <div class="total-row tva">
            <div class="total-row-label">VAT ({{ number_format($facture->taux_tva, 0) }}%)</div>
            <div class="total-row-value">{{ number_format($facture->montant_tva, 0, ',', ' ') }} DA</div>
        </div>
        <div class="total-row ttc">
            <div class="total-row-label">TOTAL INCL. VAT</div>
            <div class="total-row-value">{{ number_format($facture->montant_ttc, 0, ',', ' ') }} DA</div>
        </div>
    </div>
</div>


{{-- ══ MERCI ══ --}}
<div class="thank-wrap">
    <div class="thank-box">
        <div class="thank-title">Thank you for your trust <span style="color:#b480ff;">&#9829;</span></div>
        <div class="thank-sub">
            This document was automatically generated by {{ $institut->nom ?? 'Glow Institute' }}.
            For any questions, contact us at {{ $institut->email ?? '' }}
        </div>
    </div>
</div>

{{-- ══ FOOTER ══ --}}
<div class="footer">
    <div class="footer-left">
        {{ $institut->nom ?? 'Glow Institute' }} · {{ $institut->adresse ?? '' }}
    </div>
    <div class="footer-right">
        Generated on {{ now()->format('d/m/Y à H:i') }}
        &nbsp;·&nbsp;
        <span>Confidential document</span>
    </div>
</div>

</body>
</html>
