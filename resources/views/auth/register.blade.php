@extends('layouts.app')

@section('content')
<div style="max-width:520px;margin:0 auto;">
    <div class="card">
        <div style="text-align:center;margin-bottom:28px;">
            <div class="icon-box icon-box--lg icon-box--green" style="margin:0 auto 14px;">
                <x-icon name="user" :size="26" />
            </div>
            <p class="section-label" style="justify-content:center;">Rejoignez Matchi</p>
            <h2 style="margin-bottom:6px;">Créer un compte</h2>
            <p style="font-size:14px;">Réservez vos terrains en quelques secondes</p>
        </div>

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="grid-2">
                <div>
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Yassine" value="{{ old('first_name') }}" required>
                </div>
                <div>
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Alami" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <label for="phone"><x-icon name="phone" :size="14" /> Téléphone</label>
            <input type="text" id="phone" name="phone" placeholder="06XXXXXXXX" value="{{ old('phone') }}">

            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="vous@exemple.com" value="{{ old('email') }}" required>

            <label for="password"><x-icon name="lock" :size="14" /> Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            <label for="password_confirmation"><x-icon name="lock" :size="14" /> Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>

            <button type="submit" class="btn" style="width:100%;justify-content:center;font-size:15px;padding:13px;margin-top:4px;">
                Créer mon compte <x-icon name="arrow-right" :size="16" />
            </button>
        </form>

        <p style="text-align:center;margin-top:20px;font-size:14px;">
            Déjà un compte ?
            <a href="/login" style="color:#16a34a;font-weight:700;text-decoration:none;">Se connecter</a>
        </p>
    </div>
</div>
@endsection