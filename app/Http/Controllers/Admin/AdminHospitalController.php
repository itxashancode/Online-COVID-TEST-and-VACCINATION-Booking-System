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
         * Eager load 'user' relationship to avoid N+1 queries.
         */
        // $hospitals = Hospital::with('user')->get();

        return view('admin.hospitals.index');
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
