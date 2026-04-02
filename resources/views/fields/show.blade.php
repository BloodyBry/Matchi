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
    @forelse($field->reviews as $review)
        <p>
            <strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong>
            - Note : {{ $review->rating }}/5
        </p>
        <p>{{ $review->comment }}</p>
        <hr>
    @empty
        <p>Aucun avis pour le moment.</p>
    @endforelse
</div>
@endsection