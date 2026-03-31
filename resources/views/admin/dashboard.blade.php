{{-- Admin Dashboard --}}
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Admin Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.hospitals.index') }}" class="btn btn-sm btn-outline-secondary">Manage Hospitals</a>
        <a href="{{ route('admin.vaccines.index') }}" class="btn btn-sm btn-outline-secondary ms-2">Manage Vaccines</a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Total Patients</h6>
                        <h2 class="card-title">{{-- $totalPatients --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">👥</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Approved Hospitals</h6>
                        <h2 class="card-title">{{-- $approvedHospitals --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">🏥</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Pending Approvals</h6>
                        <h2 class="card-title">{{-- $pendingHospitals --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">⏳</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-info text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Total Appointments</h6>
                        <h2 class="card-title">{{-- $totalAppointments --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">📅</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">COVID Tests (Pos)</h6>
                        <h2 class="card-title">{{-- $positiveTests --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">🦠</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Vaccines Available</h6>
                        <h2 class="card-title">{{-- $vaccineCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">💉</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Quick Actions</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-2">
                <a href="{{ route('admin.hospitals.index') }}" class="btn btn-outline-primary w-100">Review Hospital Registrations</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('admin.vaccines.create') }}" class="btn btn-outline-success w-100">Add New Vaccine</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-info w-100">View All Bookings</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-warning w-100">Generate Reports</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (Placeholder) -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Recent Activity</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Recent appointments, registrations, and updates will appear here when database is connected.</p>
    </div>
</div>
@endsection
