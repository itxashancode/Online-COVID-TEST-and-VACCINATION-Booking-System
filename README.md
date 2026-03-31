# 🦠 COVID TEST and VACCINATION Booking System
### Product Requirements Document (PRD)
**Framework:** Laravel 10 | **Level:** Junior Developer | **Tool:** Claude Code

---

## 📋 Table of Contents

1. [Project Overview](#1-project-overview)
2. [Problem Statement](#2-problem-statement)
3. [Objectives](#3-objectives)
4. [Standards & Documentation Requirements](#4-standards--documentation-requirements)
5. [Hardware & Software Requirements](#5-hardware--software-requirements)
6. [System Modules Overview](#6-system-modules-overview)
7. [Detailed Module Descriptions](#7-detailed-module-descriptions)
8. [Tech Stack](#8-tech-stack)
9. [Project Setup — Step by Step Commands](#9-project-setup--step-by-step-commands)
10. [Database Schema](#10-database-schema)
11. [Folder Structure](#11-folder-structure)
12. [Routes Plan](#12-routes-plan)
13. [Controllers Plan](#13-controllers-plan)
14. [Views Plan](#14-views-plan)
15. [Coding Standards (Mandatory)](#15-coding-standards-mandatory)
16. [Documentation Checklist (Mandatory)](#16-documentation-checklist-mandatory)
17. [Unit Testing Checklist](#17-unit-testing-checklist)
18. [Final Checklist](#18-final-checklist)
19. [Claude Code Prompting Guide](#19-claude-code-prompting-guide)

---

## 1. Project Overview

**Application Name:** Online COVID TEST and VACCINATION Booking System

**Description:**  
A web application that connects patients with hospitals and administration to manage COVID-19 test bookings and vaccination appointments. People across the world are facing unforeseen challenges due to the Coronavirus pandemic. This web app links hospitals across the country for mobile number-based online registration and appointment booking.

**What the app does:**
- Patients can search hospitals, book appointments for COVID tests or vaccinations
- Hospitals can manage patients, approve/reject requests, and update test results
- Admins can oversee all hospitals, patients, bookings, and generate reports

---

## 2. Problem Statement

> *Taken directly from project specification document.*

Design and develop a web application for an online COVID test and vaccination booking system for patients. The COVID-19 web app connects people with hospitals and administration to fight the pandemic. With this web app, one can:
- Track vaccination appointments
- View appointment history
- Access COVID solution guidelines and symptoms

The Online Registration System (ORS) links various hospitals across the country for mobile number-based online registration. Hospitals can come on board and provide their appointment slots for online booking by patients. The system facilitates hospitals to easily manage their registration and appointment process and monitor the flow of patients.

---

## 3. Objectives

> *Taken directly from project specification document.*

- Provide a real-life project scenario for implementation
- Build a larger, more robust application using practical tools
- Work on real-life problems and apply learned concepts
- Enhance skills and add value through step-by-step implementation
- Single program to unified code leading to a complete application

---

## 4. Standards & Documentation Requirements

> ⚠️ **MANDATORY — These must be followed strictly as per the project specification.**

### Code Standards
- **Every code block MUST have comments** explaining what it does
- The **logic of the program needs to be explained** in comments
- **Proper documentation** must be maintained throughout

### Required Documentation (Full Project Report Must Include)
1. ✅ Certificate of Completion
2. ✅ Table of Contents
3. ✅ Problem Definition
4. ✅ Customer Requirement Specification
5. ✅ Project Plan
6. ✅ E-R Diagrams
7. ✅ Algorithms
8. ✅ GUI Standards Document
9. ✅ Interface Design Document
10. ✅ Task Sheet
11. ✅ Project Review and Monitoring Report
12. ✅ Unit Testing Check List
13. ✅ Final Check List

> Complete project report along with synopsis, code, and documentation must be prepared.

---

## 5. Hardware & Software Requirements

> *As specified in the project specification document.*

### Hardware
- Minimum: Pentium 166 or better processor
- Minimum: 128 MB RAM or better

### Operating System
- Linux or Windows 2000 Server (or higher)

### Original Software Specified (We are replacing with Laravel equivalents)
| Original Spec | Our Laravel 10 Equivalent |
|---|---|
| PHP | PHP 8.1+ |
| MySQL | MySQL 8.0 |
| Apache | Laravel Dev Server / Apache |
| PERL | Not needed (Laravel handles this) |

---

## 6. System Modules Overview

The system has **3 main roles / modules:**

```
┌─────────────────────────────────────────────────┐
│              COVID BOOKING SYSTEM                │
├───────────────┬──────────────────┬───────────────┤
│     ADMIN     │    HOSPITAL      │    PATIENT    │
├───────────────┼──────────────────┼───────────────┤
│ All Patients  │ Register/Login   │ Register/Login│
│ Reports       │ Patient List     │ Search Hosp.  │
│ Vaccine List  │ Approve/Reject   │ Request Test  │
│ Approve Hosp. │ Update Results   │ Book Appoint. │
│ Hospital List │ Update Vacc.     │ My Appoint.   │
│ Booking Dets. │ Status           │ View Results  │
│               │                  │ My Profile    │
└───────────────┴──────────────────┴───────────────┘
```

---

## 7. Detailed Module Descriptions

> *All features below are taken directly from the project specification — all must be implemented.*

### 7.1 Admin Module

| Feature | Description |
|---|---|
| **All Patient Details** | View all patient profile details registered in the system |
| **Report of COVID-19** | View patient COVID-19 test reports with date-wise filtering |
| **Export Reports** | Admin can export details in XLS format — by date, week, and month |
| **List of Vaccines** | View vaccine availability (available or unavailable) |
| **Approve Hospital Login** | Approve or Reject hospital registration requests |
| **List of Hospitals** | Admin can view all hospital details |
| **Booking Details** | Admin can view all patient booking details for COVID-19 tests |

### 7.2 Hospital Module

| Feature | Description |
|---|---|
| **Register** | Hospital can register with name, address, and location details |
| **Login** | Hospital can log in to their dashboard |
| **List of Patient Details** | View patients who are approved for COVID-19 tests |
| **Request from Patient (Approve/Reject)** | Hospitals can approve or reject COVID-19 test/vaccination requests from patients |
| **Update COVID-19 Result** | Hospitals can update patient COVID-19 test results |
| **Update Vaccination Status** | Hospitals can update patient vaccination status |

### 7.3 Patient Module

| Feature | Description |
|---|---|
| **Register** | Patient can register with name, address, and location details |
| **Login** | Patient can log in to their dashboard |
| **Search COVID-19/Vaccination Hospital** | Patient can search for COVID-19 testing and vaccination hospitals |
| **Request for COVID-19 Test/Vaccination** | Patient can send a request to a hospital for COVID-19 test or vaccination |
| **Report of COVID Test/Vaccination Taken** | Patient can view their COVID-19 test results and vaccination reports |
| **Book Hospital Appointment** | Patient can book an appointment at a hospital |
| **My Appointment** | Patient can view appointment timing and hospital details |
| **View Results** | Patient can view COVID-19 test results and vaccination suggestions |
| **My Profile** | Patient can view, edit, and delete their profile information |

---

## 8. Tech Stack

| Tool | Version | Purpose |
|---|---|---|
| **Laravel** | 10.x | Main PHP Framework |
| **PHP** | 8.1+ | Server-side language |
| **MySQL** | 8.0 | Database |
| **Laravel Breeze** | Latest | Authentication (Login/Register) |
| **Spatie Laravel Permission** | Latest | Role management (Admin/Hospital/Patient) |
| **Maatwebsite Excel** | 3.x | Export reports to XLS |
| **Bootstrap 5** | CDN | Frontend UI styling |
| **Blade** | Built-in | Laravel template engine |

---

## 9. Project Setup — Step by Step Commands

> Follow these commands in exact order. Run them in your terminal.

### Step 1 — Install Laravel 10

```bash
# Make sure you have Composer installed
composer create-project laravel/laravel covid-booking-system "10.*"

# Go into the project folder
cd covid-booking-system
```

### Step 2 — Configure Your Database

Open `.env` file and change these lines:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=covid_booking
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

Create the database in MySQL:

```sql
CREATE DATABASE covid_booking;
```

### Step 3 — Install Laravel Breeze (Authentication)

Breeze gives us ready-made login, register, and logout pages.

```bash
# Install Breeze package
composer require laravel/breeze --dev

# Install Breeze with Blade (simple HTML views, good for beginners)
php artisan breeze:install blade

# Install frontend dependencies
npm install

# Build frontend assets
npm run dev
```

### Step 4 — Install Spatie Permission (Roles & Guards)

This package handles Admin, Hospital, and Patient roles.

```bash
# Install the package
composer require spatie/laravel-permission

# Publish the config file
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Run the migration to create permissions tables
php artisan migrate
```

Add the `HasRoles` trait to your `User` model (`app/Models/User.php`):

```php
// app/Models/User.php

use Spatie\Permission\Traits\HasRoles; // Add this line at the top

class User extends Authenticatable
{
    use HasRoles; // Add this inside the class
    // ... rest of the model
}
```

### Step 5 — Install Maatwebsite Excel (For XLS Export)

This is used so Admin can export patient/booking reports.

```bash
# Install the package
composer require maatwebsite/excel

# Publish the config
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```

### Step 6 — Run All Migrations

```bash
php artisan migrate
```

### Step 7 — Create a Database Seeder for Roles and Admin

```bash
# Create seeder file
php artisan make:seeder RolesAndAdminSeeder
```

Edit `database/seeders/RolesAndAdminSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create the 3 roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'hospital']);
        Role::create(['name' => 'patient']);

        // Create the default admin user
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@covid.com',
            'password' => Hash::make('password'),
        ]);

        // Assign admin role to this user
        $admin->assignRole('admin');
    }
}
```

Run the seeder:

```bash
php artisan db:seed --class=RolesAndAdminSeeder
```

### Step 8 — Start the Development Server

```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

---

## 10. Database Schema

Create these migration files one by one:

### Users Table (already exists from Breeze — just modify it)

```bash
# The users table is already created by Breeze
# Add extra columns using a new migration
php artisan make:migration add_role_fields_to_users_table --table=users
```

```php
// In the migration file:
Schema::table('users', function (Blueprint $table) {
    $table->string('phone')->nullable();
    $table->string('address')->nullable();
    $table->string('city')->nullable();
    $table->enum('user_type', ['admin', 'hospital', 'patient'])->default('patient');
    $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
});
```

### Hospitals Table

```bash
php artisan make:migration create_hospitals_table
```

```php
Schema::create('hospitals', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // links to users table
    $table->string('hospital_name');
    $table->string('address');
    $table->string('city');
    $table->string('phone');
    $table->text('description')->nullable();
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // admin approves
    $table->timestamps();
});
```

### Vaccines Table

```bash
php artisan make:migration create_vaccines_table
```

```php
Schema::create('vaccines', function (Blueprint $table) {
    $table->id();
    $table->string('vaccine_name');
    $table->text('description')->nullable();
    $table->enum('availability', ['available', 'unavailable'])->default('available');
    $table->timestamps();
});
```

### Appointments Table

```bash
php artisan make:migration create_appointments_table
```

```php
Schema::create('appointments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
    $table->enum('appointment_type', ['covid_test', 'vaccination']);
    $table->date('appointment_date');
    $table->time('appointment_time')->nullable();
    $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
    $table->text('notes')->nullable();
    $table->timestamps();
});
```

### Test Results Table

```bash
php artisan make:migration create_test_results_table
```

```php
Schema::create('test_results', function (Blueprint $table) {
    $table->id();
    $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
    $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
    $table->enum('result', ['positive', 'negative', 'pending'])->default('pending');
    $table->text('doctor_notes')->nullable();
    $table->date('result_date')->nullable();
    $table->timestamps();
});
```

### Vaccination Records Table

```bash
php artisan make:migration create_vaccination_records_table
```

```php
Schema::create('vaccination_records', function (Blueprint $table) {
    $table->id();
    $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
    $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
    $table->foreignId('vaccine_id')->constrained()->onDelete('cascade');
    $table->enum('dose', ['first', 'second', 'booster']);
    $table->date('vaccination_date');
    $table->enum('status', ['completed', 'pending'])->default('pending');
    $table->timestamps();
});
```

Run all migrations:

```bash
php artisan migrate
```

---

## 11. Folder Structure

```
covid-booking-system/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminDashboardController.php
│   │   │   │   ├── AdminPatientController.php
│   │   │   │   ├── AdminHospitalController.php
│   │   │   │   ├── AdminVaccineController.php
│   │   │   │   ├── AdminBookingController.php
│   │   │   │   └── AdminReportController.php
│   │   │   ├── Hospital/
│   │   │   │   ├── HospitalDashboardController.php
│   │   │   │   ├── HospitalPatientController.php
│   │   │   │   ├── HospitalAppointmentController.php
│   │   │   │   └── HospitalResultController.php
│   │   │   ├── Patient/
│   │   │   │   ├── PatientDashboardController.php
│   │   │   │   ├── PatientSearchController.php
│   │   │   │   ├── PatientAppointmentController.php
│   │   │   │   ├── PatientResultController.php
│   │   │   │   └── PatientProfileController.php
│   │   │   └── Auth/               ← (Breeze handles this)
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       ├── HospitalMiddleware.php
│   │       └── PatientMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Hospital.php
│   │   ├── Vaccine.php
│   │   ├── Appointment.php
│   │   ├── TestResult.php
│   │   └── VaccinationRecord.php
│   └── Exports/
│       └── AppointmentsExport.php   ← For Excel export
│
├── database/
│   ├── migrations/
│   └── seeders/
│       └── RolesAndAdminSeeder.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── admin.blade.php
│       │   ├── hospital.blade.php
│       │   └── patient.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── patients/
│       │   ├── hospitals/
│       │   ├── vaccines/
│       │   ├── bookings/
│       │   └── reports/
│       ├── hospital/
│       │   ├── dashboard.blade.php
│       │   ├── patients/
│       │   ├── appointments/
│       │   └── results/
│       └── patient/
│           ├── dashboard.blade.php
│           ├── search.blade.php
│           ├── appointments/
│           ├── results/
│           └── profile/
│
└── routes/
    └── web.php
```

---

## 12. Routes Plan

All routes go in `routes/web.php`.

```php
<?php

use Illuminate\Support\Facades\Route;

// ─── PUBLIC ROUTES ────────────────────────────────────────────────
// These are handled automatically by Laravel Breeze (login, register, logout)

// ─── REDIRECT AFTER LOGIN ─────────────────────────────────────────
// After login, send user to correct dashboard based on role
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->hasRole('hospital')) {
        return redirect()->route('hospital.dashboard');
    } else {
        return redirect()->route('patient.dashboard');
    }
})->middleware('auth')->name('dashboard');


// ─── ADMIN ROUTES ──────────────────────────────────────────────────
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    Route::get('/dashboard',         [AdminDashboardController::class, 'index'])->name('dashboard');

    // Patients
    Route::get('/patients',          [AdminPatientController::class, 'index'])->name('patients.index');

    // Hospitals
    Route::get('/hospitals',         [AdminHospitalController::class, 'index'])->name('hospitals.index');
    Route::post('/hospitals/{id}/approve', [AdminHospitalController::class, 'approve'])->name('hospitals.approve');
    Route::post('/hospitals/{id}/reject',  [AdminHospitalController::class, 'reject'])->name('hospitals.reject');

    // Vaccines
    Route::resource('vaccines', AdminVaccineController::class);

    // Bookings
    Route::get('/bookings',          [AdminBookingController::class, 'index'])->name('bookings.index');

    // Reports
    Route::get('/reports',           [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export',    [AdminReportController::class, 'export'])->name('reports.export');
});


// ─── HOSPITAL ROUTES ───────────────────────────────────────────────
Route::prefix('hospital')->middleware(['auth', 'role:hospital'])->name('hospital.')->group(function () {

    Route::get('/dashboard',          [HospitalDashboardController::class, 'index'])->name('dashboard');

    // Patient list
    Route::get('/patients',           [HospitalPatientController::class, 'index'])->name('patients.index');

    // Appointment requests
    Route::get('/appointments',       [HospitalAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{id}/approve', [HospitalAppointmentController::class, 'approve'])->name('appointments.approve');
    Route::post('/appointments/{id}/reject',  [HospitalAppointmentController::class, 'reject'])->name('appointments.reject');

    // Update test result
    Route::get('/results/{id}/edit',  [HospitalResultController::class, 'edit'])->name('results.edit');
    Route::put('/results/{id}',       [HospitalResultController::class, 'update'])->name('results.update');

    // Update vaccination status
    Route::put('/vaccination/{id}',   [HospitalResultController::class, 'updateVaccination'])->name('vaccination.update');
});


// ─── PATIENT ROUTES ────────────────────────────────────────────────
Route::prefix('patient')->middleware(['auth', 'role:patient'])->name('patient.')->group(function () {

    Route::get('/dashboard',          [PatientDashboardController::class, 'index'])->name('dashboard');

    // Search hospitals
    Route::get('/search',             [PatientSearchController::class, 'index'])->name('search');

    // Book appointment
    Route::get('/appointments/create',       [PatientAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments',             [PatientAppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments',              [PatientAppointmentController::class, 'index'])->name('appointments.index');

    // View results
    Route::get('/results',            [PatientResultController::class, 'index'])->name('results.index');

    // My profile
    Route::get('/profile',            [PatientProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile',            [PatientProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',         [PatientProfileController::class, 'destroy'])->name('profile.destroy');
});
```

---

## 13. Controllers Plan

### Create All Controllers with Commands

```bash
# Admin Controllers
php artisan make:controller Admin/AdminDashboardController
php artisan make:controller Admin/AdminPatientController
php artisan make:controller Admin/AdminHospitalController
php artisan make:controller Admin/AdminVaccineController --resource
php artisan make:controller Admin/AdminBookingController
php artisan make:controller Admin/AdminReportController

# Hospital Controllers
php artisan make:controller Hospital/HospitalDashboardController
php artisan make:controller Hospital/HospitalPatientController
php artisan make:controller Hospital/HospitalAppointmentController
php artisan make:controller Hospital/HospitalResultController

# Patient Controllers
php artisan make:controller Patient/PatientDashboardController
php artisan make:controller Patient/PatientSearchController
php artisan make:controller Patient/PatientAppointmentController
php artisan make:controller Patient/PatientResultController
php artisan make:controller Patient/PatientProfileController
```

### Create All Models

```bash
php artisan make:model Hospital
php artisan make:model Vaccine
php artisan make:model Appointment
php artisan make:model TestResult
php artisan make:model VaccinationRecord
```

### Create Middleware

```bash
php artisan make:middleware AdminMiddleware
php artisan make:middleware HospitalMiddleware
php artisan make:middleware PatientMiddleware
```

### Create Excel Export

```bash
php artisan make:export AppointmentsExport --model=Appointment
```

---

## 14. Views Plan

### Create All View Files

```bash
# Create layout files
mkdir -p resources/views/layouts
touch resources/views/layouts/admin.blade.php
touch resources/views/layouts/hospital.blade.php
touch resources/views/layouts/patient.blade.php

# Admin views
mkdir -p resources/views/admin/patients
mkdir -p resources/views/admin/hospitals
mkdir -p resources/views/admin/vaccines
mkdir -p resources/views/admin/bookings
mkdir -p resources/views/admin/reports
touch resources/views/admin/dashboard.blade.php

# Hospital views
mkdir -p resources/views/hospital/patients
mkdir -p resources/views/hospital/appointments
mkdir -p resources/views/hospital/results
touch resources/views/hospital/dashboard.blade.php

# Patient views
mkdir -p resources/views/patient/appointments
mkdir -p resources/views/patient/results
mkdir -p resources/views/patient/profile
touch resources/views/patient/dashboard.blade.php
touch resources/views/patient/search.blade.php
```

### Basic Layout Template (Use This for All Layouts)

`resources/views/layouts/admin.blade.php`:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - COVID Booking System</title>
    <!-- Bootstrap 5 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">COVID Admin Panel</a>
            <!-- Logout link -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

---

## 15. Coding Standards (Mandatory)

> ⚠️ **As per project specification: Every code block MUST have comments. The logic of the program needs to be explained.**

### Rules Every File Must Follow

1. **Every function must have a comment** above it explaining what it does
2. **Every query/logic block** must have an inline comment
3. **Variable names** should be clear and readable (e.g. `$patientList` not `$pl`)
4. **No magic numbers** — use constants or named variables

### Example of Correct Comment Style

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Appointment;

class AdminPatientController extends Controller
{
    /**
     * Show a list of all registered patients.
     * Admin can see all patient profiles from here.
     */
    public function index()
    {
        // Get all users who have the 'patient' role
        $patients = User::role('patient')->get();

        // Pass the list to the view
        return view('admin.patients.index', compact('patients'));
    }
}
```

---

## 16. Documentation Checklist (Mandatory)

> These items MUST be completed as part of the final project submission per the project specification.

- [ ] **Certificate of Completion** — Signed document
- [ ] **Table of Contents** — In the final report
- [ ] **Problem Definition** — Describe the COVID booking problem
- [ ] **Customer Requirement Specification** — List all features per role
- [ ] **Project Plan** — Timeline of when each module was built
- [ ] **E-R Diagrams** — Draw relationships between Users, Hospitals, Appointments, Results
- [ ] **Algorithms** — Write out logic for booking, approval, result update
- [ ] **GUI Standards Document** — Describe your UI design decisions
- [ ] **Interface Design Document** — Screenshots of every screen
- [ ] **Task Sheet** — Table listing every feature and who built it
- [ ] **Project Review and Monitoring Report** — Notes on what was reviewed/changed
- [ ] **Unit Testing Check List** — (see Section 17)
- [ ] **Final Check List** — (see Section 18)

---

## 17. Unit Testing Checklist

Test each feature below manually (or write PHPUnit tests):

### Auth Tests
- [ ] Patient can register with name, email, password, phone, address
- [ ] Hospital can register and lands on pending approval page
- [ ] Admin can log in with seeded credentials (`admin@covid.com` / `password`)
- [ ] Logged-out users are redirected to login page

### Admin Tests
- [ ] Admin can see all patients list
- [ ] Admin can approve a hospital
- [ ] Admin can reject a hospital
- [ ] Admin can view all bookings
- [ ] Admin can see vaccine list with availability status
- [ ] Admin can export report to XLS by date, week, month
- [ ] Admin can view COVID test reports

### Hospital Tests
- [ ] Hospital can log in after admin approval
- [ ] Hospital can see list of patients with approved appointments
- [ ] Hospital can approve a patient appointment request
- [ ] Hospital can reject a patient appointment request
- [ ] Hospital can update COVID-19 test result (positive/negative)
- [ ] Hospital can update vaccination status

### Patient Tests
- [ ] Patient can register and log in
- [ ] Patient can search for hospitals
- [ ] Patient can request a COVID test at a hospital
- [ ] Patient can request a vaccination at a hospital
- [ ] Patient can view their appointments (My Appointments)
- [ ] Patient can view their test results
- [ ] Patient can view their vaccination history
- [ ] Patient can edit their profile
- [ ] Patient can delete their profile

---

## 18. Final Checklist

Before submitting the project, verify:

- [ ] All 3 roles work correctly (Admin, Hospital, Patient)
- [ ] Every page has a working navigation/sidebar
- [ ] Login/Logout works for all roles
- [ ] Hospital registration goes through Admin approval flow
- [ ] Patient can complete full booking journey end to end
- [ ] Hospital can update test results and vaccination status
- [ ] Admin export (XLS) works for reports
- [ ] All forms have CSRF protection (`@csrf`)
- [ ] All routes are protected by correct role middleware
- [ ] No debug errors (`APP_DEBUG=false` in production)
- [ ] All code blocks have comments
- [ ] Database is seeded with at least one admin user
- [ ] Documentation report is complete with all 13 items

---

## 19. Claude Code Prompting Guide

Use these prompts when working with Claude Code to build each part of the system.

### Getting Started
```
Set up a Laravel 10 project called covid-booking-system. 
Install Laravel Breeze with Blade, Spatie Permission package, and Maatwebsite Excel.
Run all migrations and create a seeder that adds admin, hospital, and patient roles plus a default admin user.
```

### Building the Database
```
Create migrations for these tables in Laravel 10:
- hospitals (linked to users, with status pending/approved/rejected)
- vaccines (with availability field)
- appointments (linked to patients and hospitals, type: covid_test or vaccination)
- test_results (linked to appointments, result: positive/negative/pending)
- vaccination_records (linked to appointments and vaccines)
Run php artisan migrate after creating all of them.
```

### Building Admin Features
```
Create an AdminHospitalController in app/Http/Controllers/Admin/.
Add an index method that shows all hospitals.
Add approve and reject methods that update hospital status.
Protect all routes with role:admin middleware using Spatie.
Create a simple Bootstrap 5 blade view for each action.
Add comments above every method explaining what it does.
```

### Building Hospital Features
```
Create a HospitalAppointmentController.
Add an index method that shows all appointment requests for the logged-in hospital.
Add approve and reject methods.
Create a HospitalResultController with an update method to save COVID test results.
Add a separate method to update vaccination status.
Use role:hospital middleware on all routes.
Add comments to every method.
```

### Building Patient Features
```
Create PatientSearchController with an index method that lets patients search hospitals by name or city.
Create PatientAppointmentController with create, store, and index methods.
Create PatientResultController with an index method that shows test and vaccination results.
Create PatientProfileController with index, update, and destroy methods.
Use role:patient middleware.
Add Bootstrap 5 views for each. Add comments to every method.
```

### Building Export Feature
```
Create an AppointmentsExport class using Maatwebsite Excel.
In AdminReportController, add an export method that downloads appointments as an .xlsx file.
Allow filtering by date, this week, and this month.
```

### Fixing Middleware
```
Register AdminMiddleware, HospitalMiddleware, PatientMiddleware in app/Http/Kernel.php.
Each middleware should check the user's role using Spatie and redirect if they don't have access.
Add the middleware to all route groups in web.php.
```

---

## 📁 Quick Reference: All Artisan Commands

```bash
# Create project
composer create-project laravel/laravel covid-booking-system "10.*"
cd covid-booking-system

# Install packages
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev

composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

composer require maatwebsite/excel
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config

# Create migrations
php artisan make:migration add_role_fields_to_users_table --table=users
php artisan make:migration create_hospitals_table
php artisan make:migration create_vaccines_table
php artisan make:migration create_appointments_table
php artisan make:migration create_test_results_table
php artisan make:migration create_vaccination_records_table
php artisan migrate

# Create models
php artisan make:model Hospital
php artisan make:model Vaccine
php artisan make:model Appointment
php artisan make:model TestResult
php artisan make:model VaccinationRecord

# Create controllers
php artisan make:controller Admin/AdminDashboardController
php artisan make:controller Admin/AdminPatientController
php artisan make:controller Admin/AdminHospitalController
php artisan make:controller Admin/AdminVaccineController --resource
php artisan make:controller Admin/AdminBookingController
php artisan make:controller Admin/AdminReportController
php artisan make:controller Hospital/HospitalDashboardController
php artisan make:controller Hospital/HospitalPatientController
php artisan make:controller Hospital/HospitalAppointmentController
php artisan make:controller Hospital/HospitalResultController
php artisan make:controller Patient/PatientDashboardController
php artisan make:controller Patient/PatientSearchController
php artisan make:controller Patient/PatientAppointmentController
php artisan make:controller Patient/PatientResultController
php artisan make:controller Patient/PatientProfileController

# Create middleware
php artisan make:middleware AdminMiddleware
php artisan make:middleware HospitalMiddleware
php artisan make:middleware PatientMiddleware

# Create export
php artisan make:export AppointmentsExport --model=Appointment

# Create seeder
php artisan make:seeder RolesAndAdminSeeder
php artisan db:seed --class=RolesAndAdminSeeder

# Start server
php artisan serve
```

---

*This PRD is based on the project specification documents: "PHP-COVID TEST and VACCINATION System" and "Project Specification — COVID TEST and VACCINATION Booking System (OST)". All module features, documentation requirements, and standards have been carried over from the original specification without omission.*