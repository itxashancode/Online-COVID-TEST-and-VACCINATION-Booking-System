{{-- Admin - All Patients --}}
@extends('layouts.admin')

@section('title', 'All Patients')

@section('breadcrumb')
    <li class="breadcrumb-item active">Patients</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Patients</h2>
    <span class="badge bg-primary rounded-pill">Total: {{-- $patients->count() --}}0</span>
</div>

<div class="card">
    <div class="card-body">
        @if(/*$patients->count()*/ false)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
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
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone ?? 'N/A' }}</td>
                            <td>{{ $patient->city ?? 'N/A' }}</td>
                            <td>{{ $patient->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- $patients->links() --}}
        @else
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">👥</div>
                <h4>No Patients Registered Yet</h4>
                <p class="text-muted">When patients register through the system, they will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
