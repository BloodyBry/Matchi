@extends('layouts.app')

@section('content')

{{-- ── Page header ── --}}
<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="compass" :size="13" /> Découvrez</p>
        <h2>Trouver un terrain</h2>
    </div>
</div>

{{-- ── Filter card ── --}}
<div class="card" style="margin-bottom:28px;">
    <form method="GET" action="{{ route('fields.index') }}">
        <div class="grid-2" style="align-items:flex-end;">
            <div>
                <label for="sport_id"><x-icon name="football" :size="14" /> Sport</label>
                <select id="sport_id" name="sport_id">
                    <option value="">Tous les sports</option>
                    @foreach($sports as $sport)
                        <option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>
                            {{ $sport->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="city"><x-icon name="map-pin" :size="14" /> Ville</label>
                <input type="text" id="city" name="city" placeholder="Ex: Casablanca" value="{{ request('city') }}">
            </div>
            <div style="display:flex;align-items:flex-end;padding-bottom:18px;">
                <button class="btn" type="submit" style="width:100%;justify-content:center;"><x-icon name="search" :size="15" /> Filtrer</button>
            </div>
        </div>
    </form>
</div>

{{-- ── Fields grid ── --}}
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
                <span class="badge badge-gray" style="display:flex;align-items:center;gap:4px;"><x-icon name="map-pin" :size="11" /> {{ $field->center->city }}</span>
            </div>
            <h3 class="field-card__name">{{ $field->name }}</h3>
            <p class="field-card__center">{{ $field->center->name }}</p>
            <div class="field-card__footer">
                <div class="field-card__price">
                    <span class="field-card__price-amount">{{ $field->price_per_hour }}</span>
                    <span class="field-card__price-unit"> MAD / h</span>
                </div>
                <a href="{{ route('fields.show', $field->id) }}" class="btn btn-sm">
                    Voir <x-icon name="arrow-right" :size="14" />
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="card empty-state" style="grid-column:1/-1;">
        <div class="empty-state__icon"><x-icon name="stadium" :size="28" /></div>
        <h3>Aucun terrain trouvé</h3>
        <p>Essayez d'autres filtres ou explorez tous les terrains.</p>
    </div>
@endforelse
</div>

<style>
.field-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .18s ease, box-shadow .18s ease;
}
.field-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
}
.field-card__img-wrap {
    position: relative;
    height: 190px;
    overflow: hidden;
    background: #f0fdf4;
}
.field-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
}
.field-card:hover .field-card__img {
    transform: scale(1.04);
}
.field-card__img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    color: #16a34a;
}
.field-card__status {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 600;
}
.field-card__status--available   { background: #16a34a; color: #fff; }
.field-card__status--maintenance { background: #f59e0b; color: #fff; }
.field-card__status--unavailable { background: #dc2626; color: #fff; }
.field-card__body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.field-card__name {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 4px;
}
.field-card__center {
    font-size: 13px;
    color: #9ca3af;
    margin-bottom: 16px;
    flex: 1;
}
.field-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
}
.field-card__price-amount {
    font-size: 20px;
    font-weight: 800;
    color: #16a34a;
}
.field-card__price-unit {
    font-size: 13px;
    color: #6b7280;
    font-weight: 500;
}
</style>

@endsection