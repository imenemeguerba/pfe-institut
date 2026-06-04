<x-app-layout>
<x-slot name="header">My Invoices</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.fct-hero {
    position:relative; overflow:hidden; padding:50px 10% 90px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.fct-hero-glow { position:absolute; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-100px; right:-80px; animation:glow 5s ease-in-out infinite alternate; }
@keyframes glow { from{ transform:scale(1); } to{ transform:scale(1.2); } }
.fct-hero-content { position:relative; z-index:2; text-align:center; }
.fct-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:18px; }
.fct-hero-title { font-family:'Playfair Display',serif; font-size:42px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:10px; }
.fct-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.fct-hero-sub { font-size:14px; color:rgba(255,255,255,0.92); }
.fct-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.fct-body { max-width:860px; margin:0 auto; padding:40px 24px 80px; }

/* TABS */
.fct-tabs { display:flex; background:white; border-radius:20px; padding:6px; box-shadow:0 4px 20px rgba(180,128,255,0.08); border:1px solid #ede9fe; margin-bottom:28px; }
.fct-tab { flex:1; padding:10px 14px; border-radius:14px; text-align:center; font-size:13px; font-weight:600; text-decoration:none; color:#9ca3af; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:6px; cursor:pointer; }
.fct-tab:hover { color:#b480ff; }
.fct-tab.active { background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; box-shadow:0 4px 14px rgba(180,128,255,0.3); }

/* EMPTY */
.fct-empty { background:white; border-radius:24px; border:1px solid #ede9fe; padding:64px 24px; text-align:center; }
.fct-empty i { font-size:48px; color:#e9d8fd; margin-bottom:16px; display:block; }
.fct-empty p { font-size:14px; color:#c4b5fd; }

/* LOADING */
.fct-loading { text-align:center; padding:40px; color:#b480ff; font-size:13px; font-weight:600; }
.fct-loading i { font-size:24px; margin-bottom:8px; display:block; animation:spin 1s linear infinite; }
@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

/* INVOICE LIST */
.fct-list { display:flex; flex-direction:column; gap:12px; }
.fct-item {
    background:white; border-radius:20px; border:1px solid #ede9fe;
    box-shadow:0 4px 16px rgba(180,128,255,0.05);
    transition:all 0.3s; overflow:hidden;
    opacity:0; animation:slideIn 0.4s forwards;
    display:flex; align-items:stretch;
}
.fct-item:nth-child(1){ animation-delay:0s; }
.fct-item:nth-child(2){ animation-delay:0.06s; }
.fct-item:nth-child(3){ animation-delay:0.12s; }
.fct-item:nth-child(4){ animation-delay:0.18s; }
.fct-item:nth-child(5){ animation-delay:0.24s; }
@keyframes slideIn { from{ opacity:0; transform:translateX(-16px); } to{ opacity:1; transform:translateX(0); } }
.fct-item:hover { transform:translateY(-3px); box-shadow:0 12px 36px rgba(180,128,255,0.12); border-color:#c4b5fd; }

.fct-item-stripe { width:5px; flex-shrink:0; }
.fct-item-stripe.rdv   { background:linear-gradient(to bottom,#b480ff,#d3aa95); }
.fct-item-stripe.order { background:linear-gradient(to bottom,#f97316,#fbbf24); }

.fct-item-body { flex:1; padding:18px 20px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.fct-item-num { font-size:16px; font-weight:800; color:#b480ff; font-family:monospace; margin-bottom:4px; }
.fct-item-date { font-size:12px; color:#9ca3af; margin-bottom:6px; }
.fct-item-type { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:700; }
.fct-item-type.rdv   { background:rgba(180,128,255,0.1); color:#b480ff; }
.fct-item-type.order { background:rgba(249,115,22,0.1); color:#f97316; }
.fct-item-right { display:flex; align-items:center; gap:14px; }
.fct-item-amount { font-size:22px; font-weight:900; color:#b480ff; white-space:nowrap; }
.fct-item-actions { display:flex; gap:8px; }
.fct-btn-view { padding:8px 16px; border-radius:20px; font-size:12px; font-weight:700; background:#f5f0ff; color:#7c3aed; text-decoration:none; border:1.5px solid #ede9fe; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px; }
.fct-btn-view:hover { background:#7c3aed; color:white; border-color:#7c3aed; }
.fct-btn-pdf { padding:8px 16px; border-radius:20px; font-size:12px; font-weight:700; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; text-decoration:none; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px; }
.fct-btn-pdf:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(180,128,255,0.4); }
.fct-pagination { margin-top:28px; display:flex; justify-content:center; }
</style>

{{-- HERO --}}
<div class="fct-hero">
    <div class="fct-hero-glow"></div>
    <div class="fct-hero-content">
        <div class="fct-hero-tag"><i class="fa-solid fa-file-invoice"></i> My Invoices</div>
        <h1 class="fct-hero-title">Your <span>Invoices</span></h1>
        <p class="fct-hero-sub">Download and manage all your billing documents</p>
    </div>
    <div class="fct-wave"></div>
</div>

<div class="fct-body">

    {{-- TABS --}}
    <div class="fct-tabs">
        @foreach(['toutes'=>['All','fa-list'],'rdv'=>['Appointments','fa-spa'],'commandes'=>['Orders','fa-cart-shopping']] as $val=>$info)
            <a href="{{ route('client.factures.index', ['type'=>$val]) }}"
               class="fct-tab {{ $type===$val?'active':'' }}"
               data-type="{{ $val }}">
                <i class="fa-solid {{ $info[1] }}"></i> {{ $info[0] }}
            </a>
        @endforeach
    </div>

    {{-- CONTENT --}}
    <div id="fct-content">
        @if($factures->isEmpty())
            <div class="fct-empty">
                <i class="fa-solid fa-file-invoice"></i>
                <p>No invoices available in this category.</p>
            </div>
        @else
            <div class="fct-list">
                @foreach($factures as $facture)
                    <div class="fct-item">
                        <div class="fct-item-stripe {{ $facture->type==='rendez_vous'?'rdv':'order' }}"></div>
                        <div class="fct-item-body">
                            <div>
                                <div class="fct-item-num">{{ $facture->numero }}</div>
                                <div class="fct-item-date">
                                    <i class="fa-regular fa-calendar" style="font-size:10px;"></i>
                                    {{ $facture->date_emission->format('d/m/Y at H:i') }}
                                </div>
                                <span class="fct-item-type {{ $facture->type==='rendez_vous'?'rdv':'order' }}">
                                    @if($facture->type==='rendez_vous')
                                        <i class="fa-solid fa-spa" style="font-size:9px;"></i> Appointment
                                    @else
                                        <i class="fa-solid fa-cart-shopping" style="font-size:9px;"></i>
                                        Order {{ $facture->commande?->numero }}
                                    @endif
                                </span>
                            </div>
                            <div class="fct-item-right">
                                <div class="fct-item-amount">{{ number_format($facture->montant_ttc,0,',',' ') }} DA</div>
                                <div class="fct-item-actions">
                                    <a href="{{ route('client.factures.show', $facture) }}" class="fct-btn-view">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('client.factures.telecharger', $facture) }}" class="fct-btn-pdf">
                                        <i class="fa-solid fa-download"></i> PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="fct-pagination">{{ $factures->links() }}</div>
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tabs    = document.querySelectorAll('.fct-tab');
    var content = document.getElementById('fct-content');

    tabs.forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            var url  = tab.getAttribute('href');
            var type = tab.getAttribute('data-type');

            tabs.forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            history.pushState({type: type}, '', url);

            content.innerHTML = '<div class="fct-loading"><i class="fa-solid fa-spinner"></i>Loading...</div>';

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r){ return r.text(); })
                .then(function(html){
                    var doc = new DOMParser().parseFromString(html, 'text/html');
                    var nc  = doc.getElementById('fct-content');
                    if (nc) content.innerHTML = nc.innerHTML;
                })
                .catch(function(){ window.location.href = url; });
        });
    });

    window.addEventListener('popstate', function(){ window.location.reload(); });
});
</script>

</x-app-layout>