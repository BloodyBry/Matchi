<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Sport;
use Illuminate\Http\Request;

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
}