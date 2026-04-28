@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Modifier le terrain</h2>

    <form action="{{ route('manager.fields.update', $field->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($field->image)
            <img src="{{ asset('storage/' . $field->image) }}"
                 style="width:220px;height:140px;object-fit:cover;border-radius:14px;margin-bottom:15px;">
        @endif

        <label>Centre</label>
        <select name="center_id">
            @foreach($centers as $center)
                <option value="{{ $center->id }}" {{ $field->center_id == $center->id ? 'selected' : '' }}>
                    {{ $center->name }}
                </option>
            @endforeach
        </select>

        <label>Sport</label>
        <select name="sport_id">
            @foreach($sports as $sport)
                <option value="{{ $sport->id }}" {{ $field->sport_id == $sport->id ? 'selected' : '' }}>
                    {{ $sport->name }}
                </option>
            @endforeach
        </select>

        <label>Nom du terrain</label>
        <input type="text" name="name" value="{{ old('name', $field->name) }}">

        <label>Description</label>
        <textarea name="description">{{ old('description', $field->description) }}</textarea>

        <label>Prix par heure</label>
        <input type="number" step="0.01" name="price_per_hour" value="{{ old('price_per_hour', $field->price_per_hour) }}">

        <label>Capacité</label>
        <input type="number" name="capacity" value="{{ old('capacity', $field->capacity) }}">

        <label>Changer l’image du terrain</label>
        <input type="file" name="image">

        <label>Statut</label>
        <select name="status">
            <option value="available" {{ $field->status == 'available' ? 'selected' : '' }}>Disponible</option>
            <option value="maintenance" {{ $field->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            <option value="unavailable" {{ $field->status == 'unavailable' ? 'selected' : '' }}>Indisponible</option>
        </select>

        <button type="submit" class="btn">Mettre à jour</button>
    </form>
</div>
@endsection