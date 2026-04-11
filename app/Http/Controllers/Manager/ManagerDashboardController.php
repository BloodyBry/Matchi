<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Reservation;
use App\Models\SportsCenter;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $managerId = session('user_id');

        $centersCount = SportsCenter::where('manager_id', $managerId)->count();

        $fieldsCount = Field::whereHas('center', function ($query) use ($managerId) {
            $query->where('manager_id', $managerId);
        })->count();

        $reservationsCount = Reservation::whereHas('field.center', function ($query) use ($managerId) {
            $query->where('manager_id', $managerId);
        })->count();

        return view('manager.dashboard', compact('centersCount', 'fieldsCount', 'reservationsCount'));
    }
}