<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Hospital;
use App\Jobs\SendHospitalStatusChanged;

class AdminHospitalController extends Controller
{
    public function index(Request $request): View
    {
        $query = Hospital::with('user');

        // Search by hospital name
        if ($request->has('search') && $search = $request->search) {
            $query->where('hospital_name', 'like', "%{$search}%");
        }

        $hospitals = $query->latest()->paginate(10);

        // Calculate counts from the paginated results
        $approvedCount = $hospitals->where('status', 'approved')->count();
        $pendingCount = $hospitals->where('status', 'pending')->count();
        $rejectedCount = $hospitals->where('status', 'rejected')->count();

        return view('admin.hospitals.index', compact(
            'hospitals',
            'approvedCount',
            'pendingCount',
            'rejectedCount'
        ));
    }

    public function approve($id): RedirectResponse
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update(['status' => 'approved']);

        // Send email notification asynchronously
        SendHospitalStatusChanged::dispatch($hospital, 'approved');

        return redirect()->back()->with('success', 'Hospital approved successfully!');
    }

    public function reject($id): RedirectResponse
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update(['status' => 'rejected']);

        // Send email notification asynchronously
        SendHospitalStatusChanged::dispatch($hospital, 'rejected');

        return redirect()->back()->with('success', 'Hospital rejected successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        $hospital = Hospital::findOrFail($id);
        $user = $hospital->user;
        
        $hospital->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->back()->with('success', 'Hospital and associated account deleted successfully!');
    }
}
