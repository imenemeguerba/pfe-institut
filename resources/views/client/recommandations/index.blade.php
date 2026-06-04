<x-app-layout>
<x-slot name="header">My Recommendations</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }
.rec-hero { position:relative; overflow:hidden; padding:70px 10% 110px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.rec-orb { position:absolute; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.08),transparent); animation:orbFloat ease-in-out infinite alternate; }
.rec-orb-1 { width:400px; height:400px; top:-100px; right:-100px; animation-duration:6s; }
.rec-orb-2 { width:300px; height:300px; bottom:-80px; left:-60px; animation-duration:8s; animation-delay:2s; }
@keyframes orbFloat { from{ transform:scale(1) translate(0,0); } to{ transform:scale(1.1) translate(20px,-20px); } }
.rec-hero-content { position:relative; z-index:2; text-align:center; }
.rec-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.rec-hero-title { font-family:'Playfair Display',serif; font-size:48px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:14px; line-height:1.2; }
.rec-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.rec-hero-sub { font-size:15px; color:rgba(255,255,255,0.88); max-width:480px; margin:0 auto; line-height:1.7; }
.rec-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }
.rec-body { max-width:1000px; margin:0 auto; padding:40px 24px 80px; }
.skin-card { background:white; border-radius:28px; padding:36px; box-shadow:0 8px 40px rgba(180,128,255,0.1); border:1px solid #ede9fe; margin-bottom:40px; opacity:0; animation:fadeUp 0.6s 0.1s forwards; }
@keyframes fadeUp { from{ opacity:0; transform:translateY(20px); } to{ opacity:1; transform:translateY(0); } }
.skin-card-title { font-size:20px; font-weight:800; color:#1a1a2e; margin-bottom:6px; }
.skin-card-sub   { font-size:14px; color:#9ca3af; margin-bottom:28px; line-height:1.6; }
.skin-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:12px; margin-bottom:24px; }
.skin-opt { display:none; }
.skin-label { display:flex; flex-direction:column; align-items:center; gap:8px; padding:18px 10px; border-radius:18px; border:2px solid #ede9fe; cursor:pointer; transition:all 0.3s; text-align:center; background:white; position:relative; overflow:hidden; }
.skin-label::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(180,128,255,0.06),rgba(211,170,149,0.06)); opacity:0; transition:opacity 0.3s; }
.skin-label:hover { border-color:#b480ff; transform:translateY(-4px); box-shadow:0 8px 24px rgba(180,128,255,0.15); }
.skin-label:hover::before { opacity:1; }
.skin-opt:checked + .skin-label { border-color:#b480ff; background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.05)); box-shadow:0 8px 24px rgba(180,128,255,0.2); transform:translateY(-4px); }
.skin-opt:checked + .skin-label::after { content:'✓'; position:absolute; top:8px; right:10px; font-size:11px; font-weight:800; color:#b480ff; }
.skin-icon { width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg,rgba(180,128,255,0.15),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; font-size:20px; color:#b480ff; }
.skin-name { font-size:13px; font-weight:700; color:#1a1a2e; }
.skin-desc { font-size:10px; color:#9ca3af; line-height:1.4; }
.btn-rec { display:inline-flex; align-items:center; gap:8px; padding:14px 32px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); }
.btn-rec:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.45); }
.skin-banner { display:flex; align-items:center; gap:16px; padding:16px 22px; background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.05)); border:1.5px solid rgba(180,128,255,0.2); border-radius:18px; margin-bottom:32px; opacity:0; animation:fadeUp 0.5s 0.2s forwards; }
.skin-banner-icon { width:42px; height:42px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
.skin-banner-text { font-size:15px; font-weight:700; color:#1a1a2e; }
.skin-banner-sub  { font-size:12px; color:#9ca3af; margin-top:2px; }
.skin-change-btn { margin-left:auto; padding:8px 18px; border-radius:30px; font-size:12px; font-weight:600; color:#b480ff; border:1.5px solid rgba(180,128,255,0.25); background:white; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; transition:all 0.2s; }
.skin-change-btn:hover { background:#b480ff; color:white; border-color:#b480ff; }
.rec-section { margin-bottom:40px; opacity:0; animation:fadeUp 0.5s forwards; }
.rec-section:nth-child(1){ animation-delay:0.2s; }
.rec-section:nth-child(2){ animation-delay:0.35s; }
.rec-section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.rec-section-title { font-size:20px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:10px; }
.rec-section-icon { width:38px; height:38px; border-radius:12px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:16px; }
.rec-section-count { font-size:12px; color:#9ca3af; font-weight:600; }
.rec-view-all { font-size:12px; font-weight:700; color:#b480ff; text-decoration:none; display:inline-flex; align-items:center; gap:5px; padding:7px 16px; border-radius:20px; border:1.5px solid rgba(180,128,255,0.2); transition:all 0.2s; }
.rec-view-all:hover { background:#b480ff; color:white; border-color:#b480ff; }
.rec-svc-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.rec-svc-card { background:white; border-radius:20px; border:1px solid #ede9fe; overflow:hidden; transition:all 0.3s cubic-bezier(0.175,0.885,0.32,1.275); box-shadow:0 4px 16px rgba(180,128,255,0.06); }
.rec-svc-card:hover { transform:translateY(-6px) scale(1.01); box-shadow:0 18px 48px rgba(180,128,255,0.15); border-color:#c4b5fd; }
.rec-svc-img { height:140px; overflow:hidden; position:relative; }
.rec-svc-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.5s; }
.rec-svc-card:hover .rec-svc-img img { transform:scale(1.08); }
.rec-svc-img-ph { width:100%; height:100%; background:linear-gradient(135deg,rgba(180,128,255,0.12),rgba(211,170,149,0.12)); display:flex; align-items:center; justify-content:center; }
.rec-svc-cat { position:absolute; top:10px; left:10px; font-size:9px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; padding:3px 10px; border-radius:20px; background:rgba(255,255,255,0.9); color:#b480ff; }
.rec-svc-body { padding:16px; }
.rec-svc-name  { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:5px; }
.rec-svc-desc  { font-size:11px; color:#9ca3af; line-height:1.5; margin-bottom:12px; }
.rec-svc-foot  { display:flex; align-items:center; justify-content:space-between; }
.rec-svc-price { font-size:16px; font-weight:900; color:#b480ff; }
.rec-svc-dur   { font-size:10px; color:#c4b5fd; margin-top:1px; }
.rec-svc-btn { display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:20px; font-size:11px; font-weight:700; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; text-decoration:none; transition:all 0.2s; white-space:nowrap; }
.rec-svc-btn:hover { transform:scale(1.05); box-shadow:0 4px 12px rgba(180,128,255,0.4); }
.rec-prd-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; }
.rec-prd-card { background:white; border-radius:20px; border:1px solid #ede9fe; overflow:hidden; transition:all 0.3s cubic-bezier(0.175,0.885,0.32,1.275); box-shadow:0 4px 16px rgba(180,128,255,0.06); }
.rec-prd-card:hover { transform:translateY(-6px) scale(1.01); box-shadow:0 18px 48px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.rec-prd-img { height:140px; overflow:hidden; }
.rec-prd-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.5s; }
.rec-prd-card:hover .rec-prd-img img { transform:scale(1.08); }
.rec-prd-img-ph { width:100%; height:100%; background:linear-gradient(135deg,rgba(211,170,149,0.15),rgba(180,128,255,0.1)); display:flex; align-items:center; justify-content:center; }
.rec-prd-body { padding:14px; }
.rec-prd-name  { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:10px; }
.rec-prd-foot  { display:flex; align-items:center; justify-content:space-between; }
.rec-prd-price { font-size:15px; font-weight:900; color:#b480ff; }
.rec-prd-actions { display:flex; gap:6px; align-items:center; }
.rec-prd-view { width:30px; height:30px; border-radius:50%; background:#f5f0ff; border:1.5px solid #ede9fe; color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:12px; text-decoration:none; transition:all 0.2s; }
.rec-prd-view:hover { background:#b480ff; color:white; border-color:#b480ff; }
.rec-prd-btn { width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; border:none; cursor:pointer; font-size:13px; display:flex; align-items:center; justify-content:center; transition:all 0.2s; }
.rec-prd-btn:hover { transform:scale(1.15); box-shadow:0 4px 12px rgba(180,128,255,0.4); }
.rec-empty { text-align:center; padding:40px; color:#d1d5db; font-style:italic; font-size:13px; }
@media(max-width:768px){ .skin-grid{ grid-template-columns:repeat(3,1fr); } .rec-svc-grid{ grid-template-columns:1fr; } .rec-prd-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:480px){ .skin-grid{ grid-template-columns:1fr 1fr; } .rec-prd-grid{ grid-template-columns:1fr; } }
</style>

<div class="rec-hero">
    <div class="rec-orb rec-orb-1"></div>
    <div class="rec-orb rec-orb-2"></div>
    <div class="rec-hero-content">
        <div class="rec-hero-tag"><i class="fa-solid fa-wand-magic-sparkles"></i> Personalized For You</div>
        <h1 class="rec-hero-title">Your <span>Beauty Profile</span></h1>
        <p class="rec-hero-sub">Services and products selected based on your unique skin type for the best results</p>
    </div>
    <div class="rec-wave"></div>
</div>

<div class="rec-body">

    <div class="skin-card">
        <div class="skin-card-title">What's your skin type?</div>
        <div class="skin-card-sub">Select your skin type to receive personalized service and product recommendations tailored to your needs.</div>
        <form method="POST" action="{{ route('client.recommandations.update') }}">
            @csrf
            <div class="skin-grid">
                @foreach([
                    'normale'  => ['fa-leaf',              'Normal',      'Balanced, no excess oil or dryness'],
                    'grasse'   => ['fa-droplet',           'Oily',        'Shiny skin, enlarged pores'],
                    'seche'    => ['fa-sun',               'Dry',         'Tight, rough, flaky'],
                    'mixte'    => ['fa-circle-half-stroke','Combination', 'Oily T-zone, dry cheeks'],
                    'sensible' => ['fa-heart',             'Sensitive',   'Reactive, prone to redness'],
                ] as $val => $info)
                    <div>
                        <input type="radio" name="type_peau" id="skin_{{ $val }}" value="{{ $val }}" class="skin-opt" {{ $typePeau===$val?'checked':'' }}>
                        <label for="skin_{{ $val }}" class="skin-label">
                            <div class="skin-icon"><i class="fa-solid {{ $info[0] }}"></i></div>
                            <div class="skin-name">{{ $info[1] }}</div>
                            <div class="skin-desc">{{ $info[2] }}</div>
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn-rec">
                <i class="fa-solid fa-wand-magic-sparkles"></i> See My Recommendations
            </button>
        </form>
    </div>

    @if($typePeau)
        @php
            $skinInfo = [
                'normale'  => ['fa-leaf',              'Normal skin'],
                'grasse'   => ['fa-droplet',           'Oily skin'],
                'seche'    => ['fa-sun',               'Dry skin'],
                'mixte'    => ['fa-circle-half-stroke','Combination skin'],
                'sensible' => ['fa-heart',             'Sensitive skin'],
            ][$typePeau] ?? ['fa-sparkles', $typePeau];
        @endphp

        <div class="skin-banner">
            <div class="skin-banner-icon"><i class="fa-solid {{ $skinInfo[0] }}"></i></div>
            <div>
                <div class="skin-banner-text">{{ $skinInfo[1] }}</div>
                <div class="skin-banner-sub">Showing personalized recommendations for your profile</div>
            </div>
            <button class="skin-change-btn" onclick="document.querySelector('.skin-card').scrollIntoView({behavior:'smooth'})">
                Change type
            </button>
        </div>

        <div class="rec-section">
            <div class="rec-section-header">
                <div class="rec-section-title">
                    <div class="rec-section-icon"><i class="fa-solid fa-spa"></i></div>
                    Recommended Services
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <span class="rec-section-count">{{ $servicesRecommandes->count() }} service(s)</span>
                    <a href="{{ route('client.services.index') }}" class="rec-view-all">
                        View all <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                    </a>
                </div>
            </div>
            @if($servicesRecommandes->isEmpty())
                <div class="rec-empty" style="background:white;border-radius:20px;border:1px solid #ede9fe;">
                    No services available for your skin type right now.
                </div>
            @else
                <div class="rec-svc-grid">
                    @foreach($servicesRecommandes as $service)
                        <div class="rec-svc-card">
                            <div class="rec-svc-img">
                                @if($service->image)
                                    <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->nom }}">
                                @else
                                    <div class="rec-svc-img-ph">
                                        <i class="fa-solid fa-spa" style="font-size:40px;color:#b480ff;opacity:0.5;"></i>
                                    </div>
                                @endif
                                @if($service->category)
                                    <span class="rec-svc-cat">{{ $service->category->nom }}</span>
                                @endif
                            </div>
                            <div class="rec-svc-body">
                                <div class="rec-svc-name">{{ $service->nom }}</div>
                                @if($service->description)
                                    <div class="rec-svc-desc">{{ Str::limit($service->description,70) }}</div>
                                @endif
                                <div class="rec-svc-foot">
                                    <div>
                                        <div class="rec-svc-price">{{ number_format($service->prix,0,',',' ') }} DA</div>
                                        <div class="rec-svc-dur"><i class="fa-regular fa-clock" style="font-size:9px;"></i> {{ $service->duree }} min</div>
                                    </div>
                                    <a href="{{ route('client.reservation.create', ['service'=>$service->id]) }}" class="rec-svc-btn">
                                        <i class="fa-regular fa-calendar-check"></i> Book
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="rec-section">
            <div class="rec-section-header">
                <div class="rec-section-title">
                    <div class="rec-section-icon" style="background:rgba(211,170,149,0.15);color:#d3aa95;"><i class="fa-solid fa-bottle-droplet"></i></div>
                    Recommended Products
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <span class="rec-section-count">{{ $produitsRecommandes->count() }} product(s)</span>
                    <a href="{{ route('client.produits.index') }}" class="rec-view-all" style="border-color:rgba(211,170,149,0.3);color:#d3aa95;">
                        View all <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                    </a>
                </div>
            </div>
            @if($produitsRecommandes->isEmpty())
                <div class="rec-empty" style="background:white;border-radius:20px;border:1px solid #ede9fe;">
                    No products available for your skin type right now.
                </div>
            @else
                <div class="rec-prd-grid">
                    @foreach($produitsRecommandes as $produit)
                        <div class="rec-prd-card">
                            <div class="rec-prd-img">
                                @if($produit->image)
                                    <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}">
                                @else
                                    <div class="rec-prd-img-ph">
                                        <i class="fa-solid fa-bottle-droplet" style="font-size:36px;color:#d3aa95;opacity:0.7;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="rec-prd-body">
                                <div class="rec-prd-name">{{ $produit->nom }}</div>
                                <div class="rec-prd-foot">
                                    <div class="rec-prd-price">{{ number_format($produit->prix,0,',',' ') }} DA</div>
                                    <div class="rec-prd-actions">
                                        <a href="{{ route('client.produits.show', $produit) }}" class="rec-prd-view" title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        {{-- ✅ AJAX cart --}}
                                        <form method="POST" action="{{ route('client.panier.ajouter', $produit) }}" class="pg-cart-form">
                                            @csrf
                                            <button type="submit" class="rec-prd-btn pg-cart-btn" title="Add to cart">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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

// ✅ Cart AJAX
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
