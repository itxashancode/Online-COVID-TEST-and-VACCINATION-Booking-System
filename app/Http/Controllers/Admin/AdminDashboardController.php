<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Models\TestResult;
use App\Models\Vaccine;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalPatients = User::role('patient')->count();
        $approvedHospitals = Hospital::where('status', 'approved')->count();
        $pendingHospitals = Hospital::where('status', 'pending')->count();
        $totalHospitals = Hospital::count();
        $totalAppointments = Appointment::count();
        $positiveTests = TestResult::where('result', 'positive')->count();
        $vaccineCount = Vaccine::count();

        return view('admin.dashboard', compact(
            'totalPatients',
            'approvedHospitals',
            'pendingHospitals',
            'totalHospitals',
            'totalAppointments',
            'positiveTests',
            'vaccineCount'
        ));
    }
}
