@extends('layouts.app')

@section('title', 'Venetian Plaster - Premium Wall Finishes')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">
                    Transform Your Walls With <span>Venetian Plaster</span>
                </h1>
                <p class="lead mt-3">Experience the timeless beauty of authentic Venetian plaster finishes. From marble-like textures to modern media walls, we bring elegance to every space.</p>
                <a href="{{ route('contact') }}" class="btn btn-gold mt-3">Get Free Consultation</a>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=600" alt="Venetian Plaster" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Services</h2>
            <p class="lead">Premium wall finishing solutions for your home</p>
        </div>
        <div class="row">
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="service-card">
                    @if($service->image)
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                    @endif
                    <div class="content">
                        <h4>{{ $service->title }}</h4>
                        <p>{{ Str::limit($service->description, 100) }}</p>
                        <a href="{{ route('service.detail', $service->id) }}" class="btn btn-outline-gold">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Work</h2>
            <p class="lead">Browse through our latest projects</p>
        </div>
        <div class="row">
            @foreach($galleries as $gallery)
            <div class="col-md-3">
                <div class="gallery-card">
                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $gallery->id }}" style="cursor: pointer;">
                    <div class="content">
                        <h5>{{ $gallery->title }}</h5>
                        @if($gallery->finish_type)
                            <span class="finish-badge finish-{{ strtolower($gallery->finish_type) }}">
                                {{ ucfirst($gallery->finish_type) }} Finish
                            </span>
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
                        <div class="modal-body">
                            <img src="{{ asset($gallery->image) }}" class="img-fluid" alt="{{ $gallery->title }}">
                            @if($gallery->description)
                                <p class="mt-3">{{ $gallery->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('gallery') }}" class="btn btn-gold">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: var(--brown); color: white;">
    <div class="container text-center">
        <h2 class="display-5">Ready to Transform Your Space?</h2>
        <p class="lead mb-4">Contact us today for a free consultation and quote</p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Get Started</a>
    </div>
</section>
@endsection