@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<!-- Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="banner-content">
                    <h1 class="banner-title">Our Services</h1>
                    <p class="banner-subtitle">Premium wall finishing solutions for your home and commercial spaces</p>
                    <a href="{{ route('contact') }}" class="btn btn-banner">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($services as $service)
            <div class="col-md-4 mb-4">
                <div class="service-card">
                    @if($service->image)
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                    @else
                        <img src="https://via.placeholder.com/400x250" alt="Service">
                    @endif
                    <div class="content">
                        <h4>{{ $service->title }}</h4>
                        <p>{{ Str::limit($service->description, 120) }}</p>
                        <a href="{{ route('service.detail', $service->id) }}" class="btn btn-outline-gold">Learn More →</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">No services available at the moment.</div>
            </div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $services->links('vendor.pagination.custom') }}
        </div>
    </div>
</section>
@endsection