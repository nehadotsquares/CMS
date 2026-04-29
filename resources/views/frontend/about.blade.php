@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<section class="page-banner about-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="banner-content">
                    <h1 class="banner-title">About Us</h1>
                    <p class="banner-subtitle">Learn more about our expertise in Venetian plaster and media walls</p>
                    <a href="{{ route('contact') }}" class="btn btn-banner">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h1 class="display-4 mb-4">About Venetian Plaster</h1>
                <p class="lead">We specialize in interior & exterior feature walls, especially TV media walls with premium Venetian plaster finishes.</p>
                
                <h4 class="mt-4">Our Expertise</h4>
                <p>With years of experience working on major productions including films & TV (Batman, Dune, House of the Dragon), we bring cinematic quality to your walls.</p>
                
                <h4 class="mt-4">Our Services</h4>
                <ul>
                    <li>Venetian Plaster Finishes (Marble/Rock aesthetic)</li>
                    <li>TV Media Walls</li>
                    <li>Cornice Work</li>
                    <li>Mouldings & Decorative Elements</li>
                </ul>
                
                <h4 class="mt-4">Our Process</h4>
                <p>View designs → Contact → Outside Consultation → Quote → Execution</p>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="stat-card text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-calendar-alt fa-3x" style="color: #D4AF37;"></i>
                            </div>
                            <h3 class="text-primary mb-0">10+</h3>
                            <p class="mb-0">Years Experience</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="stat-card text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-project-diagram fa-3x" style="color: #8B4513;"></i>
                            </div>
                            <h3 class="text-primary mb-0">500+</h3>
                            <p class="mb-0">Projects Completed</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="stat-card text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-smile fa-3x" style="color: #D4AF37;"></i>
                            </div>
                            <h3 class="text-primary mb-0">100%</h3>
                            <p class="mb-0">Client Satisfaction</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="stat-card text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-headset fa-3x" style="color: #8B4513;"></i>
                            </div>
                            <h3 class="text-primary mb-0">24/7</h3>
                            <p class="mb-0">Support Available</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=600" class="img-fluid rounded" alt="About Us">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Us?</h2>
        <div class="row">
            <!-- Quality Icon -->
            <div class="col-md-4 text-center mb-4">
                <div class="why-choose-card">
                    <div class="icon-circle quality">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h4 class="mt-3">Premium Quality</h4>
                    <p>Highest quality materials and craftsmanship using authentic Venetian plaster techniques</p>
                </div>
            </div>
            
            <!-- Delivery Icon -->
            <div class="col-md-4 text-center mb-4">
                <div class="why-choose-card">
                    <div class="icon-circle delivery">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="mt-3">Timely Delivery</h4>
                    <p>Projects completed on time, every time with attention to detail and deadlines</p>
                </div>
            </div>
            
            <!-- Trophy Icon -->
            <div class="col-md-4 text-center mb-4">
                <div class="why-choose-card">
                    <div class="icon-circle award">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4 class="mt-3">Award Winning</h4>
                    <p>Recognized for excellence in design with work featured in major film productions</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Why Choose Us Section Styling */
.why-choose-card {
    padding: 30px 20px;
    background: white;
    border-radius: 20px;
    transition: all 0.3s ease;
    height: 100%;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.why-choose-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.15);
}

.icon-circle {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.icon-circle.quality {
    background: linear-gradient(135deg, #D4AF37, #FFD700);
    box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
}

.icon-circle.delivery {
    background: linear-gradient(135deg, #8B4513, #CD853F);
    box-shadow: 0 10px 20px rgba(139, 69, 19, 0.3);
}

.icon-circle.award {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
}

.icon-circle i {
    font-size: 3rem;
    color: white;
    filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.2));
}

.why-choose-card h4 {
    color: #8B4513;
    font-weight: 600;
    margin-top: 20px;
}

.why-choose-card p {
    color: #666;
    line-height: 1.6;
}

.stat-card {
    background: white;
    border-radius: 15px;
    transition: all 0.3s ease;
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.stat-card:hover {
    transform: translateY(-5px);
    border-color: #D4AF37;
    box-shadow: 0 10px 25px rgba(212, 175, 55, 0.1);
}

.icon-wrapper i {
    transition: all 0.3s ease;
}

.stat-card:hover .icon-wrapper i {
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .icon-circle {
        width: 80px;
        height: 80px;
    }
    
    .icon-circle i {
        font-size: 2.5rem;
    }
    
    .why-choose-card {
        padding: 20px 15px;
    }
}
</style>
@endsection