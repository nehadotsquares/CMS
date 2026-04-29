@extends('admin.layouts.admin')

@section('title', 'Add to Gallery')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Image</h2>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Back</a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="e.g., Media Wall, Venetian Plaster, etc.">
                </div>
                
                <div class="mb-3">
                    <label for="finish_type" class="form-label">Finish Type</label>
                    <select class="form-control" id="finish_type" name="finish_type">
                        <option value="">Select finish</option>
                        <option value="gold">Gold Finish</option>
                        <option value="silver">Silver Finish</option>
                        <option value="brown">Brown Finish</option>
                        <option value="marble">Marble Finish</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the image..."></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Image * (Max 5MB)</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Add to Gallery</button>
            </form>
        </div>
    </div>
</div>
@endsection