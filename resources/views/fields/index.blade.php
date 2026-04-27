@extends('layouts.app')

@section('content')

<div class="card">
    <h2>Trouver un terrain</h2>

    <form method="GET" class="grid">
        <div>
            <label>Sport</label>
            <select name="sport_id">
                <option value="">Tous</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}">
                        {{ $sport->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Ville</label>
            <input type="text" name="city" placeholder="Ex: Casablanca">
        </div>

        <div style="display:flex; align-items:flex-end;">
            <button class="btn">Filtrer</button>
        </div>
    </form>
</div>

<div class="grid">
@forelse($fields as $field)
    <div class="card">
        <h3>{{ $field->name }}</h3>

        <span class="badge">{{ $field->sport->name }}</span>
        <span class="badge">{{ $field->center->city }}</span>

        <p><strong>Centre :</strong> {{ $field->center->name }}</p>
        <p><strong>Prix :</strong> {{ $field->price_per_hour }} MAD / heure</p>

        <p>
            <strong>Statut :</strong>
            @if($field->status === 'available')
                <span style="color:green;font-weight:bold;">Disponible</span>
            @elseif($field->status === 'maintenance')
                <span style="color:orange;font-weight:bold;">Maintenance</span>
            @else
                <span style="color:red;font-weight:bold;">Indisponible</span>
            @endif
        </p>

        <a href="{{ route('fields.show', $field->id) }}" class="btn">
            Voir le terrain
        </a>
    </div>
@empty
    <div class="card">
        <p>Aucun terrain trouvé.</p>
    </div>
@endforelse
</div>

@endsection