<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AdminPatientController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::role('patient');

        // Search by patient name or email
        if ($request->has('search') && $search = $request->search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $patients = $query->latest()->paginate(10);

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
