{{-- Admin - Vaccine Details --}}
@extends('layouts.admin')

@section('title', 'Vaccine Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.vaccines.index') }}">Vaccines</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-3">
                <h5 class="fw-bold mb-0">
                    <i data-lucide="syringe" class="me-2 text-admin-theme" style="width: 20px; height: 20px;"></i>
                    Vaccine Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong class="text-muted">Vaccine Name:</strong>
                        <p class="fw-medium fs-5 mb-0">{{ $vaccine->vaccine_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong class="text-muted">Availability:</strong>
                        <p>
                            @if($vaccine->availability == 'available')
                                <span class="badge bg-success rounded-pill px-3 py-2">Available</span>
                            @else
                                <span class="badge bg-danger rounded-pill px-3 py-2">Unavailable</span>
                            @endif
                        </p>
                    </div>
                </div>

                @if($vaccine->description)
                <div class="mb-3">
                    <strong class="text-muted">Description:</strong>
                    <p class="mb-0">{{ $vaccine->description }}</p>
                </div>
                @endif

                <div class="mt-4 pt-3 border-top">
                    <p class="text-muted small mb-0">
                        Created: {{ $vaccine->created_at->format('M d, Y') }} |
                        Last Updated: {{ $vaccine->updated_at->format('M d, Y') }}
                    </p>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pb-4">
                <a href="{{ route('admin.vaccines.edit', $vaccine) }}" class="btn btn-primary rounded-2">
                    <i data-lucide="edit-3" class="me-1" style="width: 14px; height: 14px;"></i>Edit Vaccine
                </a>
                <a href="{{ route('admin.vaccines.index') }}" class="btn btn-outline-secondary rounded-2 ms-2">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
