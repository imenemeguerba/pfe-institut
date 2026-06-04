<x-app-layout>
<x-slot name="header">{{ $service->nom }}</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.svs-hero {
    position:relative; height:360px; overflow:hidden;
    margin:-32px -24px 0;
}
.svs-hero-img {
    width:100%; height:100%; object-fit:cover;
    animation:heroZoom 8s ease-in-out infinite alternate;
}
.svs-hero-placeholder {
    width:100%; height:100%;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    display:flex; align-items:center; justify-content:center; font-size:100px;
}
@keyframes heroZoom { from{transform:scale(1);} to{transform:scale(1.05);} }
.svs-hero-overlay {
    position:absolute; inset:0;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    opacity:0.85;
}
.svs-hero-content {
    position:absolute; bottom:80px; left:0; right:0; padding:0 5%;
    z-index:2;
}
.svs-back {
    display:inline-flex; align-items:center; gap:6px; font-size:12px; font-weight:600;
    color:rgba(255,255,255,0.85); text-decoration:none; margin-bottom:16px;
    padding:6px 14px; border-radius:20px; background:rgba(255,255,255,0.15);
    backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.2); transition:all 0.2s;
}
.svs-back:hover { background:rgba(255,255,255,0.25); color:white; }
.svs-cat-tag {
    display:inline-block; padding:4px 14px; border-radius:20px;
    background:rgba(180,128,255,0.4); border:1px solid rgba(180,128,255,0.5);
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px;
    color:#e9d8fd; margin-bottom:12px;
}
.svs-title {
    font-family:'Playfair Display',serif;
    font-size:36px; font-weight:800; color:white; line-height:1.2; margin-bottom:10px;
}
.svs-rating-row { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.svs-stars span { font-size:18px; }
.svs-star-f { color:#f59e0b; }
.svs-star-e { color:rgba(255,255,255,0.3); }
.svs-rating-text { font-size:13px; color:rgba(255,255,255,0.8); }

/* FLOATING CARD */
.svs-float-card {
    position:absolute; bottom:-24px; right:5%; z-index:10;
    background:white; border-radius:16px; padding:20px 24px;
    box-shadow:0 20px 60px rgba(180,128,255,0.2);
    border:1px solid #ede9fe;
    display:flex;
     align-items:center; gap:20px;
    animation:slideUp 0.6s ease forwards; opacity:0;
}
.svs-float-price { text-align:center; }
.svs-float-price-val { font-size:24px; font-weight:900; color:#b480ff; display:block; }
.svs-float-price-lbl { font-size:10px; color:#c4b5fd; text-transform:uppercase; letter-spacing:0.5px; }
.svs-float-sep { width:1px; height:40px; background:#ede9fe; }
.svs-float-dur { text-align:center; }
.svs-float-dur-val { font-size:18px; font-weight:700; color:#1a1a2e; display:block; }
.svs-float-dur-lbl { font-size:10px; color:#9ca3af; text-transform:uppercase; }
@keyframes slideUp { from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }

.svs-float-item { flex:1; text-align:center; padding:0 20px; }
.svs-float-item:not(:last-child) { border-right:1px solid #ede9fe; }
.svs-float-val { font-size:16px; font-weight:800; color:#b480ff; display:block; margin-bottom:2px; }
.svs-float-lbl { font-size:10px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; }

.svs-book-btn {
    flex-shrink:0; margin-left:24px;
    display:inline-flex; align-items:center; gap:8px; padding:12px 24px;
    border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95);
    color:white; font-size:14px; font-weight:700; text-decoration:none;
    transition:all 0.2s; white-space:nowrap;
    box-shadow:0 6px 20px rgba(180,128,255,0.35);
}
.svs-book-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }

/* ── BODY ── */
.svs-body { max-width:1100px; margin:0 auto; padding:60px 24px 80px; }
.svs-grid { display:grid; grid-template-columns:1fr 360px; gap:32px; align-items:start; }

/* SECTION CARD */
.svs-card {
    background:white; border-radius:24px; padding:28px;
    border:1px solid #ede9fe; margin-bottom:24px;
    box-shadow:0 4px 20px rgba(180,128,255,0.06);
    opacity:0; animation:fadeUp 0.6s forwards;
}
.svs-card:nth-child(1){ animation-delay:0.1s; }
.svs-card:nth-child(2){ animation-delay:0.2s; }
.svs-card:nth-child(3){ animation-delay:0.3s; }
.svs-card:nth-child(4){ animation-delay:0.4s; }
@keyframes fadeUp { from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }

.svs-section-title {
    font-size:15px; font-weight:800; color:#1a1a2e;
    margin-bottom:18px; display:flex; align-items:center; gap:10px;
}
.svs-section-icon {
    width:32px; height:32px; border-radius:9px;
    background:rgba(180,128,255,0.1); color:#b480ff;
    display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0;
}
.svs-desc { font-size:14px; color:#6b7280; line-height:1.9; }

/* EXPERTS */
.esthe-card {
    display:flex; align-items:center; gap:14px; padding:14px 16px;
    background:#fdf9ff; border-radius:14px; border:1px solid #ede9fe;
    margin-bottom:10px; transition:all 0.2s; text-decoration:none;
}
.esthe-card:last-child { margin-bottom:0; }
.esthe-card:hover { border-color:#b480ff; background:rgba(180,128,255,0.04); transform:translateX(4px); }
.esthe-av {
    width:46px; height:46px; border-radius:50%; flex-shrink:0;
    background:linear-gradient(135deg,#b480ff,#d3aa95);
    color:white; font-size:16px; font-weight:700;
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 4px 12px rgba(180,128,255,0.3);
}
.esthe-av img { width:100%; height:100%; border-radius:50%; object-fit:cover; }
.esthe-info { flex:1; }
.esthe-name { font-size:14px; font-weight:700; color:#1a1a2e; }
.esthe-exp  { font-size:11px; color:#9ca3af; margin-top:2px; }
.esthe-spec { font-size:11px; color:#6b7280; margin-top:3px; font-style:italic; }
.esthe-actions { display:flex; gap:8px; flex-shrink:0; }
.esthe-btn {
    padding:7px 14px; border-radius:20px;
    font-size:11px; font-weight:600; text-decoration:none; flex-shrink:0;
    border:1.5px solid; transition:all 0.2s; display:inline-flex; align-items:center; gap:4px;
}
.esthe-btn-profile { color:#6b7280; border-color:#ede9fe; background:white; }
.esthe-btn-profile:hover { border-color:#b480ff; color:#b480ff; }
.esthe-btn-book { color:#b480ff; border-color:rgba(180,128,255,0.3); background:rgba(180,128,255,0.06); }
.esthe-btn-book:hover { background:#b480ff; color:white; border-color:#b480ff; }

/* REVIEWS */
.review-item { padding:16px 0; border-bottom:1px solid #f3f0ff; }
.review-item:last-child { border-bottom:none; padding-bottom:0; }
.review-top { display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-wrap:wrap; }
.review-av { width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.review-name { font-size:13px; font-weight:700; color:#1a1a2e; }
.review-date { font-size:11px; color:#c4b5fd; margin-left:auto; }
.review-stars span { font-size:13px; }
.star-f { color:#f59e0b; }
.star-e { color:#e5e7eb; }
.review-text { font-size:13px; color:#374151; font-style:italic; line-height:1.7; background:#fdf9ff; padding:10px 14px; border-radius:10px; border-left:3px solid rgba(180,128,255,0.2); }

/* RIGHT STICKY */
.svs-sticky { position:sticky; top:90px; }

.svs-book-card {
    background:white; border-radius:24px; padding:24px;
    border:1px solid #ede9fe; box-shadow:0 12px 40px rgba(180,128,255,0.12);
    margin-bottom:16px;
    opacity:0; animation:fadeUp 0.6s 0.2s forwards;
}
.svs-book-price { font-size:36px; font-weight:900; color:#b480ff; margin-bottom:4px; }
.svs-book-dur { font-size:13px; color:#9ca3af; margin-bottom:20px; display:flex; align-items:center; gap:5px; }
.svs-book-dur i { color:#b480ff; }
.svs-book-divider { height:1px; background:#ede9fe; margin:16px 0; }
.svs-book-feature { display:flex; align-items:center; gap:10px; font-size:13px; color:#374151; margin-bottom:10px; }
.svs-book-feature i { color:#b480ff; width:16px; text-align:center; }
.svs-book-btn-full {
    display:flex; align-items:center; justify-content:center; gap:8px; padding:14px;
    border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95);
    color:white; font-size:15px; font-weight:800; text-decoration:none;
    transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); margin-bottom:10px;
}
.svs-book-btn-full:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }
.svs-book-note { font-size:11px; color:#c4b5fd; text-align:center; }

/* AFFLUENCE */
.svs-affluence {
    background:white; border-radius:16px; padding:16px 18px;
    border:1px solid #ede9fe; margin-bottom:16px;
    display:flex; align-items:center; gap:12px;
    opacity:0; animation:fadeUp 0.6s 0.3s forwards;
}
.aff-dot { width:12px; height:12px; border-radius:50%; flex-shrink:0; }
.aff-dot.low  { background:#10b981; animation:pulseDot 2s ease infinite; }
.aff-dot.mid  { background:#f59e0b; animation:pulseDot 1.5s ease infinite; }
.aff-dot.high { background:#ef4444; animation:pulseDot 1s ease infinite; }
@keyframes pulseDot { 0%,100%{box-shadow:0 0 0 0 rgba(180,128,255,0.4);} 50%{box-shadow:0 0 0 6px rgba(180,128,255,0);} }
.aff-text { font-size:13px; color:#374151; font-weight:500; }

/* BA SLIDER */
.ba-card { background:#fff; border-radius:24px; padding:28px; border:1px solid #ede9fe; box-shadow:0 10px 40px rgba(180,128,255,0.08); margin-bottom:24px; }
.ba-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; border-radius:999px; background:rgba(180,128,255,0.1); color:#b480ff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.8px; margin-bottom:10px; }
.ba-header { margin-bottom:16px; }
.ba-header h3 { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:4px; }
.ba-header p { font-size:12px; color:#9ca3af; line-height:1.6; margin:0; }
.ba-slider { position:relative; height:320px; border-radius:16px; overflow:hidden; cursor:ew-resize; user-select:none; touch-action:none; }
.ba-after-img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
.ba-before-img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; clip-path:inset(0 50% 0 0); }
.ba-handle { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:48px; height:48px; border-radius:50%; background:white; display:flex; align-items:center; justify-content:center; gap:3px; color:#b480ff; font-size:12px; pointer-events:none; cursor:ew-resize; transition:transform .2s ease; box-shadow:0 10px 25px rgba(180,128,255,.25), 0 4px 10px rgba(0,0,0,.12); }
.ba-slider:hover .ba-handle { transform:translate(-50%,-50%) scale(1.08); }

.ba-divider { position:absolute; top:0; bottom:0; left:50%; width:2px; background:white; transform:translateX(-50%); box-shadow:0 0 12px rgba(0,0,0,0.2); pointer-events:none; }

.ba-pill { position:absolute; top:14px; padding:5px 12px; border-radius:999px; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.8px; pointer-events:none; }
.ba-pill-before { left:14px; background:rgba(0,0,0,0.55); color:white; }
.ba-pill-after  { right:14px; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; }
.ba-footer { margin-top:14px; display:flex; justify-content:space-between; gap:16px; padding-top:14px; border-top:1px solid #f3f0ff; }
.ba-footer strong { display:block; color:#1a1a2e; font-size:13px; font-weight:700; }
.ba-footer span { font-size:11px; color:#9ca3af; }
@media(max-width:768px){ .ba-slider{ height:300px; } .ba-footer{ flex-direction:column; } }
@media(max-width:900px){ .svs-grid{grid-template-columns:1fr;} .svs-sticky{position:static;} .svs-float-card{flex-wrap:wrap;gap:12px;} .svs-body{padding-top:56px;} }
@media(max-width:640px){ .svs-title{font-size:28px;} .svs-float-card{flex-direction:column;align-items:flex-start;} .svs-book-btn{margin-left:0;width:100%;justify-content:center;} }
</style>

{{-- HERO --}}
<div class="svs-hero">
    @if($service->image)
        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->nom }}" class="svs-hero-img">
    @else
        <div class="svs-hero-placeholder">💄</div>
    @endif
    <div class="svs-hero-overlay"></div>
    <div class="svs-hero-content">
        <a href="{{ route('client.services.index') }}" class="svs-back">
            <i class="fa-solid fa-arrow-left"></i> Back to Services
        </a>
        <div class="svs-cat-tag">{{ $service->category->nom }}</div>
        <h1 class="svs-title">{{ $service->nom }}</h1>
        @if($noteMoyenne > 0)
            <div class="svs-rating-row">
                <div class="svs-stars">
                    @for($i=1;$i<=5;$i++)
                        <span class="{{ $i<=round($noteMoyenne)?'svs-star-f':'svs-star-e' }}">★</span>
                    @endfor
                </div>
                <span class="svs-rating-text">{{ number_format($noteMoyenne,1) }}/5 — {{ $avis->count() }} review(s)</span>
            </div>
        @endif
    </div>

    {{-- FLOATING CARD --}}
    <div class="svs-float-card">
    <div class="svs-float-price">
        <span class="svs-float-price-val">{{ number_format($service->prix,0,',',' ') }} DA</span>
        <span class="svs-float-price-lbl">Price</span>
    </div>
    <div class="svs-float-sep"></div>
    <div class="svs-float-dur">
        <span class="svs-float-dur-val">{{ $service->dureeFormatee() }}</span>
        <span class="svs-float-dur-lbl">Duration</span>
    </div>
    @if($service->estheticiennes->isNotEmpty())
        <a href="{{ route('client.reservation.create', ['service'=>$service->id]) }}" class="svs-book-btn">
            <i class="fa-regular fa-calendar-check"></i> Book Now
        </a>
    @endif
</div>
</div>

<div class="svs-body">
<div class="svs-grid">

    {{-- LEFT --}}
<div>

    {{-- DESCRIPTION --}}
    @if($service->description)
    <div class="svs-card">
        <div class="svs-section-title">
            <div class="svs-section-icon"><i class="fa-solid fa-circle-info"></i></div>
            About this Service
        </div>
        <div class="svs-desc">{{ $service->description }}</div>
    </div>
    @endif

    {{-- avant/apres --}}
    @if($photosAvantApres->isNotEmpty())
    @foreach($photosAvantApres as $i => $photo)
    <div class="ba-card">
        <div class="ba-header">
            <span class="ba-badge"><i class="fa-solid fa-sparkles"></i> Verified Client Result</span>
<h3>Before & After Results</h3>
<p>Move the slider to compare the results.</p>
        </div>
        <div class="ba-slider" id="baSlider-{{ $i }}">
            <img src="{{ asset('storage/'.$photo->photo_apres) }}" class="ba-after-img"  alt="After">
            <img src="{{ asset('storage/'.$photo->photo_avant) }}" class="ba-before-img" alt="Before" id="baBefore-{{ $i }}">
            <div class="ba-divider" id="baDivider-{{ $i }}">
                <div class="ba-handle">
                    <i class="fa-solid fa-chevron-left"></i>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
            <div class="ba-pill ba-pill-before">Before</div>
            <div class="ba-pill ba-pill-after">After</div>
        </div>
        <div class="ba-footer">
            <div>
                <strong>{{ $photo->estheticienne->fullName() }}</strong>
                <span>Beauty Expert</span>
            </div>
            <div style="text-align:right">
                <strong>{{ $photo->created_at->format('M Y') }}</strong>
                <span>Client Result</span>
            </div>
        </div>
    </div>
    @endforeach
@endif
    {{-- EXPERTS --}}
    @if($service->estheticiennes->isNotEmpty())
    <div class="svs-card">
        <div class="svs-section-title">
            <div class="svs-section-icon"><i class="fa-solid fa-user-nurse"></i></div>
            Our Experts for this Service
        </div>
        @foreach($service->estheticiennes as $esthe)
            <div class="esthe-card">
                <div class="esthe-av">
                    @if($esthe->photo)
                        <img src="{{ asset('storage/'.$esthe->photo) }}" alt="">
                    @else
                        {{ strtoupper(substr($esthe->prenom,0,1)) }}
                    @endif
                </div>
                <div class="esthe-info">
                    <div class="esthe-name">{{ $esthe->fullName() }}</div>
                    @if($esthe->experience)<div class="esthe-exp">{{ $esthe->experience }} year(s) of experience</div>@endif
                    @if($esthe->specialites)<div class="esthe-spec">{{ Str::limit($esthe->specialites, 60) }}</div>@endif
                </div>
                <div class="esthe-actions">
                    <a href="{{ route('client.estheticiennes.show', $esthe) }}" class="esthe-btn esthe-btn-profile">
                        <i class="fa-solid fa-user" style="font-size:10px;"></i> Profile
                    </a>
                    <a href="{{ route('client.reservation.create', ['service'=>$service->id,'estheticienne'=>$esthe->id]) }}" class="esthe-btn esthe-btn-book">
                        Book <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    {{-- REVIEWS --}}
    @if($avis->isNotEmpty())
    <div class="svs-card">
        <div class="svs-section-title">
            <div class="svs-section-icon"><i class="fa-solid fa-star"></i></div>
            Client Reviews
        </div>
        @foreach($avis as $av)
            <div class="review-item">
                <div class="review-top">
                    <div class="review-av">{{ strtoupper(substr($av->client->prenom,0,1)) }}</div>
                    <div>
                        <div class="review-name">{{ $av->client->fullName() }}</div>
                        <div class="review-stars">
                            @for($i=1;$i<=5;$i++)
                                <span class="{{ $i<=$av->note?'star-f':'star-e' }}">★</span>
                            @endfor
                        </div>
                    </div>
                    <div class="review-date">{{ $av->created_at->format('d/m/Y') }}</div>
                </div>
                @if($av->commentaire)
                    <div class="review-text">"{{ $av->commentaire }}"</div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

</div>

    {{-- RIGHT --}}
    <div class="svs-sticky">

        <div class="svs-book-card">
            <div class="svs-book-price">{{ number_format($service->prix,0,',',' ') }} DA</div>
            <div class="svs-book-dur"><i class="fa-regular fa-clock"></i> {{ $service->dureeFormatee() }}</div>

            <div class="svs-book-feature"><i class="fa-solid fa-check"></i> Professional beauty experts</div>
            <div class="svs-book-feature"><i class="fa-solid fa-check"></i> Flexible scheduling</div>
            <div class="svs-book-feature"><i class="fa-solid fa-check"></i> Combine with other services</div>
            <div class="svs-book-feature"><i class="fa-solid fa-gift"></i> Earn loyalty points</div>

            <div class="svs-book-divider"></div>

            @if($service->estheticiennes->isNotEmpty())
                <a href="{{ route('client.reservation.create', ['service'=>$service->id]) }}" class="svs-book-btn-full">
                    <i class="fa-regular fa-calendar-check"></i> Book This Service
                </a>
                <div class="svs-book-note">You can add more services during booking</div>
            @else
                <div style="text-align:center;color:#c4b5fd;font-size:13px;padding:10px 0;">
                    <i class="fa-solid fa-clock"></i> No expert available right now
                </div>
            @endif
        </div>

        {{-- AFFLUENCE --}}
        @php
            $rdvAujourdhui = \App\Models\RendezVous::whereDate('date_debut', today())
                ->whereIn('statut', ['confirme','en_cours'])->count();
            if ($rdvAujourdhui <= 3)     { $affNiveau = 'faible'; $affClass = 'low'; $affText = 'Low — Great time to visit!'; $affColor = '#10b981'; }
            elseif ($rdvAujourdhui <= 7) { $affNiveau = 'moyen';  $affClass = 'mid'; $affText = 'Moderate';                   $affColor = '#f59e0b'; }
            else                         { $affNiveau = 'eleve';  $affClass = 'high'; $affText = 'High — Book ahead!';          $affColor = '#ef4444'; }
        @endphp
        <div class="svs-affluence">
            <div class="aff-dot {{ $affClass }}"></div>
            <div class="aff-text">
                Current occupancy: <span style="font-weight:700;color:{{ $affColor }};">{{ $affText }}</span>
            </div>
        </div>

    </div>

</div>
</div>
<script>

document.querySelectorAll('.ba-slider').forEach(function(slider) {
    var id      = slider.id.replace('baSlider-', '');
    var before  = document.getElementById('baBefore-'  + id);
    var divider = document.getElementById('baDivider-' + id);
    var drag    = false;

    function move(x) {
        var rect = slider.getBoundingClientRect();
        var pos  = Math.max(0, Math.min(100, ((x - rect.left) / rect.width) * 100));
        before.style.clipPath = 'inset(0 ' + (100 - pos) + '% 0 0)';
        divider.style.left    = pos + '%';
    }

    slider.addEventListener('mousedown', function(e) {
        e.preventDefault();
        drag = true;
        move(e.clientX);
    });

    window.addEventListener('mouseup', function() { drag = false; });

    window.addEventListener('mousemove', function(e) {
        if (drag) {
            e.preventDefault();
            move(e.clientX);
        }
    });

    slider.addEventListener('touchstart', function(e) {
        drag = true;
        move(e.touches[0].clientX);
    }, { passive: true });

    slider.addEventListener('touchmove', function(e) {
        e.preventDefault();
        move(e.touches[0].clientX);
    }, { passive: false });

    slider.addEventListener('touchend', function() { drag = false; });
});

</script>
</x-app-layout>