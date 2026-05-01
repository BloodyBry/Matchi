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

        $todayReservations = Reservation::whereHas('field.center', function ($query) use ($managerId) {
            $query->where('manager_id', $managerId);
        })->where('reservation_date', now()->toDateString())->count();

        $upcomingReservations = Reservation::whereHas('field.center', function ($query) use ($managerId) {
            $query->where('manager_id', $managerId);
        })
            ->where('reservation_date', '>=', now()->toDateString())
            ->where('status', '!=', 'cancelled')
            ->orderBy('reservation_date')
            ->orderBy('start_time')
            ->take(5)
            ->get();

        $recentReservations = Reservation::with(['user', 'field'])
            ->whereHas('field.center', function ($query) use ($managerId) {
                $query->where('manager_id', $managerId);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $centers = SportsCenter::where('manager_id', $managerId)
            ->withCount('fields')
            ->take(5)
            ->get();

        return view('manager.dashboard', compact(
            'centersCount',
            'fieldsCount',
            'reservationsCount',
            'todayReservations',
            'upcomingReservations',
            'recentReservations',
            'centers'
        ));
    }
}