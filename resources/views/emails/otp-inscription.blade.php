<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm your registration</title>
<style>* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:"Segoe UI",Arial,sans-serif; background:#f3eeff; color:#1e293b; }
.wrapper { max-width:560px; margin:32px auto; background:white; border-radius:20px; overflow:hidden; box-shadow:0 8px 40px rgba(180,128,255,0.15); }
.header { background:linear-gradient(135deg,#b480ff,#d3aa95); padding:36px 40px; text-align:center; }
.header h1 { color:white; font-size:22px; font-weight:800; letter-spacing:2px; text-transform:uppercase; }
.header p { color:rgba(255,255,255,0.85); font-size:12px; margin-top:6px; letter-spacing:1px; }
.body { padding:36px 40px; }
.greeting { font-size:17px; margin-bottom:14px; color:#1a1a2e; }
.greeting strong { color:#b480ff; }
.msg { font-size:14px; color:#64748b; line-height:1.8; margin-bottom:20px; }
.card { background:#fdf9ff; border-radius:12px; padding:20px 24px; margin:20px 0; border-left:4px solid #b480ff; }
.card.green { border-left-color:#059669; background:#f0fdf4; }
.card.red   { border-left-color:#dc2626; background:#fff5f5; }
.card.orange{ border-left-color:#d97706; background:#fffbeb; }
.card-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid rgba(180,128,255,0.1); font-size:13px; }
.card-row:last-child { border-bottom:none; }
.card-label { color:#64748b; }
.card-value { font-weight:600; color:#1e293b; }
.badge { display:inline-block; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:600; }
.badge.green { background:#d1fae5; color:#065f46; }
.warning { background:#fffbeb; border-left:4px solid #f59e0b; padding:14px 16px; border-radius:10px; margin:16px 0; font-size:13px; color:#92400e; line-height:1.7; }
.divider { height:1px; background:#f1f5f9; margin:20px 0; }
.footer { background:#fdf9ff; padding:24px 40px; text-align:center; border-top:1px solid rgba(180,128,255,0.1); }
.footer p { font-size:11px; color:#94a3b8; line-height:1.7; }
.footer strong { color:#b480ff; }</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>Glow Institute</h1>
        <p>Email Verification 🔐</p>
    </div>
    <div class="body">
        <p class="greeting">Hello, <strong>{{ $prenom }}</strong> ✨</p>
        <p class="msg">Thank you for joining <strong>Glow Institute</strong>!<br>Please use the verification code below to confirm your registration.</p>
        <div class="card" style="text-align:center;padding:28px 24px;">
            <p style="font-size:11px;text-transform:uppercase;letter-spacing:2px;color:#b480ff;font-weight:700;margin-bottom:16px;">Your Verification Code</p>
            <div style="display:flex;justify-content:center;gap:8px;margin-bottom:16px;">
                @for($i = 0; $i < strlen($otp); $i++)
                <div style="width:48px;height:56px;background:white;border:2px solid rgba(180,128,255,0.3);border-radius:12px;display:inline-flex;align-items:center;justify-content:center;font-size:26px;font-weight:800;color:#b480ff;font-family:monospace;">{{ $otp[$i] }}</div>
                @endfor
            </div>
            <p style="font-size:12px;color:#94a3b8;">⏱ This code expires in <strong style="color:#1e293b;">10 minutes</strong></p>
        </div>
        <div class="warning"><p>⚠️ If you did not request this, please ignore this email. Never share this code with anyone.</p></div>
        <div class="divider"></div>
        <p style="font-size:12px;color:#94a3b8;text-align:center;">Having trouble? Contact us at <a href="mailto:glowinstitute.app@gmail.com" style="color:#b480ff;text-decoration:none;">glowinstitute.app@gmail.com</a></p>
    </div>
    <div class="footer">
        <p>This email was sent automatically by <strong>Glow Institute</strong>.<br>Please do not reply to this email directly.</p>
    </div>
</div>
</body>
</html>
