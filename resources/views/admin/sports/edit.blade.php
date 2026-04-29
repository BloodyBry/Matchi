@extends('layouts.app')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="football" :size="13" /> Administration</p>
            <h2>Modifier le sport</h2>
        </div>
        <a href="{{ route('admin.sports.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        <form action="{{ route('admin.sports.update', $sport->id) }}" method="POST">
            @csrf

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $sport->name) }}">

            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $sport->description) }}</textarea>

            <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="save" :size="15" /> Mettre à jour</button>
        </form>
    </div>
</div>
@endsection