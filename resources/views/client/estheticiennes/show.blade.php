<x-app-layout>
<x-slot name="header">{{ $estheticienne->fullName() }}</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.es-hero {
    position:relative; overflow:hidden;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    padding:60px 5% 100px;
    min-height:300px;
    margin:-32px -24px 0;
}
.es-hero-particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
.es-particle { position:absolute; border-radius:50%; background:rgba(255,255,255,0.08); animation:floatP linear infinite; }
@keyframes floatP { 0%{transform:translateY(100%) scale(0);opacity:0;} 10%{opacity:1;} 90%{opacity:0.4;} 100%{transform:translateY(-100px) scale(1);opacity:0;} }

.es-hero-inner {
    position:relative; z-index:2;
    display:flex; align-items:center; justify-content:space-between; gap:32px; flex-wrap:wrap;
}

/* LEFT — avatar + info */
.es-hero-left { display:flex; align-items:center; gap:28px; }
.es-avatar-wrap { position:relative; flex-shrink:0; }
.es-avatar {
    width:150px; height:150px; border-radius:50%; object-fit:cover;
    border:4px solid rgba(255,255,255,0.9);
    box-shadow:0 12px 40px rgba(0,0,0,0.2);
}
.es-avatar-ph {
    width:150px; height:150px; border-radius:50%;
    background:rgba(255,255,255,0.2); border:4px solid rgba(255,255,255,0.9);
    box-shadow:0 12px 40px rgba(0,0,0,0.2);
    display:flex; align-items:center; justify-content:center;
    font-size:56px; font-weight:800; color:white;
}
.es-online-dot {
    position:absolute; bottom:6px; right:6px;
    width:16px; height:16px; border-radius:50%;
    background:#10b981; border:3px solid white;
}

.es-hero-info { display:flex; flex-direction:column; gap:8px; }
.es-back {
    display:inline-flex; align-items:center; gap:6px; padding:5px 12px;
    border-radius:20px; background:rgba(255,255,255,0.15);
    border:1px solid rgba(255,255,255,0.25); color:rgba(255,255,255,0.9);
    font-size:11px; font-weight:600; text-decoration:none; transition:all 0.2s;
    width:fit-content; margin-bottom:4px;
}
.es-back:hover { background:rgba(255,255,255,0.25); color:white; }
.es-badge {
    display:inline-flex; align-items:center; gap:5px; padding:3px 12px;
    border-radius:20px; background:rgba(255,255,255,0.2);
    border:1px solid rgba(255,255,255,0.3);
    font-size:10px; font-weight:700; text-transform:uppercase;
    letter-spacing:0.5px; color:white; width:fit-content;
}
.es-name {
    font-family:'Playfair Display',serif;
    font-size:32px; font-weight:800; color:white;
    line-height:1.2; text-shadow:0 2px 12px rgba(0,0,0,0.15);
}
.es-meta { display:flex; flex-direction:column; gap:5px; }
.es-meta-item { display:flex; align-items:center; gap:7px; font-size:13px; color:rgba(255,255,255,0.9); font-weight:500; }
.es-meta-item i { font-size:12px; color:rgba(255,255,255,0.7); width:14px; }

/* RIGHT — book button */
.es-hero-right { flex-shrink:0; }
.es-book-hero-btn {
    display:inline-flex; align-items:center; gap:8px; padding:14px 28px;
    border-radius:30px; background:white;
    color:#b480ff; font-size:14px; font-weight:800; text-decoration:none;
    transition:all 0.2s; white-space:nowrap;
    box-shadow:0 8px 24px rgba(0,0,0,0.15);
}
.es-book-hero-btn:hover { transform:translateY(-2px); box-shadow:0 12px 32px rgba(0,0,0,0.2); }

/* WAVE */
.es-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.es-body { max-width:1000px; margin:0 auto; padding:48px 24px 80px; }
.es-grid { display:grid; grid-template-columns:1fr 320px; gap:28px; align-items:start; }

/* SECTION CARD */
.es-card { background:white; border-radius:24px; padding:26px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); margin-bottom:20px; opacity:0; animation:fadeUp 0.5s forwards; }
.es-card:nth-child(1){ animation-delay:0.1s; }
.es-card:nth-child(2){ animation-delay:0.2s; }
.es-card:nth-child(3){ animation-delay:0.3s; }
.es-card:nth-child(4){ animation-delay:0.4s; }
@keyframes fadeUp { from{opacity:0;transform:translateY(16px);} to{opacity:1;transform:translateY(0);} }
.es-card-title { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:16px; display:flex; align-items:center; gap:10px; }
.es-card-icon { width:32px; height:32px; border-radius:9px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0; }

