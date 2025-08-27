@extends('layouts.app')

@section('content')
<!-- Gallery Section -->
<section class="gallery-section py-5" style="min-height: 100vh; background: #f8f9fa;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h1 class="display-4 fw-bold" style="background: linear-gradient(90deg, #a96ee4, #46ff46); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Press Gallery</h1>
            <p class="lead text-muted">Our Media Coverage and Press Mentions</p>
            <div class="divider mx-auto my-4" style="width: 80px; height: 4px; background: linear-gradient(90deg, #a96ee4, #46ff46);"></div>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-container">
            @php
                // Images are now passed from the controller
                $images = $images ?? [];
            @endphp

            @foreach($images as $image)
            <div class="gallery-item">
                <div class="gallery-card">
                    <div class="gallery-img-container">
                        <img src="{{ asset($image['src']) }}" alt="{{ $image['title'] }}" class="gallery-img">
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <h5>{{ $image['title'] }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Modern Gallery Layout */
.gallery-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    padding: 1rem 0;
}

.gallery-item {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    animation: fadeIn 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.gallery-item:nth-child(1) { animation-delay: 0.1s; }
.gallery-item:nth-child(2) { animation-delay: 0.2s; }
.gallery-item:nth-child(3) { animation-delay: 0.3s; }
.gallery-item:nth-child(4) { animation-delay: 0.4s; }
.gallery-item:nth-child(5) { animation-delay: 0.5s; }
.gallery-item:nth-child(6) { animation-delay: 0.6s; }
.gallery-item:nth-child(7) { animation-delay: 0.7s; }
.gallery-item:nth-child(8) { animation-delay: 0.8s; }

/* Gallery Card */
.gallery-card {
    height: 100%;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    background: white;
    position: relative;
}

.gallery-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

/* Image Container */
.gallery-img-container {
    position: relative;
    padding-top: 75%; /* 4:3 Aspect Ratio */
    overflow: hidden;
    background: #f0f2f5;
}

.gallery-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 1s cubic-bezier(0.16, 1, 0.3, 1);
}

.gallery-card:hover .gallery-img {
    transform: scale(1.05);
}

/* Hover Effect */
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
    padding: 1.5rem;
    color: white;
    text-align: center;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-caption {
    transform: translateY(20px);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    width: 100%;
    padding: 1rem;
}

.gallery-card:hover .gallery-caption {
    transform: translateY(0);
}

.gallery-caption h5 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    line-height: 1.4;
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
    .gallery-container {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .gallery-container {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
    }
    
    .section-header h1 {
        font-size: 2.5rem;
    }
    
    .gallery-caption h5 {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .gallery-container {
        grid-template-columns: 1fr;
    }
    
    .section-header h1 {
        font-size: 2rem;
    }
    
    .lead {
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple fade in animation for gallery items
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    // Add intersection observer for lazy loading
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    galleryItems.forEach(item => {
        observer.observe(item);
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize filter buttons with better performance
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    // Filter functionality
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Filter items with animation
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.5s ease-out forwards';
                } else {
                    item.style.animation = 'fadeOut 0.3s ease-out forwards';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Image modal functionality with improved UX
    document.querySelectorAll('.gallery-card').forEach(card => {
        card.addEventListener('click', function() {
            const imgContainer = this.querySelector('.gallery-img-container');
            const img = imgContainer.querySelector('img');
            const title = imgContainer.querySelector('h5')?.textContent || 'Image';
            const category = imgContainer.querySelector('.gallery-category')?.textContent || '';
            
            // Set modal content
            modalImage.src = img.src;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modalCategory.textContent = category;
            
            // Show loading state
            modalImage.style.opacity = '0';
            modalImage.onload = function() {
                modalImage.style.opacity = '1';
            };
            
            // Show modal
            modal.show();
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (modal._element.classList.contains('show')) {
            if (e.key === 'Escape') {
                modal.hide();
            }
        }
    });
});
</script>
@endsection
