@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="clipboard" :size="13" /> Administration</p>
        <h2>Toutes les réservations</h2>
    </div>
</div>

@forelse($reservations as $reservation)
    <div class="card data-row">
        <div class="icon-box icon-box--md icon-box--green">
            <x-icon name="calendar" :size="22" />
        </div>

        <div class="data-row__info">
            <div class="data-row__name">{{ $reservation->field->name }}</div>
            <div class="data-row__sub"><x-icon name="building" :size="13" /> {{ $reservation->field->center->name }} · <span class="badge badge-green" style="font-size:11px;margin:0;">{{ $reservation->field->sport->name }}</span></div>
        </div>

        <div class="data-row__meta">
            <div class="data-row__meta-label">Client</div>
            <div class="data-row__meta-value">{{ $reservation->user->first_name }} {{ $reservation->user->last_name }}</div>
        </div>

        <div class="data-row__meta">
            <div class="data-row__meta-label">Date & Horaire</div>
            <div class="data-row__meta-value" style="display:flex;align-items:center;gap:4px;">
                <x-icon name="calendar" :size="12" stroke="#9ca3af" /> {{ $reservation->reservation_date }}
            </div>
            <div style="font-size:12px;color:#6b7280;display:flex;align-items:center;gap:4px;margin-top:2px;">
                <x-icon name="clock" :size="12" stroke="#9ca3af" /> {{ $reservation->start_time }} – {{ $reservation->end_time }}
            </div>
        </div>

        <div class="data-row__meta" style="min-width:80px;">
            <div class="data-row__meta-label">Prix</div>
            <div style="font-size:16px;font-weight:800;color:#16a34a;">{{ $reservation->total_price }} <span style="font-size:11px;color:#6b7280;font-weight:500;">MAD</span></div>
        </div>

        <div>
            @if($reservation->status === 'confirmed')
                <span class="badge badge-green"><x-icon name="check-circle" :size="12" /> Confirmée</span>
            @elseif($reservation->status === 'cancelled')
                <span class="badge badge-red"><x-icon name="x-circle" :size="12" /> Annulée</span>
            @else
                <span class="badge badge-gray">{{ ucfirst($reservation->status) }}</span>
            @endif
        </div>
    </div>
@empty
    <div class="card empty-state">
        <div class="empty-state__icon"><x-icon name="clipboard" :size="28" /></div>
        <h3>Aucune réservation trouvée</h3>
        <p>Aucune réservation n'a été effectuée pour le moment.</p>
    </div>
@endforelse

@endsection