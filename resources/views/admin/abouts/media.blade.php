@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Media for: {{ $about->title }}</h1>
        <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.abouts.media.update', $about) }}" method="POST" id="mediaForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Social Media Updates -->
                <div class="mb-4">
                    <h4>Social Media Updates</h4>
                    <div id="socialMediaContainer">
                        @if(!empty($about->social_media_updates))
                            @foreach($about->social_media_updates as $index => $update)
                                <div class="row mb-3 social-media-item" data-index="{{ $index }}">
                                    <div class="col-md-5">
                                        <input type="text" name="social_media[{{ $index }}][platform]" 
                                               class="form-control mb-2" placeholder="Platform (e.g., Twitter, Facebook)" 
                                               value="{{ $update['platform'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="url" name="social_media[{{ $index }}][url]" 
                                               class="form-control mb-2" placeholder="Post URL" 
                                               value="{{ $update['url'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-social-media">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addSocialMedia">
                        <i class="fas fa-plus"></i> Add Social Media Update
                    </button>
                </div>

                <!-- Videos -->
                <div class="mb-4">
                    <h4>Videos</h4>
                    <div id="videosContainer">
                        <!-- Videos will be added here by JavaScript -->
                    </div>
                    
                    @push('scripts')
                    <script>
                    // Wait for the DOM to be fully loaded
                    function initializeVideos() {
                        // Check if addVideoItem is defined
                        if (typeof addVideoItem === 'function') {
                            // Clear any existing content
                            const container = document.getElementById('videosContainer');
                            if (container) container.innerHTML = '';
                            
                            // Initialize existing videos
                            @if(!empty($about->videos) && is_array($about->videos))
                                @foreach($about->videos as $index => $video)
                                    @if(is_array($video) && !empty($video['url']))
                                        addVideoItem(@json($video), {{ $index }});
                                    @endif
                                @endforeach
                            @endif
                            
                            // If no videos, add one empty field
                            if (document.querySelectorAll('.video-item').length === 0) {
                                addVideoItem();
                            }
                        } else {
                            // If addVideoItem is not defined yet, wait a bit and try again
                            setTimeout(initializeVideos, 100);
                        }
                    }
                    
                    // Run initialization when the document is ready
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initializeVideos);
                    } else {
                        initializeVideos();
                    }
                    </script>
                    @endpush
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addVideo">
                        <i class="fas fa-plus"></i> Add Video
                    </button>
                </div>

                <!-- Press Coverage -->
                <div class="mb-4">
                    <h4>Press Coverage</h4>
                    <div id="pressContainer">
                        @if(!empty($about->press_coverage))
                            @foreach($about->press_coverage as $index => $press)
                                <div class="row mb-3 press-item" data-index="{{ $index }}">
                                    <div class="col-md-3">
                                        <input type="text" name="press_coverage[{{ $index }}][source]" 
                                               class="form-control mb-2" placeholder="Source (e.g., Times of India)" 
                                               value="{{ $press['source'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="press_coverage[{{ $index }}][title]" 
                                               class="form-control mb-2" placeholder="Article Title" 
                                               value="{{ $press['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="url" name="press_coverage[{{ $index }}][url]" 
                                               class="form-control mb-2" placeholder="Article URL" 
                                               value="{{ $press['url'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="date" name="press_coverage[{{ $index }}][date]" 
                                               class="form-control mb-2" 
                                               value="{{ $press['date'] ?? date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm remove-press">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addPress">
                        <i class="fas fa-plus"></i> Add Press Coverage
                    </button>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save All Media
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Templates for dynamic fields -->
<template id="socialMediaTemplate">
    <div class="row mb-3 social-media-item">
        <div class="col-md-5">
            <input type="text" name="social_media_updates[__INDEX__][platform]" 
                   class="form-control mb-2" placeholder="Platform (e.g., Twitter, Facebook)" required>
        </div>
        <div class="col-md-5">
            <input type="url" name="social_media_updates[__INDEX__][url]" 
                   class="form-control mb-2" placeholder="Post URL" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger btn-sm remove-social-media">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</template>

