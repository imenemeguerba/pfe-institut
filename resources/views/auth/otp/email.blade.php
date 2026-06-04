<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Forgot Password — {{ config('app.name') }}</title>
    <style>
        body { overflow: hidden; }
        .otp-container {
            width: 820px; height: 96vh; margin: 2vh auto;
            background: white; border-radius: 30px;
            box-shadow: 0 0 30px rgba(0,0,0,0.2);
            display: flex; overflow: hidden;
        }
        .otp-left {
            width: 42%;
            background: linear-gradient(135deg, #b480ff, #d3aa95);
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 40px 30px; text-align: center; color: white;
        }
        .otp-left .otp-icon { font-size: 60px; margin-bottom: 20px; color: rgba(255,255,255,0.9); }
        .otp-left h2 { font-size: 22px; font-weight: 700; margin-bottom: 10px; background: none; -webkit-text-fill-color: white; }
        .otp-left p { font-size: 12px; color: rgba(255,255,255,0.85); line-height: 1.7; margin-bottom: 28px; }
        .otp-steps { width: 100%; }
        .otp-step {
            display: flex; align-items: center; gap: 12px;
            background: rgba(255,255,255,0.12); border-radius: 12px;
            padding: 12px 16px; margin-bottom: 10px; text-align: left;
        }
        .otp-step-num {
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; flex-shrink: 0;
        }
        .otp-step span { font-size: 12px; color: rgba(255,255,255,0.9); }
        .otp-right {
            width: 58%; display: flex; flex-direction: column;
            justify-content: center; padding: 48px 44px;
        }
        .otp-right h1 {
            font-size: 28px; text-align: center; margin-bottom: 8px;
            background: linear-gradient(270deg, #b480ff, #d3aa95, #b480ff);
            background-size: 600% 600%;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradientText 4s ease infinite;
        }
        .otp-right .subtitle { font-size: 13px; color: #aaa; text-align: center; margin-bottom: 32px; }
        .otp-right .input-box { position: relative; margin: 16px 0; }
        .otp-right .input-box input {
            width: 100%; padding: 14px 48px 14px 18px;
            background: #f0f0f0; border-radius: 10px; border: none; outline: none;
            font-size: 14px; color: #333; font-weight: 500;
            font-family: "Poppins", sans-serif; transition: background 0.3s;
        }
        .otp-right .input-box input:focus { background: #ece5ff; }
        .otp-right .input-box input::placeholder { color: #aaa; font-weight: 400; }
        .otp-right .input-box i { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: 18px; color: #b480ff; }
        .otp-right .btn {
            width: 100%; height: 48px;
            background: linear-gradient(90deg, #b480ff, #d3aa95);
            border-radius: 10px; border: none; cursor: pointer;
            font-size: 15px; color: white; font-weight: 600;
            margin-top: 8px; transition: 0.3s; font-family: "Poppins", sans-serif;
        }
        .otp-right .btn:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(180,128,255,0.4); }
        .otp-right .back-link { display: block; text-align: center; margin-top: 20px; font-size: 13px; color: #b480ff; text-decoration: none; transition: color 0.3s; }
        .otp-right .back-link:hover { color: #d3aa95; }
        .msg-success { background: #f0fff4; border: 1px solid #68d391; color: #276749; padding: 10px 14px; border-radius: 10px; font-size: 13px; margin-bottom: 16px; text-align: center; }
        .msg-error { background: #fff5f5; border: 1px solid #fc8181; color: #e53e3e; padding: 10px 14px; border-radius: 10px; font-size: 13px; margin-bottom: 16px; text-align: center; }
        @keyframes gradientText { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
    </style>
</head>
<body>
<div class="otp-container">

    <div class="otp-left">
        <div class="otp-icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h2>Password Recovery</h2>
        <p>Secure your account in 3 simple steps</p>
        <div class="otp-steps">
            <div class="otp-step"><div class="otp-step-num">1</div><span>Enter your email address</span></div>
            <div class="otp-step"><div class="otp-step-num">2</div><span>Receive a 6-digit verification code</span></div>
            <div class="otp-step"><div class="otp-step-num">3</div><span>Set your new password</span></div>
        </div>
    </div>

    <div class="otp-right">
        <h1>Forgot Password?</h1>
        <p class="subtitle">Enter your email and we'll send you a verification code</p>

        @if(session('success'))
            <div class="msg-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="msg-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.otp.send') }}">
            @csrf
            <div class="input-box">
                <input type="email" name="email" placeholder="Your email address"
                       value="{{ old('email') }}" required autofocus>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <button type="submit" class="btn">Send Verification Code</button>
        </form>

        <div style="text-align:center;">
    <a href="{{ route('login') }}" class="back-home">← Back to Sign In</a>
</div>
    </div>

</div>
</body>
</html>
