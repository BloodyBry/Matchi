@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Mes terrains</h2>
    <a href="{{ route('manager.fields.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Nouveau terrain</a>
</div>

<div class="grid">
@forelse($fields as $field)
    <div class="field-card">
        <div class="field-card__img">
            @if($field->image)
                <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}">
            @else
                <div class="field-card__placeholder"><x-icon name="football" :size="36" /></div>
            @endif
            @if($field->status === 'available')
                <span class="field-card__badge field-card__badge--green">Disponible</span>
            @elseif($field->status === 'maintenance')
                <span class="field-card__badge field-card__badge--amber">Maintenance</span>
            @else
                <span class="field-card__badge field-card__badge--red">Indisponible</span>
            @endif
        </div>
        <div class="field-card__body">
            <div style="margin-bottom:8px;">
                <span class="badge badge-green">{{ $field->sport->name }}</span>
            </div>
            <h3 style="margin-bottom:4px;">{{ $field->name }}</h3>
            <p style="font-size:13px;margin-bottom:12px;">{{ $field->center->name }} · {{ $field->capacity }} pers. · {{ $field->price_per_hour }} MAD/h</p>
            <div style="display:flex;flex-wrap:wrap;gap:6px;margin-top:auto;">
                <a href="{{ route('manager.fields.edit', $field->id) }}" class="btn btn-outline btn-sm">Modifier</a>
                <a href="{{ route('manager.schedules.index', $field->id) }}" class="btn btn-outline btn-sm">Horaires</a>
                <form action="{{ route('manager.fields.delete', $field->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')"><x-icon name="trash" :size="13" /></button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="card empty" style="grid-column:1/-1;">
        <x-icon name="stadium" :size="32" />
        <h3>Aucun terrain</h3>
        <p>Ajoutez votre premier terrain.</p>
        <a href="{{ route('manager.fields.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Nouveau terrain</a>
    </div>
@endforelse
</div>

<style>
.field-card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; display:flex; flex-direction:column; }
.field-card__img { position:relative; height:160px; overflow:hidden; background:#f9fafb; }
.field-card__img img { width:100%; height:100%; object-fit:cover; }
.field-card__placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#d1d5db; }
.field-card__badge { position:absolute; top:8px; right:8px; padding:3px 10px; border-radius:6px; font-size:12px; font-weight:500; }
.field-card__badge--green { background:#059669; color:#fff; }
.field-card__badge--amber { background:#d97706; color:#fff; }
.field-card__badge--red { background:#dc2626; color:#fff; }
.field-card__body { padding:16px; display:flex; flex-direction:column; flex:1; }
</style>

@endsection