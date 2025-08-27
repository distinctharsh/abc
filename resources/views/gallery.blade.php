@extends('layouts.app')

@section('content')
<!-- Gallery Section -->
<section class="gallery-section py-5" style="min-height: 100vh; background: #f8f9fa;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">Our Gallery</h1>
            <p class="lead text-muted">Capturing moments of excellence and care</p>
            <div class="divider mx-auto my-4" style="width: 80px; height: 4px; background: linear-gradient(90deg, #a96ee4, #46ff46);"></div>
        </div>

        <!-- Gallery Filter -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="btn-group" role="group" aria-label="Gallery filter">
                    <button type="button" class="btn btn-outline-primary active filter-btn" data-filter="all">All</button>
                    <button type="button" class="btn btn-outline-primary filter-btn" data-filter="dental">Dental</button>
                    <button type="button" class="btn btn-outline-primary filter-btn" data-filter="clinic">Clinic</button>
                    <button type="button" class="btn btn-outline-primary filter-btn" data-filter="team">Our Team</button>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="row g-4 gallery-grid">
            @php
                $images = [
                    ['src' => 'images/1.jpg', 'category' => 'dental', 'title' => 'Dental Checkup'],
                    ['src' => 'images/2.jpg', 'category' => 'dental', 'title' => 'Teeth Whitening'],
                    ['src' => 'images/3.jpg', 'category' => 'clinic', 'title' => 'Our Clinic'],
                    ['src' => 'images/4.jpg', 'category' => 'team', 'title' => 'Expert Team'],
                    ['src' => 'images/5.jpg', 'category' => 'dental', 'title' => 'Dental Implants'],
                    ['src' => 'images/6.jpg', 'category' => 'clinic', 'title' => 'Modern Equipment'],
                    ['src' => 'images/7.jpg', 'category' => 'team', 'title' => 'Dental Specialists'],
                    ['src' => 'images/8.jpg', 'category' => 'dental', 'title' => 'Oral Hygiene'],
                    ['src' => 'images/9.jpg', 'category' => 'clinic', 'title' => 'Clinic Interior'],
                    ['src' => 'images/10.jpg', 'category' => 'team', 'title' => 'Medical Staff'],
                    ['src' => 'images/11.jpg', 'category' => 'dental', 'title' => 'Dental Care'],
                    ['src' => 'images/12.jpg', 'category' => 'clinic', 'title' => 'Waiting Area']
                ];
            @endphp

            @foreach($images as $image)
            <div class="col-6 col-md-4 col-lg-3 gallery-item" data-category="{{ $image['category'] }}">
                <div class="gallery-card">
                    <div class="gallery-img-container">
                        <img src="{{ asset($image['src']) }}" alt="{{ $image['title'] }}" class="img-fluid gallery-img">
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <h5>{{ $image['title'] }}</h5>
                                <p class="mb-0">Click to view larger</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 2;"></button>
                <img src="" alt="" class="img-fluid" id="modalImage">
                <div class="p-3">
                    <h5 id="modalTitle" class="mb-0"></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    background: white;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.gallery-img-container {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
}

.gallery-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(73, 46, 228, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
}

.gallery-img-container:hover .gallery-overlay {
    opacity: 1;
}

.gallery-caption {
    color: white;
    text-align: center;
    padding: 15px;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.gallery-img-container:hover .gallery-caption {
    transform: translateY(0);
}

.gallery-caption h5 {
    font-size: 1.1rem;
    margin-bottom: 5px;
    font-weight: 600;
}

.gallery-caption p {
    font-size: 0.9rem;
    margin-bottom: 0;
    opacity: 0.9;
}

/* Filter button active state */
.btn-outline-primary.active {
    background: linear-gradient(90deg, #a96ee4, #46ff46);
    border-color: transparent;
    color: white;
}

/* Animation for gallery items */
.gallery-item {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Staggered animation */
.gallery-item:nth-child(1) { animation-delay: 0.1s; }
.gallery-item:nth-child(2) { animation-delay: 0.2s; }
.gallery-item:nth-child(3) { animation-delay: 0.3s; }
.gallery-item:nth-child(4) { animation-delay: 0.4s; }
.gallery-item:nth-child(5) { animation-delay: 0.5s; }
.gallery-item:nth-child(6) { animation-delay: 0.6s; }
.gallery-item:nth-child(7) { animation-delay: 0.7s; }
.gallery-item:nth-child(8) { animation-delay: 0.8s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize filter buttons
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    // Filter functionality
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filter = btn.dataset.filter;
            
            // Filter items
            galleryItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                    // Add animation class
                    item.style.animation = 'fadeInUp 0.5s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Image modal functionality
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    
    document.querySelectorAll('.gallery-img-container').forEach(container => {
        container.addEventListener('click', function() {
            const imgSrc = this.querySelector('img').src;
            const imgTitle = this.querySelector('h5').textContent;
            
            modalImage.src = imgSrc;
            modalTitle.textContent = imgTitle;
            modal.show();
        });
    });
});
</script>
@endsection
