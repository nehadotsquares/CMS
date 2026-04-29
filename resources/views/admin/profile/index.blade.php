@extends('admin.layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Image Card -->
            <div class="profile-card">
                <div class="profile-header">
                    @if($admin->avatar)
                        <img src="{{ asset($admin->avatar) }}" alt="Avatar" class="profile-avatar" id="profileAvatar">
                    @else
                        <div class="profile-avatar-initial" id="profileAvatar">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </div>
                    @endif
                    <h4 class="mt-3">{{ $admin->name }}</h4>
                    <p class="mb-0">{{ $admin->email }}</p>
                    <p><small>Member since: {{ $admin->created_at->format('M d, Y') }}</small></p>
                </div>
                <div class="p-4">
                    <form action="{{ route('admin.profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                        @csrf
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Change Profile Picture</label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-upload me-2"></i>Upload New Picture
                        </button>
                    </form>
                    
                    @if($admin->avatar)
                    <form action="{{ route('admin.profile.avatar.remove') }}" method="POST" id="removeAvatarForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger w-100" id="removeAvatarBtn">
                            <i class="fas fa-trash me-2"></i>Remove Picture
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <!-- Update Profile Information -->
            <div class="profile-card mb-4">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>Profile Information
                    </h5>
                </div>
                <div class="p-4">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Change Password -->
            <div class="profile-card" id="settings">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-key me-2"></i>Change Password
                    </h5>
                </div>
                <div class="p-4">
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password" required>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                       id="new_password" name="new_password" required>
                            </div>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Password must be at least 6 characters</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <input type="password" class="form-control" 
                                       id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-lock me-2"></i>Change Password
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Session Information -->
            <div class="profile-card mt-4">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Account Information
                    </h5>
                </div>
                <div class="p-4">
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Account Created:</span>
                        </div>
                        <div class="info-value">
                            {{ $admin->created_at->format('F d, Y h:i A') }}
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-clock"></i>
                            <span>Last Updated:</span>
                        </div>
                        <div class="info-value">
                            {{ $admin->updated_at->format('F d, Y h:i A') }}
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-shield-alt"></i>
                            <span>Account Status:</span>
                        </div>
                        <div class="info-value">
                            <span class="status-badge status-active">
                                <i class="fas fa-check-circle me-1"></i>Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Profile Card Styles */
.profile-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    border: 1px solid #E2E8F0;
}

.profile-header {
    background: linear-gradient(135deg, #2C3E50 0%, #1A2A3A 100%);
    padding: 40px;
    text-align: center;
    color: white;
    position: relative;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #C5A059;
    object-fit: cover;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.profile-avatar:hover {
    transform: scale(1.05);
}

.profile-avatar-initial {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #C5A059;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    font-weight: 600;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    transition: transform 0.3s ease;
}

.profile-avatar-initial:hover {
    transform: scale(1.05);
}

.card-header-custom {
    padding: 18px 24px;
    background: #F8F6F2;
    border-bottom: 1px solid #E2E8F0;
}

.card-header-custom h5 {
    color: #2C3E50;
    font-weight: 600;
    margin: 0;
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

/* Buttons */
.btn-primary {
    background: #C5A059 !important;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-primary:hover {
    background: #B08D4A !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(197, 160, 89, 0.3);
}

.btn-warning {
    background: #ED8936 !important;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 500;
    color: white;
    transition: all 0.3s;
}

.btn-warning:hover {
    background: #DD6B20 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(237, 137, 54, 0.3);
    color: white;
}

.btn-danger {
    background: #E53E3E !important;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-danger:hover {
    background: #C53030 !important;
    transform: translateY(-2px);
}

/* Info Rows */
.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #F0F0F0;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #718096;
    font-size: 0.85rem;
}

.info-label i {
    width: 20px;
    color: #C5A059;
}

.info-value {
    color: #2C3E50;
    font-weight: 500;
    font-size: 0.85rem;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-active {
    background: #F0FFF4;
    color: #48BB78;
}

/* Text Muted */
.text-muted {
    color: #A0AEC0 !important;
    font-size: 0.7rem;
    margin-top: 5px;
    display: block;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-header {
        padding: 25px;
    }
    
    .profile-avatar, .profile-avatar-initial {
        width: 90px;
        height: 90px;
        font-size: 2rem;
    }
    
    .info-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .card-header-custom {
        padding: 15px 20px;
    }
    
    .p-4 {
        padding: 20px !important;
    }
}
</style>

@push('scripts')
<script>
// Preview avatar before upload
document.getElementById('avatar')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.profile-avatar');
            const previewInitial = document.querySelector('.profile-avatar-initial');
            if (preview) {
                preview.src = e.target.result;
            }
            if (previewInitial) {
                // Replace initial with image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'profile-avatar';
                img.alt = 'Avatar';
                previewInitial.parentNode.replaceChild(img, previewInitial);
            }
        };
        reader.readAsDataURL(file);
    }
});

// Remove avatar with confirmation
document.getElementById('removeAvatarBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Remove Profile Picture?',
        text: "Are you sure you want to remove your profile picture?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('removeAvatarForm').submit();
        }
    });
});
</script>
@endpush
@endsection