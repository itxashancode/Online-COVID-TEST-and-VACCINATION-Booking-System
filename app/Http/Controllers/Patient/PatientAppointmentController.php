<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Hospital;
use App\Models\Appointment;

class PatientAppointmentController extends Controller
{
    /**
     * Show the form to create a new appointment.
     * Patient can select hospital and appointment type (covid test or vaccination).
     *
     * @param  \Illuminate\Http\Request  $request  Contains hospital_id (optional)
     * @return View
     */
    public function create(Request $request): View
    {
        /**
         * If hospital_id is provided via query parameter (e.g., from search page),
         * pre-select that hospital. Only show if hospital is approved.
         */
        $hospital = null;
        if ($request->has('hospital_id')) {
            $hospital = Hospital::where('id', $request->hospital_id)
                ->where('status', 'approved')
                ->first();
        }

        // If no specific hospital, get all approved hospitals for dropdown selection
        $hospitals = Hospital::where('status', 'approved')
            ->orderBy('hospital_name', 'asc')
            ->get();

        // Pass data to view: $hospital (pre-selected, may be null) and $hospitals (list for dropdown)
        return view('patient.appointments.create', compact('hospital', 'hospitals'));
    }

    /**
     * Store a newly created appointment in storage.
     * Patient submits booking request for COVID test or vaccination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /**
         * Validate appointment data:
         * - hospital_id: required, exists:hospitals,id
         * - appointment_type: required, in:covid_test,vaccination
         * - appointment_date: required, date
         * - appointment_time: nullable, time_format
         * - notes: nullable, string
         */
        $validated = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'appointment_type' => 'required|in:covid_test,vaccination',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'nullable',
            'notes' => 'nullable|string',
        ]);

        /**
         * Create appointment for the authenticated patient.
         * Default status is 'pending' - needs hospital approval.
         */
        Appointment::create([
            'patient_id' => auth()->id(),
            'hospital_id' => $validated['hospital_id'],
            'appointment_type' => $validated['appointment_type'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('patient.appointments.index')
            ->with('success', 'Appointment request sent successfully!');
    }

    /**
     * Display all appointments for the logged-in patient.
     * Shows pending, approved, rejected, and completed appointments.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Get all appointments for the authenticated user.
         * Why eager load 'hospital'? To show hospital name without N+1 queries
         * Why latest()? Show most recent appointments first (booked recently)
         */
        $appointments = auth()->user()->appointments()
            ->with('hospital')
            ->latest()
            ->get();

        // Pass appointments to the view
        return view('patient.appointments.index', compact('appointments'));
    }
}
