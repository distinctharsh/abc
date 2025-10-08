<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



    @stack('styles')
</head>
<body class="font-sans antialiased">
   
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <i class="fas fa-tooth me-2"></i>Orodental
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle fade-in-up" href="#about" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="animation-delay: 0.3s;">
                                About Us
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown" style="display: none; position: absolute; top: 100%; left: 0; z-index: 9999; min-width: 200px; background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(20px); border-radius: 15px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); border: none; padding: 0.5rem; margin-top: 10px; transform: none !important;">
                                <li><a class="dropdown-item" href="{{ route('gallery') }}"><i class="fas fa-images me-2"></i>Gallery</a></li>
                                <li><a class="dropdown-item" href="{{ route('press') }}"><i class="fas fa-newspaper me-2"></i>Press & Media</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">
                                <i class="fas fa-teeth me-1"></i> Orodental
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">
                                <i class="fas fa-envelope me-1"></i> Dr. Sarkar Social
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="#appointment" class="btn btn-primary">
                            <i class="fas fa-calendar-check me-1"></i> Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Include your footer here if needed -->
        
    </div>

    @stack('scripts')
</body>
</html>
