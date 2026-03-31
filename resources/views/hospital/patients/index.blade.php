{{-- Hospital - Patients with Approved Appointments --}}
@extends('layouts.hospital')

@section('title', 'Patients')

@section('breadcrumb')
    <li class="breadcrumb-item active">Patients</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Approved Patients</h2>
    <span class="badge bg-primary">Total: {{-- $patients->count() --}}0</span>
</div>

<div class="card">
    <div class="card-body">
        @if(/*$patients->count()*/ false)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Bookings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{ $patient->name }}</td>
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
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">👥</div>
                <h4>No Patients Yet</h4>
                <p class="text-muted">Patients with approved appointments will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
