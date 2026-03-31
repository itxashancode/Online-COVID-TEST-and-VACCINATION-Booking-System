<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;

class AdminHospitalController extends Controller
{
    /**
     * Display a listing of all hospitals.
     * Admin can see all registered hospitals and their status.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Retrieve all hospitals with their related user data.
         * Why eager load 'user'? Because in the view we'll show hospital's contact person
         * This avoids the N+1 problem (one query for all hospitals instead of one per hospital)
         */
        $hospitals = Hospital::with('user')->get();

        /**
         * Calculate counts by status for the header badges
         * Using collection's where() method on the already-fetched hospitals
         */
        $approvedCount = $hospitals->where('status', 'approved')->count();
        $pendingCount = $hospitals->where('status', 'pending')->count();
        $rejectedCount = $hospitals->where('status', 'rejected')->count();

        // Pass all data to the view
        return view('admin.hospitals.index', compact(
            'hospitals',
            'approvedCount',
            'pendingCount',
            'rejectedCount'
        ));
    }

    /**
     * Approve a hospital registration.
     * Admin can approve pending hospital requests.
     *
     * @param  int  $id  Hospital ID
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        /**
         * Find the hospital by ID.
         * Update status to 'approved'.
         * Redirect back with success message.
         */
        // $hospital = Hospital::findOrFail($id);
        // $hospital->update(['status' => 'approved']);
        // return redirect()->back()->with('success', 'Hospital approved successfully!');

        return redirect()->back()->with('success', 'Hospital approved! (Demo)');
    }

    /**
     * Reject a hospital registration.
     * Admin can reject pending hospital requests.
     *
     * @param  int  $id  Hospital ID
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        /**
         * Find the hospital by ID.
         * Update status to 'rejected'.
         * Redirect back with success message.
         */
        // $hospital = Hospital::findOrFail($id);
        // $hospital->update(['status' => 'rejected']);
        // return redirect()->back()->with('success', 'Hospital rejected successfully!');

        return redirect()->back()->with('success', 'Hospital rejected! (Demo)');
    }
}
