@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Ajouter un terrain</h2>

    @if($centers->count() === 0)
        <p>Vous devez d’abord créer un centre sportif.</p>
        <a href="{{ route('manager.center.create') }}" class="btn">Créer un centre</a>
    @else
        <form action="{{ route('manager.fields.store') }}" method="POST">
            @csrf

            <label>Centre</label>
            <select name="center_id">
                @foreach($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                @endforeach
            </select>

            <label>Sport</label>
            <select name="sport_id">
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                @endforeach
            </select>

            <label>Nom du terrain</label>
            <input type="text" name="name" value="{{ old('name') }}">

            <label>Description</label>
            <textarea name="description">{{ old('description') }}</textarea>

            <label>Prix par heure</label>
            <input type="number" step="0.01" name="price_per_hour" value="{{ old('price_per_hour') }}">

            <label>Capacité</label>
            <input type="number" name="capacity" value="{{ old('capacity') }}">

            <label>Statut</label>
            <select name="status">
                <option value="available">Disponible</option>
                <option value="maintenance">Maintenance</option>
                <option value="unavailable">Indisponible</option>
            </select>

            <button type="submit" class="btn">Créer</button>
        </form>
    @endif
</div>
@endsection