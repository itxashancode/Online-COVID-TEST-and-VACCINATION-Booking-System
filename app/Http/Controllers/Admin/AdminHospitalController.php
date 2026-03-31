<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Hospital;

class AdminHospitalController extends Controller
{
    public function index(): View
    {
        $hospitals = Hospital::with('user')->get();

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

        return redirect()->back()->with('success', 'Hospital approved successfully!');
    }

    public function reject($id): RedirectResponse
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update(['status' => 'rejected']);

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
