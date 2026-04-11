@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Mes centres sportifs</h2>
    <a href="{{ route('manager.center.create') }}" class="btn">Ajouter un centre</a>
</div>

@forelse($centers as $center)
    <div class="card">
        <h3>{{ $center->name }}</h3>
        <p><strong>Ville :</strong> {{ $center->city }}</p>
        <p><strong>Adresse :</strong> {{ $center->address }}</p>
        <p><strong>Téléphone :</strong> {{ $center->phone }}</p>
        <p><strong>Horaires :</strong> {{ $center->opening_time }} - {{ $center->closing_time }}</p>
        <p><strong>Statut :</strong> {{ $center->status }}</p>

        <a href="{{ route('manager.center.edit', $center->id) }}" class="btn">Modifier</a>
    </div>
@empty
    <div class="card">
        <p>Aucun centre trouvé.</p>
    </div>
@endforelse
@endsection