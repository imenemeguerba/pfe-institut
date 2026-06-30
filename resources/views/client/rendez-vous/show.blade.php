<x-app-layout>
<x-slot name="header">Appointment Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* HERO */
.rdvs-hero {
    position:relative; overflow:hidden; padding:56px 10% 90px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.rdvs-hero-pattern {
    position:absolute; inset:0;
    background-image:radial-gradient(circle at 20% 50%, rgba(180,128,255,0.15) 0%, transparent 50%),
                     radial-gradient(circle at 80% 20%, rgba(211,170,149,0.1) 0%, transparent 40%);
}
.rdvs-hero-content { position:relative; z-index:2; display:flex; align-items:flex-start; justify-content:space-between; gap:24px; flex-wrap:wrap; }
.rdvs-back {
    display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border-radius:20px;
    background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35);
    color:white; font-size:12px; font-weight:600; text-decoration:none;
    transition:all 0.2s; margin-bottom:16px;
}
.rdvs-back:hover { background:rgba(255,255,255,0.3); }
.rdvs-id { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.75); margin-bottom:8px; }
.rdvs-date {
    font-family:'Playfair Display',serif;
    font-size:32px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:8px; text-transform:capitalize; line-height:1.2;
}
.rdvs-time { font-size:14px; color:rgba(255,255,255,0.85); display:flex; align-items:center; gap:6px; }
.rdvs-time i { color:rgba(255,255,255,0.7); }
.rdvs-wave {
    position:absolute; bottom:-2px; left:0; right:0; height:60px;
    background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23faf8ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom;
    background-size:cover;
}

/* ── BODY ── */
.rdvs-body { max-width:860px; margin:0 auto; padding:32px 24px 80px; }
.rdvs-grid { display:grid; grid-template-columns:1fr 300px; gap:20px; align-items:start; }

/* SECTION CARD */
.rdvs-card {
    background:white; border-radius:24px; padding:24px;
    border:1px solid #ede9fe; margin-bottom:18px;
    box-shadow:0 4px 20px rgba(180,128,255,0.06);
    transition:all 0.3s;
    opacity:0; animation:fadeUp 0.5s forwards;
}
.rdvs-card:nth-child(1){ animation-delay:0.05s; }
.rdvs-card:nth-child(2){ animation-delay:0.1s; }
.rdvs-card:nth-child(3){ animation-delay:0.15s; }
.rdvs-card:nth-child(4){ animation-delay:0.2s; }
.rdvs-card:nth-child(5){ animation-delay:0.25s; }
.rdvs-card:hover { box-shadow:0 12px 40px rgba(180,128,255,0.1); transform:translateY(-2px); }
@keyframes fadeUp { from{ opacity:0; transform:translateY(16px); } to{ opacity:1; transform:translateY(0); } }

.rdvs-card-title { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:10px; }
.rdvs-card-icon { width:32px; height:32px; border-radius:9px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0; }

