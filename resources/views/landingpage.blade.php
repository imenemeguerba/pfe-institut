<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Landing Page</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
    <div class="logo">
        <!-- Logo de l'institut -->
        <!-- hedi bech ki n3abez 3la logo wela le nom te3 l institut yedini l home page li hiya landind page-->
        <a href="{{ route('landingpage') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
        </a>
        <a href="{{ route('landingpage') }}">
            <h2>Institut Name</h2>
        </a>
    </div>
    <!-- Liens principaux -->
    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
    <!-- Section à droite : Sign In / Sign Up ou icônes utilisateur -->
    <div class="right-section">

        {{-- Vérifie si l'utilisateur est connecté --}}
        @if(Auth::check())
            <!-- Si connecté : afficher les icônes favoris, notifications, panier -->
            <i class="fa-regular fa-heart" title="Favorites"></i>
            <i class="fa-regular fa-bell" title="Notifications"></i>
            <i class="fa-solid fa-cart-shopping" title="Cart"></i>

            <!-- Bouton Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>

        @else
            <!-- Si non connecté : afficher Sign In / Sign Up -->
            <!-- Landingpage buttons -->
            <a href="{{ route('signin') }}?action=signin"><button class="signin">Sign In</button></a>
            <a href="{{ route('signup') }}?action=signup"><button class="signup">Sign Up</button></a>
        @endif

    </div>
</nav>
    <section class="hero">
        <div class="hero-text">
            <h1>
                Discover Your <br>
                <span class="animated-gradient">Perfect Beauty</span><br>
                Experience
            </h1>
            <p> Experience world-class beauty treatments managed with precision.
                Book appointments and shop premium products online.
            </p>
            <div class="hero-buttons">
                <a href="#" class="btn primary">Book Now </a>
                <a href="#" class="btn secondary"> Shop Products </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="images/image1.png" alt="Beauty Salon">
        </div>
    </section>

</body>
</html>
