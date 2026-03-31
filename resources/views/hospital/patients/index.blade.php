{{-- Hospital - Patients with Approved Appointments --}}
@extends('layouts.hospital')

@section('title', 'Patients')

@section('breadcrumb')
    <li class="breadcrumb-item active">Patients</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-hospital-theme mb-1">Approved Patients</h2>
        <p class="text-muted small mb-0">Patients with confirmed appointments</p>
    </div>
    <span class="badge bg-hospital text-white rounded-pill px-3 py-2">Total: {{ $patients->count() }}</span>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        @if($patients->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Approved Bookings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td class="fw-medium">{{ $patient->name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone ?? 'N/A' }}</td>
                            <td>{{ $patient->city ?? 'N/A' }}</td>
                            <td>
                                {{ $patient->appointments()->where('hospital_id', auth()->user()->hospital->id)->where('status', 'approved')->count() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- EMPTY STATE: No patients with approved appointments yet -->
            <div class="empty-state">
                <i data-lucide="users" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Patients Yet</h5>
                <p class="text-muted mb-3">Patients with approved appointments will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
