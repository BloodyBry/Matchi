@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="calendar" :size="13" /> Mes réservations</p>
        <h2>Historique de réservations</h2>
    </div>
    <a href="/fields" class="btn"><x-icon name="compass" :size="15" /> Trouver un terrain</a>
</div>

@forelse($reservations as $reservation)
    <div class="card data-row">

        {{-- Sport Icon --}}
        <div class="icon-box icon-box--lg icon-box--green">
            <x-icon name="football" :size="26" />
        </div>

        {{-- Info --}}
        <div class="data-row__info" style="min-width:180px;">
            <div class="data-row__name" style="font-size:15px;">{{ $reservation->field->name }}</div>
            <div class="data-row__sub">
                {{ $reservation->field->center->name }} ·
                <span class="badge badge-green" style="font-size:11px;margin:0;">{{ $reservation->field->sport->name }}</span>
            </div>
        </div>

        {{-- Date & Time --}}
        <div class="data-row__meta" style="text-align:center;min-width:120px;">
            <div style="font-size:13px;color:#6b7280;font-weight:600;display:flex;align-items:center;gap:5px;justify-content:center;">
                <x-icon name="calendar" :size="13" /> {{ $reservation->reservation_date }}
            </div>
            <div style="font-size:14px;font-weight:700;color:#111827;margin-top:3px;display:flex;align-items:center;gap:5px;justify-content:center;">
                <x-icon name="clock" :size="13" stroke="#6b7280" /> {{ $reservation->start_time }} – {{ $reservation->end_time }}
            </div>
        </div>

        {{-- Price --}}
        <div class="data-row__meta" style="text-align:center;min-width:90px;">
            <div class="data-row__meta-label">Prix</div>
            <div style="font-size:18px;font-weight:800;color:#16a34a;">{{ $reservation->total_price }} <span style="font-size:12px;font-weight:500;color:#6b7280;">MAD</span></div>
        </div>

        {{-- Status + Action --}}
        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;min-width:120px;">
            @if($reservation->status === 'confirmed')
                <span class="badge badge-green"><x-icon name="check-circle" :size="12" /> Confirmée</span>
                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"><x-icon name="x-circle" :size="13" /> Annuler</button>
                </form>
            @elseif($reservation->status === 'cancelled')
                <span class="badge badge-red"><x-icon name="x-circle" :size="12" /> Annulée</span>
            @else
                <span class="badge badge-gray">{{ ucfirst($reservation->status) }}</span>
            @endif
        </div>

    </div>
@empty
    <div class="card empty-state">
        <div class="empty-state__icon"><x-icon name="stadium" :size="28" /></div>
        <h3>Aucune réservation</h3>
        <p>Vous n'avez pas encore de réservation. Explorez les terrains disponibles !</p>
        <a href="/fields" class="btn"><x-icon name="compass" :size="15" /> Explorer les terrains</a>
    </div>
@endforelse

@endsection