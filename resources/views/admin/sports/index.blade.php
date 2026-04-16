@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Gestion des sports</h2>
    <a href="{{ route('admin.sports.create') }}" class="btn">Ajouter un sport</a>
</div>

@forelse($sports as $sport)
    <div class="card">
        <h3>{{ $sport->name }}</h3>
        <p>{{ $sport->description }}</p>

        <a href="{{ route('admin.sports.edit', $sport->id) }}" class="btn">Modifier</a>

        <form action="{{ route('admin.sports.delete', $sport->id) }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@empty
    <div class="card">
        <p>Aucun sport trouvé.</p>
    </div>
@endforelse
@endsection