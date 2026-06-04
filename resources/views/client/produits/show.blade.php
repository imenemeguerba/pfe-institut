<x-app-layout>
<x-slot name="header">{{ $produit->nom }}</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.prd-hero {
    position:relative; overflow:hidden; padding:48px 10% 80px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.prd-hero-pattern { position:absolute; inset:0; background-image:radial-gradient(circle at 20% 50%,rgba(255,255,255,0.07) 0%,transparent 50%),radial-gradient(circle at 80% 20%,rgba(255,255,255,0.05) 0%,transparent 40%); }
.prd-hero-content { position:relative; z-index:2; display:flex; align-items:flex-start; justify-content:space-between; gap:24px; flex-wrap:wrap; }
.prd-back { display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border-radius:20px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.35); color:white; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s; margin-bottom:16px; }
.prd-back:hover { background:rgba(255,255,255,0.3); }
.prd-hero-cat  { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.75); margin-bottom:8px; }
.prd-hero-name { font-family:'Playfair Display',serif; font-size:30px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.15); margin-bottom:8px; line-height:1.2; }
.prd-hero-price { font-size:28px; font-weight:900; color:white; text-shadow:0 2px 12px rgba(0,0,0,0.15); }
.prd-wave { position:absolute; bottom:-2px; left:0; right:0; height:60px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23faf8ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* BODY */
.prd-body { max-width:1000px; margin:0 auto; padding:32px 24px 80px; }

/* MAIN GRID */
.prd-main { display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; margin-bottom:32px; }

/* IMAGE */
.prd-img-wrap { border-radius:24px; overflow:hidden; box-shadow:0 20px 60px rgba(180,128,255,0.15); position:relative; opacity:0; animation:fadeUp 0.6s forwards; }
@keyframes fadeUp { from{ opacity:0; transform:translateY(20px); } to{ opacity:1; transform:translateY(0); } }
.prd-img { width:100%; height:420px; object-fit:cover; transition:transform 0.6s ease; }
.prd-img-wrap:hover .prd-img { transform:scale(1.04); }
.prd-img-ph { width:100%; height:420px; background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; }
.prd-img-badge { position:absolute; top:16px; left:16px; padding:5px 14px; border-radius:20px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; }
.prd-img-badge.cat { background:rgba(255,255,255,0.9); color:#b480ff; backdrop-filter:blur(4px); }
.prd-img-badge.low { background:rgba(239,68,68,0.85); color:white; top:52px; }
.prd-fav-btn { position:absolute; top:16px; right:16px; width:40px; height:40px; border-radius:50%; background:white; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:16px; color:#ef4444; box-shadow:0 4px 14px rgba(0,0,0,0.12); transition:all 0.2s; }
.prd-fav-btn:hover { transform:scale(1.15); box-shadow:0 6px 18px rgba(236,72,153,0.3); }
.prd-fav-btn.active { background:#fff0f3; }

/* INFO */
.prd-info { opacity:0; animation:fadeLeft 0.6s 0.1s forwards; }
@keyframes fadeLeft { from{ opacity:0; transform:translateX(20px); } to{ opacity:1; transform:translateX(0); } }
.prd-cat  { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#b480ff; margin-bottom:10px; }
.prd-name { font-family:'Playfair Display',serif; font-size:28px; font-weight:800; color:#1a1a2e; margin-bottom:14px; line-height:1.3; }
.prd-desc { font-size:14px; color:#6b7280; line-height:1.9; margin-bottom:24px; }
.prd-price-wrap { display:flex; align-items:center; gap:10px; margin-bottom:20px; flex-wrap:wrap; }
.prd-price { font-size:38px; font-weight:900; color:#b480ff; }
.prd-stock-pill { padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700; }
.prd-stock-pill.ok  { background:rgba(16,185,129,0.1); color:#059669; border:1px solid rgba(16,185,129,0.2); }
.prd-stock-pill.low { background:rgba(239,68,68,0.1); color:#ef4444; border:1px solid rgba(239,68,68,0.2); }

/* VARIANTS */
.var-section-label { font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:8px; display:block; }
.var-pill { padding:8px 18px; border-radius:30px; font-size:13px; font-weight:600; border:1.5px solid #ede9fe; background:#fdf9ff; color:#374151; cursor:pointer; transition:all 0.2s; font-family:'Plus Jakarta Sans',sans-serif; }
.var-pill:hover { border-color:#b480ff; color:#b480ff; }
.var-pill.active { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.3); }

/* QTY */
.prd-qty-wrap { display:flex; align-items:center; gap:14px; margin-bottom:20px; }
.prd-qty-label { font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; }
.prd-qty-ctrl { display:flex; align-items:center; background:#fdf9ff; border:1.5px solid #ede9fe; border-radius:12px; overflow:hidden; }
.prd-qty-btn { width:36px; height:36px; border:none; background:none; cursor:pointer; font-size:16px; color:#b480ff; font-weight:700; transition:background 0.15s; display:flex; align-items:center; justify-content:center; }
.prd-qty-btn:hover { background:rgba(180,128,255,0.08); }
.prd-qty-input { width:48px; text-align:center; border:none; background:none; font-size:15px; font-weight:700; color:#1a1a2e; outline:none; font-family:'Plus Jakarta Sans',sans-serif; }

/* BUTTONS */
.prd-actions { display:flex; gap:10px; flex-wrap:wrap; }
.btn-add-cart { flex:1; display:flex; align-items:center; justify-content:center; gap:8px; padding:14px 24px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); }
.btn-add-cart:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }
.btn-fav { width:52px; height:52px; border-radius:50%; border:1.5px solid #ede9fe; background:white; cursor:pointer; font-size:18px; color:#ef4444; display:flex; align-items:center; justify-content:center; transition:all 0.2s; flex-shrink:0; }
.btn-fav:hover { border-color:#ec4899; transform:scale(1.1); box-shadow:0 4px 14px rgba(236,72,153,0.25); }

.in-cart-notice { display:flex; align-items:center; gap:8px; padding:10px 14px; border-radius:12px; background:rgba(180,128,255,0.08); border:1px solid rgba(180,128,255,0.2); font-size:13px; font-weight:600; color:#b480ff; margin-top:12px; }
.prd-features { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-top:20px; }
.prd-feat { display:flex; align-items:center; gap:8px; font-size:12px; color:#6b7280; }
.prd-feat i { color:#b480ff; width:16px; text-align:center; }

@media(max-width:768px){ .prd-main{ grid-template-columns:1fr; } .prd-img,.prd-img-ph{ height:300px; } .prd-features{ grid-template-columns:1fr; } }
</style>

{{-- HERO --}}
<div class="prd-hero">
    <div class="prd-hero-pattern"></div>
    <div class="prd-hero-content">
        <div>
            <a href="{{ route('client.produits.index') }}" class="prd-back">
                <i class="fa-solid fa-arrow-left"></i> Shop
            </a>
            @if($produit->categorie)
                <div class="prd-hero-cat">{{ $produit->categorie->nom }}</div>
            @endif
            <div class="prd-hero-name">{{ $produit->nom }}</div>
            <div class="prd-hero-price">{{ number_format($produit->prix,0,',',' ') }} DA</div>
        </div>
        <div style="padding-top:40px;">
            @if($produit->stock <= 5)
                <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 16px;border-radius:20px;background:rgba(239,68,68,0.2);border:1px solid rgba(239,68,68,0.3);color:white;font-size:12px;font-weight:700;">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size:10px;"></i> Low Stock
                </span>
            @else
                <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 16px;border-radius:20px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:12px;font-weight:700;">
                    <i class="fa-solid fa-check" style="font-size:10px;"></i> In Stock
                </span>
            @endif
        </div>
    </div>
    <div class="prd-wave"></div>
</div>

<div class="prd-body">

    <div class="prd-main">

        {{-- IMAGE --}}
        <div>
            <div class="prd-img-wrap">
                @if($produit->image)
                    <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="prd-img">
                @else
                    <div class="prd-img-ph">
                        <i class="fa-solid fa-bottle-droplet" style="font-size:90px;color:#b480ff;opacity:0.3;"></i>
                    </div>
                @endif
                @if($produit->categorie)
                    <span class="prd-img-badge cat">{{ $produit->categorie->nom }}</span>
                @endif
                @if($produit->stock <= 5)
                    <span class="prd-img-badge low" style="top:{{ $produit->categorie?'52px':'16px' }};">Low Stock</span>
                @endif
                <form action="{{ route('client.favoris.toggle', $produit) }}" method="POST" onsubmit="submitFav(event, this)">
                    @csrf
                    <button type="submit" class="prd-fav-btn {{ $estFavori?'active':'' }}" id="favBtnImg">
                        <i class="fa-{{ $estFavori?'solid':'regular' }} fa-heart"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- INFO --}}
        <div class="prd-info">
            @if($produit->categorie)
                <div class="prd-cat">{{ $produit->categorie->nom }}</div>
            @endif
            <div class="prd-name">{{ $produit->nom }}</div>
            @if($produit->description)
                <div class="prd-desc">{{ $produit->description }}</div>
            @endif

            @if($produit->variantes->isNotEmpty())
                <div class="prd-price-wrap">
                    <div class="prd-price" id="prdPrice">{{ number_format($produit->variantes->first()->prix,0,',',' ') }} DA</div>
                    <span class="prd-stock-pill {{ $produit->variantes->first()->stock <= 5 ? 'low' : 'ok' }}" id="prdStock">
                        {{ $produit->variantes->first()->stock <= 5 ? $produit->variantes->first()->stock.' left' : $produit->variantes->first()->stock.' in stock' }}
                    </span>
                </div>
                <div style="margin-bottom:20px;">
                    <span class="var-section-label">Size / Volume</span>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach($produit->variantes as $i => $v)
                            <button type="button" class="var-pill {{ $i===0?'active':'' }}"
                                data-id="{{ $v->id }}" data-prix="{{ $v->prix }}" data-stock="{{ $v->stock }}"
                                onclick="selectVariant(this)">{{ $v->nom }}</button>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="prd-price-wrap">
                    <div class="prd-price">{{ number_format($produit->prix,0,',',' ') }} DA</div>
                    <span class="prd-stock-pill {{ $produit->stock <= 5 ? 'low' : 'ok' }}">
                        {{ $produit->stock <= 5 ? $produit->stock.' left' : $produit->stock.' in stock' }}
                    </span>
                </div>
            @endif

            <form action="{{ route('client.panier.ajouter', $produit) }}" method="POST" id="addCartForm" onsubmit="submitCart(event)">
                @csrf
                @if($produit->variantes->isNotEmpty())
                    <input type="hidden" name="variante_id" id="selectedVarianteId" value="{{ $produit->variantes->first()->id }}">
                @endif
                <div class="prd-qty-wrap">
                    <div class="prd-qty-label">Quantity</div>
                    <div class="prd-qty-ctrl">
                        <button type="button" class="prd-qty-btn" onclick="changeQty(-1)">−</button>
                        <input type="number" name="quantite" id="qtyInput" value="1" min="1"
                               max="{{ $produit->variantes->isNotEmpty() ? $produit->variantes->first()->stock : $produit->stock }}"
                               class="prd-qty-input">
                        <button type="button" class="prd-qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>
                <div class="prd-actions">
                    <button type="submit" class="btn-add-cart">
                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                    </button>
                    <form action="{{ route('client.favoris.toggle', $produit) }}" method="POST" onsubmit="submitFav(event, this)">
                        @csrf
                        <button type="submit" class="btn-fav {{ $estFavori?'active':'' }}" id="favBtnInfo">
                            <i class="fa-{{ $estFavori?'solid':'regular' }} fa-heart"></i>
                        </button>
                    </form>
                </div>
            </form>

            @if($qteEnPanier > 0)
                <div class="in-cart-notice">
                    <i class="fa-solid fa-cart-shopping"></i> {{ $qteEnPanier }} already in your cart
                </div>
            @endif

            <div class="prd-features">
                <div class="prd-feat"><i class="fa-solid fa-flask"></i> Expert-tested formula</div>
                <div class="prd-feat"><i class="fa-solid fa-leaf"></i> Quality guaranteed</div>
                <div class="prd-feat"><i class="fa-solid fa-star"></i> Top-rated product</div>
                <div class="prd-feat"><i class="fa-solid fa-gift"></i> Earn loyalty points</div>
            </div>
        </div>

    </div>


{{-- TOAST --}}
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
</div>

<script>
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid ' + (type==='error'?'fa-circle-xmark':'fa-circle-check') + '" style="font-size:14px;flex-shrink:0;"></i><span>' + msg + '</span>';
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex'; t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); }, 4000);
}

function selectVariant(btn) {
    document.querySelectorAll('.var-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    const prix  = parseInt(btn.dataset.prix);
    const stock = parseInt(btn.dataset.stock);
    const id    = btn.dataset.id;
    document.getElementById('prdPrice').textContent = new Intl.NumberFormat('fr-DZ').format(prix) + ' DA';
    const stockEl = document.getElementById('prdStock');
    if (stock <= 5) {
        stockEl.textContent = stock + ' left';
        stockEl.className = 'prd-stock-pill low';
    } else {
        stockEl.textContent = stock + ' in stock';
        stockEl.className = 'prd-stock-pill ok';
    }
    document.getElementById('selectedVarianteId').value = id;
    const qtyInput = document.getElementById('qtyInput');
    qtyInput.max = stock;
    if (parseInt(qtyInput.value) > stock) qtyInput.value = Math.max(1, stock);
}

function changeQty(delta) {
    const input = document.getElementById('qtyInput');
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    if (val > parseInt(input.max)) val = parseInt(input.max);
    input.value = val;
}

function submitCart(e) {
    e.preventDefault();
    var form = document.getElementById('addCartForm');
    var btn  = form.querySelector('.btn-add-cart');
    btn.innerHTML = '<i class="fa-solid fa-check"></i> Added!';
    btn.style.background = 'linear-gradient(to right,#10b981,#059669)';
    showToast('Product added to cart!', 'success');
    setTimeout(function(){ btn.innerHTML='<i class="fa-solid fa-cart-plus"></i> Add to Cart'; btn.style.background=''; }, 1800);
    fetch(form.action, {
        method:'POST',
        headers:{'X-CSRF-TOKEN':form.querySelector('[name="_token"]').value,'X-Requested-With':'XMLHttpRequest'},
        body: new FormData(form)
    }).catch(function(){ form.submit(); });
}

// Toggle fav for both buttons (image + info)
var _favActive = {{ $estFavori ? 'true' : 'false' }};
function submitFav(e, form) {
    e.preventDefault();
    _favActive = !_favActive;
    ['favBtnImg','favBtnInfo'].forEach(function(id){
        var b = document.getElementById(id);
        if (!b) return;
        var i = b.querySelector('i');
        b.classList.toggle('active', _favActive);
        i.className = _favActive ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
    });
    showToast(_favActive ? 'Added to favorites!' : 'Removed from favorites.', 'success');
    fetch(form.action, {
        method:'POST',
        headers:{'X-CSRF-TOKEN':form.querySelector('[name="_token"]').value,'X-Requested-With':'XMLHttpRequest'},
        body: new FormData(form)
    }).catch(function(){ form.submit(); });
}

@if(session('success'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('error')), 'error'); });
@endif
</script>

</x-app-layout>
