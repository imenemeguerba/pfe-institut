<x-app-layout>
<x-slot name="header">My Cart</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.cart-hero {
    position:relative; overflow:hidden; padding:50px 10% 90px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.cart-hero-glow { position:absolute; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.08),transparent 70%); top:-100px; right:-80px; animation:glow 5s ease-in-out infinite alternate; }
@keyframes glow { from{ transform:scale(1); } to{ transform:scale(1.2); } }
.cart-hero-content { position:relative; z-index:2; text-align:center; }
.cart-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.cart-hero-title { font-family:'Playfair Display',serif; font-size:42px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:10px; }
.cart-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.cart-hero-sub { font-size:14px; color:rgba(255,255,255,0.92); }
.cart-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.cart-body { max-width:960px; margin:0 auto; padding:40px 24px 80px; }
.cart-grid { display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start; }

/* EMPTY */
.cart-empty { background:white; border-radius:24px; border:1px solid #ede9fe; padding:80px 24px; text-align:center; grid-column:1/-1; }
.cart-empty-icon { font-size:72px; margin-bottom:20px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-12px); } }
.cart-empty h3 { font-size:22px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:8px; }
.cart-empty p  { font-size:14px; color:#6b7280; margin-bottom:24px; }
.cart-empty-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; text-decoration:none; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.3); }
.cart-empty-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.4); }

