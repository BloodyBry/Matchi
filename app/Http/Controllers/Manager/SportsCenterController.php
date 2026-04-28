<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\SportsCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SportsCenterController extends Controller
{
    public function index()
    {
        $managerId = session('user_id');

        $centers = SportsCenter::where('manager_id', $managerId)
            ->latest()
            ->get();

        return view('manager.center.index', compact('centers'));
    }

    public function create()
    {
        return view('manager.center.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('centers', 'public');
        }

        SportsCenter::create([
            'manager_id' => session('user_id'),
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'description' => $request->description,
            'phone' => $request->phone,
            'image' => $imagePath,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'status' => 'approved',
        ]);

        return redirect()
            ->route('manager.center.index')
            ->with('success', 'Centre sportif créé avec succès.');
    }

    public function edit($id)
    {
        $center = SportsCenter::where('id', $id)
            ->where('manager_id', session('user_id'))
            ->firstOrFail();

        return view('manager.center.edit', compact('center'));
    }

    public function update(Request $request, $id)
    {
        $center = SportsCenter::where('id', $id)
            ->where('manager_id', session('user_id'))
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
        ]);

        $imagePath = $center->image;

        if ($request->hasFile('image')) {
            if ($center->image) {
                Storage::disk('public')->delete($center->image);
            }

            $imagePath = $request->file('image')->store('centers', 'public');
        }

        $center->update([
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'description' => $request->description,
            'phone' => $request->phone,
            'image' => $imagePath,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]);

        return redirect()
            ->route('manager.center.index')
            ->with('success', 'Centre sportif mis à jour avec succès.');
    }
}