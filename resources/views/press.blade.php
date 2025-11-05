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
        overflow: hidden; /* clip to show 3 cards */
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
    // Slider config (3 visible, step by 1)
    $slidesPerView = 3;
    $stepCount = max($imageCount - $slidesPerView + 1, 1);
@endphp
<!-- Simple Press Slider Section -->
<section class="simple-press" style="padding: 60px 0; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="section-header" style="text-align:center; margin-bottom: 30px;">
            <h2 class="section-title" style="font-size: 2.2rem;">Press & Media</h2>
            <p class="section-subtitle">Discover our latest media coverage and press highlights</p>
        </div>

        <div class="simple-viewport" style="overflow: hidden;">
            <div class="simple-track" id="simpleTrack" style="display:flex; transition: transform 0.5s ease; will-change: transform; gap: 20px;">
                <!-- Facebook video as the first slider card -->
                <div class="simple-item" style="flex: 0 0 calc((100% - 40px) / 3);">
                    <div class="simple-card" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; overflow:hidden;">
                        <div class="simple-video" style="position: relative; padding-top: 62%; background:#000; overflow:hidden;">
                            <iframe 
                                title="Facebook Video"
                                src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fwatch%2F%3Fv%3D1076661023943505&show_text=false&width=500&height=400"
                                style="position:absolute; top:0; left:0; width:100%; height:100%; border:none; overflow:hidden; display:block;"
                                scrolling="no" frameborder="0" allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                            </iframe>
                        </div>
                        <div style="padding: 12px 14px; color:#fff; display:flex; justify-content:flex-end; align-items:center;">
                            <a href="https://www.facebook.com/watch/?v=1076661023943505" target="_blank" rel="noopener" style="text-decoration:none; color:#00d4ff; font-weight:600;">Open</a>
                        </div>
                    </div>
                </div>
                @foreach($existingImages as $index => $imageName)
                <div class="simple-item" style="flex: 0 0 calc((100% - 40px) / 3);">
                    <div class="simple-card" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; overflow:hidden;">
                        <div class="simple-img" style="position: relative; padding-top: 62%; background:#0b0b18; overflow:hidden;">
                            <img src="{{ asset('images/press/' . $imageName) }}" alt="Press Image {{ $index + 1 }}" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                        </div>
                        <div style="padding: 14px 16px; color:#fff;">
                            <div style="font-weight:700; margin-bottom:6px;">Press Coverage {{ $index + 1 }}</div>
                            <div style="color:#b8b8b8; font-size: 0.95rem;">Latest media coverage and press highlights.</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="simple-controls" style="display:flex; justify-content:center; gap:14px; margin-top:20px;">
            <button id="simplePrev" style="width:44px; height:44px; border-radius:50%; border:1px solid rgba(255,255,255,0.25); background: rgba(255,255,255,0.08); color:#fff; cursor:pointer;">‹</button>
            <button id="simpleNext" style="width:44px; height:44px; border-radius:50%; border:1px solid rgba(255,255,255,0.25); background: rgba(255,255,255,0.08); color:#fff; cursor:pointer;">›</button>
        </div>
    </div>

    <style>
        @media (max-width: 992px) {
            .simple-track { gap: 16px !important; }
            .simple-item { flex: 0 0 calc((100% - 16px) / 2) !important; }
        }
        @media (max-width: 576px) {
            .simple-track { gap: 12px !important; }
            .simple-item { flex: 0 0 100% !important; }
        }
    </style>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('simpleTrack');
    const prev = document.getElementById('simplePrev');
    const next = document.getElementById('simpleNext');
    const items = track ? Array.from(track.children) : [];
    const slidesPerView = 3;
    let currentIndex = 0;

    function getStepWidth() {
        const first = items[0];
        if (!first) return 0;
        const rect = first.getBoundingClientRect();
        // Include flex gap from track since we no longer use per-item margins
        const trackStyles = window.getComputedStyle(track);
        let gap = 0;
        if (trackStyles.gap) {
            // gap may be like "20px" or "20px 20px"; take the first value
            const g = trackStyles.gap.split(' ')[0];
            gap = parseFloat(g) || 0;
        }
        return rect.width + gap;
    }

    function maxIndex() {
        return Math.max(items.length - slidesPerView, 0);
    }

    function update() {
        const x = -currentIndex * getStepWidth();
        track.style.transform = `translateX(${x}px)`;
        // hide controls when not needed
        const hide = maxIndex() === 0;
        prev.style.display = hide ? 'none' : '';
        next.style.display = hide ? 'none' : '';
    }

    function goNext() {
        currentIndex = currentIndex >= maxIndex() ? 0 : currentIndex + 1;
        update();
    }
    function goPrev() {
        currentIndex = currentIndex <= 0 ? maxIndex() : currentIndex - 1;
        update();
    }

    // Events
    if (prev) prev.addEventListener('click', goPrev);
    if (next) next.addEventListener('click', goNext);

    // Swipe
    let sx = 0, ex = 0;
    track.addEventListener('touchstart', e => { sx = e.touches[0].clientX; });
    track.addEventListener('touchend', e => { ex = e.changedTouches[0].clientX; const d = sx - ex; if (Math.abs(d) > 50) { d > 0 ? goNext() : goPrev(); } });

    // Resize recalculation
    window.addEventListener('resize', update);

    // Init
    update();
});
</script>
@endsection
