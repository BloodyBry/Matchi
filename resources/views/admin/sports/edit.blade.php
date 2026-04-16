@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Modifier le sport</h2>

    <form action="{{ route('admin.sports.update', $sport->id) }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="name" value="{{ old('name', $sport->name) }}">

        <label>Description</label>
        <textarea name="description">{{ old('description', $sport->description) }}</textarea>

        <button type="submit" class="btn">Mettre à jour</button>
    </form>
</div>
@endsection