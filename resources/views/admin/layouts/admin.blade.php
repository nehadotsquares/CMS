<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
   <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Inter', sans-serif;
        background: #F5F0E8; /* Soft warm cream */
        overflow-x: hidden;
    }
    
    /* Sidebar Styles - Dark elegant theme */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 280px;
        background: linear-gradient(135deg, #1E2A38 0%, #0F1A24 100%);
        color: #E8E8E8;
        transition: all 0.3s;
        z-index: 1000;
        box-shadow: 2px 0 20px rgba(0,0,0,0.1);
    }
    
    .sidebar-header {
        padding: 25px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        margin-bottom: 20px;
    }
    
    .sidebar-header h3 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 700;
        color: #E8E8E8;
        letter-spacing: -0.5px;
    }
    
    .sidebar-header h3 span {
        color: #C5A059;
        font-weight: 800;
    }
    
    .sidebar-header p {
        font-size: 0.75rem;
        opacity: 0.6;
        margin: 5px 0 0;
    }
    
    .sidebar-nav {
        padding: 0 15px;
    }
    
    .sidebar-nav a {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        margin: 5px 0;
        color: rgba(232,232,232,0.7);
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .sidebar-nav a i {
        width: 24px;
        margin-right: 12px;
        font-size: 1.1rem;
    }
    
    .sidebar-nav a:hover {
        background: rgba(197, 160, 89, 0.15);
        color: #C5A059;
        transform: translateX(3px);
    }
    
    .sidebar-nav a.active {
        background: rgba(197, 160, 89, 0.2);
        color: #C5A059;
        border-left: 3px solid #C5A059;
    }
    
    .sidebar-nav a.active i {
        color: #C5A059;
    }
    
    /* Main Content */
    .main-content {
        margin-left: 280px;
        min-height: 100vh;
        transition: all 0.3s;
    }
    
    
    /* Top Navbar Styles */
    .top-navbar {
        background: white;
        padding: 12px 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 999;
        border-bottom: 1px solid #E2E8F0;
    }

    .page-title-wrapper {
        display: flex;
        align-items: center;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2C3E50;
        margin: 0;
        position: relative;
    }

    .page-title::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 20px;
        background: #C5A059;
        border-radius: 2px;
    }

    /* User Dropdown */
    .user-dropdown {
        position: relative;
        cursor: pointer;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 6px 16px 6px 12px;
        border-radius: 50px;
        transition: all 0.3s ease;
        background: #F8F6F2;
        border: 1px solid #E2E8F0;
    }

    .user-info:hover {
        background: #EDE8E0;
        border-color: #C5A059;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #C5A059;
    }

    .user-avatar-initial {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #C5A059;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        border: 2px solid #C5A059;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .user-name {
        font-weight: 600;
        color: #2C3E50;
        font-size: 0.85rem;
    }

    .user-role {
        font-size: 0.7rem;
        color: #718096;
    }

    .dropdown-icon {
        font-size: 0.8rem;
        color: #718096;
        transition: transform 0.3s ease;
    }

    .user-info:hover .dropdown-icon {
        transform: rotate(180deg);
    }

    /* Dropdown Menu */
    .dropdown-menu-custom {
        position: absolute;
        top: 55px;
        right: 0;
        background: white;
        min-width: 280px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: none;
        z-index: 1000;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        animation: fadeIn 0.2s ease;
    }

    .dropdown-menu-custom.show {
        display: block;
    }

    .dropdown-header {
        padding: 20px;
        background: #F8F6F2;
    }

    .dropdown-user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dropdown-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #C5A059;
    }

    .dropdown-avatar-initial {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #C5A059;
        color: white;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .dropdown-user-details {
        flex: 1;
    }

    .dropdown-user-name {
        font-weight: 600;
        color: #2C3E50;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .dropdown-user-email {
        font-size: 0.75rem;
        color: #718096;
    }

    .dropdown-menu-custom a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #4A5568;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 500;
        font-size: 0.85rem;
        gap: 10px;
    }

    .dropdown-menu-custom a:hover {
        background: #F8F6F2;
        color: #C5A059;
        padding-left: 24px;
    }

    .dropdown-menu-custom a i {
        width: 20px;
        font-size: 1rem;
        color: #718096;
    }

    .dropdown-menu-custom a:hover i {
        color: #C5A059;
    }

    .logout-link {
        color: #E53E3E !important;
    }

    .logout-link i {
        color: #E53E3E !important;
    }

    .logout-link:hover {
        background: #FEF2F2 !important;
        color: #E53E3E !important;
    }

    .dropdown-divider {
        height: 1px;
        background: #E2E8F0;
        margin: 5px 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .top-navbar {
            padding: 10px 20px;
        }
        
        .page-title {
            font-size: 1.1rem;
        }
        
        .page-title::before {
            left: -10px;
            height: 16px;
        }
        
        .user-details {
            display: none;
        }
        
        .user-info {
            padding: 6px 12px;
        }
        
        .dropdown-menu-custom {
            min-width: 260px;
            right: -10px;
        }
        
        .dropdown-user-details {
            display: block;
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Content Area */
    .content-area {
        padding: 25px;
    }
    
    /* Cards */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: 0.3s;
        margin-bottom: 25px;
        border: 1px solid #E2E8F0;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border-color: #C5A059;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 15px;
        background: #F8F6F2;
        color: #C5A059;
    }
    
    .stat-card h3 {
        color: #2C3E50;
        font-weight: 700;
        font-size: 1.8rem;
        margin: 10px 0;
    }
    
    .stat-card p {
        color: #718096;
        font-size: 0.85rem;
        margin: 0;
    }
    
    /* DataTables Customization */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px;
    }
    
    .dataTables_wrapper .dataTables_filter label {
        color: #4A5568;
        font-weight: 500;
        font-size: 0.85rem;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        padding: 8px 16px;
        border: 1px solid #E2E8F0;
        width: 250px;
        background: white;
        font-size: 0.85rem;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #C5A059;
        outline: none;
        box-shadow: 0 0 0 2px rgba(197, 160, 89, 0.1);
    }
    
    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        padding: 5px 24px 5px 10px;
        margin: 0 5px;
        background-color: #fff;
        border: 1px solid #E2E8F0;
        cursor: pointer;
        color: #4A5568;
        font-size: 0.85rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%234A5568' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.6rem center;
        background-size: 12px 10px;
        appearance: none;
    }
    
    .dataTables_wrapper .dataTables_length label {
        color: #4A5568;
        font-weight: 500;
        font-size: 0.85rem;
    }
    
    .dataTable > thead > tr > th {
        background: #F8F6F2;
        font-weight: 600;
        color: #2C3E50;
        border-bottom: 1px solid #E2E8F0;
        padding: 12px;
        font-size: 0.85rem;
    }
    
    .dataTable > tbody > tr > td {
        padding: 10px 12px;
        vertical-align: middle;
        color: #4A5568;
        font-size: 0.85rem;
    }
    
    .dataTable > tbody > tr:hover {
        background: #F8F6F2;
    }
    
    .paginate_button {
        border-radius: 6px !important;
        margin: 0 2px !important;
        border: 1px solid #E2E8F0 !important;
        color: #4A5568 !important;
        background: white !important;
        padding: 5px 10px !important;
        font-size: 0.8rem !important;
    }
    
    .paginate_button:hover {
        background: #C5A059 !important;
        border-color: #C5A059 !important;
        color: white !important;
    }
    
    .paginate_button.current {
        background: #C5A059 !important;
        border-color: #C5A059 !important;
        color: white !important;
    }
    
    /* Buttons */
    .btn-primary {
        background: #C5A059 !important;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        color: white !important;
        font-size: 0.85rem;
    }
    
    .btn-primary:hover {
        background: #B08D4A !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(197, 160, 89, 0.3);
    }
    
    .btn-danger {
        background: #E53E3E !important;
        border: none;
        /* padding: 8px 20px;
        border-radius: 8px; */
        font-weight: 500;
        /* transition: all 0.3s; */
        font-size: 0.85rem;
    }
    
    .btn-danger:hover {
        background: #C53030 !important;
        transform: translateY(-1px);
    }
    
    .btn-warning {
        background: #ED8936 !important;
        border: none;
        color: white;
        font-weight: 500;
        font-size: 0.85rem;
    }
    
    .btn-info {
        background: #4299E1 !important;
        border: none;
        color: white;
        font-size: 0.85rem;
    }
    
    .btn-secondary {
        background: #718096 !important;
        border: none;
        font-size: 0.85rem;
    }
    
    /* Badges */
    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.7rem;
    }
    
    .bg-success {
        background: #48BB78 !important;
    }
    
    .bg-danger {
        background: #E53E3E !important;
    }
    
    .bg-warning {
        background: #ED8936 !important;
        color: white;
    }
    
    .bg-info {
        background: #4299E1 !important;
    }
    
    /* Modals */
    .modal-content {
        border-radius: 16px;
        border: none;
        overflow: hidden;
    }
    
    .modal-header {
        background: #F8F6F2;
        color: #2C3E50;
        border-bottom: 1px solid #E2E8F0;
        padding: 18px 24px;
    }
    
    .modal-title {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    /* Form Controls */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        padding: 8px 12px;
        color: #4A5568;
        font-size: 0.85rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #C5A059;
        box-shadow: 0 0 0 2px rgba(197, 160, 89, 0.1);
    }
    
    .form-label {
        color: #4A5568;
        font-weight: 500;
        font-size: 0.85rem;
        margin-bottom: 6px;
    }
    
    /* Cards */
    .card {
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .card-header {
        background: white;
        border-bottom: 1px solid #E2E8F0;
        padding: 15px 20px;
        font-weight: 600;
        color: #2C3E50;
        font-size: 0.9rem;
    }
    
    .table-container {
        padding: 20px;
    }
    
    /* Action buttons */
    .action-buttons {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }
    
    .action-buttons .btn {
        padding: 4px 10px;
        font-size: 0.7rem;
        border-radius: 6px;
    }
    
    /* Loading overlay */
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(44, 62, 80, 0.7);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    }
    
    .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid #F8F6F2;
        border-top: 3px solid #C5A059;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Profile Card */
    .profile-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #2C3E50, #1A2A3A);
        padding: 30px;
        text-align: center;
        color: white;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #C5A059;
        object-fit: cover;
        margin-bottom: 15px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            left: -280px;
        }
        
        .main-content {
            margin-left: 0;
        }
        
        .sidebar.active {
            left: 0;
        }
        
        .page-title {
            font-size: 1.1rem;
        }
        
        .content-area {
            padding: 15px;
        }
    }
    
    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #F8F6F2;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #CBD5E0;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #A0AEC0;
    }
    
    /* Utility Classes */
    .text-muted {
        color: #718096 !important;
    }
    
    hr {
        border-color: #E2E8F0;
    }
    
    /* Table responsive */
    .table-responsive {
        border-radius: 12px;
    }
