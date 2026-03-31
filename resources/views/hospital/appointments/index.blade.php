{{-- Hospital - Appointment Requests --}}
@extends('layouts.hospital')

@section('title', 'Appointment Requests')

@section('breadcrumb')
    <li class="breadcrumb-item active">Appointments</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-hospital-theme mb-1">Appointment Requests</h2>
        <p class="text-muted small mb-0">Manage patient appointments</p>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending: {{ $pendingCount }}</span>
        <span class="badge bg-success rounded-pill px-3 py-2">Approved: {{ $approvedCount }}</span>
        <span class="badge bg-secondary rounded-pill px-3 py-2">Completed: {{ $completedCount }}</span>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        @if($appointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Requested</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="text-muted small">{{ $appointment->id }}</td>
                            <td>
                                <strong class="fw-bold">{{ $appointment->patient->name }}</strong><br>
                                <small class="text-muted">{{ $appointment->patient->email }}</small>
                            </td>
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
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                @elseif($appointment->status == 'approved')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Approved</span>
                                @elseif($appointment->status == 'rejected')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Rejected</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">Completed</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $appointment->created_at->format('M d') }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-outline-primary rounded-2">
                                            <i data-lucide="edit-3" class="me-1" style="width: 14px; height: 14px;"></i>Review
                                        </a>
                                        <form action="{{ route('hospital.appointments.approve', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success rounded-2" title="Approve">
                                                <i data-lucide="check" style="width: 14px; height: 14px;"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('hospital.appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger rounded-2" title="Reject" onclick="return confirm('Reject this appointment?')">
                                                <i data-lucide="x" style="width: 14px; height: 14px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                @elseif($appointment->status == 'approved')
                                    <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-sm btn-outline-hospital rounded-2">
                                        <i data-lucide="file-check" class="me-1" style="width: 14px; height: 14px;"></i>
                                        Update Result
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination: {{ $appointments->links() }} --}
        @else
            <!-- EMPTY STATE: No appointments yet -->
            <div class="empty-state">
                <i data-lucide="calendar" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Appointments Yet</h5>
                <p class="text-muted mb-3">Patient appointment requests will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
