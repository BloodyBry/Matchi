@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Modifier le centre</h2>

    <form action="{{ route('manager.center.update', $center->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($center->image)
            <img src="{{ asset('storage/' . $center->image) }}"
                 style="width:220px;height:140px;object-fit:cover;border-radius:14px;margin-bottom:15px;">
        @endif

        <label>Nom</label>
        <input type="text" name="name" value="{{ old('name', $center->name) }}">

        <label>Ville</label>
        <input type="text" name="city" value="{{ old('city', $center->city) }}">

        <label>Adresse</label>
        <input type="text" name="address" value="{{ old('address', $center->address) }}">

        <label>Description</label>
        <textarea name="description">{{ old('description', $center->description) }}</textarea>

        <label>Téléphone</label>
        <input type="text" name="phone" value="{{ old('phone', $center->phone) }}">

        <label>Changer l’image du centre</label>
        <input type="file" name="image">

        <label>Heure d'ouverture</label>
        <input type="time" name="opening_time" value="{{ old('opening_time', $center->opening_time) }}">

        <label>Heure de fermeture</label>
        <input type="time" name="closing_time" value="{{ old('closing_time', $center->closing_time) }}">

        <button type="submit" class="btn">Mettre à jour</button>
    </form>
</div>
@endsection