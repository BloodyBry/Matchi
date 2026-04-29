@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="stadium" :size="13" /> Gestion</p>
        <h2>Mes terrains</h2>
    </div>
    <a href="{{ route('manager.fields.create') }}" class="btn"><x-icon name="plus" :size="15" /> Ajouter un terrain</a>
</div>

<div class="grid">
@forelse($fields as $field)
    <div class="field-card">
        <div class="field-card__img-wrap">
            @if($field->image)
                <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}" class="field-card__img">
            @else
                <div class="field-card__img-placeholder"><x-icon name="football" :size="48" /></div>
            @endif
            @if($field->status === 'available')
                <span class="field-card__status field-card__status--available">Disponible</span>
            @elseif($field->status === 'maintenance')
                <span class="field-card__status field-card__status--maintenance">Maintenance</span>
            @else
                <span class="field-card__status field-card__status--unavailable">Indisponible</span>
            @endif
        </div>
        <div class="field-card__body">
            <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:10px;">
                <span class="badge badge-green">{{ $field->sport->name }}</span>
                <span class="badge badge-gray" style="display:flex;align-items:center;gap:4px;"><x-icon name="building" :size="11" /> {{ $field->center->name }}</span>
            </div>
            <h3 class="field-card__name">{{ $field->name }}</h3>
            <p class="field-card__center">Capacité : {{ $field->capacity }} pers. · {{ $field->price_per_hour }} MAD/h</p>

            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:auto;padding-top:14px;">
                <a href="{{ route('manager.fields.edit', $field->id) }}" class="btn btn-sm"><x-icon name="edit" :size="13" /> Modifier</a>
                <a href="{{ route('manager.schedules.index', $field->id) }}" class="btn btn-outline btn-sm"><x-icon name="clock" :size="13" /> Horaires</a>
                <form action="{{ route('manager.fields.delete', $field->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce terrain ?')"><x-icon name="trash" :size="13" /></button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="card empty-state" style="grid-column:1/-1;">
        <div class="empty-state__icon"><x-icon name="stadium" :size="28" /></div>
        <h3>Aucun terrain</h3>
        <p>Ajoutez votre premier terrain pour commencer.</p>
        <a href="{{ route('manager.fields.create') }}" class="btn"><x-icon name="plus" :size="15" /> Ajouter un terrain</a>
    </div>
@endforelse
</div>

<style>
.field-card{background:#fff;border-radius:16px;border:1px solid #e5e7eb;box-shadow:0 1px 3px rgba(0,0,0,.04);overflow:hidden;display:flex;flex-direction:column;transition:transform .18s,box-shadow .18s}
.field-card:hover{transform:translateY(-4px);box-shadow:0 8px 24px rgba(0,0,0,.08)}
.field-card__img-wrap{position:relative;height:170px;overflow:hidden;background:#f0fdf4}
.field-card__img{width:100%;height:100%;object-fit:cover;transition:transform .35s}
.field-card:hover .field-card__img{transform:scale(1.04)}
.field-card__img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#f0fdf4,#dcfce7);color:#16a34a}
.field-card__status{position:absolute;top:10px;right:10px;padding:4px 12px;border-radius:999px;font-size:11.5px;font-weight:600;letter-spacing:.01em}
.field-card__status--available{background:#16a34a;color:#fff}
.field-card__status--maintenance{background:#f59e0b;color:#fff}
.field-card__status--unavailable{background:#dc2626;color:#fff}
.field-card__body{padding:18px;display:flex;flex-direction:column;flex:1}
.field-card__name{font-size:15.5px;font-weight:700;color:#111827;margin-bottom:4px}
.field-card__center{font-size:13px;color:#9ca3af;flex:1;margin-bottom:0}
</style>

@endsection