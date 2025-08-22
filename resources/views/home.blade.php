<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Sarkar Family</title>
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-papm6Q+..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        /* Video Background Styles */
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            min-width: 100%;
            min-height: 100%;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg, 
                rgba(0, 0, 0, 0.6) 0%, 
                rgba(0, 0, 0, 0.4) 50%, 
                rgba(0, 0, 0, 0.7) 100%
            );
            z-index: 1;
        }

        .services-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .services-section .container {
            position: relative;
            z-index: 2;
        }

        /* Enhanced text readability over video */
        .services-section .text-white {
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.8);
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Responsive video adjustments */
        @media (max-width: 768px) {
            .background-video {
                object-position: center center;
            }
            
            .services-section .text-white {
                font-size: 2.5rem !important;
                text-align: center;
                padding: 0 20px;
            }
        }

        @media (max-width: 480px) {
            .services-section .text-white {
                font-size: 2rem !important;
            }
        }

        /* Video loading fallback */
        .video-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            z-index: -1;
        }

        /* Smooth video transitions */
        .background-video {
            transition: opacity 0.5s ease-in-out;
        }

        .background-video.loaded {
            opacity: 1;
        }

        .background-video:not(.loaded) {
            opacity: 0;
        }

        /* News Ticker Styles */
        .news-ticker-container {
            background: linear-gradient(90deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            border-top: 2px solid rgba(0, 212, 255, 0.3);
            border-bottom: 2px solid rgba(0, 212, 255, 0.3);
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        .news-ticker {
            display: flex;
            align-items: center;
            padding: 27px 0;
            background: linear-gradient(90deg, rgba(0, 212, 255, 0.1), rgba(78, 205, 196, 0.1));
            backdrop-filter: blur(10px);
        }

        .ticker-icon {
            background: linear-gradient(45deg, #00d4ff, #4ecdc4);
            color: #000;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            margin-left: 20px;
            flex-shrink: 0;
            animation: pulse-glow 2s ease-in-out infinite;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
        }

        @keyframes pulse-glow {
            0%, 100% { 
                transform: scale(1); 
                box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            }
            50% { 
                transform: scale(1.1); 
                box-shadow: 0 0 30px rgba(0, 212, 255, 0.8);
            }
        }

        .ticker-content {
            flex: 1;
            overflow: hidden;
            position: relative;
        }

        .ticker-text {
            display: flex;
            align-items: center;
            white-space: nowrap;
            animation: ticker-scroll 60s linear infinite;
            gap: 30px;
        }

        @keyframes ticker-scroll {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        .ticker-item {
            color: #ffffff;
            font-weight: 500;
            font-size: 1.2rem;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .ticker-item:hover {
            background: rgba(0, 212, 255, 0.2);
            border-color: rgba(0, 212, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 212, 255, 0.3);
        }

        .ticker-separator {
            color: #00d4ff;
            font-size: 1.2rem;
            font-weight: bold;
            animation: separator-pulse 1.5s ease-in-out infinite;
        }

        @keyframes separator-pulse {
            0%, 100% { opacity: 0.7; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        /* Pause animation on hover */
        .news-ticker-container:hover .ticker-text {
            animation-play-state: paused;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .ticker-icon {
                width: 35px;
                height: 35px;
                margin-right: 15px;
                margin-left: 15px;
            }
            
            .ticker-item {
                font-size: 0.85rem;
                padding: 6px 12px;
            }
            
            .ticker-text {
                animation-duration: 45s;
                gap: 20px;
            }
        }

        @media (max-width: 480px) {
            .ticker-icon {
                width: 30px;
                height: 30px;
                margin-right: 10px;
                margin-left: 10px;
            }
            
            .ticker-item {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
            
            .ticker-text {
                animation-duration: 35s;
                gap: 15px;
            }
        }

        /* Enhanced visibility */
        .news-ticker-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(0, 212, 255, 0.05) 20%, 
                rgba(0, 212, 255, 0.05) 80%, 
                transparent 100%
            );
            pointer-events: none;
        }

        /* Clickable Service Cards */
        .clickable-service-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .clickable-service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .clickable-service-card:active {
            transform: translateY(-2px);
        }

      /* ===== MODAL OVERLAY (full-screen) ===== */
        /* Remove fullscreen background */
        .service-popup-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.55); /* sirf halka dark overlay */
            backdrop-filter: blur(4px);
        }

        /* Card itself */
        .service-popup-content {
            /* width: min(600px, 92vw); */
            width: min(300px, 32vw);
            width: min(500px, 52vw);
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08); /* transparent glass */
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 12px 40px rgba(0,0,0,.5);
            backdrop-filter: blur(16px) saturate(140%);
            -webkit-backdrop-filter: blur(16px) saturate(140%);
            color: #fff;
            padding: 24px;
            position: relative;
            overflow: hidden;
            /* background: linear-gradient(135deg, #00e0ff, #6b46c1); turquoise → purple */
        }


        /* Gradient Border Line */
.service-popup-content::before {
  content: "";
  position: absolute;
  inset: 0;                /* cover whole box */
  border-radius: inherit;
  padding: 2px;            /* border thickness */
  background: linear-gradient(135deg, #00e0ff, #6b46c1); /* turquoise → purple */
  
  -webkit-mask: 
    linear-gradient(#fff 0 0) content-box, 
    linear-gradient(#fff 0 0);
  -webkit-mask-composite: xor;
          mask-composite: exclude;
  pointer-events: none;
}

        /* Close button */
        .service-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.2);
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .service-popup-close:hover {
            background: rgba(255,255,255,0.35);
            transform: scale(1.05);
        }

        /* Title + subtitle */
        .service-popup-title {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .service-popup-subtitle {
            margin: 6px 0 18px 0;
            font-size: 1rem;
            color: rgba(255,255,255,0.7);
        }

        /* Image in hexagon */
        .service-popup-image img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            clip-path: polygon(25% 6.7%, 75% 6.7%, 100% 50%, 75% 93.3%, 25% 93.3%, 0% 50%);
            border: 2px solid rgba(255,255,255,0.3);
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            margin: 20px auto;
            display: block;
        }

        /* Buttons */
        .service-popup-actions {
            text-align: center;
            margin-top: 20px;
        }
        .service-popup-btn {
            padding: 10px 22px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        .service-popup-btn.primary {
            background: linear-gradient(45deg, #00e0ff, #37d7c7);
            color: #000;
        }
        .service-popup-btn.secondary {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        .service-popup-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <!-- Enhanced Responsive Navbar with 3D effects -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom">
        <div class="container">
            <!-- Brand/Logo -->
            <a class="navbar-brand fade-in-up" href="#" style="animation-delay: 0.1s;">
                <i class="fas fa-hospital-alt me-2"></i>Orodental
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fade-in-up" href="#" style="animation-delay: 0.2s;">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fade-in-up" href="#about" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="animation-delay: 0.3s;">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown" style="display: none; position: absolute; top: 100%; left: 0; z-index: 9999; min-width: 200px; background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(20px); border-radius: 15px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); border: none; padding: 0.5rem; margin-top: 10px; transform: none !important;">
                            <li><a class="dropdown-item" href="#gallery"><i class="fas fa-images me-2"></i>Gallery</a></li>
                            <li><a class="dropdown-item" href="{{ route('press') }}"><i class="fas fa-newspaper me-2"></i>Press & Media</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fade-in-up" href="#" style="animation-delay: 0.4s;">Orodental</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fade-in-up" href="#" style="animation-delay: 0.5s;">Dr. Sarkar Social</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fade-in-up" href="{{ route('admin.abouts.index') }}" style="animation-delay: 0.6s;">
                                <i class="fas fa-cog"></i> Admin
                            </a>
                        </li>
                    @endauth
                </ul>
                
                <!-- Enhanced Contact Button -->
                <button type="button" class="btn hero-btn fade-in-up" data-bs-toggle="modal" style="animation-delay: 0.7s;" data-bs-target="#drSarkarModal">
                    <i class="fas fa-phone me-2"></i>Contact
                </button>
            </div>
        </div>
    </nav>

    <!-- Enhanced Hero Section with floating animations -->
    <section class="bg-white hero-section">
        <div class="container-fluid hero-container">
            <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row">
                <!-- Left Content -->
                <div class="hero-content fade-in-up order-2 order-lg-1" style="animation-delay: 0.2s;">

               <div class="health-box">
                    <!-- Corner lines -->
                    <div class="corner-line line-hygiene-start"></div>
                    <div class="corner-line line-hygiene-end"></div>

                    <div class="corner-line line-mask-start"></div>
                    <div class="corner-line line-mask-end"></div>

                    <div class="corner-line line-home-start"></div>
                    <div class="corner-line line-home-end"></div>

                    <div class="corner-line line-distance-start"></div>
                    <div class="corner-line line-distance-end"></div>

                    <!-- Labels -->
                    <div class="label-text label-hygiene">Dr. Sarkar Family</div>
                
                </div>

                    <div class="tagline">
                        Transforming Smiles <span class="star">★</span> Transforming Lives
                    </div>
                  
                    <p class="hero-description">
                        A trusted dental surgeon and dedicated social contributor, bringing advanced healthcare and meaningful community development to the people of Asansol.
                    </p>
                
                    <button class="hero-btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                        <i class="fas fa-rocket me-2"></i>Book Appointment
                    </button>
              
                </div>
                
                <!-- Right Image with enhanced 3D effects -->
                <div class="hero-image-container order-1 order-lg-2">
                    <div class="hero-image">
                        <div class="image-wrapper">
                            <img src="{{ asset('images/sir.png') }}" alt="Hero Image" class="hero-sir" style="max-width: 100%; height: auto; display: block; cursor: pointer; transition: transform 0.3s ease;" data-bs-toggle="modal" data-bs-target="#doctorBioModal">
                            <div class="floating-elements">
                                <div class="floating-dot dot-1"></div>
                                <div class="floating-dot dot-2"></div>
                                <div class="floating-dot dot-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


     <!-- News Ticker Section -->
     <div class="news-ticker-container">
        <div class="news-ticker">
            <div class="ticker-icon">
                <i class="fas fa-broadcast-tower"></i>
            </div>
            <div class="ticker-content">
                <div class="ticker-text">
                    <span class="ticker-item">🏥 Orodental Hospital - First Dental Hospital in Burdwan District</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">🦷 Dr. Sarkar treating 100+ patients daily with advanced dental care</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">👨‍⚕️ 15+ years of excellence in dental surgery and prosthodontics</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">🏛️ Ward 84 Councillor working for community development</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">🌟 Transforming smiles, transforming lives in Asansol</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">📱 Follow us on social media for latest updates and dental tips</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">🎯 Specialized in dental implants, cosmetic dentistry & full mouth rehabilitation</span>
                    <span class="ticker-separator">•</span>
                    <span class="ticker-item">💙 Trusted by 1000+ happy patients</span>
                </div>
            </div>
        </div>
    </div>

       <!-- Enhanced Projects Section with 3D animations -->
       <section class="projects-section py-5" style="background: linear-gradient(135deg, var(--secondary-white) 0%, var(--accent-white) 100%);">
        <div class="container">
            <div class="text-center mb-5 fade-in-up" data-aos="fade-up" style="animation-delay: 0.1s;">
                <h2 class="display-5 fw-bold mb-3" style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">About Us</h2>
                <div class="mx-auto" >
                    <p class="text-muted lead">Founded by Dr. Debasish Sarkar, Orodental is the first dental hospital in Burdwan district, treating over 100 patients daily. Dr. Sarkar is not only a renowned dental surgeon but also an active community leader and Ward 84 Councillor, working tirelessly to uplift the lives of local citizens.</p>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($abouts as $index => $about)
                <div class="col-lg-4 col-md-6 fade-in-up" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s;">
                    <a href="{{ route('about.show', $about) }}" class="text-decoration-none text-dark">
                        <div class="project-card card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset($about->image) }}" class="card-img-top project-image" alt="{{ $about->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                                <div class="project-overlay d-flex align-items-center justify-content-center">
                                    <span class="btn btn-primary rounded-circle p-3" style="background: var(--gradient-primary); border: none; box-shadow: var(--shadow-medium);">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge" style="background: var(--gradient-primary); border: none;">{{ $about->title ?? 'About' }}</span>
                                    <div class="project-links">
                                        <span class="text-muted me-2 hover-lift"><i class="far fa-heart"></i></span>
                                        <span class="text-muted hover-lift"><i class="fas fa-share-alt"></i></span>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold mb-2">{{ $about->title }}</h5>
                                <p class="card-text text-muted">{{ $about->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div>
        <div class="ambulance-container">
            <img src="{{ asset('images/road.png') }}" class="road-bg" alt="Road">
            <img src="{{ asset('images/ambulance.png') }}" class="ambulance-img" alt="Ambulance">
        </div>
    </div>

    <!-- Enhanced Services Section with video background -->
    <section class="services-section" style="position: relative; overflow: hidden;" >
        <!-- Video Background -->
        <div class="video-background">
            <video autoplay muted loop playsinline class="background-video">
                <source src="{{ asset('images/video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="video-overlay"></div>
        </div>
        
        <div class="container text-center position-relative">
            <div class="d-flex text-center justify-content-center align-items-center">
                <div class="doctor-card fade-in-up" style="left: 36px; position: absolute; animation-delay: 0.2s;">
                    <div class="doctor-img mb-3 mx-auto" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 4px solid rgba(255,255,255,0.8); box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                        <img class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                </div>

                <span class="text-center text-white mt-3 mb-5 fade-in-up" style="font-size: 4rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); animation-delay: 0.4s;"> ORODENTAL HOSPITAL PVT. LTD. </span>
            </div>
            <!-- Enhanced Service Cards -->
            <div class="row g-4 d-flex justify-content-center align-items-center">
             
                <div class="col-md-5 col-lg-5 fade-in-up" style="animation-delay: 0.6s;" data-modal="servicePopupModal" data-title="Service Popup">
                    <div class="service-card card h-100 border-0 shadow-sm overflow-hidden clickable-service-card" 
                         style="cursor: pointer;">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset('images/dental.jpg') }}" class="card-img-top project-image" alt="Dental Care">
                            <div class="service-overlay">
                                <div class="service-icon">
                                    <i class="fas fa-tooth fa-3x text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2">Dental Care</h5>
                            <p class="card-text text-muted">Professional dental treatments with modern technology</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-5 fade-in-up" style="animation-delay: 0.8s;" data-modal="servicePopupModal" data-title="Service Popup">
                    <div class="service-card card h-100 border-0 shadow-sm overflow-hidden clickable-service-card" 
                         style="cursor: pointer;">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset('images/eye.jpg') }}" class="card-img-top project-image" alt="Eye Care">
                            <div class="service-overlay">
                                <div class="service-icon">
                                    <i class="fas fa-eye fa-3x text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2">Eye Care</h5>
                            <p class="card-text text-muted">Advanced ophthalmology services</p>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Enhanced Meet Our Doctors Section with staggered animations -->
            <div class="text-center pt-5">
                <h3 class="text-white mb-4 fade-in-up" style="animation-delay: 0.3s; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Meet Our Expert Doctors</h3>
                <div class="row justify-content-center">
                    <!-- Doctor 1 -->
                    <div class="col-6 col-md-3 mb-4 fade-in-up" style="animation-delay: 0.4s;">
                        <div class="doctor-card doctor-flip" data-title="Dr. John Doe" data-description="Specialist in Orthodontics and cosmetic dentistry with 12+ years of experience." data-image="{{ asset('images/a.png') }}">
                            <div class="flip-inner">
                                <div class="flip-front">
                                    <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                                        <img src="{{ asset('images/a.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. John Doe</h4>
                                    <p class="text-muted small">Orthodontics Specialist</p>
                                </div>
                                <div class="flip-back">
                                    <h5>Dr. John Doe</h5>
                                    <p>Specialist in Orthodontics and cosmetic dentistry with 12+ years of experience.</p>
                                    <div class="doctor-stats">
                                        <span class="badge bg-light text-dark me-2">12+ Years</span>
                                        <span class="badge bg-light text-dark">Expert</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor 2 -->
                    <div class="col-6 col-md-3 mb-4 fade-in-up" style="animation-delay: 0.5s;">
                        <div class="doctor-card doctor-flip" data-title="Dr. Jane Smith" data-description="Consultant Ophthalmologist focused on cataract and refractive surgeries." data-image="{{ asset('images/c.png') }}">
                            <div class="flip-inner">
                                <div class="flip-front">
                                    <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                                        <img src="{{ asset('images/c.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. Jane Smith</h4>
                                    <p class="text-muted small">Ophthalmologist</p>
                                </div>
                                <div class="flip-back">
                                    <h5>Dr. Jane Smith</h5>
                                    <p>Consultant Ophthalmologist focused on cataract and refractive surgeries.</p>
                                    <div class="doctor-stats">
                                        <span class="badge bg-light text-dark me-2">15+ Years</span>
                                        <span class="badge bg-light text-dark">Specialist</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor 3 -->
                    <div class="col-6 col-md-3 mb-4 fade-in-up" style="animation-delay: 0.6s;">
                        <div class="doctor-card doctor-flip" data-title="Dr. Robert Johnson" data-description="Maxillofacial surgeon specializing in complex jaw surgeries and implants." data-image="{{ asset('images/b.png') }}">
                            <div class="flip-inner">
                                <div class="flip-front">
                                    <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                                        <img src="{{ asset('images/b.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. Robert Johnson</h4>
                                    <p class="text-muted small">Maxillofacial Surgeon</p>
                                </div>
                                <div class="flip-back">
                                    <h5>Dr. Robert Johnson</h5>
                                    <p>Maxillofacial surgeon specializing in complex jaw surgeries and implants.</p>
                                    <div class="doctor-stats">
                                        <span class="badge bg-light text-dark me-2">18+ Years</span>
                                        <span class="badge bg-light text-dark">Surgeon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor 4 -->
                    <div class="col-6 col-md-3 mb-4 fade-in-up" style="animation-delay: 0.7s;">
                        <div class="doctor-card doctor-flip" data-title="Dr. Sarah Williams" data-description="Pediatric Dentist providing gentle care for children and teens." data-image="{{ asset('images/d.png') }}">
                            <div class="flip-inner">
                                <div class="flip-front">
                                    <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                                        <img src="{{ asset('images/d.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. Sarah Williams</h4>
                                    <p class="text-muted small">Pediatric Dentist</p>
                                </div>
                                <div class="flip-back">
                                    <h5>Dr. Sarah Williams</h5>
                                    <p>Pediatric Dentist providing gentle care for children and teens.</p>
                                    <div class="doctor-stats">
                                        <span class="badge bg-light text-dark me-2">10+ Years</span>
                                        <span class="badge bg-light text-dark">Pediatric</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Popup Modal -->
    <div id="servicePopupModal" class="service-popup-modal" style="display: none;">
        <div class="service-popup-content">
            <button class="service-popup-close" id="servicePopupClose">&times;</button>
            
            <div class="service-popup-header">
                <h2 id="servicePopupTitle" class="service-popup-title"></h2>
                <p class="service-popup-subtitle">Advanced Healthcare Solutions</p>
            </div>
            
            <div class="service-popup-body">
                <div class="service-popup-image">
                    <img id="servicePopupImage" src="" alt="">
                </div>
                
                <div class="service-popup-description">
                    <p id="servicePopupDescription"></p>
                </div>
                
                <div class="service-popup-actions">
                    <button class="service-popup-btn primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#appointmentModal">Book Appointment</button>
                    <!-- <button class="service-popup-btn secondary">Learn More</button> -->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                <div class="modal-header border-0 pb-0 text-center">
                    <div class="w-100 text-center">
                        <h5 class="modal-title fw-bold text-primary mb-1" id="appointmentModalLabel" style="font-size: 1.4rem;">Book Appointment</h5>
                        <p class="text-muted small mb-0">We'll get back to you soon</p>
                    </div>
                    <button type="button" class="btn-close position-absolute" style="top: 1rem; right: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-2">
                    <form id="appointmentForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" id="name" required 
                                   placeholder="Your Name" 
                                   style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 15px; font-size: 0.95rem;">
                            <div class="invalid-feedback">Please enter your name</div>
                        </div>
                        <div class="mb-4">
                            <input type="date" class="form-control form-control-lg" id="date" required 
                                   style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 15px; font-size: 0.95rem;">
                            <div class="invalid-feedback">Please select a date</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100" 
                                style="background: linear-gradient(135deg, #a96ee4 0%, #46ff46 100%); 
                                       border: none; 
                                       padding: 12px; 
                                       font-weight: 600; 
                                       border-radius: 10px; 
                                       letter-spacing: 0.5px;
                                       box-shadow: 0 4px 15px rgba(169, 110, 228, 0.3);
                                       transition: all 0.3s ease;">
                            Confirm Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Doctor Bio Modal -->
    <div class="modal fade" id="doctorBioModal" tabindex="-1" aria-labelledby="doctorBioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content doctor-bio-modal" style="margin-top: 70px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctorBioModalLabel">About Dr. Sarkar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="doctor-avatar">
                                <img src="{{ asset('images/sir.png') }}" alt="Dr. Sarkar" class="img-fluid rounded-circle border border-4 border-white shadow">
                                <div class="doctor-status">
                                    <span class="status-dot"></span>
                                    <span>Available Today</span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h5 class="mb-1">Dr. Suvankar Sarkar</h5>
                                <!-- <p class="text-muted mb-2">BDS, MDS (Prosthodontics)</p> -->
                                <div class="social-links">
                                    <a href="https://www.facebook.com/drdebashissarkar" class="text-primary me-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.youtube.com/@drdebashissarkartmc" class="text-info me-2"><i class="fab fa-youtube"></i></a>
                                    <a href="https://www.instagram.com/sarkardr.debasish/" class="text-danger me-2"><i class="fab fa-instagram"></i></a>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="bio-content">
                                <h6 class="text-uppercase text-primary mb-3">Dr. Suvankar Sarkar</h6>
                                <p>Dr. Debasish Sarkar is popularly known as Daktar Babu. He is currently serving as Borough Chairman-VI and Councillor of Ward No. 84 in Asansol Municipal Corporation. Recently, he became the Mayor’s Representative in ADDA (Asansol Durgapur Development Authority).
<br>
He fought for the first time in the Municipality Election (AITC ticket) and, for the first time in history, secured victory for Ward No. 84— a ward untouched by AITC since its inception in 1998.
<br>
Dr. Sarkar is very active in public activities, including political, administrative, and social work. As a renowned dentist, his Orodental Hospital initiative has outreach to over 6 lakh households.
<br>
Historic contribution includes initiating the naming of a road after Justice Radha Binod Paul, the first in West Bengal or any major metro city.
<br>
During his tenure, a total of ₹24.5 crore+ has been allocated for the development of eight wards, with 85% work sanctioned and ongoing, and 15% in DPR stage.
</p>
                                
                                <!-- <h6 class="text-uppercase text-primary mt-4 mb-3">Education</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-graduation-cap text-primary me-2"></i> BDS - Dental College, 2005</li>
                                    <li class="mb-2"><i class="fas fa-graduation-cap text-primary me-2"></i> MDS in Prosthodontics - University of Dental Sciences, 2009</li>
                                    <li class="mb-2"><i class="fas fa-certificate text-primary me-2"></i> Fellowship in Implantology, 2011</li>
                                </ul>
                                
                                <h6 class="text-uppercase text-primary mt-4 mb-3">Specializations</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark">Dental Implants</span>
                                    <span class="badge bg-light text-dark">Cosmetic Dentistry</span>
                                    <span class="badge bg-light text-dark">Full Mouth Rehabilitation</span>
                                    <span class="badge bg-light text-dark">Teeth Whitening</span>
                                    <span class="badge bg-light text-dark">Veneers & Crowns</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#appointment" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#appointmentModal">Book Appointment</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Drawer (shared) -->
    <div id="infoOverlay" class="info-overlay" aria-hidden="true"></div>
    <aside id="infoPanel" class="info-panel" role="dialog" aria-modal="true" aria-labelledby="infoTitle" aria-hidden="true">
        <button type="button" class="info-close" id="infoClose" aria-label="Close">×</button>
        <div class="info-content">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img id="infoImage" src="" alt="" style="width:64px; height:64px; border-radius:12px; object-fit:cover; background:#ffffff33;">
                <h3 id="infoTitle" class="mb-0"></h3>
            </div>
            <p id="infoDesc" class="mb-0"></p>
        </div>
    </aside>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS with enhanced settings
            AOS.init({
                duration: 1000,
                easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
                once: true,
                offset: 100,
                delay: 100
            });

            // Enhanced scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);

            // Observe all elements with scroll-reveal class
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });

            // Parallax effect for background elements
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax-bg');
                
                parallaxElements.forEach(element => {
                    const speed = 0.5;
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Enhanced dropdown functionality
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(dropdown => {
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                
                // Show dropdown on hover
                dropdown.addEventListener('mouseenter', () => {
                    dropdownMenu.classList.add('show');
                    dropdownMenu.style.display = 'block';
                    console.log('Dropdown hovered - showing menu');
                });
                
                // Hide dropdown when mouse leaves
                dropdown.addEventListener('mouseleave', () => {
                    dropdownMenu.classList.remove('show');
                    dropdownMenu.style.display = 'none';
                    console.log('Dropdown left - hiding menu');
                });
                
                // Toggle dropdown on click for mobile
                dropdownToggle.addEventListener('click', (e) => {
                    if (window.innerWidth <= 991.98) {
                        e.preventDefault();
                        dropdownMenu.classList.toggle('show');
                        dropdownMenu.style.display = dropdownMenu.classList.contains('show') ? 'block' : 'none';
                        console.log('Dropdown clicked - toggling menu');
                    }
                });

                // Debug: Log dropdown elements
                console.log('Dropdown found:', dropdown);
                console.log('Dropdown menu:', dropdownMenu);
                console.log('Dropdown toggle:', dropdownToggle);
            });

            // Interactive info drawer
            const overlay = document.getElementById('infoOverlay');
            const panel = document.getElementById('infoPanel');
            const closeBtn = document.getElementById('infoClose');
            const titleEl = document.getElementById('infoTitle');
            const descEl = document.getElementById('infoDesc');
            const imgEl = document.getElementById('infoImage');

            function openPanel({ title, description, image }) {
                titleEl.textContent = title || '';
                descEl.textContent = description || '';
                if (image) {
                    imgEl.src = image;
                    imgEl.alt = title || 'Image';
                    imgEl.style.display = 'block';
                } else {
                    imgEl.style.display = 'none';
                }
                overlay.classList.add('show');
                panel.classList.add('open');
                overlay.setAttribute('aria-hidden', 'false');
                panel.setAttribute('aria-hidden', 'false');
                closeBtn.focus();
            }

            function closePanel() {
                panel.classList.remove('open');
                overlay.classList.remove('show');
                overlay.setAttribute('aria-hidden', 'true');
                panel.setAttribute('aria-hidden', 'true');
            }

            overlay.addEventListener('click', closePanel);
            closeBtn.addEventListener('click', closePanel);
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closePanel();
            });

            function attach(card) {
                card.setAttribute('tabindex', '0');
                card.addEventListener('click', () => {
                    openPanel({
                        title: card.dataset.title,
                        description: card.dataset.description,
                        image: card.dataset.image
                    });
                });
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        card.click();
                    }
                });
            }

            document.querySelectorAll('.service-card[data-title]').forEach(attach);
            document.querySelectorAll('.doctor-card[data-title]').forEach(attach);
        });

        // Service Popup Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const popupModal = document.getElementById('servicePopupModal');
            const popupClose = document.getElementById('servicePopupClose');
            const popupTitle = document.getElementById('servicePopupTitle');
            const popupImage = document.getElementById('servicePopupImage');
            const popupDescription = document.getElementById('servicePopupDescription');
            
            // Get all clickable service cards
            const serviceCards = document.querySelectorAll('.clickable-service-card');
            
            // Add click event to each service card
            serviceCards.forEach(card => {
                card.addEventListener('click', function() {
                    const title = this.querySelector('.card-title').textContent;
                    const description = this.querySelector('.card-text').textContent;
                    const image = this.querySelector('img').src;
                    
                    // Set popup content
                    popupTitle.textContent = title;
                    popupDescription.textContent = description;
                    popupImage.src = image;
                    popupImage.alt = title;
                    
                    // Show popup
                    popupModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });
            
            // Close popup when close button is clicked
            popupClose.addEventListener('click', function() {
                closePopup();
            });
            
            // Close popup when clicking outside
            popupModal.addEventListener('click', function(e) {
                if (e.target === popupModal) {
                    closePopup();
                }
            });
            
            // Close popup with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && popupModal.style.display === 'flex') {
                    closePopup();
                }
            });
            
            function closePopup() {
                popupModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Video background handling
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.querySelector('.background-video');
            if (video) {
                // Add loaded class when video is ready
                video.addEventListener('loadeddata', function() {
                    video.classList.add('loaded');
                });

                // Ensure video plays on mobile devices
                video.addEventListener('canplay', function() {
                    video.play().catch(function(error) {
                        console.log('Video autoplay failed:', error);
                    });
                });

                // Pause video when not visible to save resources
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            video.play().catch(e => console.log('Video play failed:', e));
                        } else {
                            video.pause();
                        }
                    });
                }, { threshold: 0.1 });

                observer.observe(video);
            }
        });
    </script>

    <section class="py-5 text-center" style="background: #f8fafc;">
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <!-- Dr. Sarkar Official Button -->
            <button type="button" class="btn popup-btn flex-fill flex-md-grow-0"
                data-bs-toggle="modal" data-bs-target="#drSarkarModal">
                Dr. Sarkar Official
            </button>
            
            <!-- Capigen Highlights Button -->
            <button type="button" class="btn popup-btn flex-fill flex-md-grow-0"
                data-bs-toggle="modal" data-bs-target="#capigenModal">
                Capigen Highlights
            </button>
        </div>

        
        <!-- Dr. Sarkar Modal -->
        <div class="modal fade" id="drSarkarModal" tabindex="-1" aria-labelledby="drSarkarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background: linear-gradient(to right, #a96ee4, #46ff46); color: #fff;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="drSarkarModalLabel">Dr. Sarkar Official</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            @foreach([
                                ['key' => 'ward', 'title' => 'Ward No. 84', 'image' => 'ward.png'],
                                ['key' => 'borough', 'title' => 'Borough VI', 'image' => 'borough.png'],
                                ['key' => 'adda', 'title' => 'ADDA Activities', 'image' => 'adda.png']
                            ] as $item)
                            <div class="col-md-4">
                                <a href="{{ route('section.item', ['section' => 'dr-sarkar', 'item' => $item['key']]) }}" class="text-decoration-none">
                                    <div class="card border-0 bg-transparent h-100">
                                        <div class="position-relative">
                                            <img src="{{ asset('images/' . $item['image']) }}" class="card-img-top rounded-3 mb-3" alt="{{ $item['title'] }}" style="height: 200px; object-fit: cover;">
                                            <div class="card-overlay">
                                                <span class="btn btn-primary rounded-pill">View Details</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">{{ $item['title'] }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Capigen Highlights Modal -->
        <div class="modal fade" id="capigenModal" tabindex="-1" aria-labelledby="capigenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background: linear-gradient(to right, #a96ee4, #46ff46); color: #fff;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="capigenModalLabel">Capigen Highlights</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            @foreach([
                                ['key' => 'pase-achi', 'title' => 'Pase Achi Asansol', 'image' => 'asansol.png'],
                                ['key' => 'make-asansol-greater', 'title' => 'Make Asansol Greater Again', 'image' => 'blank-cover.png'],
                                ['key' => 'ek-daake-daktar', 'title' => 'Ek Daake Daktar', 'image' => 'blank-cover.png']
                            ] as $item)
                            <div class="col-md-4">
                                <a href="{{ route('section.item', ['section' => 'capigen-highlights', 'item' => $item['key']]) }}" class="text-decoration-none">
                                    <div class="card border-0 bg-transparent h-100">
                                        <div class="position-relative">
                                            <img src="{{ asset('images/' . $item['image']) }}" class="card-img-top rounded-3 mb-3" alt="{{ $item['title'] }}" style="height: 200px; object-fit: cover;">
                                            <div class="card-overlay">
                                                <span class="btn btn-primary rounded-pill">View Details</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">{{ $item['title'] }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dr. Sarkar Modal -->
        <div class="modal fade" id="drSarkarModal" tabindex="-1" aria-labelledby="drSarkarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style=" background: linear-gradient(to right, #a96ee4, #46ff46); color: #fff;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="drSarkarModalLabel">Dr. Sarkar Official</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('images/ward.png') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Ward No. 84</h5>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('images/borough.png') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Borough VI</h5>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('images/adda.png') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">ADDA Activities</h5>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Capigen Modal -->
        <div class="modal fade" id="capigenModal" tabindex="-1" aria-labelledby="capigenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style=" background: linear-gradient(to right, #a96ee4, #46ff46); color: #fff;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="capigenModalLabel">Capigen Highlights</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                          
                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('images/asansol.png') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Pase Achi Asansol</h5>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('images/blank-cover.png') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Make Asansol Greater Again</h5>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <img src="{{ asset('images/blank-cover.png') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Ek Daake Daktar</h5>
                                            
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Contact Section with 3D effects -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--secondary-white) 0%, var(--accent-white) 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-section fade-in-up" style="animation-delay: 0.2s;">
                        <div class="floating-shapes">
                            <div class="shape shape-1"></div>
                            <div class="shape shape-2"></div>
                            <div class="shape shape-3"></div>
                        </div>
                        <h3 class="contact-title text-center mb-4">Get In Touch</h3>
                        <p class="text-center text-white mb-4 opacity-75">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                        <form class="row g-4 justify-content-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="fas fa-user text-white"></i>
                                    </span>
                                    <input type="text" class="form-control contact-input" placeholder="Your name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="fas fa-envelope text-white"></i>
                                    </span>
                                    <input type="email" class="form-control contact-input" placeholder="Email address" required>
                                </div>
                            </div>
                            <div class="col-md-3 d-grid">
                                <button type="submit" class="btn contact-btn btn-animate">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- Social Media Section -->
<section class="social-media-section py-5 mb-5 relative overflow-hidden"
    style="background: linear-gradient(135deg, #1fd51f 0%, #16a016 100%); position: relative;">
    
    <div class="container relative z-10">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="text-white mb-3 fw-bold" 
                    style="text-shadow: 3px 3px 8px rgba(0,0,0,0.4); font-size: 2.5rem;">
                    🌐 Stay Connected
                </h2>
                <p class="text-white mb-5 fs-5 opacity-90">Follow us on social media for updates, news & tips</p>

                <div class="social-icons-container d-flex justify-content-center align-items-center gap-4 flex-wrap">
                    
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/drdebashissarkar" class="social-icon-link">
                        <div class="social-icon facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </div>
                    </a>

                    <!-- Twitter -->
                    <!-- <a href="#" class="social-icon-link">
                        <div class="social-icon twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </div>
                    </a> -->

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/sarkardr.debasish" class="social-icon-link">
                        <div class="social-icon instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                    </a>

                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@drdebashissarkartmc/" class="social-icon-link">
                        <div class="social-icon youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative background circles -->
    <div class="circle-shape"></div>
    <div class="circle-shape two"></div>
</section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-start gy-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="footer-logo">
                            <!-- <span class="footer-logo-text">C</span> -->
                        </div>
                        <!-- <span class="footer-title">ClarityUI</span> -->
                    </div>
                    <p class="footer-desc">Clarity gives you the blocks and components you need to create a truly professional website.</p>
                    <div class="d-flex gap-2">
                       
                        <a href="https://www.facebook.com/drdebashissarkar" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #2563eb; border-radius: 50%; color: #fff;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/sarkardr.debasish?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #fff; border-radius: 50%; border: 1.5px solid #e5e7eb; color: #111;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@drdebashissarkartmc/" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #fff; border-radius: 50%; border: 1.5px solid #e5e7eb; color: #111;"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 offset-md-1">
                    <div class="fw-bold mb-2 text-uppercase" style="color: #2563eb; font-size: 0.98em; letter-spacing: 1px;">Company</div>
                    <ul class="list-unstyled">
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">About</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Features</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Works</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Career</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <div class="fw-bold mb-2 text-uppercase" style="color: #2563eb; font-size: 0.98em; letter-spacing: 1px;">Help</div>
                    <ul class="list-unstyled">
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Customer Support</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Delivery Details</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Terms & Conditions</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <div class="fw-bold mb-2 text-uppercase" style="color: #2563eb; font-size: 0.98em; letter-spacing: 1px;">Resources</div>
                    <ul class="list-unstyled">
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Free eBooks</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Development Tutorial</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">How to - Blog</a></li>
                        <li class="mb-1"><a href="#" class="text-muted text-decoration-none">Youtube Playlist</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: #e5e7eb;">
            <div class="text-center text-muted small" style="letter-spacing: 0.5px;">© Copyright 2022. All Rights Reserved by ClarityUI</div>
        </div>
    </footer>
</body>
</html>
