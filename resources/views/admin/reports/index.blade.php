{{-- Admin - Reports --}}
@extends('layouts.admin')

@section('title', 'Reports')

@section('breadcrumb')
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>COVID-19 Reports</h2>
</div>

<div class="row">
    <!-- Export Section -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Export Appointments</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Download appointment data in Excel format.</p>

                <form action="{{ route('admin.reports.export') }}" method="GET">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Export Period</label>
                        <select name="period" class="form-select" required onchange="toggleDateFields()">
                            <option value="">Select Period</option>
                            <option value="date">Specific Date</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                    </div>

                    <div id="dateField" class="mb-3" style="display: none;">
                        <label for="specific_date" class="form-label">Select Date</label>
                        <input type="date" name="specific_date" id="specific_date" class="form-control">
                    </div>

                    <div id="dateRangeFields" class="row" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Export to Excel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- COVID Reports Section -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">COVID-19 Test Reports</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">View COVID-19 test results with date-wise filtering.</p>

                <form method="GET" action="{{ route('admin.reports.index') }}">
                    <div class="mb-3">
                        <label for="filter_date" class="form-label">Filter by Date</label>
                        <input type="date" name="filter_date" id="filter_date" class="form-control" value="{{ request('filter_date') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">View Results</button>
                    @if(request('filter_date'))
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Clear Filter</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Summary Stats -->
<div class="row mb-5">
    <div class="col-md-4">
        <div class="card bg-info text-white shadow-sm border-0 rounded-4">
            <div class="card-body text-center p-4">
                <h3 class="display-4 fw-bold mb-0">{{ $totalTests ?? 0 }}</h3>
                <p class="mb-0 text-white-50">Total COVID Tests</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white shadow-sm border-0 rounded-4">
            <div class="card-body text-center p-4">
                <h3 class="display-4 fw-bold mb-0">{{ $positiveCount ?? 0 }}</h3>
                <p class="mb-0 text-white-50">Positive Cases</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-teal text-white shadow-sm border-0 rounded-4" style="background-color: #20c997;">
            <div class="card-body text-center p-4">
                <h3 class="display-4 fw-bold mb-0">{{ $vaccinationCount ?? 0 }}</h3>
                <p class="mb-0 text-white-50">Vaccinations Given</p>
            </div>
        </div>
    </div>
</div>

<!-- Test Results Table -->
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">Data Listing: COVID-19 Test Reports</h5>
        <span class="text-muted small">Total: {{ $appointments->total() }} records</span>
    </div>
    <div class="card-body">
        @if($appointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Patient Name</th>
                            <th>Hospital</th>
                            <th>Test Date</th>
                            <th>Result Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td class="fw-bold">{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->hospital->hospital_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                                <td>
                                    @if($appointment->testResult)
                                        <span class="badge @if($appointment->testResult->result == 'positive') bg-danger @elseif($appointment->testResult->result == 'negative') bg-success @else bg-warning @endif rounded-pill px-3">
                                            {{ ucfirst($appointment->testResult->result) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3">Result Not Found</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $appointments->appends(request()->query())->links() }}
                </div>
            @else
            <div class="text-center py-5">
                <i data-lucide="file-x" style="width: 48px; height: 48px;" class="text-muted mb-3"></i>
                <p class="text-muted">No test results found for the requested criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleDateFields() {
        const period = document.querySelector('select[name="period"]').value;
        document.getElementById('dateField').style.display = period === 'date' ? 'block' : 'none';
        document.getElementById('dateRangeFields').style.display = (period === 'week' || period === 'month') ? 'block' : 'none';
    }
</script>
@endsection
