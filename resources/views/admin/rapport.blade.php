<x-app-layout>
<x-slot name="header">Activity Report</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.rp-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

/* ── TOP ACTION BAR ── */
.rp-actions {
    display:flex; align-items:center; justify-content:space-between;
    background:white; border-radius:14px; border:1px solid #ede9fe;
    padding:14px 20px; margin-bottom:20px;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
}
.rp-title { font-size:15px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.rp-title i { color:#b480ff; }

/* ── BUTTONS ── */
.btn-rp {
    display:inline-flex; align-items:center; gap:6px;
    padding:9px 18px; border-radius:30px; font-size:12px; font-weight:700;
    cursor:pointer; border:none; font-family:inherit; text-decoration:none;
    transition:all 0.2s;
}
.btn-rp.back  { background:#f5f0ff; color:#7c3aed; border:1px solid #ede9fe; }
.btn-rp.back:hover { background:#ede9fe; }
.btn-rp.pdf   { background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; box-shadow:0 4px 14px rgba(180,128,255,0.3); }
.btn-rp.pdf:hover  { transform:translateY(-1px); box-shadow:0 6px 20px rgba(180,128,255,0.4); }
.btn-rp.print { background:white; color:#374151; border:1px solid #ede9fe; }
.btn-rp.print:hover { border-color:#b480ff; color:#b480ff; }
.btn-rp:disabled { opacity:0.6; cursor:not-allowed; transform:none !important; }

/* ── REPORT PAGE ── */
.rp-page {
    background:white; border-radius:16px; overflow:hidden;
    border:1px solid #ede9fe; box-shadow:0 4px 24px rgba(180,128,255,0.08);
}

/* HEADER */
.rp-header {
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 45%,#d3aa95 100%);
    padding:40px; display:flex; justify-content:space-between; align-items:flex-start;
    position:relative; overflow:hidden;
}
.rp-header::before { content:''; position:absolute; top:-60px; right:-40px; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,0.08); }
.rp-header::after  { content:''; position:absolute; bottom:-60px; left:-20px;  width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,0.05); }
.rp-header-left  { position:relative; z-index:2; }
.rp-inst-name    { font-family:'Playfair Display',serif; font-size:30px; font-weight:800; color:white; }
.rp-inst-sub     { font-size:12px; color:rgba(255,255,255,0.75); margin-top:6px; }
.rp-report-label { margin-top:16px; font-size:16px; font-weight:300; color:rgba(255,255,255,0.9); }
.rp-header-badge {
    position:relative; z-index:2;
    background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.3);
    border-radius:14px; padding:16px 24px; text-align:right;
}
.b-title { font-size:10px; font-weight:700; letter-spacing:2px; color:rgba(255,255,255,0.75); text-transform:uppercase; }
.b-date  { font-size:22px; font-weight:900; color:white; margin-top:4px; }
.b-info  { font-size:11px; color:rgba(255,255,255,0.65); margin-top:2px; }

/* KPI BAND */
.rp-kpi-band { display:grid; grid-template-columns:repeat(8,1fr); background:#fdf9ff; border-bottom:2px solid #ede9fe; }
.rp-kpi-item { padding:16px 8px; text-align:center; border-right:1px solid #ede9fe; }
.rp-kpi-item:last-child { border-right:none; }
.kv    { font-size:22px; font-weight:900; color:#b480ff; line-height:1; }
.kv.g  { color:#059669; } .kv.o { color:#d97706; } .kv.r { color:#dc2626; } .kv.p { color:#9333ea; } .kv.sm { font-size:15px; }
.kl    { font-size:9px; color:#64748b; text-transform:uppercase; letter-spacing:0.5px; margin-top:4px; font-weight:600; }
.ks    { font-size:9px; color:#94a3b8; margin-top:2px; }

/* SECTIONS */
.rp-section { padding:28px 40px; border-bottom:1px solid #f0ebff; }
.rp-section:last-child { border-bottom:none; }
.rp-sec-title {
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px;
    color:#b480ff; margin-bottom:20px; padding-bottom:10px; border-bottom:2px solid #ede9fe;
    display:flex; align-items:center; gap:8px;
}
.rp-sec-title::before { content:''; width:4px; height:16px; background:#b480ff; border-radius:2px; flex-shrink:0; }
.rp-sec-title.orange { color:#d97706; } .rp-sec-title.orange::before { background:#d97706; }
.rp-sec-title.green  { color:#059669; } .rp-sec-title.green::before  { background:#059669; }

/* CHARTS */
.rp-charts-row { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; }
.rp-chart-box  { background:#fdf9ff; border-radius:12px; padding:20px; border:1px solid #ede9fe; }
.rp-chart-box h4 { font-size:12px; font-weight:700; color:#374151; margin-bottom:14px; }

/* TABLE */
.rp-table-wrap { overflow:hidden; border-radius:12px; border:1px solid #ede9fe; }
table { width:100%; border-collapse:collapse; }
table thead tr { background:linear-gradient(135deg,#b480ff,#d3aa95); }
table.dark   thead tr { background:#1a1a2e; }
table.green-h thead tr { background:#059669; }
table thead th { padding:10px 14px; color:white; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; text-align:left; }
table tbody tr { border-bottom:1px solid #fdf9ff; transition:background 0.1s; }
table tbody tr:last-child { border-bottom:none; }
table tbody tr:hover { background:#fdf9ff; }
table tbody td { padding:10px 14px; font-size:12px; color:#374151; }
table tfoot td { padding:10px 14px; font-size:12px; font-weight:700; background:#1a1a2e; color:white; }
td.num  { font-weight:700; color:#b480ff; text-align:center; }
td.numg { font-weight:700; color:#059669; text-align:right; }
td.numo { font-weight:700; color:#d97706; text-align:center; }
td.c { text-align:center; } td.r { text-align:right; }

/* TOP ITEMS */
.rp-grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px; }
.rp-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.top-item { display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid #fdf4ff; }
.top-item:last-child { border-bottom:none; }
.top-info { flex:1; } .top-name { font-size:12px; font-weight:600; color:#1e293b; }
.top-bar  { margin-top:4px; } .top-val  { font-size:12px; font-weight:700; min-width:30px; text-align:right; }
.rk   { display:inline-flex; width:22px; height:22px; border-radius:50%; align-items:center; justify-content:center; color:white; font-size:10px; font-weight:700; background:#94a3b8; flex-shrink:0; }
.rk.g { background:linear-gradient(135deg,#f59e0b,#d97706); }
.rk.s { background:linear-gradient(135deg,#9ca3af,#6b7280); }
.rk.b { background:linear-gradient(135deg,#92400e,#78350f); }
.progress-bar  { background:#ede9fe; border-radius:4px; height:8px; overflow:hidden; }
.progress-fill { height:100%; border-radius:4px; background:#b480ff; }
.progress-fill.g { background:#059669; } .progress-fill.o { background:#d97706; } .progress-fill.p { background:#9333ea; }

/* FINANCE */
.finance-card  { background:linear-gradient(135deg,#f0fdf4,#dcfce7); border:1px solid #a7f3d0; border-radius:12px; padding:20px; }
.finance-row   { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #bbf7d0; font-size:13px; }
.finance-row:last-child { border-bottom:none; }
.finance-total { display:flex; justify-content:space-between; padding:12px 0 0; margin-top:8px; border-top:2px solid #059669; font-weight:800; font-size:16px; color:#059669; }

/* BOTTOM ACTIONS */
.rp-bottom-actions {
    display:flex; align-items:center; justify-content:center; gap:12px;
    padding:28px; background:#f8f5ff; border-top:1px solid #ede9fe;
}

/* FOOTER */
.rp-footer { background:#1a1a2e; padding:20px 40px; display:flex; justify-content:space-between; align-items:center; }
.rp-footer p { font-size:11px; color:rgba(255,255,255,0.4); }

/* ── PRINT ── */
@media print {
    body * { visibility: hidden; }
    #rp-page, #rp-page * { visibility: visible; }
    #rp-page {
        position: fixed !important; top:0 !important; left:0 !important;
        width:100% !important; border:none !important;
        box-shadow:none !important; border-radius:0 !important;
        margin:0 !important; padding:0 !important;
    }
    * { -webkit-print-color-adjust:exact !important; print-color-adjust:exact !important; }
    .rp-bottom-actions { visibility:hidden !important; height:0 !important; overflow:hidden !important; }
    body { margin:0 !important; padding:0 !important; }
}
</style>

<div class="rp-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- TOP BAR : Back only --}}
    <div class="rp-actions">
        <div class="rp-title">
            <i class="fa-solid fa-chart-bar"></i>
            Activity Report — {{ now()->year }}
        </div>
        <a href="{{ route('admin.statistiques.index') }}" class="btn-rp back">
            <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Back to Statistics
        </a>
    </div>

    {{-- REPORT CONTENT --}}
    <div class="rp-page" id="rp-page">

        {{-- HEADER --}}
        <div class="rp-header">
            <div class="rp-header-left">
                <div class="rp-inst-name">{{ $institut->nom ?? 'Institut Beauté' }}</div>
                <div class="rp-inst-sub">
                    {{ $institut->adresse ?? '' }}
                    @if($institut->telephone) &nbsp;|&nbsp; {{ $institut->telephone }} @endif
                    @if($institut->email) &nbsp;|&nbsp; {{ $institut->email }} @endif
                </div>
                <div class="rp-report-label">Annual Activity Report</div>
            </div>
            <div class="rp-header-badge">
                <div class="b-title">Annual Report</div>
                <div class="b-date">{{ now()->year }}</div>
                <div class="b-info">Generated on {{ $dateRapport }}</div>
                <div class="b-info">Period: last 12 months</div>
            </div>
        </div>

        {{-- KPI BAND --}}
        <div class="rp-kpi-band">
            <div class="rp-kpi-item"><div class="kv">{{ $stats['total_clients'] }}</div><div class="kl">Clients</div></div>
            <div class="rp-kpi-item"><div class="kv p">{{ $stats['total_esthes'] }}</div><div class="kl">Experts</div><div class="ks">Active</div></div>
            <div class="rp-kpi-item"><div class="kv g">{{ $stats['rdv_termines'] }}</div><div class="kl">Done RDV</div><div class="ks">{{ $stats['rdv_ce_mois'] }} this month</div></div>
            <div class="rp-kpi-item"><div class="kv o">{{ $stats['commandes_confirmees'] }}</div><div class="kl">Orders</div><div class="ks">Confirmed</div></div>
            <div class="rp-kpi-item"><div class="kv g sm">{{ number_format($stats['revenus_rdv'], 0, ',', ' ') }}</div><div class="kl">RDV Rev. (DA)</div></div>
            <div class="rp-kpi-item"><div class="kv o sm">{{ number_format($stats['revenus_produits'], 0, ',', ' ') }}</div><div class="kl">Products (DA)</div></div>
            <div class="rp-kpi-item"><div class="kv g sm" style="font-size:13px;">{{ number_format($stats['revenus_total'], 0, ',', ' ') }}</div><div class="kl">Total (DA)</div></div>
            <div class="rp-kpi-item"><div class="kv r">{{ $stats['produits_stock_critique'] }}</div><div class="kl">Low stock</div><div class="ks">Products</div></div>
        </div>

        {{-- CHARTS --}}
        <div class="rp-section">
            <div class="rp-sec-title">Monthly Activity — Last 12 months</div>
            <div class="rp-charts-row">
                <div class="rp-chart-box"><h4>📅 Completed RDV & Orders</h4><canvas id="chartRdv" height="200"></canvas></div>
                <div class="rp-chart-box"><h4>💰 Monthly Revenue (DA)</h4><canvas id="chartRev" height="200"></canvas></div>
            </div>
            <div class="rp-table-wrap">
                <table class="dark">
                    <thead><tr><th>Month</th><th style="text-align:center">RDV done</th><th style="text-align:center">Orders</th><th style="text-align:right">Revenue (DA)</th></tr></thead>
                    <tbody>
                        @foreach($activiteMois as $m)
                        <tr>
                            <td style="font-weight:500">{{ $m['mois'] }}</td>
                            <td class="num">{{ $m['rdv'] }}</td>
                            <td class="numo">{{ $m['commandes'] }}</td>
                            <td class="{{ $m['revenus'] > 0 ? 'numg' : 'r' }}">{{ number_format($m['revenus'], 0, ',', ' ') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot><tr>
                        <td>TOTAL</td>
                        <td style="text-align:center">{{ collect($activiteMois)->sum('rdv') }}</td>
                        <td style="text-align:center">{{ collect($activiteMois)->sum('commandes') }}</td>
                        <td style="text-align:right">{{ number_format(collect($activiteMois)->sum('revenus'), 0, ',', ' ') }} DA</td>
                    </tr></tfoot>
                </table>
            </div>
        </div>

        {{-- RANKINGS --}}
        <div class="rp-section">
            <div class="rp-sec-title orange">Rankings & Performance</div>
            <div class="rp-grid-3">
                <div>
                    <div style="font-size:11px;font-weight:700;color:#b480ff;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px;">💄 Top Services</div>
                    @php $maxS = max(1, $topServices->max('nb')); @endphp
                    @forelse($topServices as $i => $s)
                        <div class="top-item">
                            <span class="rk {{ $i===0?'g':($i===1?'s':($i===2?'b':'')) }}">{{ $i+1 }}</span>
                            <div class="top-info"><div class="top-name">{{ $s->nom }}</div><div class="top-bar"><div class="progress-bar"><div class="progress-fill" style="width:{{ max(4,($s->nb/$maxS)*100) }}%"></div></div></div></div>
                            <div class="top-val" style="color:#b480ff;">{{ $s->nb }}</div>
                        </div>
                    @empty <p style="color:#94a3b8;font-style:italic;font-size:12px;">No data</p> @endforelse
                </div>
                <div>
                    <div style="font-size:11px;font-weight:700;color:#9333ea;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px;">👩‍🎨 Top Experts</div>
                    @php $maxE = max(1, $topEsthes->max('nb_rdv')); @endphp
                    @forelse($topEsthes as $i => $e)
                        <div class="top-item">
                            <span class="rk {{ $i===0?'g':($i===1?'s':($i===2?'b':'')) }}">{{ $i+1 }}</span>
                            <div class="top-info"><div class="top-name">{{ $e->fullName() }}</div><div class="top-bar"><div class="progress-bar"><div class="progress-fill p" style="width:{{ max(4,($e->nb_rdv/$maxE)*100) }}%"></div></div></div></div>
                            <div class="top-val" style="color:#9333ea;">{{ $e->nb_rdv }}</div>
                        </div>
                    @empty <p style="color:#94a3b8;font-style:italic;font-size:12px;">No data</p> @endforelse
                </div>
                <div>
                    <div style="font-size:11px;font-weight:700;color:#d97706;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px;">🧴 Top Products</div>
                    @php $maxP = max(1, $topProduits->max('total_vendu')); @endphp
                    @forelse($topProduits as $i => $p)
                        <div class="top-item">
                            <span class="rk {{ $i===0?'g':($i===1?'s':($i===2?'b':'')) }}">{{ $i+1 }}</span>
                            <div class="top-info"><div class="top-name">{{ $p->nom }}</div><div class="top-bar"><div class="progress-bar"><div class="progress-fill o" style="width:{{ max(4,($p->total_vendu/$maxP)*100) }}%"></div></div></div></div>
                            <div class="top-val" style="color:#d97706;">{{ $p->total_vendu }}</div>
                        </div>
                    @empty <p style="color:#94a3b8;font-style:italic;font-size:12px;">No data</p> @endforelse
                </div>
            </div>
        </div>

        {{-- FINANCIAL SUMMARY --}}
        <div class="rp-section">
            <div class="rp-sec-title green">Financial Summary</div>
            <div class="rp-grid-2">
                <div class="finance-card">
                    <div class="finance-row"><span>💄 Appointment Revenue</span><strong style="color:#059669;">{{ number_format($stats['revenus_rdv'], 0, ',', ' ') }} DA</strong></div>
                    <div class="finance-row"><span>🧴 Product Revenue</span><strong style="color:#d97706;">{{ number_format($stats['revenus_produits'], 0, ',', ' ') }} DA</strong></div>
                    <div class="finance-total"><span>Total Revenue</span><span>{{ number_format($stats['revenus_total'], 0, ',', ' ') }} DA</span></div>
                </div>
                <div style="background:#fdf9ff;border-radius:12px;border:1px solid #ede9fe;padding:20px;">
                    <div style="font-size:12px;color:#64748b;margin-bottom:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Revenue Breakdown</div>
                    @php $pctRdv = $stats['revenus_total'] > 0 ? round(($stats['revenus_rdv']/$stats['revenus_total'])*100) : 0; $pctProd = 100-$pctRdv; @endphp
                    <div style="margin-bottom:16px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:12px;font-weight:600;"><span style="color:#059669;">💄 Appointments</span><span style="color:#059669;">{{ $pctRdv }}%</span></div>
                        <div class="progress-bar" style="height:14px;"><div class="progress-fill g" style="width:{{ max(2,$pctRdv) }}%"></div></div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:12px;font-weight:600;"><span style="color:#d97706;">🧴 Products</span><span style="color:#d97706;">{{ $pctProd }}%</span></div>
                        <div class="progress-bar" style="height:14px;"><div class="progress-fill o" style="width:{{ max(2,$pctProd) }}%"></div></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- REPORT FOOTER --}}
        <div class="rp-footer">
            <p>{{ $institut->nom ?? 'Institut Beauté' }} &nbsp;•&nbsp; {{ $institut->adresse ?? '' }} &nbsp;•&nbsp; {{ $institut->email ?? '' }}</p>
            <p>Report generated on {{ $dateRapport }}</p>
        </div>

        {{-- ✅ BOTTOM ACTIONS — Print + Download PDF --}}
        <div class="rp-bottom-actions" id="rp-bottom-actions">
            <button class="btn-rp print" onclick="doPrint()">
                <i class="fa-solid fa-print"></i> Print
            </button>
            <button class="btn-rp pdf" onclick="doPDF()" id="btnPdf">
                <i class="fa-solid fa-file-arrow-down"></i>
                <span id="pdfLabel">Download PDF</span>
            </button>
        </div>

    </div>{{-- end rp-page --}}
</div>{{-- end rp-wrap --}}

<script>
// ── TOAST ──────────────────────────────────────────────────────────────────
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

// ── PRINT ─────────────────────────────────────────────────────────────────
function doPrint() {
    window.print();
}

// ── DOWNLOAD PDF ──────────────────────────────────────────────────────────
function doPDF() {
    var btn      = document.getElementById('btnPdf');
    var label    = document.getElementById('pdfLabel');
    var bottomEl = document.getElementById('rp-bottom-actions');
    var topEl    = document.querySelector('.rp-actions');

    // ✅ Cache les boutons AVANT capture → n'apparaissent pas dans le PDF
    bottomEl.style.display = 'none';
    if (topEl) topEl.style.display = 'none';

    html2pdf()
        .set({
            margin:      [6, 6, 6, 6],
            filename:    'Activity-Report-{{ now()->year }}.pdf',
            image:       { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, logging: false, backgroundColor: '#ffffff' },
            jsPDF:       { unit: 'mm', format: 'a4', orientation: 'landscape' },
            pagebreak:   { mode: ['avoid-all', 'css', 'legacy'] }
        })
        .from(document.getElementById('rp-page'))
        .save()
        .then(function() {
            // ✅ Réaffiche les boutons après génération
            bottomEl.style.display = '';
            if (topEl) topEl.style.display = '';
            showToast('PDF downloaded successfully!', 'success');
        })
        .catch(function() {
            bottomEl.style.display = '';
            if (topEl) topEl.style.display = '';
            showToast('PDF generation failed. Try again.', 'error');
        });
}

// ── CHARTS ────────────────────────────────────────────────────────────────
const mois = @json(collect($activiteMois)->pluck('mois'));
const rdvD = @json(collect($activiteMois)->pluck('rdv'));
const revD = @json(collect($activiteMois)->pluck('revenus'));
const cmdD = @json(collect($activiteMois)->pluck('commandes'));

new Chart(document.getElementById('chartRdv'), {
    type: 'bar',
    data: { labels: mois, datasets: [
        { label: 'RDV done', data: rdvD, backgroundColor: 'rgba(180,128,255,0.8)', borderRadius: 5 },
        { label: 'Orders',   data: cmdD, backgroundColor: 'rgba(217,119,6,0.8)',   borderRadius: 5 },
    ]},
    options: { responsive:true, plugins:{legend:{position:'top'}}, scales:{y:{beginAtZero:true,ticks:{stepSize:1}}} }
});

new Chart(document.getElementById('chartRev'), {
    type: 'line',
    data: { labels: mois, datasets:[{
        label: 'Revenue (DA)', data: revD,
        borderColor:'#059669', backgroundColor:'rgba(5,150,105,0.1)',
        fill:true, tension:0.4, pointBackgroundColor:'#059669', pointRadius:5,
    }]},
    options: { responsive:true, plugins:{legend:{position:'top'}}, scales:{y:{beginAtZero:true}} }
});
</script>

</x-app-layout>
