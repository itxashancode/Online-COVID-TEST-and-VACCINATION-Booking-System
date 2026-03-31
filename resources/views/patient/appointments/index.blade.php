{{-- Patient - My Appointments --}}
@extends('layouts.patient')

@section('title', 'My Appointments')

@section('breadcrumb')
    <li class="breadcrumb-item active">My Appointments</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>My Appointments</h2>
    <a href="{{ route('patient.appointments.create') }}" class="btn btn-success">+ New Appointment</a>
</div>

<div class="card">
    <div class="card-body">
        @if(/*$appointments->count()*/ false)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
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
                            <td>
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending Approval</span>
                                @elseif($appointment->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($appointment->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Completed</span>
                                @endif
                            </td>
                            <td>{{ $appointment->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <small class="text-muted">Waiting for hospital approval</small>
                                @elseif($appointment->status == 'approved')
                                    <small class="text-success">✓ Confirmed</small>
                                @elseif($appointment->status == 'rejected')
                                    <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
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
                <p class="mb-3">Book your first appointment to get started!</p>
                <a href="{{ route('patient.appointments.create') }}" class="btn btn-primary">Book Appointment</a>
            </div>
        @endif
    </div>
</div>
@endsection
