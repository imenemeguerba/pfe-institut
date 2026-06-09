<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Notification</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:"Segoe UI",Arial,sans-serif; background:#f3eeff; color:#1e293b; }
.wrapper { max-width:560px; margin:32px auto; background:white; border-radius:20px; overflow:hidden; box-shadow:0 8px 40px rgba(180,128,255,0.15); }
.header { background:linear-gradient(135deg,#b480ff,#d3aa95); padding:36px 40px; text-align:center; }
.header h1 { color:white; font-size:22px; font-weight:800; letter-spacing:2px; text-transform:uppercase; }
.header p  { color:rgba(255,255,255,0.85); font-size:12px; margin-top:6px; letter-spacing:1px; }
.body   { padding:36px 40px; }
.greeting { font-size:17px; margin-bottom:14px; color:#1a1a2e; }
.greeting strong { color:#b480ff; }
.msg { font-size:14px; color:#64748b; line-height:1.8; margin-bottom:20px; }
.card { border-radius:12px; padding:20px 24px; margin:20px 0; }
.card.green  { border-left:4px solid #059669; background:#f0fdf4; }
.card.red    { border-left:4px solid #dc2626; background:#fff5f5; }
.card.orange { border-left:4px solid #d97706; background:#fffbeb; }
.footer { background:#fdf9ff; padding:24px 40px; text-align:center; border-top:1px solid rgba(180,128,255,0.1); }
.footer p { font-size:11px; color:#94a3b8; line-height:1.7; }
.footer strong { color:#b480ff; }
</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>Glow Institute</h1>
        <p>Information about your account</p>
    </div>
    <div class="body">
        <p class="greeting">Hello, <strong>{{ $prenom }}</strong></p>

        @if($action === 'supprime')
            <p class="msg">Your <strong>Glow Institute</strong> account has been <strong style="color:#dc2626;">permanently deleted</strong>.</p>
            <div class="card red">
                <p style="font-size:13px;color:#991b1b;">All your data has been removed from our system.</p>
                @if($motif)
                    <p style="font-size:13px;color:#991b1b;margin-top:8px;"><strong>Reason:</strong> {{ $motif }}</p>
                @endif
            </div>

        @elseif($action === 'bloque')
            <p class="msg">Your <strong>Glow Institute</strong> account has been <strong style="color:#d97706;">blocked</strong>.</p>
            <div class="card orange">
                @if($motif)
                    <p style="font-size:13px;color:#92400e;"><strong>Reason:</strong> {{ $motif }}</p>
                    <p style="font-size:13px;color:#92400e;margin-top:8px;">If you believe this is a mistake, please contact our team.</p>
                @else
                    <p style="font-size:13px;color:#92400e;">If you believe this is a mistake, please contact our team.</p>
                @endif
            </div>

        @elseif($action === 'reactive')
            <p class="msg">Great news! Your <strong>Glow Institute</strong> account has been <strong style="color:#059669;">reactivated</strong>.</p>
            <div class="card green">
                <p style="font-size:13px;color:#065f46;">You can now sign in and access all services as usual.</p>
            </div>

        @else
            <p class="msg">There has been an update regarding your <strong>Glow Institute</strong> account. Please contact our team for more information.</p>
        @endif

        <p class="msg" style="margin-top:16px;">For any questions, please contact the Glow Institute administration.</p>
    </div>
    <div class="footer">
        <p>This email was sent automatically by <strong>Glow Institute</strong>.<br>Please do not reply to this email directly.</p>
    </div>
</div>
</body>
</html>
