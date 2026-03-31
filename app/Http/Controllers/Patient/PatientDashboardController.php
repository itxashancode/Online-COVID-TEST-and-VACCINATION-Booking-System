<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Appointment;
use App\Models\TestResult;
use App\Models\VaccinationRecord;

class PatientDashboardController extends Controller
{
    /**
     * Display the patient dashboard.
     * Shows patient's appointments, recent results, and quick actions.
     * Patients only see their own data (data isolation by role).
     *
     * @return View
     */
    public function index(): View
    {
        // WHY: Patients need to see their personal health information and appointments
        // Get the authenticated patient user
        $user = auth()->user();

        /**
         * UPCOMING APPOINTMENTS:
         * Why include 'pending'? Patient can see requests they've sent that haven't been reviewed yet
         * Why include 'approved'? Confirmed appointments that are scheduled
         */
        $upcomingAppointments = $user->appointments()  // Get all appointments for this patient
            ->whereIn('status', ['pending', 'approved'])  // Filter to upcoming ones
            ->with('hospital')  // Eager load hospital details (name, address) to show in table
            ->latest()          // Sort by appointment date descending (most recent first)
            ->take(5)           // Show only the next 5 (we have limited dashboard space)
            ->get();

        /**
         * COMPLETED APPOINTMENTS:
         * Count of appointments that have been marked as completed
         * Why? Shows patient their vaccination/test completion progress
         */
        $completedCount = $user->appointments()
            ->where('status', 'completed')
            ->count();

        /**
         * TEST RESULTS:
         * Patient's COVID test results linked through appointments table
         * Why eager load? Need both result value and doctor notes
         */
        $recentResults = $user->testResults()
            ->with('hospital')  // Need hospital name to show where test was done
            ->latest()          // Most recent first
            ->take(5)           // Limit to 5
            ->get();

        /**
         * VACCINATION HISTORY:
         * Records of vaccines patient has received
         * Need vaccine details to show which vaccine was administered
         */
        $vaccinationRecords = $user->vaccinationRecords()
            ->with('vaccine')  // Need vaccine name
            ->latest()         // Most recent first
            ->take(5)          // Limit to 5
            ->get();

        // WHY: Count of upcoming appointments shown in dashboard card
        $upcomingCount = $upcomingAppointments->count();

        // WHY: Count of test results shown in dashboard card
        $resultsCount = $recentResults->count();

        // Pass all fetched data to the patient dashboard view
        return view('patient.dashboard', compact(
            'upcomingAppointments',
            'completedCount',
            'recentResults',
            'vaccinationRecords',
            'upcomingCount',
            'resultsCount'
        ));
    }
}
