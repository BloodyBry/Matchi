@extends('layouts.app')

@section('content')
<div style="max-width:640px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="stadium" :size="13" /> Gestion</p>
            <h2>Ajouter un terrain</h2>
        </div>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        @if($centers->count() === 0)
            <div class="empty-state">
                <div class="empty-state__icon"><x-icon name="building" :size="28" /></div>
                <h3>Aucun centre sportif</h3>
                <p>Vous devez d'abord créer un centre sportif.</p>
                <a href="{{ route('manager.center.create') }}" class="btn"><x-icon name="plus" :size="15" /> Créer un centre</a>
            </div>
        @else
            <form action="{{ route('manager.fields.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid-2">
                    <div>
                        <label for="center_id"><x-icon name="building" :size="14" /> Centre</label>
                        <select id="center_id" name="center_id">
                            @foreach($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sport_id"><x-icon name="football" :size="14" /> Sport</label>
                        <select id="sport_id" name="sport_id">
                            @foreach($sports as $sport)
                                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label for="name">Nom du terrain</label>
                <input type="text" id="name" name="name" placeholder="Ex: Terrain A - Gazon synthétique" value="{{ old('name') }}" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Décrivez le terrain...">{{ old('description') }}</textarea>

                <div class="grid-2">
                    <div>
                        <label for="price_per_hour"><x-icon name="dollar" :size="14" /> Prix par heure (MAD)</label>
                        <input type="number" step="0.01" id="price_per_hour" name="price_per_hour" placeholder="Ex: 150" value="{{ old('price_per_hour') }}" required>
                    </div>
                    <div>
                        <label for="capacity"><x-icon name="users" :size="14" /> Capacité</label>
                        <input type="number" id="capacity" name="capacity" placeholder="Ex: 10" value="{{ old('capacity') }}" required>
                    </div>
                </div>

                <label for="status"><x-icon name="tag" :size="14" /> Statut</label>
                <select id="status" name="status">
                    <option value="available">Disponible</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="unavailable">Indisponible</option>
                </select>

                <label for="image">Image du terrain</label>
                <input type="file" id="image" name="image" accept="image/*">

                <div style="display:flex;gap:12px;margin-top:8px;">
                    <button type="submit" class="btn" style="flex:1;justify-content:center;"><x-icon name="check-circle" :size="15" /> Créer le terrain</button>
                    <a href="{{ route('manager.fields.index') }}" class="btn btn-outline" style="flex:1;justify-content:center;text-align:center;">Annuler</a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection