<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Login/Signup Form</title>
</head>
<body>
    <div class="container">
        <!-- signin form -->
        <div class="form-box login">
            <form action="#">
                <h1>Sign In</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Sign In</button>
                <a href="{{ route('landingpage') }}" class="back-home">← Back to Home</a>
            </form>
        </div>

        <!--signup form-->
        <div class="form-box register">
            <form action="#">
                <h1>Sign Up</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="date" id="dob" name="dob" required>
                    <i class="fa-solid fa-calendar"></i> <!-- just for icon, does NOT open calendar -->
               </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <button type="submit" class="btn">Sign Up</button>
                <a href="{{ route('landingpage') }}" class="back-home">← Back to Home</a>
            </form>
        </div>

        <!-- toggle box  -->
        <div class="toggle-box">
            <!-- toggle box left -->
            <div class="toggle-panel toggle-left">
                <h1>Hello,  Welcome!</h1>
                <p>Don't have an account yet?</p>
                <button class="btn register-btn">Sign Up</button>
            </div>

            <!-- toggle box right -->
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p> Already have an account ?</p>
                <button class="btn login-btn">Sign In</button>
            </div>
        </div>
    </div>
@vite('resources/js/app.js')
</body>
</html>
