@extends('layouts.app')

@section('content')
<!-- Press & Media Section -->

<style>
    .press-section {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        min-height: 100vh;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .press-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
        position: relative;
        z-index: 2;
    }

    .section-title {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(45deg, #00d4ff, #ff6b6b, #4ecdc4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
        text-shadow: 0 0 30px rgba(0, 212, 255, 0.3);
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: #b8b8b8;
        max-width: 600px;
        margin: 0 auto;
    }

    .modern-slider {
        position: relative;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .slider-container {
        position: relative;
        perspective: 1000px;
        transform-style: preserve-3d;
    }

    .slider-track {
        display: flex;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform-style: preserve-3d;
    }

    .slide-item {
        flex: 0 0 350px;
        margin: 0 15px;
        transform-style: preserve-3d;
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
    }

    .slide-item:hover {
        transform: translateZ(50px) rotateY(5deg) scale(1.05);
    }

    .slide-card {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        height: 450px;
    }

    .slide-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .slide-card:hover::before {
        transform: translateX(100%);
    }

    .slide-image {
        width: 100%;
        height: 280px;
        overflow: hidden;
        position: relative;
    }

    .slide-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .slide-item:hover .slide-image img {
        transform: scale(1.1);
    }

    .slide-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
        opacity: 0;
        transition: opacity 0.6s ease;
    }

    .slide-item:hover .slide-overlay {
        opacity: 1;
    }

    .slide-content {
        padding: 25px;
        position: relative;
        z-index: 2;
    }

    .slide-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .slide-description {
        color: #b8b8b8;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .slide-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(45deg, #00d4ff, #4ecdc4);
        color: #000;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        transform: translateY(0);
        box-shadow: 0 8px 25px rgba(0, 212, 255, 0.3);
    }

    .slide-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 212, 255, 0.4);
        color: #000;
    }

    .slide-button-icon {
        width: 16px;
        height: 16px;
        transition: transform 0.3s ease;
    }

    .slide-button:hover .slide-button-icon {
        transform: translateX(3px);
    }

    .slider-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 50px;
        position: relative;
        z-index: 2;
    }

    .control-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        backdrop-filter: blur(20px);
        position: relative;
        overflow: hidden;
    }

    .control-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: radial-gradient(circle, rgba(0, 212, 255, 0.3) 0%, transparent 70%);
        transition: all 0.3s ease;
        transform: translate(-50%, -50%);
    }

    .control-btn:hover::before {
        width: 100px;
        height: 100px;
    }

    .control-btn:hover {
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 212, 255, 0.3);
        border-color: rgba(0, 212, 255, 0.5);
    }

    .control-btn svg {
        width: 24px;
        height: 24px;
        transition: transform 0.3s ease;
    }

    .control-btn:hover svg {
        transform: scale(1.1);
    }

    .slider-indicators {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 30px;
        position: relative;
        z-index: 2;
    }

    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .indicator::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #00d4ff, #4ecdc4);
        transform: scale(0);
        transition: transform 0.3s ease;
        border-radius: 50%;
    }

    .indicator.active::before {
        transform: scale(1);
    }

    .indicator:hover {
        transform: scale(1.2);
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        z-index: 1;
    }

    .floating-element {
        position: absolute;
        background: linear-gradient(45deg, rgba(0, 212, 255, 0.1), rgba(78, 205, 196, 0.1));
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2.5rem;
        }
        
        .slide-item {
            flex: 0 0 300px;
            margin: 0 10px;
        }
        
        .slide-card {
            height: 400px;
        }
        
        .control-btn {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 480px) {
        .slide-item {
            flex: 0 0 280px;
            margin: 0 8px;
        }
        
        .slide-card {
            height: 380px;
        }
        
        .slide-content {
            padding: 20px;
        }
    }
</style>

@php
    // Only the images that actually exist
    $existingImages = [
        'p1.jpg', 'p2.jpg', 'p3.jpg', 'p4.jpg', 
        'p37.jpg', 'p38.jpg', 'p41.jpg'
    ];
    $imageCount = count($existingImages);
@endphp

<section class="press-section">
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Press & Media</h1>
            <p class="section-subtitle">Discover our latest media coverage and press highlights</p>
        </div>

        <div class="modern-slider">
            <div class="slider-container">
                <div class="slider-track" id="sliderTrack">
                    @foreach($existingImages as $index => $imageName)
                    <div class="slide-item">
                        <div class="slide-card">
                            <div class="slide-image">
                                <img src="{{ asset('images/press/' . $imageName) }}" alt="Press Image {{ $index + 1 }}" />
                                <div class="slide-overlay"></div>
                            </div>
                            <div class="slide-content">
                                <h3 class="slide-title">Press Coverage {{ $index + 1 }}</h3>
                                <p class="slide-description">Latest media coverage and press highlights showcasing our achievements and milestones.</p>
                                <a href="#" class="slide-button">
                                    View Details
                                    <svg class="slide-button-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="slider-controls">
                <button class="control-btn" id="prevBtn">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button class="control-btn" id="nextBtn">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="slider-indicators" id="indicators">
                @for($i = 1; $i <= ceil($imageCount/3); $i++)
                <div class="indicator {{ $i == 1 ? 'active' : '' }}" data-index="{{ $i - 1 }}"></div>
                @endfor
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sliderTrack = document.getElementById('sliderTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicators = document.querySelectorAll('.indicator');
    
    let currentIndex = 0;
    const totalSlides = {{ $imageCount }}; // Use the actual image count
    const slidesPerView = 3;
    const maxIndex = Math.ceil(totalSlides / slidesPerView) - 1;
    
    // Auto-play functionality
    let autoPlayInterval;
    
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            nextSlide();
        }, 3000);
    }
    
    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }
    
    function updateSlider() {
        const translateX = -currentIndex * (350 + 30) * slidesPerView;
        sliderTrack.style.transform = `translateX(${translateX}px)`;
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentIndex);
        });
        
        // Add animation class
        sliderTrack.classList.add('sliding');
        setTimeout(() => {
            sliderTrack.classList.remove('sliding');
        }, 800);
    }
    
    function nextSlide() {
        currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
        updateSlider();
    }
    
    function prevSlide() {
        currentIndex = currentIndex <= 0 ? maxIndex : currentIndex - 1;
        updateSlider();
    }
    
    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }
    
    // Event listeners
    prevBtn.addEventListener('click', () => {
        prevSlide();
        stopAutoPlay();
        startAutoPlay();
    });
    
    nextBtn.addEventListener('click', () => {
        nextSlide();
        stopAutoPlay();
        startAutoPlay();
    });
    
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            goToSlide(index);
            stopAutoPlay();
            startAutoPlay();
        });
    });
    
    // Touch/swipe support
    let startX = 0;
    let endX = 0;
    
    sliderTrack.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderTrack.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
            stopAutoPlay();
            startAutoPlay();
        }
    }
    
    // Hover effects
    const slideItems = document.querySelectorAll('.slide-item');
    slideItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            stopAutoPlay();
        });
        
        item.addEventListener('mouseleave', () => {
            startAutoPlay();
        });
    });
    
    // Initialize
    updateSlider();
    startAutoPlay();
    
    // Pause on window blur
    window.addEventListener('blur', stopAutoPlay);
    window.addEventListener('focus', startAutoPlay);
});
</script>
@endsection
