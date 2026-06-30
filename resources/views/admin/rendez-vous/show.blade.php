<x-app-layout>
<x-slot name="header">Appointment Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:760px; margin:0 auto; }

.show-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.show-top h1 { font-size:17px; font-weight:800; color:#1a1a2e; }
.btn-back { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }

.grouped-notice { background:rgba(180,128,255,0.06); border:1px solid rgba(180,128,255,0.2); border-left:3px solid #b480ff; border-radius:12px; padding:12px 16px; margin-bottom:14px; font-size:13px; color:#7c3aed; font-weight:500; }

.card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:20px 24px; margin-bottom:14px; }
.card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.card-title i { color:#b480ff; }

.rdv-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:18px; flex-wrap:wrap; }
.rdv-date-day  { font-size:18px; font-weight:800; color:#1a1a2e; text-transform:capitalize; margin-bottom:4px; }
.rdv-date-time { font-size:14px; color:#6b7280; }
.rdv-status { font-size:11px; font-weight:600; padding:5px 14px; border-radius:20px; display:inline-block; flex-shrink:0; }
.rdv-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.rdv-status.confirme   { background:rgba(16,185,129,0.1); color:#059669; }
.rdv-status.termine    { background:rgba(96,165,250,0.1); color:#2563eb; }
.rdv-status.annule     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-status.refuse     { background:rgba(239,68,68,0.1); color:#ef4444; }
.rdv-status.reporte    { background:rgba(234,179,8,0.1); color:#ca8a04; }

.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; padding-top:16px; border-top:1px solid #f0ebff; }
.fi-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:4px; }
.fi-value { font-size:13px; font-weight:600; color:#1a1a2e; }
.fi-sub   { font-size:11px; color:#9ca3af; margin-top:1px; }
.fi-link  { color:#b480ff; text-decoration:none; }
.fi-link:hover { color:#9333ea; }

.service-row { display:flex; align-items:center; justify-content:space-between; padding:10px 14px; border-radius:10px; background:#fdf9ff; border:1px solid #ede9fe; margin-bottom:8px; }
.service-row:last-child { margin-bottom:0; }
.service-name  { font-size:13px; font-weight:500; color:#374151; }
.service-price { font-size:13px; font-weight:700; color:#b480ff; }
.promo-box { background:rgba(16,185,129,0.06); border:1px solid rgba(16,185,129,0.2); border-radius:10px; padding:10px 14px; margin-top:10px; font-size:13px; color:#059669; }
.total-row { display:flex; justify-content:space-between; align-items:center; padding-top:14px; margin-top:12px; border-top:1px solid #ede9fe; }
.total-label  { font-size:14px; font-weight:700; color:#1a1a2e; }
.total-amount { font-size:22px; font-weight:800; color:#b480ff; }

.groupe-item { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; border-radius:12px; background:rgba(180,128,255,0.04); border:1px solid #ede9fe; margin-bottom:8px; gap:12px; flex-wrap:wrap; }
.groupe-item:last-child { margin-bottom:0; }
.groupe-name  { font-size:13px; font-weight:600; color:#1a1a2e; }
.groupe-time  { font-size:11px; color:#9ca3af; margin-top:2px; }
.groupe-tags  { display:flex; flex-wrap:wrap; gap:4px; margin-top:4px; }
.groupe-tag   { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.groupe-link  { font-size:11px; color:#b480ff; text-decoration:none; font-weight:600; white-space:nowrap; }

.note-box { background:#fdf9ff; border-radius:10px; padding:12px 14px; font-size:13px; color:#374151; line-height:1.6; border-left:3px solid rgba(180,128,255,0.3); }
.note-box.danger { background:#fff5f5; border-left-color:#ef4444; color:#991b1b; }
</style>

<div class="show-wrap">
<div class="show-inner">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    <div class="show-top">
        <h1>Appointment Details</h1>
        <a href="{{ route('admin.rendez-vous.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    @if($rendezVous->groupe_reservation)
        <div class="grouped-notice">
            <i class="fa-solid fa-link"></i> This appointment is part of a group booking split between multiple experts.
        </div>
    @endif

    {{-- MAIN INFO --}}
    <div class="card">
        <div class="rdv-header">
            <div>
                <div class="rdv-date-day">{{ $rendezVous->date_debut->isoFormat('dddd D MMMM YYYY') }}</div>
                <div class="rdv-date-time">
                    <i class="fa-regular fa-clock" style="font-size:11px;"></i>
                    {{ $rendezVous->date_debut->format('H:i') }} → {{ $rendezVous->date_fin->format('H:i') }}
                </div>
            </div>
            <span class="rdv-status {{ $rendezVous->statut }}">
                {{ ['en_attente'=>'Pending','confirme'=>'Confirmed','termine'=>'Done','annule'=>'Cancelled','refuse'=>'Refused','reporte'=>'Rescheduled'][$rendezVous->statut] ?? $rendezVous->statut }}
            </span>
        </div>
        <div class="info-grid">
            <div>
                <div class="fi-label">Client</div>
                <div class="fi-value"><a href="{{ route('admin.clients.show', $rendezVous->client) }}" class="fi-link">{{ $rendezVous->client->fullName() }}</a></div>
                <div class="fi-sub">{{ $rendezVous->client->email }}</div>
            </div>
            <div>
                <div class="fi-label">Expert</div>
                <div class="fi-value"><a href="{{ route('admin.estheticiennes.show', $rendezVous->estheticienne) }}" class="fi-link">{{ $rendezVous->estheticienne->fullName() }}</a></div>
                <div class="fi-sub">{{ $rendezVous->estheticienne->telephone ?? '—' }}</div>
            </div>
            <div>
                <div class="fi-label">Total Duration</div>
                <div class="fi-value">{{ $rendezVous->duree_totale }} min</div>
            </div>
            <div>
                <div class="fi-label">Created</div>
                <div class="fi-value">{{ $rendezVous->created_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>
    </div>

    {{-- SERVICES --}}
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-spa"></i> Services</div>
        @foreach($rendezVous->services as $service)
            <div class="service-row">
                <div class="service-name">{{ $service->nom }}</div>
                <div class="service-price">{{ number_format($service->pivot->prix_au_moment, 0, ',', ' ') }} DA</div>
            </div>
        @endforeach
        @php
            $reduction = $rendezVous->prix_original - $rendezVous->prix_final;
            $reductionFideliteAffichage = \App\Services\FideliteService::reductionPourcent($rendezVous->client);
            $montantFidelite = (int) round($rendezVous->prix_final * $reductionFideliteAffichage / 100);
            $montantHT = $rendezVous->prix_final - $montantFidelite;
            $tauxTva = (float) (\App\Models\Institut::instance()->taux_tva ?? 19.00);
            $montantTva = (int) round($montantHT * $tauxTva / 100);
            $totalTTC = $montantHT + $montantTva;
        @endphp
        @if($reduction > 0)
            <div class="promo-box">
                <i class="fa-solid fa-tag"></i>
                Promo code <strong>{{ $rendezVous->codePromo?->code }}</strong> : -{{ number_format($reduction, 0, ',', ' ') }} DA
            </div>
        @endif
        @if($montantFidelite > 0)
            <div class="promo-box">
                <i class="fa-solid fa-medal"></i>
                Loyalty discount ({{ $reductionFideliteAffichage }}%) : -{{ number_format($montantFidelite, 0, ',', ' ') }} DA
            </div>
        @endif
        <div class="total-row" style="border-top:none; padding-top:0; margin-top:8px;">
            <div style="font-size:13px; color:#6b7280;">Amount excl. VAT</div>
            <div style="font-size:13px; font-weight:700; color:#1a1a2e;">{{ number_format($montantHT, 0, ',', ' ') }} DA</div>
        </div>
        <div class="total-row" style="border-top:none; padding-top:0; margin-top:4px;">
            <div style="font-size:13px; color:#6b7280;">VAT ({{ number_format($tauxTva, 0) }}%)</div>
            <div style="font-size:13px; font-weight:700; color:#1a1a2e;">{{ number_format($montantTva, 0, ',', ' ') }} DA</div>
        </div>
        <div class="total-row">
            <div class="total-label">Total Paid</div>
            <div class="total-amount">{{ number_format($totalTTC, 0, ',', ' ') }} DA</div>
        </div>
    </div>

    {{-- GROUPE --}}
    @if($rdvsGroupe && $rdvsGroupe->isNotEmpty())
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-link"></i> Other appointments in this booking</div>
            @foreach($rdvsGroupe as $autre)
                <div class="groupe-item">
                    <div>
                        <div class="groupe-name">{{ $autre->estheticienne->fullName() }}</div>
                        <div class="groupe-time">{{ $autre->date_debut->format('H:i') }} → {{ $autre->date_fin->format('H:i') }}</div>
                        <div class="groupe-tags">
                            @foreach($autre->services as $s)
                                <span class="groupe-tag">{{ $s->nom }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">
                        <span class="rdv-status {{ $autre->statut }}" style="font-size:10px;">
                            {{ ['en_attente'=>'Pending','confirme'=>'Confirmed','termine'=>'Done','annule'=>'Cancelled'][$autre->statut] ?? $autre->statut }}
                        </span>
                        <a href="{{ route('admin.rendez-vous.show', $autre) }}" class="groupe-link">View →</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($rendezVous->notes)
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-note-sticky"></i> Client Note</div>
            <div class="note-box">{{ $rendezVous->notes }}</div>
        </div>
    @endif
    @if($rendezVous->motif_refus)
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-circle-xmark"></i> Refusal / Cancellation Reason</div>
            <div class="note-box danger">{{ $rendezVous->motif_refus }}</div>
        </div>
    @endif
    @if($rendezVous->motif_report)
        <div class="card">
            <div class="card-title"><i class="fa-solid fa-calendar-xmark"></i> Rescheduling Reason</div>
            <div class="note-box">{{ $rendezVous->motif_report }}</div>
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
