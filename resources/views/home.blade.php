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
                            <li><a class="dropdown-item" href="#press"><i class="fas fa-newspaper me-2"></i>Press</a></li>
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
                <div class="hero-content fade-in-up" style="animation-delay: 0.2s;">
                    <h1 class="hero-title">
                        Welcome to <br><span class="gradient-text">Orodental Hospital</span>
                    </h1>
                    <p class="hero-description">
                        Excellence in Dental Care with a Human Touch
                    </p>
                
                        <button class="hero-btn">
                            <i class="fas fa-rocket me-2"></i>Book an Appointment
                        </button>
              
                </div>
                
                <!-- Right Image with enhanced 3D effects -->
                <div class="hero-image-container">
                    <div class="hero-image">
                        <div class="image-wrapper">
                            <img src="{{ asset('images/sir.png') }}" alt="Hero Image" class="hero-sir" style="max-width: 100%; height: auto; display: block;">
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
                    <div class="project-card card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset($about->image) }}" class="card-img-top project-image" alt="{{ $about->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="project-overlay d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn-primary rounded-circle p-3" style="background: var(--gradient-primary); border: none; box-shadow: var(--shadow-medium);">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge" style="background: var(--gradient-primary); border: none;">{{ $about->title ?? 'Web Design' }}</span>
                                <div class="project-links">
                                    <a href="#" class="text-muted me-2 hover-lift"><i class="far fa-heart"></i></a>
                                    <a href="#" class="text-muted hover-lift"><i class="fas fa-share-alt"></i></a>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">{{ $about->title }}</h5>
                            <p class="card-text text-muted">{{ $about->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <style>
        .ambulance-container {
            position: relative;
            width: 100%;
            /* height: 200px; */
            overflow: hidden;
            margin: 2rem 0;
            /* background-color: #f0f0f0; */
            border-radius: 8px;
        }
        .road-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .ambulance-img {
            position: absolute;
            bottom: -5px;
            left: -200px;
            width: 150px;
            height: auto;
            animation: moveAmbulance 8s linear infinite;
        }
        @keyframes moveAmbulance {
            0% {
                transform: translateX(-200px);
            }
            100% {
                transform: translateX(calc(100vw + 200px));
            }
        }
        /* Flip animation for doctor cards */
        .doctor-flip {
            perspective: 1000px;
            height: 200px;
        }
        .doctor-flip .flip-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.7s ease;
            transform-origin: center center;
        }
        .doctor-flip:hover .flip-inner {
            transform: rotateY(-180deg);
            -webkit-transform: rotateY(-180deg);
        }
        .doctor-flip .flip-front,
        .doctor-flip .flip-back {
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            width: 100%; height: 100%;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .doctor-flip .flip-back { 
            transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 50%, #7c3aed 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }
        .doctor-flip .flip-back h5 { 
            font-size: 1rem; 
            margin-bottom: 0.5rem;
            letter-spacing: 0.3px;
        }
        .doctor-flip .flip-back p { 
            font-size: 0.8rem; 
            opacity: 0.95; 
            line-height: 1.4;
            margin: 0;
        }
        /* Flip entire column (right-to-left) */
        .flip-col {
            perspective: 1000px;
        }
        .flip-col .flip-inner {
            position: relative;
            width: 100%;
            height: 360px;
            transform-style: preserve-3d;
            transition: transform 0.7s ease;
            transform-origin: center center;
        }
        .flip-col:hover .flip-inner {
            transform: rotateY(-180deg);
            -webkit-transform: rotateY(-180deg);
        }
        .flip-col .flip-front,
        .flip-col .flip-back {
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            width: 100%; height: 100%;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
        .flip-col .flip-back { 
            transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            display: flex; align-items: stretch; justify-content: stretch;
        }
        .flip-col .flip-front .title-overlay {
            position: absolute; left: 0; right: 0; bottom: 0;
            padding: 1rem 1.25rem; background: rgba(0,0,0,0.45); color: #fff;
        }
        /* Stylish back content */
        .info-back-card {
            position: relative;
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 50%, #7c3aed 100%);
            border-radius: 0.75rem;
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 12px 30px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.12);
            overflow: hidden;
        }
        .info-back-card::before {
            content: "";
            position: absolute;
            top: -20%; left: -20%;
            width: 60%; height: 140%;
            background: radial-gradient(ellipse at center, rgba(255,255,255,0.28), rgba(255,255,255,0.0) 60%);
            transform: rotate(25deg);
            pointer-events: none;
        }
        .info-back-card h5 { letter-spacing: 0.3px; }
        .info-back-card p { opacity: 0.95; line-height: 1.6; }
    </style>

    <div>
        <div class="ambulance-container">
            <img src="{{ asset('images/road.png') }}" class="road-bg" alt="Road">
            <img src="{{ asset('images/ambulance.png') }}" class="ambulance-img" alt="Ambulance">
        </div>
    </div>

    <!-- Enhanced Services Section with glassmorphism effects -->
    <section class="services-section" style="background: url({{ asset('images/abbg.png') }}) no-repeat center center/cover; position: relative;">
        <div class="services-overlay"></div>
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
             
                <div class="col-md-5 col-lg-5 fade-in-up" style="animation-delay: 0.6s;">
                    <div class="service-card card h-100 border-0 shadow-sm overflow-hidden" data-title="Dental Care" data-description="Comprehensive dental treatments including root canals, implants, cosmetic dentistry, and preventive care by experienced dentists." data-image="{{ asset('images/dental.jpg') }}">
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

                <div class="col-md-5 col-lg-5 fade-in-up" style="animation-delay: 0.8s;">
                    <div class="service-card card h-100 border-0 shadow-sm overflow-hidden" data-title="Eye Care" data-description="Advanced eye examinations, cataract surgery, LASIK, glaucoma management, and pediatric ophthalmology." data-image="{{ asset('images/eye.jpg') }}">
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
    </script>

    <section class="py-5 text-center" style="background: #f8fafc;">
        <div class=" gap-4 flex-direction-column">
            <!-- Dr. Sarkar Official Button -->
            <button type="button" class="btn popup-btn" data-bs-toggle="modal" data-bs-target="#drSarkarModal">
                Dr. Sarkar Official
            </button>
            
            <!-- Capigen Highlights Button -->
            <button type="button" class="btn popup-btn" data-bs-toggle="modal" data-bs-target="#capigenModal">
                Capigen highlights
            </button>
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-start gy-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="footer-logo">
                            <span class="footer-logo-text">C</span>
                        </div>
                        <span class="footer-title">ClarityUI</span>
                    </div>
                    <p class="footer-desc">Clarity gives you the blocks and components you need to create a truly professional website.</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #fff; border-radius: 50%; border: 1.5px solid #e5e7eb; color: #111;"><i class="fa-brands fa-twitter"></i></a>
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
