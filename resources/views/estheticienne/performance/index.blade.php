<x-app-layout>
<x-slot name="header">My Performance</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.perf-wrap { margin:-24px; padding:0; background:#f8f5ff; }

/* ── HERO ── */
.perf-hero {
    position:relative; overflow:hidden; padding:44px 32px 90px;
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);
    margin:0 0 0 0;
}
.perf-hero-dots {
    position:absolute; inset:0;
    background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px);
    background-size:28px 28px;
}
.perf-hero-orb1 { position:absolute; width:300px; height:300px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-80px; right:-60px; animation:orbFloat 7s ease-in-out infinite alternate; }
.perf-hero-orb2 { position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%); bottom:-50px; left:80px; animation:orbFloat 10s ease-in-out infinite alternate; }
@keyframes orbFloat { from{transform:scale(1)translate(0,0);} to{transform:scale(1.1)translate(20px,-15px);} }
.perf-hero-content { position:relative; z-index:2; }
.perf-hero-tag {
    display:inline-flex; align-items:center; gap:7px;
    padding:5px 16px; border-radius:30px;
    background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35);
    color:white; font-size:11px; font-weight:700; letter-spacing:1.5px;
    text-transform:uppercase; margin-bottom:14px;
}
.perf-hero-title {
    font-family:'Playfair Display',serif;
    font-size:34px; font-weight:800; color:white;
    text-shadow:0 2px 16px rgba(0,0,0,0.15); margin-bottom:8px; line-height:1.2;
}
.perf-hero-title span {
    -webkit-text-fill-color:rgba(255,255,255,0.75);
    text-decoration:underline; text-decoration-color:rgba(255,255,255,0.35);
    text-underline-offset:4px;
}
.perf-hero-sub { font-size:13px; color:rgba(255,255,255,0.8); margin-bottom:24px; line-height:1.7; }
/* hero mini stats */
.perf-hero-stats { display:flex; gap:12px; flex-wrap:wrap; }
.perf-hero-stat {
    display:flex; align-items:center; gap:10px;
    padding:10px 16px; border-radius:20px;
    background:rgba(255,255,255,0.15);
    border:1px solid rgba(255,255,255,0.2);
    backdrop-filter:blur(6px);
}
.perf-hero-stat-ic {
    width:28px; height:28px; border-radius:50%;
    background:rgba(255,255,255,0.2);
    display:flex; align-items:center; justify-content:center;
    font-size:12px; color:white;
}
.perf-hero-stat-num { font-size:20px; font-weight:900; color:white; line-height:1; }
.perf-hero-stat-lbl { font-size:10px; color:rgba(255,255,255,0.7); }
/* wave */
.perf-wave {
    position:absolute; bottom:-2px; left:0; right:0; height:60px;
    background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E")
    no-repeat bottom; background-size:cover;
}

/* ── BODY ── */
.perf-body { padding:24px; }

