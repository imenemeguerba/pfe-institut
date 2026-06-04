<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Sign In — {{ config('app.name') }}</title>
</head>
<body>
<div class="container" id="container">

    {{-- ── SIGN IN FORM ── --}}
    <div class="form-box login">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Sign In</h1>

            @if(session('success'))
                <p class="msg-success">{{ session('success') }}</p>
            @endif
            @if($errors->any())
                <p class="msg-error">{{ $errors->first() }}</p>
            @endif

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <div class="forgot-link">
                <a href="{{ route('password.otp.email') }}">Forgot Password?</a>
            </div>

            <button type="submit" class="btn">Sign In</button>
            <a href="{{ route('landingpage') }}" class="back-home">← Back to Home</a>
            <p class="join-esthe">Are you a beauty expert? <a href="{{ route('register.estheticienne') }}">Join as Esthetician</a></p>
        </form>
    </div>

    {{-- ── SIGN UP FORM ── --}}
    <div class="form-box register">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Sign Up</h1>

            @if($errors->any())
                <p class="msg-error">{{ $errors->first() }}</p>
            @endif

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

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input-row">
                <div class="input-box">
                    <input type="text" name="telephone" placeholder="Phone" value="{{ old('telephone') }}" required>
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="input-box">
                    <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required>
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>

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

            <div class="law-check">
                <input type="checkbox" id="loi1807r" name="loi1807" required>
                <label for="loi1807r">
                    I agree that my personal data will be processed in accordance with
                    <a href="#">Law n°18-07 of June 10, 2018</a>
                    relating to the protection of individuals with regard to the processing of personal data.
                </label>
            </div>

            <button type="submit" class="btn">Sign Up</button>
            <a href="{{ route('landingpage') }}" class="back-home">← Back to Home</a>
        </form>
    </div>

    {{-- ── TOGGLE BOX ── --}}
    <div class="toggle-box">
        <div class="toggle-panel toggle-left">
            <h1>Hello, Welcome!</h1>
            <p>Don't have an account yet?</p>
            <button class="btn register-btn">Sign Up</button>
        </div>
        <div class="toggle-panel toggle-right">
            <h1>Welcome Back!</h1>
            <p>Already have an account?</p>
            <button class="btn login-btn">Sign In</button>
        </div>
    </div>

</div>

<script>
const container   = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn    = document.querySelector('.login-btn');
registerBtn.addEventListener('click', () => container.classList.add('active'));
loginBtn.addEventListener('click',    () => container.classList.remove('active'));
</script>
</body>
</html>
