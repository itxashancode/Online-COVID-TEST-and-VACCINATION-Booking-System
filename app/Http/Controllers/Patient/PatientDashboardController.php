<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    /**
     * Display the patient dashboard.
     * Shows patient's appointments, recent results, and quick actions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Get the authenticated patient (User model).
         * Retrieve their data:
         * - Upcoming appointments (status: pending, approved)
         * - Past appointments (status: completed)
         * - Latest test results
         * - Vaccination history
         */
        // $user = auth()->user();
        // $upcomingAppointments = $user->appointments()
        //     ->whereIn('status', ['pending', 'approved'])
        //     ->with('hospital')
        //     ->latest()
        //     ->take(5)
        //     ->get();
        //
        // $recentResults = $user->testResults()->latest()->take(5)->get();
        // $vaccinationRecords = $user->vaccinationRecords()->with('vaccine')->latest()->take(5)->get();

        return view('patient.dashboard');
    }
}
