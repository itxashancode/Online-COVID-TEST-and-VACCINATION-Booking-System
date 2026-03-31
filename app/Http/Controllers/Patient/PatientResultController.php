<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PatientResultController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $testResults = $user->testResults()
            ->with(['hospital', 'appointment'])
            ->latest()
            ->get();

        $vaccinationRecords = $user->vaccinationRecords()
            ->with(['vaccine', 'hospital'])
            ->latest()
            ->get();

        return view('patient.results.index', compact(
            'testResults',
            'vaccinationRecords'
        ));
    }
}
