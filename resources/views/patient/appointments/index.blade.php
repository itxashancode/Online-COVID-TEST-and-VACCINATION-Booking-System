{{-- Patient - My Appointments --}}
@extends('layouts.patient')

@section('title', 'My Appointments')

@section('breadcrumb')
    <li class="breadcrumb-item active">My Appointments</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-patient-theme mb-1">My Appointments</h2>
        <p class="text-muted small mb-0">Track your COVID tests and vaccination bookings</p>
    </div>
    <a href="{{ route('patient.appointments.create') }}" class="btn btn-primary rounded-2 shadow-sm">
        <i data-lucide="plus" class="me-2" style="width: 16px; height: 16px;"></i>
        New Appointment
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        @if($appointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Hospital</th>
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
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending Approval</span>
                                @elseif($appointment->status == 'approved')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Approved</span>
                                @elseif($appointment->status == 'rejected')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Rejected</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">Completed</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $appointment->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <small class="text-muted">Waiting for hospital approval</small>
                                @elseif($appointment->status == 'approved')
                                    <small class="text-success fw-bold">✓ Confirmed</small>
                                @elseif($appointment->status == 'rejected')
                                    <form action="{{ route('patient.appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this rejected appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2">
                                            <i data-lucide="trash-2" class="me-1" style="width: 14px; height: 14px;"></i>Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination if needed: {{ $appointments->links() }} --}
        @else
            <!-- EMPTY STATE: No appointments yet -->
            <div class="empty-state">
                <i data-lucide="calendar" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Appointments Yet</h5>
                <p class="text-muted mb-3">Book your first appointment to get started!</p>
                <a href="{{ route('patient.appointments.create') }}" class="btn btn-primary rounded-2 px-4">
                    <i data-lucide="plus" class="me-2" style="width: 16px; height: 16px;"></i>
                    Book Appointment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
