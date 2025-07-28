<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add YouTube Highlight - ClarityUI</title>
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-papm6Q+..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom">
        <div class="container-fluid navbar-container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="nav-logo">
            </a>
            
            <!-- Navigation Links -->
            <div class="d-flex align-items-center nav-links">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
                <a class="nav-link active" href="{{ route('youtube-highlights.index') }}">YouTube Highlights</a>
                <a class="nav-link" href="#">Feature</a>
                <a class="nav-link" href="#">Pricing</a>
            </div>
            
            <!-- Start Free Trial Button -->
            <button class="btn start-trial-btn">
                Start Free Trial
            </button>
        </div>
    </nav>

    <!-- Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="fas fa-plus"></i> Add New YouTube Highlight
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('youtube-highlights.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label fw-bold">Title *</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="author" class="form-label fw-bold">Author *</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                               id="author" name="author" value="{{ old('author') }}" required>
                                        @error('author')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Description *</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="video_url" class="form-label fw-bold">Video URL</label>
                                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                                               id="video_url" name="video_url" value="{{ old('video_url') }}">
                                        @error('video_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="youtube_id" class="form-label fw-bold">YouTube ID</label>
                                        <input type="text" class="form-control @error('youtube_id') is-invalid @enderror" 
                                               id="youtube_id" name="youtube_id" value="{{ old('youtube_id') }}">
                                        @error('youtube_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="thumbnail" class="form-label fw-bold">Thumbnail Path</label>
                                        <input type="text" class="form-control @error('thumbnail') is-invalid @enderror" 
                                               id="thumbnail" name="thumbnail" value="{{ old('thumbnail', 'images/b.jpg') }}">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="published_date" class="form-label fw-bold">Published Date *</label>
                                        <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                               id="published_date" name="published_date" value="{{ old('published_date', date('Y-m-d')) }}" required>
                                        @error('published_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="views" class="form-label fw-bold">Views</label>
                                        <input type="number" class="form-control @error('views') is-invalid @enderror" 
                                               id="views" name="views" value="{{ old('views', 0) }}" min="0">
                                        @error('views')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="likes" class="form-label fw-bold">Likes</label>
                                        <input type="number" class="form-control @error('likes') is-invalid @enderror" 
                                               id="likes" name="likes" value="{{ old('likes', 0) }}" min="0">
                                        @error('likes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tags" class="form-label fw-bold">Tags (comma separated)</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" name="tags" value="{{ old('tags') }}" 
                                           placeholder="e.g., Programming, Laravel, PHP">
                                    <small class="form-text text-muted">Enter tags separated by commas</small>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="is_featured">
                                            Mark as Featured
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Highlight
                                    </button>
                                    <a href="{{ route('youtube-highlights.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to List
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="text-center text-muted small" style="letter-spacing: 0.5px;">© Copyright 2022. All Rights Reserved by ClarityUI</div>
        </div>
    </footer>

    <script>
        // Convert tags input to array format
        document.querySelector('form').addEventListener('submit', function(e) {
            const tagsInput = document.getElementById('tags');
            if (tagsInput.value.trim()) {
                const tags = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);
                tagsInput.value = JSON.stringify(tags);
            }
        });
    </script>
</body>
</html> 