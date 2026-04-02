@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Liste des terrains</h2>

    <form method="GET" action="{{ route('fields.index') }}">
        <label>Ville</label>
        <input type="text" name="city" value="{{ request('city') }}">

        <label>Sport</label>
        <select name="sport_id">
            <option value="">-- Tous les sports --</option>
            @foreach($sports as $sport)
                <option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>
                    {{ $sport->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">Filtrer</button>
    </form>
</div>

@foreach($fields as $field)
    <div class="card">
        <h3>{{ $field->name }}</h3>
        <p><strong>Centre :</strong> {{ $field->center->name }}</p>
        <p><strong>Ville :</strong> {{ $field->center->city }}</p>
        <p><strong>Sport :</strong> {{ $field->sport->name }}</p>
        <p><strong>Prix/heure :</strong> {{ $field->price_per_hour }} MAD</p>
        <a href="{{ route('fields.show', $field->id) }}" class="btn">Voir détails</a>
    </div>
@endforeach
@endsection