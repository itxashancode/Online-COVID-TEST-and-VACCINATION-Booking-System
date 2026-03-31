<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Hospital;

class HospitalDashboardController extends Controller
{
    public function index(): View
    {
        $hospital = auth()->user()->hospital;

        if (!$hospital) {
            $pendingCount = $approvedCount = $completedCount = $recentAppointments = 0;
        } else {
            $pendingCount = $hospital->appointments()->where('status', 'pending')->count();
            $approvedCount = $hospital->appointments()->where('status', 'approved')->count();
            $completedCount = $hospital->appointments()->where('status', 'completed')->count();

            $recentAppointments = $hospital->appointments()
                ->with('patient')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('hospital.dashboard', compact(
            'pendingCount',
            'approvedCount',
            'completedCount',
            'recentAppointments'
        ));
    }
}
