@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <img src="{{ asset('images/' . $itemData['image']) }}" 
                     alt="{{ $itemData['title'] }}" 
                     class="img-fluid rounded-circle mb-4" 
                     style="width: 200px; height: 200px; object-fit: cover;">
                <h1 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #a96ee4 0%, #46ff46 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    {{ $itemData['title'] }}
                </h1>
                <p class="lead text-muted">{{ $itemData['description'] }}</p>
            </div>

            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4">
                    <div class="content">
                        <p>{{ $itemData['full_content'] }}</p>
                        
                        <!-- Add any additional content specific to this item here -->
                        @if(isset($itemData['videos']))
                            <div class="mt-4">
                                <h4 class="mb-3">Related Videos</h4>
                                <div class="row g-3">
                                    @foreach($itemData['videos'] as $video)
                                    <div class="col-md-6">
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe src="https://www.youtube.com/embed/{{ $video['id'] }}" 
                                                    title="{{ $video['title'] }}" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                        <h5 class="mt-2">{{ $video['title'] }}</h5>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ url()->previous() }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i> Back to {{ $sectionData['title'] }}
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary ms-2">
                    <i class="fas fa-home me-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
