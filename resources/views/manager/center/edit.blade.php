@extends('layouts.app')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="page-header">
        <h2>Modifier le centre</h2>
        <a href="{{ route('manager.center.index') }}" class="btn btn-outline btn-sm">Retour</a>
    </div>
    <div class="card">
        @if($center->image)
            <img src="{{ asset('storage/' . $center->image) }}" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:16px;">
        @endif
        <form action="{{ route('manager.center.update', $center->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $center->name) }}">
            <div class="form-row">
                <div><label for="city">Ville</label><input type="text" id="city" name="city" value="{{ old('city', $center->city) }}"></div>
                <div><label for="phone">Téléphone</label><input type="text" id="phone" name="phone" value="{{ old('phone', $center->phone) }}"></div>
            </div>
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value="{{ old('address', $center->address) }}">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $center->description) }}</textarea>
            <label for="image">Changer l'image</label>
            <input type="file" id="image" name="image">
            <div class="form-row">
                <div><label for="opening_time">Ouverture</label><input type="time" id="opening_time" name="opening_time" value="{{ old('opening_time', $center->opening_time) }}"></div>
                <div><label for="closing_time">Fermeture</label><input type="time" id="closing_time" name="closing_time" value="{{ old('closing_time', $center->closing_time) }}"></div>
            </div>
            <button type="submit" class="btn" style="width:100%;justify-content:center;">Enregistrer</button>
        </form>
    </div>
</div>
@endsection