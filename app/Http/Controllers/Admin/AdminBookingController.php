<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Appointment;

class AdminBookingController extends Controller
{
    /**
     * Display all booking details.
     * Admin can view all patient booking details for COVID-19 tests and vaccinations.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Retrieve all appointments with patient and hospital relationships.
         * Why eager load ['patient', 'hospital']? Because the view will display:
         * - Patient name (from patient relationship)
         * - Hospital name (from hospital relationship)
         * This prevents N+1 queries by loading everything in 2-3 queries total
         */
        $appointments = Appointment::with(['patient', 'hospital'])->latest()->get();

        // Alternative with pagination if many appointments:
        // $appointments = Appointment::with(['patient', 'hospital'])->latest()->paginate(25);

        // Pass appointments to the view
        return view('admin.bookings.index', compact('appointments'));
    }
}
