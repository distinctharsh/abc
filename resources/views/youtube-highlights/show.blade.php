<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $youtubeHighlight->title }} - YouTube Highlights</title>
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

    <!-- Video Detail Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Video Thumbnail -->
                    <div class="position-relative mb-4">
                        <img src="{{ $youtubeHighlight->thumbnail_url }}" 
                             class="img-fluid rounded-3 w-100" 
                             alt="{{ $youtubeHighlight->title }}"
                             style="max-height: 400px; object-fit: cover;">
                        @if($youtubeHighlight->video_url)
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <a href="{{ $youtubeHighlight->video_url }}" target="_blank" 
                                   class="btn btn-danger btn-lg rounded-circle">
                                    <i class="fab fa-youtube fa-2x"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Video Info -->
                    <div class="mb-4">
                        <h1 class="fw-bold mb-3">{{ $youtubeHighlight->title }}</h1>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-3">
                                    <i class="fas fa-eye"></i> {{ number_format($youtubeHighlight->views) }} views
                                </small>
                                <small class="text-muted me-3">
                                    <i class="fas fa-heart"></i> {{ number_format($youtubeHighlight->likes) }} likes
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> {{ $youtubeHighlight->formatted_date }}
                                </small>
                            </div>
                            @if($youtubeHighlight->is_featured)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            @endif
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <strong>{{ $youtubeHighlight->author }}</strong>
                                    <div class="text-muted small">Content Creator</div>
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            @foreach($youtubeHighlight->tags as $tag)
                                <span class="badge rounded-pill px-3 py-2 me-2 mb-2" 
                                      style="background: #f4f4f6; color: #6c3ef5; font-weight: 500;">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>

                        <!-- Description -->
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-3">Description</h5>
                                <p class="card-text">{{ $youtubeHighlight->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Related Videos -->
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Related Videos</h5>
                            @php
                                $relatedVideos = \App\Models\YoutubeHighlight::where('id', '!=', $youtubeHighlight->id)
                                    ->where(function($query) use ($youtubeHighlight) {
                                        foreach($youtubeHighlight->tags as $tag) {
                                            $query->orWhereJsonContains('tags', $tag);
                                        }
                                    })
                                    ->latest()
                                    ->take(3)
                                    ->get();
                            @endphp
                            
                            @foreach($relatedVideos as $video)
                                <div class="d-flex mb-3">
                                    <img src="{{ $video->thumbnail_url }}" 
                                         class="rounded me-3" 
                                         alt="{{ $video->title }}"
                                         style="width: 80px; height: 60px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">
                                            <a href="{{ route('youtube-highlights.show', $video) }}" 
                                               class="text-decoration-none text-dark">
                                                {{ Str::limit($video->title, 50) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ $video->author }}</small>
                                        <div class="text-muted small">
                                            {{ number_format($video->views) }} views
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card border-0 bg-light mt-3">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Quick Actions</h5>
                            <div class="d-grid gap-2">
                                @if($youtubeHighlight->video_url)
                                    <a href="{{ $youtubeHighlight->video_url }}" target="_blank" 
                                       class="btn btn-danger">
                                        <i class="fab fa-youtube"></i> Watch on YouTube
                                    </a>
                                @endif
                                <a href="{{ route('youtube-highlights.index') }}" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-list"></i> View All Highlights
                                </a>
                                <button class="btn btn-outline-secondary" onclick="shareVideo()">
                                    <i class="fas fa-share"></i> Share Video
                                </button>
                            </div>
                        </div>
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
        function shareVideo() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $youtubeHighlight->title }}',
                    text: '{{ $youtubeHighlight->description }}',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(window.location.href).then(function() {
                    alert('Link copied to clipboard!');
                });
            }
        }
    </script>
</body>
</html> 