<template id="videoTemplate">
    <div class="row mb-3 video-item">
        <div class="col-md-4">
            <input type="text" name="videos[__INDEX__][title]" 
                   class="form-control mb-2" placeholder="Video Title" required>
        </div>
        <div class="col-md-4">
            <input type="url" name="videos[__INDEX__][url]" 
                   class="form-control mb-2" placeholder="Video URL (YouTube, Vimeo, etc.)" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="videos[__INDEX__][thumbnail]" 
                   class="form-control mb-2" placeholder="Thumbnail URL">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm remove-video">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</template>

<template id="pressTemplate">
    <div class="row mb-3 press-item">
        <div class="col-md-3">
            <input type="text" name="press_coverage[__INDEX__][source]" 
                   class="form-control mb-2" placeholder="Source (e.g., Times of India)" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="press_coverage[__INDEX__][title]" 
                   class="form-control mb-2" placeholder="Article Title" required>
        </div>
        <div class="col-md-3">
            <input type="url" name="press_coverage[__INDEX__][url]" 
                   class="form-control mb-2" placeholder="Article URL" required>
        </div>
        <div class="col-md-1">
            <input type="date" name="press_coverage[__INDEX__][date]" 
                   class="form-control mb-2" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm remove-press">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</template>

@push('scripts')
<script>
// Global index counters
let socialMediaIndex = {{ !empty($about->social_media_updates) && is_array($about->social_media_updates) ? count($about->social_media_updates) : 0 }};
let videoIndex = {{ !empty($about->videos) && is_array($about->videos) ? count($about->videos) : 0 }};
let pressIndex = {{ !empty($about->press_coverage) && is_array($about->press_coverage) ? count($about->press_coverage) : 0 }};

