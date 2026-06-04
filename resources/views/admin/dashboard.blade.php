<x-app-layout>
<x-slot name="header">Dashboard</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.db-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

/* ── WELCOME BANNER ── */
.db-welcome {
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 45%,#d3aa95 100%);
    border-radius:16px; padding:28px 32px; margin-bottom:20px;
    display:flex; align-items:center; justify-content:space-between;
    position:relative; overflow:hidden;
}
.db-welcome::before { content:''; position:absolute; top:-40px; right:100px; width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,0.08); }
.db-welcome::after  { content:''; position:absolute; bottom:-50px; left:40px; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,0.05); }
.db-welcome-text h2 { font-family:'Playfair Display',serif; font-size:26px; font-weight:800; color:#fff; margin-bottom:4px; text-shadow:0 2px 12px rgba(0,0,0,0.1); }
.db-welcome-text p  { font-size:13px; color:rgba(255,255,255,0.8); }
.db-welcome-right   { display:flex; align-items:center; gap:16px; position:relative; z-index:1; }
.db-welcome-date    { text-align:right; }
.db-welcome-date .day  { font-size:56px; font-weight:900; color:#fff; line-height:1; }
.db-welcome-date .info { font-size:11px; color:rgba(255,255,255,0.75); }
.db-welcome-alerts { display:flex; flex-direction:column; gap:6px; }
.db-alert-chip {
    display:inline-flex; align-items:center; gap:6px;
    padding:6px 12px; border-radius:20px;
    background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25);
    color:white; font-size:11px; font-weight:700; white-space:nowrap;
    text-decoration:none; transition:all 0.2s;
}
.db-alert-chip:hover { background:rgba(255,255,255,0.25); }
.db-alert-chip .dot { width:6px; height:6px; border-radius:50%; background:#fbbf24; animation:blink 1.5s infinite; }
@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.3;} }

