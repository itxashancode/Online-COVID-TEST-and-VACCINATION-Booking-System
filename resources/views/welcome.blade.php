<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COVID-19 Test & Vaccination Booking System</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .hero-section {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            padding: 100px 0;
            color: white;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }
        .btn-booking {
            background-color: #10b981;
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-booking:hover {
            background-color: #059669;
            transform: translateY(-2px);
            color: white;
        }
        .card-portal {
            border: none;
            border-radius: 20px;
            transition: all 0.3s;
            height: 100%;
        }
        .card-portal:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .portal-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute w-100">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
                <i data-lucide="shield-plus"></i>
                COVID Booking
            </a>
            <div class="ms-auto d-flex gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-light rounded-pill px-4">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-white text-decoration-none fw-medium">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light rounded-pill px-4 text-primary fw-bold">Sign Up</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Protect Yourself & Your Loved Ones</h1>
                    <p class="lead mb-5 opacity-90">Schedule your COVID-19 Test or Vaccination with ease. Fast, secure, and reliable booking at a hospital near you.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-booking rounded-pill shadow-lg">Get Started Now</a>
                        <a href="#portals" class="btn btn-outline-light rounded-pill px-4 d-flex align-items-center gap-2">
                             Learn More <i data-lucide="chevron-down" style="width: 18px;"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://img.freepik.com/free-vector/doctors-concept-illustration_114360-1515.jpg" alt="Healthcare Professionals" class="img-fluid rounded-4 shadow-2xl" style="filter: drop-shadow(0 0 20px rgba(0,0,0,0.2));">
                </div>
            </div>
        </div>
    </header>

    <!-- Portal Section -->
    <section id="portals" class="py-5" style="margin-top: -50px;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <!-- Patient Portal -->
                <div class="col-md-4">
                    <div class="card card-portal shadow-sm p-4 text-center">
                        <div class="portal-icon bg-primary bg-opacity-10 mx-auto text-primary">
                            <i data-lucide="user"></i>
                        </div>
                        <h4 class="fw-bold">For Patients</h4>
                        <p class="text-muted smaill">Search hospitals, book appointments, and download your results instantly.</p>
                        <a href="{{ route('register') }}?role=patient" class="btn btn-link text-decoration-none fw-bold mt-2">Book a Test →</a>
                    </div>
                </div>
                <!-- Hospital Portal -->
                <div class="col-md-4">
                    <div class="card card-portal shadow-sm p-4 text-center">
                        <div class="portal-icon bg-success bg-opacity-10 mx-auto text-success">
                            <i data-lucide="hospital"></i>
                        </div>
                        <h4 class="fw-bold">For Hospitals</h4>
                        <p class="text-muted smal">Partner with us to manage vaccination drives and patient test results efficiently.</p>
                        <a href="{{ route('register') }}?role=hospital" class="btn btn-link text-decoration-none fw-bold text-success mt-2">Join Network →</a>
                    </div>
                </div>
                <!-- Admin Portal -->
                <div class="col-md-4">
                    <div class="card card-portal shadow-sm p-4 text-center">
                        <div class="portal-icon bg-dark bg-opacity-10 mx-auto text-dark">
                            <i data-lucide="layout-dashboard"></i>
                        </div>
                        <h4 class="fw-bold">System Admin</h4>
                        <p class="text-muted sma">Oversee system operations, approve registrations, and manage global health metrics.</p>
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none fw-bold text-dark mt-2">Access Panel →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-5 bg-white border-top">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">Live Stats</div>
                    <h2 class="fw-bold mb-4">Empowering Healthcare with Real-time Data</h2>
                    <p class="text-muted mb-4 lead">Our system provides seamless coordination between patients and healthcare providers, ensuring every test is recorded and every vaccine is accounted for.</p>
                    <div class="row g-4">
                        <div class="col-6">
                            <h3 class="fw-bold text-primary mb-0">100%</h3>
                            <p class="text-muted">Digital Results</p>
                        </div>
                        <div class="col-6">
                            <h3 class="fw-bold text-success mb-0">24/7</h3>
                            <p class="text-muted">Online Booking</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-light rounded-4">
                         <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-primary text-white p-2 rounded-circle"><i data-lucide="check" style="width: 20px;"></i></div>
                            <span class="fw-medium">Secure Patient Records</span>
                         </div>
                         <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-success text-white p-2 rounded-circle"><i data-lucide="check" style="width: 20px;"></i></div>
                            <span class="fw-medium">Automated Vaccine Tracking</span>
                         </div>
                         <div class="d-flex align-items-center gap-3">
                            <div class="bg-info text-white p-2 rounded-circle"><i data-lucide="check" style="width: 20px;"></i></div>
                            <span class="fw-medium">Role-based Access Control</span>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0 opacity-50 small">&copy; 2024 Online COVID-19 Booking System. Built with Care for Public Health.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
