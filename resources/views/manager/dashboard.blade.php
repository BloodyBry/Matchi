@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Dashboard Gestionnaire</h2>
    <p><strong>Centres :</strong> {{ $centersCount }}</p>
    <p><strong>Terrains :</strong> {{ $fieldsCount }}</p>
    <p><strong>Réservations :</strong> {{ $reservationsCount }}</p>
</div>

<div class="card">
    <a href="{{ route('manager.center.index') }}" class="btn">Gérer mes centres</a>
    <a href="{{ route('manager.fields.index') }}" class="btn">Gérer mes terrains</a>
    <a href="{{ route('manager.reservations.index') }}" class="btn">Voir les réservations</a>
</div>
@endsection