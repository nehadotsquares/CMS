@extends('layouts.app')

@section('title', 'Our Gallery')

@section('content')
<!-- Page Banner -->
<section class="page-banner gallery-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="banner-content">
                    <h1 class="banner-title">Our Gallery</h1>
                    <p class="banner-subtitle">Browse through our collection of stunning wall finishes and media walls</p>
                    <a href="{{ route('contact') }}" class="btn btn-banner">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <!-- Category filters -->
        @if(isset($categories) && count($categories) > 0)
        <div class="text-center mb-4">
            <a href="{{ route('gallery') }}" class="btn btn-outline-gold m-1">All</a>
            @foreach($categories as $category)
                @if($category)
                <a href="{{ route('gallery.category', $category) }}" class="btn btn-outline-gold m-1">{{ $category }}</a>
                @endif
            @endforeach
        </div>
        @endif
        
        <div class="row">
            @forelse($galleries as $gallery)
            <div class="col-md-4 col-lg-3 mb-4 gallery-modal">
                <div class="gallery-card">
                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $gallery->id }}" style="cursor: pointer; height: 250px; width: 100%; object-fit: cover;">
                    <div class="content">
                        <h5>{{ $gallery->title }}</h5>
                        @if($gallery->finish_type)
                            <span class="finish-badge finish-{{ strtolower($gallery->finish_type) }}">
                                {{ ucfirst($gallery->finish_type) }} Finish
                            </span>
                        @endif
                        @if($gallery->category)
                            <p class="mt-2 mb-0"><small>{{ $gallery->category }}</small></p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $gallery->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset($gallery->image) }}" class="img-fluid" alt="{{ $gallery->title }}">
                            @if($gallery->description)
                                <p class="mt-3">{{ $gallery->description }}</p>
                            @endif
                            @if($gallery->finish_type)
                                <p><strong>Finish Type:</strong> {{ ucfirst($gallery->finish_type) }}</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">No images in gallery yet.</div>
            </div>
            @endforelse
        </div>
        
        <div class="pagination-wrapper">
            {{ $galleries->links('vendor.pagination.custom') }}
        </div>
        
        <div class="text-center mt-3">
            <p class="text-muted">
                Showing {{ $galleries->firstItem() }} to {{ $galleries->lastItem() }} 
                of {{ $galleries->total() }} images
            </p>
        </div>
    </div>
</section>
@endsection