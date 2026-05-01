@extends('layouts.app')
@section('container-class', 'dashboard-bg')

@section('content')

<div style="margin-bottom:32px;">
    <h1 style="font-size:32px;margin-bottom:8px;">Réservez votre terrain<br>de sport en ligne</h1>
    <p style="font-size:16px;max-width:520px;margin-bottom:20px;">
        Trouvez et réservez des terrains de football, padel, tennis et plus encore, dans les meilleurs centres sportifs.
    </p>
    <div style="display:flex;gap:8px;flex-wrap:wrap;">
        <a href="/fields" class="btn">Explorer les terrains</a>
        @if(!session()->has('user_id'))
            <a href="/register" class="btn btn-outline">Créer un compte</a>
        @endif
    </div>
</div>

<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));">
    <div class="card">
        <h3>Réservation rapide</h3>
        <p>Choisissez une date, consultez les créneaux et réservez instantanément.</p>
    </div>
    <div class="card">
        <h3>Centres sportifs</h3>
        <p>Les gestionnaires gèrent leurs terrains, horaires et réservations facilement.</p>
    </div>
    <div class="card">
        <h3>Mobile friendly</h3>
        <p>Interface pensée pour tous les écrans. Réservez depuis n'importe où.</p>
    </div>
</div>

@endsection