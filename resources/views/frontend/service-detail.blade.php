@extends('layouts.app')

@section('title', $service->title)

@section('content')
<section class="page-banner gallery-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="banner-content">
                    <h1 class="banner-title">{{ $service->title }}</h1>
                    <p class="banner-subtitle">Browse through our collection of stunning wall finishes and media walls</p>
                    <a href="{{ route('contact') }}" class="btn btn-banner">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="service-card">
                    @if($service->image)
                        <img src="{{ asset($service->image) }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;" alt="{{ $service->title }}">
                    @endif
                    <div class="content p-4">
                        <h1 class="mb-4">{{ $service->title }}</h1>
                        <div class="service-description">
                            {!! nl2br(e($service->description)) !!}
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-gold">Get a Quote</a>
                            <a href="{{ route('services') }}" class="btn btn-outline-gold ms-2">View All Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection