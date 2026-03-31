{{-- Patient - My Profile --}}
@extends('layouts.patient')

@section('title', 'My Profile')

@section('breadcrumb')
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="row justify-content-center animate-fadeIn">
    <div class="col-lg-8">
        <!-- Main Profile Card -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden glass-card">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h4 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i data-lucide="user-cog" class="text-primary"></i>
                    My Profile Settings
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('patient.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="user" style="width: 16px;"></i></span>
                                <input type="text" name="name" class="form-control border-0 bg-light rounded-end-3" required value="{{ old('name', auth()->user()->name) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="mail" style="width: 16px;"></i></span>
                                <input type="email" name="email" class="form-control border-0 bg-light rounded-end-3" required value="{{ old('email', auth()->user()->email) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="phone" style="width: 16px;"></i></span>
                                <input type="text" name="phone" class="form-control border-0 bg-light rounded-end-3" value="{{ old('phone', auth()->user()->phone) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">City</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="map-pin" style="width: 16px;"></i></span>
                                <input type="text" name="city" class="form-control border-0 bg-light rounded-end-3" value="{{ old('city', auth()->user()->city) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Residential Address</label>
                        <textarea name="address" class="form-control border-0 bg-light rounded-3" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
                    </div>

                    <div class="bg-light p-4 rounded-4 mb-4 border-start border-4 border-primary shadow-sm bg-opacity-50">
                        <h6 class="fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i data-lucide="shield-lock" style="width: 18px;"></i>
                            Security & Password
                        </h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-muted small">Current Password (Required to change email or password)</label>
                                <input type="password" name="current_password" class="form-control border-0 rounded-3">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">New Password</label>
                                <input type="password" name="new_password" class="form-control border-0 rounded-3">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control border-0 rounded-3">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i data-lucide="save" class="me-2" style="width: 18px;"></i>
                            Update Profile
                        </button>
                        <button type="button" class="btn btn-outline-danger border-0 rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i data-lucide="trash-2" class="me-2" style="width: 18px;"></i>
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Meta Info Card -->
        <div class="card border-0 shadow-sm rounded-4 mt-4 bg-primary bg-opacity-10 text-primary overflow-hidden">
            <div class="card-body py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle p-2 shadow-sm">
                        <i data-lucide="info" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div>
                        <span class="small fw-medium opacity-75">Member Since:</span>
                        <span class="small fw-bold ms-1">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                <div>
                    <span class="small fw-medium opacity-75">Last Activity:</span>
                    <span class="small fw-bold ms-1 text-dark">{{ auth()->user()->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                <p class="text-danger"><strong>Warning:</strong> All your data including appointments and results will be permanently removed.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('patient.profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
