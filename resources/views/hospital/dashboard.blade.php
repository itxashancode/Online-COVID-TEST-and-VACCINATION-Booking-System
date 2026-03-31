{{-- Hospital Dashboard --}}
@extends('layouts.hospital')

@section('title', 'Hospital Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Hospital Dashboard</h2>
    <span class="badge bg-info text-dark">{{ auth()->user()->name }}</span>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-warning text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Pending Requests</h6>
                        <h2 class="card-title">{{-- $pendingCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">⏳</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Approved</h6>
                        <h2 class="card-title">{{-- $approvedCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">✅</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Completed</h6>
                        <h2 class="card-title">{{-- $completedCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">✔️</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Quick Actions</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-2">
                <a href="{{ route('hospital.appointments.index') }}" class="btn btn-outline-primary w-100">
                    View Appointment Requests
                </a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('hospital.patients.index') }}" class="btn btn-outline-success w-100">
                    View Approved Patients
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Appointments -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Appointment Requests</h5>
        <a href="{{ route('hospital.appointments.index') }}" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="card-body">
        @if(/*$recentAppointments->count()*/ false)
            <div class="table-responsive">
                <table class="table table-sm table-striped">
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
                            <td>{{ $appointment->patient->name }}</td>
                            <td>{{ $appointment->appointment_type == 'covid_test' ? 'COVID Test' : 'Vaccination' }}</td>
                            <td>{{ $appointment->appointment_date->format('M d') }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-sm btn-primary">Review</a>
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
            <p class="text-muted text-center">No appointment requests yet.</p>
        @endif
    </div>
</div>
@endsection
