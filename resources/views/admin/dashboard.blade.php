@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Dashboard Administrateur</h2>
    <p><strong>Utilisateurs :</strong> {{ $usersCount }}</p>
    <p><strong>Centres sportifs :</strong> {{ $centersCount }}</p>
    <p><strong>Terrains :</strong> {{ $fieldsCount }}</p>
    <p><strong>Réservations :</strong> {{ $reservationsCount }}</p>
    <p><strong>Sports :</strong> {{ $sportsCount }}</p>
</div>

<div class="card">
    <a href="{{ route('admin.users.index') }}" class="btn">Gérer les utilisateurs</a>
    <a href="{{ route('admin.centers.index') }}" class="btn">Gérer les centres</a>
    <a href="{{ route('admin.sports.index') }}" class="btn">Gérer les sports</a>
    <a href="{{ route('admin.reservations.index') }}" class="btn">Voir les réservations</a>
</div>
@endsection