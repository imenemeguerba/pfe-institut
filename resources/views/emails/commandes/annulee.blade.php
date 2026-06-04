<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Order Cancelled</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Helvetica Neue',Arial,sans-serif; background:#f5f0ff; color:#1a1a2e; }
.wrapper { max-width:580px; margin:32px auto; background:white; border-radius:20px; overflow:hidden; box-shadow:0 4px 24px rgba(180,128,255,0.12); }
.header { background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%); padding:36px 40px; text-align:center; }
.header-icon { width:60px; height:60px; background:rgba(255,255,255,0.2); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:16px; }
.header-icon span { font-size:28px; }
.header h1 { font-size:22px; font-weight:800; color:white; margin-bottom:6px; }
.header p  { font-size:13px; color:rgba(255,255,255,0.8); }
.body { padding:32px 40px; }
.greeting { font-size:15px; font-weight:600; color:#1a1a2e; margin-bottom:8px; }
.intro    { font-size:13px; color:#6b7280; line-height:1.7; margin-bottom:24px; }
.order-card { background:#fdf9ff; border:1.5px solid rgba(180,128,255,0.15); border-radius:14px; padding:20px 24px; margin-bottom:20px; }
.order-num  { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; margin-bottom:6px; }
.order-val  { font-family:monospace; font-size:20px; font-weight:800; color:#b480ff; margin-bottom:16px; }
.row        { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid #f0ebff; font-size:13px; }
.row:last-child { border-bottom:none; padding-bottom:0; }
.row-label  { color:#6b7280; }
.row-value  { font-weight:600; color:#1a1a2e; }
.row-total  { font-size:15px; font-weight:800; }
.row-total .row-value { color:#b480ff; font-size:17px; }
.motif-box  { background:#fff5f5; border:1px solid rgba(239,68,68,0.2); border-left:3px solid #ef4444; border-radius:10px; padding:14px 16px; margin-bottom:20px; }
.motif-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#ef4444; margin-bottom:6px; }
.motif-text  { font-size:13px; color:#374151; line-height:1.6; }
.products-title { font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:10px; }
.product-item   { display:flex; justify-content:space-between; padding:8px 12px; background:#fdf9ff; border-radius:8px; font-size:13px; margin-bottom:6px; }
.product-name   { color:#374151; }
.product-price  { font-weight:600; color:#b480ff; }
.support-box { background:rgba(180,128,255,0.05); border:1px solid rgba(180,128,255,0.15); border-radius:12px; padding:16px 20px; margin-top:20px; }
.support-box p { font-size:13px; color:#6b7280; line-height:1.7; }
.support-box a { color:#b480ff; font-weight:600; text-decoration:none; }
.footer { background:#faf8ff; padding:20px 40px; text-align:center; border-top:1px solid #f0ebff; }
.footer p { font-size:11px; color:#d1d5db; line-height:1.8; }
.footer strong { color:#b480ff; }
</style>
</head>
<body>
<div class="wrapper">

    {{-- HEADER --}}
    <div class="header">
        <div class="header-icon"><span>❌</span></div>
        <h1>Order Cancelled</h1>
        <p>We're sorry to inform you about this cancellation</p>
    </div>

    <div class="body">
        <p class="greeting">Hello {{ $commande->client->prenom }},</p>
        <p class="intro">
            Your order has been cancelled by our team.
            @if($commande->motif_annulation)
                Please see the reason below.
            @endif
            We apologise for any inconvenience this may have caused.
        </p>

        {{-- MOTIF --}}
        @if($commande->motif_annulation)
            <div class="motif-box">
                <div class="motif-label">Reason for cancellation</div>
                <div class="motif-text">{{ $commande->motif_annulation }}</div>
            </div>
        @endif

        {{-- ORDER CARD --}}
        <div class="order-card">
            <div class="order-num">Order reference</div>
            <div class="order-val">{{ $commande->numero }}</div>

            {{-- PRODUCTS --}}
            @if($commande->produits->isNotEmpty())
                <div class="products-title">Cancelled items</div>
                @foreach($commande->produits as $produit)
                    <div class="product-item">
                        <span class="product-name">{{ $produit->nom }} × {{ $produit->pivot->quantite }}</span>
                        <span class="product-price">{{ number_format($produit->pivot->prix_au_moment * $produit->pivot->quantite, 0, ',', ' ') }} DA</span>
                    </div>
                @endforeach
                <div style="height:12px;"></div>
            @endif

            <div class="row">
                <span class="row-label">Order date</span>
                <span class="row-value">{{ $commande->created_at->format('d/m/Y') }}</span>
            </div>
            @if($commande->codePromo)
                <div class="row">
                    <span class="row-label">Promo code used</span>
                    <span class="row-value">{{ $commande->codePromo->code }}</span>
                </div>
            @endif
            <div class="row row-total">
                <span class="row-label">Order total</span>
                <span class="row-value">{{ number_format($commande->montant_total, 0, ',', ' ') }} DA</span>
            </div>
        </div>

        {{-- SUPPORT --}}
        <div class="support-box">
            <p>
                If you have any questions regarding this cancellation, please don't hesitate to contact us via the
                <a href="{{ config('app.url') }}/client/contact">contact form</a>
                or reach us directly at
                <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>.
            </p>
        </div>
    </div>

    <div class="footer">
        <p>
            <strong>Glow Institute</strong> — Beauty & Wellness<br>
            This email was sent automatically. Please do not reply directly to this message.
        </p>
    </div>

</div>
</body>
</html>
