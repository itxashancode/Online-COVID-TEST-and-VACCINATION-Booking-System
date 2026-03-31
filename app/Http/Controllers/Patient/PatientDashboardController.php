<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Models\TestResult;
use App\Models\VaccinationRecord;

class PatientDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $upcomingAppointments = $user->appointments()
            ->whereIn('status', ['pending', 'approved'])
            ->with('hospital')
            ->latest()
            ->take(5)
            ->get();

        $completedCount = $user->appointments()
            ->where('status', 'completed')
            ->count();

        $recentResults = $user->testResults()
            ->with('hospital')
            ->latest()
            ->take(5)
            ->get();

        $vaccinationRecords = $user->vaccinationRecords()
            ->with('vaccine')
            ->latest()
            ->take(5)
            ->get();

        $upcomingCount = $upcomingAppointments->count();
        $resultsCount = $recentResults->count();

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
