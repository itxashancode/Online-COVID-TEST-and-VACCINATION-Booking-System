<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPatientController;
use App\Http\Controllers\Admin\AdminHospitalController;
use App\Http\Controllers\Admin\AdminVaccineController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Hospital\HospitalDashboardController;
use App\Http\Controllers\Hospital\HospitalPatientController;
use App\Http\Controllers\Hospital\HospitalAppointmentController;
use App\Http\Controllers\Hospital\HospitalResultController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\Patient\PatientSearchController;
use App\Http\Controllers\Patient\PatientAppointmentController;
use App\Http\Controllers\Patient\PatientResultController;
use App\Http\Controllers\Patient\PatientProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - COVID Booking System
|--------------------------------------------------------------------------
|
| Role-based routes for Admin, Hospital, and Patient modules.
| All protected with middleware: 'auth' + role check
|
*/


Route::get('/', function () {
    return redirect()->route('login');
});

// After login, redirect users to appropriate dashboard based on role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('hospital')) {
        // PREVENT REDIRECT LOOP: Check status before sending to hospital.dashboard
        if ($user->hospital && $user->hospital->status !== 'approved') {
            return view('hospital.pending', ['status' => $user->hospital->status]);
        }
        return redirect()->route('hospital.dashboard');
    } else {
        return redirect()->route('patient.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Patients Management
    Route::get('/patients', [AdminPatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{id}', [AdminPatientController::class, 'show'])->name('patients.show');

    // Hospitals Management
    Route::get('/hospitals', [AdminHospitalController::class, 'index'])->name('hospitals.index');
    Route::post('/hospitals/{id}/approve', [AdminHospitalController::class, 'approve'])->name('hospitals.approve');
    Route::post('/hospitals/{id}/reject', [AdminHospitalController::class, 'reject'])->name('hospitals.reject');
    Route::delete('/hospitals/{id}', [AdminHospitalController::class, 'destroy'])->name('hospitals.destroy');

    // Vaccines Management (Full CRUD)
    Route::resource('vaccines', AdminVaccineController::class);

    // Bookings Viewing
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    // Reports & Exports
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [AdminReportController::class, 'export'])->name('reports.export');
});

Route::prefix('hospital')->middleware(['auth', 'hospital'])->name('hospital.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [HospitalDashboardController::class, 'index'])->name('dashboard');

    // Patient List (those with approved appointments)
    Route::get('/patients', [HospitalPatientController::class, 'index'])->name('patients.index');

    // Appointment Requests Management
    Route::get('/appointments', [HospitalAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{id}/approve', [HospitalAppointmentController::class, 'approve'])->name('appointments.approve');
    Route::post('/appointments/{id}/reject', [HospitalAppointmentController::class, 'reject'])->name('appointments.reject');

    // Update Test Results & Vaccination Status
    Route::get('/results', [HospitalResultController::class, 'index'])->name('results.index');
    Route::get('/results/{id}/edit', [HospitalResultController::class, 'edit'])->name('results.edit');
    Route::put('/results/{id}', [HospitalResultController::class, 'update'])->name('results.update');

    // Separate route for vaccination update (if needed separately)
    Route::put('/vaccination/{id}', [HospitalResultController::class, 'updateVaccination'])->name('vaccination.update');
});

Route::prefix('patient')->middleware(['auth', 'patient'])->name('patient.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');

    // Search Hospitals
    Route::get('/search', [PatientSearchController::class, 'index'])->name('search');

    // Book Appointment
    Route::get('/appointments/create', [PatientAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [PatientAppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [PatientAppointmentController::class, 'index'])->name('appointments.index');

    // View Test Results & Vaccination Records
    Route::get('/results', [PatientResultController::class, 'index'])->name('results.index');

    // Download Certificates
    Route::get('/results/test/{id}/certificate', [PatientResultController::class, 'downloadTestCertificate'])->name('results.test.certificate');
    Route::get('/results/vaccination/{id}/certificate', [PatientResultController::class, 'downloadVaccinationCertificate'])->name('results.vaccination.certificate');

    // My Profile (View, Update, Delete)
    Route::get('/profile', [PatientProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [PatientProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [PatientProfileController::class, 'destroy'])->name('profile.destroy');
});

// These are automatically loaded by Breeze from routes/auth.php
require __DIR__ . '/auth.php';
