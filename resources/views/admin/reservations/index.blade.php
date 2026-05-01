@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Toutes les réservations</h2>
</div>

@if($reservations->count())
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Terrain</th>
                <th>Client</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Prix</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
            <tr>
                <td>
                    <div class="cell-name">{{ $r->field->name }}</div>
                    <div class="cell-sub">{{ $r->field->center->name }} · {{ $r->field->sport->name }}</div>
                </td>
                <td>{{ $r->user->first_name }} {{ $r->user->last_name }}</td>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="card empty">
    <x-icon name="clipboard" :size="32" />
    <h3>Aucune réservation</h3>
</div>
@endif

@endsection