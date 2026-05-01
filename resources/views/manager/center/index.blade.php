@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Mes centres sportifs</h2>
    <a href="{{ route('manager.center.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Nouveau centre</a>
</div>

@if($centers->count())
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Centre</th>
                <th>Téléphone</th>
                <th>Horaires</th>
                <th>Statut</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centers as $center)
            <tr>
                <td>
                    <div class="cell-name">{{ $center->name }}</div>
                    <div class="cell-sub">{{ $center->city }} · {{ $center->address }}</div>
                </td>
                <td>{{ $center->phone }}</td>
                <td>{{ $center->opening_time }} – {{ $center->closing_time }}</td>
                <td>
                    @if($center->status === 'active')
                        <span class="badge badge-green">Actif</span>
                    @else
                        <span class="badge badge-red">Inactif</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <a href="{{ route('manager.center.edit', $center->id) }}" class="btn btn-outline btn-sm">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="card empty">
    <x-icon name="building" :size="32" />
    <h3>Aucun centre</h3>
    <p>Créez votre premier centre sportif.</p>
    <a href="{{ route('manager.center.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Nouveau centre</a>
</div>
@endif

@endsection