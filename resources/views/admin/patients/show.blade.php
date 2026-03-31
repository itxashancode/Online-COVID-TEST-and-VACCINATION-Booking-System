{{-- Admin - Patient Detailed Profile --}}
@extends('layouts.admin')

@section('title', 'Patient: ' . $patient->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.patients.index') }}">Patients</a></li>
    <li class="breadcrumb-item active">Patient Profile</li>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center p-5">
                <div class="icon-wrapper mx-auto mb-4" style="width: 80px; height: 80px; background: var(--patient-bg-light); color: var(--patient-primary);">
                    <i data-lucide="user" style="width: 40px; height: 40px;"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $patient->name }}</h3>
                <p class="text-muted mb-4">{{ $patient->email }}</p>
                
                <div class="d-grid gap-2 border-top pt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Status</span>
                        <span class="badge bg-success">Active</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Registered</span>
                        <span class="fw-medium small">{{ $patient->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Location</span>
                        <span class="fw-medium small">{{ $patient->city ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row g-4 mb-4">
            <!-- Appointment Stats -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                    <h5 class="text-muted small text-uppercase mb-0">Appointments</h5>
                    <div class="display-6 fw-bold text-primary">{{ $patient->appointments->count() }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                    <h5 class="text-muted small text-uppercase mb-0">Tests Done</h5>
                    <div class="display-6 fw-bold text-success">{{ $patient->appointments->where('appointment_type', 'covid_test')->count() }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                    <h5 class="text-muted small text-uppercase mb-0">Vaccinations</h5>
                    <div class="display-6 fw-bold text-info">{{ $patient->appointments->where('appointment_type', 'vaccination')->count() }}</div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header border-0 bg-transparent pt-4 pb-0">
                <h5 class="fw-bold mb-0">Medical History</h5>
            </div>
            <div class="card-body">
                @if($patient->appointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Hospital</th>
                                    <th>Status</th>
                                    <th>Outcome</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patient->appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge {{ $appointment->appointment_type == 'covid_test' ? 'bg-primary' : 'bg-info' }}">
                                            {{ $appointment->appointment_type == 'covid_test' ? 'COVID Test' : 'Vaccination' }}
                                        </span>
                                    </td>
                                    <td>{{ $appointment->hospital->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $appointment->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $appointment->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($appointment->appointment_type == 'covid_test' && $appointment->testResult)
                                            <span class="text-{{ $appointment->testResult->result == 'positive' ? 'danger' : 'success' }} fw-bold">
                                                {{ strtoupper($appointment->testResult->result) }}
                                            </span>
                                        @elseif($appointment->appointment_type == 'vaccination' && $appointment->vaccinationRecord)
                                            <span class="text-success fw-bold">
                                                {{ $appointment->vaccinationRecord->dose }} DOSE
                                            </span>
                                        @else
                                            <span class="text-muted small">Pending Result</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i data-lucide="calendar" style="width: 48px; height: 48px;"></i>
                        <p class="text-muted">No appointments found for this patient.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