/* ── SECTION LABEL ── */
.db-sec { font-size:10px; text-transform:uppercase; letter-spacing:0.1em; color:#9ca3af; font-weight:700; margin-bottom:8px; }

/* ── KPI ── */
.db-kpi-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:18px; }
.db-kpi {
    background:white; border:1px solid #ede9fe; border-radius:14px;
    padding:18px 20px; display:flex; align-items:center; gap:12px;
    text-decoration:none; transition:all 0.25s;
    opacity:0; animation:fadeUp 0.4s forwards; box-shadow:0 2px 10px rgba(180,128,255,0.05);
}
.db-kpi:nth-child(1){animation-delay:.05s} .db-kpi:nth-child(2){animation-delay:.1s}
.db-kpi:nth-child(3){animation-delay:.15s} .db-kpi:nth-child(4){animation-delay:.2s}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.db-kpi:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.db-kpi-icon { width:44px; height:44px; border-radius:11px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
.db-kpi-icon.violet { background:#f5f0ff; color:#7c3aed; }
.db-kpi-icon.peach  { background:#fff4f0; color:#c2714f; }
.db-kpi-icon.blue   { background:#eff6ff; color:#3b82f6; }
.db-kpi-icon.green  { background:#f0fdf4; color:#16a34a; }
.db-kpi-label { font-size:10px; color:#6b7280; font-weight:600; margin-bottom:3px; text-transform:uppercase; letter-spacing:0.4px; }
.db-kpi-value { font-size:28px; font-weight:900; color:#1a1a2e; line-height:1; }
.db-kpi-sub   { font-size:10px; color:#10b981; margin-top:2px; font-weight:600; }

/* ── QUICK ACTIONS ── */
.db-quick-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:18px; }
.db-quick {
    border-radius:14px; padding:18px 20px;
    display:flex; align-items:center; gap:12px;
    text-decoration:none; transition:all 0.2s; cursor:pointer;
    opacity:0; animation:fadeUp 0.4s forwards;
}
.db-quick:nth-child(1){animation-delay:.1s} .db-quick:nth-child(2){animation-delay:.15s}
.db-quick:nth-child(3){animation-delay:.2s}  .db-quick:nth-child(4){animation-delay:.25s}
.db-quick:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.15); }
.db-quick.violet { background:linear-gradient(135deg,#b480ff,#9333ea); }
.db-quick.pink   { background:linear-gradient(135deg,#ec4899,#db2777); }
.db-quick.peach  { background:linear-gradient(135deg,#d3aa95,#c08060); }
.db-quick.blue   { background:linear-gradient(135deg,#60a5fa,#3b82f6); }
.db-quick-icon  { width:38px; height:38px; border-radius:10px; background:rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; font-size:16px; color:white; flex-shrink:0; }
.db-quick-title { font-size:12px; font-weight:700; color:white; margin-bottom:1px; }
.db-quick-sub   { font-size:10px; color:rgba(255,255,255,0.75); }

/* ── BOTTOM ── */
.db-bottom { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.db-panel { background:white; border:1px solid #ede9fe; border-radius:14px; padding:20px; box-shadow:0 2px 10px rgba(180,128,255,0.04); }
.db-panel-title { font-size:13px; font-weight:800; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; }
.db-panel-title a { font-size:11px; color:#7c3aed; text-decoration:none; font-weight:600; }
.db-panel-title a:hover { text-decoration:underline; }

/* AFFLUENCE */
.aff-row   { display:flex; justify-content:space-between; font-size:12px; color:#6b7280; margin-bottom:6px; }
.aff-row strong { color:#1a1a2e; font-weight:700; }
.aff-track { height:6px; background:#f3f0ff; border-radius:6px; margin-bottom:14px; overflow:hidden; }
.aff-fill  { height:100%; border-radius:6px; transition:width 0.6s ease; }
.aff-chips { display:grid; grid-template-columns:1fr 1fr 1fr; gap:6px; }
.aff-chip  { text-align:center; padding:10px 4px; border-radius:10px; }
.aff-chip .av { font-size:11px; font-weight:700; margin-bottom:1px; }
.aff-chip .ar { font-size:9px; color:#9ca3af; }

/* ACTIVITY */
.act-item { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #fdf4ff; }
.act-item:last-child { border-bottom:none; padding-bottom:0; }
.act-icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:13px; flex-shrink:0; }
.act-icon.violet { background:#f5f0ff; color:#7c3aed; }
.act-icon.green  { background:#f0fdf4; color:#16a34a; }
.act-icon.orange { background:#fff7ed; color:#ea580c; }
.act-icon.pink   { background:#fdf2f8; color:#db2777; }
.act-title { font-size:12px; font-weight:600; color:#1a1a2e; margin-bottom:1px; }
.act-sub   { font-size:10px; color:#9ca3af; }
.act-time  { font-size:10px; color:#d1d5db; margin-left:auto; white-space:nowrap; }
.empty-msg { font-size:12px; color:#d1d5db; text-align:center; padding:20px 0; }

@media(max-width:1024px){ .db-kpi-grid,.db-quick-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:640px) { .db-bottom{ grid-template-columns:1fr; } }
</style>

<div class="db-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- WELCOME --}}
    <div class="db-welcome">
        <div class="db-welcome-text">
            <h2>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ Auth::user()->prenom }} 👋</h2>
            <p>Welcome back to Glow Institute — {{ now()->locale('en')->isoFormat('dddd, D MMMM YYYY') }}</p>
        </div>
        <div class="db-welcome-right">
            {{-- Alert chips --}}
            <div class="db-welcome-alerts">
                @if($stats['esthe_en_attente'] > 0)
                    <a href="{{ route('admin.estheticiennes.index', ['filtre'=>'en_attente']) }}" class="db-alert-chip">
                        <span class="dot"></span>
                        {{ $stats['esthe_en_attente'] }} expert(s) pending
                    </a>
                @endif
                @if($stats['commandes_a_traiter'] > 0)
                    <a href="{{ route('admin.commandes.index') }}" class="db-alert-chip">
                        <span class="dot"></span>
                        {{ $stats['commandes_a_traiter'] }} order(s) to confirm
                    </a>
                @endif
                @if(isset($stats['avis_en_attente']) && $stats['avis_en_attente'] > 0)
                    <a href="{{ route('admin.avis.index') }}" class="db-alert-chip">
                        <span class="dot"></span>
                        {{ $stats['avis_en_attente'] }} review(s) to moderate
                    </a>
                @endif
            </div>
            <div class="db-welcome-date">
                <div class="day">{{ now()->format('d') }}</div>
                <div class="info">{{ now()->locale('en')->isoFormat('dddd') }}, {{ now()->format('M Y') }}</div>
            </div>
        </div>
    </div>

    {{-- KPIs --}}
    <div class="db-sec">Key Metrics</div>
    <div class="db-kpi-grid">
        <a href="{{ route('admin.clients.index') }}" class="db-kpi">
            <div class="db-kpi-icon violet"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="db-kpi-label">Total Clients</div>
                <div class="db-kpi-value">{{ $stats['total_clients'] }}</div>
                <div class="db-kpi-sub">Registered</div>
            </div>
        </a>
        <a href="{{ route('admin.estheticiennes.index') }}" class="db-kpi">
            <div class="db-kpi-icon peach"><i class="fa-solid fa-user-nurse"></i></div>
            <div>
                <div class="db-kpi-label">Active Experts</div>
                <div class="db-kpi-value">{{ $stats['total_estheticiennes'] }}</div>
                <div class="db-kpi-sub">Professionals</div>
            </div>
        </a>
        <a href="{{ route('admin.rendez-vous.index') }}" class="db-kpi">
            <div class="db-kpi-icon blue"><i class="fa-solid fa-calendar-check"></i></div>
            <div>
                <div class="db-kpi-label">Appointments Today</div>
                <div class="db-kpi-value">{{ $stats['rdv_aujourdhui'] }}</div>
                <div class="db-kpi-sub">{{ now()->format('d M') }}</div>
            </div>
        </a>
        <a href="{{ route('admin.statistiques.index') }}" class="db-kpi">
            @php
                $inst = \App\Models\Institut::instance();
                $rdv  = $stats['rdv_aujourdhui'];
                $sel  = $inst->seuil_affluence_eleve ?? 10;
                $smo  = $inst->seuil_affluence_moyen ?? 5;
                $lvl  = $rdv >= $sel ? 'High' : ($rdv >= $smo ? 'Medium' : 'Low');
            @endphp
            <div class="db-kpi-icon green"><i class="fa-solid fa-chart-line"></i></div>
            <div>
                <div class="db-kpi-label">Activity Level</div>
                <div class="db-kpi-value" style="font-size:16px;padding-top:4px;">{{ $lvl }}</div>
                <div class="db-kpi-sub">Affluence</div>
            </div>
        </a>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="db-sec">Quick Actions</div>
    <div class="db-quick-grid">
        <a href="{{ route('admin.services.create') }}" class="db-quick violet">
            <div class="db-quick-icon"><i class="fa-solid fa-plus"></i></div>
            <div>
                <div class="db-quick-title">Add New Service</div>
                <div class="db-quick-sub">Create a service</div>
            </div>
        </a>
        <a href="{{ route('admin.estheticiennes.index', ['filtre'=>'en_attente']) }}" class="db-quick pink">
            <div class="db-quick-icon"><i class="fa-solid fa-user-check"></i></div>
            <div>
                <div class="db-quick-title">Validate Experts</div>
                <div class="db-quick-sub">{{ $stats['esthe_en_attente'] }} pending</div>
            </div>
        </a>
        <a href="{{ route('admin.commandes.index') }}" class="db-quick peach">
            <div class="db-quick-icon"><i class="fa-solid fa-cart-shopping"></i></div>
            <div>
                <div class="db-quick-title">Manage Orders</div>
                <div class="db-quick-sub">{{ $stats['commandes_a_traiter'] }} to confirm</div>
            </div>
        </a>
        <a href="{{ route('admin.produits.create') }}" class="db-quick blue">
            <div class="db-quick-icon"><i class="fa-solid fa-box"></i></div>
            <div>
                <div class="db-quick-title">Add New Product</div>
                <div class="db-quick-sub">Add to catalogue</div>
            </div>
        </a>
    </div>

    {{-- BOTTOM PANELS --}}
    <div class="db-bottom">

        {{-- AFFLUENCE --}}
        <div class="db-panel">
            <div class="db-panel-title">
                <span><i class="fa-solid fa-gauge" style="color:#b480ff;margin-right:6px;font-size:11px;"></i> Institute Affluence</span>
                <a href="{{ route('admin.rendez-vous.calendrier') }}">View Calendar →</a>
            </div>
            @php
                $pct = $sel > 0 ? min(100, round(($rdv/$sel)*100)) : 0;
                $clr = $rdv >= $sel ? '#f87171' : ($rdv >= $smo ? '#fbbf24' : '#34d399');
            @endphp
            <div class="aff-row">
                <span>Today's appointments</span>
                <strong>{{ $rdv }} / {{ $sel }}</strong>
            </div>
            <div class="aff-track">
                <div class="aff-fill" style="width:{{ $pct }}%;background:{{ $clr }};"></div>
            </div>
            <div class="aff-chips">
                <div class="aff-chip" style="background:#f0fdf4;">
                    <div class="av" style="color:#10b981;">Low</div>
                    <div class="ar">0–{{ $smo-1 }}</div>
                </div>
                <div class="aff-chip" style="background:#fffbeb;">
                    <div class="av" style="color:#f59e0b;">Medium</div>
                    <div class="ar">{{ $smo }}–{{ $sel-1 }}</div>
                </div>
                <div class="aff-chip" style="background:#fff5f5;">
                    <div class="av" style="color:#ef4444;">High</div>
                    <div class="ar">{{ $sel }}+</div>
                </div>
            </div>
        </div>

        {{-- RECENT ACTIVITY --}}
        <div class="db-panel">
            <div class="db-panel-title">
                <span><i class="fa-solid fa-bell" style="color:#b480ff;margin-right:6px;font-size:11px;"></i> Recent Activity</span>
            </div>
            @php $notifs = Auth::user()->unreadNotifications()->latest()->take(5)->get(); @endphp
            @forelse($notifs as $n)
                @php $d = json_decode($n->data, true); @endphp
                <div class="act-item">
                    <div class="act-icon violet"><i class="fa-solid fa-bell"></i></div>
                    <div style="flex:1;min-width:0;">
                        <div class="act-title">{{ Str::limit($d['message'] ?? 'New notification', 42) }}</div>
                        <div class="act-sub">Glow Institute</div>
                    </div>
                    <div class="act-time">{{ $n->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <div class="empty-msg">
                    <i class="fa-regular fa-bell-slash" style="font-size:28px;color:#e9d8fd;display:block;margin-bottom:8px;"></i>
                    No recent activity
                </div>
            @endforelse
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
