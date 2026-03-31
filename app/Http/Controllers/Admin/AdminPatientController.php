<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AdminPatientController extends Controller
{
    public function index(): View
    {
        $patients = User::role('patient')->latest()->get();
        return view('admin.patients.index', compact('patients'));
    }

    public function show($id): View
    {
        $patient = User::role('patient')
            ->with(['appointments.hospital', 'appointments.testResult', 'appointments.vaccinationRecord.vaccine'])
            ->findOrFail($id);

        return view('admin.patients.show', compact('patient'));
    }
}
