@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Ajouter un sport</h2>

    <form action="{{ route('admin.sports.store') }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label>Description</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <button type="submit" class="btn">Créer</button>
    </form>
</div>
@endsection