/* ITEMS CARD */
.cart-items-card { background:white; border-radius:24px; border:1px solid #ede9fe; overflow:hidden; box-shadow:0 4px 20px rgba(180,128,255,0.07); opacity:0; animation:fadeUp 0.5s 0.1s forwards; }
@keyframes fadeUp { from{ opacity:0; transform:translateY(16px); } to{ opacity:1; transform:translateY(0); } }
.cart-items-head { padding:18px 22px; border-bottom:1px solid #faf8ff; display:flex; align-items:center; justify-content:space-between; }
.cart-items-title { font-size:15px; font-weight:800; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.cart-items-title i { color:#b480ff; }
.cart-clear-btn { padding:6px 14px; border-radius:20px; font-size:11px; font-weight:600; background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; }
.cart-clear-btn:hover { background:#fff5f5; }

/* ITEM ROW */
.cart-item { display:flex; align-items:center; gap:14px; padding:16px 22px; border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.cart-item:last-child { border-bottom:none; }
.cart-item:hover { background:#fdf9ff; }
.cart-item-img { width:64px; height:64px; border-radius:14px; object-fit:cover; flex-shrink:0; }
.cart-item-img-ph { width:64px; height:64px; border-radius:14px; background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.1)); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.cart-item-info { flex:1; min-width:0; }
.cart-item-name  { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.cart-item-price { font-size:12px; color:#9ca3af; }
.cart-item-total { font-size:16px; font-weight:800; color:#b480ff; white-space:nowrap; }
.cart-qty-ctrl { display:flex; align-items:center; background:#fdf9ff; border:1.5px solid #ede9fe; border-radius:10px; overflow:hidden; flex-shrink:0; }
.cart-qty-btn { width:30px; height:30px; border:none; background:none; cursor:pointer; font-size:14px; color:#b480ff; font-weight:700; display:flex; align-items:center; justify-content:center; transition:background 0.15s; }
.cart-qty-btn:hover { background:rgba(180,128,255,0.08); }
.cart-qty-val { width:34px; text-align:center; font-size:14px; font-weight:700; color:#1a1a2e; }
.cart-remove-btn { width:30px; height:30px; border-radius:50%; border:none; background:rgba(239,68,68,0.06); color:#ef4444; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px; transition:all 0.2s; flex-shrink:0; }
.cart-remove-btn:hover { background:rgba(239,68,68,0.12); transform:scale(1.1); }

/* SUMMARY */
.cart-summary { position:sticky; top:90px; }
.cart-sum-card { background:white; border-radius:24px; border:1px solid #ede9fe; padding:24px; box-shadow:0 8px 30px rgba(180,128,255,0.1); opacity:0; animation:fadeUp 0.5s 0.2s forwards; }
.cart-sum-title { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:20px; display:flex; align-items:center; gap:8px; }
.cart-sum-title i { color:#b480ff; }
.cart-sum-items { margin-bottom:16px; }
.cart-sum-item { display:flex; justify-content:space-between; font-size:13px; color:#6b7280; margin-bottom:8px; }
.cart-sum-item:last-child { margin-bottom:0; }
.cart-sum-item span:last-child { font-weight:600; color:#374151; }
.cart-sum-divider { height:1px; background:#ede9fe; margin:16px 0; }
.cart-sum-total { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.cart-sum-total-label { font-size:14px; font-weight:700; color:#1a1a2e; }
.cart-sum-total-value { font-size:24px; font-weight:900; color:#b480ff; }
.cart-promo-wrap { margin-bottom:16px; }
.cart-promo-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; display:block; }
.cart-promo-input { width:100%; padding:10px 14px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; outline:none; font-family:'Plus Jakarta Sans',sans-serif; text-transform:uppercase; transition:border-color 0.2s; }
.cart-promo-input:focus { border-color:#b480ff; background:white; }
.cart-order-btn { width:100%; padding:14px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); }
.cart-order-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }
.cart-continue-link { display:block; text-align:center; margin-top:12px; font-size:12px; color:#9ca3af; text-decoration:none; }
.cart-continue-link:hover { color:#b480ff; }
.cart-sum-feat { display:flex; align-items:center; gap:8px; font-size:12px; color:#6b7280; margin-bottom:8px; }
.cart-sum-feat i { color:#b480ff; width:14px; text-align:center; }

@media(max-width:768px){ .cart-grid{ grid-template-columns:1fr; } .cart-summary{ position:static; } }
</style>

{{-- HERO --}}
<div class="cart-hero">
    <div class="cart-hero-glow"></div>
    <div class="cart-hero-content">
        <div class="cart-hero-tag"><i class="fa-solid fa-cart-shopping"></i> Shopping Cart</div>
        <h1 class="cart-hero-title">My <span>Cart</span></h1>
        <p class="cart-hero-sub">Review your items and place your order</p>
    </div>
    <div class="cart-wave"></div>
</div>

<div class="cart-body">

    @if($panier->estVide())
        <div class="cart-empty">
            <span class="cart-empty-icon">🛒</span>
            <h3>Your cart is empty</h3>
            <p>Discover our premium beauty products and add them to your cart!</p>
            <a href="{{ route('client.produits.index') }}" class="cart-empty-btn">
                <i class="fa-solid fa-bottle-droplet"></i> Browse the Shop
            </a>
        </div>
    @else
        <div class="cart-grid">

            {{-- ITEMS --}}
            <div>
                <div class="cart-items-card">
                    <div class="cart-items-head">
                        <div class="cart-items-title">
                            <i class="fa-solid fa-cart-shopping"></i>
                            {{ $panier->produits->count() }} Item(s)
                        </div>
                        <form action="{{ route('client.panier.vider') }}" method="POST" id="clearCartForm">
                            @csrf @method('DELETE')
                            <button type="button" class="cart-clear-btn" onclick="
                                glowConfirm(
                                    'Clear your cart?',
                                    'All items will be removed from your cart.',
                                    'Yes, clear it',
                                    'fa-trash',
                                    'red',
                                    function(){ document.getElementById('clearCartForm').submit(); }
                                )">
                                <i class="fa-solid fa-trash"></i> Clear Cart
                            </button>
                        </form>
                    </div>

                    @foreach($panier->produits as $produit)
                        <div class="cart-item" id="item-{{ $produit->id }}">
                            @if($produit->image)
                                <img src="{{ asset('storage/'.$produit->image) }}" class="cart-item-img" alt="{{ $produit->nom }}">
                            @else
                                <div class="cart-item-img-ph">
                                    <i class="fa-solid fa-bottle-droplet" style="font-size:24px;color:#b480ff;opacity:0.4;"></i>
                                </div>
                            @endif
                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $produit->nom }}</div>
                                <div class="cart-item-price">{{ number_format($produit->prix,0,',',' ') }} DA / unit</div>
                            </div>

                            <div class="cart-qty-ctrl">
                                <form action="{{ route('client.panier.modifier', $produit) }}" method="POST" id="qtyForm{{ $produit->id }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="quantite" id="qtyVal{{ $produit->id }}" value="{{ $produit->pivot->quantite }}">
                                </form>
                                <button type="button" class="cart-qty-btn" onclick="changeQty({{ $produit->id }}, {{ $produit->pivot->quantite }}, -1, {{ $produit->stock }})">−</button>
                                <span class="cart-qty-val" id="qtyDisplay{{ $produit->id }}">{{ $produit->pivot->quantite }}</span>
                                <button type="button" class="cart-qty-btn" onclick="changeQty({{ $produit->id }}, {{ $produit->pivot->quantite }}, 1, {{ $produit->stock }})">+</button>
                            </div>

                            <div class="cart-item-total" id="total{{ $produit->id }}">
                                {{ number_format($produit->prix * $produit->pivot->quantite,0,',',' ') }} DA
                            </div>

                            <form action="{{ route('client.panier.retirer', $produit) }}" method="POST" id="removeForm{{ $produit->id }}">
                                @csrf @method('DELETE')
                                <button type="button" class="cart-remove-btn" title="Remove"
                                    onclick="glowConfirm('Remove this item?', '{{ $produit->nom }} will be removed from your cart.', 'Remove', 'fa-xmark', 'red', function(){ document.getElementById('removeForm{{ $produit->id }}').submit(); })">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- SUMMARY --}}
            <div class="cart-summary">
                <div class="cart-sum-card">
                    <div class="cart-sum-title"><i class="fa-solid fa-receipt"></i> Order Summary</div>

                    <div class="cart-sum-items">
                        @foreach($panier->produits as $produit)
                            <div class="cart-sum-item">
                                <span id="sumLabel{{ $produit->id }}">{{ Str::limit($produit->nom,24) }} ×{{ $produit->pivot->quantite }}</span>
                                <span id="sumRow{{ $produit->id }}">{{ number_format($produit->prix * $produit->pivot->quantite,0,',',' ') }} DA</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-sum-divider"></div>
                    <div class="cart-sum-total">
                        <div class="cart-sum-total-label">Total</div>
                        <div class="cart-sum-total-value">{{ number_format($panier->total(),0,',',' ') }} DA</div>
                    </div>

                    <div class="cart-sum-feat"><i class="fa-solid fa-shield-halved"></i> Secure checkout</div>
                    <div class="cart-sum-feat"><i class="fa-solid fa-gift"></i> Earn loyalty points</div>

                    <div class="cart-sum-divider"></div>

                    <form action="{{ route('client.commandes.store') }}" method="POST" id="orderForm">
                        @csrf
                        <div class="cart-promo-wrap">
                            <label class="cart-promo-label">Promo Code (optional)</label>
                            <input type="text" name="code_promo" value="{{ old('code_promo') }}" placeholder="e.g. BEAUTY20" class="cart-promo-input">
                        </div>
                        <button type="button" class="cart-order-btn" onclick="
                            glowConfirm(
                                'Confirm your order?',
                                'Your order will be placed and sent for confirmation.',
                                'Place Order',
                                'fa-bag-shopping',
                                'purple',
                                function(){ document.getElementById('orderForm').submit(); }
                            )">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Place Order — {{ number_format($panier->total(),0,',',' ') }} DA
                        </button>
                    </form>
                    <a href="{{ route('client.produits.index') }}" class="cart-continue-link">
                        <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Continue Shopping
                    </a>
                </div>
            </div>

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

const prices = {
    @foreach($panier->produits as $p)
        {{ $p->id }}: {{ $p->prix }},
    @endforeach
};

function updateCartSummary() {
    let grandTotal = 0;
    @foreach($panier->produits as $p)
        const qty{{ $p->id }}   = parseInt(document.getElementById('qtyDisplay{{ $p->id }}').textContent) || 0;
        const line{{ $p->id }}  = prices[{{ $p->id }}] * qty{{ $p->id }};
        grandTotal += line{{ $p->id }};
        const sumRow{{ $p->id }}   = document.getElementById('sumRow{{ $p->id }}');
        const sumLabel{{ $p->id }} = document.getElementById('sumLabel{{ $p->id }}');
        if (sumRow{{ $p->id }})   sumRow{{ $p->id }}.textContent   = line{{ $p->id }}.toLocaleString('fr-FR') + ' DA';
        if (sumLabel{{ $p->id }}) sumLabel{{ $p->id }}.textContent = '{{ Str::limit($p->nom,24) }} ×' + qty{{ $p->id }};
    @endforeach
    document.querySelectorAll('.cart-sum-total-value').forEach(el => {
        el.textContent = grandTotal.toLocaleString('fr-FR') + ' DA';
    });
    document.querySelectorAll('.cart-order-btn').forEach(btn => {
        btn.innerHTML = '<i class="fa-solid fa-bag-shopping"></i> Place Order — ' + grandTotal.toLocaleString('fr-FR') + ' DA';
    });
}

function changeQty(id, current, delta, max) {
    let qty = parseInt(document.getElementById('qtyDisplay'+id).textContent) + delta;
    if (qty < 1) qty = 1;
    if (qty > max) qty = max;
    document.getElementById('qtyDisplay'+id).textContent = qty;
    document.getElementById('qtyVal'+id).value = qty;
    const total = prices[id] * qty;
    document.getElementById('total'+id).textContent = total.toLocaleString('fr-FR') + ' DA';
    updateCartSummary();
    clearTimeout(window['timer'+id]);
    window['timer'+id] = setTimeout(function() {
        const form  = document.getElementById('qtyForm'+id);
        const token = form.querySelector('[name="_token"]').value;
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: '_method=PATCH&_token=' + encodeURIComponent(token) + '&quantite=' + qty
        }).catch(function() { form.submit(); });
    }, 600);
}
</script>

</x-app-layout>
