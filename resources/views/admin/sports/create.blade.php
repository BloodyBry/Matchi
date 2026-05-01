@extends('layouts.app')
@section('content')
<div style="max-width:480px;margin:0 auto;">
    <div class="page-header"><h2>Ajouter un sport</h2><a href="{{ route('admin.sports.index') }}" class="btn btn-outline btn-sm">Retour</a></div>
    <div class="card">
        <form action="{{ route('admin.sports.store') }}" method="POST">
            @csrf
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Ex: Football" value="{{ old('name') }}">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            <button type="submit" class="btn" style="width:100%;justify-content:center;">Créer</button>
        </form>
    </div>
</div>
@endsection