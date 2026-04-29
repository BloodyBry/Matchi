@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="football" :size="13" /> Administration</p>
        <h2>Gestion des sports</h2>
    </div>
    <a href="{{ route('admin.sports.create') }}" class="btn"><x-icon name="plus" :size="15" /> Ajouter un sport</a>
</div>

@forelse($sports as $sport)
    <div class="card data-row">
        <div class="icon-box icon-box--md icon-box--green">
            <x-icon name="football" :size="22" />
        </div>
        <div class="data-row__info">
            <div class="data-row__name">{{ $sport->name }}</div>
            <div class="data-row__sub">{{ $sport->description }}</div>
        </div>
        <div class="data-row__actions">
            <a href="{{ route('admin.sports.edit', $sport->id) }}" class="btn btn-sm btn-outline"><x-icon name="edit" :size="13" /> Modifier</a>
            <form action="{{ route('admin.sports.delete', $sport->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce sport ?')"><x-icon name="trash" :size="13" /></button>
            </form>
        </div>
    </div>
@empty
    <div class="card empty-state">
        <div class="empty-state__icon"><x-icon name="football" :size="28" /></div>
        <h3>Aucun sport trouvé</h3>
        <p>Ajoutez votre premier sport pour commencer.</p>
        <a href="{{ route('admin.sports.create') }}" class="btn"><x-icon name="plus" :size="15" /> Ajouter un sport</a>
    </div>
@endforelse

@endsection