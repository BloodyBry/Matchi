@extends('layouts.app')

@section('content')
<div style="max-width:600px;margin:0 auto;">
    <div class="page-header">
        <h2>Horaires — {{ $field->name }}</h2>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm">Retour</a>
    </div>

    <div class="card">
        <h3>Ajouter un horaire</h3>
        <form action="{{ route('manager.schedules.store', $field->id) }}" method="POST">
            @csrf
            <div class="form-row">
                <div>
                    <label for="day_of_week">Jour</label>
                    <select id="day_of_week" name="day_of_week">
                        <option value="monday">Lundi</option><option value="tuesday">Mardi</option><option value="wednesday">Mercredi</option>
                        <option value="thursday">Jeudi</option><option value="friday">Vendredi</option><option value="saturday">Samedi</option><option value="sunday">Dimanche</option>
                    </select>
                </div>
                <div>
                    <label for="is_open">Ouvert ?</label>
                    <select id="is_open" name="is_open"><option value="1">Oui</option><option value="0">Non</option></select>
                </div>
            </div>
            <div class="form-row">
                <div><label for="start_time">Début</label><input type="time" id="start_time" name="start_time"></div>
                <div><label for="end_time">Fin</label><input type="time" id="end_time" name="end_time"></div>
            </div>
            <button type="submit" class="btn" style="width:100%;justify-content:center;">Ajouter</button>
        </form>
    </div>

    @if($field->schedules->count())
    <div class="table-wrap">
        <table>
            <thead><tr><th>Jour</th><th>Horaire</th><th>Statut</th><th style="text-align:right;">Action</th></tr></thead>
            <tbody>
                @foreach($field->schedules as $s)
                <tr>
                    <td class="cell-name">{{ ucfirst($s->day_of_week) }}</td>
                    <td>{{ $s->start_time }} – {{ $s->end_time }}</td>
                    <td>
                        @if($s->is_open)<span class="badge badge-green">Ouvert</span>
                        @else <span class="badge badge-gray">Fermé</span>@endif
                    </td>
                    <td style="text-align:right;">
                        <form action="{{ route('manager.schedules.delete', $s->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')"><x-icon name="trash" :size="13" /></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="card empty">
        <h3>Aucun horaire</h3>
        <p>Ajoutez des horaires ci-dessus.</p>
    </div>
    @endif
</div>
@endsection