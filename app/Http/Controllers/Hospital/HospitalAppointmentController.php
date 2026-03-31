<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class HospitalAppointmentController extends Controller
{
    /**
     * Display all appointment requests for the logged-in hospital.
     * Shows pending, approved, rejected, and completed appointments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Get the authenticated hospital's ID.
         * Fetch all appointments for this hospital.
         * Include patient details using eager loading.
         */
        // $hospital = auth()->user()->hospital;
        // $appointments = $hospital->appointments()->with('patient')->latest()->get();

        return view('hospital.appointments.index');
    }

    /**
     * Approve a patient appointment request.
     * Hospital can approve COVID test or vaccination appointments.
     *
     * @param  int  $id  Appointment ID
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        /**
         * Find the appointment that belongs to this hospital.
         * Update status to 'approved'.
         */
        // $hospital = auth()->user()->hospital;
        // $appointment = Appointment::where('id', $id)
        //     ->where('hospital_id', $hospital->id)
        //     ->firstOrFail();
        // $appointment->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Appointment approved! (Demo)');
    }

    /**
     * Reject a patient appointment request.
     * Hospital can decline appointment requests.
     *
     * @param  int  $id  Appointment ID
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        /**
         * Find appointment belonging to this hospital.
         * Update status to 'rejected'.
         */
        // $hospital = auth()->user()->hospital;
        // $appointment = Appointment::where('id', $id)
        //     ->where('hospital_id', $hospital->id)
        //     ->firstOrFail();
        // $appointment->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Appointment rejected! (Demo)');
    }
}
