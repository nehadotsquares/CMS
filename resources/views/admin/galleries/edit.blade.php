@extends('admin.layouts.admin')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Gallery Image</h2>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Back</a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ $gallery->category }}">
                </div>
                
                <div class="mb-3">
                    <label for="finish_type" class="form-label">Finish Type</label>
                    <select class="form-control" id="finish_type" name="finish_type">
                        <option value="">Select finish</option>
                        <option value="gold" {{ $gallery->finish_type == 'gold' ? 'selected' : '' }}>Gold Finish</option>
                        <option value="silver" {{ $gallery->finish_type == 'silver' ? 'selected' : '' }}>Silver Finish</option>
                        <option value="brown" {{ $gallery->finish_type == 'brown' ? 'selected' : '' }}>Brown Finish</option>
                        <option value="marble" {{ $gallery->finish_type == 'marble' ? 'selected' : '' }}>Marble Finish</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $gallery->description }}</textarea>
                </div>
                
                <div class="mb-3">
                    @if($gallery->image)
                        <div class="mb-2">
                            <img src="{{ asset($gallery->image) }}" width="200" class="img-thumbnail">
                        </div>
                    @endif
                    <label for="image" class="form-label">Image (Leave empty to keep current)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-primary">Update Image</button>
            </form>
        </div>
    </div>
</div>
@endsection