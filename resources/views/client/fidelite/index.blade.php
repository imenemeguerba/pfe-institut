<x-app-layout>
<x-slot name="header">Loyalty Program</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.fd-hero {
    position:relative; overflow:hidden; padding:60px 10% 110px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.fd-stars { position:absolute; inset:0; }
.fd-star { position:absolute; font-size:12px; opacity:0; animation:twinkle ease-in-out infinite; }
@keyframes twinkle { 0%,100%{ opacity:0; transform:scale(0.8); } 50%{ opacity:0.6; transform:scale(1); } }
.fd-hero-content { position:relative; z-index:2; text-align:center; }
.fd-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.25); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.fd-hero-title { font-family:'Playfair Display',serif; font-size:46px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:12px; }
.fd-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.fd-hero-sub { font-size:15px; color:rgba(255,255,255,0.92); margin-bottom:32px; }
.fd-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.fd-body { max-width:900px; margin:0 auto; padding:40px 24px 80px; }

/* ── LEVEL CARD ── */
.fd-level-card { border-radius:28px; overflow:hidden; margin-bottom:24px; box-shadow:0 20px 60px rgba(0,0,0,0.15); opacity:0; animation:fadeUp 0.6s 0.1s forwards; }
@keyframes fadeUp { from{ opacity:0; transform:translateY(20px); } to{ opacity:1; transform:translateY(0); } }
.fd-level-bg { padding:36px; position:relative; overflow:hidden; }
.fd-level-bg.bronze { background:linear-gradient(135deg,#92400e,#b45309,#d97706); }
.fd-level-bg.silver { background:linear-gradient(135deg,#374151,#6b7280,#9ca3af); }
.fd-level-bg.gold   { background:linear-gradient(135deg,#78350f,#b45309,#f59e0b); }
.fd-level-bg::before { content:''; position:absolute; width:300px; height:300px; border-radius:50%; background:rgba(255,255,255,0.06); top:-80px; right:-60px; }
.fd-level-bg::after  { content:''; position:absolute; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,0.04); bottom:-60px; left:-40px; }
.fd-level-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px; position:relative; z-index:2; flex-wrap:wrap; gap:16px; }
.fd-level-sublabel { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.75); margin-bottom:8px; }
.fd-level-badge { font-size:52px; font-weight:900; color:white; display:flex; align-items:center; gap:12px; line-height:1; margin-bottom:10px; }
.fd-level-badge-emoji { animation:bounce 1s ease-in-out infinite alternate; }
@keyframes bounce { from{ transform:translateY(0); } to{ transform:translateY(-6px); } }
.fd-level-pts { font-size:18px; font-weight:700; color:rgba(255,255,255,0.9); }
.fd-level-reduction { display:inline-flex; align-items:center; gap:6px; margin-top:6px; padding:5px 14px; border-radius:20px; background:rgba(255,255,255,0.15); color:white; font-size:13px; font-weight:700; }
.fd-level-right { text-align:right; }
.fd-level-name { font-size:13px; color:rgba(255,255,255,0.8); font-weight:600; }
.fd-level-since { font-size:12px; color:rgba(255,255,255,0.9); margin-top:4px; }

/* PROGRESS BAR */
.fd-progress-wrap { position:relative; z-index:2; }
.fd-progress-labels { display:flex; justify-content:space-between; font-size:12px; color:rgba(255,255,255,0.65); font-weight:600; margin-bottom:8px; }
.fd-progress-track { height:10px; background:rgba(255,255,255,0.2); border-radius:10px; overflow:hidden; }
.fd-progress-fill { height:100%; border-radius:10px; background:linear-gradient(to right,rgba(255,255,255,0.9),rgba(255,255,255,0.5)); transition:width 1.5s ease; position:relative; }
.fd-progress-fill::after { content:''; position:absolute; right:0; top:0; bottom:0; width:4px; border-radius:50%; background:white; box-shadow:0 0 8px rgba(255,255,255,0.8); }
.fd-max-banner { display:flex; align-items:center; justify-content:center; gap:8px; padding:12px; border-radius:14px; background:rgba(255,255,255,0.15); backdrop-filter:blur(4px); color:white; font-size:14px; font-weight:700; margin-top:16px; }

/* ── CARDS ── */
.fd-card { background:white; border-radius:24px; padding:26px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); margin-bottom:20px; opacity:0; animation:fadeUp 0.5s forwards; }
.fd-card:nth-child(2){ animation-delay:0.15s; }
.fd-card:nth-child(3){ animation-delay:0.25s; }
.fd-card:nth-child(4){ animation-delay:0.35s; }
.fd-card-title { font-size:16px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:18px; display:flex; align-items:center; gap:10px; }
.fd-card-icon { width:34px; height:34px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0; }

/* EARN GRID */
.fd-earn-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.fd-earn-item { display:flex; align-items:center; gap:14px; padding:16px; border-radius:16px; border:1.5px solid #ede9fe; background:#fdf9ff; transition:all 0.2s; }
.fd-earn-item:hover { border-color:#b480ff; transform:translateY(-2px); box-shadow:0 8px 24px rgba(180,128,255,0.1); }
.fd-earn-emoji { font-size:32px; }
.fd-earn-label { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.fd-earn-pts { font-size:20px; font-weight:900; }
.fd-earn-pts.rdv   { color:#b480ff; }
.fd-earn-pts.order { color:#d3aa95; }

/* LEVELS GRID */
.fd-levels-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.fd-level-tile { text-align:center; padding:20px 14px; border-radius:18px; border:2px solid #ede9fe; transition:all 0.2s; position:relative; overflow:hidden; }
.fd-level-tile.current { border-color:#b480ff; }
.fd-level-tile.current::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(180,128,255,0.06),rgba(211,170,149,0.04)); }
.fd-level-tile:hover { transform:translateY(-4px); box-shadow:0 10px 30px rgba(180,128,255,0.1); }
.fd-level-tile-emoji   { font-size:40px; margin-bottom:10px; display:block; }
.fd-level-tile-name    { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:4px; }
.fd-level-tile-pts     { font-size:11px; color:#9ca3af; margin-bottom:8px; }
.fd-level-tile-benefit { font-size:13px; font-weight:700; color:#b480ff; }
.fd-level-tile-badge   { margin-top:10px; display:inline-block; padding:3px 12px; border-radius:20px; font-size:10px; font-weight:700; background:#b480ff; color:white; }

/* HISTORY */
.fd-history-item { display:flex; align-items:center; gap:14px; padding:14px 0; border-bottom:1px solid #faf8ff; }
.fd-history-item:last-child { border-bottom:none; }
.fd-history-dot { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0; }
.fd-history-dot.plus  { background:rgba(16,185,129,0.1); }
.fd-history-dot.minus { background:rgba(239,68,68,0.1); }
.fd-history-desc { flex:1; font-size:13px; font-weight:600; color:#1a1a2e; }
.fd-history-date { font-size:11px; color:#9ca3af; margin-top:2px; }
.fd-history-pts { font-size:16px; font-weight:900; white-space:nowrap; }
.fd-history-pts.plus  { color:#059669; }
.fd-history-pts.minus { color:#ef4444; }
.fd-empty-hist { text-align:center; padding:32px; color:#d1d5db; font-size:13px; font-style:italic; }

@media(max-width:640px){ .fd-earn-grid{ grid-template-columns:1fr; } .fd-levels-grid{ grid-template-columns:1fr; } }
</style>

{{-- HERO --}}
<div class="fd-hero">
    <div class="fd-stars" id="stars"></div>
    <div class="fd-hero-content">
        <div class="fd-hero-tag"><i class="fa-solid fa-crown"></i> Loyalty Rewards</div>
        <h1 class="fd-hero-title">Your <span>Rewards</span></h1>
        <p class="fd-hero-sub">Earn points with every visit and unlock exclusive beauty discounts</p>
    </div>
    <div class="fd-wave"></div>
</div>

<div class="fd-body">

    @php
        $niveau = $infos['niveau']['label'];
        $levelClass = strtolower($niveau);
        $pointsSuivant = $infos['pointsSuivant'] ?? null;
        $min = $niveau === 'Bronze' ? 0 : ($niveau === 'Silver' ? 100 : 300);
        $max = $niveau === 'Bronze' ? 100 : ($niveau === 'Silver' ? 300 : 300);
        $pct = $pointsSuivant ? min(100, (($infos['points'] - $min) / ($max - $min)) * 100) : 100;
    @endphp

    {{-- LEVEL CARD --}}
    <div class="fd-level-card">
        <div class="fd-level-bg {{ $levelClass }}">
            <div class="fd-level-top">
                <div>
                    <div class="fd-level-sublabel">Current Level</div>
                    <div class="fd-level-badge">
                        <span class="fd-level-badge-emoji">{{ $infos['niveau']['icon'] }}</span>
                        {{ $infos['niveau']['label'] }}
                    </div>
                    <div class="fd-level-pts"><strong>{{ number_format($infos['points']) }}</strong> points</div>
                    @if($infos['niveau']['reduction'] > 0)
                        <div class="fd-level-reduction">
                            <i class="fa-solid fa-percent" style="font-size:11px;"></i>
                            {{ $infos['niveau']['reduction'] }}% automatic discount on bookings
                        </div>
                    @endif
                </div>
                <div class="fd-level-right">
                    <div class="fd-level-name">{{ $client->fullName() }}</div>
                    <div class="fd-level-since">Member since {{ $client->created_at->format('M Y') }}</div>
                </div>
            </div>

            @if($pointsSuivant)
                @php $nextLabel = $niveau === 'Bronze' ? '🥈 Silver' : '🥇 Gold'; @endphp
                <div class="fd-progress-wrap">
                    <div class="fd-progress-labels">
                        <span>{{ $infos['niveau']['icon'] }} {{ $infos['niveau']['label'] }}</span>
                        <span>{{ $nextLabel }} — {{ $pointsSuivant }} pts away</span>
                    </div>
                    <div class="fd-progress-track">
                        <div class="fd-progress-fill" id="progressBar" style="width:0%"></div>
                    </div>
                </div>
            @else
                <div class="fd-max-banner">
                    <i class="fa-solid fa-trophy"></i> Congratulations! You've reached the maximum level!
                </div>
            @endif
        </div>
    </div>

    {{-- HOW TO EARN --}}
    <div class="fd-card">
        <div class="fd-card-title"><div class="fd-card-icon"><i class="fa-solid fa-star"></i></div> How to Earn Points</div>
        <div class="fd-earn-grid">
            <div class="fd-earn-item">
                <div class="fd-earn-emoji">📅</div>
                <div>
                    <div class="fd-earn-label">Completed Appointment</div>
                    <div class="fd-earn-pts rdv">+10 pts</div>
                </div>
            </div>
            <div class="fd-earn-item">
                <div class="fd-earn-emoji">🛒</div>
                <div>
                    <div class="fd-earn-label">Confirmed Order</div>
                    <div class="fd-earn-pts order">+5 pts</div>
                </div>
            </div>
        </div>
    </div>

    {{-- LEVELS --}}
    <div class="fd-card">
        <div class="fd-card-title"><div class="fd-card-icon"><i class="fa-solid fa-trophy"></i></div> Membership Levels</div>
        <div class="fd-levels-grid">
            @foreach([
                ['🥉','Bronze','0 – 99 pts','Program access','bronze'],
                ['🥈','Silver','100 – 299 pts','5% discount','silver'],
                ['🥇','Gold',  '300+ pts',    '10% discount', 'gold'],
            ] as $niv)
                <div class="fd-level-tile {{ $niveau === $niv[1] ? 'current' : '' }}">
                    <span class="fd-level-tile-emoji">{{ $niv[0] }}</span>
                    <div class="fd-level-tile-name">{{ $niv[1] }}</div>
                    <div class="fd-level-tile-pts">{{ $niv[2] }}</div>
                    <div class="fd-level-tile-benefit">{{ $niv[3] }}</div>
                    @if($niveau === $niv[1])
                        <div class="fd-level-tile-badge">Your level</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- HISTORY --}}
    <div class="fd-card">
        <div class="fd-card-title"><div class="fd-card-icon"><i class="fa-solid fa-clock-rotate-left"></i></div> Points History</div>
        @if($infos['historique']->isEmpty())
            <div class="fd-empty-hist">
                No points yet. Book an appointment or place an order to start earning!
            </div>
        @else
            @foreach($infos['historique'] as $entry)
                @php $isPlus = $entry->points > 0; @endphp
                <div class="fd-history-item">
                    <div class="fd-history-dot {{ $isPlus?'plus':'minus' }}">
                        {{ $isPlus?'⭐':'➖' }}
                    </div>
                    <div style="flex:1;">
                        <div class="fd-history-desc">{{ $entry->description }}</div>
                        <div class="fd-history-date">{{ $entry->created_at->format('d/m/Y at H:i') }}</div>
                    </div>
                    <div class="fd-history-pts {{ $isPlus?'plus':'minus' }}">
                        {{ $isPlus?'+':'' }}{{ $entry->points }} pts
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>

<script>
const starsEl = document.getElementById('stars');
for (let i = 0; i < 30; i++) {
    const s = document.createElement('div');
    s.className = 'fd-star';
    s.textContent = '★';
    s.style.cssText = `left:${Math.random()*100}%;top:${Math.random()*100}%;animation-duration:${Math.random()*3+2}s;animation-delay:${Math.random()*4}s;font-size:${Math.random()*14+8}px;color:rgba(255,255,255,0.3);`;
    starsEl.appendChild(s);
}
setTimeout(() => {
    const bar = document.getElementById('progressBar');
    if (bar) bar.style.width = '{{ $pct }}%';
}, 400);
</script>

</x-app-layout>