<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;

class PatientAppointmentController extends Controller
{
    public function create(Request $request): View
    {
        $hospital = null;
        if ($request->has('hospital_id')) {
            $hospital = Hospital::where('id', $request->hospital_id)
                ->where('status', 'approved')
                ->first();
        }

        $hospitals = Hospital::where('status', 'approved')
            ->orderBy('hospital_name', 'asc')
            ->get();

        return view('patient.appointments.create', compact('hospital', 'hospitals'));
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

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

    public function index(): View
    {
        $appointments = auth()->user()->appointments()
            ->with('hospital')
            ->latest()
            ->get();

        return view('patient.appointments.index', compact('appointments'));
    }
}
