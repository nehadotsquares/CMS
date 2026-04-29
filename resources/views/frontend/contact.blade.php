@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Page Banner -->
<section class="page-banner contact-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="banner-content">
                    <h1 class="banner-title">Contact Us</h1>
                    <p class="banner-subtitle">Get in touch with us for a free consultation and quote</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="contact-form">
                    <h2 class="mb-4">Get In Touch</h2>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gold w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4">
                    <h2 class="mb-4">Visit Us</h2>
                    <p><i class="fas fa-map-marker-alt me-2" style="color: #D4AF37;"></i> 123 Design Street, Creative City</p>
                    <p><i class="fas fa-phone me-2" style="color: #D4AF37;"></i> +1 234 567 890</p>
                    <p><i class="fas fa-envelope me-2" style="color: #D4AF37;"></i> info@venetianplaster.com</p>
                    <h4 class="mt-4">Working Hours</h4>
                    <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                    Saturday: 10:00 AM - 4:00 PM<br>
                    Sunday: Closed</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection