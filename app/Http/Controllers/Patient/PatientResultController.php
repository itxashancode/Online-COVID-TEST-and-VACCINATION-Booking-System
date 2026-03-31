<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Models\TestResult;
use App\Models\VaccinationRecord;
use Barryvdh\DomPDF\Facade\Pdf;

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

    /**
     * Download COVID-19 Test Result Certificate
     */
    public function downloadTestCertificate(TestResult $testResult): Response
    {
        // Authorization: Ensure the test result belongs to the authenticated patient
        if ($testResult->patient_id !== auth()->id()) {
            abort(403, 'Unauthorized access');
        }

        $data = [
            'testResult' => $testResult,
            'patient' => $testResult->patient,
            'hospital' => $testResult->hospital,
            'appointment' => $testResult->appointment,
            'generated_at' => now(),
        ];

        $pdf = Pdf::loadView('patient.certificates.test', $data);

        $fileName = 'COVID-19_Test_Certificate_' . $testResult->id . '_' . now()->format('Y_m_d') . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Download Vaccination Certificate
     */
    public function downloadVaccinationCertificate(VaccinationRecord $vaccinationRecord): Response
    {
        // Authorization: Ensure the vaccination record belongs to the authenticated patient
        if ($vaccinationRecord->patient_id !== auth()->id()) {
            abort(403, 'Unauthorized access');
        }

        $data = [
            'vaccinationRecord' => $vaccinationRecord,
            'patient' => $vaccinationRecord->patient,
            'hospital' => $vaccinationRecord->hospital,
            'vaccine' => $vaccinationRecord->vaccine,
            'generated_at' => now(),
        ];

        $pdf = Pdf::loadView('patient.certificates.vaccination', $data);

        $fileName = 'Vaccination_Certificate_' . $vaccinationRecord->id . '_' . now()->format('Y_m_d') . '.pdf';

        return $pdf->download($fileName);
    }
}
