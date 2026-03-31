<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;

class PatientSearchController extends Controller
{
    /**
     * Search for COVID-19/Vaccination hospitals.
     * Patients can search hospitals by name or city.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * Get search parameters from request:
         * - hospital_name: optional, search by hospital name
         * - city: optional, search by city
         * - status: default to 'approved' hospitals only
         *
         * Build query based on filters:
         * 1. Only approved hospitals (status = 'approved')
         * 2. Filter by name if provided
         * 3. Filter by city if provided
         * 4. Order by name
         */
        // $query = Hospital::where('status', 'approved')->with('user');
        //
        // if ($request->has('hospital_name') && $request->hospital_name) {
        //     $query->where('hospital_name', 'like', '%' . $request->hospital_name . '%');
        // }
        //
        // if ($request->has('city') && $request->city) {
        //     $query->where('city', 'like', '%' . $request->city . '%');
        // }
        //
        // $hospitals = $query->orderBy('hospital_name', 'asc')->paginate(10);

        /**
         * Pass search parameters to view to maintain form values.
         */
        $hospital_name = $request->input('hospital_name');
        $city = $request->input('city');

        return view('patient.search.index', compact('hospital_name', 'city'));
    }
}
