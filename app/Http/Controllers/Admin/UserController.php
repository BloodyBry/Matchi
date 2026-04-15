<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function updateStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->withErrors(['user' => 'Impossible de modifier le statut d’un administrateur.']);
        }

        $newStatus = $user->status === 'active' ? 'blocked' : 'active';

        $user->update([
            'status' => $newStatus
        ]);

        return back()->with('success', 'Statut utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->withErrors(['user' => 'Impossible de supprimer un administrateur.']);
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}