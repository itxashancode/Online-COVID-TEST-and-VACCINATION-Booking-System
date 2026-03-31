<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Hospital;

class HospitalPatientController extends Controller
{
    /**
     * Display a list of patients with approved appointments.
     * Hospital can view patients who have approved COVID-19 test/vaccination appointments.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Get the logged-in hospital's profile.
         * Why? To filter patients by this specific hospital's approved appointments
         */
        $hospital = auth()->user()->hospital;

        // Handle case where hospital profile doesn't exist (edge case)
        if (!$hospital) {
            $patients = collect();
        } else {
            /**
             * Query all patients (users with 'patient' role) who have
             * at least one approved appointment at this hospital.
             *
             * Why whereHas? Filters patients based on their related appointments
             * This returns only patients, not appointments themselves
             */
            $patients = User::role('patient')
                ->whereHas('appointments', function($query) use ($hospital) {
                    $query->where('hospital_id', $hospital->id)
                          ->where('status', 'approved');
                })
                ->get();
        }

        // Pass patients to the view
        return view('hospital.patients.index', compact('patients'));
    }
}
