@extends('layouts.app')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="football" :size="13" /> Administration</p>
            <h2>Ajouter un sport</h2>
        </div>
        <a href="{{ route('admin.sports.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        <form action="{{ route('admin.sports.store') }}" method="POST">
            @csrf

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Ex: Football" value="{{ old('name') }}">

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Décrivez ce sport...">{{ old('description') }}</textarea>

            <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="plus" :size="15" /> Créer</button>
        </form>
    </div>
</div>
@endsection