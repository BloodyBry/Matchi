<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Sport;
use App\Models\SportsCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::with(['center', 'sport'])
            ->whereHas('center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->latest()
            ->get();

        return view('manager.fields.index', compact('fields'));
    }

    public function create()
    {
        $managerId = session('user_id');

        $centers = SportsCenter::where('manager_id', $managerId)->get();
        $sports = Sport::all();

        return view('manager.fields.create', compact('centers', 'sports'));
    }

    public function store(Request $request)
    {
        $managerId = session('user_id');

        $request->validate([
            'center_id' => 'required|exists:sports_centers,id',
            'sport_id' => 'required|exists:sports,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric|min:0',
            'capacity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:available,maintenance,unavailable',
        ]);

        $center = SportsCenter::where('id', $request->center_id)
            ->where('manager_id', $managerId)
            ->firstOrFail();

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fields', 'public');
        }

        Field::create([
            'center_id' => $center->id,
            'sport_id' => $request->sport_id,
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'capacity' => $request->capacity,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('manager.fields.index')
            ->with('success', 'Terrain ajouté avec succès.');
    }

    public function edit($id)
    {
        $field = Field::whereHas('center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->findOrFail($id);

        $centers = SportsCenter::where('manager_id', session('user_id'))->get();
        $sports = Sport::all();

        return view('manager.fields.edit', compact('field', 'centers', 'sports'));
    }

    public function update(Request $request, $id)
    {
        $field = Field::whereHas('center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->findOrFail($id);

        $request->validate([
            'center_id' => 'required|exists:sports_centers,id',
            'sport_id' => 'required|exists:sports,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric|min:0',
            'capacity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:available,maintenance,unavailable',
        ]);

        $center = SportsCenter::where('id', $request->center_id)
            ->where('manager_id', session('user_id'))
            ->firstOrFail();

        $imagePath = $field->image;

        if ($request->hasFile('image')) {
            if ($field->image) {
                Storage::disk('public')->delete($field->image);
            }

            $imagePath = $request->file('image')->store('fields', 'public');
        }

        $field->update([
            'center_id' => $center->id,
            'sport_id' => $request->sport_id,
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'capacity' => $request->capacity,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('manager.fields.index')
            ->with('success', 'Terrain mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $field = Field::whereHas('center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->findOrFail($id);

        if ($field->image) {
            Storage::disk('public')->delete($field->image);
        }

        $field->delete();

        return redirect()
            ->route('manager.fields.index')
            ->with('success', 'Terrain supprimé avec succès.');
    }
}