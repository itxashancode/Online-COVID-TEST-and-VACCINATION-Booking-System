{{-- Admin - All Patients --}}
@extends('layouts.admin')

@section('title', 'All Patients')

@section('breadcrumb')
    <li class="breadcrumb-item active">Patients</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-admin-theme mb-1">All Patients</h2>
        <p class="text-muted small mb-0">Manage registered patient accounts</p>
    </div>
    <span class="badge bg-primary rounded-pill px-3 py-2">Total: {{ $patients->count() }}</span>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        @if($patients->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td class="text-muted small">{{ $patient->id }}</td>
                            <td class="fw-medium">{{ $patient->name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone ?? 'N/A' }}</td>
                            <td>{{ $patient->city ?? 'N/A' }}</td>
                            <td>{{ $patient->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary rounded-2">
                                    <i data-lucide="eye" class="me-1" style="width: 14px; height: 14px;"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination if we enable it: {{ $patients->links() }} --}}
        @else
            <!-- EMPTY STATE: No patients in system yet -->
            <div class="empty-state">
                <i data-lucide="users" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Patients Registered Yet</h5>
                <p class="text-muted mb-3">When patients register through the system, they will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
