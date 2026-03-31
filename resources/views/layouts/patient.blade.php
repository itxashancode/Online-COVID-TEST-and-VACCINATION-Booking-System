<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Dashboard') - COVID Booking System</title>
    <!-- Google Fonts: Inter - Consistent professional typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* GLOBAL TYPOGRAPHY */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* PATIENT THEME VARIABLES: Trust Blue (#3b82f6) - Why? Blue is calming, trustworthy, and welcoming. It reduces anxiety for patients booking medical appointments. */
        :root {
            --patient-primary: #3b82f6;
            --patient-primary-dark: #2563eb;
            --patient-bg-light: #eff6ff;
        }

        /* NAVBAR: Sticky with shadow for better UX */
        .navbar {
            background-color: var(--patient-primary) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }

        /* Hover lift for cards */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1) !important;
        }

        /* Patient-specific icon wrapper */
        .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            background-color: var(--patient-bg-light);
            color: var(--patient-primary);
        }

        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        .empty-state i {
            opacity: 0.4;
            margin-bottom: 1rem;
        }

        /* Table enhancements */
        .table thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            color: #64748b;
            padding: 0.75rem 1rem;
        }
        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Breadcrumb styling */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }
        .breadcrumb-item a {
            color: var(--patient-primary);
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #64748b;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <!-- Sticky navbar ensures patient can always access navigation, even on long pages -->
    <nav class="navbar navbar-dark sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('patient.dashboard') }}">
                <i data-lucide="user" style="width: 28px; height: 28px;"></i>
                <span>Patient Portal</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm rounded-pill">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('patient.dashboard') }}">Dashboard</a></li>
                @yield('breadcrumb')
            </ol>
        </nav>

        <!-- Page Content -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>lucide.createIcons();</script>
    @yield('scripts')
</body>
</html>
