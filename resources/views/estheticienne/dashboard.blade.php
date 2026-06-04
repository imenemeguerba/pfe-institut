<x-app-layout>
<x-slot name="header">Dashboard</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.db-wrap { margin:-24px; padding:24px; background:#f8f5ff; min-height:calc(100vh - 70px); }

/* ── WELCOME BANNER ── */
.welcome-banner {
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);
    border-radius:20px; padding:26px 28px; margin-bottom:18px;
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:14px; position:relative; overflow:hidden;
}
.wb-orb  { position:absolute; border-radius:50%; pointer-events:none; }
.wb-orb1 { width:220px; height:220px; background:rgba(255,255,255,0.09); top:-70px; right:80px; }
.wb-orb2 { width:140px; height:140px; background:rgba(255,255,255,0.06); bottom:-50px; left:60px; }
.wb-orb3 { width:90px;  height:90px;  background:rgba(255,255,255,0.07); top:10px; right:240px; }
.wb-left  { position:relative; z-index:1; }
.wb-tag   { display:inline-flex; align-items:center; gap:6px; padding:4px 12px; border-radius:20px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.3); color:white; font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:10px; }
.wb-greeting { font-size:22px; font-weight:800; color:white; margin-bottom:4px; }
.wb-sub   { font-size:12px; color:rgba(255,255,255,0.8); display:flex; align-items:center; gap:5px; }
.wb-sub i { font-size:10px; }
.wb-right { position:relative; z-index:1; display:flex; gap:8px; flex-wrap:wrap; }
.wb-btn   { padding:9px 18px; border-radius:30px; font-size:12px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
.wb-btn.white { background:white; color:#b480ff; }
.wb-btn.white:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(0,0,0,0.15); }
.wb-btn.glass { background:rgba(255,255,255,0.18); color:white; border:1px solid rgba(255,255,255,0.3); }
.wb-btn.glass:hover { background:rgba(255,255,255,0.28); }

/* ── QUICK ACTIONS ── */
.qa-card  { background:white; border-radius:16px; border:1px solid #ede9fe; padding:16px 20px; margin-bottom:18px; box-shadow:0 2px 12px rgba(180,128,255,0.05); }
.qa-title { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; margin-bottom:12px; display:flex; align-items:center; gap:6px; }
.qa-title i { color:#b480ff; }
.qa-grid  { display:flex; flex-wrap:wrap; gap:8px; }
.qa-btn   { padding:8px 16px; border-radius:30px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; border:1.5px solid transparent; }
.qa-btn:hover { transform:translateY(-2px); }
.qa-btn.violet { background:#f5f0ff; color:#7c3aed; border-color:#ede9fe; }
.qa-btn.violet:hover { background:#ede9fe; }
.qa-btn.green  { background:rgba(16,185,129,0.08); color:#059669; border-color:rgba(16,185,129,0.2); }
.qa-btn.green:hover  { background:rgba(16,185,129,0.14); }
.qa-btn.red    { background:rgba(239,68,68,0.06); color:#ef4444; border-color:rgba(239,68,68,0.2); }
.qa-btn.red:hover    { background:rgba(239,68,68,0.12); }
.qa-btn.gray   { background:#f9fafb; color:#374151; border-color:#e5e7eb; }
.qa-btn.gray:hover   { background:#f3f4f6; }
.qa-btn.pink   { background:rgba(236,72,153,0.06); color:#db2777; border-color:rgba(236,72,153,0.2); }
.qa-btn.pink:hover   { background:rgba(236,72,153,0.12); }

/* ── STATS GRID ── */
.stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:18px; }
.stat-card  {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    padding:20px; text-decoration:none; transition:all 0.3s;
    display:block; position:relative; overflow:hidden;
    opacity:0; animation:statIn 0.5s forwards;
    box-shadow:0 2px 12px rgba(180,128,255,0.05);
}
.stat-card:nth-child(1){ animation-delay:0.05s; }
.stat-card:nth-child(2){ animation-delay:0.1s; }
.stat-card:nth-child(3){ animation-delay:0.15s; }
.stat-card:nth-child(4){ animation-delay:0.2s; }
.stat-card:nth-child(5){ animation-delay:0.25s; }
.stat-card:nth-child(6){ animation-delay:0.3s; }
@keyframes statIn { from{opacity:0;transform:translateY(16px);} to{opacity:1;transform:translateY(0);} }
.stat-card:hover { transform:translateY(-4px); box-shadow:0 12px 32px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.stat-card::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(180,128,255,0.03),transparent); opacity:0; transition:opacity 0.3s; }
.stat-card:hover::before { opacity:1; }
.stat-card.urgent { border-left:3px solid #f97316; }
.stat-icon-wrap { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:12px; font-size:16px; }
.stat-icon-wrap.violet { background:rgba(180,128,255,0.12); color:#b480ff; }
.stat-icon-wrap.orange { background:rgba(249,115,22,0.1); color:#f97316; }
.stat-icon-wrap.green  { background:rgba(16,185,129,0.1); color:#059669; }
.stat-icon-wrap.blue   { background:rgba(37,99,235,0.1); color:#2563eb; }
.stat-icon-wrap.pink   { background:rgba(236,72,153,0.1); color:#db2777; }
.stat-icon-wrap.gray   { background:#f3f4f6; color:#6b7280; }
.stat-label { font-size:11px; color:#9ca3af; font-weight:500; margin-bottom:6px; }
.stat-value { font-size:30px; font-weight:800; color:#1a1a2e; line-height:1; }
.stat-value.violet { color:#b480ff; }
.stat-value.orange { color:#f97316; }
.stat-value.green  { color:#059669; }
.stat-sub   { font-size:10px; color:#c4b5fd; margin-top:5px; display:flex; align-items:center; gap:4px; }

/* ── RDV CARD ── */
.rdv-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    overflow:hidden; box-shadow:0 2px 12px rgba(180,128,255,0.05);
    opacity:0; animation:statIn 0.5s 0.35s forwards;
}
.rdv-card-head { display:flex; align-items:center; justify-content:space-between; padding:16px 20px; border-bottom:1px solid #faf8ff; }
.rdv-card-head h3 { font-size:14px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.rdv-card-head h3 i { color:#b480ff; }
.rdv-see-all { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; padding:5px 12px; border-radius:20px; background:rgba(180,128,255,0.08); transition:all 0.2s; }
.rdv-see-all:hover { background:rgba(180,128,255,0.15); }
.rdv-item { display:flex; align-items:center; justify-content:space-between; padding:14px 20px; border-bottom:1px solid #faf8ff; transition:background 0.15s; gap:12px; }
.rdv-item:last-child { border-bottom:none; }
.rdv-item:hover { background:#fdf9ff; }
.rdv-av   { width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:13px; font-weight:700; flex-shrink:0; }
.rdv-name { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:2px; }
.rdv-time { font-size:11px; color:#9ca3af; display:flex; align-items:center; gap:4px; }
.rdv-time i { font-size:9px; color:#b480ff; }
.rdv-tags { display:flex; flex-wrap:wrap; gap:4px; margin-top:5px; }
.rdv-tag  { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; font-weight:600; }
.rdv-status { font-size:10px; font-weight:700; padding:4px 10px; border-radius:20px; display:inline-block; }
.rdv-status.confirme   { background:rgba(16,185,129,0.1); color:#059669; }
.rdv-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.rdv-link { font-size:11px; color:#b480ff; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:3px; padding:5px 10px; border-radius:16px; background:rgba(180,128,255,0.06); transition:all 0.2s; }
.rdv-link:hover { background:rgba(180,128,255,0.14); }
.rdv-empty { padding:36px; text-align:center; }
.rdv-empty i { font-size:36px; color:#e9d8fd; display:block; margin-bottom:10px; }
.rdv-empty p { font-size:13px; color:#d1d5db; }

@media(max-width:768px){ .stats-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:480px){ .stats-grid{ grid-template-columns:1fr; } }
</style>

<div class="db-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- WELCOME BANNER --}}
    <div class="welcome-banner">
        <div class="wb-orb wb-orb1"></div>
        <div class="wb-orb wb-orb2"></div>
        <div class="wb-orb wb-orb3"></div>
        <div class="wb-left">
            <div class="wb-tag"><i class="fa-solid fa-spa"></i> Expert Space</div>
            <div class="wb-greeting">Hello, {{ Auth::user()->prenom }} 💄</div>
            <div class="wb-sub">
                <i class="fa-regular fa-calendar"></i>
                {{ now()->isoFormat('dddd D MMMM YYYY') }} — Welcome back to your space.
            </div>
        </div>
        <div class="wb-right">
            <a href="{{ route('estheticienne.disponibilites.create') }}" class="wb-btn white">
                <i class="fa-solid fa-plus"></i> Add Availability
            </a>
            <a href="{{ route('estheticienne.rendez-vous.index') }}" class="wb-btn glass">
                <i class="fa-solid fa-calendar-check"></i> My Appointments
            </a>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="qa-card">
        <div class="qa-title"><i class="fa-solid fa-grip"></i> My Space</div>
        <div class="qa-grid">
            <a href="{{ route('estheticienne.planning.index') }}" class="qa-btn violet">
                <i class="fa-solid fa-calendar-days"></i> My Schedule
            </a>
            <a href="{{ route('estheticienne.rendez-vous.index') }}" class="qa-btn violet">
                <i class="fa-solid fa-list-check"></i> My Appointments
            </a>
            <a href="{{ route('estheticienne.performance.index') }}" class="qa-btn violet">
                <i class="fa-solid fa-chart-line"></i> Performance
            </a>
            <a href="{{ route('estheticienne.disponibilites.create') }}" class="qa-btn green">
                <i class="fa-solid fa-plus"></i> Add Availability
            </a>
            <a href="{{ route('estheticienne.indisponibilites.create') }}" class="qa-btn red">
                <i class="fa-solid fa-ban"></i> Report Absence
            </a>
            <a href="{{ route('estheticienne.avant-apres.index') }}" class="qa-btn pink">
                <i class="fa-solid fa-images"></i> Before / After
            </a>
            <a href="{{ route('estheticienne.contact.index') }}" class="qa-btn gray">
                <i class="fa-solid fa-envelope"></i> Contact
            </a>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">
        <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>'a_venir']) }}" class="stat-card">
            <div class="stat-icon-wrap violet"><i class="fa-regular fa-calendar-check"></i></div>
            <div class="stat-label">Today's Appointments</div>
            <div class="stat-value violet">{{ $stats['rdv_aujourdhui'] }}</div>
        </a>
        <a href="{{ route('estheticienne.rendez-vous.index', ['filtre'=>'en_attente']) }}"
           class="stat-card {{ $stats['rdv_a_traiter'] > 0 ? 'urgent' : '' }}">
            <div class="stat-icon-wrap {{ $stats['rdv_a_traiter'] > 0 ? 'orange' : 'violet' }}">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div class="stat-label">Pending Requests</div>
            <div class="stat-value {{ $stats['rdv_a_traiter'] > 0 ? 'orange' : '' }}">{{ $stats['rdv_a_traiter'] }}</div>
        </a>
        <a href="{{ route('estheticienne.performance.index') }}" class="stat-card">
            <div class="stat-icon-wrap green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-label">Done This Month</div>
            <div class="stat-value green">{{ $stats['rdv_du_mois'] }}</div>
        </a>
        <a href="{{ route('estheticienne.performance.index') }}" class="stat-card">
            <div class="stat-icon-wrap pink"><i class="fa-solid fa-star"></i></div>
            <div class="stat-label">Published Reviews</div>
            <div class="stat-value">{{ $stats['avis_recus'] }}</div>
        </a>
        <a href="{{ route('estheticienne.performance.index') }}" class="stat-card">
            <div class="stat-icon-wrap violet"><i class="fa-solid fa-star-half-stroke"></i></div>
            <div class="stat-label">Average Rating</div>
            <div class="stat-value violet">
                {{ number_format($stats['note_moyenne'], 1) }}
                <span style="font-size:14px;color:#9ca3af;font-weight:600;">/5</span>
            </div>
        </a>
        <a href="{{ route('estheticienne.planning.index') }}" class="stat-card">
            <div class="stat-icon-wrap blue"><i class="fa-regular fa-calendar"></i></div>
            <div class="stat-label">Configured Slots</div>
            <div class="stat-value">{{ $stats['nb_disponibilites'] }}</div>
            <div class="stat-sub"><i class="fa-solid fa-circle" style="font-size:5px;"></i> in my schedule</div>
        </a>
    </div>

    {{-- UPCOMING RDV --}}
    <div class="rdv-card">
        <div class="rdv-card-head">
            <h3><i class="fa-solid fa-calendar-check"></i> Upcoming Appointments</h3>
            <a href="{{ route('estheticienne.rendez-vous.index') }}" class="rdv-see-all">
                View all <i class="fa-solid fa-arrow-right" style="font-size:9px;"></i>
            </a>
        </div>
        @if(isset($rdvAVenir) && $rdvAVenir->isNotEmpty())
            @foreach($rdvAVenir as $rdv)
                <div class="rdv-item">
                    <div style="display:flex;align-items:center;gap:12px;flex:1;min-width:0;">
                        <div class="rdv-av">{{ strtoupper(substr($rdv->client->prenom, 0, 1)) }}</div>
                        <div style="min-width:0;">
                            <div class="rdv-name">{{ $rdv->client->fullName() }}</div>
                            <div class="rdv-time">
                                <i class="fa-regular fa-clock"></i>
                                {{ $rdv->date_debut->isoFormat('ddd D MMM') }} at {{ $rdv->date_debut->format('H:i') }}
                                <span style="color:#c4b5fd;">·</span>
                                {{ $rdv->duree_totale }} min
                            </div>
                            <div class="rdv-tags">
                                @foreach($rdv->services->take(3) as $s)
                                    <span class="rdv-tag">{{ $s->nom }}</span>
                                @endforeach
                                @if($rdv->services->count() > 3)
                                    <span class="rdv-tag">+{{ $rdv->services->count() - 3 }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;flex-shrink:0;">
                        <span class="rdv-status {{ $rdv->statut }}">
                            @if($rdv->statut === 'confirme')
                                <i class="fa-solid fa-check" style="font-size:8px;"></i> Confirmed
                            @else
                                <i class="fa-solid fa-clock" style="font-size:8px;"></i> Pending
                            @endif
                        </span>
                        <a href="{{ route('estheticienne.rendez-vous.show', $rdv) }}" class="rdv-link">
                            View <i class="fa-solid fa-arrow-right" style="font-size:9px;"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="rdv-empty">
                <i class="fa-regular fa-calendar-xmark"></i>
                <p>No upcoming appointments yet.</p>
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
