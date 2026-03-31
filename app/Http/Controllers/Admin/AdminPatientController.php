<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPatientController extends Controller
{
    /**
     * Display a listing of all registered patients.
     * Admin can view all patient profiles and their details.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Query all users with 'patient' role using Spatie Permission.
         * This retrieves all registered patients in the system.
         * Later we'll add search and pagination.
         */
        // $patients = User::role('patient')->get();

        /**
         * For now, return empty view - database will be populated later.
         * View: admin/patients/index.blade.php
         */
        return view('admin.patients.index');
    }
}
