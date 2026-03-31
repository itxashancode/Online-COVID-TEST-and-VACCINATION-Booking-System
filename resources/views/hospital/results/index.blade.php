@extends('layouts.hospital')

@section('title', 'Patient Records')

@section('content')
<div class="container-fluid animate-fadeIn">
    <!-- Header with Breadcrumbs -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold text-dark">Patient Medical Records</h1>
            <p class="text-muted">History of COVID-19 tests and vaccinations performed at your hospital.</p>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden glass-card">
        <div class="p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Detailed Result / Record</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td>
                                <div class="fw-medium text-dark">{{ $appointment->patient->name }}</div>
                                <div class="text-muted small">{{ $appointment->patient->email }}</div>
                            </td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark rounded-pill px-3 py-2">COVID Test</span>
                                @else
                                    <span class="badge bg-primary rounded-pill px-3 py-2">Vaccination</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark small">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                            </td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    @if($appointment->testResult)
                                        <div class="d-flex align-items-center gap-2">
                                            @if($appointment->testResult->result == 'positive')
                                                <i data-lucide="alert-triangle" class="text-danger" style="width: 16px;"></i>
                                                <span class="text-danger fw-bold">Positive</span>
                                            @elseif($appointment->testResult->result == 'negative')
                                                <i data-lucide="check-circle" class="text-success" style="width: 16px;"></i>
                                                <span class="text-success fw-bold">Negative</span>
                                            @else
                                                <span class="text-muted">Pending Result</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted small italic">Not recorded</span>
                                    @endif
                                @else
                                    @if($appointment->vaccinationRecord)
                                        <div class="small">
                                            <span class="fw-medium">{{ $appointment->vaccinationRecord->vaccine->vaccine_name }}</span>
                                            <span class="text-muted mx-1">|</span>
                                            <span class="text-primary">{{ ucfirst($appointment->vaccinationRecord->dose) }} Dose</span>
                                        </div>
                                    @else
                                        <span class="text-muted small italic">Incomplete</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($appointment->status == 'completed')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Completed</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">Approved</span>
                                @endif
                            </td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-sm btn-outline-primary rounded-2 px-3">
                                        Update Result
                                    </a>
                                @else
                                    <a href="{{ route('hospital.appointments.index') }}" class="btn btn-sm btn-outline-primary rounded-2 px-3">
                                        Update Dose
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <i data-lucide="folder-search" class="mb-3" style="width: 48px; height: 48px;"></i>
                                    <h5>No Medical Records Found</h5>
                                    <p class="text-muted">Once results are updated, they will appear here.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