// Add Social Media
function addSocialMediaItem() {
    const container = document.getElementById('socialMediaContainer');
    const index = socialMediaIndex++;
    const template = `
        <div class="row mb-3 social-media-item" data-index="${index}">
            <div class="col-md-5">
                <input type="text" name="social_media[${index}][platform]" 
                       class="form-control mb-2" placeholder="Platform (e.g., Twitter, Facebook)" required>
            </div>
            <div class="col-md-5">
                <input type="url" name="social_media[${index}][url]" 
                       class="form-control mb-2" placeholder="Post URL" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-social-media">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', template);
}

// Add Video
function addVideoItem(video = {title: '', url: '', thumbnail: ''}, index = null) {
    const container = document.getElementById('videosContainer');
    const itemIndex = index !== null ? index : videoIndex++;
    
    // Ensure video is an object with default values
    if (typeof video !== 'object' || video === null) {
        video = {title: '', url: '', thumbnail: ''};
    }
    
    // Ensure all required fields exist
    video = {
        title: video.title || '',
        url: video.url || '',
        thumbnail: video.thumbnail || ''
    };
    
    const template = `
        <div class="row mb-3 video-item" data-index="${itemIndex}">
            <div class="col-md-4">
                <input type="text" name="videos[${itemIndex}][title]" 
                       class="form-control mb-2" placeholder="Video Title" 
                       value="${escapeHtml(video.title)}">
            </div>
            <div class="col-md-4">
                <input type="url" name="videos[${itemIndex}][url]" 
                       class="form-control mb-2 video-url" placeholder="Video URL" 
                       value="${escapeHtml(video.url)}" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="videos[${itemIndex}][thumbnail]" 
                       class="form-control mb-2" placeholder="Thumbnail URL"
                       value="${escapeHtml(video.thumbnail)}">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-video">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;
        
    // Helper function to escape HTML
    function escapeHtml(unsafe) {
        if (typeof unsafe !== 'string') return '';
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    container.insertAdjacentHTML('beforeend', template);
}

// Add Press Coverage
function addPressItem() {
    const container = document.getElementById('pressContainer');
    const index = pressIndex++;
    const template = `
        <div class="row mb-3 press-item" data-index="${index}">
            <div class="col-md-3">
                <input type="text" name="press_coverage[${index}][source]" 
                       class="form-control mb-2" placeholder="Source" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="press_coverage[${index}][title]" 
                       class="form-control mb-2" placeholder="Title">
            </div>
            <div class="col-md-3">
                <input type="url" name="press_coverage[${index}][url]" 
                       class="form-control mb-2" placeholder="URL" required>
            </div>
            <div class="col-md-2">
                <input type="date" name="press_coverage[${index}][date]" 
                       class="form-control mb-2" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-press">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', template);
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for add buttons
    document.getElementById('addSocialMedia')?.addEventListener('click', addSocialMediaItem);
    document.getElementById('addVideo')?.addEventListener('click', addVideoItem);
    document.getElementById('addPress')?.addEventListener('click', addPressItem);

    // Event delegation for remove buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-social-media')) {
            e.target.closest('.social-media-item').remove();
        } else if (e.target.closest('.remove-video')) {
            e.target.closest('.video-item').remove();
        } else if (e.target.closest('.remove-press')) {
            e.target.closest('.press-item').remove();
        }
    });

    // Form submission
    const form = document.getElementById('mediaForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Clean up empty values before submission
            const formData = new FormData(form);
            
            // Process social media
            const socialMedia = [];
            document.querySelectorAll('.social-media-item').forEach((item, index) => {
                const platform = item.querySelector('input[name$="[platform]"]')?.value;
                const url = item.querySelector('input[name$="[url]"]')?.value;
                if (platform && url) {
                    socialMedia.push({
                        platform: platform,
                        url: url
                    });
                }
            });
            
            // Process videos
            const videos = [];
            document.querySelectorAll('.video-item').forEach((item, index) => {
                const title = item.querySelector('input[name$="[title]"]')?.value;
                const url = item.querySelector('input[name$="[url]"]')?.value;
                const thumbnail = item.querySelector('input[name$="[thumbnail]"]')?.value;
                if (url) {
                    videos.push({
                        title: title,
                        url: url,
                        thumbnail: thumbnail
                    });
                }
            });
            
            // Process press coverage
            const pressCoverage = [];
            document.querySelectorAll('.press-item').forEach((item, index) => {
                const source = item.querySelector('input[name$="[source]"]')?.value;
                const title = item.querySelector('input[name$="[title]"]')?.value;
                const url = item.querySelector('input[name$="[url]"]')?.value;
                const date = item.querySelector('input[name$="[date]"]')?.value;
                if (source && url) {
                    pressCoverage.push({
                        source: source,
                        title: title,
                        url: url,
                        date: date || new Date().toISOString().split('T')[0]
                    });
                }
            });
            
            // Add hidden fields with the processed data
            const socialMediaInput = document.createElement('input');
            socialMediaInput.type = 'hidden';
            socialMediaInput.name = 'social_media';
            socialMediaInput.value = JSON.stringify(socialMedia);
            form.appendChild(socialMediaInput);
            
            const videosInput = document.createElement('input');
            videosInput.type = 'hidden';
            videosInput.name = 'videos';
            videosInput.value = JSON.stringify(videos);
            form.appendChild(videosInput);
            
            const pressCoverageInput = document.createElement('input');
            pressCoverageInput.type = 'hidden';
            pressCoverageInput.name = 'press_coverage';
            pressCoverageInput.value = JSON.stringify(pressCoverage);
            form.appendChild(pressCoverageInput);
            
            // Let the form submit normally
            return true;
        });
    }
});
</script>
@endpush

<style>
    .btn-outline-primary {
        border-color: #4e73df;
        color: #4e73df;
    }
    .btn-outline-primary:hover {
        background-color: #4e73df;
        color: white;
    }
    .btn-danger {
        margin-top: 0.25rem;
    }
    h4 {
        color: #4e73df;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e3e6f0;
    }
</style>
@endsection
