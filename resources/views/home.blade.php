@extends('layouts.app')

@section('content')
<div class="card" style="background: linear-gradient(135deg, #eff6ff, #ffffff);">
    <h1>Book your game with Matchi</h1>
    <p>
        Réservez facilement des terrains sportifs près de chez vous :
        football, padel, tennis et plus encore.
    </p>

    <a href="/fields" class="btn">Explorer les terrains</a>

    @if(!session()->has('user_id'))
        <a href="/register" class="btn" style="background:#0f172a;margin-left:10px;">Créer un compte</a>
    @endif
</div>

<div class="grid">
    <div class="card">
        <h3>Réservation rapide</h3>
        <p>Choisissez une date, consultez les créneaux disponibles et réservez en quelques clics.</p>
    </div>

    <div class="card">
        <h3>Centres sportifs</h3>
        <p>Les gestionnaires peuvent gérer leurs terrains, horaires et réservations facilement.</p>
    </div>

    <div class="card">
        <h3>Expérience mobile</h3>
        <p>Une interface responsive pensée pour ordinateur, tablette et smartphone.</p>
    </div>
</div>
@endsection