<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Hospital;

class PatientSearchController extends Controller
{
    /**
     * Search for COVID-19/Vaccination hospitals.
     * Patients can search hospitals by name or city.
     * Requirement: Only show hospitals where status = 'approved' (README Section 11)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        /**
         * Build query starting point:
         * 1. Only approved hospitals (status = 'approved') - Why? Patients shouldn't see pending/rejected hospitals
         * 2. Eager load 'user' relationship to show hospital contact info
         */
        $query = Hospital::where('status', 'approved')->with('user');

        /**
         * Apply filters based on search form input:
         * - hospital_name: partial match (SQL LIKE %value%)
         * - city: partial match
         * Both are optional, so only add if user provided
         */
        if ($request->has('hospital_name') && $request->hospital_name) {
            // Why use like with % wildcards? Allows searching "city" to match "City Hospital"
            $query->where('hospital_name', 'like', '%' . $request->hospital_name . '%');
        }

        if ($request->has('city') && $request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        /**
         * Finalize query:
         * - Order alphabetically by hospital name for easy browsing
         * - Paginate 10 results per page (prevents long page)
         */
        $hospitals = $query->orderBy('hospital_name', 'asc')->paginate(10);

        /**
         * Get the search parameters to pre-fill the search form
         * So user doesn't have to re-type after results show
         */
        $hospital_name = $request->input('hospital_name');
        $city = $request->input('city');

        // Pass hospitals list and search parameters to the view
        return view('patient.search.index', compact('hospitals', 'hospital_name', 'city'));
    }
}
