<x-app-layout>
<x-slot name="header">My Reviews</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.avis-wrap { margin:-24px; padding:0; background:#f8f5ff; }

/* ── HERO ── */
.avis-hero {
    position:relative; overflow:hidden;
    padding:44px 32px 90px;
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);
}
.avis-hero-dots { position:absolute; inset:0; background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px); background-size:28px 28px; }
.avis-hero-orb1 { position:absolute; width:300px; height:300px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-80px; right:-60px; animation:orbF 7s ease-in-out infinite alternate; }
.avis-hero-orb2 { position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%); bottom:-40px; left:80px; animation:orbF 10s ease-in-out 2s infinite alternate; }
@keyframes orbF{ from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);} }
.avis-hero-content { position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px; }
.avis-hero-tag { display:inline-flex; align-items:center; gap:7px; padding:5px 16px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:14px; }
.avis-hero-title { font-family:'Playfair Display',serif; font-size:34px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.15); margin-bottom:6px; line-height:1.2; }
.avis-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.35); text-underline-offset:4px; }
.avis-hero-sub { font-size:13px; color:rgba(255,255,255,0.8); line-height:1.7; }
.avis-hero-stats { display:flex; gap:10px; flex-wrap:wrap; }
.avis-hero-stat { display:flex; align-items:center; gap:10px; padding:11px 16px; border-radius:20px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); }
.avis-hero-stat-ic { width:28px; height:28px; border-radius:50%; background:rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; font-size:12px; color:white; }
.avis-hero-stat-num { font-size:20px; font-weight:900; color:white; line-height:1; }
.avis-hero-stat-lbl { font-size:10px; color:rgba(255,255,255,0.7); }
.avis-wave { position:absolute; bottom:-2px; left:0; right:0; height:60px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.avis-body { padding:24px; }

/* STATS CARDS */
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:18px; }
.stat-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    padding:20px; text-align:center;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s forwards; transition:all 0.25s;
}
.stat-card:nth-child(1){animation-delay:.05s} .stat-card:nth-child(2){animation-delay:.1s}
.stat-card:nth-child(3){animation-delay:.15s} .stat-card:nth-child(4){animation-delay:.2s}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.stat-ic { width:38px; height:38px; border-radius:11px; margin:0 auto 12px; display:flex; align-items:center; justify-content:center; font-size:16px; }
.stat-ic.v { background:rgba(180,128,255,0.1); color:#b480ff; }
.stat-ic.y { background:rgba(245,158,11,0.1);  color:#f59e0b; }
.stat-ic.g { background:rgba(16,185,129,0.1);  color:#059669; }
.stat-ic.p { background:rgba(147,51,234,0.1);  color:#9333ea; }
.stat-value { font-size:28px; font-weight:900; line-height:1; margin-bottom:5px; color:#b480ff; }
.stat-value.yellow { color:#f59e0b; }
.stat-value.green  { color:#059669; }
.stat-value.purple { color:#9333ea; }
.stat-label { font-size:11px; color:#9ca3af; font-weight:500; }

/* RATING BREAKDOWN */
.rating-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    padding:22px 24px; margin-bottom:18px;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s .25s forwards;
}
.rating-card-title { font-size:14px; font-weight:800; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
.rating-card-title .ci { width:28px; height:28px; border-radius:8px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:12px; }
.rating-avg { display:flex; align-items:center; gap:24px; }
.rating-big { font-size:52px; font-weight:900; color:#b480ff; line-height:1; }
.rating-stars { display:flex; gap:3px; margin-bottom:4px; }
.star { font-size:18px; }
.star.filled { color:#f59e0b; }
.star.empty  { color:#e5e7eb; }
.rating-sub { font-size:12px; color:#9ca3af; }
.rating-bars { flex:1; }
.bar-row { display:flex; align-items:center; gap:10px; margin-bottom:8px; }
.bar-row:last-child { margin-bottom:0; }
.bar-label { font-size:11px; color:#6b7280; width:30px; text-align:right; flex-shrink:0; font-weight:600; }
.bar-track { flex:1; height:8px; background:#f3f0ff; border-radius:20px; overflow:hidden; }
.bar-fill  { height:100%; border-radius:20px; background:linear-gradient(to right,#b480ff,#d3aa95); transition:width 0.6s ease; }
.bar-count { font-size:11px; color:#9ca3af; width:20px; flex-shrink:0; font-weight:600; }

/* REVIEWS LIST */
.reviews-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    overflow:hidden; box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s .35s forwards;
}
.reviews-head {
    padding:16px 20px; border-bottom:1px solid #ede9fe;
    display:flex; align-items:center; justify-content:space-between;
    background:linear-gradient(135deg,rgba(180,128,255,0.04),rgba(211,170,149,0.02));
}
.reviews-head h3 { font-size:14px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.reviews-head h3 i { color:#b480ff; }
.reviews-head .avis-count-badge { font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }

.review-item { padding:18px 20px; border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.review-item:last-child { border-bottom:none; }
.review-item:hover { background:#fdf9ff; }
.review-top { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:12px; }
.review-av { width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:13px; font-weight:800; flex-shrink:0; }
.review-client { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:3px; }
.review-date   { font-size:11px; color:#9ca3af; display:flex; align-items:center; gap:3px; }
.review-date i { font-size:9px; color:#b480ff; }
.review-stars  { display:flex; gap:2px; }
.review-star   { font-size:14px; }
.review-star.filled { color:#f59e0b; }
.review-star.empty  { color:#e5e7eb; }
.review-comment { font-size:13px; color:#374151; line-height:1.7; font-style:italic; background:#fdf9ff; padding:12px 14px; border-radius:12px; border-left:3px solid rgba(180,128,255,0.3); }
.review-no-comment { font-size:12px; color:#d1d5db; font-style:italic; padding:4px 0; display:flex; align-items:center; gap:5px; }
.review-no-comment i { font-size:10px; }

.avis-empty { text-align:center; padding:60px 24px; }
.avis-empty i { font-size:48px; color:#e9d8fd; margin-bottom:14px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float{0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);}}
.avis-empty p { font-size:14px; color:#d1d5db; line-height:1.7; }
.avis-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }

@media(max-width:768px){ .stats-grid{grid-template-columns:1fr 1fr;} .rating-avg{flex-direction:column;} }
</style>

<div class="avis-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="avis-hero">
        <div class="avis-hero-dots"></div>
        <div class="avis-hero-orb1"></div>
        <div class="avis-hero-orb2"></div>
        <div class="avis-hero-content">
            <div>
                <div class="avis-hero-tag"><i class="fa-solid fa-star"></i> Client Feedback</div>
                <h1 class="avis-hero-title">My <span>Reviews</span></h1>
                <p class="avis-hero-sub">See what your clients think about your work.</p>
            </div>
            <div class="avis-hero-stats">
                <div class="avis-hero-stat">
                    <div class="avis-hero-stat-ic"><i class="fa-solid fa-star"></i></div>
                    <div>
                        <div class="avis-hero-stat-num">{{ number_format($stats['note_moyenne'],1) }}/5</div>
                        <div class="avis-hero-stat-lbl">Avg rating</div>
                    </div>
                </div>
                <div class="avis-hero-stat">
                    <div class="avis-hero-stat-ic"><i class="fa-solid fa-comments"></i></div>
                    <div>
                        <div class="avis-hero-stat-num">{{ $stats['total'] }}</div>
                        <div class="avis-hero-stat-lbl">Reviews</div>
                    </div>
                </div>
                <div class="avis-hero-stat">
                    <div class="avis-hero-stat-ic"><i class="fa-solid fa-thumbs-up"></i></div>
                    <div>
                        <div class="avis-hero-stat-num">{{ $stats['note_5'] }}</div>
                        <div class="avis-hero-stat-lbl">5-star</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="avis-wave"></div>
    </div>

    <div class="avis-body">

        {{-- STATS CARDS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-ic v"><i class="fa-solid fa-comments"></i></div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Reviews</div>
            </div>
            <div class="stat-card">
                <div class="stat-ic y"><i class="fa-solid fa-star-half-stroke"></i></div>
                <div class="stat-value yellow">{{ number_format($stats['note_moyenne'],1) }}</div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-ic y"><i class="fa-solid fa-star"></i></div>
                <div class="stat-value yellow">{{ $stats['note_5'] }}</div>
                <div class="stat-label">5-Star Reviews</div>
            </div>
            <div class="stat-card">
                <div class="stat-ic g"><i class="fa-solid fa-thumbs-up"></i></div>
                <div class="stat-value green">{{ $stats['note_4'] + $stats['note_5'] }}</div>
                <div class="stat-label">Positive Reviews</div>
            </div>
        </div>

        {{-- RATING BREAKDOWN --}}
        @if($stats['total'] > 0)
        <div class="rating-card">
            <div class="rating-card-title">
                <div class="ci" style="width:28px;height:28px;border-radius:8px;background:rgba(180,128,255,0.1);color:#b480ff;display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;">
                    <i class="fa-solid fa-chart-bar"></i>
                </div>
                Rating Breakdown
            </div>
            <div class="rating-avg">
                <div style="text-align:center;flex-shrink:0;">
                    <div class="rating-big">{{ number_format($stats['note_moyenne'],1) }}</div>
                    <div class="rating-stars">
                        @for($i=1;$i<=5;$i++)
                            <span class="star {{ $i<=round($stats['note_moyenne'])?'filled':'empty' }}">★</span>
                        @endfor
                    </div>
                    <div class="rating-sub">{{ $stats['total'] }} review(s)</div>
                </div>
                <div class="rating-bars">
                    @foreach([5,4,3,2,1] as $note)
                        @php
                            $count = $stats['note_'.$note];
                            $pct   = $stats['total'] > 0 ? ($count / $stats['total']) * 100 : 0;
                        @endphp
                        <div class="bar-row">
                            <div class="bar-label">{{ $note }}★</div>
                            <div class="bar-track">
                                <div class="bar-fill" style="width:{{ $pct }}%;"></div>
                            </div>
                            <div class="bar-count">{{ $count }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- REVIEWS LIST --}}
        <div class="reviews-card">
            <div class="reviews-head">
                <h3><i class="fa-solid fa-comments"></i> Client Reviews</h3>
                @if($stats['total'] > 0)
                    <span class="avis-count-badge">{{ $stats['total'] }} review(s)</span>
                @endif
            </div>

            @if($avis->isEmpty())
                <div class="avis-empty">
                    <i class="fa-regular fa-star"></i>
                    <p>No reviews yet.<br>Complete appointments to receive feedback!</p>
                </div>
            @else
                @foreach($avis as $av)
                    <div class="review-item">
                        <div class="review-top">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="review-av">{{ strtoupper(substr($av->client->prenom,0,1)) }}</div>
                                <div>
                                    <div class="review-client">{{ $av->client->fullName() }}</div>
                                    <div class="review-date">
                                        <i class="fa-regular fa-calendar"></i>
                                        {{ $av->created_at->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="review-stars">
                                @for($i=1;$i<=5;$i++)
                                    <span class="review-star {{ $i<=$av->note?'filled':'empty' }}">★</span>
                                @endfor
                            </div>
                        </div>
                        @if($av->commentaire)
                            <div class="review-comment">"{{ $av->commentaire }}"</div>
                        @else
                            <div class="review-no-comment">
                                <i class="fa-regular fa-comment-slash"></i> No comment left.
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="avis-pagination">{{ $avis->links() }}</div>
            @endif
        </div>

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
