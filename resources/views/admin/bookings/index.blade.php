{{-- Admin - All Bookings --}}
@extends('layouts.admin')

@section('title', 'All Appointments')

@section('breadcrumb')
    <li class="breadcrumb-item active">Appointments</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-admin-theme mb-1">All Appointments</h2>
        <p class="text-muted small mb-0">System-wide booking overview</p>
    </div>
    <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-success rounded-2 shadow-sm">
        <i data-lucide="file-bar-chart" class="me-2" style="width: 16px; height: 16px;"></i>
        Export to Excel
    </a>
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
                            <th>Hospital</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="text-muted small">{{ $appointment->id }}</td>
                            <td class="fw-medium">{{ $appointment->patient->name ?? 'N/A' }}</td>
                            <td>{{ $appointment->hospital->hospital_name ?? 'N/A' }}</td>
                            <td>
                                @if($appointment->appointment_type == 'covid_test')
                                    <span class="badge bg-info text-dark rounded-pill px-3 py-2">COVID Test</span>
                                @else
                                    <span class="badge bg-primary rounded-pill px-3 py-2">Vaccination</span>
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
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
                            <td class="text-muted small">{{ $appointment->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.bookings.destroy', $appointment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this booking permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Delete">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination: {{ $appointments->links() }} --}}
        @else
            <div class="empty-state">
                <i data-lucide="calendar" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Appointments Yet</h5>
                <p class="text-muted mb-3">Appointments will appear here when patients book.</p>
            </div>
        @endif
    </div>
</div>
@endsection
