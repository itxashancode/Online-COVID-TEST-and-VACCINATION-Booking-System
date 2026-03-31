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
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Book Appointment for
                    @if($hospital ?? null)
                        {{ $hospital->hospital_name }}
                    @else
                        Select Hospital
                    @endif
                </h5>
            </div>
            <div class="card-body">
                @if($hospital ?? null)
                    <!-- Hospital Info -->
                    <div class="alert alert-info">
                        <h6>{{ $hospital->hospital_name }}</h6>
                        <p class="mb-1"><i class="bi bi-geo-alt"></i> {{ $hospital->address }}, {{ $hospital->city }}</p>
                        <p class="mb-0"><i class="bi bi-telephone"></i> {{ $hospital->phone }}</p>
                    </div>
                @endif

                <form action="{{ route('patient.appointments.store') }}" method="POST">
                    @csrf

                    <!-- Hospital Selection -->
                    <div class="mb-3">
                        <label for="hospital_id" class="form-label">Select Hospital <span class="text-danger">*</span></label>
                        <select name="hospital_id" id="hospital_id" class="form-select" required {{ $hospital ?? null ? 'disabled' : '' }}>
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
                    <div class="mb-3">
                        <label class="form-label">Appointment Type <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="appointment_type" id="type_covid" value="covid_test" required>
                            <label class="form-check-label" for="type_covid">
                                🦠 COVID-19 Test
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="appointment_type" id="type_vaccine" value="vaccination">
                            <label class="form-check-label" for="type_vaccine">
                                💉 Vaccination
                            </label>
                        </div>
                    </div>

                    <!-- Appointment Date -->
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Preferred Date <span class="text-danger">*</span></label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <!-- Appointment Time (Optional) -->
                    <div class="mb-3">
                        <label for="appointment_time" class="form-label">Preferred Time (Optional)</label>
                        <input type="time" name="appointment_time" id="appointment_time" class="form-control">
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Additional Notes (Optional)</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Any additional information you'd like to provide..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Request Appointment</button>
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
            // Hospital select functionality
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
