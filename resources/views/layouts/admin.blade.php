<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - COVID Booking System</title>
    <!-- Google Fonts: Inter - Why? Inter is a professional, highly readable font designed for computer screens. It's neutral and modern, perfect for admin interfaces. -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons CDN - Why? Lucide provides beautiful, consistent icons that replace emojis for a professional look. They're lightweight and scale perfectly. -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* GLOBAL TYPOGRAPHY: Apply Inter font to entire app for consistency */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* ADMIN THEME VARIABLES: Slate/Dark blue-gray theme (#0f172a) - Why? Dark blue conveys authority, professionalism, and seriousness appropriate for system administrators. */
        :root {
            --admin-primary: #0f172a;
            --admin-primary-light: #334155;
            --admin-accent: #3b82f6;
        }

        /* NAVBAR: Make sticky with shadow for depth */
        /* Why sticky-top? Keeps navigation accessible while scrolling long pages - improves UX */
        /* Why shadow-sm? Adds subtle vertical separation between nav and content */
        .navbar {
            background-color: var(--admin-primary) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }

        /* SIDEBAR: Light theme with borders - Why? Modern admin panels use light backgrounds with colored accents instead of dark sidebars. This is more readable and less overwhelming. */
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar .nav-link {
            color: #64748b;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem 0 0 0.5rem;
            margin: 0.25rem 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* HOVER STATE: Subtle background on hover - Why? Visual feedback tells users this element is interactive */
        .sidebar .nav-link:hover {
            color: var(--admin-primary);
            background-color: #f1f5f9;
        }

        /* ACTIVE STATE: Highlight current page - Why? Users need to know where they are in the system. High contrast with theme color shows active section */
        .sidebar .nav-link.active {
            color: var(--admin-accent);
            background-color: #eff6ff;
            font-weight: 600;
        }

        .sidebar .nav-link i {
            width: 20px;
            height: 20px;
        }

        /* MAIN CONTENT AREA: Add subtle padding and ensure content doesn't touch edges */
        main {
            padding-top: 1rem;
        }

        /* CARD HOVER LIFT EFFECT: Why? Small animations create delight and indicate interactivity. Users subconsciously associate lifted cards with "clickability" */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1) !important;
        }

        /* THEME-SPECIFIC COLORS: Reusable utility classes */
        /* Why utility classes? Makes it easy to apply theme colors anywhere without repeating hex values */
        .text-admin-theme { color: var(--admin-primary) !important; }
        .bg-admin-light { background-color: #eff6ff !important; }
        .border-admin { border-color: var(--admin-primary) !important; }

        /* Hospital theme class (available for use in admin if needed) */
        .text-hospital { color: var(--hospital-primary) !important; }
        .bg-hospital { background-color: #ecfdf5 !important; }

        /* Patient theme class */
        .text-patient { color: var(--patient-primary) !important; }
        .bg-patient { background-color: #eff6ff !important; }

        /* ICON WRAPPER: Standard size for dashboard card icons - Why? Consistency in icon presentation creates visual harmony */
        .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            background-color: #eff6ff;
            color: var(--admin-accent);
        }

        /* EMPTY STATE: Helpful design pattern when no data exists - Why? Empty states are opportunities to guide users, not dead ends. They should explain what's missing and provide a next step. */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        .empty-state i {
            opacity: 0.4;
            margin-bottom: 1rem;
        }

        /* TABLE ENHANCEMENTS: Better readability */
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

        /* SIDEBAR TOGGLE (responsive): Show/hide on small screens */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1040;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <!-- Why sticky-top? Keeps nav visible on scroll - critical for admin managing lots of data -->
    <!-- Why shadow-sm? Adds depth, separates nav from content -->
    <nav class="navbar navbar-dark sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <!-- Lucide Icon: layout-dashboard - Why? Represents admin control panel -->
                <i data-lucide="layout-dashboard" style="width: 28px; height: 28px;"></i>
                <span>COVID Admin</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light">Welcome, {{ auth()->user()->name }}</span>
                <!-- Logout link -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <!-- Why rounded-pill? Pill-shaped buttons feel more modern and are easier to click on mobile -->
                    <button type="submit" class="btn btn-outline-light btn-sm rounded-pill">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <!-- Why d-md-block? Hidden on mobile by default, shown on medium+ screens -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse show">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i data-lucide="layout-dashboard" style="width: 18px; height: 18px;"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}" href="{{ route('admin.patients.index') }}">
                                <i data-lucide="users" style="width: 18px; height: 18px;"></i>
                                Patients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.hospitals.*') ? 'active' : '' }}" href="{{ route('admin.hospitals.index') }}">
                                <i data-lucide="building" style="width: 18px; height: 18px;"></i>
                                Hospitals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.vaccines.*') ? 'active' : '' }}" href="{{ route('admin.vaccines.index') }}">
                                <i data-lucide="syringe" style="width: 18px; height: 18px;"></i>
                                Vaccines
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
                                <i data-lucide="calendar" style="width: 18px; height: 18px;"></i>
                                Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                                <i data-lucide="bar-chart-3" style="width: 18px; height: 18px;"></i>
                                Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <!-- Why these classes? col-md-9 offsets the 3-column sidebar, col-lg-10 offsets the 2-column on large screens -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Flash Messages -->
                <!-- Bootstrap's alert component is accessible and dismissible. We show success/error messages from Laravel sessions. -->
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

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Initialize Lucide Icons - Why? This call renders all <i data-lucide="..."> elements as SVG icons -->
    <script>lucide.createIcons();</script>
    @yield('scripts')
</body>
</html>
