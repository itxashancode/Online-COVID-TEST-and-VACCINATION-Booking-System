@extends('layouts.admin')

@section('title', 'Vaccines')

@section('breadcrumb')
    <li class="breadcrumb-item active">Vaccines</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-admin-theme mb-1">Vaccine List</h2>
        <p class="text-muted small mb-0">Manage available COVID vaccines</p>
    </div>
    <a href="{{ route('admin.vaccines.create') }}" class="btn btn-admin rounded-2 shadow-sm">
        <i data-lucide="plus" class="me-2" style="width: 16px; height: 16px;"></i>
        Add Vaccine
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        @if($vaccines->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vaccine Name</th>
                            <th>Description</th>
                            <th>Availability</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vaccines as $vaccine)
                        <tr>
                            <td class="text-muted small">{{ $vaccine->id }}</td>
                            <td class="fw-medium">{{ $vaccine->vaccine_name }}</td>
                            <td>{{ Str::limit($vaccine->description, 50) }}</td>
                            <td>
                                @if($vaccine->availability == 'available')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Available</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Unavailable</span>
                                @endif
                            </td>
                            <td>{{ $vaccine->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.vaccines.edit', $vaccine) }}" class="btn btn-sm btn-outline-primary rounded-2 me-1">
                                    <i data-lucide="edit-3" class="me-1" style="width: 14px; height: 14px;"></i>Edit
                                </a>
                                <form action="{{ route('admin.vaccines.destroy', $vaccine) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this vaccine? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-2">
                                        <i data-lucide="trash-2" class="me-1" style="width: 14px; height: 14px;"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination: {{ $vaccines->links() }} --}}
        @else
            <div class="empty-state">
                <i data-lucide="syringe" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Vaccines Added Yet</h5>
                <p class="text-muted mb-3">Add vaccines that hospitals can administer to patients.</p>
                <a href="{{ route('admin.vaccines.create') }}" class="btn btn-admin rounded-2 px-4">
                    <i data-lucide="plus" class="me-2" style="width: 16px; height: 16px;"></i>
                    Add First Vaccine
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
