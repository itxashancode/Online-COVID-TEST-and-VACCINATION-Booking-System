<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     * Shows overview statistics and navigation for admin users.
     * This method fetches all the data needed for the dashboard cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // WHY: Admin needs to see system-wide statistics at a glance
        // These counts help admin monitor platform health and activity

        // Get total patients count: Count all users with 'patient' role
        $totalPatients = User::role('patient')->count();

        // Get hospitals statistics by status
        $approvedHospitals = Hospital::where('status', 'approved')->count();
        $pendingHospitals = Hospital::where('status', 'pending')->count();
        $totalHospitals = Hospital::count();

        // Get total appointments across all hospitals
        $totalAppointments = Appointment::count();

        // Get COVID positive tests count (for monitoring outbreak patterns)
        $positiveTests = TestResult::where('result', 'positive')->count();

        // Get total vaccines available in the system
        $vaccineCount = Vaccine::count();

        // Pass all data to the view
        return view('admin.dashboard', compact(
            'totalPatients',
            'approvedHospitals',
            'pendingHospitals',
            'totalHospitals',
            'totalAppointments',
            'positiveTests',
            'vaccineCount'
        ));
    }
}
