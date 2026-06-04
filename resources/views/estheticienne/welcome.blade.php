<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Welcome — Glow Institute</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html,body{height:100%;width:100%;overflow:hidden;font-family:'Plus Jakarta Sans',sans-serif;}

/* ══ 1. PHOTO FULL SCREEN ══════════════════════════════════════════ */
.wl-photo{
  position:fixed;inset:0;z-index:0;
  background-image: url('{{ asset("images/gp.png") }}');
  background-size:cover;
  background-position:center top;
  /* subtle Ken Burns animation */
  animation:kenBurns 20s ease-in-out infinite alternate;
}
@keyframes kenBurns{
  from{ transform:scale(1)    translateX(0)    translateY(0); }
  to  { transform:scale(1.06) translateX(-1%)  translateY(-1%); }
}

/* ══ 2. GRADIENT OVERLAY ════════════════════════════════════════════ */
.wl-overlay{
  position:fixed;inset:0;z-index:1;
  /* dark from left + bottom, keeps photo visible on right */
  background:
    linear-gradient(
      to right,
      rgba(10,5,28,0.82) 0%,
      rgba(26,10,53,0.65) 40%,
      rgba(26,10,53,0.20) 75%,
      transparent 100%
    ),
    linear-gradient(
      to top,
      rgba(10,5,28,0.70) 0%,
      transparent 50%
    );
}

/* ══ 3. PARTICLE LAYER ══════════════════════════════════════════════ */
.wl-particles{position:fixed;inset:0;z-index:2;pointer-events:none;overflow:hidden;}
.p{
  position:absolute;border-radius:50%;
  animation:particleRise linear infinite;
  opacity:0;
}
@keyframes particleRise{
  0%  {opacity:0;transform:translateY(0) scale(0.5);}
  10% {opacity:.5;}
  90% {opacity:.2;}
  100%{opacity:0;transform:translateY(-100vh) scale(1.1);}
}

/* ══ 4. PAGE CONTENT ════════════════════════════════════════════════ */
.wl-content{
  position:fixed;inset:0;z-index:3;
  display:flex;flex-direction:column;
  justify-content:space-between;
  padding:32px 48px 40px;
}

/* ── top bar ── */
.wl-top{
  display:flex;align-items:center;justify-content:space-between;
  animation:fadeDown .7s .1s both;
}
@keyframes fadeDown{from{opacity:0;transform:translateY(-18px);}to{opacity:1;transform:translateY(0);}}

.wl-logo{display:flex;align-items:center;gap:10px;}
.wl-logo img{
  height:40px;object-fit:contain;
  filter:brightness(0) invert(1);opacity:.9;
}
.wl-logo-name{
  font-family:'Playfair Display',serif;
  font-size:22px;font-weight:800;
  color:rgba(255,255,255,.9);
  letter-spacing:.5px;
}

