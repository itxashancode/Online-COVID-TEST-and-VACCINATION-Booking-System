<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::with(['patient', 'hospital'])->latest()->get();
        return view('admin.bookings.index', compact('appointments'));
    }

    public function destroy($id): RedirectResponse
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully!');
    }
}
