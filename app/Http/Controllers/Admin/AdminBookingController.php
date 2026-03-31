<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display all booking details.
     * Admin can view all patient booking details for COVID-19 tests and vaccinations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Retrieve all appointments with patient and hospital relationships.
         * Later we'll add filters for date, status, type, etc.
         */
        // $appointments = Appointment::with(['patient', 'hospital'])->latest()->get();

        return view('admin.bookings.index');
    }
}
