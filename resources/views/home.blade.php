<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClarityUI - Landingfolio Kit</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom">
        <div class="container navbar-container justify-content-center">
            
            <!-- Navigation Links -->
            <div class="d-flex align-items-center nav-links">
                <a class="nav-link" href="#about">About Us</a>
                <a class="nav-link" href="#">Orodental</a>
                <a class="nav-link mr-5" href="#">Dr. Sarkar Social</a>
                @auth
                    <a class="nav-link" href="{{ route('admin.abouts.index') }}" style="margin-left: 20px;">
                        <i class="fas fa-cog"></i> Admin
                    </a>
                @endauth
            </div>
            
            <!-- Start Free Trial Button -->
            <button class="btn start-trial-btn ml-5">
                Contact
            </button>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="display: none;">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white hero-section">
        <div class="container-fluid hero-container">
            <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row">
                <!-- Left Content -->
                <div class="hero-content">
                    <h1 class="hero-title">
                        Meet the new<br>Landingfolio Kit
                    </h1>
                    <p class="hero-description">
                        Clarity gives you the blocks & components you need to create a truly professional website, landing page or admin panel for your SaaS.
                    </p>
                
                        <button class="hero-btn">
                            Start using Landingfolio
                        </button>
              
                </div>
                
                <!-- Right Image -->
                <div class="hero-image-container">
                    <div class="hero-image">
                        <img src="{{ asset('images/sir.png') }}" alt="Hero Image" style="background: transparent;">
                    </div>
                </div>
            </div>
        </div>
    </section>


       <!-- Projects Section -->
       <section class="projects-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-primary mb-3">About Us</h2>
                <!-- <div class="mx-auto" style="max-width: 600px;">
                    <p class="text-muted lead">Explore our portfolio of successful projects and see how we bring ideas to life with innovative solutions.</p>
                </div> -->
            </div>
            
            <div class="row g-4">
                @foreach($abouts as $index => $about)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="project-card card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset($about->image) }}" class="card-img-top project-image" alt="{{ $about->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="project-overlay d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn-primary rounded-circle p-3">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $about->title ?? 'Web Design' }}</span>
                                <div class="project-links">
                                    <a href="#" class="text-muted me-2"><i class="far fa-heart"></i></a>
                                    <a href="#" class="text-muted"><i class="fas fa-share-alt"></i></a>
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
            bottom: 0px;
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
    </style>

    <div>
        <div class="ambulance-container">
            <img src="{{ asset('images/road.png') }}" class="road-bg" alt="Road">
            <img src="{{ asset('images/ambulance.png') }}" class="ambulance-img" alt="Ambulance">
        </div>
    </div>

    <!-- Services Section -->
    <section class="services-section " style=" background: url({{ asset('images/abbg.png') }}) no-repeat center center/cover">
        <div class="container text-center">
            <div class="d-flex text-center justify-content-center align-items-center">
            <div class="doctor-card" style="    left: 36px;
    position: absolute;">
                <div class="doctor-img mb-3 mx-auto" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
            </div>


                        <h1 class="text-center text-white mt-3 mb-5"> ORODENTAL HOSPITAL PVT. LTD. </h1>
            </div>
            <!-- Service Cards -->
            <div class="row g-4 d-flex justify-content-center align-items-center">
             
                <div class=" col-md-4" data-aos="fade-up" >
                    <div class="project-card card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset('images/f.png') }}" class="card-img-top project-image" alt="Eye Care">
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2">Dental Care</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" >
                    <div class="project-card card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset('images/e.png') }}" class="card-img-top project-image" alt="Eye Care">
                           
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2">Eye Care</h5>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Meet Our Doctors Section -->
            <div class="text-center  pt-5">
       
                <div class="row justify-content-center">
                    <!-- Doctor 1 -->
                    <div class="col-6 col-md-3 mb-4">
                        <div class="doctor-card">
                            <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <img src="{{ asset('images/a.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. John Doe</h4>
                        </div>
                    </div>
                    
                    <!-- Doctor 2 -->
                    <div class="col-6 col-md-3 mb-4">
                        <div class="doctor-card">
                            <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <img src="{{ asset('images/c.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. Jane Smith</h4>
                        </div>
                    </div>
                    
                    <!-- Doctor 3 -->
                    <div class="col-6 col-md-3 mb-4">
                        <div class="doctor-card">
                            <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <img src="{{ asset('images/b.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. Robert Johnson</h4>
                        </div>
                    </div>
                    
                    <!-- Doctor 4 -->
                    <div class="col-6 col-md-3 mb-4">
                        <div class="doctor-card">
                            <div class="doctor-img mb-3 mx-auto" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <img src="{{ asset('images/d.png') }}" alt="Doctor" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 5px; font-weight: 600;">Dr. Sarah Williams</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .service-card {
            background: white;
            border-radius: 10px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            height: 100%;
        }
        .service-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
        }
        .service-card h3 {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .service-card p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        .read-more {
            color: #0d6efd;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .read-more i {
            margin-left: 5px;
            font-size: 0.8rem;
        }
        .doctor-card {
            text-align: center;
            padding: 15px 10px;
        }
        .doctor-img {
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .doctor-card h4 {
            font-size: 1rem;
            color: #333;
            margin: 10px 0 5px;
            font-weight: 600;
        }
        .doctor-card .specialty {
            color: #666;
            font-size: 0.85rem;
            margin: 0;
        }
        @media (max-width: 768px) {
            .doctor-img {
                width: 100px;
                height: 100px;
            }
        }
    </style>

    <!-- Projects Section -->
    <!-- <section class="projects-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-semibold">OUR WORK</span>
                <h2 class="display-5 fw-bold mb-3">Our Featured Projects</h2>
                <div class="mx-auto" style="max-width: 600px;">
                    <p class="text-muted lead">Explore our portfolio of successful projects and see how we bring ideas to life with innovative solutions.</p>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($projects as $index => $project)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="project-card card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset($project['img']) }}" class="card-img-top project-image" alt="{{ $project['title'] }}">
                            <div class="project-overlay d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn-primary rounded-circle p-3">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $project['category'] ?? 'Web Design' }}</span>
                                <div class="project-links">
                                    <a href="#" class="text-muted me-2"><i class="far fa-heart"></i></a>
                                    <a href="#" class="text-muted"><i class="fas fa-share-alt"></i></a>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">{{ $project['title'] }}</h5>
                            <p class="card-text text-muted">{{ $project['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="#" class="btn btn-outline-primary px-4 py-2">
                    View All Projects <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section> -->

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>

    <!-- Testimonials Section -->
    <!-- <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                @foreach($testimonials as $testimonial)
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/a.jpg') }}" class="img-fluid rounded-4" alt="Testimonial">
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Real-time Analytics</small>
                    <h3 class="fw-bold mt-2">{{ $testimonial['title'] }}</h3>
                    <p>{{ $testimonial['desc'] }}</p>
                    <div class="mb-2"><strong>{{ $testimonial['author'] }}</strong> <span class="text-muted">- {{ $testimonial['role'] }}</span></div>
                    <a href="#" class="text-primary">Read Full Case Study →</a>
                </div>
                @endforeach
            </div>
        </div>
    </section> -->

    <!-- Youtube Highlights Section -->
    <!-- <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Youtube Highlights</h4>
                <a href="{{ route('youtube-highlights.index') }}" class="btn btn-outline-primary">
                    View All <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach($highlights as $yt)
                <div class="col-md-4">
                    <div class="card border-0 bg-transparent">
                        <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-0">
                            <small class="d-block mb-1" style="color: #6c3ef5; font-weight: 500;">{{ $yt['author'] }} • {{ $yt['date'] }}</small>
                            <div class="d-flex align-items-center mb-1">
                                <h5 class="card-title fw-bold mb-0 flex-grow-1">{{ $yt['title'] }}</h5>
                                <span class="ms-2" style="font-size: 1.1em; color: #888;">&#8599;</span>
                            </div>
                            <p class="card-text text-muted mb-2" style="font-size: 0.97em;">{{ $yt['desc'] }}</p>
                            <div class="mb-2">
                                @foreach($yt['tags'] as $tag)
                                    <span class="badge rounded-pill px-3 py-2 me-1 mb-1" style="background: #f4f4f6; color: #6c3ef5; font-weight: 500; font-size: 0.95em;">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('youtube-highlights.index') }}" class="btn btn-primary">
                    View All Highlights <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section> -->


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
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Test</h5>
                                            
                                    </div>
                                    <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Test</h5>
                                            
                                    </div>
                                    <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Test</h5>
                                            
                                    </div>
                                    <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
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
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Test</h5>
                                            
                                    </div>
                                    <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Test</h5>
                                            
                                    </div>
                                    <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent">
                                    <div class="d-flex align-items-center mb-1">
                                        <h5 class="card-title fw-bold mb-0 flex-grow-1 text-white">Test</h5>
                                            
                                    </div>
                                    <img src="{{ asset('images/b.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Youtube" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5" style="background: #f8fafc;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-section">
                        <svg width="120" height="120" class="contact-svg-1" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="80" cy="80" r="80" stroke="#fff" stroke-width="8"/>
                        </svg>
                        <svg width="120" height="120" class="contact-svg-2" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="80" r="40" stroke="#fff" stroke-width="6"/>
                        </svg>
                        <h3 class="contact-title">Contact Us</h3>
                        <form class="row g-3 justify-content-center">
                            <div class="col-md-4">
                                <input type="text" class="form-control contact-input" placeholder="First name">
                            </div>
                            <div class="col-md-4">
                                <input type="email" class="form-control contact-input" placeholder="Email address">
                            </div>
                            <div class="col-md-3 d-grid">
                                <button type="submit" class="btn contact-btn">Send your query</button>
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
                        <a href="#" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #2563eb; border-radius: 50%; color: #fff;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #fff; border-radius: 50%; border: 1.5px solid #e5e7eb; color: #111;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #fff; border-radius: 50%; border: 1.5px solid #e5e7eb; color: #111;"><i class="fa-brands fa-github"></i></a>
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
