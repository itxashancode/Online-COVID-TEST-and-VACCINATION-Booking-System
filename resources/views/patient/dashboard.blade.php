{{-- Patient Dashboard --}}
@extends('layouts.patient')

@section('title', 'My Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Page Header -->
<!-- Why? Clear page title with subtle CTA buttons helps patient understand where they are and what they can do -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-patient-theme mb-1">My Dashboard</h2>
        <p class="text-muted small mb-0">Manage your COVID test and vaccination bookings</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('patient.search') }}" class="btn btn-outline-primary rounded-2 shadow-sm">
            <i data-lucide="search" class="me-2" style="width: 16px; height: 16px;"></i>
            Find Hospital
        </a>
        <!-- Why btn-primary? Primary actions should stand out - booking an appointment is the main task for patients -->
        <a href="{{ route('patient.appointments.create') }}" class="btn btn-primary rounded-2 shadow-sm">
            <i data-lucide="calendar-plus" class="me-2" style="width: 16px; height: 16px;"></i>
            Book Appointment
        </a>
    </div>
</div>

<!-- Stats Cards Row -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 bg-white rounded-4 shadow-sm h-100 hover-lift">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Upcoming Appointments</p>
                        <h2 class="card-title display-4 fw-bold text-primary">{{ $upcomingCount }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="calendar" style="width: 32px; height: 32px;"></i>
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
                        <h2 class="card-title display-4 fw-bold text-success">{{ $completedCount }}</h2>
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
                        <p class="text-muted fw-medium text-uppercase fs-6 mb-2">Test Results</p>
                        <h2 class="card-title display-4 fw-bold text-info">{{ $resultsCount }}</h2>
                    </div>
                    <div class="icon-wrapper">
                        <i data-lucide="file-text" style="width: 32px; height: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Appointments -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i data-lucide="clock" class="me-2 text-primary" style="width: 20px; height: 20px;"></i>
            Upcoming Appointments
        </h5>
        <a href="{{ route('patient.appointments.index') }}" class="btn btn-outline-primary btn-sm rounded-2">
            View All
        </a>
    </div>
    <div class="card-body pb-4">
        @if($upcomingAppointments->count() > 0)
            <!-- Why table-responsive? Ensures tables scroll horizontally on mobile instead of breaking layout -->
            <div class="table-responsive">
                <!-- Why table-hover? Row hover effect improves readability for long lists -->
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Hospital</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingAppointments as $appointment)
                        <tr>
                            <td class="fw-medium">{{ $appointment->hospital->hospital_name }}</td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark rounded-pill px-3 py-2">COVID Test</span>
                                @else
                                    <span class="badge bg-primary rounded-pill px-3 py-2">Vaccination</span>
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
                            <td>{{ $appointment->appointment_time ?? '--:--' }}</td>
                            <td>
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">{{ ucfirst($appointment->status) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">Wait for hospital approval</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- EMPTY STATE: Beautiful design instead of boring text -->
            <div class="empty-state">
                <i data-lucide="calendar-x" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No upcoming appointments</h5>
                <p class="text-muted mb-3">Ready to protect yourself? Book a COVID test or vaccination appointment today.</p>
                <a href="{{ route('patient.appointments.create') }}" class="btn btn-primary rounded-2 px-4">
                    <i data-lucide="plus" class="me-2" style="width: 16px; height: 16px;"></i>
                    Book Now
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Recent Results -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i data-lucide="file-check" class="me-2 text-success" style="width: 20px; height: 20px;"></i>
            Recent Test Results
        </h5>
        <a href="{{ route('patient.results.index') }}" class="btn btn-outline-success btn-sm rounded-2">
            View All
        </a>
    </div>
    <div class="card-body pb-4">
        @if($recentResults->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hospital</th>
                            <th>Result</th>
                            <th>Doctor Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentResults as $result)
                        <tr>
                            <td class="fw-medium">{{ $result->result_date ?? $result->created_at->format('M d, Y') }}</td>
                            <td>{{ $result->hospital->hospital_name ?? 'N/A' }}</td>
                            <td>
                                @if($result->result == 'positive')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Positive</span>
                                @elseif($result->result == 'negative')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Negative</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ Str::limit($result->doctor_notes, 50) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i data-lucide="file-search" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No test results yet</h5>
                <p class="text-muted mb-3">Complete a COVID test appointment to view your results here.</p>
                <a href="{{ route('patient.search') }}" class="btn btn-primary rounded-2 px-4">
                    <i data-lucide="search" class="me-2" style="width: 16px; height: 16px;"></i>
                    Find Testing Location
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Vaccination History -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3">
        <h5 class="fw-bold mb-0">
            <i data-lucide="shield-check" class="me-2 text-success" style="width: 20px; height: 20px;"></i>
            Vaccination History
        </h5>
    </div>
    <div class="card-body pb-4">
        @if($vaccinationRecords->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hospital</th>
                            <th>Vaccine</th>
                            <th>Dose</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vaccinationRecords as $record)
                        <tr>
                            <td class="fw-medium">{{ $record->vaccination_date }}</td>
                            <td>{{ $record->hospital->hospital_name ?? 'N/A' }}</td>
                            <td>{{ $record->vaccine->vaccine_name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($record->dose) }}</td>
                            <td>
                                <span class="badge bg-{{ $record->status == 'completed' ? 'success' : 'warning' }} text-dark rounded-pill px-3 py-2">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i data-lucide="shield-alert" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No vaccination records</h5>
                <p class="text-muted mb-3">Stay protected against COVID-19. Schedule your vaccination today.</p>
                <a href="{{ route('patient.appointments.create') }}" class="btn btn-success rounded-2 px-4">
                    <i data-lucide="calendar-plus" class="me-2" style="width: 16px; height: 16px;"></i>
                    Book Vaccination
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
