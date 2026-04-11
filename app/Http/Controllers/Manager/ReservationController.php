<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'field.center', 'field.sport'])
            ->whereHas('field.center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->latest()
            ->get();

        return view('manager.reservations.index', compact('reservations'));
    }
}