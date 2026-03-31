{{-- Patient Dashboard --}}
@extends('layouts.patient')

@section('title', 'My Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Patient Dashboard</h2>
    <div>
        <a href="{{ route('patient.search') }}" class="btn btn-primary">🏥 Find Hospital</a>
        <a href="{{ route('patient.appointments.create') }}" class="btn btn-success">📅 Book Appointment</a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Upcoming Appointments</h6>
                        <h2 class="card-title">{{-- $upcomingCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">📅</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Completed</h6>
                        <h2 class="card-title">{{-- $completedCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">✅</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-1">Test Results</h6>
                        <h2 class="card-title">{{-- $resultsCount --}}0</h2>
                    </div>
                    <div class="fs-1 opacity-50">🦠</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Appointments -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Upcoming Appointments</h5>
        <a href="{{ route('patient.appointments.index') }}" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="card-body">
        @if(/*$upcomingAppointments->count()*/ false)
            <div class="table-responsive">
                <table class="table table-sm table-striped">
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
                            <td>{{ $appointment->hospital->hospital_name }}</td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark">COVID Test</span>
                                @else
                                    <span class="badge bg-primary">Vaccination</span>
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
                            <td>{{ $appointment->appointment_time ?? '--:--' }}</td>
                            <td><span class="badge bg-warning text-dark">{{ ucfirst($appointment->status) }}</span></td>
                            <td>
                                <small class="text-muted">Wait for hospital approval</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3">No upcoming appointments. <a href="{{ route('patient.appointments.create') }}">Book one now!</a></p>
        @endif
    </div>
</div>

<!-- Recent Results -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Test Results</h5>
        <a href="{{ route('patient.results.index') }}" class="btn btn-sm btn-info">View All</a>
    </div>
    <div class="card-body">
        @if(/*$recentResults->count()*/ false)
            <div class="table-responsive">
                <table class="table table-sm table-striped">
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
                            <td>{{ $result->result_date ?? $result->created_at->format('M d, Y') }}</td>
                            <td>{{ $result->hospital->hospital_name ?? 'N/A' }}</td>
                            <td>
                                @if($result->result == 'positive')
                                    <span class="badge bg-danger">Positive</span>
                                @elseif($result->result == 'negative')
                                    <span class="badge bg-success">Negative</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($result->doctor_notes, 50) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3">No test results yet.</p>
        @endif
    </div>
</div>

<!-- Vaccination History -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Vaccination History</h5>
    </div>
    <div class="card-body">
        @if(/*$vaccinationRecords->count()*/ false)
            <div class="table-responsive">
                <table class="table table-sm table-striped">
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
                            <td>{{ $record->vaccination_date }}</td>
                            <td>{{ $record->hospital->hospital_name ?? 'N/A' }}</td>
                            <td>{{ $record->vaccine->vaccine_name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($record->dose) }}</td>
                            <td>
                                <span class="badge bg-{{ $record->status == 'completed' ? 'success' : 'warning' }} text-dark">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3">No vaccination records yet.</p>
        @endif
    </div>
</div>
@endsection
