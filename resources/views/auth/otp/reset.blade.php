<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Password — {{ config('app.name') }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Segoe UI',Arial,sans-serif; background:#f3eeff; display:flex; align-items:center; justify-content:center; min-height:100vh; overflow:hidden; }
.otp-container { width:820px; height:96vh; max-height:540px; background:white; border-radius:30px; box-shadow:0 0 40px rgba(180,128,255,0.2); display:flex; overflow:hidden; }
.otp-left { width:42%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; flex-direction:column; justify-content:center; align-items:center; padding:40px 30px; text-align:center; color:white; }
.otp-left .otp-icon { font-size:56px; margin-bottom:20px; }
.otp-left h2 { font-size:22px; font-weight:700; margin-bottom:10px; }
.otp-left p  { font-size:12px; color:rgba(255,255,255,0.85); line-height:1.7; margin-bottom:24px; }
.otp-steps { width:100%; }
.otp-step { display:flex; align-items:center; gap:12px; border-radius:12px; padding:10px 14px; margin-bottom:8px; font-size:12px; text-align:left; }
.otp-step.done   { background:rgba(255,255,255,0.25); color:white; }
.otp-step.active { background:rgba(255,255,255,0.12); color:rgba(255,255,255,0.9); }
.step-num { width:26px; height:26px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; flex-shrink:0; }
.otp-step.done .step-num   { background:rgba(255,255,255,0.9); color:#b480ff; }
.otp-step.active .step-num { background:rgba(255,255,255,0.3); color:white; }
.otp-right { width:58%; display:flex; flex-direction:column; justify-content:center; padding:48px 44px; }
.otp-right h1 { font-size:28px; text-align:center; margin-bottom:8px; background:linear-gradient(270deg,#b480ff,#d3aa95,#b480ff); background-size:600% 600%; -webkit-background-clip:text; -webkit-text-fill-color:transparent; animation:gradientText 4s ease infinite; }
.subtitle { font-size:13px; color:#aaa; text-align:center; margin-bottom:28px; }
.input-box { position:relative; margin-bottom:16px; }
.input-box input { width:100%; padding:14px 48px 14px 18px; background:#f0f0f0; border-radius:10px; border:none; outline:none; font-size:14px; color:#333; font-weight:500; font-family:'Segoe UI',sans-serif; transition:background 0.3s; }
.input-box input:focus { background:#ece5ff; }
.input-box i { position:absolute; right:16px; top:50%; transform:translateY(-50%); font-size:18px; color:#b480ff; }
.msg-success { background:#f0fff4; border:1px solid #68d391; color:#276749; padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:16px; text-align:center; }
.msg-error   { background:#fff5f5; border:1px solid #fc8181; color:#e53e3e; padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:16px; text-align:center; }
.btn { width:100%; height:48px; background:linear-gradient(90deg,#b480ff,#d3aa95); border-radius:10px; border:none; cursor:pointer; font-size:15px; color:white; font-weight:600; font-family:'Segoe UI',sans-serif; transition:0.3s; }
.btn:hover { opacity:0.9; transform:translateY(-2px); box-shadow:0 4px 15px rgba(180,128,255,0.4); }
.back-link { display:block; text-align:center; margin-top:16px; font-size:13px; color:#b480ff; text-decoration:none; }
.back-link:hover { color:#d3aa95; }
@keyframes gradientText { 0%{background-position:0% 50%;}50%{background-position:100% 50%;}100%{background-position:0% 50%;} }
</style>
</head>
<body>
<div class="otp-container">
    <div class="otp-left">
        <div class="otp-icon"><i class="fa-solid fa-key"></i></div>
        <h2>Last Step!</h2>
        <p>Choose a strong new password to secure your account.</p>
        <div class="otp-steps">
            <div class="otp-step done">
                <div class="step-num"><i class="fa-solid fa-check" style="font-size:11px;"></i></div>
                <span>Email address entered</span>
            </div>
            <div class="otp-step done">
                <div class="step-num"><i class="fa-solid fa-check" style="font-size:11px;"></i></div>
                <span>Code verified</span>
            </div>
            <div class="otp-step active">
                <div class="step-num">3</div>
                <span>Set new password</span>
            </div>
        </div>
    </div>
    <div class="otp-right">
        <h1>New Password</h1>
        <p class="subtitle">Enter and confirm your new password</p>

        @if(session('success'))
            <div class="msg-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="msg-error"><i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.otp.update') }}">
            @csrf
            {{-- ✅ FIX: email manquait → "The email field is required" --}}
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="input-box">
                <input type="password" name="password" placeholder="New password" required autofocus>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <button type="submit" class="btn">
                <i class="fa-solid fa-key"></i> Save New Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">← Back to Sign In</a>
    </div>
</div>
</body>
</html>
