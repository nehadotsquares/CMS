@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="welcome-section mb-4">
        <h2 class="dashboard-title">Welcome back, {{ Auth::user()->name }}!</h2>
        <p class="dashboard-subtitle">Here's what's happening with your website today.</p>
    </div>
    
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3>{{ $totalServices ?? 0 }}</h3>
                <p>Total Services</p>
                <a href="{{ route('admin.services.index') }}" class="stat-link">
                    Manage Services <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-images"></i>
                </div>
                <h3>{{ $totalGalleries ?? 0 }}</h3>
                <p>Gallery Images</p>
                <a href="{{ route('admin.galleries.index') }}" class="stat-link">
                    Manage Gallery <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>{{ $totalContacts ?? 0 }}</h3>
                <p>Contact Inquiries</p>
                <a href="{{ route('admin.contacts.index') }}" class="stat-link">
                    View Inquiries <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Recent Inquiries Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-card">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-clock me-2"></i>Recent Contact Inquiries
                        </h5>
                        <a href="{{ route('admin.contacts.index') }}" class="view-all-link">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body-custom">
                    <div class="table-responsive">
                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentContacts ?? [] as $contact)
                                <tr>
                                    <td class="contact-name">
                                        <i class="fas fa-user-circle me-2"></i>
                                        {{ $contact->name }}
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $contact->email }}" class="email-link">
                                            <i class="fas fa-envelope me-1"></i>
                                            {{ $contact->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $contact->phone }}" class="phone-link">
                                            <i class="fas fa-phone me-1"></i>
                                            {{ $contact->phone }}
                                        </a>
                                    </td>
                                    <td class="message-preview">
                                        {{ Str::limit($contact->message, 50) }}
                                    </td>
                                    <td>
                                        <span class="date-badge">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $contact->created_at->format('M d, Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($contact->status == 'unread')
                                            <span class="status-badge status-unread">
                                                <i class="fas fa-circle me-1"></i>Unread
                                            </span>
                                        @else
                                            <span class="status-badge status-read">
                                                <i class="fas fa-check-circle me-1"></i>Read
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center empty-state">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p>No inquiries yet</p>
                                        <small>When customers contact you, their messages will appear here</small>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="dashboard-card">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body-custom">
                    <div class="quick-actions">
                        <button type="button" class="quick-action-btn" id="quickAddServiceBtn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add New Service</span>
                        </button>
                        
                        <button type="button" class="quick-action-btn" id="quickAddGalleryBtn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Gallery Image</span>
                        </button>
                        
                        <a href="{{ route('admin.profile') }}" class="quick-action-btn">
                            <i class="fas fa-user-edit"></i>
                            <span>Edit Profile</span>
                        </a>
                        
                        <a href="{{ route('admin.contacts.index') }}" class="quick-action-btn">
                            <i class="fas fa-envelope"></i>
                            <span>View Inquiries</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Custom Styles */
.dashboard-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2C3E50;
    margin-bottom: 5px;
}

.dashboard-subtitle {
    color: #718096;
    font-size: 0.9rem;
    margin: 0;
}

/* Stat Cards */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    border: 1px solid #E2E8F0;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #C5A059, #2C3E50);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    border-color: #C5A059;
}

.stat-icon {
    width: 55px;
    height: 55px;
    background: #F8F6F2;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.stat-icon i {
    font-size: 1.8rem;
    color: #C5A059;
}

.stat-card h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2C3E50;
    margin: 10px 0 5px;
}

.stat-card p {
    color: #718096;
    font-size: 0.85rem;
    margin: 0 0 15px;
}

.stat-link {
    color: #C5A059;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.stat-link:hover {
    color: #B08D4A;
    gap: 8px;
}

/* Dashboard Card */
.dashboard-card {
    background: white;
    border-radius: 16px;
    border: 1px solid #E2E8F0;
    overflow: hidden;
    margin-top: 20px;
}

.card-header-custom {
    padding: 18px 24px;
    background: #F8F6F2;
    border-bottom: 1px solid #E2E8F0;
}

.card-header-custom h5 {
    color: #2C3E50;
    font-weight: 600;
}

.view-all-link {
    color: #C5A059;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s;
}

.view-all-link:hover {
    color: #B08D4A;
}

.card-body-custom {
    padding: 20px 24px;
}

/* Dashboard Table */
.dashboard-table {
    width: 100%;
    border-collapse: collapse;
}

.dashboard-table thead th {
    text-align: left;
    padding: 12px 12px;
    background: #F8F6F2;
    color: #4A5568;
    font-weight: 600;
    font-size: 0.8rem;
    border-bottom: 1px solid #E2E8F0;
}

.dashboard-table tbody td {
    padding: 14px 12px;
    color: #4A5568;
    font-size: 0.85rem;
    border-bottom: 1px solid #F0F0F0;
}

.dashboard-table tbody tr:hover {
    background: #F8F6F2;
}

.contact-name {
    font-weight: 500;
    color: #2C3E50;
}

.email-link, .phone-link {
    color: #718096;
    text-decoration: none;
    transition: color 0.3s;
}

.email-link:hover, .phone-link:hover {
    color: #C5A059;
}

.message-preview {
    color: #718096;
    max-width: 200px;
}

.date-badge {
    color: #718096;
    font-size: 0.75rem;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
}

.status-unread {
    background: #FEF2F2;
    color: #E53E3E;
}

.status-read {
    background: #F0FFF4;
    color: #48BB78;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 40px;
    color: #A0AEC0;
}

.empty-state i {
    color: #CBD5E0;
}

.empty-state p {
    margin: 10px 0 5px;
    font-size: 0.9rem;
}

.empty-state small {
    font-size: 0.75rem;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 12px 20px;
    background: #F8F6F2;
    border-radius: 10px;
    text-decoration: none;
    color: #4A5568;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.3s;
    border: 1px solid #E2E8F0;
    cursor: pointer;
    width: 100%;
}

.quick-action-btn i {
    font-size: 1rem;
    color: #C5A059;
}

.quick-action-btn:hover {
    background: #C5A059;
    color: white;
    transform: translateY(-2px);
    border-color: #C5A059;
}

.quick-action-btn:hover i {
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-title {
        font-size: 1.4rem;
    }
    
    .stat-card h3 {
        font-size: 1.5rem;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
    
    .dashboard-table {
        font-size: 0.75rem;
    }
    
    .dashboard-table tbody td {
        padding: 10px 8px;
    }
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    // Quick Add Service - Open Service Modal
    $('#quickAddServiceBtn').on('click', function() {
        // Reset service form
        if ($('#serviceForm').length) {
            $('#serviceForm')[0].reset();
            $('#service_id').val('');
            $('#currentImage').html('');
            $('#modalTitle').html('<i class="fas fa-plus-circle me-2"></i>Add Service');
            // Show modal
            $('#serviceModal').modal('show');
        } else {
            // If modal not found on dashboard, redirect to services page
            window.location.href = '{{ route("admin.services.index") }}';
        }
    });
    
    // Quick Add Gallery - Open Gallery Modal
    $('#quickAddGalleryBtn').on('click', function() {
        // Reset gallery form
        if ($('#galleryForm').length) {
            $('#galleryForm')[0].reset();
            $('#gallery_id').val('');
            $('#currentGalleryImage').html('');
            $('#galleryModalTitle').text('Add Gallery Image');
            // Show modal
            $('#galleryModal').modal('show');
        } else {
            // If modal not found on dashboard, redirect to gallery page
            window.location.href = '{{ route("admin.galleries.index") }}';
        }
    });
});
</script>
@endpush
@endsection