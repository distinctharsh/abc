<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Highlights - ClarityUI</title>
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
        <div class="container-fluid navbar-container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="nav-logo">
            </a>
            
            <!-- Navigation Links -->
            <div class="d-flex align-items-center nav-links">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
                <a class="nav-link active" href="{{ route('youtube-highlights.index') }}">YouTube Highlights</a>
                <a class="nav-link" href="#">Feature</a>
                <a class="nav-link" href="#">Pricing</a>
            </div>
            
            <!-- Start Free Trial Button -->
            <button class="btn start-trial-btn">
                Start Free Trial
            </button>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <!-- <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">YouTube Highlights</h1>
                <p class="lead text-muted">Discover the best educational content and insights from our curated collection</p>
                <a href="{{ route('youtube-highlights.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Highlight
                </a>
            </div> -->

            <!-- Search and Filter Section -->
            <div class="row mb-4">
                <!-- <div class="col-md-8">
                    <form method="GET" action="{{ route('youtube-highlights.index') }}" class="d-flex">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control me-2" placeholder="Search videos, authors, or descriptions...">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div> -->
                <!-- <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <select name="tag" class="form-select" onchange="this.form.submit()">
                            <option value="">All Tags</option>
                            @foreach($allTags as $tag)
                                <option value="{{ $tag }}" {{ request('tag') == $tag ? 'selected' : '' }}>
                                    {{ $tag }}
                                </option>
                            @endforeach
                        </select>
                        <a href="{{ route('youtube-highlights.index', array_merge(request()->query(), ['featured' => request('featured') ? null : '1'])) }}" 
                           class="btn btn-outline-primary">
                            {{ request('featured') ? 'Show All' : 'Featured Only' }}
                        </a>
                    </div>
                </div> -->
            </div>

            <!-- Results Info -->
            @if(request('search') || request('tag') || request('featured'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Showing {{ $highlights->total() }} result(s)
                    @if(request('search'))
                        for "{{ request('search') }}"
                    @endif
                    @if(request('tag'))
                        in tag "{{ request('tag') }}"
                    @endif
                    @if(request('featured'))
                        (featured videos only)
                    @endif
                    <a href="{{ route('youtube-highlights.index') }}" class="float-end">Clear filters</a>
                </div>
            @endif
        </div>
    </section>

    <!-- YouTube Highlights Grid -->
    <section class="py-5">
        <div class="container">
            @if($highlights->count() > 0)
                <div class="row g-4">
                    @foreach($highlights as $highlight)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 bg-transparent h-100">
                            <div class="position-relative">
                                <img src="{{ $highlight->thumbnail_url }}" class="card-img-top rounded-3 mb-3" 
                                     alt="{{ $highlight->title }}" style="height: 200px; object-fit: cover;">
                                @if($highlight->is_featured)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark">
                                        <i class="fas fa-star"></i> Featured
                                    </span>
                                @endif
                            </div>
                            <div class="card-body p-0">
                                <small class="d-block mb-1" style="color: #6c3ef5; font-weight: 500;">
                                    {{ $highlight->author }} • {{ $highlight->formatted_date }}
                                </small>
                                <div class="d-flex align-items-center mb-1">
                                    <h5 class="card-title fw-bold mb-0 flex-grow-1">{{ $highlight->title }}</h5>
                                    <span class="ms-2" style="font-size: 1.1em; color: #888;">&#8599;</span>
                                </div>
                                <p class="card-text text-muted mb-2" style="font-size: 0.97em;">
                                    {{ Str::limit($highlight->description, 120) }}
                                </p>
                                
                                <!-- Stats -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-eye"></i> {{ number_format($highlight->views) }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-heart"></i> {{ number_format($highlight->likes) }}
                                    </small>
                                </div>
                                
                                <!-- Tags -->
                                <div class="mb-2">
                                    @foreach($highlight->tags as $tag)
                                        <span class="badge rounded-pill px-3 py-2 me-1 mb-1" 
                                              style="background: #f4f4f6; color: #6c3ef5; font-weight: 500; font-size: 0.95em;">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    @if($highlight->video_url)
                                        <a href="{{ $highlight->video_url }}" target="_blank" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fab fa-youtube"></i> Watch
                                        </a>
                                    @endif
                                    <a href="{{ route('youtube-highlights.show', $highlight) }}" 
                                       class="btn btn-outline-secondary btn-sm">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper mt-5">
                    {{ $highlights->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No videos found</h4>
                    <p class="text-muted">Try adjusting your search criteria or filters.</p>
                    <a href="{{ route('youtube-highlights.index') }}" class="btn btn-primary">
                        View All Videos
                    </a>
                </div>
            @endif
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
                        <li class="mb-1"><a href="{{ route('youtube-highlights.index') }}" class="text-muted text-decoration-none">Youtube Playlist</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: #e5e7eb;">
            <div class="text-center text-muted small" style="letter-spacing: 0.5px;">© Copyright 2022. All Rights Reserved by ClarityUI</div>
        </div>
    </footer>

    <script>
        // Auto-submit form when tag filter changes
        document.querySelector('select[name="tag"]').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
</body>
</html> 