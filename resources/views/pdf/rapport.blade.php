<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Facture {{ $facture->numero }}</title>
<style>
*{ margin:0; padding:0; box-sizing:border-box; }
@page { margin:0; }
body{ font-family: DejaVu Sans, sans-serif; background:#ffffff; color:#1a1a2e; font-size:10px; }

.invoice-wrap{ width:100%; background:white; }

/* ── HEADER ── */
.header{ position:relative; overflow:hidden; padding:34px 40px 30px; background:#b480ff; }
.hc1{ position:absolute; width:220px; height:220px; border-radius:50%; background:rgba(255,255,255,0.1); top:-90px; right:-40px; }
.hc2{ position:absolute; width:180px; height:180px; border-radius:50%; background:rgba(255,255,255,0.08); bottom:-90px; left:-20px; }
.h-inner{ position:relative; z-index:2; display:table; width:100%; }
.h-left,.h-right{ display:table-cell; vertical-align:top; }
.h-right{ text-align:right; }
.brand-name{ font-size:26px; color:white; font-weight:bold; letter-spacing:1px; }
.brand-sub{ font-size:9px; color:rgba(255,255,255,0.85); letter-spacing:3px; margin-top:5px; text-transform:uppercase; }
.brand-contact{ margin-top:16px; font-size:9px; color:rgba(255,255,255,0.9); line-height:2; }
.inv-label{ font-size:10px; letter-spacing:4px; color:rgba(255,255,255,0.85); text-transform:uppercase; font-weight:bold; }
.inv-num{ margin-top:6px; font-size:22px; color:white; font-weight:bold; font-family:'Courier New',monospace; }
.inv-date{ margin-top:8px; color:rgba(255,255,255,0.9); font-size:9px; }

/* ── GRADIENT BAND ── */
.gband{ height:5px; background:#d3aa95; }

/* ── STATUS BAR ── */
.sbar{ padding:13px 40px; background:#fcf9ff; border-bottom:1px solid #eee7ff; display:table; width:100%; }
.sbar-l,.sbar-r{ display:table-cell; vertical-align:middle; }
.sbar-r{ text-align:right; }
.sbadge{ display:inline-block; padding:5px 16px; border-radius:30px; background:rgba(180,128,255,0.12); border:1px solid rgba(180,128,255,0.25); color:#7c3aed; font-size:8.5px; font-weight:bold; letter-spacing:1px; }
.smeta{ color:#9ca3af; font-size:9px; }
.smeta strong{ color:#1a1a2e; }

/* ── PARTIES ── */
.parties{ padding:26px 40px 8px; display:table; width:100%; }
.pcol{ display:table-cell; width:50%; vertical-align:top; }
.pbox{ border-radius:12px; padding:18px 20px; }
.pbox.left{ background:#fcf9ff; border-left:4px solid #b480ff; margin-right:10px; }
.pbox.right{ background:#fffaf7; border-left:4px solid #d3aa95; margin-left:10px; }
.ptitle{ font-size:8px; text-transform:uppercase; letter-spacing:2px; color:#9ca3af; margin-bottom:10px; font-weight:bold; }
.pname{ font-size:14px; font-weight:bold; color:#1a1a2e; margin-bottom:5px; }
.pinfo{ font-size:9.5px; line-height:2; color:#6b7280; }

/* ── SECTION TITLE ── */
.sec-wrap{ padding:22px 40px 10px; }
.sec-title{ font-size:9px; text-transform:uppercase; letter-spacing:2px; font-weight:bold; color:#b480ff; padding-bottom:8px; border-bottom:1px solid #ede9fe; }

/* ── TABLE ── */
.tw{ padding:0 40px 22px; }
.tbox{ border:1px solid #ede9fe; border-radius:14px; overflow:hidden; }
table{ width:100%; border-collapse:collapse; }
thead th{ padding:13px 16px; color:white; font-size:8.5px; text-transform:uppercase; letter-spacing:1px; text-align:left; background:#b480ff; }
thead th:last-child,tbody td:last-child{ text-align:right; }
tbody tr{ border-bottom:1px solid #f4efff; }
tbody tr:nth-child(even){ background:#fdfbff; }
tbody td{ padding:13px 16px; font-size:10px; color:#374151; }
.svc-name{ font-weight:bold; color:#1a1a2e; margin-bottom:3px; }
.svc-sub{ color:#9ca3af; font-size:8.5px; }
.price{ color:#b480ff; font-weight:bold; }
.tc{ text-align:center; }
.tr{ text-align:right; }
.muted{ color:#6b7280; font-weight:normal; }

/* ── PROMO ── */
.pw{ padding:0 40px 16px; }
.pbox-promo{ background:#f0fdf4; border:1px solid rgba(16,185,129,0.2); border-left:4px solid #10b981; border-radius:10px; padding:11px 16px; color:#065f46; font-size:9.5px; }

/* ── TOTALS ── */
.totw{ padding:0 40px 26px; }
.totcard{ width:42%; margin-left:auto; border-radius:16px; overflow:hidden; border:1px solid #ede9fe; }
.trow{ display:table; width:100%; }
.tlabel,.tvalue{ display:table-cell; padding:12px 16px; }
.tlabel{ font-size:10px; color:#6b7280; }
.tvalue{ text-align:right; font-weight:bold; color:#1a1a2e; }
.trow.light{ background:white; border-bottom:1px solid #f3edff; }
.trow.soft{ background:#fcf9ff; border-bottom:1px solid #ede9fe; }
.trow.final{ background:#b480ff; }
.trow.final .tlabel{ color:white; font-size:11px; font-weight:bold; }
.trow.final .tvalue{ color:white; font-size:15px; }

/* ── THANK YOU ── */
.thkw{ padding:0 40px 26px; }
.thkbox{ background:#fcf9ff; border:1px solid #ede9fe; border-radius:14px; padding:20px; text-align:center; }
.thk-title{ font-size:14px; color:#1a1a2e; font-weight:bold; margin-bottom:6px; }
.thk-sub{ font-size:9px; color:#9ca3af; line-height:1.9; }

/* ── FOOTER ── */
.footer{ background:#b480ff; padding:15px 40px; display:table; width:100%; }
.fl,.fr{ display:table-cell; vertical-align:middle; color:rgba(255,255,255,0.9); font-size:8.5px; }
.fr{ text-align:right; }
.fr span{ color:white; font-weight:bold; }
</style>
</head>
<body>
<div class="invoice-wrap">

{{-- HEADER --}}
<div class="header">
    <div class="hc1"></div>
    <div class="hc2"></div>
    <div class="h-inner">
        <div class="h-left">
            <div class="brand-name">{{ strtoupper($institut->nom ?? 'Glow Institute') }}</div>
            <div class="brand-sub">Beauty &bull; Wellness &bull; Luxury Care</div>
            <div class="brand-contact">
                {{ $institut->adresse ?? '' }}<br>
                {{ $institut->telephone ?? '' }}
                @if(($institut->telephone ?? '') && ($institut->email ?? '')) &nbsp;&middot;&nbsp; @endif
                {{ $institut->email ?? '' }}
            </div>
        </div>
        <div class="h-right">
            <div class="inv-label">Facture</div>
            <div class="inv-num">{{ $facture->numero }}</div>
            <div class="inv-date">Émise le {{ $facture->date_emission->format('d/m/Y') }}</div>
        </div>
    </div>
</div>
<div class="gband"></div>

{{-- STATUS BAR --}}
<div class="sbar">
    <div class="sbar-l"><span class="sbadge">FACTURE VALIDÉE</span></div>
    <div class="sbar-r">
        <div class="smeta">
            TVA : <strong>{{ number_format($facture->taux_tva,0) }}%</strong>
            &nbsp;&middot;&nbsp;
            Type : <strong>{{ $facture->type === 'rendez_vous' ? 'Rendez-vous' : 'Commande' }}</strong>
            &nbsp;&middot;&nbsp;
            Date : <strong>{{ $facture->date_emission->format('d/m/Y H:i') }}</strong>
        </div>
    </div>
</div>

{{-- PARTIES --}}
<div class="parties">
    <div class="pcol">
        <div class="pbox left">
            <div class="ptitle">Institut</div>
            <div class="pname">{{ $institut->nom ?? 'Glow Institute' }}</div>
            <div class="pinfo">
                {{ $institut->adresse ?? '—' }}<br>
                Tél : {{ $institut->telephone ?? '—' }}<br>
                Email : {{ $institut->email ?? '—' }}
            </div>
        </div>
    </div>
    <div class="pcol">
        <div class="pbox right">
            <div class="ptitle">Client</div>
            <div class="pname">{{ $facture->client->fullName() }}</div>
            <div class="pinfo">
                {{ $facture->client->email }}<br>
                Tél : {{ $facture->client->telephone ?? '—' }}
            </div>
        </div>
    </div>
</div>

{{-- RDV DETAILS --}}
@if($facture->estDeRdv() && isset($rdv))
    <div class="sec-wrap">
        <div class="sec-title">Détail du rendez-vous</div>
    </div>
    <div class="tw">
        <div class="tbox">
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Esthéticienne</th>
                        <th>Date &amp; Heure</th>
                        <th>Prix (DA)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rdv->services as $service)
                        <tr>
                            <td>
                                <div class="svc-name">{{ $service->nom }}</div>
                                <div class="svc-sub">Durée : {{ $service->duree }} min</div>
                            </td>
                            <td>{{ $rdv->estheticienne->fullName() }}</td>
                            <td>{{ $rdv->date_debut->format('d/m/Y H:i') }}</td>
                            <td class="price">{{ number_format($service->pivot->prix_au_moment,0,',',' ') }} DA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

{{-- COMMANDE DETAILS --}}
@if($facture->estDeCommande() && isset($commande))
    <div class="sec-wrap">
        <div class="sec-title">Détail de la commande &mdash; {{ $commande->numero }}</div>
    </div>
    <div class="tw">
        <div class="tbox">
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th class="tc">Qté</th>
                        <th class="tr">Prix unitaire (DA)</th>
                        <th>Total (DA)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->produits as $produit)
                        <tr>
                            <td><div class="svc-name">{{ $produit->nom }}</div></td>
                            <td class="tc">{{ $produit->pivot->quantite }}</td>
                            <td class="tr muted">{{ number_format($produit->pivot->prix_au_moment,0,',',' ') }}</td>
                            <td class="price">{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite,0,',',' ') }} DA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($commande->codePromo)
        <div class="pw">
            <div class="pbox-promo">
                Code promotionnel <strong>{{ $commande->codePromo->code }}</strong> appliqué —
                Réduction : <strong>{{ number_format($commande->reductionAppliquee(),0,',',' ') }} DA</strong>
            </div>
        </div>
    @endif
@endif

{{-- TOTALS --}}
<div class="totw">
    <div class="totcard">
        <div class="trow light">
            <div class="tlabel">Montant HT</div>
            <div class="tvalue">{{ number_format($facture->montant_ht,0,',',' ') }} DA</div>
        </div>
        <div class="trow soft">
            <div class="tlabel">TVA ({{ number_format($facture->taux_tva,0) }}%)</div>
            <div class="tvalue">{{ number_format($facture->montant_tva,0,',',' ') }} DA</div>
        </div>
        <div class="trow final">
            <div class="tlabel">TOTAL TTC</div>
            <div class="tvalue">{{ number_format($facture->montant_ttc,0,',',' ') }} DA</div>
        </div>
    </div>
</div>

{{-- THANK YOU --}}
<div class="thkw">
    <div class="thkbox">
        <div class="thk-title">Merci pour votre confiance 💜</div>
        <div class="thk-sub">
            Cette facture a été générée automatiquement par {{ $institut->nom ?? 'Glow Institute' }}.<br>
            Pour toute assistance, contactez-nous à {{ $institut->email ?? '' }}
        </div>
    </div>
</div>

{{-- FOOTER --}}
<div class="footer">
    <div class="fl">{{ $institut->nom ?? 'Glow Institute' }} &nbsp;&bull;&nbsp; {{ $institut->adresse ?? '' }}</div>
    <div class="fr">Généré le {{ now()->format('d/m/Y H:i') }} &nbsp;&middot;&nbsp; <span>Document confidentiel</span></div>
</div>

</div>
</body>
</html>