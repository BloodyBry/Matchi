@extends('layouts.app')

@section('content')
<div style="max-width:600px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="building" :size="13" /> Gestion</p>
            <h2>Modifier le centre</h2>
        </div>
        <a href="{{ route('manager.center.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        @if($center->image)
            <img src="{{ asset('storage/' . $center->image) }}"
                 style="width:100%;height:180px;object-fit:cover;border-radius:12px;margin-bottom:20px;">
        @endif

        <form action="{{ route('manager.center.update', $center->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $center->name) }}">

            <div class="grid-2">
                <div>
                    <label for="city"><x-icon name="map-pin" :size="14" /> Ville</label>
                    <input type="text" id="city" name="city" value="{{ old('city', $center->city) }}">
                </div>
                <div>
                    <label for="phone"><x-icon name="phone" :size="14" /> Téléphone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $center->phone) }}">
                </div>
            </div>

            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value="{{ old('address', $center->address) }}">

            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $center->description) }}</textarea>

            <label for="image">Changer l'image du centre</label>
            <input type="file" id="image" name="image">

            <div class="grid-2">
                <div>
                    <label for="opening_time"><x-icon name="clock" :size="14" /> Heure d'ouverture</label>
                    <input type="time" id="opening_time" name="opening_time" value="{{ old('opening_time', $center->opening_time) }}">
                </div>
                <div>
                    <label for="closing_time"><x-icon name="clock" :size="14" /> Heure de fermeture</label>
                    <input type="time" id="closing_time" name="closing_time" value="{{ old('closing_time', $center->closing_time) }}">
                </div>
            </div>

            <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="save" :size="15" /> Mettre à jour</button>
        </form>
    </div>
</div>
@endsection