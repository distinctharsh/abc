@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                @if($about->image)
                <img src="{{ asset($about->image) }}" class="card-img-top" alt="{{ $about->title }}">
                @endif
                <div class="card-body p-4">
                    <h1 class="h2 mb-4">{{ $about->title }}</h1>
                    <div class="mb-4">
                        {!! $about->content !!}
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
