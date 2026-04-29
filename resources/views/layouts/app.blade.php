<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Venetian Plaster & Media Walls')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gold: #D4AF37;
            --silver: #C0C0C0;
            --brown: #8B4513;
            --cream: #FFF8E7;
            --marble: #F5F5F5;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--brown);
            font-size: 1.8rem;
        }
        
        .navbar-brand span {
            color: var(--gold);
        }
        
        .nav-link {
            color: #333;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .nav-link:hover {
            color: var(--gold);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--cream) 0%, #fff 100%);
            padding: 100px 0;
            position: relative;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--brown);
        }
        
        .hero-title span {
            color: var(--gold);
        }
        
        .btn-gold {
            background: var(--gold);
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: 0.3s;
        }
        
        .btn-gold:hover {
            background: #b8941f;
            color: #fff;
            transform: translateY(-2px);
        }
        
        .service-card, .gallery-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
            margin-bottom: 30px;
        }
        
        .service-card:hover, .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .service-card img, .gallery-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .service-card .content, .gallery-card .content {
            padding: 20px;
        }
        
        .service-card h4, .gallery-card h4 {
            color: var(--brown);
            margin-bottom: 10px;
        }
        
        .finish-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-right: 5px;
        }
        
        .finish-gold { background: var(--gold); color: #fff; }
        .finish-silver { background: var(--silver); color: #fff; }
        .finish-brown { background: var(--brown); color: #fff; }
        
        footer {
            background: #2c2c2c;
            color: #fff;
            padding: 50px 0 20px;
            /* margin-top: 50px; */
        }
        
        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .flash-message {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .gallery-modal img {
            width: 100%;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .gallery-modal img:hover {
            transform: scale(1.05);
        }

        /* Custom Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 40px 0 20px;
            flex-wrap: wrap;
        }

        .pagination .page-item {
            list-style: none;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            color: #8B4513;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        /* Hover effect */
        .pagination .page-link:hover {
            background: linear-gradient(135deg, #D4AF37, #FFD700);
            border-color: #D4AF37;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        /* Active page */
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #D4AF37, #FFD700);
            border-color: #D4AF37;
            color: white;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
        }

        /* Disabled state */
        .pagination .page-item.disabled .page-link {
            background: #f5f5f5;
            border-color: #e0e0e0;
            color: #999;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Previous and Next buttons specific styling */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            font-weight: 600;
            padding: 0 20px;
        }

        .pagination .page-item:first-child .page-link {
            border-radius: 12px;
        }

        .pagination .page-item:last-child .page-link {
            border-radius: 12px;
        }

        /* Add icons for previous/next */
        .pagination .page-item:first-child .page-link::before {
            /* content: "← "; */
            font-size: 14px;
        }

        .pagination .page-item:last-child .page-link::after {
            /* content: " →"; */
            font-size: 14px;
        }

        /* Alternative: If you want to use Font Awesome icons instead */
        .pagination .page-item:first-child .page-link i,
        .pagination .page-item:last-child .page-link i {
            font-size: 14px;
        }

        /* Responsive pagination */
        @media (max-width: 768px) {
            .pagination {
                gap: 5px;
            }
            
            .pagination .page-link {
                min-width: 35px;
                height: 35px;
                padding: 0 8px;
                font-size: 12px;
            }
            
            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                padding: 0 12px;
            }
        }

        /* Animation for page change */
        .pagination .page-link {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stylish ellipsis */
        .pagination .page-item.disabled .page-link {
            background: transparent;
            border: none;
            color: #999;
            font-weight: bold;
        }

        /* Optional: Add a subtle shadow on active page */
        .pagination .page-item.active .page-link {
            position: relative;
        }

        .pagination .page-item.active .page-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: #D4AF37;
            border-radius: 2px;
        }

        /* Page Banner Styles */
        .page-banner {
            position: relative;
            padding: 100px 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-blend-mode: overlay;
            margin-bottom: 50px;
        }

        /* Default banner for pages without specific image */
        .page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 100%);
            z-index: 1;
        }

        .page-banner .container {
            position: relative;
            z-index: 2;
        }

        .banner-content {
            color: white;
            animation: fadeInUp 0.8s ease;
        }

        .banner-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            background: linear-gradient(135deg, #fff, #D4AF37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .banner-subtitle {
            font-size: 1.2rem;
            opacity: 0.95;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        /* Breadcrumb styling */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 20px;
        }

        .breadcrumb-item {
            color: rgba(255,255,255,0.8);
        }

        .breadcrumb-item a {
            color: #D4AF37;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: #FFD700;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.6);
            content: "›";
            font-size: 1.2rem;
        }

        /* Banner button */
        .btn-banner {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #D4AF37, #FFD700);
            color: #333;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            margin-top: 10px;
        }

        .btn-banner:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: #333;
        }

        /* Different banner variations */
        .page-banner.services-banner {
            background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1920');
        }

        .page-banner.gallery-banner {
            background-image: url('https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=1920');
        }

        .page-banner.contact-banner {
            background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1920');
        }

        .page-banner.about-banner {
            background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1920');
        }

        .page-banner.home-banner {
            min-height: 500px;
            display: flex;
            align-items: center;
            background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1920');
        }

        /* Small banner variation */
        .page-banner.small {
            padding: 60px 0;
        }

        .page-banner.small .banner-title {
            font-size: 2.5rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-banner {
                padding: 60px 0;
            }
            
            .banner-title {
                font-size: 2rem;
            }
            
            .banner-subtitle {
                font-size: 1rem;
            }
            
            .page-banner.home-banner {
                min-height: 400px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navigation')
    
    @if(session('success'))
        <div class="alert alert-success flash-message">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            document.querySelectorAll('.flash-message').forEach(el => el.remove());
        }, 5000);
    </script>
    @stack('scripts')
</body>
</html>