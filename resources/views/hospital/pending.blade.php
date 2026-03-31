@extends('layouts.hospital')

@section('title', 'Account Status')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-8 text-center animate-fadeIn">
        <div class="card border-0 shadow-lg p-5 rounded-4 glass-card">
            <div class="mb-4">
                @if($status == 'pending')
                    <div class="icon-wrapper mx-auto mb-4 bg-warning bg-opacity-10 text-warning" style="width: 80px; height: 80px;">
                        <i data-lucide="clock" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-3">Registration Pending</h2>
                    <p class="text-muted lead">
                        Thank you for registering your hospital. Your account is currently under review by our administrators.
                    </p>
                    <div class="alert alert-info border-0 rounded-3 mt-4">
                        <i data-lucide="info" class="me-2" style="width: 18px;"></i>
                        You will be able to access the hospital portal once your account is **Approved**.
                    </div>
                @elseif($status == 'rejected')
                    <div class="icon-wrapper mx-auto mb-4 bg-danger bg-opacity-10 text-danger" style="width: 80px; height: 80px;">
                        <i data-lucide="x-circle" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-3">Account Rejected</h2>
                    <p class="text-muted lead">
                        Unfortunately, your hospital registration request has been rejected. 
                    </p>
                    <div class="alert alert-danger border-0 rounded-3 mt-4">
                        Please contact the administrator for further clarification or appeal.
                    </div>
                @endif
                
                <div class="mt-5">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                            Logout and Exit
                        </button>
                    </form>
                    <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4 ms-2">
                        Refresh Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
