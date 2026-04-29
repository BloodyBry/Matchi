@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="settings" :size="13" /> Administration</p>
        <h2>Dashboard Admin</h2>
    </div>
</div>

{{-- Stats Grid --}}
<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-card__icon icon-box icon-box--md icon-box--green">
            <x-icon name="users" :size="22" />
        </div>
        <div class="stat-value">{{ $usersCount }}</div>
        <div class="stat-label">Utilisateurs</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon icon-box icon-box--md icon-box--blue">
            <x-icon name="building" :size="22" />
        </div>
        <div class="stat-value">{{ $centersCount }}</div>
        <div class="stat-label">Centres sportifs</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon icon-box icon-box--md icon-box--amber">
            <x-icon name="stadium" :size="22" />
        </div>
        <div class="stat-value">{{ $fieldsCount }}</div>
        <div class="stat-label">Terrains</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon icon-box icon-box--md icon-box--green">
            <x-icon name="clipboard" :size="22" />
        </div>
        <div class="stat-value">{{ $reservationsCount }}</div>
        <div class="stat-label">Réservations</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon icon-box icon-box--md icon-box--red">
            <x-icon name="football" :size="22" />
        </div>
        <div class="stat-value">{{ $sportsCount }}</div>
        <div class="stat-label">Sports</div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="card">
    <p class="section-label"><x-icon name="zap" :size="12" /> Gestion</p>
    <h3 style="margin-bottom:18px;">Actions rapides</h3>
    <div style="display:flex;flex-wrap:wrap;gap:10px;">
        <a href="{{ route('admin.users.index') }}" class="btn"><x-icon name="users" :size="15" /> Utilisateurs</a>
        <a href="{{ route('admin.centers.index') }}" class="btn"><x-icon name="building" :size="15" /> Centres</a>
        <a href="{{ route('admin.sports.index') }}" class="btn"><x-icon name="football" :size="15" /> Sports</a>
        <a href="{{ route('admin.reservations.index') }}" class="btn"><x-icon name="clipboard" :size="15" /> Réservations</a>
    </div>
</div>

<style>
.stat-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px 20px;
    text-align: center;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    transition: transform .18s, box-shadow .18s;
}
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.07); }
.stat-card__icon { margin: 0 auto 12px; }
.stat-value { font-size: 32px; font-weight: 800; color: #16a34a; line-height: 1; margin-bottom: 6px; }
.stat-label { font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: .6px; }
</style>

@endsection