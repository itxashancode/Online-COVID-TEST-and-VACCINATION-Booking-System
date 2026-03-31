<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Vaccine;

class AdminVaccineController extends Controller
{
    /**
     * Display a listing of all vaccines.
     * Admin can view vaccine inventory and availability status.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Retrieve all vaccines from database.
         * Why latest()? Show newest entries first (vaccines added recently)
         * This helps admin see what was recently added to inventory
         */
        $vaccines = Vaccine::latest()->get();

        // Pass vaccine list to the view
        return view('admin.vaccines.index', compact('vaccines'));
    }

    /**
     * Show the form for creating a new vaccine.
     * Display form to add new vaccine to the system.
     *
     * @return View
     */
    public function create(): View
    {
        /**
         * Show create form view.
         * Form fields: vaccine_name, description, availability.
         */
        return view('admin.vaccines.create');
    }

    /**
     * Store a newly created vaccine in storage.
     * Validate input and save new vaccine record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /**
         * Validate request data:
         * - vaccine_name: required, string, max:255
         * - description: nullable, string
         * - availability: required, in:available,unavailable
         */
        $validated = $request->validate([
            'vaccine_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,unavailable',
        ]);

        /**
         * Create new vaccine record with validated data.
         */
        // Vaccine::create($validated);

        // Redirect back to index with success message
        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine created successfully!');
    }

    /**
     * Display the specified vaccine.
     * Show details of a single vaccine (optional feature).
     *
     * @param  string  $id  Vaccine ID
     * @return View
     */
    public function show(string $id): View
    {
        /**
         * Find vaccine by ID or fail.
         */
        $vaccine = Vaccine::findOrFail($id);

        return view('admin.vaccines.show', compact('vaccine'));
    }

    /**
     * Show the form for editing the specified vaccine.
     * Display edit form with current vaccine data.
     *
     * @param  string  $id  Vaccine ID
     * @return View
     */
    public function edit(string $id): View
    {
        /**
         * Find vaccine by ID.
         * Pass to edit view.
         */
        $vaccine = Vaccine::findOrFail($id);

        return view('admin.vaccines.edit', compact('vaccine'));
    }

    /**
     * Update the specified vaccine in storage.
     * Validate and update vaccine information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id  Vaccine ID
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        /**
         * Validate request data (same as store).
         */
        $validated = $request->validate([
            'vaccine_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,unavailable',
        ]);

        /**
         * Find vaccine and update with new data.
         */
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->update($validated);

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine updated successfully!');
    }

    /**
     * Remove the specified vaccine from storage.
     * Delete a vaccine record (use with caution).
     *
     * @param  string  $id  Vaccine ID
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        /**
         * Find vaccine and delete it.
         * Consider soft deletes for production.
         */
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->delete();

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine deleted successfully!');
    }
}
