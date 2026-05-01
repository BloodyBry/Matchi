@extends('layouts.app')
@section('container-class', 'dashboard-bg')

@section('content')

<div class="page-header">
    <div>
        <h2>Dashboard Admin</h2>
        <p class="page-subtitle">Vue d'ensemble de la plateforme Matchi.</p>
    </div>
</div>

{{-- Primary stats --}}
<div class="stats">
    <div class="stat-card">
        <div class="stat-card__label">Utilisateurs</div>
        <div class="stat-card__value">{{ $usersCount }}</div>
    </div>
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
    <div class="stat-card">
        <div class="stat-card__label">Sports</div>
        <div class="stat-card__value">{{ $sportsCount }}</div>
    </div>
</div>

{{-- Secondary stats --}}
<div class="stats" style="margin-bottom:24px;">
    <div class="stat-card" style="border-left:3px solid #059669;">
        <div class="stat-card__label">Utilisateurs actifs</div>
        <div class="stat-card__value">{{ $activeUsers }}</div>
    </div>
    <div class="stat-card" style="border-left:3px solid #ea580c;">
        <div class="stat-card__label">Centres en attente</div>
        <div class="stat-card__value">{{ $pendingCenters }}</div>
    </div>
    <div class="stat-card" style="border-left:3px solid #2563eb;">
        <div class="stat-card__label">Réservations aujourd'hui</div>
        <div class="stat-card__value">{{ $todayReservations }}</div>
    </div>
</div>

{{-- Two-column layout --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

    {{-- Recent users --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="margin-bottom:0;">
                <x-icon name="users" :size="16" stroke="#059669" /> Derniers inscrits
            </h3>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">Tout voir</a>
        </div>

        @if($recentUsers->count() > 0)
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($recentUsers as $user)
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--border-light);border-radius:8px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:#ecfdf5;display:flex;align-items:center;justify-content:center;">
                                <x-icon name="user" :size="16" stroke="#059669" />
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px;">{{ $user->first_name }} {{ $user->last_name }}</div>
                                <div style="font-size:12px;color:var(--text-secondary);">{{ $user->email }}</div>
                            </div>
                        </div>
                        <span class="badge badge-{{ $user->role === 'admin' ? 'blue' : ($user->role === 'manager' ? 'orange' : 'gray') }}">{{ ucfirst($user->role) }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align:center;padding:20px 0;color:var(--text-tertiary);">Aucun utilisateur récent</p>
        @endif
    </div>

    {{-- Recent reservations --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="margin-bottom:0;">
                <x-icon name="calendar" :size="16" stroke="#059669" /> Dernières réservations
            </h3>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline btn-sm">Tout voir</a>
        </div>

        @if($recentReservations->count() > 0)
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($recentReservations as $reservation)
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--border-light);border-radius:8px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:8px;background:#ecfdf5;display:flex;align-items:center;justify-content:center;">
                                <x-icon name="football" :size="16" stroke="#059669" />
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px;">{{ $reservation->field->name ?? 'Terrain' }}</div>
                                <div style="font-size:12px;color:var(--text-secondary);">{{ $reservation->user->first_name ?? '' }} {{ $reservation->user->last_name ?? '' }} · {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}</div>
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
            <p style="text-align:center;padding:20px 0;color:var(--text-tertiary);">Aucune réservation récente</p>
        @endif
    </div>
</div>

{{-- Quick actions --}}
<div class="card" style="margin-top:4px;">
    <h3 style="margin-bottom:12px;">Actions rapides</h3>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="users" :size="14" /> Utilisateurs
        </a>
        <a href="{{ route('admin.centers.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="building" :size="14" /> Centres
        </a>
        <a href="{{ route('admin.sports.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="football" :size="14" /> Sports
        </a>
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline btn-sm">
            <x-icon name="calendar" :size="14" /> Réservations
        </a>
    </div>
</div>

@endsection