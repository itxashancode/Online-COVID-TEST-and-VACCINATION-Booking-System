{{-- Hospital - Appointment Requests --}}
@extends('layouts.hospital')

@section('title', 'Appointment Requests')

@section('breadcrumb')
    <li class="breadcrumb-item active">Appointments</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Appointment Requests</h2>
    <div>
        <span class="badge bg-warning text-dark">Pending: {{-- $pendingCount --}}0</span>
        <span class="badge bg-success">Approved: {{-- $approvedCount --}}0</span>
        <span class="badge bg-secondary">Completed: {{-- $completedCount --}}0</span>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(/*$appointments->count()*/ false)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
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
                            <td>{{ $appointment->id }}</td>
                            <td>
                                <strong>{{ $appointment->patient->name }}</strong><br>
                                <small class="text-muted">{{ $appointment->patient->email }}</small>
                            </td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark">COVID Test</span>
                                @else
                                    <span class="badge bg-primary">Vaccination</span>
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
                            <td>{{ $appointment->appointment_time ?? '--:--' }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($appointment->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($appointment->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Completed</span>
                                @endif
                            </td>
                            <td>{{ $appointment->created_at->format('M d') }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-primary">
                                            Review / Update Result
                                        </a>
                                        <form action="{{ route('hospital.appointments.approve', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success" title="Approve">✓</button>
                                        </form>
                                        <form action="{{ route('hospital.appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" title="Reject" onclick="return confirm('Reject this appointment?')">✗</button>
                                        </form>
                                    </div>
                                @elseif($appointment->status == 'approved')
                                    <a href="{{ route('hospital.results.edit', $appointment->id) }}" class="btn btn-sm btn-info">
                                        Update Result
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

            {{-- $appointments->links() --}
        @else
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">📅</div>
                <h4>No Appointments Yet</h4>
                <p class="text-muted">Patient appointment requests will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
