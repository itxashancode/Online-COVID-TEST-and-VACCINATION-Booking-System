{{-- Admin - Vaccines List --}}
@extends('layouts.admin')

@section('title', 'Vaccines')

@section('breadcrumb')
    <li class="breadcrumb-item active">Vaccines</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Vaccine List</h2>
    <a href="{{ route('admin.vaccines.create') }}" class="btn btn-primary">+ Add Vaccine</a>
</div>

<div class="card">
    <div class="card-body">
        @if(/*$vaccines->count()*/ false)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
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
                            <td>{{ $vaccine->id }}</td>
                            <td>{{ $vaccine->vaccine_name }}</td>
                            <td>{{ Str::limit($vaccine->description, 50) }}</td>
                            <td>
                                @if($vaccine->availability == 'available')
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-danger">Unavailable</span>
                                @endif
                            </td>
                            <td>{{ $vaccine->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.vaccines.edit', $vaccine) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.vaccines.destroy', $vaccine) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this vaccine?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- $vaccines->links() --}}
        @else
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">💉</div>
                <h4>No Vaccines Added Yet</h4>
                <p class="mb-3">Add vaccines that hospitals can administer to patients.</p>
                <a href="{{ route('admin.vaccines.create') }}" class="btn btn-primary">Add First Vaccine</a>
            </div>
        @endif
    </div>
</div>
@endsection
