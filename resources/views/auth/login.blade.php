@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Connexion</h2>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Mot de passe</label>
        <input type="password" name="password">

        <button type="submit" class="btn">Se connecter</button>
    </form>
</div>
@endsection