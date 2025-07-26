<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClarityUI - Landingfolio Kit</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-papm6Q+..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white" style="height: 80px; padding: 0 80px;">
        <div class="container-fluid " style="display: grid; grid-template-columns: auto 1fr auto; max-width: 1440px; margin: 0 auto; position: relative;">
            <!-- Logo -->
            <a class="navbar-brand" href="#"  >
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="object-fit: cover; width: 134px; height: 37px; margin-right: 0;">
            </a>
            
            <!-- Navigation Links -->
            <div class="d-flex align-items-center" style="gap: 40px; margin-left: 78px; ">
                <a class="text-decoration-none" href="#" style="color: #0F172A; font-size: 16px; font-weight: 500; line-height: 24px;">Product</a>
                <a class="text-decoration-none" href="#" style="color: #0F172A; font-size: 16px; font-weight: 500; line-height: 24px;">Feature</a>
                <a class="text-decoration-none" href="#" style="color: #0F172A; font-size: 16px; font-weight: 500; line-height: 24px;">Pricing</a>
                <a class="text-decoration-none" href="#" style="color: #0F172A; font-size: 16px; font-weight: 500; line-height: 24px;">Support</a>
            </div>
            
            <!-- Start Free Trial Button -->
            <button class="btn" style="width: 156px; height: 50px; border: 2px solid #0F172A; border-radius: 8px; font-weight: 600; font-size: 16px; line-height: 24px; color: #0F172A;">
                Start Free Trial
            </button>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="display: none;">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1 class="display-5 fw-bold mb-3">Meet the New<br>Landingfolio Kit</h1>
                    <p class="mb-4">Clarity gives you the blocks & components you need to create a truly professional website, landing page or admin panel for your SaaS.</p>
                    <a href="#" class="btn btn-primary">Start using LandingFolio</a>
                </div>
                <div class="col-md-6 text-center">
                    <div style="background: #e7f0fd; border-radius: 24px; min-height: 400px; width: 100%; height: 100%; position: relative; overflow: hidden;">
                        <img src="{{ asset('images/d.jpg') }}" alt="Hero Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 24px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our other projects that<br>you can look</h2>
                <p class="text-muted">The blocks & components you need</p>
            </div>
            <div class="row g-4">
                @foreach($projects as $project)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project['title'] }}</h5>
                            <p class="card-text">{{ $project['desc'] }}</p>
                        </div>
                        <img src="{{ asset($project['img']) }}" class="card-img-bottom" alt="Project Image">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
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
    </section>

    <!-- Youtube Highlights Section -->
    <section class="py-5">
        <div class="container">
            <h4 class="mb-4">Youtube Highlights</h4>
            <div class="row g-4">
                @foreach($youtube as $yt)
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
            <nav class="mt-5">
                <ul class="pagination justify-content-center align-items-center" style="border: none;">
                    <li class="page-item disabled"><a class="page-link bg-transparent border-0 text-muted" href="#" tabindex="-1"><span style="font-size:1.2em">&#8592;</span> Previous</a></li>
                    <li class="page-item active"><a class="page-link rounded-circle bg-light text-dark border-0 mx-1" href="#">1</a></li>
                    <li class="page-item"><a class="page-link rounded-circle bg-transparent text-dark border-0 mx-1" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-circle bg-transparent text-dark border-0 mx-1" href="#">3</a></li>
                    <li class="page-item"><a class="page-link rounded-circle bg-transparent text-dark border-0 mx-1" href="#">...</a></li>
                    <li class="page-item"><a class="page-link rounded-circle bg-transparent text-dark border-0 mx-1" href="#">10</a></li>
                    <li class="page-item"><a class="page-link bg-transparent border-0 text-muted" href="#">Next <span style="font-size:1.2em">&#8594;</span></a></li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5" style="background: #f8fafc;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div style="background: #2563eb; border-radius: 20px; position: relative; overflow: hidden; padding: 3rem 1rem;">
                        <!-- Top Left SVG -->
                        <svg width="120" height="120" style="position: absolute; top: -40px; left: -40px; opacity: 0.3;" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="80" cy="80" r="80" stroke="#fff" stroke-width="8"/>
                        </svg>
                        <!-- Bottom Right SVG -->
                        <svg width="120" height="120" style="position: absolute; bottom: -40px; right: -40px; opacity: 0.7;" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="80" r="40" stroke="#fff" stroke-width="6"/>
                        </svg>
                        <h3 class="mb-4 text-center" style="color: #fff; font-weight: bold; letter-spacing: 1px;">Contact Us</h3>
                        <form class="row g-3 justify-content-center">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="First name" style="background: transparent; border: 1.5px solid #fff; color: #fff; border-radius: 8px; font-weight: 500;">
                            </div>
                            <div class="col-md-4">
                                <input type="email" class="form-control" placeholder="Email address" style="background: transparent; border: 1.5px solid #fff; color: #fff; border-radius: 8px; font-weight: 500;">
                            </div>
                            <div class="col-md-3 d-grid">
                                <button type="submit" class="btn" style="background: #111; color: #fff; font-weight: 600; border-radius: 8px;">Send your query</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="pt-5 pb-3" style="background: #f8fafc;">
        <div class="container">
            <div class="row align-items-start gy-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-2">
                        <div style="width: 36px; height: 36px; background: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                            <span style="color: #fff; font-size: 1.5rem; font-weight: bold;">C</span>
                        </div>
                        <span class="fw-bold fs-5" style="letter-spacing: 1px;">ClarityUI</span>
                    </div>
                    <p class="text-muted small mb-3" style="max-width: 260px;">Clarity gives you the blocks and components you need to create a truly professional website.</p>
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