/* ESTHE ROW */
.esthe-row { display:flex; align-items:center; gap:14px; padding:14px 16px; background:#fdf9ff; border-radius:14px; border:1px solid #ede9fe; }
.esthe-av-big { width:50px; height:50px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:18px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.esthe-name-big { font-size:15px; font-weight:700; color:#1a1a2e; }
.esthe-info { font-size:12px; color:#9ca3af; margin-top:3px; }

/* INFO GRID */
.rdvs-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:18px; }
.rdvs-info-item { background:#fdf9ff; border-radius:12px; padding:12px 14px; border:1px solid #ede9fe; }
.rdvs-info-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#c4b5fd; margin-bottom:4px; }
.rdvs-info-value { font-size:13px; font-weight:700; color:#1a1a2e; }

/* SERVICES LIST */
.svc-item { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; background:#fdf9ff; border-radius:12px; border:1px solid #ede9fe; margin-bottom:8px; }
.svc-item:last-child { margin-bottom:0; }
.svc-item-name { font-size:13px; font-weight:600; color:#1a1a2e; }
.svc-item-price { font-size:14px; font-weight:800; color:#b480ff; }
.svc-total { display:flex; justify-content:space-between; align-items:center; padding-top:14px; margin-top:10px; border-top:1px solid #ede9fe; }
.svc-total-label { font-size:14px; font-weight:700; color:#1a1a2e; }
.svc-total-value { font-size:22px; font-weight:900; color:#b480ff; }
.promo-badge { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2); color:#059669; padding:6px 14px; border-radius:10px; font-size:12px; font-weight:600; display:inline-flex; align-items:center; gap:6px; margin-top:8px; }

/* NOTE BOX */
.note-box { background:#fdf9ff; border-radius:12px; padding:14px 16px; font-size:13px; color:#374151; border-left:3px solid rgba(180,128,255,0.3); line-height:1.7; }
.motif-box { border-radius:12px; padding:14px 16px; font-size:13px; line-height:1.7; }
.motif-box.red    { background:rgba(239,68,68,0.04); border:1px solid rgba(239,68,68,0.15); border-left:3px solid #ef4444; color:#991b1b; }
.motif-box.orange { background:rgba(249,115,22,0.04); border:1px solid rgba(249,115,22,0.15); border-left:3px solid #f97316; color:#9a3412; }

/* GROUP BADGE */
.group-badge { background:rgba(37,99,235,0.06); border:1px solid rgba(37,99,235,0.15); border-left:3px solid #2563eb; border-radius:12px; padding:12px 16px; margin-bottom:18px; font-size:13px; color:#1e40af; display:flex; align-items:center; gap:8px; }

/* OTHER RDVS IN GROUP */
.other-rdv { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; background:#fdf9ff; border-radius:12px; border:1px solid rgba(180,128,255,0.1); margin-bottom:8px; flex-wrap:wrap; gap:8px; }
.other-rdv-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; padding:5px 12px; border-radius:20px; background:rgba(180,128,255,0.08); }
.other-rdv-link:hover { background:#b480ff; color:white; }

/* STICKY SIDEBAR */
.rdvs-sticky { position:sticky; top:90px; }
.rdvs-action-card {
    background:white; border-radius:24px; padding:22px;
    border:1px solid #ede9fe; box-shadow:0 8px 30px rgba(180,128,255,0.1);
    margin-bottom:14px;
    opacity:0; animation:fadeUp 0.5s 0.2s forwards;
}
.rdvs-action-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; }
.rdvs-timeline { }
.rdvs-timeline-item { display:flex; gap:12px; margin-bottom:14px; }
.rdvs-timeline-item:last-child { margin-bottom:0; }
.rdvs-timeline-dot { width:10px; height:10px; border-radius:50%; background:#b480ff; margin-top:4px; flex-shrink:0; position:relative; }
.rdvs-timeline-dot::after { content:''; position:absolute; top:10px; left:4px; width:2px; height:calc(100% + 4px); background:rgba(180,128,255,0.2); }
.rdvs-timeline-item:last-child .rdvs-timeline-dot::after { display:none; }
.rdvs-timeline-text { font-size:12px; color:#6b7280; line-height:1.6; }
.rdvs-timeline-text strong { color:#1a1a2e; display:block; font-size:13px; }

.rdvs-cancel-card {
    background:white; border-radius:24px; padding:20px 22px;
    border:1.5px solid rgba(239,68,68,0.15);
    opacity:0; animation:fadeUp 0.5s 0.3s forwards;
}
.btn-cancel-full {
    width:100%; padding:12px; border-radius:30px;
    background:rgba(239,68,68,0.06); color:#ef4444;
    font-size:14px; font-weight:700; border:1.5px solid rgba(239,68,68,0.2);
    cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif;
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:all 0.2s;
}
.btn-cancel-full:hover { background:rgba(239,68,68,0.12); }

/* REVIEW CARD */
.rdvs-review-card {
    background:white; border-radius:24px; padding:22px;
    border:1.5px solid rgba(245,158,11,0.2);
    box-shadow:0 4px 20px rgba(245,158,11,0.08);
    opacity:0; animation:fadeUp 0.5s 0.35s forwards;
}
.rdvs-review-title { font-size:14px; font-weight:800; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.rdvs-review-title i { color:#f59e0b; }
.stars-display { display:flex; gap:3px; }
.star-filled { color:#f59e0b; font-size:16px; }
.star-empty  { color:#e5e7eb; font-size:16px; }
.btn-review {
    display:flex; align-items:center; justify-content:center; gap:8px;
    padding:12px; border-radius:30px;
    background:linear-gradient(to right,#f59e0b,#d97706);
    color:white; font-size:14px; font-weight:700; text-decoration:none;
    transition:all 0.2s; box-shadow:0 4px 14px rgba(245,158,11,0.3);
    margin-top:12px;
}
.btn-review:hover { transform:translateY(-1px); box-shadow:0 8px 20px rgba(245,158,11,0.4); }
.review-status { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:20px; font-size:12px; font-weight:600; background:rgba(16,185,129,0.1); color:#059669; margin-top:8px; }

@media(max-width:800px){ .rdvs-grid{ grid-template-columns:1fr; } .rdvs-sticky{ position:static; } .rdvs-info-grid{ grid-template-columns:1fr; } }
</style>

{{-- HERO --}}
<div class="rdvs-hero">
    <div class="rdvs-hero-pattern"></div>
    <div class="rdvs-hero-content">
        <div>
            <a href="{{ route('client.rendez-vous.index') }}" class="rdvs-back">
                <i class="fa-solid fa-arrow-left"></i> My Appointments
            </a>
            <div class="rdvs-id">Appointment #{{ $rendezVous->id }}</div>
            <div class="rdvs-date">{{ $rendezVous->date_debut->isoFormat('dddd D MMMM YYYY') }}</div>
            <div class="rdvs-time">
                <i class="fa-regular fa-clock"></i>
                {{ $rendezVous->date_debut->format('H:i') }} → {{ $rendezVous->date_fin->format('H:i') }}
                <span style="margin-left:8px;padding:2px 10px;border-radius:20px;background:rgba(255,255,255,0.2);font-size:11px;color:white;">
                    {{ $rendezVous->duree_totale }} min
                </span>
            </div>
        </div>
        <div style="padding-top:40px;">
            @include('client.rendez-vous._statut_badge', ['statut'=>$rendezVous->statut])
        </div>
    </div>
    <div class="rdvs-wave"></div>
</div>

<div class="rdvs-body">

    {{-- GROUP BADGE --}}
    @if($rendezVous->groupe_reservation)
        <div class="group-badge">
            <i class="fa-solid fa-link"></i>
            This appointment is part of a group booking split between multiple experts.
        </div>
    @endif

    <div class="rdvs-grid">

        {{-- LEFT --}}
        <div>

            {{-- EXPERT --}}
            <div class="rdvs-card">
                <div class="rdvs-card-title">
                    <div class="rdvs-card-icon"><i class="fa-solid fa-user-nurse"></i></div>
                    Your Expert
                </div>
                <div class="esthe-row">
                    <div class="esthe-av-big">{{ strtoupper(substr($rendezVous->estheticienne->prenom,0,1)) }}</div>
                    <div>
                        <div class="esthe-name-big">{{ $rendezVous->estheticienne->fullName() }}</div>
                        <div class="esthe-info">
                            @if($rendezVous->estheticienne->experience) {{ $rendezVous->estheticienne->experience }} yr(s) experience @endif
                            @if($rendezVous->estheticienne->telephone) · {{ $rendezVous->estheticienne->telephone }} @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERVICES & PRICE --}}
            <div class="rdvs-card">
                <div class="rdvs-card-title">
                    <div class="rdvs-card-icon"><i class="fa-solid fa-spa"></i></div>
                    Services & Pricing
                </div>
                @foreach($rendezVous->services as $svc)
                    <div class="svc-item">
                        <div>
                            <div class="svc-item-name">{{ $svc->nom }}</div>
                            <div style="font-size:11px;color:#9ca3af;">{{ $svc->pivot->duree_au_moment }} min</div>
                        </div>
                        <div class="svc-item-price">{{ number_format($svc->pivot->prix_au_moment,0,',',' ') }} DA</div>
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
                    <div class="promo-badge">
                        <i class="fa-solid fa-tag"></i> Promo code applied — {{ number_format($reduction,0,',',' ') }} DA saved!
                    </div>
                @endif
                @if($montantFidelite > 0)
                    <div class="promo-badge">
                        <i class="fa-solid fa-medal"></i> Loyalty discount ({{ $reductionFideliteAffichage }}%) — {{ number_format($montantFidelite,0,',',' ') }} DA saved!
                    </div>
                @endif
                <div class="svc-total" style="border-top:none; padding-top:0; margin-top:8px;">
                    <div style="font-size:13px; color:#6b7280;">Amount excl. VAT</div>
                    <div style="font-size:13px; font-weight:700; color:#1a1a2e;">{{ number_format($montantHT,0,',',' ') }} DA</div>
                </div>
                <div class="svc-total" style="border-top:none; padding-top:0; margin-top:4px;">
                    <div style="font-size:13px; color:#6b7280;">VAT ({{ number_format($tauxTva,0) }}%)</div>
                    <div style="font-size:13px; font-weight:700; color:#1a1a2e;">{{ number_format($montantTva,0,',',' ') }} DA</div>
                </div>
                <div class="svc-total">
                    <div class="svc-total-label">Total</div>
                    <div class="svc-total-value">{{ number_format($totalTTC,0,',',' ') }} DA</div>
                </div>
            </div>

            {{-- NOTES --}}
            @if($rendezVous->notes)
            <div class="rdvs-card">
                <div class="rdvs-card-title">
                    <div class="rdvs-card-icon"><i class="fa-solid fa-note-sticky"></i></div>
                    Your Note
                </div>
                <div class="note-box">{{ $rendezVous->notes }}</div>
            </div>
            @endif

            {{-- MOTIF REFUS --}}
            @if($rendezVous->motif_refus)
            <div class="rdvs-card">
                <div class="rdvs-card-title">
                    <div class="rdvs-card-icon" style="background:rgba(239,68,68,0.1);color:#ef4444;"><i class="fa-solid fa-circle-xmark"></i></div>
                    Reason
                </div>
                <div class="motif-box red">{{ $rendezVous->motif_refus }}</div>
            </div>
            @endif

            {{-- AUTRES RDVs GROUPE --}}
            @if($rdvsGroupe && $rdvsGroupe->isNotEmpty())
            <div class="rdvs-card">
                <div class="rdvs-card-title">
                    <div class="rdvs-card-icon"><i class="fa-solid fa-link"></i></div>
                    Other Appointments in this Booking
                </div>
                @foreach($rdvsGroupe as $autre)
                    <div class="other-rdv">
                        <div>
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:5px;">
                                <div style="width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,#b480ff,#d3aa95);color:white;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center;">{{ strtoupper(substr($autre->estheticienne->prenom,0,1)) }}</div>
                                <span style="font-size:13px;font-weight:700;color:#1a1a2e;">{{ $autre->estheticienne->fullName() }}</span>
                                <span style="font-size:11px;color:#9ca3af;">{{ $autre->date_debut->format('H:i') }} → {{ $autre->date_fin->format('H:i') }}</span>
                            </div>
                            <div style="display:flex;gap:5px;flex-wrap:wrap;">
                                @foreach($autre->services as $s)
                                    <span style="font-size:10px;padding:2px 8px;border-radius:20px;background:rgba(180,128,255,0.08);color:#b480ff;">{{ $s->nom }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;">
                            @include('client.rendez-vous._statut_badge', ['statut'=>$autre->statut])
                            <a href="{{ route('client.rendez-vous.show', $autre) }}" class="other-rdv-link">
                                <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="rdvs-sticky">

            {{-- INFO CARD --}}
            <div class="rdvs-action-card">
                <div class="rdvs-action-title">Booking Info</div>
                <div class="rdvs-timeline">
                    <div class="rdvs-timeline-item">
                        <div class="rdvs-timeline-dot"></div>
                        <div class="rdvs-timeline-text">
                            <strong>Date & Time</strong>
                            {{ $rendezVous->date_debut->format('d/m/Y') }} · {{ $rendezVous->date_debut->format('H:i') }}
                        </div>
                    </div>
                    <div class="rdvs-timeline-item">
                        <div class="rdvs-timeline-dot"></div>
                        <div class="rdvs-timeline-text">
                            <strong>Duration</strong>
                            {{ $rendezVous->duree_totale }} minutes
                        </div>
                    </div>
                    <div class="rdvs-timeline-item">
                        <div class="rdvs-timeline-dot"></div>
                        <div class="rdvs-timeline-text">
                            <strong>Expert</strong>
                            {{ $rendezVous->estheticienne->fullName() }}
                        </div>
                    </div>
                    <div class="rdvs-timeline-item">
                        <div class="rdvs-timeline-dot"></div>
                        <div class="rdvs-timeline-text">
                            <strong>Total Price</strong>
                            {{ number_format($totalTTC,0,',',' ') }} DA
                        </div>
                    </div>
                    <div class="rdvs-timeline-item">
                        <div class="rdvs-timeline-dot" style="background:{{ match($rendezVous->statut){ 'confirme'=>'#10b981','termine'=>'#2563eb','annule','refuse'=>'#ef4444',default=>'#b480ff' } }};"></div>
                        <div class="rdvs-timeline-text">
                            <strong>Status</strong>
                            {{ ['en_attente'=>'Pending','confirme'=>'Confirmed','termine'=>'Completed','annule'=>'Cancelled','refuse'=>'Refused'][$rendezVous->statut] ?? $rendezVous->statut }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- CANCEL --}}
            @if(in_array($rendezVous->statut,['en_attente','confirme']) && $rendezVous->date_debut->isFuture())
            <div class="rdvs-cancel-card">
                <div style="font-size:13px;color:#9ca3af;margin-bottom:12px;line-height:1.6;">
                    Need to cancel? Please do so as early as possible.
                </div>
                <form action="{{ route('client.rendez-vous.annuler', $rendezVous) }}" method="POST" id="cancelRdvForm">
                    @csrf @method('PATCH')
                    <button type="button" class="btn-cancel-full"
                        onclick="glowConfirm(
                            '{{ $rendezVous->groupe_reservation ? 'Cancel entire group booking?' : 'Cancel this appointment?' }}',
                            '{{ $rendezVous->groupe_reservation ? 'All appointments in this group will be cancelled.' : 'This appointment will be cancelled.' }}',
                            '{{ $rendezVous->groupe_reservation ? 'Cancel All' : 'Yes, cancel' }}',
                            'fa-xmark', 'red',
                            function(){ document.getElementById('cancelRdvForm').submit(); }
                        )">
                        <i class="fa-solid fa-xmark"></i>
                        {{ $rendezVous->groupe_reservation ? 'Cancel Entire Booking' : 'Cancel Appointment' }}
                    </button>
                </form>
            </div>
            @endif

            {{-- REVIEW --}}
            @if($rendezVous->statut === 'termine')
                @php
                    $avisExistant = \App\Models\Avis::where('client_id', auth()->id())
                        ->where('rendez_vous_id', $rendezVous->id)
                        ->where('type', 'estheticienne')
                        ->first();
                @endphp
                <div class="rdvs-review-card">
                    <div class="rdvs-review-title">
                        <i class="fa-solid fa-star"></i> Leave a Review
                    </div>
                    @if($avisExistant)
                        <div style="font-size:13px;color:#374151;margin-bottom:8px;">You have already reviewed this appointment.</div>
                        <div class="stars-display">
                            @for($i=1;$i<=5;$i++)
                                <span class="{{ $i<=$avisExistant->note?'star-filled':'star-empty' }}">★</span>
                            @endfor
                        </div>
                        <div class="review-status">
                            @if($avisExistant->statut==='publie')
                                <i class="fa-solid fa-check"></i> Published
                            @else
                                <i class="fa-solid fa-clock"></i> {{ ucfirst($avisExistant->statut) }}
                            @endif
                        </div>
                    @else
                        <div style="font-size:13px;color:#6b7280;margin-bottom:4px;line-height:1.6;">Share your experience with this expert!</div>
                        <a href="{{ route('client.avis.create-esthe', $rendezVous) }}" class="btn-review">
                            <i class="fa-solid fa-star"></i> Write a Review
                        </a>
                    @endif
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
