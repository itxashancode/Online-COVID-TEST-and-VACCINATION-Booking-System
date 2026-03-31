{{-- Hospital Dashboard --}}
@extends('layouts.hospital')

@section('title', 'Hospital Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-hospital-theme mb-1">Hospital Dashboard</h2>
        <p class="text-muted small mb-0">Manage appointments and patient care</p>
    </div>
    <span class="badge bg-hospital text-white px-3 py-2 rounded-pill">
        <i data-lucide="user" class="me-1" style="width: 14px; height: 14px; vertical-align: middle;"></i>
        {{ auth()->user()->name }}
    </span>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Pending Requests</p>
                        <h2 class="card-title display-4 fw-bold text-warning">{{ $pendingCount }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="clock" style="width: 32px; height: 32px;"></i>
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
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Approved</p>
                        <h2 class="card-title display-4 fw-bold text-success">{{ $approvedCount }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="check-circle" style="width: 32px; height: 32px;"></i>
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
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Completed</p>
                        <h2 class="card-title display-4 fw-bold text-secondary">{{ $completedCount }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="check-square" style="width: 32px; height: 32px;"></i>
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
            <i data-lucide="zap" class="me-2 text-hospital" style="width: 20px; height: 20px;"></i>
            Quick Actions
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <a href="{{ route('hospital.appointments.index') }}" class="btn btn-outline-primary w-100 rounded-2 py-3 shadow-sm hover-lift d-flex align-items-center">
                    <i data-lucide="calendar-check" class="me-3" style="width: 24px; height: 24px;"></i>
                    <div class="text-start">
                        <div class="fw-medium">View Appointment Requests</div>
                        <small class="text-muted">Review and manage pending appointments</small>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('hospital.patients.index') }}" class="btn btn-outline-success w-100 rounded-2 py-3 shadow-sm hover-lift d-flex align-items-center">
                    <i data-lucide="users" class="me-3" style="width: 24px; height: 24px;"></i>
                    <div class="text-start">
                        <div class="fw-medium">View Approved Patients</div>
                        <small class="text-muted">Access patient records and history</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Appointments -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i data-lucide="clock-3" class="me-2 text-hospital" style="width: 20px; height: 20px;"></i>
            Recent Appointment Requests
        </h5>
        <a href="{{ route('hospital.appointments.index') }}" class="btn btn-outline-success btn-sm rounded-2">
            View All
        </a>
    </div>
    <div class="card-body pb-4">
        @if($recentAppointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAppointments as $appointment)
                        <tr>
                            <td class="fw-medium">{{ $appointment->patient->name }}</td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark rounded-pill px-3 py-2">COVID Test</span>
                                @else
                                    <span class="badge bg-primary rounded-pill px-3 py-2">Vaccination</span>
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'approved' ? 'success' : 'danger') }} rounded-pill px-3 py-2">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-sm btn-primary rounded-2 shadow-sm">
                                        <i data-lucide="eye" class="me-1" style="width: 14px; height: 14px;"></i>
                                        Review
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i data-lucide="clipboard-list" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No appointment requests yet</h5>
                <p class="text-muted mb-3">When patients book appointments, they'll appear here for your review.</p>
                <a href="{{ route('patient.search') }}" class="btn btn-hospital rounded-2 px-4" target="_blank">
                    <i data-lucide="user-plus" class="me-2" style="width: 16px; height: 16px;"></i>
                    Invite Patients
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
