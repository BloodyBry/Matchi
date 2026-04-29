@extends('layouts.app')

@section('content')
<div style="max-width:440px;margin:0 auto;">
    <div class="card">
        <div style="text-align:center;margin-bottom:28px;">
            <div class="icon-box icon-box--lg icon-box--green" style="margin:0 auto 14px;">
                <x-icon name="lock" :size="26" />
            </div>
            <p class="section-label" style="justify-content:center;">Bienvenue</p>
            <h2 style="margin-bottom:6px;">Connexion</h2>
            <p style="font-size:14px;">Accédez à votre espace Matchi</p>
        </div>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="vous@exemple.com" value="{{ old('email') }}" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            <button type="submit" class="btn" style="width:100%;justify-content:center;font-size:15px;padding:13px;">
                Se connecter <x-icon name="arrow-right" :size="16" />
            </button>
        </form>

        <p style="text-align:center;margin-top:20px;font-size:14px;">
            Pas encore de compte ?
            <a href="/register" style="color:#16a34a;font-weight:700;text-decoration:none;">Créer un compte</a>
        </p>
    </div>
</div>
@endsection