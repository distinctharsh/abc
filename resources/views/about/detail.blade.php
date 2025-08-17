@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">{{ $about->title }}</h1>
            <p class="lead">{{ $about->description }}</p>
        </div>
        @if($about->image)
        <div class="col-lg-6">
            <img src="{{ asset($about->image) }}" alt="{{ $about->title }}" class="img-fluid rounded shadow">
        </div>
        @endif
    </div>

    <!-- Content Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    {!! $about->content !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Social Media Posts Section -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Social Media Updates</h2>
            <div>
                <button class="btn btn-sm btn-outline-secondary me-2" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        
        <div class="position-relative">
            <div class="social-slider-container">
                <div class="social-slider" id="socialMediaContainer">
                    @foreach($socialMediaPosts as $post)
                    <div class="social-slide">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-white d-flex align-items-center">
                                <i class="fab fa-{{ $post['platform'] }} fa-lg me-2 text-{{ 
                                    $post['platform'] === 'facebook' ? 'primary' : 
                                    ($post['platform'] === 'twitter' ? 'info' : 'danger') 
                                }}"></i>
                                <h6 class="mb-0 small">{{ ucfirst($post['platform']) }}</h6>
                            </div>
                            <div class="card-body p-0">
                                <div style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                    @if($post['platform'] === 'facebook')
                                        @if(str_contains($post['url'], 'videos/'))
                                            <iframe 
                                                src="https://www.facebook.com/plugins/video.php?href={{ urlencode($post['url']) }}&show_text=0&width=300" 
                                                style="border:none;overflow:hidden; width: 100%; height: 100%;" 
                                                scrolling="no" 
                                                frameborder="0" 
                                                allowfullscreen="true" 
                                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                            </iframe>
                                        @else
                                            <iframe 
                                                src="https://www.facebook.com/plugins/post.php?href={{ urlencode($post['url']) }}&show_text=true&width=300" 
                                                style="border:none;overflow:hidden; width: 100%; height: 100%;" 
                                                scrolling="no" 
                                                frameborder="0" 
                                                allowfullscreen="true" 
                                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                            </iframe>
                                        @endif
                                    @elseif($post['platform'] === 'twitter' || $post['platform'] === 'x')
                                        @php
                                            // Extract status ID from Twitter URL
                                            $urlParts = explode('/', rtrim($post['url'], '/'));
                                            $statusId = $urlParts[array_search('status', $urlParts) + 1] ?? '';
                                        @endphp
                                        @if($statusId)
                                            <blockquote class="twitter-tweet" data-theme="light" data-dnt="true">
                                                <a href="https://twitter.com/x/status/{{ $statusId }}"></a>
                                            </blockquote>
                                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                        @else
                                            <div class="text-center p-4">
                                                <i class="fab fa-twitter fa-3x text-muted mb-2"></i>
                                                <p class="mb-0">Twitter post not available</p>
                                                <a href="{{ $post['url'] }}" target="_blank" class="btn btn-sm btn-outline-info mt-2">
                                                    View on X <i class="fas fa-external-link-alt ms-1"></i>
                                                </a>
                                            </div>
                                        @endif
                                    @elseif($post['platform'] === 'instagram')
                                        <iframe 
                                            src="https://www.instagram.com/p/{{ last(explode('/', rtrim(parse_url($post['url'], PHP_URL_PATH), '/'))) }}/embed" 
                                            style="border:none;overflow:hidden; width: 300px; height: 100%;" 
                                            scrolling="no" 
                                            frameborder="0" 
                                            allowfullscreen="true" 
                                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                        </iframe>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <a href="{{ $post['url'] }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                    View Post <i class="fas fa-external-link-alt ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Add New Post Form -->
        <!-- <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Add New Social Media Post</h5>
            </div>
            <div class="card-body">
                <form id="addPostForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Platform</label>
                        <select class="form-select" id="platformSelect">
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="instagram">Instagram</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Post URL</label>
                        <input type="url" class="form-control" id="postUrl" placeholder="https://" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Preview Post</button>
                </form>
            </div>
        </div> -->
    </section>

    @push('styles')
    <style>
        .social-slider-container {
            overflow: hidden;
            position: relative;
            padding: 10px 0;
        }
        .social-slider {
            display: flex;
            gap: 20px;
            transition: transform 0.3s ease;
            padding: 10px 5px;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        .social-slider::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .social-slide {
            flex: 0 0 300px;
            height: 350px;
        }
        .social-slide .card {
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .social-slide .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
    @endpush

    @push('scripts')
    <!-- Twitter widgets.js is loaded dynamically when needed -->
    <script>
        // Social Media Slider Navigation
        const slider = document.getElementById('socialMediaContainer');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const slideWidth = 320; // 300px card + 20px gap
        
        let scrollPosition = 0;
        
        // Next button click
        nextBtn.addEventListener('click', () => {
            scrollPosition += slideWidth;
            if (scrollPosition > slider.scrollWidth - slider.clientWidth) {
                scrollPosition = slider.scrollWidth - slider.clientWidth;
            }
            slider.scrollTo({
                left: scrollPosition,
                behavior: 'smooth'
            });
        });
        
        // Previous button click
        prevBtn.addEventListener('click', () => {
            scrollPosition -= slideWidth;
            if (scrollPosition < 0) {
                scrollPosition = 0;
            }
            slider.scrollTo({
                left: scrollPosition,
                behavior: 'smooth'
            });
        });
        
        // Function to load Twitter widgets
        function loadTwitterWidgets() {
            if (window.twttr && window.twttr.widgets) {
                window.twttr.widgets.load();
            } else if (window.twttr) {
                window.twttr.ready(function(twttr) {
                    twttr.widgets.load();
                });
            }
        }

        // Add new post functionality
        document.getElementById('addPostForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const platform = document.getElementById('platformSelect').value;
            const url = document.getElementById('postUrl').value;
            
            if (!url) return;
            
            const slide = document.createElement('div');
            slide.className = 'social-slide';
            
            // Create a unique ID for the iframe to avoid conflicts
            const iframeId = 'post-' + Math.random().toString(36).substr(2, 9);
            
            let embedHtml = '';
            
            if (platform === 'facebook') {
                const isVideo = url.includes('videos/');
                embedHtml = `
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex align-items-center">
                            <i class="fab fa-${platform} fa-lg me-2 text-primary"></i>
                            <h6 class="mb-0 small">${platform.charAt(0).toUpperCase() + platform.slice(1)}</h6>
                        </div>
                        <div class="card-body p-0">
                            <div style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                <iframe 
                                    id="${iframeId}"
                                    src="https://www.facebook.com/plugins/${isVideo ? 'video' : 'post'}.php?href=${encodeURIComponent(url)}&show_text=true&width=300" 
                                    style="border:none;overflow:hidden; width: 100%; height: 100%;" 
                                    scrolling="no" 
                                    frameborder="0" 
                                    allowfullscreen="true" 
                                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                </iframe>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <a href="${url}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                View Post <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </div>
                    </div>
                `;
            } else if (platform === 'twitter' || platform === 'x') {
                // Extract status ID from Twitter URL
                const urlParts = url.split('/');
                const statusIndex = urlParts.findIndex(part => part === 'status');
                const statusId = statusIndex !== -1 ? urlParts[statusIndex + 1] : '';
                
                if (statusId) {
                    embedHtml = `
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-white d-flex align-items-center">
                                <i class="fab fa-twitter fa-lg me-2 text-info"></i>
                                <h6 class="mb-0 small">Twitter</h6>
                            </div>
                            <div class="card-body p-0">
                                <div style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa; padding: 10px;">
                                    <blockquote class="twitter-tweet" data-theme="light" data-dnt="true">
                                        <a href="https://twitter.com/x/status/${statusId}"></a>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <a href="${url}" target="_blank" class="btn btn-sm btn-outline-info w-100">
                                    View on X <i class="fas fa-external-link-alt ms-1"></i>
                                </a>
                            </div>
                        </div>
                    `;
                } else {
                    // Fallback for invalid Twitter URLs
                    embedHtml = `
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-white d-flex align-items-center">
                                <i class="fab fa-twitter fa-lg me-2 text-info"></i>
                                <h6 class="mb-0 small">Twitter</h6>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <div class="text-center p-4">
                                    <i class="fab fa-twitter fa-3x text-muted mb-2"></i>
                                    <p class="mb-0">Could not load this post</p>
                                    <a href="${url}" target="_blank" class="btn btn-sm btn-outline-info mt-2">
                                        View on X <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                }
            } else if (platform === 'instagram') {
                const postId = url.split('/').filter(Boolean).pop();
                embedHtml = `
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex align-items-center">
                            <i class="fab fa-instagram fa-lg me-2 text-danger"></i>
                            <h6 class="mb-0 small">Instagram</h6>
                        </div>
                        <div class="card-body p-0">
                            <div style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                <iframe 
                                    id="${iframeId}"
                                    src="https://www.instagram.com/p/${postId}/embed" 
                                    style="border:none;overflow:hidden; width: 300px; height: 100%;" 
                                    scrolling="no" 
                                    frameborder="0" 
                                    allowfullscreen="true" 
                                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                </iframe>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <a href="${url}" target="_blank" class="btn btn-sm btn-outline-danger w-100">
                                View on Instagram <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </div>
                    </div>
                `;
            }
            
            slide.innerHTML = embedHtml;
            
            // Add the new slide at the beginning of the slider
            slider.insertBefore(slide, slider.firstChild);
            
            // Load Twitter widgets if this is a Twitter post
            if (platform === 'twitter' || platform === 'x') {
                // Check if Twitter widgets.js is already loaded
                if (!document.querySelector('script[src*="platform.twitter.com/widgets.js"]')) {
                    const script = document.createElement('script');
                    script.src = 'https://platform.twitter.com/widgets.js';
                    script.charset = 'utf-8';
                    script.async = true;
                    script.onload = loadTwitterWidgets;
                    document.body.appendChild(script);
                } else {
                    loadTwitterWidgets();
                }
            }
            
            // Reset the form
            document.getElementById('postUrl').value = '';
            
            // Scroll to show the newly added slide
            scrollPosition = 0;
            slider.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
        });
    </script>
    @endpush

    <!-- Video Section -->
    <section class="mb-5">
        <h2 class="h3 mb-4">Videos</h2>
        <div class="row g-4">
            @foreach($videos as $video)
            <div class="col-md-6">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/{{ $video['id'] }}" 
                            title="{{ $video['title'] }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </div>
                <h5 class="mt-2">{{ $video['title'] }}</h5>
            </div>
            @endforeach
        </div>
    </section>
</div>

<style>
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    .gallery-item:hover {
        transform: translateY(-5px);
    }
    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 8px;
        font-size: 0.9rem;
        text-align: center;
    }
</style>
@endsection
