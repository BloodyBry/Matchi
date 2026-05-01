@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Terrains disponibles</h2>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:20px;">
    <form method="GET" action="{{ route('fields.index') }}" style="display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
        <div style="flex:1;min-width:160px;">
            <label for="sport_id">Sport</label>
            <select id="sport_id" name="sport_id" style="margin-bottom:0;">
                <option value="">Tous</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="flex:1;min-width:160px;">
            <label for="city">Ville</label>
            <input type="text" id="city" name="city" placeholder="Ex: Casablanca" value="{{ request('city') }}" style="margin-bottom:0;">
        </div>
        <button class="btn" type="submit" style="height:38px;">Filtrer</button>
    </form>
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
                <span class="badge badge-gray">{{ $field->center->city }}</span>
            </div>
            <h3 style="margin-bottom:4px;">{{ $field->name }}</h3>
            <p style="font-size:13px;flex:1;">{{ $field->center->name }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;">
                <div><span style="font-size:18px;font-weight:700;color:var(--primary);">{{ $field->price_per_hour }}</span> <span style="font-size:13px;color:#6b7280;">MAD/h</span></div>
                <a href="{{ route('fields.show', $field->id) }}" class="btn btn-sm">Voir</a>
            </div>
        </div>
    </div>
@empty
    <div class="card empty" style="grid-column:1/-1;">
        <x-icon name="stadium" :size="32" />
        <h3>Aucun terrain trouvé</h3>
        <p>Essayez d'autres filtres.</p>
    </div>
@endforelse
</div>

<style>
.field-card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; display:flex; flex-direction:column; }
.field-card__img { position:relative; height:180px; overflow:hidden; background:#f9fafb; }
.field-card__img img { width:100%; height:100%; object-fit:cover; }
.field-card__placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#d1d5db; }
.field-card__badge { position:absolute; top:8px; right:8px; padding:3px 10px; border-radius:6px; font-size:12px; font-weight:500; }
.field-card__badge--green { background:#059669; color:#fff; }
.field-card__badge--amber { background:#d97706; color:#fff; }
.field-card__badge--red { background:#dc2626; color:#fff; }
.field-card__body { padding:16px; display:flex; flex-direction:column; flex:1; }
</style>

@endsection