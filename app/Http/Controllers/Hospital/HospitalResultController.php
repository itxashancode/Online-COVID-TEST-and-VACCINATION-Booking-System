<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use App\Models\TestResult;
use App\Models\VaccinationRecord;
use App\Models\Vaccine;

class HospitalResultController extends Controller
{
    public function index(): View
    {
        $hospital = auth()->user()->hospital;

        if (!$hospital) {
            abort(404, 'Hospital profile not found.');
        }

        $appointments = Appointment::where('hospital_id', $hospital->id)
            ->whereIn('status', ['completed', 'approved'])
            ->with(['patient', 'testResult', 'vaccinationRecord', 'vaccinationRecord.vaccine'])
            ->latest()
            ->get();

        return view('hospital.results.index', compact('appointments'));
    }

    public function edit($id): View
    {
        $hospital = auth()->user()->hospital;

        if (!$hospital) {
            abort(403, 'Hospital profile not found. Please contact admin.');
        }

        $appointment = Appointment::where('id', $id)
            ->where('hospital_id', $hospital->id)
            ->where('appointment_type', 'covid_test')
            ->with('patient')
            ->firstOrFail();

        $testResult = $appointment->testResult;

        return view('hospital.results.edit', compact('appointment', 'testResult'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'result' => 'required|in:positive,negative,pending',
            'doctor_notes' => 'nullable|string',
            'result_date' => 'required|date',
        ]);

        $hospital = auth()->user()->hospital;

        if (!$hospital) {
            abort(403, 'Hospital profile not found.');
        }

        $appointment = Appointment::where('id', $id)
            ->where('hospital_id', $hospital->id)
            ->firstOrFail();

        TestResult::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'patient_id' => $appointment->patient_id,
                'hospital_id' => $hospital->id,
                'result' => $validated['result'],
                'doctor_notes' => $validated['doctor_notes'],
                'result_date' => $validated['result_date'],
            ]
        );

        if ($validated['result'] != 'pending') {
            $appointment->update(['status' => 'completed']);
        }

        return redirect()->back()->with('success', 'Test result updated successfully!');
    }

    public function updateVaccination($id): RedirectResponse
    {
        $hospital = auth()->user()->hospital;

        if (!$hospital) {
            abort(403, 'Hospital profile not found.');
        }

        $validated = $this->validateVaccinationData();

        $appointment = Appointment::where('id', $id)
            ->where('hospital_id', $hospital->id)
            ->where('appointment_type', 'vaccination')
            ->firstOrFail();

        VaccinationRecord::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'patient_id' => $appointment->patient_id,
                'hospital_id' => $hospital->id,
                'vaccine_id' => $validated['vaccine_id'],
                'dose' => $validated['dose'],
                'vaccination_date' => $validated['vaccination_date'],
                'status' => 'completed',
            ]
        );

        $appointment->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Vaccination status updated!');
    }

    private function validateVaccinationData(): array
    {
        request()->validate([
            'vaccine_id' => 'required|exists:vaccines,id',
            'dose' => 'required|in:first,second,booster',
            'vaccination_date' => 'required|date',
        ]);

        return request()->only(['vaccine_id', 'dose', 'vaccination_date']);
    }
}
