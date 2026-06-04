<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enter Verification Code — {{ config('app.name') }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Segoe UI',Arial,sans-serif; background:#f3eeff; display:flex; align-items:center; justify-content:center; min-height:100vh; overflow:hidden; }

.otp-container {
    width:820px; height:96vh; max-height:560px;
    background:white; border-radius:30px;
    box-shadow:0 0 40px rgba(180,128,255,0.2);
    display:flex; overflow:hidden;
}
.otp-left {
    width:42%;
    background:linear-gradient(135deg, #b480ff, #d3aa95);
    display:flex; flex-direction:column;
    justify-content:center; align-items:center;
    padding:40px 30px; text-align:center; color:white;
}
.otp-left .otp-icon { font-size:56px; margin-bottom:20px; }
.otp-left h2 { font-size:22px; font-weight:700; margin-bottom:10px; }
.otp-left p { font-size:12px; color:rgba(255,255,255,0.85); line-height:1.7; margin-bottom:24px; }
.otp-steps { width:100%; }
.otp-step {
    display:flex; align-items:center; gap:12px;
    border-radius:12px; padding:10px 14px; margin-bottom:8px;
    font-size:12px; text-align:left;
}
.otp-step.done  { background:rgba(255,255,255,0.25); color:white; }
.otp-step.active { background:rgba(255,255,255,0.12); color:rgba(255,255,255,0.9); }
.otp-step.todo  { background:rgba(255,255,255,0.07); color:rgba(255,255,255,0.6); }
.step-num {
    width:26px; height:26px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:700; flex-shrink:0;
}
.otp-step.done  .step-num { background:rgba(255,255,255,0.9); color:#b480ff; }
.otp-step.active .step-num { background:rgba(255,255,255,0.3); color:white; }
.otp-step.todo  .step-num { background:rgba(255,255,255,0.15); color:rgba(255,255,255,0.6); }

.otp-right {
    width:58%; display:flex; flex-direction:column;
    justify-content:center; padding:48px 44px;
}
.otp-right h1 {
    font-size:28px; text-align:center; margin-bottom:8px;
    background:linear-gradient(270deg, #b480ff, #d3aa95, #b480ff);
    background-size:600% 600%;
    -webkit-background-clip:text; -webkit-text-fill-color:transparent;
    animation:gradientText 4s ease infinite;
}
.subtitle { font-size:13px; color:#aaa; text-align:center; margin-bottom:6px; }
.email-badge {
    display:block; text-align:center;
    background:rgba(180,128,255,0.1); color:#b480ff;
    padding:5px 14px; border-radius:20px;
    font-size:13px; font-weight:600; margin-bottom:24px;
}
.otp-input-wrap { display:flex; justify-content:center; gap:10px; margin:16px 0; }
.otp-input-wrap input {
    width:52px; height:60px; text-align:center;
    font-size:24px; font-weight:700;
    background:#f0f0f0; border:2px solid transparent;
    border-radius:12px; outline:none; color:#333;
    font-family:'Segoe UI',sans-serif; transition:all 0.2s;
}
.otp-input-wrap input:focus { background:#ece5ff; border-color:#b480ff; }
.otp-timer { text-align:center; font-size:12px; color:#aaa; margin-bottom:16px; }
.otp-timer i { color:#b480ff; }
.btn {
    width:100%; height:48px;
    background:linear-gradient(90deg, #b480ff, #d3aa95);
    border-radius:10px; border:none; cursor:pointer;
    font-size:15px; color:white; font-weight:600;
    font-family:'Segoe UI',sans-serif; transition:0.3s;
}
.btn:hover { opacity:0.9; transform:translateY(-2px); box-shadow:0 4px 15px rgba(180,128,255,0.4); }
.resend-wrap { text-align:center; margin-top:14px; }
.resend-btn {
    background:transparent; border:1.5px solid #b480ff;
    cursor:pointer; font-size:13px; color:#b480ff;
    font-family:'Segoe UI',sans-serif;
    padding:7px 20px; border-radius:30px; transition:0.3s;
}
.resend-btn:hover { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; }
.back-link { display:block; text-align:center; margin-top:12px; font-size:13px; color:#b480ff; text-decoration:none; }
.back-link:hover { color:#d3aa95; }
.msg-success { background:#f0fff4; border:1px solid #68d391; color:#276749; padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:14px; text-align:center; }
.msg-error   { background:#fff5f5; border:1px solid #fc8181; color:#e53e3e; padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:14px; text-align:center; }
@keyframes gradientText {
    0%   { background-position:0% 50%; }
    50%  { background-position:100% 50%; }
    100% { background-position:0% 50%; }
}
</style>
</head>
<body>
<div class="otp-container">
    <div class="otp-left">
        <div class="otp-icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h2>Password Recovery</h2>
        <p>Enter the 6-digit code we sent to your email.</p>
        <div class="otp-steps">
            <div class="otp-step done">
                <div class="step-num"><i class="fa-solid fa-check" style="font-size:11px;"></i></div>
                <span>Email address entered</span>
            </div>
            <div class="otp-step active">
                <div class="step-num">2</div>
                <span>Enter verification code</span>
            </div>
            <div class="otp-step todo">
                <div class="step-num">3</div>
                <span>Set new password</span>
            </div>
        </div>
    </div>
    <div class="otp-right">
        <h1>Enter Your Code</h1>
        <p class="subtitle">Code sent to</p>
        <span class="email-badge">{{ session('otp_email') ?? session('email') ?? '' }}</span>

        @if(session('success'))
            <div class="msg-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="msg-error"><i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.otp.verify.post') }}" id="otpForm">
            @csrf
            <input type="hidden" name="otp" id="otpHidden">
            <div class="otp-input-wrap">
                @for($i = 0; $i < 6; $i++)
                    <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" {{ $i === 0 ? 'autofocus' : '' }}>
                @endfor
            </div>
            <div class="otp-timer"><i class="fa-regular fa-clock"></i> This code expires in <strong>15 minutes</strong></div>
            <button type="submit" class="btn"><i class="fa-solid fa-arrow-right"></i> Verify Code</button>
        </form>

        <div class="resend-wrap">
            <form method="POST" action="{{ route('password.otp.send') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('otp_email') ?? '' }}">
                <button type="submit" class="resend-btn"><i class="fa-solid fa-rotate-right"></i> Resend Code</button>
            </form>
        </div>
        <a href="{{ route('password.otp.email') }}" class="back-link">← Change email</a>
    </div>
</div>

<script>
const digits = document.querySelectorAll('.otp-digit');
digits.forEach((input, i) => {
    input.addEventListener('input', () => {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value && i < digits.length - 1) digits[i+1].focus();
        updateHidden();
    });
    input.addEventListener('keydown', e => {
        if (e.key === 'Backspace' && !input.value && i > 0) digits[i-1].focus();
    });
    input.addEventListener('paste', e => {
        e.preventDefault();
        const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
        [...paste].forEach((char, j) => { if (digits[i+j]) digits[i+j].value = char; });
        updateHidden();
        if (digits[Math.min(i+paste.length, digits.length-1)]) digits[Math.min(i+paste.length, digits.length-1)].focus();
    });
});
function updateHidden() {
    document.getElementById('otpHidden').value = [...digits].map(d => d.value).join('');
}
document.getElementById('otpForm').addEventListener('submit', e => {
    updateHidden();
    if (document.getElementById('otpHidden').value.length !== 6) e.preventDefault();
});
</script>
</body>
</html>
