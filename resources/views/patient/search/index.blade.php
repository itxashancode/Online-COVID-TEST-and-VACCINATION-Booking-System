{{-- Patient - Search Hospitals --}}
@extends('layouts.patient')

@section('title', 'Search Hospitals')

@section('breadcrumb')
    <li class="breadcrumb-item active">Search Hospitals</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-patient-theme mb-1">Find COVID-19 Test & Vaccination Hospitals</h2>
        <p class="text-muted small mb-0">Search for approved testing and vaccination centers near you</p>
    </div>
</div>

<!-- Search Form -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form action="{{ route('patient.search') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="hospital_name" class="form-label fw-medium">Hospital Name</label>
                <input type="text" name="hospital_name" id="hospital_name" class="form-control rounded-2"
                       placeholder="Enter hospital name..."
                       value="{{ old('hospital_name', $hospital_name ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="city" class="form-label fw-medium">City</label>
                <input type="text" name="city" id="city" class="form-control rounded-2"
                       placeholder="Enter city..."
                       value="{{ old('city', $city ?? '') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 rounded-2 shadow-sm">
                    <i data-lucide="search" class="me-2" style="width: 16px; height: 16px;"></i>
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Results -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3">
        <h5 class="fw-bold mb-0">
            <i data-lucide="hospital" class="me-2 text-patient" style="width: 20px; height: 20px;"></i>
            Available Hospitals
            @if($hospital_name || $city)
                <small class="text-muted">(Filtered)</small>
            @endif
        </h5>
    </div>
    <div class="card-body pb-4">
        @if(isset($hospitals) && $hospitals->count() > 0)
            <div class="row g-3">
                @foreach($hospitals as $hospital)
                <div class="col-md-6">
                    <div class="card border-0 bg-light h-100 rounded-3 hover-lift">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $hospital->hospital_name }}</h5>
                            <p class="text-muted mb-1 small">
                                <i data-lucide="map-pin" class="me-1" style="width: 14px; height: 14px;"></i>
                                {{ $hospital->address }}, {{ $hospital->city }}
                            </p>
                            <p class="mb-2">
                                <i data-lucide="phone" class="me-1" style="width: 14px; height: 14px;"></i>
                                {{ $hospital->phone }}
                            </p>
                            @if($hospital->description)
                                <p class="text-muted mb-3 small">{{ Str::limit($hospital->description, 100) }}</p>
                            @endif
                            <div class="mt-auto">
                                <a href="{{ route('patient.appointments.create', ['hospital_id' => $hospital->id]) }}"
                                   class="btn btn-primary btn-sm rounded-2 shadow-sm w-100">
                                    <i data-lucide="calendar-plus" class="me-2" style="width: 14px; height: 14px;"></i>
                                    Book Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination: {{ $hospitals->links() }} --}
        @else
            <!-- EMPTY STATE: No hospitals found -->
            <div class="empty-state">
                <i data-lucide="hospital" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Hospitals Found</h5>
                <p class="text-muted mb-3">
                    @if($hospital_name || $city)
                        Try adjusting your search criteria to find more results.
                    @else
                        No hospitals have been registered and approved yet. Check back later!
                    @endif
                </p>
                @if(!$hospital_name && !$city)
                <a href="{{ route('patient.search') }}" class="btn btn-primary rounded-2">
                    <i data-lucide="refresh-cw" class="me-2" style="width: 16px; height: 16px;"></i>
                    Refresh Search
                </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
