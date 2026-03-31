<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hospital;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     * Supports both 'patient' and 'hospital' roles.
     * Hospital accounts are created with 'pending' status and require admin approval.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Base validation rules for all users
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:patient,hospital'],
        ];

        // Additional validation for hospital registrations
        if ($request->role === 'hospital') {
            $rules['hospital_name'] = ['required', 'string', 'max:255'];
            $rules['phone'] = ['required', 'string', 'max:20'];
            $rules['city'] = ['required', 'string', 'max:100'];
            $rules['address'] = ['required', 'string'];
        }

        $validated = $request->validate($rules);

        /**
         * Determine user_type and status based on role:
         * - Patient: user_type = 'patient', status = 'active'
         * - Hospital: user_type = 'hospital', status = 'pending' (needs admin approval)
         */
        $userType = $validated['role'];
        $status = ($userType === 'hospital') ? 'pending' : 'active';

        /**
         * Create the user account
         */
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type' => $userType,
            'status' => $status,
            'phone' => $request->phone ?? null,
            'address' => $request->address ?? null,
            'city' => $request->city ?? null,
        ]);

        /**
         * Assign the appropriate role using Spatie Permission
         */
        $user->assignRole($userType);

        /**
         * If registering as a hospital, also create a hospital profile
         */
        if ($userType === 'hospital') {
            Hospital::create([
                'user_id' => $user->id,
                'hospital_name' => $request->hospital_name,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'description' => null,
                'status' => 'pending', // Hospital needs admin approval
            ]);
        }

        /**
         * Fire Registered event and log the user in
         */
        event(new Registered($user));
        Auth::login($user);

        /**
         * Redirect based on role:
         * - Hospital: Show pending approval message
         * - Patient: Go to patient dashboard
         */
        if ($userType === 'hospital') {
            return redirect()->route('hospital.dashboard')
                ->with('info', 'Registration successful! Please wait for admin approval before you can access hospital features.');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
