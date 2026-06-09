<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Join as Expert — {{ config('app.name') }}</title>
    <style>
        body { overflow: hidden; }

        .esthe-container {
            position: relative;
            width: 880px;
            height: 96vh;
            background: #fff;
            margin: 2vh auto;
            border-radius: 30px;
            box-shadow: 0 0 30px rgba(0,0,0,0.2);
            display: flex;
            overflow: hidden;
        }

        /* ── LEFT PANEL ── */
        .esthe-left {
            width: 38%;
            background: linear-gradient(135deg, #b480ff, #d3aa95);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 36px 28px;
            text-align: center;
            color: white;
            flex-shrink: 0;
        }
        .esthe-left .icon { font-size: 52px; margin-bottom: 16px; }
        .esthe-left h2 {
            font-size: 22px; font-weight: 700; margin-bottom: 10px;
            background: none; -webkit-text-fill-color: white;
        }
        .esthe-left p {
            font-size: 12px; color: rgba(255,255,255,0.88);
            line-height: 1.7; margin-bottom: 20px;
        }
        .esthe-left .left-link {
            display: inline-block; padding: 8px 20px;
            border: 2px solid white; border-radius: 25px;
            color: white; font-size: 12px; font-weight: 600;
            text-decoration: none; transition: 0.3s; margin: 4px 0;
        }
        .esthe-left .left-link:hover { background: white; color: #b480ff; }

        /* ── RIGHT PANEL ── */
        .esthe-right {
            width: 62%;
            padding: 28px 36px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .esthe-right::-webkit-scrollbar { width: 3px; }
        .esthe-right::-webkit-scrollbar-thumb {
            background: linear-gradient(#b480ff, #d3aa95);
            border-radius: 4px;
        }
        .esthe-right h1 {
            font-size: 28px; text-align: center; margin-bottom: 4px;
            background: linear-gradient(270deg, #b480ff, #d3aa95, #b480ff);
            background-size: 600% 600%;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradientText 4s ease infinite;
        }
        .esthe-right .subtitle {
            font-size: 12px; color: #aaa; text-align: center; margin-bottom: 18px;
        }
        .esthe-right .input-box {
            position: relative; margin: 10px 0;
        }
        .esthe-right .input-box input,
        .esthe-right .input-box textarea {
            width: 100%; padding: 10px 42px 10px 16px;
            background: #f0f0f0; border-radius: 8px; border: none; outline: none;
            font-size: 13px; color: #333; font-weight: 500;
            font-family: "Poppins", sans-serif;
        }
        .esthe-right .input-box textarea {
            padding: 10px 16px; height: 60px; resize: none;
        }
        .esthe-right .input-box input::placeholder,
        .esthe-right .input-box textarea::placeholder { color: #aaa; font-weight: 400; }
        .esthe-right .input-box i {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); font-size: 16px; color: #333;
        }

        /* 2 colonnes pour nom/prénom et password */
        .input-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 10px;
        }

        /* ── CHECKBOX LOI ── */
        .law-check {
            display: flex; align-items: flex-start; gap: 10px;
            background: #f8f4ff; border-radius: 10px; padding: 12px 14px;
            margin: 12px 0;
            border: 1px solid rgba(180,128,255,0.2);
        }
        .law-check input[type="checkbox"] {
            width: 16px; height: 16px; margin-top: 2px;
            accent-color: #b480ff; flex-shrink: 0; cursor: pointer;
        }
        .law-check label {
            font-size: 11px; color: #666; line-height: 1.6; cursor: pointer;
        }
        .law-check label a { color: #b480ff; text-decoration: none; font-weight: 600; }
        .law-check label a:hover { color: #d3aa95; }

        /* ── SUBMIT BTN ── */
        .esthe-right .btn {
            width: 100%; height: 44px;
            background: linear-gradient(90deg, #b480ff, #d3aa95);
            border-radius: 8px; border: none; cursor: pointer;
            font-size: 14px; color: #fff; font-weight: 600;
            transition: 0.3s; font-family: "Poppins", sans-serif;
        }
        .esthe-right .btn:hover {
            opacity: 0.9; transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(180,128,255,0.4);
        }

        /* ── ERROR ── */
        .error-box {
            background: #fff5f5; border: 1px solid #fc8181;
            padding: 8px 12px; border-radius: 8px;
            font-size: 12px; color: #e53e3e; margin-bottom: 10px;
        }

        @keyframes gradientText {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .esthe-left .icon i { font-size: 52px; color: rgba(255,255,255,0.9); }
    </style>
</head>
<body>

<div class="esthe-container">

    {{-- ── LEFT ── --}}
    <div class="esthe-left">
        <div class="icon"><i class="fa-solid fa-spa"></i></div>
        <h2>Join Our Expert Team</h2>
        <p>
            Submit your application and you'll receive an email once your account is validated by our team.
        </p>
        <a href="{{ route('login') }}" class="left-link">Already have an account?</a>
        <a href="{{ route('landingpage') }}" class="left-link">← Back to Home</a>
    </div>

    {{-- ── RIGHT ── --}}
    <div class="esthe-right">
        <h1>Expert Registration</h1>
        <p class="subtitle">Fill in your professional information below</p>

        @if($errors->any())
            <div class="error-box">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register.estheticienne') }}" novalidate>
            @csrf

            {{-- Nom + Prénom --}}
            <div class="input-row">
                <div class="input-box">
                    <input type="text" name="nom" placeholder="Last Name" value="{{ old('nom') }}" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" name="prenom" placeholder="First Name" value="{{ old('prenom') }}" required>
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            {{-- Email --}}
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            {{-- Téléphone + Expérience --}}
            <div class="input-row">
                <div class="input-box">
                    <input type="tel" name="telephone" placeholder="Phone" value="{{ old('telephone') }}" required>
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="input-box">
                    <input type="number" name="experience" placeholder="Years of experience" value="{{ old('experience') }}" min="0" max="60" required>
                    <i class="fa-solid fa-briefcase"></i>
                </div>
            </div>

            {{-- Spécialités --}}
            <div class="input-box">
                <textarea name="specialites" placeholder="Your specialties (e.g. facial care, makeup, massage...)" required minlength="10" maxlength="1000">{{ old('specialites') }}</textarea>
            </div>

            {{-- Password + Confirm --}}
            <div class="input-row">
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>

            {{-- Loi 18-07 --}}
            <div class="law-check">
                <input type="checkbox" id="loi1807" name="loi1807" required>
                <label for="loi1807">
                    I agree that my personal data will be processed in accordance with
                    <a href="#" title="Loi n°18-07 du 10 juin 2018">Law n°18-07 of June 10, 2018</a>
                    relating to the protection of individuals with regard to the processing of personal data.
                </label>
            </div>

            <button type="submit" class="btn">Submit My Application</button>
        </form>
    </div>

</div>

</body>
</html>
