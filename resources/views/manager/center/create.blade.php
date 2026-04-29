@extends('layouts.app')

@section('content')
<div style="max-width:600px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="building" :size="13" /> Gestion</p>
            <h2>Ajouter un centre sportif</h2>
        </div>
        <a href="{{ route('manager.center.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        <form action="{{ route('manager.center.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Ex: Sport City Center" value="{{ old('name') }}">

            <div class="grid-2">
                <div>
                    <label for="city"><x-icon name="map-pin" :size="14" /> Ville</label>
                    <input type="text" id="city" name="city" placeholder="Ex: Casablanca" value="{{ old('city') }}">
                </div>
                <div>
                    <label for="phone"><x-icon name="phone" :size="14" /> Téléphone</label>
                    <input type="text" id="phone" name="phone" placeholder="06XXXXXXXX" value="{{ old('phone') }}">
                </div>
            </div>

            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" placeholder="Adresse complète" value="{{ old('address') }}">

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Décrivez votre centre...">{{ old('description') }}</textarea>

            <label for="image">Image du centre</label>
            <input type="file" id="image" name="image">

            <div class="grid-2">
                <div>
                    <label for="opening_time"><x-icon name="clock" :size="14" /> Heure d'ouverture</label>
                    <input type="time" id="opening_time" name="opening_time" value="{{ old('opening_time') }}">
                </div>
                <div>
                    <label for="closing_time"><x-icon name="clock" :size="14" /> Heure de fermeture</label>
                    <input type="time" id="closing_time" name="closing_time" value="{{ old('closing_time') }}">
                </div>
            </div>

            <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="plus" :size="15" /> Créer</button>
        </form>
    </div>
</div>
@endsection