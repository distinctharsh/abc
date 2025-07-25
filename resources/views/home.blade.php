<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClarityUI - Landingfolio Kit</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">ClarityUI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0" style="margin-bottom: 12px;">
                    <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
                </ul>
            </div>
            <a href="#" class="btn btn-outline-dark">Start free trial</a>
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
                    <div style="background: #e7f0fd; border-radius: 24px; min-height: 400px; display: flex; align-items: center; justify-content: center;">
                        <svg width="64" height="64" fill="#94a3b8" viewBox="0 0 24 24">
                            <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2ZM5 5h14v10.17l-3.59-3.58a2 2 0 0 0-2.82 0L5 19V5Zm0 14v-1.17l5.59-5.58a2 2 0 0 1 2.82 0L19 19H5Z"/>
                        </svg>
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
                        <img src="https://via.placeholder.com/400x200?text=Project" class="card-img-bottom" alt="Project Image">
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
                    <img src="https://via.placeholder.com/400x250?text=Testimonial" class="img-fluid rounded-4" alt="Testimonial">
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
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x200?text=Youtube" class="card-img-top" alt="Youtube">
                        <div class="card-body">
                            <small class="text-muted">{{ $yt['author'] }} • {{ $yt['date'] }}</small>
                            <h5 class="card-title mt-2">{{ $yt['title'] }}</h5>
                            <p class="card-text">{{ $yt['desc'] }}</p>
                            <div>
                                @foreach($yt['tags'] as $tag)
                                    <span class="badge bg-light text-dark border me-1">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">10</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="mb-4 text-center">Contact Us</h3>
                    <form class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="First name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email address">
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark px-5">Send your query</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-white border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fw-bold mb-2">ClarityUI</div>
                    <p class="text-muted small">Clarity gives you the blocks and components you need to create a truly professional website.</p>
                    <div>
                        <a href="#" class="me-2 text-dark"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-2 text-dark"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="me-2 text-dark"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <div class="fw-bold mb-2">Company</div>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">About</a></li>
                        <li><a href="#" class="text-muted">Features</a></li>
                        <li><a href="#" class="text-muted">Works</a></li>
                        <li><a href="#" class="text-muted">Career</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <div class="fw-bold mb-2">Help</div>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Customer Support</a></li>
                        <li><a href="#" class="text-muted">Delivery Details</a></li>
                        <li><a href="#" class="text-muted">Terms & Conditions</a></li>
                        <li><a href="#" class="text-muted">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <div class="fw-bold mb-2">Resources</div>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Free ebooks</a></li>
                        <li><a href="#" class="text-muted">Development Tutorial</a></li>
                        <li><a href="#" class="text-muted">New – Blog</a></li>
                        <li><a href="#" class="text-muted">Youtube Playlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4 text-muted small">© Copyright 2022. All Rights Reserved by ClarityUI</div>
        </div>
    </footer>
</body>
</html>
