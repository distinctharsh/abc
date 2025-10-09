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
            <!-- <div>
                <button class="btn btn-sm btn-outline-secondary me-2" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div> -->
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
                                <div style="height: 500px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                    @if($post['platform'] === 'facebook')
                                        @php
                                            $url = $post['url'];
                                            // Handle Facebook share video links e.g., /share/v/{id}
                                            $isShareVideo = \Illuminate\Support\Str::contains($url, '/share/v/');
                                            if ($isShareVideo) {
                                                // try to convert to a watch URL which is embeddable
                                                $parts = explode('/', trim(parse_url($url, PHP_URL_PATH), '/'));
                                                $vIndex = array_search('v', $parts);
                                                $shareId = $vIndex !== false && isset($parts[$vIndex + 1]) ? $parts[$vIndex + 1] : null;
                                                if ($shareId) {
                                                    $url = 'https://www.facebook.com/watch/?v=' . $shareId;
                                                }
                                            }
                                            $isVideo = \Illuminate\Support\Str::contains($url, ['videos/', '/video.php', '/watch/?v=']);
                                            $isPost  = \Illuminate\Support\Str::contains($url, ['/posts/', 'story_fbid=']);
                                            $isPage  = !$isVideo && !$isPost; // profile/page link
                                        @endphp
                                        @if($isVideo)
                                            <iframe 
                                                src="https://www.facebook.com/plugins/video.php?href={{ urlencode($url) }}&show_text=0&width=300&height=500" 
                                                style="border:none;overflow:hidden; width: 100%; height: 500px;" 
                                                scrolling="no" 
                                                frameborder="0" 
                                                allowfullscreen="true" 
                                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                            </iframe>
                                        @elseif($isPost)
                                            <iframe 
                                                src="https://www.facebook.com/plugins/post.php?href={{ urlencode($url) }}&show_text=true&width=300&height=500" 
                                                style="border:none;overflow:hidden; width: 100%; height: 500px;" 
                                                scrolling="no" 
                                                frameborder="0" 
                                                allowfullscreen="true" 
                                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                            </iframe>
                                        @else
                                            <!-- Fallback to Page Plugin when a profile/page URL is provided -->
                                            <iframe
                                                src="https://www.facebook.com/plugins/page.php?href={{ urlencode($url) }}&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true"
                                                style="border:none;overflow:hidden; width: 100%; height: 500px;"
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
                                        @php
                                            $igUrl = $post['url'];
                                            $path = parse_url($igUrl, PHP_URL_PATH) ?? '';
                                            $isMedia = \Illuminate\Support\Str::contains($path, ['/p/', '/reel/', '/tv/']);
                                        @endphp
                                        @if($isMedia)
                                            @php
                                                $segments = array_values(array_filter(explode('/', trim($path, '/'))));
                                                $mediaId = end($segments);
                                            @endphp
                                            <iframe 
                                                src="https://www.instagram.com/p/{{ $mediaId }}/embed" 
                                                style="border:none;overflow:hidden; width: 300px; height: 500px;" 
                                                scrolling="no" 
                                                frameborder="0" 
                                                allowfullscreen="true" 
                                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                            </iframe>
                                        @else
                                            <div class="text-center p-4 w-100" style="height:460px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                                <i class="fab fa-instagram fa-3x text-danger mb-3"></i>
                                                <p class="mb-2">Profile embeds are not supported. Open the Instagram profile to view posts.</p>
                                                <a href="{{ $igUrl }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                                    View Profile <i class="fas fa-external-link-alt ms-1"></i>
                                                </a>
                                            </div>
                                        @endif
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
            height: 620px; /* header (~60) + embed (500) + footer (~60) */
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

    <!-- Press Coverage Section -->
    @if(!empty($pressItems ?? []))
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Press Coverage</h2>
        </div>

        <div class="row g-4">
            @foreach($pressItems as $press)
                @php
                    $type = strtolower($press['type'] ?? 'website');
                    $url  = $press['url'] ?? '';
                    $title = $press['title'] ?? null;
                    $domain = parse_url($url, PHP_URL_HOST) ?: $url;
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex align-items-center">
                            @if($type === 'youtube')
                                <i class="fab fa-youtube fa-lg me-2 text-danger"></i>
                                <h6 class="mb-0 small">YouTube</h6>
                            @elseif($type === 'facebook')
                                <i class="fab fa-facebook fa-lg me-2 text-primary"></i>
                                <h6 class="mb-0 small">Facebook</h6>
                            @else
                                <i class="fas fa-newspaper fa-lg me-2 text-secondary"></i>
                                <h6 class="mb-0 small">Website</h6>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div style="height: 260px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                @if($type === 'youtube')
                                    @php
                                        $ytId = '';
                                        $parts = parse_url($url);
                                        $path = $parts['path'] ?? '';
                                        parse_str($parts['query'] ?? '', $q);
                                        if (!empty($q['v'])) { $ytId = $q['v']; }
                                        elseif (preg_match('#^/(?:embed/|shorts/|watch/|live/)?([A-Za-z0-9_-]{6,})#', $path, $m)) { $ytId = $m[1]; }
                                    @endphp
                                    @if($ytId)
                                        <div class="ratio ratio-16x9 w-100">
                                            <iframe src="https://www.youtube.com/embed/{{ $ytId }}" title="YouTube video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    @else
                                        <div class="text-center p-4">
                                            <i class="fab fa-youtube fa-3x text-danger mb-2"></i>
                                            <p class="mb-0">Unable to preview this YouTube link</p>
                                        </div>
                                    @endif
                                @elseif($type === 'facebook')
                                    @php
                                        $fbUrl = $url;
                                        $isShareVideo = \Illuminate\Support\Str::contains($fbUrl, '/share/v/');
                                        if ($isShareVideo) {
                                            $pathParts = explode('/', trim(parse_url($fbUrl, PHP_URL_PATH), '/'));
                                            $vIndex = array_search('v', $pathParts);
                                            $shareId = $vIndex !== false && isset($pathParts[$vIndex + 1]) ? $pathParts[$vIndex + 1] : null;
                                            if ($shareId) { $fbUrl = 'https://www.facebook.com/watch/?v=' . $shareId; }
                                        }
                                        $isVideo = \Illuminate\Support\Str::contains($fbUrl, ['videos/', '/video.php', '/watch/?v=']);
                                        $isPost  = \Illuminate\Support\Str::contains($fbUrl, ['/posts/', 'story_fbid=']);
                                        $isPage  = !$isVideo && !$isPost;
                                    @endphp
                                    @if($isVideo)
                                        <iframe src="https://www.facebook.com/plugins/video.php?href={{ urlencode($fbUrl) }}&show_text=0&width=300&height=260" style="border:none;overflow:hidden; width: 100%; height: 260px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                    @elseif($isPost)
                                        <iframe src="https://www.facebook.com/plugins/post.php?href={{ urlencode($fbUrl) }}&show_text=true&width=300&height=260" style="border:none;overflow:hidden; width: 100%; height: 260px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                    @else
                                        <iframe src="https://www.facebook.com/plugins/page.php?href={{ urlencode($fbUrl) }}&tabs=timeline&width=300&height=260&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true" style="border:none;overflow:hidden; width: 100%; height: 260px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                    @endif
                                @else
                                    @php
                                        $meta = $press['meta'] ?? [];
                                        $previewTitle = $title ?? ($meta['title'] ?? $domain);
                                        $previewDesc  = $meta['description'] ?? null;
                                        $previewImg   = $meta['image'] ?? null;
                                        $host = parse_url($url, PHP_URL_HOST) ?: $domain;
                                        $favicon = 'https://www.google.com/s2/favicons?domain=' . $host . '&sz=64';
                                    @endphp
                                    @if($previewTitle || $previewImg)
                                        <div class="w-100 h-100 d-flex align-items-stretch">
                                            <div class="w-100 d-flex flex-column" style="overflow:hidden;">
                                                @if($previewImg)
                                                    <div class="position-relative w-100">
                                                        <div class="ratio ratio-16x9 w-100">
                                                            <img src="{{ $previewImg }}" alt="{{ $previewTitle }}" style="object-fit: cover; width:100%; height:100%;"
                                                                 onerror="this.closest('.ratio').classList.add('d-none'); this.closest('.position-relative').querySelector('.press-fallback').classList.remove('d-none');">
                                                        </div>
                                                        <div class="press-fallback d-none d-flex align-items-center justify-content-center bg-light" style="height: 160px;">
                                                            <img src="{{ $favicon }}" alt="favicon" class="me-2" width="32" height="32">
                                                            <span class="text-muted small">{{ $host }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 160px;">
                                                        <img src="{{ $favicon }}" alt="favicon" class="me-2" width="32" height="32">
                                                        <span class="text-muted small">{{ $host }}</span>
                                                    </div>
                                                @endif
                                                <div class="p-3" style="min-height: 100px;">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <img src="{{ $favicon }}" alt="favicon" class="me-2" width="16" height="16">
                                                        <span class="small text-muted">{{ $host }}</span>
                                                    </div>
                                                    <div class="fw-semibold text-truncate" title="{{ $previewTitle }}">{{ $previewTitle }}</div>
                                                    @if($previewDesc)
                                                        <div class="text-muted small mt-1" style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                                            {{ $previewDesc }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="p-3 w-100">
                                            <a class="microlink" href="{{ $url }}" data-size="large"></a>
                                        </div>
                                        @push('scripts')
                                            <script src="https://cdn.jsdelivr.net/npm/microlinkjs@latest/dist/microlink.min.js"></script>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function(){
                                                    if (window.microlink) window.microlink('.microlink');
                                                });
                                            </script>
                                        @endpush
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="small text-muted text-truncate">{{ $title ?? $domain }}</div>
                            <a href="{{ $url }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary w-100 mt-2">
                                Read Full <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

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
