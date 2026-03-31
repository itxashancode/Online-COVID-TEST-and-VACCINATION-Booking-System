<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use App\Jobs\SendAppointmentStatusChanged;

class HospitalAppointmentController extends Controller
{
    public function index(): View
    {
        $hospital = auth()->user()->hospital;

        if (!$hospital) {
            $appointments = collect();
            $pendingCount = $approvedCount = $completedCount = 0;
        } else {
            $appointments = $hospital->appointments()
                ->with('patient')
                ->latest()
                ->get();

            $pendingCount = $appointments->where('status', 'pending')->count();
            $approvedCount = $appointments->where('status', 'approved')->count();
            $completedCount = $appointments->where('status', 'completed')->count();
        }

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
        $hospital = auth()->user()->hospital;
        $appointment = Appointment::where('id', $id)
            ->where('hospital_id', $hospital->id)
            ->firstOrFail();
        $appointment->update(['status' => 'approved']);

        // Send email notification to patient
        SendAppointmentStatusChanged::dispatch($appointment, 'approved');

        return redirect()->back()->with('success', 'Appointment approved successfully!');
    }

    public function reject($id): RedirectResponse
    {
        $hospital = auth()->user()->hospital;
        $appointment = Appointment::where('id', $id)
            ->where('hospital_id', $hospital->id)
            ->firstOrFail();
        $appointment->update(['status' => 'rejected']);

        // Send email notification to patient
        SendAppointmentStatusChanged::dispatch($appointment, 'rejected');

        return redirect()->back()->with('success', 'Appointment rejected successfully!');
    }
}
