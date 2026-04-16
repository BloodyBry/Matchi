@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Gestion des utilisateurs</h2>
</div>

@forelse($users as $user)
    <div class="card">
        <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Téléphone :</strong> {{ $user->phone }}</p>
        <p><strong>Rôle :</strong> {{ $user->role }}</p>
        <p><strong>Statut :</strong> {{ $user->status }}</p>

        @if($user->role !== 'admin')
            <form action="{{ route('admin.users.status', $user->id) }}" method="POST" style="margin-bottom:10px;">
                @csrf
                <button type="submit" class="btn">
                    {{ $user->status === 'active' ? 'Bloquer' : 'Activer' }}
                </button>
            </form>

            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        @endif
    </div>
@empty
    <div class="card">
        <p>Aucun utilisateur trouvé.</p>
    </div>
@endforelse
@endsection