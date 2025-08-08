@if(isset($about))
    @php
        $title = 'Edit About Section';
        $method = 'PUT';
        $action = route('admin.abouts.update', $about);
        $buttonText = 'Update Section';
    @endphp
@else
    @php
        $title = 'Add New About Section';
        $method = 'POST';
        $action = route('admin.abouts.store');
        $buttonText = 'Create Section';
        $about = new \App\Models\About([
            'is_active' => true,
            'order' => 0
        ]);
    @endphp
@endif

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">{{ $title }}</h1>
        <a href="{{ route('admin.abouts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method($method)

                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $about->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5" required>{{ old('description', $about->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="order" class="form-label">Order *</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $about->order) }}" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                       id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $about->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">
                        {{ isset($about) && $about->image ? 'Change Image' : 'Image *' }}
                    </label>
                    <input class="form-control @error('image') is-invalid @enderror" 
                           type="file" id="image" name="image" 
                           {{ !isset($about) || !$about->image ? 'required' : '' }}>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(isset($about) && $about->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $about->image) }}" 
                                 alt="{{ $about->title }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px; height: auto;">
                            <p class="text-muted mt-1">Current image</p>
                        </div>
                    @endif
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary me-md-2">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ $buttonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle required attribute on file input based on whether an image exists
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const hasExistingImage = {!! isset($about) && $about->image ? 'true' : 'false' !!};
        
        if (hasExistingImage) {
            imageInput.removeAttribute('required');
        }
        
        imageInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                this.setAttribute('required', 'required');
            } else if (hasExistingImage) {
                this.removeAttribute('required');
            }
        });
    });
</script>
@endpush
