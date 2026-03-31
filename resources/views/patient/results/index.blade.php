{{-- Patient - My Test Results & Vaccination Records --}}
@extends('layouts.patient')

@section('title', 'My Results')

@section('breadcrumb')
    <li class="breadcrumb-item active">Test Results & Vaccinations</li>
@endsection

@section('content')
<h2 class="mb-3">My Health Records</h2>

<!-- Tab Navigation -->
<ul class="nav nav-tabs mb-4" id="resultTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="covid-tab" data-bs-toggle="tab" data-bs-target="#covid" type="button">
            🦠 COVID-19 Test Results
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="vaccine-tab" data-bs-toggle="tab" data-bs-target="#vaccine" type="button">
            💉 Vaccination Records
        </button>
    </li>
</ul>

<div class="tab-content" id="resultTabsContent">
    <!-- COVID Test Results Tab -->
    <div class="tab-pane fade show active" id="covid" role="tabpanel">
        @if(/*$testResults->count()*/ false)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
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
                                    <td>{{ $result->result_date ?? $result->created_at->format('M d, Y') }}</td>
                                    <td>{{ $result->hospital->hospital_name ?? 'N/A' }}</td>
                                    <td>
                                        @if($result->result == 'positive')
                                            <span class="badge bg-danger">Positive</span>
                                        @elseif($result->result == 'negative')
                                            <span class="badge bg-success">Negative</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $result->doctor_notes ?? 'No notes' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">🦠</div>
                <h4>No Test Results Yet</h4>
                <p class="text-muted">Your COVID-19 test results will appear here once hospitals update them.</p>
            </div>
        @endif
    </div>

    <!-- Vaccination Records Tab -->
    <div class="tab-pane fade" id="vaccine" role="tabpanel">
        @if(/*$vaccinationRecords->count()*/ false)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
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
                                    <td>{{ $record->vaccination_date }}</td>
                                    <td>{{ $record->hospital->hospital_name ?? 'N/A' }}</td>
                                    <td>{{ $record->vaccine->vaccine_name ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($record->dose) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $record->status == 'completed' ? 'success' : 'warning' }} text-dark">
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
            <div class="text-center py-5">
                <div class="fs-1 text-muted mb-3">💉</div>
                <h4>No Vaccinations Yet</h4>
                <p class="text-muted">Your vaccination records will appear here after you get vaccinated.</p>
            </div>
        @endif
    </div>
</div>
@endsection
