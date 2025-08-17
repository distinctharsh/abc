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
        <h2 class="h3 mb-4">Social Media Updates</h2>
        <div class="row g-4">
            @foreach($socialMediaPosts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white d-flex align-items-center">
                        <i class="fab fa-{{ $post['platform'] }} fa-2x me-2 text-{{ 
                            $post['platform'] === 'facebook' ? 'primary' : 
                            ($post['platform'] === 'twitter' ? 'info' : 'danger') 
                        }}"></i>
                        <div>
                            <h6 class="mb-0">{{ ucfirst($post['platform']) }}</h6>
                            <small class="text-muted">{{ $post['date'] }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $post['content'] }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                        <span class="text-muted">
                            <i class="far fa-heart me-1"></i> {{ $post['likes'] ?? 0 }}
                        </span>
                        <span class="text-muted">
                            <i class="far fa-comment me-1"></i> {{ $post['comments'] ?? 0 }}
                        </span>
                        @if(isset($post['shares']))
                        <span class="text-muted">
                            <i class="fas fa-share me-1"></i> {{ $post['shares'] }}
                        </span>
                        @elseif(isset($post['retweets']))
                        <span class="text-muted">
                            <i class="fas fa-retweet me-1"></i> {{ $post['retweets'] }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

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
