<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalPatientController extends Controller
{
    /**
     * Display a list of patients with approved appointments.
     * Hospital can view patients who have approved COVID-19 test/vaccination appointments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Get the logged-in hospital's profile.
         * Retrieve patients who have approved appointments.
         * We join appointments with users where status is 'approved'.
         *
         * Later add search by name, phone, etc.
         */
        // $hospital = auth()->user()->hospital;
        // $patients = User::role('patient')
        //     ->whereHas('appointments', function($query) use ($hospital) {
        //         $query->where('hospital_id', $hospital->id)
        //               ->where('status', 'approved');
        //     })
        //     ->get();

        return view('hospital.patients.index');
    }
}