/* STAT CARDS */
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:18px; }
.stat-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    padding:20px; text-align:center;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s forwards;
    transition:all 0.25s;
}
.stat-card:nth-child(1){animation-delay:.05s}
.stat-card:nth-child(2){animation-delay:.1s}
.stat-card:nth-child(3){animation-delay:.15s}
.stat-card:nth-child(4){animation-delay:.2s}
.stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(180,128,255,0.12); border-color:#c4b5fd; }
@keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.stat-ic { width:40px; height:40px; border-radius:12px; margin:0 auto 12px; display:flex; align-items:center; justify-content:center; font-size:17px; }
.stat-ic.violet { background:rgba(180,128,255,0.1); color:#b480ff; }
.stat-ic.green  { background:rgba(16,185,129,0.1);  color:#059669; }
.stat-ic.yellow { background:rgba(245,158,11,0.1);  color:#f59e0b; }
.stat-ic.purple { background:rgba(147,51,234,0.1);  color:#9333ea; }
.stat-value { font-size:30px; font-weight:900; line-height:1; margin-bottom:5px; }
.stat-value.violet { color:#b480ff; }
.stat-value.green  { color:#059669; }
.stat-value.yellow { color:#f59e0b; }
.stat-value.purple { color:#9333ea; }
.stat-label { font-size:11px; color:#9ca3af; font-weight:500; }

/* CHART */
.chart-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    padding:22px 24px; margin-bottom:18px;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s .25s forwards;
}
.chart-title { font-size:14px; font-weight:800; color:#1a1a2e; margin-bottom:20px; display:flex; align-items:center; gap:8px; }
.chart-title .ci { width:30px; height:30px; border-radius:9px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:13px; }
.bar-chart { display:flex; align-items:flex-end; gap:10px; height:120px; padding-bottom:4px; }
.bar-col { flex:1; display:flex; flex-direction:column; align-items:center; gap:4px; }
.bar-count { font-size:11px; font-weight:800; color:#b480ff; }
.bar-body { width:100%; border-radius:8px 8px 0 0; background:linear-gradient(to top,#b480ff,#d3aa95); transition:height 0.5s ease; min-height:4px; }
.bar-month { font-size:10px; color:#9ca3af; text-align:center; line-height:1.3; font-weight:500; }

/* SECTION CARD */
.section-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    overflow:hidden; margin-bottom:18px;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s forwards;
}
.section-card:nth-of-type(1){animation-delay:.3s}
.section-card:nth-of-type(2){animation-delay:.4s}
.section-head {
    padding:16px 20px; border-bottom:1px solid #faf8ff;
    display:flex; align-items:center; gap:8px;
    background:linear-gradient(135deg,rgba(180,128,255,0.04),rgba(211,170,149,0.02));
}
.section-head h3 { font-size:14px; font-weight:800; color:#1a1a2e; }
.section-head .ci { width:28px; height:28px; border-radius:8px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:12px; }

/* REVIEWS */
.review-item { padding:16px 20px; border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.review-item:last-child { border-bottom:none; }
.review-item:hover { background:#fdf9ff; }
.review-top { display:flex; align-items:center; gap:10px; margin-bottom:10px; flex-wrap:wrap; }
.review-av { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:12px; font-weight:800; flex-shrink:0; }
.review-name { font-size:13px; font-weight:700; color:#1a1a2e; }
.review-date { font-size:11px; color:#9ca3af; margin-left:auto; }
.review-stars { display:flex; gap:2px; }
.star { font-size:14px; }
.star.filled { color:#f59e0b; }
.star.empty  { color:#e5e7eb; }
.review-comment { font-size:12px; color:#374151; line-height:1.7; background:#fdf9ff; padding:10px 12px; border-radius:10px; border-left:3px solid rgba(180,128,255,0.3); margin-bottom:5px; font-style:italic; }
.review-rdv { font-size:10px; color:#c4b5fd; display:flex; align-items:center; gap:4px; }
.section-pagination { padding:14px 20px; border-top:1px solid #faf8ff; }
.section-empty { padding:40px; text-align:center; font-size:13px; color:#d1d5db; }
.section-empty i { font-size:36px; color:#e9d8fd; display:block; margin-bottom:10px; }

/* HISTORY TABLE */
.hist-table { width:100%; border-collapse:collapse; }
.hist-table thead th { padding:11px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.hist-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.hist-table tbody tr:last-child { border-bottom:none; }
.hist-table tbody tr:hover { background:#fdf9ff; }
.hist-table td { padding:13px 16px; vertical-align:middle; }
.hist-date   { font-size:12px; font-weight:700; color:#1a1a2e; }
.hist-time   { font-size:11px; color:#9ca3af; margin-top:2px; display:flex; align-items:center; gap:3px; }
.hist-time i { font-size:9px; color:#b480ff; }
.hist-client { font-size:13px; font-weight:700; color:#1a1a2e; }
.hist-tags   { display:flex; flex-wrap:wrap; gap:4px; }
.hist-tag    { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; font-weight:600; }
.hist-dur    { font-size:12px; color:#6b7280; font-weight:600; display:flex; align-items:center; gap:3px; }
.hist-dur i  { font-size:10px; color:#b480ff; }

@media(max-width:768px){ .stats-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:480px){ .stats-grid{ grid-template-columns:1fr; } }
</style>

<div class="perf-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="perf-hero">
        <div class="perf-hero-dots"></div>
        <div class="perf-hero-orb1"></div>
        <div class="perf-hero-orb2"></div>
        <div class="perf-hero-content">
            <div class="perf-hero-tag">
                <i class="fa-solid fa-chart-line"></i> Performance
            </div>
            <h1 class="perf-hero-title">
                Your <span>Activity</span> &amp; Stats
            </h1>
            <p class="perf-hero-sub">Track your progress, reviews and completed appointments.</p>
            <div class="perf-hero-stats">
                <div class="perf-hero-stat">
                    <div class="perf-hero-stat-ic"><i class="fa-solid fa-circle-check"></i></div>
                    <div>
                        <div class="perf-hero-stat-num">{{ $stats['total_rdv_termines'] }}</div>
                        <div class="perf-hero-stat-lbl">Done total</div>
                    </div>
                </div>
                <div class="perf-hero-stat">
                    <div class="perf-hero-stat-ic"><i class="fa-regular fa-calendar"></i></div>
                    <div>
                        <div class="perf-hero-stat-num">{{ $stats['rdv_ce_mois'] }}</div>
                        <div class="perf-hero-stat-lbl">This month</div>
                    </div>
                </div>
                <div class="perf-hero-stat">
                    <div class="perf-hero-stat-ic"><i class="fa-solid fa-star"></i></div>
                    <div>
                        <div class="perf-hero-stat-num">{{ number_format($stats['note_moyenne'],1) }}/5</div>
                        <div class="perf-hero-stat-lbl">Avg rating</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="perf-wave"></div>
    </div>

    <div class="perf-body">

        {{-- STAT CARDS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-ic violet"><i class="fa-solid fa-circle-check"></i></div>
                <div class="stat-value violet">{{ $stats['total_rdv_termines'] }}</div>
                <div class="stat-label">Done Appointments</div>
            </div>
            <div class="stat-card">
                <div class="stat-ic green"><i class="fa-regular fa-calendar"></i></div>
                <div class="stat-value green">{{ $stats['rdv_ce_mois'] }}</div>
                <div class="stat-label">This Month</div>
            </div>
            <div class="stat-card">
                <div class="stat-ic yellow"><i class="fa-solid fa-star-half-stroke"></i></div>
                <div class="stat-value yellow">
                    {{ number_format($stats['note_moyenne'],1) }}
                    <span style="font-size:14px;color:#9ca3af;font-weight:600;">/5</span>
                </div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-ic purple"><i class="fa-solid fa-star"></i></div>
                <div class="stat-value purple">{{ $stats['total_avis'] }}</div>
                <div class="stat-label">Published Reviews</div>
            </div>
        </div>

        {{-- ACTIVITY CHART --}}
        <div class="chart-card">
            <div class="chart-title">
                <div class="ci"><i class="fa-solid fa-chart-bar"></i></div>
                Activity — Last 6 Months
            </div>
            @php $max = $activiteMois->max('count') ?: 1; @endphp
            <div class="bar-chart">
                @foreach($activiteMois as $m)
                    <div class="bar-col">
                        <div class="bar-count">{{ $m['count'] }}</div>
                        <div class="bar-body" style="height:{{ max(4, ($m['count'] / $max) * 90) }}px;"></div>
                        <div class="bar-month">{{ $m['mois'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- REVIEWS --}}
        <div class="section-card">
            <div class="section-head">
                <div class="ci"><i class="fa-solid fa-star"></i></div>
                <h3>Client Reviews</h3>
            </div>
            @if($avis->isEmpty())
                <div class="section-empty">
                    <i class="fa-regular fa-star"></i>
                    No reviews published yet.
                </div>
            @else
                @foreach($avis as $av)
                    <div class="review-item">
                        <div class="review-top">
                            <div class="review-av">{{ strtoupper(substr($av->client->prenom,0,1)) }}</div>
                            <div class="review-name">{{ $av->client->fullName() }}</div>
                            <div class="review-stars">
                                @for($i=1;$i<=5;$i++)
                                    <span class="star {{ $i<=$av->note?'filled':'empty' }}">★</span>
                                @endfor
                            </div>
                            <div class="review-date">{{ $av->created_at->format('d/m/Y') }}</div>
                        </div>
                        @if($av->commentaire)
                            <div class="review-comment">"{{ $av->commentaire }}"</div>
                        @endif
                        @if($av->rendezVous)
                            <div class="review-rdv">
                                <i class="fa-regular fa-calendar" style="font-size:9px;"></i>
                                Appointment on {{ $av->rendezVous->date_debut->format('d/m/Y') }}
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="section-pagination">{{ $avis->links() }}</div>
            @endif
        </div>

        {{-- HISTORY --}}
        <div class="section-card">
            <div class="section-head">
                <div class="ci"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <h3>Completed Appointments History</h3>
            </div>
            @if($rdvTermines->isEmpty())
                <div class="section-empty">
                    <i class="fa-regular fa-calendar-xmark"></i>
                    No completed appointments yet.
                </div>
            @else
                <div style="overflow-x:auto;">
                    <table class="hist-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Services</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rdvTermines as $rdv)
                                <tr>
                                    <td>
                                        <div class="hist-date">{{ $rdv->date_debut->isoFormat('ddd D MMM YYYY') }}</div>
                                        <div class="hist-time">
                                            <i class="fa-regular fa-clock"></i>
                                            {{ $rdv->date_debut->format('H:i') }} → {{ $rdv->date_fin->format('H:i') }}
                                        </div>
                                    </td>
                                    <td><div class="hist-client">{{ $rdv->client->fullName() }}</div></td>
                                    <td>
                                        <div class="hist-tags">
                                            @foreach($rdv->services->take(3) as $s)
                                                <span class="hist-tag">{{ $s->nom }}</span>
                                            @endforeach
                                            @if($rdv->services->count() > 3)
                                                <span class="hist-tag">+{{ $rdv->services->count()-3 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="hist-dur">
                                            <i class="fa-regular fa-clock"></i> {{ $rdv->duree_totale }} min
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="section-pagination">{{ $rdvTermines->links() }}</div>
            @endif
        </div>

    </div>{{-- end .perf-body --}}
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
