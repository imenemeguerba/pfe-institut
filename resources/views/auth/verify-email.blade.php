<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify Email — {{ config('app.name') }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Segoe UI',Arial,sans-serif; background:#f3eeff; display:flex; align-items:center; justify-content:center; min-height:100vh; }

.card {
    width:480px; background:white; border-radius:24px;
    box-shadow:0 0 40px rgba(180,128,255,0.18);
    overflow:hidden;
}
.card-header {
    background:linear-gradient(135deg, #b480ff, #d3aa95);
    padding:40px 32px; text-align:center; color:white;
}
.card-header .icon { font-size:52px; margin-bottom:14px; }
.card-header h1 { font-size:24px; font-weight:700; margin-bottom:6px; }
.card-header p  { font-size:13px; color:rgba(255,255,255,0.85); line-height:1.6; }

.card-body { padding:32px; }

.info-box {
    background:rgba(180,128,255,0.07); border:1px solid rgba(180,128,255,0.2);
    border-left:4px solid #b480ff; border-radius:12px;
    padding:14px 16px; font-size:13px; color:#6b4fa0;
    line-height:1.7; margin-bottom:20px;
}
.info-box i { color:#b480ff; margin-right:6px; }

.msg-success { background:#f0fff4; border:1px solid #68d391; color:#276749; padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:16px; display:flex; align-items:center; gap:8px; }

.actions { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; }

.btn-resend {
    flex:1; height:46px;
    background:linear-gradient(90deg, #b480ff, #d3aa95);
    border-radius:30px; border:none; cursor:pointer;
    font-size:14px; color:white; font-weight:600;
    font-family:'Segoe UI',sans-serif; transition:0.3s;
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
}
.btn-resend:hover { opacity:0.9; transform:translateY(-1px); box-shadow:0 4px 15px rgba(180,128,255,0.35); }

.btn-logout {
    padding:10px 20px; border-radius:30px;
    background:white; color:#9ca3af; font-size:13px;
    font-weight:500; border:1.5px solid #e5e7eb; cursor:pointer;
    font-family:'Segoe UI',sans-serif; transition:0.3s;
}
.btn-logout:hover { border-color:#b480ff; color:#b480ff; }

.spam-note {
    text-align:center; font-size:12px; color:#aaa; margin-top:18px; line-height:1.7;
}
.spam-note strong { color:#374151; }
</style>
</head>
<body>
<div class="card">
    <div class="card-header">
        <div class="icon"><i class="fa-regular fa-envelope"></i></div>
        <h1>Verify Your Email</h1>
        <p>Thank you for registering at <strong>Glow Institute</strong>!<br>
        Please verify your email address to activate your account.</p>
    </div>
    <div class="card-body">
        @if(session('status') == 'verification-link-sent')
            <div class="msg-success">
                <i class="fa-solid fa-circle-check"></i>
                A new verification link has been sent to your email.
            </div>
        @endif

        <div class="info-box">
            <i class="fa-solid fa-circle-info"></i>
            A verification link has been sent to your email address. Click the link to activate your account.
        </div>

        <div class="actions">
            <form method="POST" action="{{ route('verification.send') }}" style="flex:1;">
                @csrf
                <button type="submit" class="btn-resend">
                    <i class="fa-solid fa-paper-plane"></i> Resend Verification Email
                </button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>

        <p class="spam-note">
            Didn't receive the email? Check your <strong>Spam</strong> folder.<br>
            Make sure <strong>{{ Auth::user()->email ?? '' }}</strong> is correct.
        </p>
    </div>
</div>
</body>
</html>
