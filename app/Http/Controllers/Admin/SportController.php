<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::latest()->get();

        return view('admin.sports.index', compact('sports'));
    }

    public function create()
    {
        return view('admin.sports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sports,name',
            'description' => 'nullable|string',
        ]);

        Sport::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.sports.index')->with('success', 'Sport ajouté avec succès.');
    }

    public function edit($id)
    {
        $sport = Sport::findOrFail($id);

        return view('admin.sports.edit', compact('sport'));
    }

    public function update(Request $request, $id)
    {
        $sport = Sport::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:sports,name,' . $sport->id,
            'description' => 'nullable|string',
        ]);

        $sport->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.sports.index')->with('success', 'Sport mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $sport = Sport::findOrFail($id);
        $sport->delete();

        return back()->with('success', 'Sport supprimé avec succès.');
    }
}