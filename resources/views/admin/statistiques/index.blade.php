<x-app-layout>
<x-slot name="header">Statistics & Reports</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
.st-wrap { margin: -24px; padding: 28px; background: #f8f5ff; }
.st-inner { max-width: 1200px; margin: 0 auto; }

/* ── TOP BAR ── */
.st-topbar {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
}
.st-title h1 { font-size: 20px; font-weight: 800; color: #1a1a2e; margin-bottom: 2px; }
.st-title p  { font-size: 12px; color: #9ca3af; }
.st-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.period-btn {
    padding: 7px 16px; border-radius: 30px; font-size: 12px; font-weight: 600;
    text-decoration: none; transition: all 0.2s; border: 1.5px solid #ede9fe;
    color: #6b7280; background: white;
}
.period-btn:hover { border-color: #b480ff; color: #b480ff; }
.period-btn.active { background: linear-gradient(to right, #b480ff, #d3aa95); color: white; border-color: transparent; }
.btn-pdf {
    padding: 8px 18px; border-radius: 30px; font-size: 12px; font-weight: 600;
    background: linear-gradient(to right, #b480ff, #d3aa95); color: white;
    text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;
    border: none; cursor: pointer; font-family: inherit;
}
.btn-pdf:hover { opacity: 0.88; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(180,128,255,0.3); }

/* ── KPI CARDS ── */
.kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
.kpi-card {
    background: white; border-radius: 16px; padding: 20px;
    border: 1px solid #ede9fe; position: relative; overflow: hidden;
    transition: all 0.2s;
}
.kpi-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(180,128,255,0.1); }
.kpi-card::after {
    content: ''; position: absolute; bottom: -20px; right: -20px;
    width: 80px; height: 80px; border-radius: 50%;
    background: rgba(180,128,255,0.04);
}
.kpi-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; margin-bottom: 14px;
}
.kpi-icon.violet { background: #f5f0ff; color: #7c3aed; }
.kpi-icon.green  { background: #f0fdf4; color: #16a34a; }
.kpi-icon.orange { background: #fff7ed; color: #ea580c; }
.kpi-icon.blue   { background: #eff6ff; color: #2563eb; }
.kpi-icon.red    { background: #fff5f5; color: #ef4444; }
.kpi-icon.yellow { background: #fefce8; color: #ca8a04; }
.kpi-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #9ca3af; margin-bottom: 6px; }
.kpi-value { font-size: 30px; font-weight: 800; color: #1a1a2e; line-height: 1; margin-bottom: 4px; }
.kpi-sub   { font-size: 11px; color: #9ca3af; }

/* ── CHARTS ── */
.charts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
.chart-card {
    background: white; border-radius: 16px; padding: 20px;
    border: 1px solid #ede9fe;
}
.chart-title {
    font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
}
.chart-title-icon {
    width: 28px; height: 28px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center; font-size: 12px;
}
.chart-title-icon.violet { background: #f5f0ff; color: #7c3aed; }
.chart-title-icon.green  { background: #f0fdf4; color: #16a34a; }

/* ── TOPS ── */
.tops-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 20px; }
.top-card { background: white; border-radius: 16px; padding: 20px; border: 1px solid #ede9fe; }
.top-title { font-size: 13px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.top-title i { font-size: 14px; color: #b480ff; }
.top-item { margin-bottom: 14px; }
.top-item-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
.top-rank {
    width: 22px; height: 22px; border-radius: 50%; color: white;
    font-size: 10px; font-weight: 700; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.top-rank.gold   { background: #f59e0b; }
.top-rank.silver { background: #94a3b8; }
.top-rank.bronze { background: #b45309; }
.top-rank.other  { background: #c4b5fd; }
.top-name { font-size: 12px; color: #374151; font-weight: 500; flex: 1; margin: 0 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.top-count { font-size: 12px; font-weight: 700; color: #b480ff; }
.top-bar-track { height: 4px; background: #f3f4f6; border-radius: 4px; overflow: hidden; }
.top-bar-fill { height: 100%; border-radius: 4px; }

/* ── BOTTOM ROW ── */
.bottom-grid { grid-template-columns: 1fr; }
.bottom-card { background: white; border-radius: 16px; padding: 20px; border: 1px solid #ede9fe; }
.bottom-title { font-size: 13px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.bottom-title i { color: #b480ff; }

/* Clients list */
.client-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 0; border-bottom: 1px solid #f7f5ff;
}
.client-item:last-child { border-bottom: none; padding-bottom: 0; }
.client-av {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, #b480ff, #d3aa95);
    color: white; font-size: 11px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.client-name { font-size: 13px; font-weight: 600; color: #1a1a2e; }
.client-email { font-size: 11px; color: #9ca3af; }
.client-time { font-size: 11px; color: #d1d5db; }

/* Promo notif */
.promo-textarea {
    width: 100%; padding: 12px 14px; border-radius: 10px;
    border: 1.5px solid #ede9fe; background: #fdf9ff;
    font-size: 13px; color: #1a1a2e; font-family: 'Plus Jakarta Sans', sans-serif;
    outline: none; resize: none; transition: all 0.2s; margin-bottom: 12px;
}
.promo-textarea:focus { border-color: #b480ff; background: white; }
.btn-send {
    padding: 10px 22px; border-radius: 30px;
    background: linear-gradient(to right, #b480ff, #d3aa95);
    color: white; font-size: 13px; font-weight: 600;
    border: none; cursor: pointer; font-family: inherit; transition: all 0.2s;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-send:hover { opacity: 0.88; }

@media (max-width: 1024px) {
    .kpi-grid { grid-template-columns: repeat(2, 1fr); }
    .charts-grid, .tops-grid, .bottom-grid { grid-template-columns: 1fr; }
}
</style>

<div class="st-wrap">
<div class="st-inner">

    {{-- TOP BAR --}}
    <div class="st-topbar">
        <div class="st-title">
            <h1>Statistics & Reports</h1>
            <p>Period: <strong>{{ $labelPeriode }}</strong></p>
        </div>
        <div class="st-actions">
            @foreach(['semaine' => 'Last 7 days', 'mois' => 'This month', 'annee' => 'This year'] as $val => $label)
                <a href="{{ route('admin.statistiques.index', ['periode' => $val]) }}"
                   class="period-btn {{ $periode === $val ? 'active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
            <a href="{{ route('admin.statistiques.export-pdf') }}" class="btn-pdf">
                <i class="fa-solid fa-file-pdf"></i> View Report
            </a>
        </div>
    </div>

    {{-- KPI GRID --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon violet"><i class="fa-solid fa-calendar-check"></i></div>
            <div class="kpi-label">Appointments Done</div>
            <div class="kpi-value">{{ $stats['rdv_termines'] }}</div>
            <div class="kpi-sub">{{ $stats['rdv_total'] }} total</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon green"><i class="fa-solid fa-sack-dollar"></i></div>
            <div class="kpi-label">Total Revenue</div>
            <div class="kpi-value" style="font-size:22px;">{{ number_format($stats['revenus_total'], 0, ',', ' ') }}</div>
            <div class="kpi-sub">DA</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon orange"><i class="fa-solid fa-cart-shopping"></i></div>
            <div class="kpi-label">Confirmed Orders</div>
            <div class="kpi-value">{{ $stats['commandes_confirmees'] }}</div>
            <div class="kpi-sub">This period</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon blue"><i class="fa-solid fa-users"></i></div>
            <div class="kpi-label">Total Clients</div>
            <div class="kpi-value">{{ $stats['total_clients'] }}</div>
            <div class="kpi-sub">{{ $stats['total_esthes'] }} experts</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon violet"><i class="fa-solid fa-spa"></i></div>
            <div class="kpi-label">Services Revenue</div>
            <div class="kpi-value" style="font-size:20px;">{{ number_format($stats['revenus_rdv'], 0, ',', ' ') }}</div>
            <div class="kpi-sub">DA</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon orange"><i class="fa-solid fa-box"></i></div>
            <div class="kpi-label">Products Revenue</div>
            <div class="kpi-value" style="font-size:20px;">{{ number_format($stats['revenus_produits'], 0, ',', ' ') }}</div>
            <div class="kpi-sub">DA</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon yellow"><i class="fa-solid fa-star"></i></div>
            <div class="kpi-label">Institute Rating</div>
            <div class="kpi-value">{{ number_format($stats['note_moyenne_inst'], 1) }}</div>
            <div class="kpi-sub">out of 5</div>
        </div>
        <div class="kpi-card {{ $stats['produits_stock_critique'] > 0 ? 'border-l-4' : '' }}" style="{{ $stats['produits_stock_critique'] > 0 ? 'border-left: 3px solid #ef4444;' : '' }}">
            <div class="kpi-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="kpi-label">Critical Stock</div>
            <div class="kpi-value" style="{{ $stats['produits_stock_critique'] > 0 ? 'color:#ef4444;' : '' }}">{{ $stats['produits_stock_critique'] }}</div>
            <div class="kpi-sub">Products</div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-title">
                <div class="chart-title-icon violet"><i class="fa-solid fa-calendar-check"></i></div>
                Appointments & Orders
            </div>
            <canvas id="chartRdv" height="180"></canvas>
        </div>
        <div class="chart-card">
            <div class="chart-title">
                <div class="chart-title-icon green"><i class="fa-solid fa-chart-line"></i></div>
                Revenue (DA)
            </div>
            <canvas id="chartRevenus" height="180"></canvas>
        </div>
    </div>

    {{-- TOPS --}}
    <div class="tops-grid">

        {{-- Top Services --}}
        <div class="top-card">
            <div class="top-title"><i class="fa-solid fa-spa"></i> Top Services</div>
            @php $maxS = $topServices->max('nb') ?: 1; @endphp
            @forelse($topServices as $i => $s)
                <div class="top-item">
                    <div class="top-item-header">
                        <div class="top-rank {{ $i===0?'gold':($i===1?'silver':($i===2?'bronze':'other')) }}">{{ $i+1 }}</div>
                        <span class="top-name">{{ $s->nom }}</span>
                        <span class="top-count">{{ $s->nb }}</span>
                    </div>
                    <div class="top-bar-track">
                        <div class="top-bar-fill" style="width:{{ ($s->nb/$maxS)*100 }}%;background:linear-gradient(to right,#b480ff,#d3aa95);"></div>
                    </div>
                </div>
            @empty
                <p style="font-size:12px;color:#d1d5db;text-align:center;padding:16px 0;">No data for this period</p>
            @endforelse
        </div>

        {{-- Top Esthéticiennes --}}
        <div class="top-card">
            <div class="top-title"><i class="fa-solid fa-user-nurse"></i> Top Experts</div>
            @php $maxE = $topEsthes->max('nb_rdv') ?: 1; @endphp
            @forelse($topEsthes as $i => $e)
                <div class="top-item">
                    <div class="top-item-header">
                        <div class="top-rank {{ $i===0?'gold':($i===1?'silver':($i===2?'bronze':'other')) }}">{{ $i+1 }}</div>
                        <span class="top-name">{{ $e->fullName() }}</span>
                        <span class="top-count">{{ $e->nb_rdv }}</span>
                    </div>
                    <div class="top-bar-track">
                        <div class="top-bar-fill" style="width:{{ ($e->nb_rdv/$maxE)*100 }}%;background:linear-gradient(to right,#c084fc,#a855f7);"></div>
                    </div>
                </div>
            @empty
                <p style="font-size:12px;color:#d1d5db;text-align:center;padding:16px 0;">No data for this period</p>
            @endforelse
        </div>

        {{-- Top Produits --}}
        <div class="top-card">
            <div class="top-title"><i class="fa-solid fa-box"></i> Top Products</div>
            @php $maxP = $topProduits->max('total_vendu') ?: 1; @endphp
            @forelse($topProduits as $i => $p)
                <div class="top-item">
                    <div class="top-item-header">
                        <div class="top-rank {{ $i===0?'gold':($i===1?'silver':($i===2?'bronze':'other')) }}">{{ $i+1 }}</div>
                        <span class="top-name">{{ $p->nom }}</span>
                        <span class="top-count">{{ $p->total_vendu }}</span>
                    </div>
                    <div class="top-bar-track">
                        <div class="top-bar-fill" style="width:{{ ($p->total_vendu/$maxP)*100 }}%;background:linear-gradient(to right,#fb923c,#f97316);"></div>
                    </div>
                </div>
            @empty
                <p style="font-size:12px;color:#d1d5db;text-align:center;padding:16px 0;">No data for this period</p>
            @endforelse
        </div>

    </div>

    {{-- BOTTOM --}}
    <div class="bottom-grid">

        {{-- Recent Clients --}}
        <div class="bottom-card">
            <div class="bottom-title"><i class="fa-solid fa-users"></i> Recent Clients</div>
            @foreach($clientsRecents as $client)
                <div class="client-item">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="client-av">{{ strtoupper(substr($client->prenom,0,1)) }}</div>
                        <div>
                            <div class="client-name">{{ $client->fullName() }}</div>
                            <div class="client-email">{{ $client->email }}</div>
                        </div>
                    </div>
                    <div class="client-time">{{ $client->created_at->diffForHumans() }}</div>
                </div>
            @endforeach
        </div>


    </div>

</div>
</div>

<script>
const labels  = @json($chartData['labels']);
const rdvData = @json($chartData['rdvData']);
const revData = @json($chartData['revenusData']);
const cmdData = @json($chartData['commandesData']);

new Chart(document.getElementById('chartRdv'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Appointments',
            data: rdvData,
            backgroundColor: 'rgba(180,128,255,0.8)',
            borderRadius: 6,
        }, {
            label: 'Orders',
            data: cmdData,
            backgroundColor: 'rgba(211,170,149,0.8)',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top', labels: { font: { family: 'Plus Jakarta Sans', size: 11 } } } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1, font: { family: 'Plus Jakarta Sans' } } } }
    }
});

new Chart(document.getElementById('chartRevenus'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Revenue (DA)',
            data: revData,
            borderColor: '#b480ff',
            backgroundColor: 'rgba(180,128,255,0.08)',
            fill: true, tension: 0.4,
            pointBackgroundColor: '#b480ff', pointRadius: 4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top', labels: { font: { family: 'Plus Jakarta Sans', size: 11 } } } },
        scales: { y: { beginAtZero: true, ticks: { font: { family: 'Plus Jakarta Sans' } } } }
    }
});
</script>

</x-app-layout>
