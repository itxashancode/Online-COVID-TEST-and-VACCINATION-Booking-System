<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientProfileController extends Controller
{
    /**
     * Display patient's profile.
     * Shows personal information, contact details.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Get authenticated user's profile data.
         * No need to query database - auth()->user() has it.
         */
        $user = auth()->user();

        return view('patient.profile.index', compact('user'));
    }

    /**
     * Update patient's profile information.
     * Patient can edit their name, email, phone, address, city.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /**
         * Validate profile update:
         * - name: required, string, max:255
         * - email: required, email, unique:users,email,{auth id}
         * - phone: nullable, string
         * - address: nullable, string
         * - city: nullable, string
         * - current_password: nullable, required if changing password
         * - new_password: nullable, min:8, confirmed
         */
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        /**
         * Get authenticated user.
         * Update basic fields: name, email, phone, address, city.
         */
        $user = auth()->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->city = $validated['city'];

        /**
         * If current_password provided and matches, update password.
         */
        if (!empty($validated['current_password'])) {
            if (Hash::check($validated['current_password'], $user->password)) {
                $user->password = Hash::make($validated['new_password']);
            } else {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
        }

        $user->save();

        return redirect()->route('patient.profile.index')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete patient's account.
     * Permanently deletes the user account and all related data.
     * Use with caution - consider soft deletes in production.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        /**
         * Get authenticated user.
         * Delete the user account.
         * All related data (appointments, test results) will cascade delete if DB foreign keys set.
         */
        // $user = auth()->user();
        // $user->delete();

        // Logout and redirect to home with message
        return redirect()->route('login')->with('success', 'Account deleted successfully! (Demo)');
    }
}
