@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Inscription</h2>

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <label>Prénom</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}">

        <label>Nom</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}">

        <label>Téléphone</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Mot de passe</label>
        <input type="password" name="password">

        <label>Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="btn">S'inscrire</button>
    </form>
</div>
@endsection