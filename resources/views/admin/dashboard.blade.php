{{-- Admin Dashboard --}}
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Page Header -->
<!-- Why border-bottom? Creates visual separation between page title and content, establishing hierarchy -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 fw-bold text-admin-theme mb-0">Admin Dashboard</h1>
        <p class="text-muted small mb-0">System overview and management</p>
    </div>
    <div class="btn-toolbar mt-2 mt-md-0">
        <a href="{{ route('admin.hospitals.index') }}" class="btn btn-outline-primary btn-sm rounded-2 shadow-sm me-2">
            <i data-lucide="building" class="me-1" style="width: 14px; height: 14px;"></i>
            Manage Hospitals
        </a>
        <a href="{{ route('admin.vaccines.create') }}" class="btn btn-outline-success btn-sm rounded-2 shadow-sm">
            <i data-lucide="plus-circle" class="me-1" style="width: 14px; height: 14px;"></i>
            Add Vaccine
        </a>
    </div>
</div>

<!-- Stats Cards Row 1 -->
<div class="row g-3 mb-4">
    <!-- CARD PATTERN EXPLAINED:
     Why border-0? Removes default Bootstrap border for cleaner look
     Why bg-white? White background provides contrast against gray page
     Why rounded-4? Bootstrap's maximum border radius (1rem) creates soft, modern cards
     Why shadow-sm? Subtle elevation adds depth without being heavy
     Why hover-lift? Hover effect signals interactability and adds delight
    -->
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Total Patients</p>
                        <h2 class="card-title display-4 fw-bold text-primary">{{ $totalPatients }}</h2>
                    </div>
                    <!-- Icon wrapper provides consistent size and background for icons -->
                    <div class="icon-wrapper">
                        <i data-lucide="users" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Approved Hospitals</p>
                        <h2 class="card-title display-4 fw-bold text-success">{{ $approvedHospitals }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="building-2" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Pending Approvals</p>
                        <h2 class="card-title display-4 fw-bold text-warning">{{ $pendingHospitals }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="clock" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards Row 2 -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Total Appointments</p>
                        <h2 class="card-title display-4 fw-bold text-info">{{ $totalAppointments }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="calendar-check" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">COVID Tests (Positive)</p>
                        <h2 class="card-title display-4 fw-bold text-danger">{{ $positiveTests }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <!-- Why? Changed from "virus" to "activity" - Lucide v8 doesn't have "virus" icon. "activity" represents health monitoring and is commonly used for test tracking -->
                        <i data-lucide="activity" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Vaccines Available</p>
                        <h2 class="card-title display-4 fw-bold text-secondary">{{ $vaccineCount }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="shield-check" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3">
        <h5 class="fw-bold mb-0">
            <i data-lucide="zap" class="me-2 text-warning" style="width: 20px; height: 20px;"></i>
            Quick Actions
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.hospitals.index') }}" class="btn btn-outline-primary w-100 rounded-2 py-3 shadow-sm hover-lift h-100 d-flex flex-column align-items-center justify-content-center">
                    <i data-lucide="building" class="mb-2" style="width: 28px; height: 28px;"></i>
                    <small class="fw-medium">Review Hospitals</small>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.vaccines.create') }}" class="btn btn-outline-success w-100 rounded-2 py-3 shadow-sm hover-lift h-100 d-flex flex-column align-items-center justify-content-center">
                    <i data-lucide="plus" class="mb-2" style="width: 28px; height: 28px;"></i>
                    <small class="fw-medium">Add Vaccine</small>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-info w-100 rounded-2 py-3 shadow-sm hover-lift h-100 d-flex flex-column align-items-center justify-content-center">
                    <i data-lucide="calendar" class="mb-2" style="width: 28px; height: 28px;"></i>
                    <small class="fw-medium">View Bookings</small>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-warning w-100 rounded-2 py-3 shadow-sm hover-lift h-100 d-flex flex-column align-items-center justify-content-center">
                    <i data-lucide="file-bar-chart" class="mb-2" style="width: 28px; height: 28px;"></i>
                    <small class="fw-medium">Generate Reports</small>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (Placeholder) -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3">
        <h5 class="fw-bold mb-0">
            <i data-lucide="activity" class="me-2 text-muted" style="width: 20px; height: 20px;"></i>
            Recent Activity
        </h5>
    </div>
    <div class="card-body">
        <div class="empty-state">
            <i data-lucide="inbox" style="width: 64px; height: 64px;"></i>
            <h5 class="text-muted">No recent activity</h5>
            <p class="text-muted mb-3">Recent appointments, registrations, and updates will appear here when the database is connected.</p>
            <a href="{{ route('admin.hospitals.index') }}" class="btn btn-primary rounded-2">
                <i data-lucide="building" class="me-2" style="width: 16px; height: 16px;"></i>
                Manage Hospitals
            </a>
        </div>
    </div>
</div>
@endsection
