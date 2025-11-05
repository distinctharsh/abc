@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Section Title and Description --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #a96ee4 0%, #46ff46 100%);
             -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $sectionData['title'] }}
        </h1>
        <p class="lead text-muted">{{ $sectionData['description'] }}</p>
    </div>

    {{-- Render the full_content raw HTML --}}
    <div class="adda-section">
        {!! $sectionData['full_content'] !!}
    </div>

    {{-- Optional: If you want to show the card grid from content --}}
    {{-- 
    <div class="row g-4 mt-5">
        @foreach($sectionData['content'] as $key => $item)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="position-relative" style="height: 200px; overflow: hidden;">
                    <img src="{{ asset('images/' . $item['image']) }}" 
                         class="card-img-top h-100" 
                         alt="{{ $item['title'] }}" 
                         style="object-fit: cover; width: 100%;">
                    <div class="card-img-overlay d-flex align-items-end" style="background: rgba(0,0,0,0.5);">
                        <div>
                            <h5 class="text-white mb-1">{{ $item['title'] }}</h5>
                            <p class="text-white-50 mb-0">{{ $item['description'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-outline-primary w-100">
                        View Details <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    --}}

</div>
@endsection

