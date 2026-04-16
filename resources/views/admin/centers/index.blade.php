@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Gestion des centres sportifs</h2>
</div>

@forelse($centers as $center)
    <div class="card">
        <h3>{{ $center->name }}</h3>
        <p><strong>Manager :</strong> {{ $center->manager->first_name }} {{ $center->manager->last_name }}</p>
        <p><strong>Ville :</strong> {{ $center->city }}</p>
        <p><strong>Adresse :</strong> {{ $center->address }}</p>
        <p><strong>Téléphone :</strong> {{ $center->phone }}</p>
        <p><strong>Statut :</strong> {{ $center->status }}</p>

        <form action="{{ route('admin.centers.status', $center->id) }}" method="POST" style="margin-bottom:10px;">
            @csrf
            <button type="submit" class="btn">Changer le statut</button>
        </form>

        <form action="{{ route('admin.centers.delete', $center->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@empty
    <div class="card">
        <p>Aucun centre trouvé.</p>
    </div>
@endforelse
@endsection