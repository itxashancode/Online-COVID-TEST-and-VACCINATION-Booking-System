{{-- Admin - All Bookings --}}
@extends('layouts.admin')

@section('title', 'All Appointments')

@section('breadcrumb')
    <li class="breadcrumb-item active">Appointments</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Appointments</h2>
    <div>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-success">Export to Excel</a>
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
                            <th>Hospital</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                            <td>{{ $appointment->hospital->hospital_name ?? 'N/A' }}</td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark">COVID Test</span>
                                @else
                                    <span class="badge bg-primary">Vaccination</span>
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
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
                            <td>{{ $appointment->created_at->format('M d, Y') }}</td>
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
                <p class="text-muted">Appointments will appear here when patients book.</p>
            </div>
        @endif
    </div>
</div>
@endsection
