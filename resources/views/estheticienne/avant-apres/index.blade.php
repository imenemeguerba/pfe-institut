<x-app-layout>
<x-slot name="header">Before & After</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.aa-wrap { margin:-24px; padding:0; background:#f8f5ff; }

/* ── HERO ── */
.aa-hero {
    position:relative; overflow:hidden;
    padding:44px 32px 90px;
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);
}
.aa-hero-dots { position:absolute; inset:0; background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px); background-size:28px 28px; }
.aa-hero-orb1 { position:absolute; width:320px; height:320px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-80px; right:-60px; animation:orbF 7s ease-in-out infinite alternate; }
.aa-hero-orb2 { position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%); bottom:-40px; left:100px; animation:orbF 10s ease-in-out 2s infinite alternate; }
@keyframes orbF{ from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);} }
.aa-hero-content { position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px; }
.aa-hero-tag { display:inline-flex; align-items:center; gap:7px; padding:5px 16px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:14px; }
.aa-hero-title { font-family:'Playfair Display',serif; font-size:34px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.15); margin-bottom:8px; line-height:1.2; }
.aa-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.35); text-underline-offset:4px; }
.aa-hero-hint { display:inline-flex; align-items:center; gap:7px; padding:8px 16px; border-radius:20px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.85); font-size:12px; font-weight:600; margin-top:10px; }
.aa-hero-hint i { animation:moveX 1.5s ease-in-out infinite alternate; }
@keyframes moveX { from{transform:translateX(-4px);} to{transform:translateX(4px);} }
.aa-hero-right { display:flex; align-items:center; gap:12px; flex-wrap:wrap; }
.aa-hero-count { display:flex; align-items:center; gap:10px; padding:12px 18px; border-radius:20px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); }
.aa-hero-count-num { font-size:24px; font-weight:900; color:white; line-height:1; }
.aa-hero-count-lbl { font-size:11px; color:rgba(255,255,255,0.7); }
.btn-new-hero { display:inline-flex; align-items:center; gap:7px; padding:12px 22px; border-radius:30px; font-size:13px; font-weight:700; background:white; color:#b480ff; text-decoration:none; transition:all 0.2s; box-shadow:0 4px 16px rgba(0,0,0,0.12); }
.btn-new-hero:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.18); }
.aa-wave { position:absolute; bottom:-2px; left:0; right:0; height:60px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.aa-body { padding:28px 24px 60px; }

/* COUNT */
.aa-count { font-size:13px; color:#9ca3af; margin-bottom:24px; }
.aa-count strong { color:#1a1a2e; }

/* GRID */
.aa-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }

/* CARD — same as client */
.aa-card {
    background:white; border-radius:24px; overflow:hidden;
    border:1px solid #ede9fe;
    box-shadow:0 4px 20px rgba(180,128,255,0.07);
    transition:all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
    opacity:0; animation:cardIn 0.5s forwards;
}
.aa-card:nth-child(1){animation-delay:0s}   .aa-card:nth-child(2){animation-delay:.08s}
.aa-card:nth-child(3){animation-delay:.16s} .aa-card:nth-child(4){animation-delay:.24s}
.aa-card:nth-child(5){animation-delay:.32s} .aa-card:nth-child(6){animation-delay:.4s}
.aa-card:nth-child(7){animation-delay:.48s} .aa-card:nth-child(8){animation-delay:.56s}
.aa-card:nth-child(9){animation-delay:.64s}
@keyframes cardIn { from{opacity:0;transform:translateY(24px) scale(0.96);} to{opacity:1;transform:translateY(0) scale(1);} }
.aa-card:hover { transform:translateY(-8px) scale(1.01); box-shadow:0 24px 56px rgba(180,128,255,0.18); border-color:#c4b5fd; }

/* SLIDER — exact same as client */
.ba-slider-wrap {
    position:relative; height:260px; overflow:hidden;
    cursor:col-resize; user-select:none;
}
.ba-img-after {
    position:absolute; inset:0; width:100%; height:100%; object-fit:cover;
    transition:transform 0.3s;
}
.aa-card:hover .ba-img-after { transform:scale(1.03); }
.ba-before-clip { position:absolute; inset:0; overflow:hidden; }
.ba-img-before  { position:absolute; inset:0; height:100%; object-fit:cover; }

/* labels */
.ba-label { position:absolute; top:12px; font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; padding:4px 12px; border-radius:20px; z-index:4; }
.ba-label.before { left:12px; background:rgba(0,0,0,0.6); color:white; backdrop-filter:blur(4px); }
.ba-label.after  { right:12px; background:rgba(180,128,255,0.85); color:white; backdrop-filter:blur(4px); }

/* divider line */
.ba-line { position:absolute; top:0; bottom:0; width:2px; background:white; box-shadow:0 0 12px rgba(255,255,255,0.6); z-index:3; pointer-events:none; }
.ba-handle {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
    width:38px; height:38px; border-radius:50%; background:white;
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 4px 16px rgba(0,0,0,0.2); color:#b480ff; font-size:14px;
    animation:handlePulse 2s ease-in-out infinite;
}
@keyframes handlePulse { 0%,100%{box-shadow:0 4px 16px rgba(180,128,255,0.3);} 50%{box-shadow:0 4px 24px rgba(180,128,255,0.6);} }

/* CARD BODY */
.aa-card-body { padding:16px 18px; }
.aa-card-top  { display:flex; align-items:flex-start; justify-content:space-between; gap:10px; margin-bottom:8px; }
.aa-card-service { display:inline-flex; align-items:center; gap:5px; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.aa-card-date { font-size:10px; color:#c4b5fd; display:flex; align-items:center; gap:4px; white-space:nowrap; }
.aa-card-desc { font-size:12px; color:#9ca3af; line-height:1.6; margin-bottom:10px; }
.aa-card-footer { display:flex; align-items:center; justify-content:flex-end; }
.btn-del {
    padding:5px 13px; border-radius:20px; background:white; color:#ef4444;
    font-size:11px; font-weight:600; border:1.5px solid rgba(239,68,68,0.2);
    cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:4px;
    transition:all 0.2s;
}
.btn-del:hover { background:#fff5f5; border-color:rgba(239,68,68,0.4); }

/* EMPTY */
.aa-empty {
    background:white; border-radius:24px; border:1px solid #ede9fe;
    text-align:center; padding:72px 24px;
    box-shadow:0 4px 20px rgba(180,128,255,0.06);
}
.aa-empty i { font-size:52px; color:#e9d8fd; margin-bottom:16px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
.aa-empty p { font-size:14px; color:#d1d5db; margin-bottom:20px; line-height:1.7; }

@media(max-width:900px){ .aa-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:580px){ .aa-grid{ grid-template-columns:1fr; } }
</style>

<div class="aa-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="aa-hero">
        <div class="aa-hero-dots"></div>
        <div class="aa-hero-orb1"></div>
        <div class="aa-hero-orb2"></div>
        <div class="aa-hero-content">
            <div class="aa-hero-left">
                <div class="aa-hero-tag"><i class="fa-solid fa-images"></i> My Gallery</div>
                <h1 class="aa-hero-title">Before &amp; <span>After</span></h1>
                <div class="aa-hero-hint">
                    <i class="fa-solid fa-arrows-left-right"></i>
                    Drag the slider to reveal the transformation
                </div>
            </div>
            <div class="aa-hero-right">
                <div class="aa-hero-count">
                    <div>
                        <div class="aa-hero-count-num">{{ $photos->total() }}</div>
                        <div class="aa-hero-count-lbl">Photo{{ $photos->total() > 1 ? 's' : '' }}</div>
                    </div>
                </div>
                <a href="{{ route('estheticienne.avant-apres.create') }}" class="btn-new-hero">
                    <i class="fa-solid fa-plus"></i> Add Photos
                </a>
            </div>
        </div>
        <div class="aa-wave"></div>
    </div>

    <div class="aa-body">

        @if($photos->isEmpty())
            <div class="aa-empty">
                <i class="fa-solid fa-images"></i>
                <p>No before &amp; after photos yet.<br>Start showcasing your work!</p>
                <a href="{{ route('estheticienne.avant-apres.create') }}" style="display:inline-flex;align-items:center;gap:6px;padding:12px 24px;border-radius:30px;background:linear-gradient(to right,#b480ff,#d3aa95);color:white;font-size:13px;font-weight:700;text-decoration:none;transition:all 0.2s;">
                    <i class="fa-solid fa-plus"></i> Add your first work
                </a>
            </div>
        @else
            <div class="aa-count">
                <strong>{{ $photos->total() }}</strong> transformation(s)
            </div>

            <div class="aa-grid">
                @foreach($photos as $photo)
                    <div class="aa-card">
                        {{-- SLIDER — même style que le client --}}
                        <div class="ba-slider-wrap"
                             x-data="{ pos: 50 }"
                             @mousemove="pos = Math.min(100, Math.max(0, ($event.offsetX / $el.offsetWidth) * 100))"
                             @touchmove.prevent="pos = Math.min(100, Math.max(0, (($event.touches[0].clientX - $el.getBoundingClientRect().left) / $el.offsetWidth) * 100))">

                            <img src="{{ asset('storage/'.$photo->photo_apres) }}"
                                 class="ba-img-after" draggable="false" alt="After">

                            <div class="ba-before-clip" :style="'width:'+pos+'%'">
                                <img src="{{ asset('storage/'.$photo->photo_avant) }}"
                                     class="ba-img-before"
                                     :style="'width:'+(100/pos*100)+'%'"
                                     draggable="false" alt="Before">
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
                        <div class="aa-card-body">
                            <div class="aa-card-top">
                                <div>
                                    @if($photo->service)
                                        <span class="aa-card-service">
                                            <i class="fa-solid fa-spa" style="font-size:9px;"></i>
                                            {{ $photo->service }}
                                        </span>
                                    @endif
                                </div>
                                <div class="aa-card-date">
                                    <i class="fa-regular fa-calendar" style="font-size:9px;"></i>
                                    {{ $photo->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                            @if($photo->description)
                                <div class="aa-card-desc">{{ Str::limit($photo->description, 90) }}</div>
                            @endif
                            <div class="aa-card-footer">
                                <form method="POST"
                                      action="{{ route('estheticienne.avant-apres.destroy', $photo) }}"
                                      id="delPhoto{{ $photo->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-del"
                                        onclick="glowConfirm(
                                            'Delete these photos?',
                                            'This action cannot be undone.',
                                            'Delete',
                                            'fa-trash',
                                            'red',
                                            function(){ document.getElementById('delPhoto{{ $photo->id }}').submit(); }
                                        )">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($photos->hasPages())
                <div style="margin-top:28px;">{{ $photos->links() }}</div>
            @endif
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
