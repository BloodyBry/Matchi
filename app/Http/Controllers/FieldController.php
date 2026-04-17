<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Reservation;
use App\Models\Sport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        $query = Field::with(['center', 'sport']);

        if ($request->filled('sport_id')) {
            $query->where('sport_id', $request->sport_id);
        }

        if ($request->filled('city')) {
            $query->whereHas('center', function ($q) use ($request) {
                $q->where('city', 'like', '%' . $request->city . '%');
            });
        }

        $fields = $query->latest()->get();
        $sports = Sport::all();

        return view('fields.index', compact('fields', 'sports'));
    }

    public function show($id)
    {
        $field = Field::with(['center', 'sport', 'schedules', 'reviews.user'])->findOrFail($id);

        return view('fields.show', compact('field'));
    }

    public function availableSlots(Request $request, $id)
    {
        $request->validate([
            'reservation_date' => 'required|date',
        ]);

        $field = Field::with(['schedules', 'reviews.user'])->findOrFail($id);

        if ($field->status !== 'available') {
            return back()->withErrors([
                'reservation' => 'Ce terrain n’est pas disponible.'
            ]);
        }

        $reservationDate = Carbon::parse($request->reservation_date);
        $today = Carbon::today();

        if ($reservationDate->lt($today)) {
            return back()->withErrors([
                'reservation' => 'Vous ne pouvez pas choisir une date passée.'
            ]);
        }

        $dayOfWeek = strtolower($reservationDate->englishDayOfWeek);

        $schedule = $field->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_open', true)
            ->first();

        if (!$schedule) {
            return back()->withErrors([
                'reservation' => 'Ce terrain est fermé à cette date.'
            ]);
        }

        $reservedSlots = Reservation::where('field_id', $field->id)
            ->where('reservation_date', $request->reservation_date)
            ->where('status', 'confirmed')
            ->get(['start_time', 'end_time']);

        $availableSlots = [];

        $slotStart = Carbon::createFromFormat('H:i:s', $schedule->start_time);
        $slotEndLimit = Carbon::createFromFormat('H:i:s', $schedule->end_time);

        while ($slotStart->copy()->addHour() <= $slotEndLimit) {
            $slotEnd = $slotStart->copy()->addHour();

            $isReserved = $reservedSlots->contains(function ($reservation) use ($slotStart, $slotEnd) {
                return $slotStart->format('H:i:s') < $reservation->end_time
                    && $slotEnd->format('H:i:s') > $reservation->start_time;
            });

            if (!$isReserved) {
                $availableSlots[] = [
                    'start_time' => $slotStart->format('H:i'),
                    'end_time' => $slotEnd->format('H:i'),
                ];
            }

            $slotStart->addHour();
        }

        return view('fields.show', [
            'field' => $field,
            'availableSlots' => $availableSlots,
            'selectedDate' => $request->reservation_date,
        ]);
    }
}