/* SPECIALTIES */
.es-spec-text { font-size:14px; color:#374151; line-height:1.8; background:#fdf9ff; border-radius:12px; padding:14px 16px; border-left:3px solid rgba(180,128,255,0.3); }

/* SERVICES */
.es-svc-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.es-svc-card { border:1.5px solid #ede9fe; border-radius:16px; padding:16px; transition:all 0.25s; background:white; position:relative; overflow:hidden; }
.es-svc-card::before { content:''; position:absolute; left:0; top:0; bottom:0; width:3px; background:linear-gradient(to bottom,#b480ff,#d3aa95); border-radius:3px 0 0 3px; opacity:0; transition:opacity 0.25s; }
.es-svc-card:hover { border-color:#b480ff; transform:translateY(-3px); box-shadow:0 10px 28px rgba(180,128,255,0.12); }
.es-svc-card:hover::before { opacity:1; }
.es-svc-cat  { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#b480ff; margin-bottom:4px; }
.es-svc-name { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.es-svc-desc { font-size:11px; color:#9ca3af; line-height:1.5; margin-bottom:10px; }
.es-svc-foot { display:flex; align-items:center; justify-content:space-between; }
.es-svc-price { font-size:16px; font-weight:900; color:#b480ff; }
.es-svc-dur   { font-size:10px; color:#c4b5fd; }
.es-svc-btn   { display:inline-flex; align-items:center; gap:4px; padding:7px 14px; border-radius:20px; font-size:11px; font-weight:700; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; text-decoration:none; transition:all 0.2s; white-space:nowrap; }
.es-svc-btn:hover { transform:scale(1.05); box-shadow:0 4px 12px rgba(180,128,255,0.4); }

/* REVIEWS */
.review-item { padding:16px 0; border-bottom:1px solid #f3f0ff; }
.review-item:last-child { border-bottom:none; padding-bottom:0; }
.review-top { display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-wrap:wrap; }
.review-av { width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.review-name { font-size:13px; font-weight:700; color:#1a1a2e; }
.review-date { font-size:11px; color:#c4b5fd; margin-left:auto; }
.review-stars span { font-size:13px; }
.star-f { color:#f59e0b; } .star-e { color:#e5e7eb; }
.review-text { font-size:13px; color:#374151; font-style:italic; line-height:1.7; background:#fdf9ff; padding:10px 14px; border-radius:10px; border-left:3px solid rgba(180,128,255,0.2); }

/* STICKY SIDEBAR */
.es-sticky { position:sticky; top:90px; }
.es-book-card { background:white; border-radius:24px; padding:24px; border:1px solid #ede9fe; box-shadow:0 12px 40px rgba(180,128,255,0.1); margin-bottom:14px; opacity:0; animation:fadeUp 0.5s 0.2s forwards; }
.es-book-title  { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:16px; }
.es-book-feature { display:flex; align-items:center; gap:8px; font-size:12px; color:#374151; margin-bottom:8px; }
.es-book-feature i { color:#b480ff; width:14px; text-align:center; }
.es-book-divider { height:1px; background:#ede9fe; margin:16px 0; }
.es-book-btn { display:flex; align-items:center; justify-content:center; gap:8px; padding:14px; border-radius:30px; width:100%; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:800; text-decoration:none; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; }
.es-book-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }

.es-empty { text-align:center; padding:24px; color:#d1d5db; font-size:13px; font-style:italic; }

@media(max-width:900px){ .es-grid{grid-template-columns:1fr;} .es-sticky{position:static;} .es-svc-grid{grid-template-columns:1fr;} .es-hero-left{flex-direction:column;align-items:flex-start;} .es-hero-inner{flex-direction:column;} }
@media(max-width:640px){ .es-name{font-size:24px;} }
</style>

{{-- HERO --}}
<div class="es-hero">
    <div class="es-hero-particles" id="esParticles"></div>

    <div class="es-hero-inner">
        {{-- LEFT --}}
        <div class="es-hero-left">
            <div class="es-avatar-wrap">
                @if($estheticienne->photo)
                    <img src="{{ asset('storage/'.$estheticienne->photo) }}" alt="" class="es-avatar">
                @else
                    <div class="es-avatar-ph">{{ strtoupper(substr($estheticienne->prenom,0,1)) }}</div>
                @endif
                <div class="es-online-dot"></div>
            </div>

            <div class="es-hero-info">
                <a href="{{ url()->previous() }}" class="es-back">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <div class="es-badge"><i class="fa-solid fa-spa"></i> Beauty Expert</div>
                <div class="es-name">{{ $estheticienne->fullName() }}</div>
                <div class="es-meta">
                    @if($estheticienne->experience)
                        <div class="es-meta-item"><i class="fa-solid fa-briefcase"></i> {{ $estheticienne->experience }} year(s) of experience</div>
                    @endif
                    <div class="es-meta-item"><i class="fa-solid fa-spa"></i> {{ $estheticienne->servicesProposes->count() }} service(s)</div>
                    @if($noteMoyenne > 0)
                        <div class="es-meta-item"><i class="fa-solid fa-star" style="color:#f59e0b;"></i> {{ number_format($noteMoyenne,1) }}/5 — {{ $avis->count() }} review(s)</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- RIGHT — Book button --}}
        @if($estheticienne->servicesProposes->isNotEmpty())
            <div class="es-hero-right">
                <a href="{{ route('client.reservation.create', ['estheticienne'=>$estheticienne->id]) }}" class="es-book-hero-btn">
                    <i class="fa-regular fa-calendar-check"></i> Book with {{ $estheticienne->prenom }}
                </a>
            </div>
        @endif
    </div>

    <div class="es-wave"></div>
</div>

<div class="es-body">
<div class="es-grid">

    {{-- LEFT --}}
    <div>

        {{-- SPECIALTIES --}}
        @if($estheticienne->specialites)
        <div class="es-card">
            <div class="es-card-title"><div class="es-card-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div> Specialties</div>
            <div class="es-spec-text">{{ $estheticienne->specialites }}</div>
        </div>
        @endif

        {{-- SERVICES --}}
        <div class="es-card">
            <div class="es-card-title">
                <div class="es-card-icon"><i class="fa-solid fa-spa"></i></div>
                Services ({{ $estheticienne->servicesProposes->count() }})
            </div>
            @if($estheticienne->servicesProposes->isEmpty())
                <div class="es-empty">No services available yet.</div>
            @else
                <div class="es-svc-grid">
                    @foreach($estheticienne->servicesProposes as $service)
                        <div class="es-svc-card">
                            <div class="es-svc-cat">{{ $service->category->nom ?? '' }}</div>
                            <div class="es-svc-name">{{ $service->nom }}</div>
                            @if($service->description)
                                <div class="es-svc-desc">{{ Str::limit($service->description,70) }}</div>
                            @endif
                            <div class="es-svc-foot">
                                <div>
                                    <div class="es-svc-price">{{ number_format($service->prix,0,',',' ') }} DA</div>
                                    <div class="es-svc-dur"><i class="fa-regular fa-clock" style="font-size:9px;"></i> {{ $service->dureeFormatee() }}</div>
                                </div>
                                <a href="{{ route('client.reservation.create', ['service'=>$service->id,'estheticienne'=>$estheticienne->id]) }}" class="es-svc-btn">
                                    Book <i class="fa-solid fa-arrow-right" style="font-size:9px;"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- REVIEWS --}}
        <div class="es-card">
    <div class="es-card-title">
        <div class="es-card-icon"><i class="fa-solid fa-star"></i></div>
        Client Reviews @if($avis->isNotEmpty()) ({{ $avis->count() }}) @endif
    </div>
    @if($avis->isEmpty())
        <div class="es-empty">No reviews yet for this expert.</div>
    @else
        @foreach($avis as $av)
            {{-- review item --}}
        @endforeach
    @endif
</div>

    </div>

    {{-- RIGHT --}}
    <div class="es-sticky">
        <div class="es-book-card">
            <div class="es-book-title">Book with {{ $estheticienne->prenom }}</div>
            <div class="es-book-feature"><i class="fa-solid fa-check"></i> Instant booking confirmation</div>
            <div class="es-book-feature"><i class="fa-solid fa-calendar"></i> Flexible scheduling</div>
            <div class="es-book-feature"><i class="fa-solid fa-gift"></i> Earn loyalty points</div>
            <div class="es-book-divider"></div>
            @if($estheticienne->servicesProposes->isNotEmpty())
                <a href="{{ route('client.reservation.create', ['estheticienne'=>$estheticienne->id]) }}" class="es-book-btn">
                    <i class="fa-regular fa-calendar-check"></i> Book an Appointment
                </a>
            @else
                <div style="text-align:center;font-size:13px;color:#c4b5fd;padding:8px 0;">
                    <i class="fa-solid fa-clock"></i> No services available right now
                </div>
            @endif
        </div>
    </div>

</div>
</div>

<script>
var c = document.getElementById('esParticles');
if (c) {
    for (var i = 0; i < 15; i++) {
        var p = document.createElement('div');
        p.className = 'es-particle';
        var s = Math.random()*50+15;
        p.style.cssText='width:'+s+'px;height:'+s+'px;left:'+(Math.random()*100)+'%;animation-duration:'+(Math.random()*12+8)+'s;animation-delay:'+(Math.random()*8)+'s;opacity:'+(Math.random()*0.25)+';';
        c.appendChild(p);
    }
}
</script>

</x-app-layout>