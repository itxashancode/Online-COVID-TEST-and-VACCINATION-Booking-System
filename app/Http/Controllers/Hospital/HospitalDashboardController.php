<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Appointment;

class HospitalDashboardController extends Controller
{
    /**
     * Display the hospital dashboard.
     * Shows overview of hospital's appointments, patients, and latest updates.
     * Each hospital only sees their own data (not other hospitals' data).
     *
     * @return View
     */
    public function index(): View
    {
        // WHY: Hospitals need to see their own appointment statistics to manage workload
        // We only show data for the logged-in hospital (data isolation by role)

        // Get the hospital profile associated with the logged-in user
        // Each user (hospital admin) is linked to one hospital record via user_id
        $hospital = auth()->user()->hospital;

        // If hospital profile doesn't exist (shouldn't happen with proper registration), show empty stats
        if (!$hospital) {
            $pendingCount = $approvedCount = $completedCount = $recentAppointments = 0;
        } else {
            // WHY: We need to count appointments by status to track workflow
            // Pending: New requests awaiting hospital action
            // Approved: Confirmed appointments patient can see
            // Completed: Finished appointments (test done or vaccination given)
            $pendingCount = $hospital->appointments()->where('status', 'pending')->count();
            $approvedCount = $hospital->appointments()->where('status', 'approved')->count();
            $completedCount = $hospital->appointments()->where('status', 'completed')->count();

            // Get the 5 most recent appointment requests with patient details
            // WHY: Eager load 'patient' relationship to avoid N+1 query problem
            // This loads patient data in one query instead of one query per appointment
            $recentAppointments = $hospital->appointments()
                ->with('patient')  // Eager load patient relationship
                ->latest()         // Order by created_at DESC
                ->take(5)          // Limit to 5 recent items
                ->get();
        }

        // Pass data to view for display
        return view('hospital.dashboard', compact(
            'pendingCount',
            'approvedCount',
            'completedCount',
            'recentAppointments'
        ));
    }
}
