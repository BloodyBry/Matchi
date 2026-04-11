<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\FieldSchedule;
use Illuminate\Http\Request;

class FieldScheduleController extends Controller
{
    public function index($fieldId)
    {
        $field = Field::with('schedules')
            ->whereHas('center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->findOrFail($fieldId);

        return view('manager.schedules.index', compact('field'));
    }

    public function store(Request $request, $fieldId)
    {
        $field = Field::whereHas('center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->findOrFail($fieldId);

        $request->validate([
            'day_of_week' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_open' => 'required|boolean',
        ]);

        FieldSchedule::create([
            'field_id' => $field->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_open' => $request->is_open,
        ]);

        return back()->with('success', 'Horaire ajouté avec succès.');
    }

    public function destroy($id)
    {
        $schedule = FieldSchedule::whereHas('field.center', function ($query) {
                $query->where('manager_id', session('user_id'));
            })
            ->findOrFail($id);

        $schedule->delete();

        return back()->with('success', 'Horaire supprimé avec succès.');
    }
}