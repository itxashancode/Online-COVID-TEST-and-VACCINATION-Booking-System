<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Appointment::with(['patient', 'hospital']);

        // Search by patient name or hospital name
        if ($request->has('search') && $search = $request->search) {
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('hospital', function($q) use ($search) {
                $q->where('hospital_name', 'like', "%{$search}%");
            });
        }

        $appointments = $query->latest()->paginate(10);

        return view('admin.bookings.index', compact('appointments'));
    }

    public function destroy($id): RedirectResponse
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully!');
    }
}
