@extends('layouts.app')

@section('content')
<div style="max-width:640px;margin:0 auto;">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <p class="section-label"><x-icon name="clock" :size="13" /> Gestion</p>
            <h2>Horaires : {{ $field->name }}</h2>
        </div>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-right" :size="13" style="transform:rotate(180deg)" /> Retour</a>
    </div>

    <div class="card">
        <h3 style="display:flex;align-items:center;gap:8px;"><x-icon name="plus" :size="17" stroke="#16a34a" /> Ajouter un horaire</h3>
        <form action="{{ route('manager.schedules.store', $field->id) }}" method="POST">
            @csrf
            <div class="grid-2">
                <div>
                    <label for="day_of_week">Jour</label>
                    <select id="day_of_week" name="day_of_week">
                        <option value="monday">Lundi</option>
                        <option value="tuesday">Mardi</option>
                        <option value="wednesday">Mercredi</option>
                        <option value="thursday">Jeudi</option>
                        <option value="friday">Vendredi</option>
                        <option value="saturday">Samedi</option>
                        <option value="sunday">Dimanche</option>
                    </select>
                </div>
                <div>
                    <label for="is_open">Ouvert ?</label>
                    <select id="is_open" name="is_open">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
            </div>
            <div class="grid-2">
                <div>
                    <label for="start_time"><x-icon name="clock" :size="14" /> Heure début</label>
                    <input type="time" id="start_time" name="start_time">
                </div>
                <div>
                    <label for="end_time"><x-icon name="clock" :size="14" /> Heure fin</label>
                    <input type="time" id="end_time" name="end_time">
                </div>
            </div>
            <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="plus" :size="15" /> Ajouter</button>
        </form>
    </div>

    @forelse($field->schedules as $schedule)
        <div class="card data-row">
            <div class="icon-box icon-box--sm {{ $schedule->is_open ? 'icon-box--green' : 'icon-box--red' }}">
                <x-icon name="clock" :size="16" />
            </div>
            <div class="data-row__info">
                <div class="data-row__name">{{ ucfirst($schedule->day_of_week) }}</div>
                <div class="data-row__sub">{{ $schedule->start_time }} – {{ $schedule->end_time }}</div>
            </div>
            <div>
                @if($schedule->is_open)
                    <span class="badge badge-green"><x-icon name="check-circle" :size="12" /> Ouvert</span>
                @else
                    <span class="badge badge-red"><x-icon name="x-circle" :size="12" /> Fermé</span>
                @endif
            </div>
            <div class="data-row__actions">
                <form action="{{ route('manager.schedules.delete', $schedule->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet horaire ?')"><x-icon name="trash" :size="13" /></button>
                </form>
            </div>
        </div>
    @empty
        <div class="card empty-state">
            <div class="empty-state__icon"><x-icon name="clock" :size="28" /></div>
            <h3>Aucun horaire</h3>
            <p>Ajoutez des horaires pour ce terrain.</p>
        </div>
    @endforelse
</div>
@endsection