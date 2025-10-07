@extends('layouts.app')

@section('content')
<!-- Gallery Section -->
<section class="gallery-section py-5" style="min-height: 100vh; background: #f8f9fa;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h1 class="display-4 fw-bold" style="background: linear-gradient(90deg, #a96ee4, #46ff46); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Press Gallery</h1>
            <p class="lead text-muted">Our Media Coverage and Press Mentions</p>
            <div class="divider mx-auto my-4" style="width: 80px; height: 4px; background: linear-gradient(90deg, #a96ee4, #46ff46);"></div>
            
            <!-- Search -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="gallerySearch" placeholder="Search images..." aria-label="Search images">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-container">
            @forelse($images as $image)
            <div class="gallery-item" data-category="{{ $image['category'] }}" data-title="{{ strtolower($image['title']) }}">
                <div class="gallery-card">
                    <div class="gallery-img-container">
                        <img src="/{{ $image['src'] }}" alt="{{ $image['title'] }}" class="gallery-img" loading="lazy">

                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <h5>{{ $image['title'] }}</h5>
                                @if(isset($image['date']))
                                    <p class="small mb-0">{{ $image['date'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-info">
                    No gallery images found. Please check back later.
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($images->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Gallery pagination">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($images->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $images->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    {{-- Pagination --}}
                    @foreach ($images->getUrlRange(1, $images->lastPage()) as $page => $url)
                        @if ($page == $images->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($images->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $images->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @else
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</section>

<style> /* Modern Gallery Layout */ .gallery-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.8rem; padding: 1.5rem 0; transition: all 0.3s ease; } .gallery-item { border-radius: 16px; overflow: hidden; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); animation: fadeIn 0.6s ease-out forwards; opacity: 0; transform: translateY(20px); } @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } } .gallery-item:nth-child(1) { animation-delay: 0.1s; } .gallery-item:nth-child(2) { animation-delay: 0.2s; } .gallery-item:nth-child(3) { animation-delay: 0.3s; } .gallery-item:nth-child(4) { animation-delay: 0.4s; } .gallery-item:nth-child(5) { animation-delay: 0.5s; } .gallery-item:nth-child(6) { animation-delay: 0.6s; } .gallery-item:nth-child(7) { animation-delay: 0.7s; } .gallery-item:nth-child(8) { animation-delay: 0.8s; } /* Gallery Card */ .gallery-card { height: 100%; border-radius: 16px; overflow: hidden; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); background: white; position: relative; } .gallery-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); } /* Image Container */ .gallery-img-container { position: relative; padding-top: 75%; /* 4:3 Aspect Ratio */ overflow: hidden; background: #f0f2f5; } .gallery-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 1s cubic-bezier(0.16, 1, 0.3, 1); } .gallery-card:hover .gallery-img { transform: scale(1.05); } /* Hover Effect */ .gallery-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0) 100%); display: flex; align-items: flex-end; justify-content: center; opacity: 0; transition: opacity 0.4s ease; padding: 1.5rem; color: white; text-align: center; } .gallery-card:hover .gallery-overlay { opacity: 1; } .gallery-caption { transform: translateY(20px); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); width: 100%; padding: 1rem; } .gallery-card:hover .gallery-caption { transform: translateY(0); } .gallery-caption h5 { font-size: 1.1rem; font-weight: 600; margin: 0; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3); line-height: 1.4; } /* Responsive Adjustments */ @media (max-width: 1200px) { .gallery-container { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); } } @media (max-width: 768px) { .gallery-container { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem; } .section-header h1 { font-size: 2.5rem; } .gallery-caption h5 { font-size: 1rem; } } @media (max-width: 480px) { .gallery-container { grid-template-columns: 1fr; } .section-header h1 { font-size: 2rem; } .lead { font-size: 1rem; } } </style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fade in + lazy load
    const galleryItems = document.querySelectorAll('.gallery-item');

    // Lightbox setup
    const lightbox = document.createElement('div');
    lightbox.id = 'lightbox';
    Object.assign(lightbox.style, {
        display: 'none',
        position: 'fixed',
        top: '0',
        left: '0',
        width: '100%',
        height: '100%',
        backgroundColor: 'rgba(0, 0, 0, 0.9)',
        zIndex: '1000',
        justifyContent: 'center',
        alignItems: 'center',
        opacity: '0',
        transition: 'opacity 0.3s ease'
    });

    const lightboxImg = document.createElement('img');
    Object.assign(lightboxImg.style, {
        maxWidth: '90%',
        maxHeight: '90vh',
        objectFit: 'contain'
    });

    const lightboxCaption = document.createElement('div');
    Object.assign(lightboxCaption.style, {
        position: 'absolute',
        bottom: '20px',
        color: 'white',
        textAlign: 'center',
        width: '100%',
        padding: '0 20px'
    });

    lightbox.appendChild(lightboxImg);
    lightbox.appendChild(lightboxCaption);
    document.body.appendChild(lightbox);

    // Close lightbox
    lightbox.addEventListener('click', (e) => {
        if (e.target !== lightboxImg) {
            lightbox.style.opacity = '0';
            setTimeout(() => {
                lightbox.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);
        }
    });

    // Open lightbox
    galleryItems.forEach(item => {
        const img = item.querySelector('img');
        item.style.cursor = 'pointer';
        item.addEventListener('click', () => {
            lightboxImg.src = img.src;
            lightboxCaption.innerHTML = img.alt;
            lightbox.style.display = 'flex';
            setTimeout(() => lightbox.style.opacity = '1', 10);
            document.body.style.overflow = 'hidden';
        });
    });

    // IntersectionObserver for fade-in
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const item = entry.target;
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 100);

                observer.unobserve(item);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px 100px 0px' });

    galleryItems.forEach(item => observer.observe(item));

    // Search
    const searchInput = document.getElementById('gallerySearch');
    const searchButton = document.getElementById('searchButton');
    function filterGallery() {
        const searchTerm = searchInput.value.toLowerCase();
        galleryItems.forEach(item => {
            const title = item.dataset.title.toLowerCase();
            const category = item.dataset.category.toLowerCase();
            item.style.display = (title.includes(searchTerm) || category.includes(searchTerm)) ? '' : 'none';
        });
    }
    searchInput.addEventListener('keyup', filterGallery);
    searchButton.addEventListener('click', filterGallery);

    // Keyboard navigation for lightbox
    document.addEventListener('keydown', (e) => {
        if (lightbox.style.display === 'flex' && lightbox.style.opacity === '1') {
            if (e.key === 'Escape' || e.keyCode === 27) {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    lightbox.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }, 300);
            }
        }
    });
});
</script>
@endpush
@endsection
