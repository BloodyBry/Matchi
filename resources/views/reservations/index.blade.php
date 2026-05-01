@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Mes réservations</h2>
    <a href="/fields" class="btn btn-sm">Trouver un terrain</a>
</div>

@if($reservations->count())
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Terrain</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Prix</th>
                <th>Statut</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
            <tr>
                <td>
                    <div class="cell-name">{{ $r->field->name }}</div>
                    <div class="cell-sub">{{ $r->field->center->name }} · {{ $r->field->sport->name }}</div>
                </td>
                <td>{{ $r->reservation_date }}</td>
                <td>{{ $r->start_time }} – {{ $r->end_time }}</td>
                <td style="font-weight:600;">{{ $r->total_price }} MAD</td>
                <td>
                    @if($r->status === 'confirmed')
                        <span class="badge badge-green">Confirmée</span>
                    @elseif($r->status === 'cancelled')
                        <span class="badge badge-red">Annulée</span>
                    @else
                        <span class="badge badge-gray">{{ ucfirst($r->status) }}</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    @if($r->status === 'confirmed')
                        <form action="{{ route('reservations.cancel', $r->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="card empty">
    <x-icon name="calendar" :size="32" />
    <h3>Aucune réservation</h3>
    <p>Vous n'avez pas encore de réservation.</p>
    <a href="/fields" class="btn btn-sm">Explorer les terrains</a>
</div>
@endif

@endsection