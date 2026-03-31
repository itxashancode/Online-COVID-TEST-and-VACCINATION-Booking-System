<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Vaccine;

class AdminVaccineController extends Controller
{
    public function index(): View
    {
        $vaccines = Vaccine::latest()->get();
        return view('admin.vaccines.index', compact('vaccines'));
    }

    public function create(): View
    {
        return view('admin.vaccines.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vaccine_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,unavailable',
        ]);

        Vaccine::create($validated);

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine created successfully!');
    }

    public function show(string $id): View
    {
        $vaccine = Vaccine::findOrFail($id);
        return view('admin.vaccines.show', compact('vaccine'));
    }

    public function edit(string $id): View
    {
        $vaccine = Vaccine::findOrFail($id);
        return view('admin.vaccines.edit', compact('vaccine'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'vaccine_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,unavailable',
        ]);

        $vaccine = Vaccine::findOrFail($id);
        $vaccine->update($validated);

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine updated successfully!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->delete();

        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine deleted successfully!');
    }
}
