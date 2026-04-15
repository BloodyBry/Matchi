<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportsCenter;

class SportsCenterController extends Controller
{
    public function index()
    {
        $centers = SportsCenter::with('manager')->latest()->get();

        return view('admin.centers.index', compact('centers'));
    }

    public function updateStatus($id)
    {
        $center = SportsCenter::findOrFail($id);

        $nextStatus = match ($center->status) {
            'pending' => 'approved',
            'approved' => 'rejected',
            'rejected' => 'approved',
            default => 'approved',
        };

        $center->update([
            'status' => $nextStatus
        ]);

        return back()->with('success', 'Statut du centre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $center = SportsCenter::findOrFail($id);
        $center->delete();

        return back()->with('success', 'Centre supprimé avec succès.');
    }
}