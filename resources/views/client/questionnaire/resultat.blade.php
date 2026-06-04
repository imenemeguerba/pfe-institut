<x-app-layout>
<x-slot name="header">Your Skin Analysis</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }
.res-hero { position:relative; overflow:hidden; padding:60px 10% 110px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.res-hero-glow1 { position:absolute; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-100px; right:-50px; animation:glow 5s ease-in-out infinite alternate; }
.res-hero-glow2 { position:absolute; width:300px; height:300px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.08),transparent 70%); bottom:-80px; left:-60px; animation:glow 4s ease-in-out 1s infinite alternate; }
@keyframes glow { from{transform:scale(1);} to{transform:scale(1.2);} }
.res-hero-content { position:relative; z-index:2; text-align:center; }
.res-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.res-hero-emoji { font-size:72px; display:block; margin-bottom:16px; animation:bounceIn 0.8s ease; }
@keyframes bounceIn { 0%{transform:scale(0);opacity:0;} 60%{transform:scale(1.1);} 100%{transform:scale(1);opacity:1;} }
.res-hero-type { font-family:'Playfair Display',serif; font-size:48px; font-weight:800; color:white; margin-bottom:10px; text-shadow:0 2px 16px rgba(0,0,0,0.15); }
.res-hero-type span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.res-hero-desc { font-size:15px; color:rgba(255,255,255,0.88); max-width:500px; margin:0 auto 24px; line-height:1.7; }
.res-retry { display:inline-flex; align-items:center; gap:6px; padding:8px 20px; border-radius:20px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s; }
.res-retry:hover { background:rgba(255,255,255,0.3); }
.res-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,30 C360,60 1080,0 1440,30 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }
.res-body { max-width:960px; margin:0 auto; padding:40px 24px 80px; }
.res-card { background:white; border-radius:24px; padding:28px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); margin-bottom:20px; opacity:0; animation:fadeUp 0.5s forwards; }
.res-card:nth-child(1){animation-delay:0.1s} .res-card:nth-child(2){animation-delay:0.2s} .res-card:nth-child(3){animation-delay:0.3s} .res-card:nth-child(4){animation-delay:0.4s} .res-card:nth-child(5){animation-delay:0.5s}
@keyframes fadeUp { from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }
.res-card-title { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:10px; }
.res-card-icon { width:36px; height:36px; border-radius:12px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
.routine-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.routine-box { border-radius:16px; padding:20px; }
.routine-box.am { background:linear-gradient(135deg,rgba(251,191,36,0.08),rgba(245,158,11,0.04)); border:1px solid rgba(245,158,11,0.15); }
.routine-box.pm { background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(99,102,241,0.04)); border:1px solid rgba(180,128,255,0.15); }
.routine-box-title { font-size:14px; font-weight:700; margin-bottom:14px; display:flex; align-items:center; gap:6px; }
.routine-box.am .routine-box-title { color:#b45309; }
.routine-box.pm .routine-box-title { color:#7c3aed; }
.routine-step { display:flex; align-items:center; gap:10px; margin-bottom:8px; }
.routine-step:last-child { margin-bottom:0; }
.routine-step-num { width:24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; flex-shrink:0; }
.routine-box.am .routine-step-num { background:#f59e0b; color:white; }
.routine-box.pm .routine-step-num { background:#7c3aed; color:white; }
.routine-step-text { font-size:13px; color:#374151; }
.avoid-grid { display:flex; flex-wrap:wrap; gap:8px; }
.avoid-tag { display:inline-flex; align-items:center; gap:5px; padding:6px 14px; border-radius:20px; background:rgba(239,68,68,0.06); border:1px solid rgba(239,68,68,0.15); color:#ef4444; font-size:12px; font-weight:600; }
.qr-svc-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.qr-svc-card { border:1.5px solid #ede9fe; border-radius:16px; padding:16px; transition:all 0.2s; background:white; }
.qr-svc-card:hover { border-color:#b480ff; transform:translateY(-3px); box-shadow:0 10px 28px rgba(180,128,255,0.12); }
.qr-svc-name  { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:5px; }
.qr-svc-price { font-size:16px; font-weight:900; color:#b480ff; margin-bottom:10px; }
.qr-svc-btn { display:block; text-align:center; padding:8px; border-radius:10px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:700; text-decoration:none; transition:opacity 0.2s; }
.qr-svc-btn:hover { opacity:0.88; }
.qr-prd-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; }
.qr-prd-card { border:1px solid #ede9fe; border-radius:16px; overflow:hidden; transition:all 0.2s; }
.qr-prd-card:hover { transform:translateY(-3px); box-shadow:0 10px 28px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.qr-prd-img { height:110px; overflow:hidden; }
.qr-prd-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.4s; }
.qr-prd-card:hover .qr-prd-img img { transform:scale(1.08); }
.qr-prd-img-ph { width:100%; height:100%; background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; }
.qr-prd-body { padding:12px; }
.qr-prd-name  { font-size:12px; font-weight:700; color:#1a1a2e; margin-bottom:8px; }
.qr-prd-foot  { display:flex; align-items:center; justify-content:space-between; }
.qr-prd-price { font-size:13px; font-weight:900; color:#b480ff; }
.qr-prd-btn { width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; border:none; cursor:pointer; font-size:12px; display:flex; align-items:center; justify-content:center; transition:all 0.2s; }
.qr-prd-btn:hover { transform:scale(1.15); box-shadow:0 4px 10px rgba(180,128,255,0.4); }
@media(max-width:768px){ .routine-grid{grid-template-columns:1fr;} .qr-svc-grid{grid-template-columns:1fr 1fr;} .qr-prd-grid{grid-template-columns:1fr 1fr;} }
@media(max-width:480px){ .qr-svc-grid{grid-template-columns:1fr;} .qr-prd-grid{grid-template-columns:1fr 1fr;} }
</style>

<div class="res-hero">
    <div class="res-hero-glow1"></div>
    <div class="res-hero-glow2"></div>
    <div class="res-hero-content">
        <div class="res-hero-tag"><i class="fa-solid fa-flask"></i> Your Results</div>
        <span class="res-hero-emoji">{{ $infosTypePeau['icon'] }}</span>
        <div class="res-hero-type">Your Skin is <span>{{ $infosTypePeau['label'] }}</span></div>
        <div class="res-hero-desc">{{ $infosTypePeau['description'] }}</div>
        <a href="{{ route('client.questionnaire.index') }}" class="res-retry">
            <i class="fa-solid fa-rotate-right"></i> Retake the Quiz
        </a>
    </div>
    <div class="res-wave"></div>
</div>

<div class="res-body">

    <div class="res-card">
        <div class="res-card-title">
            <div class="res-card-icon"><i class="fa-solid fa-calendar-day"></i></div>
            Your Daily Routine
        </div>
        <div class="routine-grid">
            <div class="routine-box am">
                <div class="routine-box-title"><i class="fa-solid fa-sun"></i> Morning Routine (AM)</div>
                @foreach($infosTypePeau['routine_am'] as $i => $step)
                    <div class="routine-step">
                        <div class="routine-step-num">{{ $i+1 }}</div>
                        <div class="routine-step-text">{{ $step }}</div>
                    </div>
                @endforeach
            </div>
            <div class="routine-box pm">
                <div class="routine-box-title"><i class="fa-solid fa-moon"></i> Evening Routine (PM)</div>
                @foreach($infosTypePeau['routine_pm'] as $i => $step)
                    <div class="routine-step">
                        <div class="routine-step-num">{{ $i+1 }}</div>
                        <div class="routine-step-text">{{ $step }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="res-card" style="border-color:rgba(239,68,68,0.15);">
        <div class="res-card-title">
            <div class="res-card-icon" style="background:rgba(239,68,68,0.1);color:#ef4444;"><i class="fa-solid fa-ban"></i></div>
            Avoid for Your Skin Type
        </div>
        <div class="avoid-grid">
            @foreach($infosTypePeau['eviter'] as $item)
                <span class="avoid-tag"><i class="fa-solid fa-xmark" style="font-size:10px;"></i> {{ $item }}</span>
            @endforeach
        </div>
    </div>

    @if($services->isNotEmpty())
    <div class="res-card">
        <div class="res-card-title">
            <div class="res-card-icon"><i class="fa-solid fa-spa"></i></div>
            Recommended Services for You
        </div>
        <div class="qr-svc-grid">
            @foreach($services as $service)
                <div class="qr-svc-card">
                    <div class="qr-svc-name">{{ $service->nom }}</div>
                    <div class="qr-svc-price">{{ number_format($service->prix,0,',',' ') }} DA</div>
                    <a href="{{ route('client.reservation.create', ['service'=>$service->id]) }}" class="qr-svc-btn">
                        <i class="fa-regular fa-calendar-check"></i> Book Now
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($produits->isNotEmpty())
    <div class="res-card">
        <div class="res-card-title">
            <div class="res-card-icon" style="background:rgba(211,170,149,0.15);color:#d3aa95;"><i class="fa-solid fa-bottle-droplet"></i></div>
            Recommended Products
        </div>
        <div class="qr-prd-grid">
            @foreach($produits as $produit)
                <div class="qr-prd-card">
                    <div class="qr-prd-img">
                        @if($produit->image)
                            <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}">
                        @else
                            <div class="qr-prd-img-ph"><i class="fa-solid fa-bottle-droplet" style="font-size:32px;color:#d3aa95;"></i></div>
                        @endif
                    </div>
                    <div class="qr-prd-body">
                        <div class="qr-prd-name">{{ Str::limit($produit->nom,30) }}</div>
                        <div class="qr-prd-foot">
                            <div class="qr-prd-price">{{ number_format($produit->prix,0,',',' ') }} DA</div>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('client.produits.show', $produit) }}" style="width:30px;height:30px;border-radius:50%;background:#f5f0ff;border:1.5px solid #ede9fe;color:#b480ff;display:flex;align-items:center;justify-content:center;font-size:12px;text-decoration:none;" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                {{-- ✅ AJAX cart --}}
                                <form method="POST" action="{{ route('client.panier.ajouter', $produit) }}" class="pg-cart-form" style="display:flex;">
                                    @csrf
                                    <button type="submit" class="qr-prd-btn pg-cart-btn" title="Add to cart">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

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

document.querySelectorAll('.pg-cart-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn  = form.querySelector('.pg-cart-btn');
        var icon = btn ? btn.querySelector('i') : null;
        if (btn)  btn.style.background = 'linear-gradient(135deg,#10b981,#059669)';
        if (icon) icon.className = 'fa-solid fa-check';
        showToast('Product added to cart!', 'success');
        setTimeout(function() {
            if (btn)  btn.style.background = '';
            if (icon) icon.className = 'fa-solid fa-cart-plus';
        }, 1400);
        fetch(form.action, {
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':form.querySelector('[name="_token"]').value, 'X-Requested-With':'XMLHttpRequest' },
            body: new FormData(form)
        }).catch(function(){ form.submit(); });
    });
});
</script>

</x-app-layout>
