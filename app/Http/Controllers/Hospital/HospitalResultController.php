<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\TestResult;
use App\Models\VaccinationRecord;

class HospitalResultController extends Controller
{
    /**
     * Show the form to edit COVID-19 test result.
     * Hospital can update test results (positive/negative).
     *
     * @param  int  $id  Appointment ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * Get the logged-in hospital.
         * Find the appointment for this hospital where type is 'covid_test'.
         * Load existing test result if available.
         */
        // $hospital = auth()->user()->hospital;
        // $appointment = Appointment::where('id', $id)
        //     ->where('hospital_id', $hospital->id)
        //     ->where('appointment_type', 'covid_test')
        //     ->with('patient')
        //     ->firstOrFail();
        //
        // $testResult = $appointment->testResult;

        return view('hospital.results.edit', compact('appointment', 'testResult'));
    }

    /**
     * Update COVID-19 test result.
     * Save test result (positive/negative) and doctor notes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  Appointment ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Validate incoming data:
         * - result: required, in:positive,negative,pending
         * - doctor_notes: nullable, string
         * - result_date: required, date
         */
        $validated = $request->validate([
            'result' => 'required|in:positive,negative,pending',
            'doctor_notes' => 'nullable|string',
            'result_date' => 'required|date',
        ]);

        /**
         * Find the appointment for this hospital.
         * Create or update the test result record.
         */
        // $hospital = auth()->user()->hospital;
        // $appointment = Appointment::where('id', $id)
        //     ->where('hospital_id', $hospital->id)
        //     ->firstOrFail();
        //
        // // Create or update test result
        // $testResult = TestResult::updateOrCreate(
        //     ['appointment_id' => $appointment->id],
        //     [
        //         'patient_id' => $appointment->patient_id,
        //         'hospital_id' => $hospital->id,
        //         'result' => $validated['result'],
        //         'doctor_notes' => $validated['doctor_notes'],
        //         'result_date' => $validated['result_date'],
        //     ]
        // );
        //
        // // Update appointment status to 'completed' if test done
        // $appointment->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Test result updated successfully! (Demo)');
    }

    /**
     * Update vaccination status for a patient.
     * Hospital can mark vaccination as completed.
     *
     * @param  int  $id  Appointment ID
     * @return \Illuminate\Http\Response
     */
    public function updateVaccination($id)
    {
        /**
         * Find the vaccination appointment for this hospital.
         * Validate that appointment_type is 'vaccination'.
         * Create or update vaccination record with:
         * - vaccine_id (which vaccine was given)
         * - dose (first, second, booster)
         * - vaccination_date
         * - status (completed)
         */
        // $hospital = auth()->user()->hospital;
        // $appointment = Appointment::where('id', $id)
        //     ->where('hospital_id', $hospital->id)
        //     ->where('appointment_type', 'vaccination')
        //     ->firstOrFail();
        //
        // // Validate request data (vaccine_id, dose, date)
        // $validated = $request->validate([
        //     'vaccine_id' => 'required|exists:vaccines,id',
        //     'dose' => 'required|in:first,second,booster',
        //     'vaccination_date' => 'required|date',
        // ]);
        //
        // VaccinationRecord::updateOrCreate(
        //     ['appointment_id' => $appointment->id],
        //     [
        //         'patient_id' => $appointment->patient_id,
        //         'hospital_id' => $hospital->id,
        //         'vaccine_id' => $validated['vaccine_id'],
        //         'dose' => $validated['dose'],
        //         'vaccination_date' => $validated['vaccination_date'],
        //         'status' => 'completed',
        //     ]
        // );
        //
        // $appointment->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Vaccination status updated! (Demo)');
    }
}
