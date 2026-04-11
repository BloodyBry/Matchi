@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Ajouter un centre sportif</h2>

    <form action="{{ route('manager.center.store') }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label>Ville</label>
        <input type="text" name="city" value="{{ old('city') }}">

        <label>Adresse</label>
        <input type="text" name="address" value="{{ old('address') }}">

        <label>Description</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <label>Téléphone</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>Heure d'ouverture</label>
        <input type="time" name="opening_time" value="{{ old('opening_time') }}">

        <label>Heure de fermeture</label>
        <input type="time" name="closing_time" value="{{ old('closing_time') }}">

        <button type="submit" class="btn">Créer</button>
    </form>
</div>
@endsection