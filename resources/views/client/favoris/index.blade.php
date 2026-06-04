<x-app-layout>
<x-slot name="header">My Favorites</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.fav-hero { position:relative; overflow:hidden; padding:60px 10% 110px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.fav-hearts { position:absolute; inset:0; pointer-events:none; }
.fav-heart-float { position:absolute; font-size:18px; opacity:0; animation:heartFloat linear infinite; }
@keyframes heartFloat { 0%{ transform:translateY(100vh) scale(0) rotate(-20deg); opacity:0; } 10%{ opacity:0.4; } 90%{ opacity:0.2; } 100%{ transform:translateY(-80px) scale(1) rotate(15deg); opacity:0; } }
.fav-hero-content { position:relative; z-index:2; text-align:center; }
.fav-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.fav-hero-title { font-family:'Playfair Display',serif; font-size:46px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:12px; }
.fav-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.fav-hero-sub { font-size:15px; color:rgba(255,255,255,0.92); margin-bottom:16px; }
.fav-hero-count { display:inline-flex; align-items:center; gap:8px; padding:8px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); color:white; font-size:14px; font-weight:700; }
.fav-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.fav-body { max-width:1200px; margin:0 auto; padding:40px 24px 80px; }

.fav-empty { background:white; border-radius:28px; border:1px solid #ede9fe; padding:80px 24px; text-align:center; box-shadow:0 4px 20px rgba(180,128,255,0.06); }
.fav-empty-icon { font-size:64px; display:block; margin-bottom:20px; animation:heartbeat 1.5s ease-in-out infinite; }
@keyframes heartbeat { 0%,100%{ transform:scale(1); } 14%{ transform:scale(1.15); } 28%{ transform:scale(1); } 42%{ transform:scale(1.1); } 70%{ transform:scale(1); } }
.fav-empty h3 { font-size:22px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:8px; }
.fav-empty p  { font-size:14px; color:#6b7280; margin-bottom:24px; }
.fav-empty-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; text-decoration:none; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.3); }
.fav-empty-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.4); }

.fav-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:22px; }
.fav-card { background:white; border-radius:22px; overflow:hidden; border:1px solid #ede9fe; box-shadow:0 4px 16px rgba(180,128,255,0.06); transition:all 0.4s cubic-bezier(0.175,0.885,0.32,1.275); opacity:0; animation:cardIn 0.5s forwards; position:relative; }
.fav-card:nth-child(1){animation-delay:0s} .fav-card:nth-child(2){animation-delay:.06s} .fav-card:nth-child(3){animation-delay:.12s} .fav-card:nth-child(4){animation-delay:.18s}
.fav-card:nth-child(5){animation-delay:.24s} .fav-card:nth-child(6){animation-delay:.3s} .fav-card:nth-child(7){animation-delay:.36s} .fav-card:nth-child(8){animation-delay:.42s}
@keyframes cardIn { from{opacity:0;transform:translateY(20px) scale(0.96);} to{opacity:1;transform:translateY(0) scale(1);} }
.fav-card:hover { transform:translateY(-10px) scale(1.02); box-shadow:0 24px 56px rgba(180,128,255,0.15); border-color:#c4b5fd; }

.fav-card-img { position:relative; height:200px; overflow:hidden; }
.fav-card-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.6s ease; }
.fav-card:hover .fav-card-img img { transform:scale(1.08); }
.fav-card-img-ph { width:100%; height:100%; background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; }

/* ✅ remove btn: z-index above overlay */
.fav-remove-form { position:absolute; top:10px; right:10px; z-index:3; }
.fav-remove-btn { width:34px; height:34px; border-radius:50%; background:white; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:14px; color:#ef4444; box-shadow:0 2px 10px rgba(0,0,0,0.12); transition:all 0.2s; }
.fav-remove-btn:hover { transform:scale(1.2); box-shadow:0 4px 16px rgba(239,68,68,0.3); background:#fff5f5; }
.fav-stock-badge { position:absolute; top:10px; left:10px; padding:3px 10px; border-radius:20px; font-size:10px; font-weight:700; background:rgba(239,68,68,0.85); color:white; z-index:2; }
.fav-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(26,10,53,0.6),transparent); opacity:0; transition:opacity 0.3s; display:flex; align-items:flex-end; padding:14px; z-index:1; pointer-events:none; }
.fav-card:hover .fav-overlay { opacity:1; pointer-events:auto; }
.fav-overlay-link { display:inline-flex; align-items:center; gap:5px; padding:7px 14px; border-radius:20px; background:rgba(255,255,255,0.9); color:#b480ff; font-size:11px; font-weight:700; text-decoration:none; }

.fav-card-body { padding:16px; }
.fav-card-name  { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.fav-card-stock { font-size:11px; color:#9ca3af; margin-bottom:10px; }
.fav-card-foot  { display:flex; align-items:center; justify-content:space-between; }
.fav-card-price { font-size:18px; font-weight:900; color:#b480ff; }
.fav-add-btn { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); border:none; cursor:pointer; color:white; font-size:15px; transition:all 0.2s; box-shadow:0 4px 12px rgba(180,128,255,0.3); }
.fav-add-btn:hover { transform:scale(1.15); box-shadow:0 6px 18px rgba(180,128,255,0.5); }

@media(max-width:1024px){ .fav-grid{ grid-template-columns:repeat(3,1fr); } }
@media(max-width:768px) { .fav-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:480px) { .fav-grid{ grid-template-columns:1fr; } }
</style>

{{-- HERO --}}
<div class="fav-hero">
    <div class="fav-hearts" id="hearts"></div>
    <div class="fav-hero-content">
        <div class="fav-hero-tag"><i class="fa-solid fa-heart"></i> My Wishlist</div>
        <h1 class="fav-hero-title">My <span>Favorites</span></h1>
        <p class="fav-hero-sub">Products you love, saved for whenever you're ready</p>
        @if(!$favoris->isEmpty())
            <div class="fav-hero-count">
                <i class="fa-solid fa-heart" style="color:#fca5a5;"></i>
                {{ $favoris->count() }} favorite product(s)
            </div>
        @endif
    </div>
    <div class="fav-wave"></div>
</div>

<div class="fav-body">

    @if($favoris->isEmpty())
        <div class="fav-empty">
            <span class="fav-empty-icon">🤍</span>
            <h3>No favorites yet</h3>
            <p>Browse our shop and tap the heart icon on products you love!</p>
            <a href="{{ route('client.produits.index') }}" class="fav-empty-btn">
                <i class="fa-solid fa-bottle-droplet"></i> Discover Products
            </a>
        </div>
    @else
        <div class="fav-grid">
            @foreach($favoris as $produit)
                <div class="fav-card">
                    <div class="fav-card-img">
                        @if($produit->image)
                            <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}">
                        @else
                            <div class="fav-card-img-ph">
                                <i class="fa-solid fa-bottle-droplet" style="font-size:48px;color:#b480ff;opacity:0.4;"></i>
                            </div>
                        @endif

                        @if($produit->stock <= 5)
                            <span class="fav-stock-badge">Low Stock</span>
                        @endif

                        {{-- ✅ remove fav: AJAX + toast, pas de confirm (juste toggle) --}}
                        <form action="{{ route('client.favoris.toggle', $produit) }}" method="POST"
                              class="fav-remove-form fav-toggle-form">
                            @csrf
                            <button type="submit" class="fav-remove-btn" title="Remove from favorites">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>

                        <div class="fav-overlay">
                            <a href="{{ route('client.produits.show', $produit) }}" class="fav-overlay-link">
                                <i class="fa-solid fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                    <div class="fav-card-body">
                        <div class="fav-card-name">{{ $produit->nom }}</div>
                        <div class="fav-card-stock">{{ $produit->stock }} in stock</div>
                        <div class="fav-card-foot">
                            <div class="fav-card-price">{{ number_format($produit->prix,0,',',' ') }} DA</div>
                            {{-- ✅ add to cart: AJAX + toast --}}
                            <form action="{{ route('client.panier.ajouter', $produit) }}" method="POST"
                                  class="fav-cart-form">
                                @csrf
                                <button type="submit" class="fav-add-btn" title="Add to cart">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

{{-- TOAST --}}
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

<script>
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid ' + (type==='error'?'fa-circle-xmark':'fa-circle-check') + '" style="font-size:14px;flex-shrink:0;"></i><span>' + msg + '</span>';
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex'; t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); }, 4000);
}

@if(session('success'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('error')), 'error'); });
@endif