.wl-clock{
  display:flex;align-items:center;gap:7px;
  padding:8px 18px;border-radius:30px;
  background:rgba(255,255,255,.1);
  backdrop-filter:blur(12px);
  border:1px solid rgba(255,255,255,.15);
  font-size:13px;font-weight:700;color:rgba(255,255,255,.85);
}
.wl-clock i{color:#b480ff;font-size:11px;}

/* ── centre text block ── */
.wl-center{
  flex:1;display:flex;flex-direction:column;
  justify-content:center;
  max-width:600px;
  padding:20px 0;
}

.wl-greeting{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 16px;border-radius:30px;
  background:rgba(180,128,255,.2);
  border:1px solid rgba(180,128,255,.35);
  backdrop-filter:blur(8px);
  font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;
  color:rgba(255,255,255,.85);margin-bottom:20px;
  animation:fadeLeft .7s .25s both;
}
.wl-greeting i{color:#b480ff;font-size:10px;}

@keyframes fadeLeft{from{opacity:0;transform:translateX(-30px);}to{opacity:1;transform:translateX(0);}}

.wl-title{
  font-family:'Playfair Display',serif;
  font-size:clamp(44px,5.5vw,76px);
  font-weight:800;color:white;line-height:1.1;
  text-shadow:0 4px 32px rgba(0,0,0,.4);
  margin-bottom:20px;
  animation:fadeLeft .7s .4s both;
}
.wl-title span{
  font-style:italic;
  background:linear-gradient(135deg,#b480ff,#d3aa95);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  text-shadow:none;
}

.wl-desc{
  font-size:16px;color:rgba(255,255,255,.6);
  line-height:1.8;max-width:440px;
  font-weight:400;margin-bottom:36px;
  animation:fadeLeft .7s .55s both;
}

/* stats pills */
.wl-stats{
  display:flex;gap:12px;flex-wrap:wrap;
  margin-bottom:40px;
  animation:fadeLeft .7s .65s both;
}
.wl-stat{
  display:flex;align-items:center;gap:10px;
  padding:12px 20px;border-radius:30px;
  background:rgba(255,255,255,.1);
  backdrop-filter:blur(14px);
  border:1px solid rgba(255,255,255,.14);
  transition:all .25s;
}
.wl-stat:hover{
  background:rgba(255,255,255,.16);
  border-color:rgba(180,128,255,.4);
  transform:translateY(-2px);
}
.wl-stat-ic{
  width:32px;height:32px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;font-size:13px;
}
.wl-stat-ic.v{background:rgba(180,128,255,.3);color:#b480ff;}
.wl-stat-ic.o{background:rgba(249,115,22,.3);color:#f97316;}
.wl-stat-num{
  font-size:22px;font-weight:900;color:white;line-height:1;
}
.wl-stat-lbl{font-size:11px;color:rgba(255,255,255,.5);font-weight:500;}

/* CTA BUTTON */
.wl-btn{
  display:inline-flex;align-items:center;gap:12px;
  padding:18px 40px;border-radius:60px;
  background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);
  color:white;font-size:16px;font-weight:800;
  text-decoration:none;border:none;cursor:pointer;
  font-family:'Plus Jakarta Sans',sans-serif;

  transition:all .3s cubic-bezier(.175,.885,.32,1.275);
  position:relative;overflow:hidden;
  animation:fadeLeft .7s .75s both;
}
.wl-btn::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.08),transparent 50%);
}
.wl-btn::after{
  content:'';position:absolute;
  width:200px;height:200px;border-radius:50%;
  background:rgba(255,255,255,.04);
  top:-60px;right:-40px;
  transition:transform .4s;
}
.wl-btn:hover{
  transform:translateY(-4px) scale(1.02);
}
.wl-btn:hover::after{transform:scale(1.4);}
.wl-btn span,.wl-btn i{position:relative;z-index:1;}
.wl-btn .arr{transition:transform .25s;position:relative;z-index:1;}
.wl-btn:hover .arr{transform:translateX(6px);}

/* ── bottom bar ── */
.wl-bottom{
  display:flex;align-items:center;justify-content:space-between;
  animation:fadeUp .6s .9s both;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}

.wl-bottom-links{display:flex;gap:8px;}
.wl-bl{
  display:inline-flex;align-items:center;gap:5px;
  padding:7px 14px;border-radius:20px;
  background:rgba(255,255,255,.07);
  backdrop-filter:blur(8px);
  border:1px solid rgba(255,255,255,.1);
  color:rgba(255,255,255,.55);
  font-size:11px;font-weight:600;text-decoration:none;
  transition:all .2s;
}
.wl-bl:hover{
  color:rgba(255,255,255,.9);
  background:rgba(255,255,255,.13);
  border-color:rgba(180,128,255,.3);
}
.wl-bl i{font-size:9px;}

.wl-bottom-brand{
  font-size:11px;color:rgba(255,255,255,.25);
  letter-spacing:1.5px;text-transform:uppercase;
}

/* ── avatar mini (bottom right) ── */
.wl-av-mini{
  display:flex;align-items:center;gap:10px;
  padding:8px 16px 8px 8px;border-radius:30px;
  background:rgba(255,255,255,.09);
  backdrop-filter:blur(12px);
  border:1px solid rgba(255,255,255,.12);
}
.wl-av-img{
  width:34px;height:34px;border-radius:50%;
  border:2px solid rgba(180,128,255,.5);overflow:hidden;
  background:linear-gradient(135deg,#b480ff,#d3aa95);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.wl-av-img img{width:100%;height:100%;object-fit:cover;}
.wl-av-init{font-size:14px;font-weight:900;color:white;}
.wl-av-info{}
.wl-av-name-sm{font-size:12px;font-weight:700;color:rgba(255,255,255,.85);}
.wl-av-role-sm{font-size:10px;color:rgba(255,255,255,.4);}

/* responsive */
@media(max-width:768px){
  .wl-content{padding:24px 24px 30px;}
  .wl-title{font-size:clamp(34px,8vw,52px);}
  .wl-desc{font-size:14px;}
  .wl-bottom{flex-direction:column;align-items:flex-start;gap:12px;}
  .wl-top .wl-logo-name{display:none;}
}

/* logout btn */
.wl-logout-btn{
  display:inline-flex;align-items:center;gap:7px;
  padding:8px 18px;border-radius:30px;
  background:rgba(255,255,255,.08);
  backdrop-filter:blur(12px);
  border:1px solid rgba(255,255,255,.12);
  color:rgba(255,255,255,.6);
  font-size:12px;font-weight:600;cursor:pointer;
  font-family:'Plus Jakarta Sans',sans-serif;
  transition:all .2s;
}
.wl-logout-btn:hover{
  background:rgba(239,68,68,.15);
  border-color:rgba(239,68,68,.3);
  color:rgba(255,100,100,.9);
}
.wl-logout-btn i{font-size:11px;}
</style>
</head>
<body>

{{-- ══ PHOTO ══════════════════════════════════════════════════════ --}}
<div class="wl-photo"></div>
<div class="wl-overlay"></div>
<div class="wl-particles" id="particles"></div>

{{-- ══ CONTENT ═════════════════════════════════════════════════════ --}}
<div class="wl-content">

  {{-- TOP BAR --}}
  <div class="wl-top">
    <div class="wl-logo">
      <span class="wl-logo-name">Glow Institute</span>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
      <div class="wl-clock">
        <i class="fa-regular fa-clock"></i>
        <span id="topTime">--:--</span>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="wl-logout-btn">
          <i class="fa-solid fa-right-from-bracket"></i>
          Sign Out
        </button>
      </form>
    </div>
  </div>

  {{-- CENTRE --}}
  <div class="wl-center">
    <h1 class="wl-title">
      Welcome back,<br>
      <span>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
    </h1>

    <p class="wl-desc">
      Your clients are waiting. Your space is ready.<br>
      Step in and let your artistry shine today.
    </p>

    <div class="wl-stats">
      <div class="wl-stat">
        <div class="wl-stat-ic v"><i class="fa-regular fa-calendar-check"></i></div>
        <div>
          <div class="wl-stat-num">{{ $nbRdvAujourdhui }}</div>
          <div class="wl-stat-lbl">Today's appointments</div>
        </div>
      </div>
      @if($nbEnAttente > 0)
      <div class="wl-stat">
        <div class="wl-stat-ic o"><i class="fa-solid fa-hourglass-half"></i></div>
        <div>
          <div class="wl-stat-num">{{ $nbEnAttente }}</div>
          <div class="wl-stat-lbl">Pending requests</div>
        </div>
      </div>
      @endif
    </div>

    <a href="{{ route('estheticienne.dashboard') }}" class="wl-btn">
      <i class="fa-solid fa-sparkles"></i>
      <span>Enter My Space</span>
      <i class="fa-solid fa-arrow-right arr"></i>
    </a>
  </div>

  {{-- BOTTOM BAR --}}
  <div class="wl-bottom">
    <div class="wl-bottom-brand">Glow Institute &mdash; Expert Portal</div>
  </div>

</div>

<script>
// ── clock + greeting ───────────────────────────────────────────────
function tick(){
  const now=new Date(), h=now.getHours(), m=now.getMinutes();
  const ts=String(h).padStart(2,'0')+':'+String(m).padStart(2,'0');
  document.getElementById('topTime').textContent=ts;
}
tick(); setInterval(tick,1000);

// ── floating particles ─────────────────────────────────────────────
const colors=['rgba(180,128,255,0.5)','rgba(211,170,149,0.4)','rgba(255,255,255,0.35)','rgba(236,72,153,0.3)'];
const wrap=document.getElementById('particles');
for(let i=0;i<40;i++){
  const p=document.createElement('div');
  p.className='p';
  const sz=Math.random()*5+2;
  Object.assign(p.style,{
    left:  Math.random()*100+'%',
    top:   (60+Math.random()*50)+'%',
    width: sz+'px', height:sz+'px',
    background: colors[Math.floor(Math.random()*colors.length)],
    animationDuration: (Math.random()*14+10)+'s',
    animationDelay:    (Math.random()*18)+'s',
  });
  wrap.appendChild(p);
}
</script>
</body>
</html>
