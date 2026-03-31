<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;

class HospitalAppointmentController extends Controller
{
    /**
     * Display all appointment requests for the logged-in hospital.
     * Shows pending, approved, rejected, and completed appointments.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Get the authenticated hospital's profile.
         * Why? To ensure hospitals only see their own appointments (data isolation)
         */
        $hospital = auth()->user()->hospital;

        // If hospital doesn't exist (edge case), show empty data
        if (!$hospital) {
            $appointments = collect();
            $pendingCount = $approvedCount = $completedCount = 0;
        } else {
            /**
             * Fetch all appointments for this hospital with patient details.
             * Why eager load 'patient'? To display patient name/email without N+1 queries
             */
            $appointments = $hospital->appointments()
                ->with('patient')
                ->latest()  // Most recent first
                ->get();

            /**
             * Calculate counts for status badges
             */
            $pendingCount = $appointments->where('status', 'pending')->count();
            $approvedCount = $appointments->where('status', 'approved')->count();
            $completedCount = $appointments->where('status', 'completed')->count();
        }

        // Pass data to view
        return view('hospital.appointments.index', compact(
            'appointments',
            'pendingCount',
            'approvedCount',
            'completedCount'
        ));
    }

    /**
     * Approve a patient appointment request.
     * Hospital can approve COVID test or vaccination appointments.
     *
     * @param  int  $id  Appointment ID
     * @return RedirectResponse
     */
    public function approve($id): RedirectResponse
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
     * @return RedirectResponse
     */
    public function reject($id): RedirectResponse
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
