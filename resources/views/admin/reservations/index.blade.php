@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Toutes les réservations</h2>
</div>

@forelse($reservations as $reservation)
    <div class="card">
        <h3>{{ $reservation->field->name }}</h3>
        <p><strong>Client :</strong> {{ $reservation->user->first_name }} {{ $reservation->user->last_name }}</p>
        <p><strong>Centre :</strong> {{ $reservation->field->center->name }}</p>
        <p><strong>Sport :</strong> {{ $reservation->field->sport->name }}</p>
        <p><strong>Date :</strong> {{ $reservation->reservation_date }}</p>
        <p><strong>Horaire :</strong> {{ $reservation->start_time }} - {{ $reservation->end_time }}</p>
        <p><strong>Prix :</strong> {{ $reservation->total_price }} MAD</p>
        <p><strong>Statut :</strong> {{ $reservation->status }}</p>
    </div>
@empty
    <div class="card">
        <p>Aucune réservation trouvée.</p>
    </div>
@endforelse
@endsection