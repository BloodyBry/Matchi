@extends('layouts.app')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="page-header">
        <h2>Nouveau centre</h2>
        <a href="{{ route('manager.center.index') }}" class="btn btn-outline btn-sm">Retour</a>
    </div>
    <div class="card">
        <form action="{{ route('manager.center.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Ex: Sport City Center" value="{{ old('name') }}">
            <div class="form-row">
                <div><label for="city">Ville</label><input type="text" id="city" name="city" value="{{ old('city') }}"></div>
                <div><label for="phone">Téléphone</label><input type="text" id="phone" name="phone" value="{{ old('phone') }}"></div>
            </div>
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            <label for="image">Image</label>
            <input type="file" id="image" name="image">
            <div class="form-row">
                <div><label for="opening_time">Ouverture</label><input type="time" id="opening_time" name="opening_time" value="{{ old('opening_time') }}"></div>
                <div><label for="closing_time">Fermeture</label><input type="time" id="closing_time" name="closing_time" value="{{ old('closing_time') }}"></div>
            </div>
            <button type="submit" class="btn" style="width:100%;justify-content:center;">Créer le centre</button>
        </form>
    </div>
</div>
@endsection