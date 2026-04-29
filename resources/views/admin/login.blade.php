<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Venetian Plaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #F5F0E8;
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(135deg, rgba(197, 160, 89, 0.05) 0%, rgba(44, 62, 80, 0.02) 100%),
                repeating-linear-gradient(45deg, rgba(197, 160, 89, 0.02) 0px, rgba(197, 160, 89, 0.02) 2px, transparent 2px, transparent 8px);
            pointer-events: none;
        }
        
        /* Decorative circles */
        body::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(197, 160, 89, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            padding: 45px 40px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(197, 160, 89, 0.2);
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.12);
        }
        
        /* Logo/Brand Section */
        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .brand-logo h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2C3E50;
            margin: 0;
        }
        
        .brand-logo h2 span {
            color: #C5A059;
        }
        
        .brand-logo p {
            color: #718096;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .brand-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #F8F6F2, #FFF);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 2px solid #C5A059;
        }
        
        .brand-icon i {
            font-size: 2rem;
            color: #C5A059;
        }
        
        /* Form Styles */
        .form-label {
            font-weight: 500;
            color: #4A5568;
            font-size: 0.85rem;
            margin-bottom: 6px;
        }
        
        .form-control {
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            padding: 10px 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #C5A059;
            box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.1);
            outline: none;
        }
        
        .input-group-text {
            background: #F8F6F2;
            border: 1px solid #E2E8F0;
            border-right: none;
            color: #718096;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group .form-control:focus {
            border-left: none;
        }
        
        /* Button Styles */
        .btn-login {
            background: #C5A059;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
            color: white;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background: #B08D4A;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.85rem;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background: #FEF2F2;
            color: #E53E3E;
            border-left: 3px solid #E53E3E;
        }
        
        /* Links */
        .forgot-link {
            color: #718096;
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .forgot-link:hover {
            color: #C5A059;
        }
        
        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
        }
        
        .login-footer small {
            color: #A0AEC0;
            font-size: 0.75rem;
        }
        
        .demo-credentials {
            background: #F8F6F2;
            border-radius: 8px;
            padding: 10px;
            margin-top: 15px;
        }
        
        .demo-credentials p {
            margin: 0;
            font-size: 0.75rem;
            color: #718096;
        }
        
        .demo-credentials code {
            background: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            color: #C5A059;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 30px 25px;
                margin: 20px;
            }
            
            .brand-logo h2 {
                font-size: 1.5rem;
            }
            
            .brand-icon {
                width: 60px;
                height: 60px;
            }
            
            .brand-icon i {
                font-size: 1.5rem;
            }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-card {
            animation: fadeInUp 0.6s ease;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-card">
                        <div class="brand-logo">
                            <div class="brand-icon">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <h2>Venetian <span>Plaster</span></h2>
                            <p>Admin Portal</p>
                        </div>
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="admin@venetian.com" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="••••••••" required>
                                </div>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember" style="font-size: 0.85rem; color: #718096;">
                                    Remember me
                                </label>
                            </div>
                            
                            <button type="submit" class="btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>
                        
                        <div class="demo-credentials">
                            <p class="text-center mb-1">
                                <i class="fas fa-info-circle me-1"></i>Demo Credentials:
                            </p>
                            <p class="text-center">
                                <code>admin@venetian.com</code> / <code>1234567890</code>
                            </p>
                        </div>
                        
                        <div class="login-footer">
                            <small>© {{ date('Y') }} Venetian Plaster. All rights reserved.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>