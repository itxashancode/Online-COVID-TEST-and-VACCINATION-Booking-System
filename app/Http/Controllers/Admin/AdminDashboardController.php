<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     * Shows overview statistics and navigation for admin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Admin Dashboard View
         * Displays key metrics and links to all admin features:
         * - Total patients count
         * - Total hospitals count (pending/approved/rejected)
         * - Total bookings
         * - Recent activity
         */
        return view('admin.dashboard');
    }
}
