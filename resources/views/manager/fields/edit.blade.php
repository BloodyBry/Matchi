@extends('layouts.app')

@section('content')
<div style="max-width:640px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="stadium" :size="13" /> Gestion</p>
            <h2>Modifier le terrain</h2>
        </div>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        @if($field->image)
            <img src="{{ asset('storage/' . $field->image) }}" style="width:100%;height:200px;object-fit:cover;border-radius:12px;margin-bottom:22px;">
        @endif

        <form action="{{ route('manager.fields.update', $field->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid-2">
                <div>
                    <label for="center_id"><x-icon name="building" :size="14" /> Centre</label>
                    <select id="center_id" name="center_id">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ $field->center_id == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="sport_id"><x-icon name="football" :size="14" /> Sport</label>
                    <select id="sport_id" name="sport_id">
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}" {{ $field->sport_id == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <label for="name">Nom du terrain</label>
            <input type="text" id="name" name="name" value="{{ old('name', $field->name) }}" required>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $field->description) }}</textarea>
            <div class="grid-2">
                <div>
                    <label for="price_per_hour"><x-icon name="dollar" :size="14" /> Prix/h (MAD)</label>
                    <input type="number" step="0.01" id="price_per_hour" name="price_per_hour" value="{{ old('price_per_hour', $field->price_per_hour) }}" required>
                </div>
                <div>
                    <label for="capacity"><x-icon name="users" :size="14" /> Capacité</label>
                    <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $field->capacity) }}" required>
                </div>
            </div>
            <label for="status"><x-icon name="tag" :size="14" /> Statut</label>
            <select id="status" name="status">
                <option value="available" {{ $field->status == 'available' ? 'selected' : '' }}>Disponible</option>
                <option value="maintenance" {{ $field->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="unavailable" {{ $field->status == 'unavailable' ? 'selected' : '' }}>Indisponible</option>
            </select>
            <label for="image">Changer l'image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <div style="display:flex;gap:12px;margin-top:8px;">
                <button type="submit" class="btn" style="flex:1;justify-content:center;"><x-icon name="save" :size="15" /> Mettre à jour</button>
                <a href="{{ route('manager.fields.index') }}" class="btn btn-outline" style="flex:1;justify-content:center;">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection