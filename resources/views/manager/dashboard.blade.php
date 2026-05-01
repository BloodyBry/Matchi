@extends('layouts.app')
@section('container-class', 'dashboard-bg')

@section('content')

<div class="page-header">
    <div>
        <h2>Dashboard Gestionnaire</h2>
        <p class="page-subtitle">Gérez vos centres, terrains et réservations.</p>
    </div>
    <a href="{{ route('manager.center.create') }}" class="btn btn-sm">
        <x-icon name="plus" :size="15" /> Nouveau centre
    </a>
</div>

{{-- Stats --}}
<div class="stats">
    <div class="stat-card">
        <div class="stat-card__label">Centres</div>
        <div class="stat-card__value">{{ $centersCount }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Terrains</div>
        <div class="stat-card__value">{{ $fieldsCount }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Réservations</div>
        <div class="stat-card__value">{{ $reservationsCount }}</div>
    </div>
    <div class="stat-card" style="border-left:3px solid #2563eb;">
        <div class="stat-card__label">Aujourd'hui</div>
        <div class="stat-card__value">{{ $todayReservations }}</div>
    </div>
</div>

{{-- Two-column layout --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

    {{-- Upcoming reservations --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="margin-bottom:0;">
                <x-icon name="calendar" :size="16" stroke="#059669" /> Réservations à venir
            </h3>
            <a href="{{ route('manager.reservations.index') }}" class="btn btn-outline btn-sm">Tout voir</a>
        </div>

        @if($upcomingReservations->count() > 0)
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($upcomingReservations as $reservation)
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--border-light);border-radius:8px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:8px;background:#ecfdf5;display:flex;align-items:center;justify-content:center;">
                                <x-icon name="clock" :size="16" stroke="#059669" />
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px;">{{ $reservation->field->name ?? 'Terrain' }}</div>
                                <div style="font-size:12px;color:var(--text-secondary);">
                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }} · {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}–{{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                </div>
                            </div>
                        </div>
                        @if($reservation->status === 'confirmed')
                            <span class="badge badge-green">Confirmée</span>
                        @elseif($reservation->status === 'pending')
                            <span class="badge badge-orange">En attente</span>
                        @else
                            <span class="badge badge-gray">{{ ucfirst($reservation->status) }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                <x-icon name="calendar" :size="32" />
                <h3>Aucune réservation à venir</h3>
                <p>Les nouvelles réservations apparaîtront ici.</p>
            </div>
        @endif
    </div>

    {{-- Recent activity --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="margin-bottom:0;">
                <x-icon name="clock" :size="16" stroke="#059669" /> Activité récente
            </h3>
        </div>

        @if($recentReservations->count() > 0)
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($recentReservations as $reservation)
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--border-light);border-radius:8px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;">
                                <x-icon name="football" :size="16" stroke="#2563eb" />
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px;">{{ $reservation->user->first_name ?? '' }} {{ $reservation->user->last_name ?? '' }}</div>
                                <div style="font-size:12px;color:var(--text-secondary);">{{ $reservation->field->name ?? 'Terrain' }} · {{ \Carbon\Carbon::parse($reservation->created_at)->diffForHumans() }}</div>
                            </div>
                        </div>
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
                @endforeach
            </div>
        @else
            <p style="text-align:center;padding:20px 0;color:var(--text-tertiary);">Aucune activité récente</p>
        @endif
    </div>
</div>

{{-- Centers overview --}}
<div class="card" style="margin-top:4px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <h3 style="margin-bottom:0;">
            <x-icon name="building" :size="16" stroke="#059669" /> Mes centres
        </h3>
        <a href="{{ route('manager.center.index') }}" class="btn btn-outline btn-sm">Gérer</a>
    </div>

    @if($centers->count() > 0)
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Ville</th>
                        <th>Terrains</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centers as $center)
                        <tr>
                            <td class="cell-name">{{ $center->name }}</td>
                            <td>{{ $center->city }}</td>
                            <td>{{ $center->fields_count }}</td>
                            <td>
                                @if($center->status === 'active')
                                    <span class="badge badge-green">Actif</span>
                                @elseif($center->status === 'pending')
                                    <span class="badge badge-orange">En attente</span>
                                @else
                                    <span class="badge badge-gray">{{ ucfirst($center->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty">
            <x-icon name="building" :size="32" />
            <h3>Aucun centre</h3>
            <p>Créez votre premier centre sportif pour commencer.</p>
            <a href="{{ route('manager.center.create') }}" class="btn btn-sm">Créer un centre</a>
        </div>
    @endif
</div>

{{-- Quick actions --}}
<div class="card" style="margin-top:4px;">
    <h3 style="margin-bottom:12px;">Actions rapides</h3>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <a href="{{ route('manager.center.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="building" :size="14" /> Mes centres
        </a>
        <a href="{{ route('manager.fields.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="layout-grid" :size="14" /> Mes terrains
        </a>
        <a href="{{ route('manager.reservations.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="calendar" :size="14" /> Réservations
        </a>
        <a href="{{ route('manager.fields.create') }}" class="btn btn-outline btn-sm">
            <x-icon name="plus" :size="14" /> Ajouter un terrain
        </a>
    </div>
</div>

@endsection