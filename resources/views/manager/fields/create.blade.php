@extends('layouts.app')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="page-header">
        <h2>Nouveau terrain</h2>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm">Retour</a>
    </div>
    <div class="card">
        @if($centers->count() === 0)
            <div class="empty">
                <h3>Aucun centre</h3>
                <p>Vous devez d'abord créer un centre sportif.</p>
                <a href="{{ route('manager.center.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Créer un centre</a>
            </div>
        @else
        <form action="{{ route('manager.fields.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div><label for="center_id">Centre</label><select id="center_id" name="center_id">@foreach($centers as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
                <div><label for="sport_id">Sport</label><select id="sport_id" name="sport_id">@foreach($sports as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach</select></div>
            </div>
            <label for="name">Nom du terrain</label>
            <input type="text" id="name" name="name" placeholder="Ex: Terrain A" value="{{ old('name') }}" required>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            <div class="form-row">
                <div><label for="price_per_hour">Prix / heure (MAD)</label><input type="number" step="0.01" id="price_per_hour" name="price_per_hour" value="{{ old('price_per_hour') }}" required></div>
                <div><label for="capacity">Capacité</label><input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" required></div>
            </div>
            <label for="status">Statut</label>
            <select id="status" name="status">
                <option value="available">Disponible</option>
                <option value="maintenance">Maintenance</option>
                <option value="unavailable">Indisponible</option>
            </select>
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <div style="display:flex;gap:8px;margin-top:4px;">
                <button type="submit" class="btn" style="flex:1;justify-content:center;">Créer</button>
                <a href="{{ route('manager.fields.index') }}" class="btn btn-outline" style="flex:1;justify-content:center;">Annuler</a>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection