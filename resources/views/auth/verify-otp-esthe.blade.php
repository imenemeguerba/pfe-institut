<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Verify Email — {{ config('app.name') }}</title>
    <style>
        body { overflow: hidden; }
        .otp-container { width: 820px; height: 96vh; margin: 2vh auto; background: white; border-radius: 30px; box-shadow: 0 0 30px rgba(0,0,0,0.2); display: flex; overflow: hidden; }
        .otp-left { width: 42%; background: linear-gradient(135deg, #b480ff, #d3aa95); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px 30px; text-align: center; color: white; }
        .otp-left .otp-icon { font-size: 60px; margin-bottom: 20px; color: rgba(255,255,255,0.9); }
        .otp-left h2 { font-size: 22px; font-weight: 700; margin-bottom: 10px; background: none; -webkit-text-fill-color: white; }
        .otp-left p { font-size: 12px; color: rgba(255,255,255,0.85); line-height: 1.7; margin-bottom: 20px; }
        .otp-right { width: 58%; display: flex; flex-direction: column; justify-content: center; padding: 48px 44px; }
        .otp-right h1 { font-size: 28px; text-align: center; margin-bottom: 8px; background: linear-gradient(270deg, #b480ff, #d3aa95, #b480ff); background-size: 600% 600%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; animation: gradientText 4s ease infinite; }
        .otp-right .subtitle { font-size: 13px; color: #aaa; text-align: center; margin-bottom: 8px; }
        .email-badge { display: block; text-align: center; background: rgba(180,128,255,0.1); color: #b480ff; padding: 5px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 28px; }
        .otp-input-wrap { display: flex; justify-content: center; gap: 10px; margin: 20px 0; }
        .otp-input-wrap input { width: 52px; height: 60px; text-align: center; font-size: 24px; font-weight: 700; background: #f0f0f0; border: 2px solid transparent; border-radius: 12px; outline: none; color: #333; font-family: "Poppins", sans-serif; transition: all 0.2s; }
        .otp-input-wrap input:focus { background: #ece5ff; border-color: #b480ff; }
        .otp-timer { text-align: center; font-size: 12px; color: #aaa; margin-bottom: 20px; }
        .otp-timer i { color: #b480ff; }
        .otp-right .btn { width: 100%; height: 48px; background: linear-gradient(90deg, #b480ff, #d3aa95); border-radius: 10px; border: none; cursor: pointer; font-size: 15px; color: white; font-weight: 600; transition: 0.3s; font-family: "Poppins", sans-serif; }
        .otp-right .btn:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(180,128,255,0.4); }
        .resend-wrap { text-align: center; margin-top: 16px; }
        .resend-wrap button {
    background: transparent;
    border: 1.5px solid #b480ff;
    cursor: pointer;
    font-size: 13px;
    color: #b480ff;
    font-family: "Poppins", sans-serif;
    padding: 8px 22px;
    border-radius: 30px;
    margin-top: 10px;
    transition: 0.3s;
}
.resend-wrap button:hover {
    background: linear-gradient(to right, #b480ff, #d3aa95);
    color: white;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(180,128,255,0.4);
}
        .msg-success { background: #f0fff4; border: 1px solid #68d391; color: #276749; padding: 10px 14px; border-radius: 10px; font-size: 13px; margin-bottom: 16px; text-align: center; }
        .msg-error { background: #fff5f5; border: 1px solid #fc8181; color: #e53e3e; padding: 10px 14px; border-radius: 10px; font-size: 13px; margin-bottom: 16px; text-align: center; }
        @keyframes gradientText { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
    </style>
</head>
<body>
<div class="otp-container">
    <div class="otp-left">
        <div class="otp-icon"><i class="fa-regular fa-envelope-open"></i></div>
        <h2>Check Your Email</h2>
        <p>We sent a 6-digit verification code to confirm your registration at Glow Institute.</p>
        <p>Your application will be reviewed by our team after verification.</p>
    </div>
    <div class="otp-right">
        <h1>Verify Your Email</h1>
        <p class="subtitle">Code sent to</p>
        <span class="email-badge">{{ session('register_esthe_data.email') }}</span>

        @if(session('success'))
            <div class="msg-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="msg-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register.esthe.verify.otp.submit') }}" id="otpForm">
            @csrf
            <input type="hidden" name="otp" id="otpHidden">
            <div class="otp-input-wrap">
                <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" autofocus>
                <input type="text" class="otp-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-digit" maxlength="1" inputmode="numeric">
            </div>
            <div class="otp-timer"><i class="fa-regular fa-clock"></i> This code expires in 10 minutes</div>
            <button type="submit" class="btn">Confirm My Email</button>
        </form>

        <div class="resend-wrap">
            <form method="POST" action="{{ route('register.esthe.resend.otp') }}">
                @csrf
                <button type="submit">Resend Code</button>
            </form>
        </div>
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
});
function updateHidden() {
    document.getElementById('otpHidden').value = [...digits].map(d => d.value).join('');
}
document.getElementById('otpForm').addEventListener('submit', e => {
    updateHidden();
    if (document.getElementById('otpHidden').value.length !== 6) {
        e.preventDefault();
    }
});
</script>
</body>
</html>
