@extends('layouts.app')

@section('content')
<div class="card">
    <h2>{{ $field->name }}</h2>
    <p><strong>Centre :</strong> {{ $field->center->name }}</p>
    <p><strong>Ville :</strong> {{ $field->center->city }}</p>
    <p><strong>Adresse :</strong> {{ $field->center->address }}</p>
    <p><strong>Sport :</strong> {{ $field->sport->name }}</p>
    <p><strong>Prix/heure :</strong> {{ $field->price_per_hour }} MAD</p>
    <p><strong>Description :</strong> {{ $field->description }}</p>

    @php
        $averageRating = $field->reviews->count() > 0 ? round($field->reviews->avg('rating'), 1) : null;
    @endphp

    <p><strong>Note moyenne :</strong> {{ $averageRating ? $averageRating . '/5' : 'Pas encore noté' }}</p>
</div>

<div class="card">
    <h3>Horaires</h3>
    @forelse($field->schedules as $schedule)
        <p>{{ $schedule->day_of_week }} : {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
    @empty
        <p>Aucun horaire défini.</p>
    @endforelse
</div>

@if(session()->has('user_id'))
<div class="card">
    <h3>Réserver ce terrain</h3>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="field_id" value="{{ $field->id }}">

        <label>Date</label>
        <input type="date" name="reservation_date">

        <label>Heure de début</label>
        <input type="time" name="start_time">

        <label>Heure de fin</label>
        <input type="time" name="end_time">

        <label>Notes</label>
        <textarea name="notes"></textarea>

        <button type="submit" class="btn">Réserver</button>
    </form>
</div>
@endif

<div class="card">
    <h3>Avis</h3>

    @if(session()->has('user_id'))
        @php
            $myReview = $field->reviews->where('user_id', session('user_id'))->first();
        @endphp

        @if(!$myReview)
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="field_id" value="{{ $field->id }}">

                <label>Note</label>
                <select name="rating">
                    <option value="1">1/5</option>
                    <option value="2">2/5</option>
                    <option value="3">3/5</option>
                    <option value="4">4/5</option>
                    <option value="5">5/5</option>
                </select>

                <label>Commentaire</label>
                <textarea name="comment"></textarea>

                <button type="submit" class="btn">Ajouter un avis</button>
            </form>
        @endif
    @endif
</div>

<div class="card">
    <h3>Liste des avis</h3>

    @forelse($field->reviews as $review)
        <div style="margin-bottom:20px;">
            <p>
                <strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong>
                - Note : {{ $review->rating }}/5
            </p>
            <p>{{ $review->comment }}</p>

            @if(session('user_id') == $review->user_id)
                <form action="{{ route('reviews.update', $review->id) }}" method="POST" style="margin-bottom:10px;">
                    @csrf

                    <label>Modifier la note</label>
                    <select name="rating">
                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1/5</option>
                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2/5</option>
                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3/5</option>
                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4/5</option>
                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5/5</option>
                    </select>

                    <label>Modifier le commentaire</label>
                    <textarea name="comment">{{ $review->comment }}</textarea>

                    <button type="submit" class="btn">Modifier</button>
                </form>

                <form action="{{ route('reviews.delete', $review->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            @endif

            <hr>
        </div>
    @empty
        <p>Aucun avis pour le moment.</p>
    @endforelse
</div>
@endsection