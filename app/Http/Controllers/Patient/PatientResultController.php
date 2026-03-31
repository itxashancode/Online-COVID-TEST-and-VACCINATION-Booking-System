<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientResultController extends Controller
{
    /**
     * Display patient's test results and vaccination reports.
     * Shows COVID-19 test results and vaccination history.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Retrieve all test results for the authenticated patient.
         * Include hospital and appointment details for context.
         *
         * Also retrieve all vaccination records.
         */
        // $user = auth()->user();
        //
        // $testResults = $user->testResults()
        //     ->with(['hospital', 'appointment'])
        //     ->latest()
        //     ->get();
        //
        // $vaccinationRecords = $user->vaccinationRecords()
        //     ->with(['vaccine', 'hospital'])
        //     ->latest()
        //     ->get();

        return view('patient.results.index');
    }
}
