@extends('layouts.patient')

@section('title', 'My Health Records')

@section('breadcrumb')
    <li class="breadcrumb-item active">Test Results & Vaccinations</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-patient-theme mb-1">My Health Records</h2>
        <p class="text-muted small mb-0">View your test results and vaccination history</p>
    </div>
</div>

<ul class="nav nav-pills mb-4" id="resultTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-pill px-4 py-2" id="covid-tab" data-bs-toggle="tab" data-bs-target="#covid" type="button">
            <i data-lucide="activity" class="me-2" style="width: 18px; height: 18px;"></i>
            COVID-19 Test Results
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill px-4 py-2" id="vaccine-tab" data-bs-toggle="tab" data-bs-target="#vaccine" type="button">
            <i data-lucide="shield" class="me-2" style="width: 18px; height: 18px;"></i>
            Vaccination Records
        </button>
    </li>
</ul>

<div class="tab-content" id="resultTabsContent">
    <div class="tab-pane fade show active" id="covid" role="tabpanel">
        @if($testResults->count() > 0)
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Hospital</th>
                                    <th>Result</th>
                                    <th>Doctor Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testResults as $result)
                                <tr>
                                    <td class="fw-medium">{{ $result->result_date ?? $result->created_at->format('M d, Y') }}</td>
                                    <td>{{ $result->hospital->hospital_name ?? 'N/A' }}</td>
                                    <td>
                                        @if($result->result == 'positive')
                                            <span class="badge bg-danger rounded-pill px-3 py-2">Positive</span>
                                        @elseif($result->result == 'negative')
                                            <span class="badge bg-success rounded-pill px-3 py-2">Negative</span>
                                        @else
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $result->doctor_notes ?? 'No notes' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <i data-lucide="test-tube" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Test Results Yet</h5>
                <p class="text-muted mb-3">Your COVID-19 test results will appear here once hospitals update them.</p>
            </div>
        @endif
    </div>

    <div class="tab-pane fade" id="vaccine" role="tabpanel">
        @if($vaccinationRecords->count() > 0)
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Hospital</th>
                                    <th>Vaccine</th>
                                    <th>Dose</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vaccinationRecords as $record)
                                <tr>
                                    <td class="fw-medium">{{ $record->vaccination_date }}</td>
                                    <td>{{ $record->hospital->hospital_name ?? 'N/A' }}</td>
                                    <td>{{ $record->vaccine->vaccine_name ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($record->dose) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $record->status == 'completed' ? 'success' : 'warning' }} text-dark rounded-pill px-3 py-2">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <i data-lucide="syringe" style="width: 64px; height: 64px;"></i>
                <h5 class="text-muted">No Vaccinations Yet</h5>
                <p class="text-muted mb-3">Your vaccination records will appear here after you get vaccinated.</p>
            </div>
        @endif
    </div>
</div>
@endsection
