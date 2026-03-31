{{-- Hospital - Update Test Result or Vaccination Status --}}
@extends('layouts.hospital')

@section('title', 'Update Result')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('hospital.appointments.index') }}">Appointments</a></li>
    <li class="breadcrumb-item active">Update Result</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    @if($appointment->appointment_type == 'covid_test')
                        Update COVID-19 Test Result
                    @else
                        Update Vaccination Status
                    @endif
                </h5>
            </div>
            <div class="card-body">
                <!-- Appointment Details -->
                <div class="alert alert-info">
                    <h6>Appointment Details</h6>
                    <p class="mb-1"><strong>Patient:</strong> {{ $appointment->patient->name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Date:</strong> {{ $appointment->appointment_date->format('l, F d, Y') }}</p>
                    <p class="mb-0"><strong>Type:</strong>
                        @if($appointment->appointment_type == 'covid_test')
                            <span class="badge bg-info text-dark">COVID Test</span>
                        @else
                            <span class="badge bg-primary">Vaccination</span>
                        @endif
                    </p>
                </div>

                <form action="{{ route('hospital.results.update', $appointment->id) }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf
                    @method('PUT')

                    @if($appointment->appointment_type == 'covid_test')
                        <!-- COVID Test Result Section -->
                        <div class="mb-3">
                            <label class="form-label">Test Result <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="result" id="result_positive" value="positive">
                                <label class="form-check-label" for="result_positive">
                                    <span class="badge bg-danger">Positive</span> - Patient tested positive
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="result" id="result_negative" value="negative">
                                <label class="form-check-label" for="result_negative">
                                    <span class="badge bg-success">Negative</span> - Patient tested negative
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="result" id="result_pending" value="pending" checked>
                                <label class="form-check-label" for="result_pending">
                                    <span class="badge bg-warning text-dark">Pending</span> - Result not ready yet
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="doctor_notes" class="form-label">Doctor Notes</label>
                            <textarea name="doctor_notes" id="doctor_notes" class="form-control" rows="3" placeholder="Additional notes about the test result..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="result_date" class="form-label">Result Date <span class="text-danger">*</span></label>
                            <input type="date" name="result_date" id="result_date" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>

                        <button type="submit" class="btn btn-primary" :disabled="submitting">
                            <template x-if="submitting">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            </template>
                            <template x-if="!submitting">
                                <i data-lucide="save" class="me-2" style="width: 16px; height: 16px;"></i>
                            </template>
                            <span x-text="submitting ? 'Saving...' : 'Save Test Result'"></span>
                        </button>
                    @else
                        <!-- Vaccination Update Section -->
                        <div class="mb-3">
                            <label for="vaccine_id" class="form-label">Vaccine <span class="text-danger">*</span></label>
                            <select name="vaccine_id" id="vaccine_id" class="form-select" required>
                                <option value="">Select Vaccine</option>
                                @foreach($vaccines as $vaccine)
                                    <option value="{{ $vaccine->id }}">{{ $vaccine->vaccine_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dose <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dose" id="dose_first" value="first">
                                <label class="form-check-label" for="dose_first">First Dose</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dose" id="dose_second" value="second">
                                <label class="form-check-label" for="dose_second">Second Dose</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dose" id="dose_booster" value="booster">
                                <label class="form-check-label" for="dose_booster">Booster Dose</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="vaccination_date" class="form-label">Vaccination Date <span class="text-danger">*</span></label>
                            <input type="date" name="vaccination_date" id="vaccination_date" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>

                        <button type="submit" class="btn btn-primary" :disabled="submitting">
                            <template x-if="submitting">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            </template>
                            <template x-if="!submitting">
                                <i data-lucide="check-circle" class="me-2" style="width: 16px; height: 16px;"></i>
                            </template>
                            <span x-text="submitting ? 'Processing...' : 'Complete Vaccination'"></span>
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Instructions</h6>
            </div>
            <div class="card-body">
                @if($appointment->appointment_type == 'covid_test')
                    <ul class="mb-0">
                        <li>Select the test result (positive or negative)</li>
                        <li>Add any doctor notes if necessary</li>
                        <li>Set the date when result was determined</li>
                        <li>This will update the appointment status to "Completed"</li>
                    </ul>
                @else
                    <ul class="mb-0">
                        <li>Select which vaccine was administered</li>
                        <li>Choose the dose type (first, second, or booster)</li>
                        <li>Set the vaccination date</li>
                        <li>This will mark the appointment as completed</li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
