{{-- Admin - All Hospitals --}}
@extends('layouts.admin')

@section('title', 'Hospitals')

@section('breadcrumb')
    <li class="breadcrumb-item active">Hospitals</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Hospitals List</h2>
    <div>
        <span class="badge bg-success me-2">Approved: {{-- $approvedCount --}}0</span>
        <span class="badge bg-warning text-dark me-2">Pending: {{-- $pendingCount --}}0</span>
        <span class="badge bg-danger">Rejected: {{-- $rejectedCount --}}0</span>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(/*$hospitals->count()*/ false)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Hospital Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hospitals as $hospital)
                        <tr>
                            <td>{{ $hospital->id }}</td>
                            <td>{{ $hospital->hospital_name }}</td>
                            <td>{{ Str::limit($hospital->address, 30) }}</td>
                            <td>{{ $hospital->city }}</td>
                            <td>{{ $hospital->phone }}</td>
                            <td>
                                @if($hospital->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($hospital->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $hospital->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($hospital->status == 'pending')
                                    <form action="{{ route('admin.hospitals.approve', $hospital) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this hospital?')">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.hospitals.reject', $hospital) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this hospital?')">Reject</button>
                                    </form>
                                @else
                                    <span class="text-muted">No actions</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- $hospitals->links() --}}
        @else
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">🏥</div>
                <h4>No Hospitals Registered Yet</h4>
                <p class="text-muted">Hospitals will appear here after they register.</p>
            </div>
        @endif
    </div>
</div>
@endsection
