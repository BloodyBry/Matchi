<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SportsCenter;
use App\Models\Field;
use App\Models\Reservation;
use App\Models\Sport;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $centersCount = SportsCenter::count();
        $fieldsCount = Field::count();
        $reservationsCount = Reservation::count();
        $sportsCount = Sport::count();

        return view('admin.dashboard', compact(
            'usersCount',
            'centersCount',
            'fieldsCount',
            'reservationsCount',
            'sportsCount'
        ));
    }
}