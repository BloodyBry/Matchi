<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        if ($role === 'admin') {
            return view('dashboard.admin');
        }

        if ($role === 'manager') {
            return redirect()->route('manager.dashboard');
        }

        return view('dashboard.user');
    }
}