@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="clipboard" :size="13" /> Gestion</p>
        <h2>Réservations de mes terrains</h2>
    </div>
</div>

@forelse($reservations as $reservation)
    <div class="card data-row">

        <div class="icon-box icon-box--md icon-box--green">
            <x-icon name="football" :size="22" />
        </div>

        <div class="data-row__info" style="min-width:160px;">
            <div class="data-row__name">{{ $reservation->field->name }}</div>
            <div class="data-row__sub">
                <span class="badge badge-green" style="font-size:11px;margin:0;">{{ $reservation->field->sport->name }}</span>
            </div>
        </div>

        <div class="data-row__meta" style="min-width:140px;">
            <div class="data-row__meta-label">Client</div>
            <div class="data-row__meta-value">
                {{ $reservation->user->first_name }} {{ $reservation->user->last_name }}
            </div>
        </div>

        <div class="data-row__meta" style="text-align:center;min-width:120px;">
            <div style="font-size:12px;color:#9ca3af;font-weight:600;display:flex;align-items:center;gap:4px;">
                <x-icon name="calendar" :size="12" /> {{ $reservation->reservation_date }}
            </div>
            <div style="font-size:13px;font-weight:700;color:#111827;margin-top:2px;display:flex;align-items:center;gap:4px;">
                <x-icon name="clock" :size="12" stroke="#6b7280" /> {{ $reservation->start_time }} – {{ $reservation->end_time }}
            </div>
        </div>

        <div class="data-row__meta" style="text-align:center;min-width:80px;">
            <div class="data-row__meta-label">Prix</div>
            <div style="font-size:17px;font-weight:800;color:#16a34a;">{{ $reservation->total_price }} <span style="font-size:11px;color:#6b7280;font-weight:500;">MAD</span></div>
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
        <h3>Aucune réservation</h3>
        <p>Aucune réservation sur vos terrains pour le moment.</p>
    </div>
@endforelse

@endsection