</style>
</head>
<body>
    <div id="loading-overlay">
        <div class="spinner"></div>
    </div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Venetian<span>CMS</span></h3>
            <p>Admin Dashboard</p>
        </div>
        
        <div class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell"></i>
                <span>Services</span>
            </a>
            
            <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Gallery</span>
            </a>
            
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span>Contact Inquiries</span>
                @php
                    $unreadCount = \App\Models\Contact::where('status', 'unread')->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger ms-2">{{ $unreadCount }}</span>
                @endif
            </a>
            
            <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
                <span>My Profile</span>
            </a>
        </div>
        
        <div class="position-absolute bottom-0 start-0 w-100 p-3">
            <button type="button" class="btn btn-danger w-100" id="logoutButton" style="border-radius: 50px;">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
            <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="page-title-wrapper">
                <h4 class="page-title">@yield('title', 'Dashboard')</h4>
            </div>
            
            <div class="user-dropdown">
                <div class="user-info" onclick="toggleDropdown()">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" class="user-avatar">
                    @else
                        <div class="user-avatar-initial">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                
                <div class="dropdown-menu-custom" id="dropdownMenu">
                    <div class="dropdown-header">
                        <div class="dropdown-user-info">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" class="dropdown-avatar">
                            @else
                                <div class="dropdown-avatar-initial">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-name">{{ Auth::user()->name }}</div>
                                <div class="dropdown-user-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-circle"></i> My Profile
                    </a>
                    <a href="{{ route('admin.profile') }}#settings">
                        <i class="fas fa-cog"></i> Account Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" id="dropdownLogoutBtn" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    
    <script>
        // Toggle dropdown
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }
        
        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.user-info') && !event.target.closest('.user-info')) {
                const dropdowns = document.getElementsByClassName('dropdown-menu-custom');
                for (let i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
        }
        
        // Logout confirmation
        document.getElementById('logoutButton')?.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of the admin panel!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel',
                background: '#fff',
                backdrop: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
        
        // Dropdown logout button
        document.getElementById('dropdownLogoutBtn')?.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of the admin panel!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>