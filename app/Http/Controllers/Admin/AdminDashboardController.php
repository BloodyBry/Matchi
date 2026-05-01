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

        $activeUsers = User::where('status', 'active')->count();
        $pendingCenters = SportsCenter::where('status', 'pending')->count();
        $todayReservations = Reservation::where('reservation_date', now()->toDateString())->count();

        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentReservations = Reservation::with(['user', 'field'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'usersCount',
            'centersCount',
            'fieldsCount',
            'reservationsCount',
            'sportsCount',
            'activeUsers',
            'pendingCenters',
            'todayReservations',
            'recentUsers',
            'recentReservations'
        ));
    }
}