<x-app-layout>
<x-slot name="header">My Orders</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.cm-hero { position:relative; overflow:hidden; padding:50px 10% 90px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.cm-hero-glow { position:absolute; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-100px; right:-80px; animation:glow 5s ease-in-out infinite alternate; }
@keyframes glow { from{transform:scale(1);} to{transform:scale(1.2);} }
.cm-hero-content { position:relative; z-index:2; text-align:center; }
.cm-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.25); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:18px; }
.cm-hero-title { font-family:'Playfair Display',serif; font-size:42px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:10px; }
.cm-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.cm-hero-sub { font-size:14px; color:rgba(255,255,255,0.92); }
.cm-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.cm-body { max-width:860px; margin:0 auto; padding:40px 24px 80px; }

.cm-tabs { display:flex; background:white; border-radius:20px; padding:6px; box-shadow:0 4px 20px rgba(180,128,255,0.08); border:1px solid #ede9fe; margin-bottom:28px; }
.cm-tab { flex:1; padding:10px 10px; border-radius:14px; text-align:center; font-size:12px; font-weight:600; text-decoration:none; color:#9ca3af; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:5px; cursor:pointer; }
.cm-tab:hover { color:#b480ff; }
.cm-tab.active { background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; box-shadow:0 4px 14px rgba(180,128,255,0.3); }

.cm-empty { background:white; border-radius:24px; border:1px solid #ede9fe; padding:64px 24px; text-align:center; }
.cm-empty i { font-size:48px; color:#e9d8fd; margin-bottom:16px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
.cm-empty h3 { font-size:22px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:8px; }
.cm-empty p  { font-size:14px; color:#6b7280; margin-bottom:24px; }
.cm-empty-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; text-decoration:none; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.3); }
.cm-empty-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.4); }

.cm-loading { text-align:center; padding:40px; color:#b480ff; font-size:13px; font-weight:600; }
.cm-loading i { font-size:24px; margin-bottom:8px; display:block; animation:spin 1s linear infinite; }
@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

.cm-list { display:flex; flex-direction:column; gap:14px; }
.cm-card { background:white; border-radius:22px; border:1px solid #ede9fe; box-shadow:0 4px 16px rgba(180,128,255,0.06); overflow:hidden; transition:all 0.3s cubic-bezier(0.175,0.885,0.32,1.275); opacity:0; animation:slideIn 0.4s forwards; display:flex; }
.cm-card:nth-child(1){animation-delay:0s} .cm-card:nth-child(2){animation-delay:.07s} .cm-card:nth-child(3){animation-delay:.14s} .cm-card:nth-child(4){animation-delay:.21s}
@keyframes slideIn { from{opacity:0;transform:translateX(-16px);} to{opacity:1;transform:translateX(0);} }
.cm-card:hover { transform:translateY(-4px); box-shadow:0 16px 44px rgba(180,128,255,0.13); border-color:#c4b5fd; }
.cm-card-stripe { width:5px; flex-shrink:0; }
.cm-card-stripe.waiting  { background:linear-gradient(to bottom,#f97316,#fbbf24); }
.cm-card-stripe.confirmed{ background:linear-gradient(to bottom,#10b981,#34d399); }
.cm-card-stripe.cancelled{ background:linear-gradient(to bottom,#ef4444,#fca5a5); }
.cm-card-body { flex:1; padding:18px 22px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.cm-card-num  { font-size:16px; font-weight:900; color:#b480ff; font-family:monospace; margin-bottom:4px; }
.cm-card-date { font-size:12px; color:#9ca3af; margin-bottom:8px; }
.cm-card-tags { display:flex; flex-wrap:wrap; gap:5px; }
.cm-card-tag  { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; }
.cm-card-right { display:flex; flex-direction:column; align-items:flex-end; gap:8px; flex-shrink:0; }
.cm-card-price { font-size:20px; font-weight:900; color:#b480ff; }
.cm-card-status { font-size:11px; font-weight:700; padding:4px 12px; border-radius:20px; }
.cm-card-status.waiting   { background:rgba(249,115,22,0.1); color:#f97316; }
.cm-card-status.confirmed { background:rgba(16,185,129,0.1); color:#059669; }
.cm-card-status.cancelled { background:rgba(239,68,68,0.1); color:#ef4444; }
.cm-card-actions { display:flex; gap:8px; align-items:center; }
.cm-btn-detail { padding:7px 14px; border-radius:20px; font-size:11px; font-weight:700; background:#f5f0ff; color:#7c3aed; text-decoration:none; border:1.5px solid #ede9fe; transition:all 0.2s; display:inline-flex; align-items:center; gap:4px; }
.cm-btn-detail:hover { background:#7c3aed; color:white; border-color:#7c3aed; }
.cm-btn-cancel { padding:7px 12px; border-radius:20px; font-size:11px; font-weight:600; background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:inherit; transition:all 0.2s; }
.cm-btn-cancel:hover { background:#fff5f5; }
.cm-pagination { margin-top:28px; display:flex; justify-content:center; }
</style>

<div class="cm-hero">
    <div class="cm-hero-glow"></div>
    <div class="cm-hero-content">
        <div class="cm-hero-tag"><i class="fa-solid fa-box"></i> My Orders</div>
        <h1 class="cm-hero-title">Order <span>History</span></h1>
        <p class="cm-hero-sub">Track and manage all your beauty product orders</p>
    </div>
    <div class="cm-wave"></div>
</div>

<div class="cm-body">

    <div class="cm-tabs">
        @foreach(['toutes'=>['All','fa-list'],'en_attente'=>['Pending','fa-clock'],'confirmees'=>['Confirmed','fa-check'],'annulees'=>['Cancelled','fa-xmark']] as $val=>$info)
            <a href="{{ route('client.commandes.index', ['filtre'=>$val]) }}"
               class="cm-tab {{ $filtre===$val?'active':'' }}"
               data-filtre="{{ $val }}">
                <i class="fa-solid {{ $info[1] }}"></i> {{ $info[0] }}
            </a>
        @endforeach
    </div>

    <div id="cm-content">
        @if($commandes->isEmpty())
            <div class="cm-empty">
                <i class="fa-solid fa-box-open"></i>
                <h3>No orders yet</h3>
                <p>{{ $filtre==='toutes' ? "You haven't placed any orders yet." : 'No orders in this category.' }}</p>
                <a href="{{ route('client.produits.index') }}" class="cm-empty-btn">
                    <i class="fa-solid fa-bottle-droplet"></i> Shop Products
                </a>
            </div>
        @else
            <div class="cm-list">
                @foreach($commandes as $commande)
                    @php
                        $stripeClass = match($commande->statut) { 'en_attente'=>'waiting','confirmee'=>'confirmed',default=>'cancelled' };
                        $statusLabel = match($commande->statut) { 'en_attente'=>'Pending','confirmee'=>'Confirmed',default=>'Cancelled' };
                    @endphp
                    <div class="cm-card">
                        <div class="cm-card-stripe {{ $stripeClass }}"></div>
                        <div class="cm-card-body">
                            <div>
                                <div class="cm-card-num">{{ $commande->numero }}</div>
                                <div class="cm-card-date"><i class="fa-regular fa-calendar" style="font-size:10px;"></i> {{ $commande->created_at->format('d/m/Y at H:i') }}</div>
                                <div class="cm-card-tags">
                                    @foreach($commande->produits->take(3) as $p)
                                        <span class="cm-card-tag">{{ $p->nom }}</span>
                                    @endforeach
                                    @if($commande->produits->count() > 3)
                                        <span class="cm-card-tag">+{{ $commande->produits->count()-3 }} more</span>
                                    @endif
                                </div>
                            </div>
                            <div class="cm-card-right">
                                <div class="cm-card-price">{{ number_format($commande->prix_final,0,',',' ') }} DA</div>
                                <span class="cm-card-status {{ $stripeClass }}">{{ $statusLabel }}</span>
                                <div class="cm-card-actions">
                                    <a href="{{ route('client.commandes.show', $commande) }}" class="cm-btn-detail">
                                        Details <i class="fa-solid fa-arrow-right" style="font-size:9px;"></i>
                                    </a>
                                    @if($commande->statut==='en_attente')
                                        <form action="{{ route('client.commandes.annuler', $commande) }}"
                                              method="POST" id="cancelOrder{{ $commande->id }}">
                                            @csrf @method('PATCH')
                                            <button type="button" class="cm-btn-cancel"
                                                onclick="glowConfirm('Cancel this order?','Order {{ $commande->numero }} will be cancelled.','Yes, cancel','fa-xmark','red',function(){ document.getElementById('cancelOrder{{ $commande->id }}').submit(); })">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cm-pagination">{{ $commandes->links() }}</div>
        @endif
    </div>

</div>

{{-- TOAST --}}
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

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

document.addEventListener('DOMContentLoaded', function() {
    var tabs    = document.querySelectorAll('.cm-tab');
    var content = document.getElementById('cm-content');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            var url = tab.getAttribute('href');
            tabs.forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            history.pushState({}, '', url);
            content.innerHTML = '<div class="cm-loading"><i class="fa-solid fa-spinner"></i>Loading...</div>';
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r){ return r.text(); })
                .then(function(html){
                    var doc = new DOMParser().parseFromString(html, 'text/html');
                    var nc  = doc.getElementById('cm-content');
                    if (nc) content.innerHTML = nc.innerHTML;
                })
                .catch(function(){ window.location.href = url; });
        });
    });
    window.addEventListener('popstate', function(){ window.location.reload(); });
});
</script>

</x-app-layout>