// ✅ Fav toggle AJAX — remove card with animation + toast
document.querySelectorAll('.fav-toggle-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var card = form.closest('.fav-card');
        showToast('Removed from favorites.', 'success');
        // Animate card out
        card.style.transition = 'all 0.35s ease';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.85)';
        setTimeout(function() {
            card.remove();
            // Update count badge
            var remaining = document.querySelectorAll('.fav-card').length;
            var countEl = document.querySelector('.fav-hero-count');
            if (countEl) {
                if (remaining === 0) {
                    countEl.remove();
                    document.querySelector('.fav-grid').innerHTML =
                        '<div class="fav-empty" style="grid-column:1/-1"><span class="fav-empty-icon">🤍</span><h3>No favorites yet</h3><p>Browse our shop and tap the heart icon on products you love!</p><a href="{{ route("client.produits.index") }}" class="fav-empty-btn"><i class="fa-solid fa-bottle-droplet"></i> Discover Products</a></div>';
                } else {
                    countEl.innerHTML = '<i class="fa-solid fa-heart" style="color:#fca5a5;"></i> ' + remaining + ' favorite product(s)';
                }
            }
        }, 350);
        fetch(form.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value, 'X-Requested-With': 'XMLHttpRequest' },
            body: new FormData(form)
        }).catch(function() { window.location.reload(); });
    });
});

// ✅ Add to cart AJAX + toast
document.querySelectorAll('.fav-cart-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn  = form.querySelector('.fav-add-btn');
        var icon = btn.querySelector('i');
        btn.style.background = 'linear-gradient(135deg,#10b981,#059669)';
        icon.className = 'fa-solid fa-check';
        showToast('Product added to cart!', 'success');
        setTimeout(function() {
            btn.style.background = '';
            icon.className = 'fa-solid fa-cart-plus';
        }, 1400);
        fetch(form.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value, 'X-Requested-With': 'XMLHttpRequest' },
            body: new FormData(form)
        }).catch(function() { form.submit(); });
    });
});

// Floating hearts
const heartsEl = document.getElementById('hearts');
for (let i = 0; i < 15; i++) {
    const h = document.createElement('div');
    h.className = 'fav-heart-float';
    h.textContent = ['❤️','🩷','💕','💖'][Math.floor(Math.random()*4)];
    h.style.cssText = `left:${Math.random()*100}%;animation-duration:${Math.random()*12+8}s;animation-delay:${Math.random()*10}s;font-size:${Math.random()*16+10}px;`;
    heartsEl.appendChild(h);
}

// 3D tilt
document.querySelectorAll('.fav-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left - rect.width/2) / rect.width;
        const y = (e.clientY - rect.top - rect.height/2) / rect.height;
        card.style.transform = `translateY(-10px) scale(1.02) perspective(800px) rotateX(${y*-6}deg) rotateY(${x*6}deg)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
        card.style.transition = 'all 0.6s cubic-bezier(0.175,0.885,0.32,1.275)';
    });
});
</script>

</x-app-layout>
