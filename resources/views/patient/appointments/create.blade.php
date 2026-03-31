{{-- Patient - Book Appointment --}}
@extends('layouts.patient')

@section('title', 'Book Appointment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('patient.search') }}">Search Hospitals</a></li>
    <li class="breadcrumb-item active">Book Appointment</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-3">
                <h5 class="fw-bold mb-0">
                    <i data-lucide="calendar-plus" class="me-2 text-patient" style="width: 20px; height: 20px;"></i>
                    Book Appointment for
                    @if($hospital ?? null)
                        <span class="text-primary">{{ $hospital->hospital_name }}</span>
                    @else
                        Select Hospital
                    @endif
                </h5>
            </div>
            <div class="card-body">
                @if($hospital ?? null)
                    <!-- Hospital Info -->
                    <div class="alert alert-patient border-0 bg-patient-light mb-4 rounded-2">
                        <h6 class="fw-bold mb-2">{{ $hospital->hospital_name }}</h6>
                        <p class="mb-1 small">
                            <i data-lucide="map-pin" class="me-1" style="width: 14px; height: 14px;"></i>
                            {{ $hospital->address }}, {{ $hospital->city }}
                        </p>
                        <p class="mb-0 small">
                            <i data-lucide="phone" class="me-1" style="width: 14px; height: 14px;"></i>
                            {{ $hospital->phone }}
                        </p>
                    </div>
                @endif

                <form action="{{ route('patient.appointments.store') }}" method="POST">
                    @csrf

                    <!-- Hospital Selection -->
                    <div class="mb-4">
                        <label for="hospital_id" class="form-label fw-medium">Select Hospital <span class="text-danger">*</span></label>
                        <select name="hospital_id" id="hospital_id" class="form-select rounded-2" required {{ $hospital ?? null ? 'disabled' : '' }}>
                            <option value="">-- Choose a Hospital --</option>
                            @foreach($hospitals ?? [] as $h)
                                <option value="{{ $h->id }}" {{ ($hospital ?? null) && $hospital->id == $h->id ? 'selected' : '' }}>
                                    {{ $h->hospital_name }} ({{ $h->city }})
                                </option>
                            @endforeach
                        </select>
                        @if($hospital ?? null)
                            <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">
                        @endif
                    </div>

                    <!-- Appointment Type -->
                    <div class="mb-4">
                        <label class="form-label fw-medium">Appointment Type <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check card border-0 bg-light h-100 rounded-2 p-3 hover-lift">
                                    <input class="form-check-input" type="radio" name="appointment_type" id="type_covid" value="covid_test" required>
                                    <label class="form-check-label w-100 h-100 d-flex flex-column justify-content-center" for="type_covid">
                                        <i data-lucide="activity" class="mb-2 mx-auto" style="width: 32px; height: 32px; color: #3b82f6;"></i>
                                        <span class="fw-medium text-center">COVID-19 Test</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check card border-0 bg-light h-100 rounded-2 p-3 hover-lift">
                                    <input class="form-check-input" type="radio" name="appointment_type" id="type_vaccine" value="vaccination">
                                    <label class="form-check-label w-100 h-100 d-flex flex-column justify-content-center" for="type_vaccine">
                                        <i data-lucide="shield" class="mb-2 mx-auto" style="width: 32px; height: 32px; color: #10b981;"></i>
                                        <span class="fw-medium text-center">Vaccination</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Date -->
                    <div class="mb-4">
                        <label for="appointment_date" class="form-label fw-medium">Preferred Date <span class="text-danger">*</span></label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control rounded-2" required min="{{ date('Y-m-d') }}">
                    </div>

                    <!-- Appointment Time (Optional) -->
                    <div class="mb-4">
                        <label for="appointment_time" class="form-label fw-medium">Preferred Time (Optional)</label>
                        <input type="time" name="appointment_time" id="appointment_time" class="form-control rounded-2">
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-medium">Additional Notes (Optional)</label>
                        <textarea name="notes" id="notes" class="form-control rounded-2" rows="3" placeholder="Any additional information you'd like to provide..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-2 py-2 px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-2 shadow-sm py-2 px-4 fw-semibold">
                            <i data-lucide="send" class="me-2" style="width: 16px; height: 16px;"></i>
                            Request Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Simple form validation helper
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date to today
        const dateInput = document.getElementById('appointment_date');
        if(dateInput) {
            dateInput.min = new Date().toISOString().split('T')[0];
        }

        // If specific hospital passed via URL, load hospitals select
        @if(!($hospital ?? null))
            const hospitalSelect = document.getElementById('hospital_id');
            hospitalSelect.addEventListener('change', function() {
                if(this.value) {
                    // Could update UI to show hospital details via AJAX (future enhancement)
                }
            });
        @endif
    });
</script>
@endsection
