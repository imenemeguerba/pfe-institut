<x-app-layout>
<x-slot name="header">Before & After Gallery</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.ba-hero {
    position:relative; overflow:hidden; padding:65px 10% 115px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
}
.ba-hero-orbs { position:absolute; inset:0; }
.ba-orb { position:absolute; border-radius:50%; animation:orbPulse ease-in-out infinite alternate; }
.ba-orb-1 { width:400px; height:400px; top:-120px; right:-80px; background:radial-gradient(circle,rgba(180,128,255,0.2),transparent 70%); animation-duration:5s; }
.ba-orb-2 { width:280px; height:280px; bottom:-60px; left:-50px; background:radial-gradient(circle,rgba(211,170,149,0.15),transparent 70%); animation-duration:7s; animation-delay:1s; }
@keyframes orbPulse { from{ transform:scale(1); } to{ transform:scale(1.2); } }
.ba-hero-content { position:relative; z-index:2; text-align:center; }
.ba-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.ba-hero-title { font-family:'Playfair Display',serif; font-size:48px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:14px; line-height:1.2; }
.ba-hero-title span { background:none; -webkit-text-fill-color:rgba(255,255,255,0.7); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
@keyframes shimmer { 0%,100%{ background-position:0%; } 50%{ background-position:100%; } }
.ba-hero-sub { font-size:15px; color:rgba(255,255,255,0.88); max-width:460px; margin:0 auto 28px; line-height:1.7; }
.ba-hero-hint { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:14px; background:rgba(180,128,255,0.06); border:1px solid rgba(180,128,255,0.15); color:#6b7280; font-size:13px; font-weight:500; backdrop-filter:blur(4px); }
.ba-hero-hint i { color:#b480ff; animation:moveX 1.5s ease-in-out infinite alternate; }
@keyframes moveX { from{ transform:translateX(-4px); } to{ transform:translateX(4px); } }
.ba-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.ba-body { max-width:1200px; margin:0 auto; padding:48px 24px 80px; }

/* COUNT */
.ba-count { font-size:13px; color:#9ca3af; margin-bottom:28px; text-align:center; }
.ba-count strong { color:#1a1a2e; }

/* EMPTY */
.ba-empty { background:white; border-radius:28px; border:1px solid #ede9fe; padding:80px 24px; text-align:center; box-shadow:0 4px 20px rgba(180,128,255,0.06); }
.ba-empty-icon { font-size:72px; display:block; margin-bottom:20px; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-12px); } }
.ba-empty h3 { font-size:20px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:8px; }
.ba-empty p  { font-size:14px; color:rgba(255,255,255,0.92); }

/* GRID */
.ba-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }

/* CARD */
.ba-card {
    background:white; border-radius:24px; overflow:hidden;
    border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.07);
    transition:all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
    opacity:0; animation:cardIn 0.5s forwards;
}
.ba-card:nth-child(1){ animation-delay:0s; }
.ba-card:nth-child(2){ animation-delay:0.08s; }
.ba-card:nth-child(3){ animation-delay:0.16s; }
.ba-card:nth-child(4){ animation-delay:0.24s; }
.ba-card:nth-child(5){ animation-delay:0.32s; }
.ba-card:nth-child(6){ animation-delay:0.4s; }
@keyframes cardIn { from{ opacity:0; transform:translateY(24px) scale(0.96); } to{ opacity:1; transform:translateY(0) scale(1); } }
.ba-card:hover { transform:translateY(-8px) scale(1.01); box-shadow:0 24px 56px rgba(180,128,255,0.18); border-color:#c4b5fd; }

/* SLIDER */
.ba-slider-wrap {
    position:relative; height:260px; overflow:hidden;
    cursor:col-resize; user-select:none;
}
.ba-img-after {
    position:absolute; inset:0; width:100%; height:100%; object-fit:cover;
    transition:transform 0.3s;
}
.ba-card:hover .ba-img-after { transform:scale(1.03); }
.ba-before-clip { position:absolute; inset:0; overflow:hidden; }
.ba-img-before  { position:absolute; inset:0; height:100%; object-fit:cover; }

/* LABELS */
.ba-label { position:absolute; top:12px; font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; padding:4px 12px; border-radius:20px; z-index:4; }
.ba-label.before { left:12px; background:rgba(0,0,0,0.6); color:white; backdrop-filter:blur(4px); }
.ba-label.after  { right:12px; background:rgba(180,128,255,0.85); color:white; backdrop-filter:blur(4px); }

/* DIVIDER LINE */
.ba-line { position:absolute; top:0; bottom:0; width:2px; background:white; box-shadow:0 0 12px rgba(255,255,255,0.6); z-index:3; pointer-events:none; }
.ba-handle {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
    width:38px; height:38px; border-radius:50%; background:white;
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 4px 16px rgba(0,0,0,0.2); color:#b480ff; font-size:14px;
    animation:handlePulse 2s ease-in-out infinite;
}
@keyframes handlePulse { 0%,100%{ box-shadow:0 4px 16px rgba(180,128,255,0.3); } 50%{ box-shadow:0 4px 24px rgba(180,128,255,0.6); } }

/* CARD BODY */
.ba-card-body { padding:16px 18px; }
.ba-card-top { display:flex; align-items:flex-start; justify-content:space-between; gap:10px; }
.ba-card-title { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.ba-card-service { display:inline-flex; align-items:center; gap:5px; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.ba-card-esthe { text-align:right; }
.ba-card-esthe-name { font-size:12px; font-weight:700; color:#374151; margin-bottom:2px; }
.ba-card-esthe-date { font-size:10px; color:#c4b5fd; }
.ba-card-desc { font-size:12px; color:#9ca3af; line-height:1.6; margin-top:10px; }

@media(max-width:1024px){ .ba-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:640px) { .ba-grid{ grid-template-columns:1fr; } .ba-hero-title{ font-size:34px; } }
</style>

{{-- HERO --}}
<div class="ba-hero">
    <div class="ba-hero-orbs">
        <div class="ba-orb ba-orb-1"></div>
        <div class="ba-orb ba-orb-2"></div>
    </div>
    <div class="ba-hero-content">
        <div class="ba-hero-tag"><i class="fa-solid fa-images"></i> Transformations</div>
        <h1 class="ba-hero-title">Before & <span>After</span></h1>
        <p class="ba-hero-sub">Discover the incredible transformations our experts achieve every day</p>
        <div class="ba-hero-hint">
            <i class="fa-solid fa-arrows-left-right"></i>
            Drag the slider to reveal the transformation
        </div>
    </div>
    <div class="ba-wave"></div>
</div>

<div class="ba-body">

    @if(!$photos->isEmpty())
        <div class="ba-count"><strong>{{ $photos->count() }}</strong> transformation(s)</div>
    @endif

    @if($photos->isEmpty())
        <div class="ba-empty">
            <span class="ba-empty-icon">📸</span>
            <h3>No transformations yet</h3>
            <p>Our experts will soon share their amazing work here.</p>
        </div>
    @else
        <div class="ba-grid">
            @foreach($photos as $photo)
                <div class="ba-card">
                    {{-- SLIDER --}}
                    <div class="ba-slider-wrap"
                         x-data="{ pos: 50, drag: false }"
                         @mousedown="drag = true"
                         @mouseup="drag = false"
                         @mouseleave="drag = false"
                         @mousemove="pos = Math.min(100, Math.max(0, ($event.offsetX / $el.offsetWidth) * 100))"
                         @touchmove.prevent="pos = Math.min(100, Math.max(0, (($event.touches[0].clientX - $el.getBoundingClientRect().left) / $el.offsetWidth) * 100))">

                        <img src="{{ asset('storage/'.$photo->photo_apres) }}" class="ba-img-after" draggable="false" alt="After">

                        <div class="ba-before-clip" :style="'width:'+pos+'%'">
                            <img src="{{ asset('storage/'.$photo->photo_avant) }}" class="ba-img-before"
                                 :style="'width:'+(100/pos*100)+'%'" draggable="false" alt="Before">
                        </div>

                        <span class="ba-label before">Before</span>
                        <span class="ba-label after">After</span>

                        <div class="ba-line" :style="'left:'+pos+'%'">
                            <div class="ba-handle">
                                <i class="fa-solid fa-arrows-left-right"></i>
                            </div>
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="ba-card-body">
                        <div class="ba-card-top">
                            <div>
                                @if($photo->titre)
                                    <div class="ba-card-title">{{ $photo->titre }}</div>
                                @endif
                                @if($photo->service)
                                    <span class="ba-card-service"><i class="fa-solid fa-spa" style="font-size:9px;"></i> {{ $photo->service }}</span>
                                @endif
                            </div>
                            <div class="ba-card-esthe">
                                <div class="ba-card-esthe-name">{{ $photo->estheticienne->fullName() }}</div>
                                <div class="ba-card-esthe-date">{{ $photo->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @if($photo->description)
                            <div class="ba-card-desc">{{ Str::limit($photo->description, 100) }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

</x-app-layout>