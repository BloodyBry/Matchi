<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Field;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'manager') {
            return redirect()->route('manager.dashboard');
        }

        $userId = session('user_id');

        $totalReservations = Reservation::where('user_id', $userId)->count();
        $upcomingReservations = Reservation::where('user_id', $userId)
            ->where('reservation_date', '>=', now()->toDateString())
            ->where('status', '!=', 'cancelled')
            ->orderBy('reservation_date')
            ->orderBy('start_time')
            ->take(5)
            ->get();
        $completedReservations = Reservation::where('user_id', $userId)
            ->where('reservation_date', '<', now()->toDateString())
            ->count();
        $cancelledReservations = Reservation::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->count();
        $recentReservations = Reservation::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.user', compact(
            'totalReservations',
            'upcomingReservations',
            'completedReservations',
            'cancelledReservations',
            'recentReservations'
        ));
    }
}