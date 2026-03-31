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
                        📥 Export to Excel
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

                <div class="mb-3">
                    <label for="report_date" class="form-label">Filter by Date</label>
                    <input type="date" class="form-control">
                </div>

                <button class="btn btn-primary">View Results</button>
            </div>
        </div>
    </div>
</div>

<!-- Summary Stats -->
<div class="row">
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h3>{{-- $totalTests --}}0</h3>
                <p class="mb-0">Total COVID Tests</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h3>{{-- $positiveCount --}}0</h3>
                <p class="mb-0">Positive Cases</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-dark">
            <div class="card-body text-center">
                <h3>{{-- $vaccinationCount --}}0</h3>
                <p class="mb-0">Vaccinations Given</p>
            </div>
        </div>
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
