{{-- Admin - All Hospitals --}}
@extends('layouts.admin')

@section('title', 'All Hospitals')

@section('breadcrumb')
    <li class="breadcrumb-item active">Hospitals</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-admin-theme mb-1">Hospitals List</h2>
        <p class="text-muted small mb-0">Manage hospital registrations and approvals</p>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-success rounded-pill px-3 py-2">Approved: {{ $approvedCount }}</span>
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending: {{ $pendingCount }}</span>
        <span class="badge bg-danger rounded-pill px-3 py-2">Rejected: {{ $rejectedCount }}</span>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        @if($hospitals->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
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
                            <td class="text-muted small">{{ $hospital->id }}</td>
                            <td class="fw-medium">{{ $hospital->hospital_name }}</td>
                            <td>{{ Str::limit($hospital->address, 30) }}</td>
                            <td>{{ $hospital->city }}</td>
                            <td>{{ $hospital->phone }}</td>
                            <td>
                                @if($hospital->status == 'approved')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Approved</span>
                                @elseif($hospital->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $hospital->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($hospital->status == 'pending')
                                    <form action="{{ route('admin.hospitals.approve', $hospital->id) }}" method="POST" class="d-inline me-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-2" title="Approve">
                                            <i data-lucide="check" style="width: 14px; height: 14px;"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.hospitals.reject', $hospital->id) }}" method="POST" class="d-inline me-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-warning rounded-2" title="Reject">
                                            <i data-lucide="x" style="width: 14px; height: 14px;"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this hospital and its user account permanently?')">
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

            {{-- Pagination if enabled: {{ $hospitals->links() }} --}}
        @else
            <div class="empty-state">
                <i data-lucide="building" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Hospitals Registered Yet</h5>
                <p class="text-muted mb-3">Hospitals will appear here after they register and request approval.</p>
            </div>
        @endif
    </div>
</div>
@endsection
