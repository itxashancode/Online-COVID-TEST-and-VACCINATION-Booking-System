<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalDashboardController extends Controller
{
    /**
     * Display the hospital dashboard.
     * Shows overview of hospital's appointments, patients, and latest updates.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Hospital dashboard statistics:
         * - Pending appointment requests count
         * - Approved appointments count
         * - Completed appointments count
         * - Recent appointment requests
         * - Upcoming appointments
         */
        // $hospital = auth()->user()->hospital; // Get logged-in hospital's profile
        // $pendingCount = $hospital->appointments()->where('status', 'pending')->count();
        // $approvedCount = $hospital->appointments()->where('status', 'approved')->count();
        // $completedCount = $hospital->appointments()->where('status', 'completed')->count();
        // $recentAppointments = $hospital->appointments()->with('patient')->latest()->take(5)->get();

        return view('hospital.dashboard');
    }
}
