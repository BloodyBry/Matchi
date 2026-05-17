@extends('layouts.app')
@section('container-class', 'dashboard-bg')
@section('content')

<div class="page-header">
    <div>
        <h2>Bienvenue</h2>
        <p class="page-subtitle">Voici un aperçu de votre activité sur Matchi.</p>
    </div>
    <a href="/fields" class="btn btn-sm">
        <x-icon name="search" :size="15" /> Réserver un terrain
    </a>
</div>

{{-- Stats --}}
<div class="stats">
    <div class="stat-card">
        <div class="stat-card__label">Total réservations</div>
        <div class="stat-card__value">{{ $totalReservations }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">À venir</div>
        <div class="stat-card__value">{{ $upcomingReservations->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Terminées</div>
        <div class="stat-card__value">{{ $completedReservations }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Annulées</div>
        <div class="stat-card__value">{{ $cancelledReservations }}</div>
    </div>
</div>

{{-- Two-column layout --}}
<div class="grid-2" style="grid-template-columns: 1fr 1fr; gap: 16px;">

    {{-- Upcoming reservations --}}
    <div class="card" style="grid-column: 1 / -1;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="margin-bottom:0;">
                <x-icon name="calendar" :size="16" stroke="#059669" /> Prochaines réservations
            </h3>
            <a href="/my-reservations" class="btn btn-outline btn-sm">Tout voir</a>
        </div>

        @if($upcomingReservations->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Terrain</th>
                            <th>Date</th>
                            <th>Horaire</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingReservations as $reservation)
                            <tr>
                                <td class="cell-name">{{ $reservation->field->name ?? '—' }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</td>
                                <td>
                                    @if($reservation->status === 'confirmed')
                                        <span class="badge badge-green">Confirmée</span>
                                    @elseif($reservation->status === 'pending')
                                        <span class="badge badge-orange">En attente</span>
                                    @else
                                        <span class="badge badge-gray">{{ ucfirst($reservation->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">
                <x-icon name="calendar" :size="32" />
                <h3>Aucune réservation à venir</h3>
                <p>Explorez les terrains disponibles et réservez votre prochain match.</p>
                <a href="/fields" class="btn btn-sm">Explorer les terrains</a>
            </div>
        @endif
    </div>
</div>

{{-- Recent activity --}}
<div class="card" style="margin-top:4px;">
    <h3 style="margin-bottom:16px;">
        <x-icon name="clock" :size="16" stroke="#059669" /> Activité récente
    </h3>

    @if($recentReservations->count() > 0)
        <div style="display:flex;flex-direction:column;gap:12px;">
            @foreach($recentReservations as $reservation)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--border-light);border-radius:8px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:36px;height:36px;border-radius:8px;background:#ecfdf5;display:flex;align-items:center;justify-content:center;">
                            <x-icon name="football" :size="16" stroke="#059669" />
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:14px;">{{ $reservation->field->name ?? 'Terrain' }}</div>
                            <div style="font-size:12px;color:var(--text-secondary);">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        @if($reservation->status === 'confirmed')
                            <span class="badge badge-green">Confirmée</span>
                        @elseif($reservation->status === 'pending')
                            <span class="badge badge-orange">En attente</span>
                        @elseif($reservation->status === 'cancelled')
                            <span class="badge badge-red">Annulée</span>
                        @else
                            <span class="badge badge-gray">{{ ucfirst($reservation->status) }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p style="text-align:center;padding:20px 0;color:var(--text-tertiary);">Aucune activité récente</p>
    @endif
</div>

{{-- Quick actions --}}
<div class="card" style="margin-top:4px;">
    <h3 style="margin-bottom:12px;">Actions rapides</h3>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <a href="/fields" class="btn btn-outline btn-sm">
            <x-icon name="search" :size="14" /> Trouver un terrain
        </a>
        <a href="/my-reservations" class="btn btn-outline btn-sm">
            <x-icon name="clipboard" :size="14" /> Mes réservations
        </a>
    </div>
</div>

@endsection