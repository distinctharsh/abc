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
                                    @elseif($post['platform'] === 'youtube')
                                        @php
                                            $ytUrl = $post['url'];
                                            $yt = $post['yt'] ?? null; // ['type' => 'playlist'|'video', 'playlistId'| 'id']
                                        @endphp
                                        @if($yt && ($yt['type'] ?? '') === 'playlist' && !empty($yt['playlistId'] ?? ''))
                                            <div class="ratio ratio-16x9 w-100" style="max-width:480px;">
                                                <iframe 
                                                    src="https://www.youtube.com/embed/videoseries?list={{ $yt['playlistId'] }}" 
                                                    title="YouTube playlist" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                    allowfullscreen></iframe>
                                            </div>
                                        @elseif($yt && ($yt['type'] ?? '') === 'video' && !empty($yt['id'] ?? ''))
                                            <div class="ratio ratio-16x9 w-100" style="max-width:480px;">
                                                <iframe 
                                                    src="https://www.youtube.com/embed/{{ $yt['id'] }}" 
                                                    title="YouTube video" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                    allowfullscreen></iframe>
                                            </div>
                                        @else
                                            @php
                                                // Fallback: parse URL for video id; if not found treat as channel
                                                $ytParts = parse_url($ytUrl);
                                                $ytPath = $ytParts['path'] ?? '';
                                                parse_str($ytParts['query'] ?? '', $ytQ);
                                                $ytId = '';
                                                if (!empty($ytQ['v'])) { $ytId = $ytQ['v']; }
                                                elseif (preg_match('#^/(?:embed/|shorts/|watch/|live/)?([A-Za-z0-9_-]{6,})#', $ytPath, $m)) { $ytId = $m[1]; }
                                            @endphp
                                            @if($ytId)
                                                <div class="ratio ratio-16x9 w-100" style="max-width:480px;">
                                                    <iframe 
                                                        src="https://www.youtube.com/embed/{{ $ytId }}" 
                                                        title="YouTube video" 
                                                        frameborder="0" 
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                        allowfullscreen></iframe>
                                                </div>
                                            @else
                                                <div class="text-center p-4 w-100" style="height:460px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                                    <i class="fab fa-youtube fa-3x text-danger mb-3"></i>
                                                    <p class="mb-2">YouTube channel preview is not embeddable here.</p>
                                                    <a href="{{ $ytUrl }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                                        View Channel <i class="fas fa-external-link-alt ms-1"></i>
                                                    </a>
                                                </div>
                                            @endif
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
    @if(!empty($videos))
    <section class="mb-5">
        <h2 class="h3 mb-4">Videos</h2>
        <div class="row g-4">
            @foreach($videos as $index => $video)
                @php
                    // Log video data for debugging
                    \Log::info('Processing video ' . ($index + 1) . ':', [
                        'video' => $video,
                        'url' => $video['url'] ?? 'No URL',
                        'title' => $video['title'] ?? 'No Title'
                    ]);

                    $url = trim($video['url'] ?? '#');
                    $title = $video['title'] ?? 'Video ' . ($index + 1);
                    $isYoutube = str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be');
                    $isVimeo = str_contains($url, 'vimeo.com');
                    $embedUrl = '#';
                    $videoId = '';
                    
                    // Extract video ID and create embed URL
                    if ($isYoutube) {
                        // Handle YouTube URLs with list parameters
                        if (preg_match('/[&?]v=([^&\n?#]+)/', $url, $matches) || 
                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/v\/)([^&\n?#]+)/', $url, $matches)) {
                            
                            $videoId = $matches[1];
                            // Clean up video ID (remove query parameters and fragments)
                            $videoId = explode('?', $videoId)[0];
                            $videoId = explode('&', $videoId)[0];
                            $videoId = explode('#', $videoId)[0];
                            
                            if (!empty($videoId)) {
                                // For YouTube videos with list parameters, we need to include the list in the embed URL
                                if (preg_match('/[&?]list=([^&\n?#]+)/', $url, $listMatches)) {
                                    $listId = $listMatches[1];
                                    $embedUrl = "https://www.youtube.com/embed/$videoId?list=$listId";
                                } else {
                                    $embedUrl = "https://www.youtube.com/embed/$videoId";
                                }
                            }
                        }
                    } elseif ($isVimeo) {
                        // Handle Vimeo URLs
                        if (preg_match('/(?:vimeo\.com\/|player\.vimeo\.com\/video\/|vimeo\.com\/video\/)(\d+)/', $url, $matches)) {
                            $videoId = $matches[1];
                            if (!empty($videoId)) {
                                $embedUrl = "https://player.vimeo.com/video/$videoId";
                            }
                        }
                    }
                    
                    // Log the final values for debugging
                    \Log::info('Processed video details:', [
                        'index' => $index + 1,
                        'url' => $url,
                        'videoId' => $videoId,
                        'embedUrl' => $embedUrl,
                        'isYoutube' => $isYoutube,
                        'isVimeo' => $isVimeo
                    ]);
                @endphp
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <div class="ratio ratio-16x9">
                            @if(($isYoutube || $isVimeo) && !empty($videoId))
                                <iframe 
                                    src="{{ $embedUrl }}" 
                                    title="{{ $title }}" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    style="border: none; width: 100%; height: 100%;">
                                </iframe>
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center bg-light h-100 p-3">
                                    <i class="fas fa-play-circle fa-3x text-muted mb-2"></i>
                                    <p class="mb-2 small text-center">{{ $title }}</p>
                                    @if(!empty($url))
                                        <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-external-link-alt me-1"></i> Watch Video
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title mb-0 text-truncate" title="{{ $title }}">{{ $title }}</h6>
                            @if(!empty($video['description']))
                                <p class="small text-muted mt-1 mb-0">{{ Str::limit($video['description'], 60) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

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
                    $url = trim($press['url'] ?? '');
                    $title = $press['title'] ?? null;
                    $domain = parse_url($url, PHP_URL_HOST) ?: $url;
                    
                    // Log press item for debugging
                    \Log::info('Processing press item:', [
                        'type' => $type,
                        'url' => $url,
                        'title' => $title,
                        'domain' => $domain
                    ]);
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex align-items-center">
                            @if($type === 'youtube' || str_contains(strtolower($url), 'youtube.com') || str_contains(strtolower($url), 'youtu.be'))
                                @php $type = 'youtube'; @endphp
                                <i class="fab fa-youtube fa-lg me-2 text-danger"></i>
                                <h6 class="mb-0 small">YouTube Video</h6>
                            @elseif($type === 'facebook' || str_contains(strtolower($url), 'facebook.com'))
                                @php $type = 'facebook'; @endphp
                                <i class="fab fa-facebook fa-lg me-2 text-primary"></i>
                                <h6 class="mb-0 small">Facebook Post</h6>
                            @else
                                <i class="fas fa-newspaper fa-lg me-2 text-secondary"></i>
                                <h6 class="mb-0 small">{{ $title ?: 'Website' }}</h6>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div style="min-height: 260px; max-height: 260px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                @if($type === 'youtube')
                                    @php
                                        $ytId = '';
                                        // Try to extract video ID from various YouTube URL formats
                                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/v\/|youtube\.com\/watch\?.*v=)([^&\n?#]+)/', $url, $matches)) {
                                            $ytId = $matches[1];
                                            // Clean up video ID (remove query parameters and fragments)
                                            $ytId = explode('?', $ytId)[0];
                                            $ytId = explode('&', $ytId)[0];
                                            $ytId = explode('#', $ytId)[0];
                                        }
                                        
                                        $embedUrl = $ytId ? "https://www.youtube.com/embed/$ytId" : '';
                                    @endphp
                                    @if($ytId)
                                        <div class="ratio ratio-16x9 w-100">
                                            <iframe 
                                                src="{{ $embedUrl }}" 
                                                title="{{ $title ?? 'YouTube Video' }}" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen
                                                style="border: none; width: 100%; height: 100%;">
                                            </iframe>
                                        </div>
                                    @else
                                        <div class="text-center p-4">
                                            <i class="fab fa-youtube fa-3x text-danger mb-2"></i>
                                            <p class="mb-2">YouTube Video</p>
                                            <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                                <i class="fab fa-youtube me-1"></i> Watch on YouTube
                                            </a>
                                        </div>
                                    @endif
                                @elseif($type === 'facebook')
                                    @php
                                        $fbUrl = $url;
                                        // Handle Facebook share video links
                                        $isShareVideo = \Illuminate\Support\Str::contains($fbUrl, '/share/v/');
                                        if ($isShareVideo) {
                                            $pathParts = explode('/', trim(parse_url($fbUrl, PHP_URL_PATH), '/'));
                                            $vIndex = array_search('v', $pathParts);
                                            $shareId = $vIndex !== false && isset($pathParts[$vIndex + 1]) ? $pathParts[$vIndex + 1] : null;
                                            if ($shareId) { 
                                                $fbUrl = 'https://www.facebook.com/watch/?v=' . $shareId; 
                                            }
                                        }
                                        
                                        $isVideo = \Illuminate\Support\Str::contains($fbUrl, ['videos/', '/video.php', '/watch/?v=', '/watch/video/']);
                                        $isPost = \Illuminate\Support\Str::contains($fbUrl, ['/posts/', 'story_fbid=', '/permalink/']);
                                        $isPage = !$isVideo && !$isPost;
                                        
                                        // Log Facebook URL processing
                                        \Log::info('Facebook URL processed:', [
                                            'original_url' => $url,
                                            'processed_url' => $fbUrl,
                                            'isVideo' => $isVideo,
                                            'isPost' => $isPost,
                                            'isPage' => $isPage
                                        ]);
                                    @endphp
                                    @if($isVideo)
                                        <iframe src="https://www.facebook.com/plugins/post.php?href={{ urlencode($fbUrl) }}&show_text=true&width=300&height=260" style="border:none;overflow:hidden; width: 100%; height: 260px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                    @else
                                        <iframe src="https://www.facebook.com/plugins/page.php?href={{ urlencode($fbUrl) }}&tabs=timeline&width=300&height=260&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true" style="border:none;overflow:hidden; width: 100%; height: 260px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                    @endif
                                @else
                                    @php
                                        $meta = $press['meta'] ?? [];
                                        $previewTitle = $title ?? ($meta['title'] ?? $domain);
                                        $previewDesc = $meta['description'] ?? 'Click to read more...';
                                        $previewImg = $meta['image'] ?? null;
                                        
                                        // Clean up the URL for display
                                        $displayUrl = str_replace(['http://', 'https://', 'www.'], '', $url);
                                        $displayUrl = rtrim($displayUrl, '/');
                                        
                                        // If no image but we have a URL, try to get a favicon
                                        $faviconUrl = 'https://www.google.com/s2/favicons?domain=' . urlencode($domain) . '&sz=64';
                                        
                                        // Log the meta data for debugging
                                        \Log::info('Website preview data:', [
                                            'url' => $url,
                                            'meta' => $meta,
                                            'title' => $previewTitle,
                                            'has_image' => !empty($previewImg),
                                            'domain' => $domain
                                        ]);
                                    @endphp
                                    
                                    <div class="w-100 h-100 d-flex flex-column">
                                        @if($previewImg)
                                            <div class="w-100" style="border-bottom: 1px solid #eee;">
                                                <div class="ratio ratio-16x9">
                                                    <div class="position-relative w-100 h-100">
                                                        <img src="{{ $previewImg }}" alt="{{ $previewTitle }}" 
                                                             class="w-100 h-100"
                                                             style="object-fit: cover;"
                                                             onerror="this.closest('.ratio').classList.add('d-none'); this.closest('.position-relative').querySelector('.press-fallback').classList.remove('d-none');">
                                                        <div class="press-fallback d-none d-flex align-items-center justify-content-center bg-light w-100 h-100">
                                                            <div class="position-absolute bottom-0 start-0 end-0 p-2" style="background: rgba(0,0,0,0.5);">
                                                                <p class="text-white small mb-0">{{ Str::limit($previewTitle, 60) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="p-3">
                                            <div class="d-flex align-items-center mb-2">
                                                @if($faviconUrl)
                                                    <img src="{{ $faviconUrl }}" alt="favicon" class="me-2" width="16" height="16">
                                                @endif
                                                <span class="small text-muted">{{ $displayUrl }}</span>
                                            </div>
                                            <h6 class="mb-2">
                                                <a href="{{ $url }}" target="_blank" class="text-decoration-none text-dark">
                                                    {{ Str::limit($previewTitle, 60) }}
                                                </a>
                                            </h6>
                                            @if($previewDesc)
                                                <p class="small text-muted mb-2">{{ Str::limit($previewDesc, 100) }}</p>
                                            @endif
                                        </div>
                                    </div>
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
    
    /* Video Player Styles */
    .video-card {
        transition: all 0.3s ease;
    }
    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .video-thumbnail {
        position: relative;
        cursor: pointer;
        overflow: hidden;
    }
    .video-thumbnail iframe {
        border: none;
        width: 100%;
        height: 100%;
    }
    .play-button {
        transition: all 0.3s ease;
    }
    .play-button:hover .play-icon {
        transform: scale(1.1);
        background: rgba(255,255,255,0.9);
    }
    .text-vimeo {
        color: #1ab7ea;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle video player clicks
    document.querySelectorAll('.video-player').forEach(player => {
        const playButton = player.querySelector('.play-button');
        const embedUrl = player.dataset.embed;
        const thumbnail = player.dataset.thumbnail;
        let iframe = null;
        
        playButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create iframe if it doesn't exist
            if (!iframe) {
                iframe = document.createElement('iframe');
                iframe.setAttribute('src', embedUrl + (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1');
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allowfullscreen', '');
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.style.position = 'absolute';
                iframe.style.top = '0';
                iframe.style.left = '0';
                
                // Replace the thumbnail with the iframe
                player.innerHTML = '';
                player.appendChild(iframe);
                
                // Add a class to indicate the video is playing
                player.classList.add('playing');
            }
        });
        
        // Handle hover effects
        player.addEventListener('mouseenter', function() {
            if (!player.classList.contains('playing')) {
                playButton.style.opacity = '1';
            }
        });
        
        player.addEventListener('mouseleave', function() {
            if (!player.classList.contains('playing')) {
                playButton.style.opacity = '0.9';
            }
        });
    });
    
    // Initialize microlink for link previews if available
    if (window.microlink) {
        window.microlink('.microlink');
    }
});
</script>
@endpush

@endsection
