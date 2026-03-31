<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaccine;

class AdminVaccineController extends Controller
{
    /**
     * Display a listing of all vaccines.
     * Admin can view vaccine inventory and availability status.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Retrieve all vaccines from database.
         * Order by most recent first.
         */
        // $vaccines = Vaccine::latest()->get();

        return view('admin.vaccines.index');
    }

    /**
     * Show the form for creating a new vaccine.
     * Display form to add new vaccine to the system.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        /**
         * Find vaccine by ID or fail.
         */
        // $vaccine = Vaccine::findOrFail($id);

        return view('admin.vaccines.show', compact('vaccine'));
    }

    /**
     * Show the form for editing the specified vaccine.
     * Display edit form with current vaccine data.
     *
     * @param  string  $id  Vaccine ID
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        /**
         * Find vaccine by ID.
         * Pass to edit view.
         */
        // $vaccine = Vaccine::findOrFail($id);

        return view('admin.vaccines.edit', compact('vaccine'));
    }

    /**
     * Update the specified vaccine in storage.
     * Validate and update vaccine information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id  Vaccine ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
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
        // $vaccine = Vaccine::findOrFail($id);
        // $vaccine->update($validated);

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine updated successfully!');
    }

    /**
     * Remove the specified vaccine from storage.
     * Delete a vaccine record (use with caution).
     *
     * @param  string  $id  Vaccine ID
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        /**
         * Find vaccine and delete it.
         * Consider soft deletes for production.
         */
        // $vaccine = Vaccine::findOrFail($id);
        // $vaccine->delete();

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine deleted successfully!');
    }
}
