<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $userId = session('user_id');

        $existingReview = Review::where('user_id', $userId)
            ->where('field_id', $request->field_id)
            ->first();

        if ($existingReview) {
            return back()->withErrors([
                'review' => 'Vous avez déjà laissé un avis sur ce terrain.'
            ])->withInput();
        }

        Review::create([
            'user_id' => $userId,
            'field_id' => $request->field_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Avis ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Avis modifié avec succès.');
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $review->delete();

        return back()->with('success', 'Avis supprimé avec succès.');
    }
}