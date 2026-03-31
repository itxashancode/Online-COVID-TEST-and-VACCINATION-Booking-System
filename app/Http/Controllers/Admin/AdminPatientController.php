<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AdminPatientController extends Controller
{
    /**
     * Display a listing of all registered patients.
     * Admin can view all patient profiles and their details.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Query all users with 'patient' role using Spatie Permission.
         * Why role('patient')? Filters users to only those with patient role
         * This uses Spatie's role scope which is efficient and clear
         */
        $patients = User::role('patient')->get();

        /**
         * We could add pagination later if many patients:
         * $patients = User::role('patient')->paginate(20);
         * For now, get all since it's a smaller project
         */

        // Pass the patient list to the view for display in a table
        return view('admin.patients.index', compact('patients'));
    }
}
