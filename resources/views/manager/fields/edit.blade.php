@extends('layouts.app')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="page-header">
        <h2>Modifier le terrain</h2>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm">Retour</a>
    </div>
    <div class="card">
        @if($field->image)
            <img src="{{ asset('storage/' . $field->image) }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;margin-bottom:16px;">
        @endif
        <form action="{{ route('manager.fields.update', $field->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div><label for="center_id">Centre</label><select id="center_id" name="center_id">@foreach($centers as $c)<option value="{{ $c->id }}" {{ $field->center_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
                <div><label for="sport_id">Sport</label><select id="sport_id" name="sport_id">@foreach($sports as $s)<option value="{{ $s->id }}" {{ $field->sport_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>@endforeach</select></div>
            </div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $field->name) }}" required>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $field->description) }}</textarea>
            <div class="form-row">
                <div><label for="price_per_hour">Prix / heure (MAD)</label><input type="number" step="0.01" id="price_per_hour" name="price_per_hour" value="{{ old('price_per_hour', $field->price_per_hour) }}" required></div>
                <div><label for="capacity">Capacité</label><input type="number" id="capacity" name="capacity" value="{{ old('capacity', $field->capacity) }}" required></div>
            </div>
            <label for="status">Statut</label>
            <select id="status" name="status">
                <option value="available" {{ $field->status == 'available' ? 'selected' : '' }}>Disponible</option>
                <option value="maintenance" {{ $field->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="unavailable" {{ $field->status == 'unavailable' ? 'selected' : '' }}>Indisponible</option>
            </select>
            <label for="image">Changer l'image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <div style="display:flex;gap:8px;margin-top:4px;">
                <button type="submit" class="btn" style="flex:1;justify-content:center;">Enregistrer</button>
                <a href="{{ route('manager.fields.index') }}" class="btn btn-outline" style="flex:1;justify-content:center;">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection