<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;

class PatientProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('patient.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = auth()->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->city = $validated['city'];

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

    public function destroy(): RedirectResponse
    {
        return redirect()->route('login')->with('success', 'Account deleted successfully! (Demo)');
    }
}
