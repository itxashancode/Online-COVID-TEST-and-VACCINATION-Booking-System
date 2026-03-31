{{-- Patient - Search Hospitals --}}
@extends('layouts.patient')

@section('title', 'Search Hospitals')

@section('breadcrumb')
    <li class="breadcrumb-item active">Search Hospitals</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Find COVID-19 Testing & Vaccination Hospitals</h2>
</div>

<!-- Search Form -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('patient.search') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <label for="hospital_name" class="form-label">Hospital Name</label>
                <input type="text" name="hospital_name" id="hospital_name" class="form-control"
                       placeholder="Search by hospital name..."
                       value="{{ old('hospital_name', $hospital_name ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control"
                       placeholder="Search by city..."
                       value="{{ old('city', $city ?? '') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
            </div>
        </form>
    </div>
</div>

<!-- Results -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            Available Hospitals
            @if($hospital_name || $city)
                <small class="text-muted">(Filtered results)</small>
            @endif
        </h5>
    </div>
    <div class="card-body">
        @if(/*$hospitals->count()*/ false)
            <div class="row">
                @foreach($hospitals as $hospital)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hospital->hospital_name }}</h5>
                            <p class="text-muted mb-1">
                                <i class="bi bi-geo-alt"></i> {{ $hospital->address }}, {{ $hospital->city }}
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-telephone"></i> {{ $hospital->phone }}
                            </p>
                            @if($hospital->description)
                                <p class="mb-2">{{ Str::limit($hospital->description, 100) }}</p>
                            @endif
                            <div class="mt-auto">
                                <a href="{{ route('patient.appointments.create', ['hospital_id' => $hospital->id]) }}"
                                   class="btn btn-primary btn-sm">
                                    Book Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- $hospitals->links() --}
        @else
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">🏥</div>
                <h4>No Hospitals Found</h4>
                <p class="text-muted">
                    @if($hospital_name || $city)
                        Try adjusting your search criteria.
                    @else
                        No hospitals have been registered yet. Check back later!
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
