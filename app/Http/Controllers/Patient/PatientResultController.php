<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\TestResult;
use App\Models\VaccinationRecord;

class PatientResultController extends Controller
{
    /**
     * Display patient's test results and vaccination reports.
     * Shows COVID-19 test results and vaccination history.
     *
     * @return View
     */
    public function index(): View
    {
        // Get the authenticated patient user
        $user = auth()->user();

        /**
         * Fetch all COVID test results for this patient.
         * Why eager load 'hospital' and 'appointment'?
         * - hospital: to show which hospital conducted the test
         * - appointment: to link back to the appointment record
         */
        $testResults = $user->testResults()
            ->with(['hospital', 'appointment'])
            ->latest()  // Most recent first
            ->get();

        /**
         * Fetch all vaccination records for this patient.
         * Why eager load 'vaccine' and 'hospital'?
         * - vaccine: to show which vaccine was administered
         * - hospital: to show where vaccination took place
         */
        $vaccinationRecords = $user->vaccinationRecords()
            ->with(['vaccine', 'hospital'])
            ->latest()
            ->get();

        // Pass both datasets to the view (tabs display them separately)
        return view('patient.results.index', compact(
            'testResults',
            'vaccinationRecords'
        ));
    }
}
