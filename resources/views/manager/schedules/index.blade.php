@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Horaires du terrain : {{ $field->name }}</h2>
</div>

<div class="card">
    <h3>Ajouter un horaire</h3>

    <form action="{{ route('manager.schedules.store', $field->id) }}" method="POST">
        @csrf

        <label>Jour</label>
        <select name="day_of_week">
            <option value="monday">Lundi</option>
            <option value="tuesday">Mardi</option>
            <option value="wednesday">Mercredi</option>
            <option value="thursday">Jeudi</option>
            <option value="friday">Vendredi</option>
            <option value="saturday">Samedi</option>
            <option value="sunday">Dimanche</option>
        </select>

        <label>Heure début</label>
        <input type="time" name="start_time">

        <label>Heure fin</label>
        <input type="time" name="end_time">

        <label>Ouvert ?</label>
        <select name="is_open">
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>

        <button type="submit" class="btn">Ajouter</button>
    </form>
</div>

@forelse($field->schedules as $schedule)
    <div class="card">
        <p><strong>Jour :</strong> {{ $schedule->day_of_week }}</p>
        <p><strong>Horaire :</strong> {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
        <p><strong>Ouvert :</strong> {{ $schedule->is_open ? 'Oui' : 'Non' }}</p>

        <form action="{{ route('manager.schedules.delete', $schedule->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@empty
    <div class="card">
        <p>Aucun horaire trouvé.</p>
    </div>
@endforelse
@endsection