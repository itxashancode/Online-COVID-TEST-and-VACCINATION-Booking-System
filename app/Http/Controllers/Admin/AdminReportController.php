<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use App\Exports\AppointmentsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::with(['patient', 'hospital', 'testResult'])
            ->where('appointment_type', 'covid_test')
            ->latest()
            ->get();

        return view('admin.reports.index', compact('appointments'));
    }

    public function export(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|in:date,week,month',
            'specific_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $query = Appointment::with(['patient', 'hospital', 'testResult']);

        if ($validated['period'] == 'date') {
            $query->whereDate('appointment_date', $validated['specific_date']);
        } elseif ($validated['period'] == 'week') {
            $query->whereBetween('appointment_date', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($validated['period'] == 'month') {
            $query->whereMonth('appointment_date', now()->month);
        }

        $appointments = $query->get();

        if ($appointments->isEmpty()) {
            return redirect()->back()->with('error', 'No data found for the selected period.');
        }

        return Excel::download(new AppointmentsExport($appointments), 'covid_appointments_' . now()->format('Y_m_d') . '.xlsx');
    }
}
