<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Portal') - MED-Digi</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- GLOBAL ENHANCEMENTS -->
    <link rel="stylesheet" href="{{ asset('css/modern-health.css') }}">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* GLOBAL TYPOGRAPHY */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* HOSPITAL THEME VARIABLES: Emerald Green (#10b981) */
        :root {
            --hospital-primary: #10b981;
            --hospital-primary-dark: #059669;
            --hospital-bg-light: #ecfdf5;
        }

        /* NAVBAR: Sticky with shadow for depth */
        .navbar {
            background-color: var(--hospital-primary) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }

        /* Hover lift effect for cards */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1) !important;
        }

        /* Hospital-specific icon wrapper */
        .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            background-color: var(--hospital-bg-light);
            color: var(--hospital-primary);
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
            color: var(--hospital-primary);
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
    <!-- Sticky navigation -->
    <nav class="navbar navbar-dark sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('hospital.dashboard') }}">
                <i data-lucide="hospital" style="width: 28px; height: 28px;"></i>
                <span>MED-Digi</span>
            </a>
            <!-- MOBILE TOGGLE -->
            <button class="navbar-toggler d-md-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <i data-lucide="menu" class="text-white"></i>
            </button>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light d-none d-sm-inline">Welcome, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm rounded-pill">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-md-block collapse bg-white border-end shadow-sm" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('hospital.dashboard') || request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i data-lucide="layout-dashboard"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        {{-- Only show management links if hospital is approved --}}
                        @if(auth()->user()->hospital && auth()->user()->hospital->status == 'approved')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('hospital.patients.*') ? 'active' : '' }}" href="{{ route('hospital.patients.index') }}">
                                <i data-lucide="users"></i>
                                Patients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('hospital.appointments.*') ? 'active' : '' }}" href="{{ route('hospital.appointments.index') }}">
                                <i data-lucide="calendar"></i>
                                Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('hospital.results.*') ? 'active' : '' }}" href="{{ route('hospital.results.index') }}">
                                <i data-lucide="file-text"></i>
                                Test Results
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>lucide.createIcons();</script>
    @yield('scripts')
</body>
</html>
