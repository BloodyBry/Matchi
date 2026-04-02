<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'field_id'          => 'required|exists:fields,id',
            'reservation_date'  => 'required|date',
            'start_time'        => 'required',
            'end_time'          => 'required|after:start_time',
            'notes'             => 'nullable|string',
        ]);

        $field = Field::findOrFail($request->field_id);

        $conflict = Reservation::where('field_id', $request->field_id)
            ->where('reservation_date', $request->reservation_date)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
                });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'reservation' => 'Ce créneau est déjà réservé.'
            ])->withInput();
        }

        $start = strtotime($request->start_time);
        $end   = strtotime($request->end_time);
        $hours = ($end - $start) / 3600;
        $totalPrice = $hours * $field->price_per_hour;

        Reservation::create([
            'user_id'           => session('user_id'),
            'field_id'          => $request->field_id,
            'reservation_date'  => $request->reservation_date,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
            'total_price'       => $totalPrice,
            'status'            => 'confirmed',
            'notes'             => $request->notes,
        ]);

        return redirect('/my-reservations')->with('success', 'Réservation créée avec succès.');
    }

    public function myReservations()
    {
        $reservations = Reservation::with('field.center', 'field.sport')
            ->where('user_id', session('user_id'))
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $reservation->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Réservation annulée.');
    }
}