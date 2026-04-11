@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Mes terrains</h2>
    <a href="{{ route('manager.fields.create') }}" class="btn">Ajouter un terrain</a>
</div>

@forelse($fields as $field)
    <div class="card">
        <h3>{{ $field->name }}</h3>
        <p><strong>Centre :</strong> {{ $field->center->name }}</p>
        <p><strong>Sport :</strong> {{ $field->sport->name }}</p>
        <p><strong>Prix/heure :</strong> {{ $field->price_per_hour }} MAD</p>
        <p><strong>Capacité :</strong> {{ $field->capacity }}</p>
        <p><strong>Statut :</strong> {{ $field->status }}</p>

        <a href="{{ route('manager.fields.edit', $field->id) }}" class="btn">Modifier</a>
        <a href="{{ route('manager.schedules.index', $field->id) }}" class="btn">Horaires</a>

        <form action="{{ route('manager.fields.delete', $field->id) }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@empty
    <div class="card">
        <p>Aucun terrain trouvé.</p>
    </div>
@endforelse
@endsection