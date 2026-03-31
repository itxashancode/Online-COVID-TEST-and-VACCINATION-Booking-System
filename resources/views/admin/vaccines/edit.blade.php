{{-- Admin - Edit Vaccine --}}
@extends('layouts.admin')

@section('title', 'Edit Vaccine')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.vaccines.index') }}">Vaccines</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Vaccine</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.vaccines.update', $vaccine) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="vaccine_name" class="form-label">Vaccine Name <span class="text-danger">*</span></label>
                        <input type="text" name="vaccine_name" id="vaccine_name" class="form-control" required maxlength="255" value="{{ old('vaccine_name', $vaccine->vaccine_name ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $vaccine->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Availability Status <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" id="available" value="available" {{ (old('availability', $vaccine->availability ?? '') == 'available') ? 'checked' : '' }}>
                            <label class="form-check-label" for="available">
                                Available
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" id="unavailable" value="unavailable" {{ (old('availability', $vaccine->availability ?? '') == 'unavailable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="unavailable">
                                Unavailable
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Vaccine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
