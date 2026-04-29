@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="building" :size="13" /> Gestion</p>
        <h2>Mes centres sportifs</h2>
    </div>
    <a href="{{ route('manager.center.create') }}" class="btn"><x-icon name="plus" :size="15" /> Ajouter un centre</a>
</div>

<div class="grid">
@forelse($centers as $center)
    <div class="card" style="padding:0;overflow:hidden;">
        @if($center->image)
            <img src="{{ asset('storage/' . $center->image) }}"
                 style="width:100%;height:180px;object-fit:cover;">
        @else
            <div style="width:100%;height:180px;background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;color:#16a34a;">
                <x-icon name="building" :size="48" />
            </div>
        @endif

        <div style="padding:20px;">
            <h3 style="margin-bottom:12px;">{{ $center->name }}</h3>

            <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:16px;">
                <div style="font-size:13px;color:#6b7280;display:flex;align-items:center;gap:6px;">
                    <x-icon name="map-pin" :size="14" stroke="#9ca3af" /> {{ $center->city }} · {{ $center->address }}
                </div>
                <div style="font-size:13px;color:#6b7280;display:flex;align-items:center;gap:6px;">
                    <x-icon name="phone" :size="14" stroke="#9ca3af" /> {{ $center->phone }}
                </div>
                <div style="font-size:13px;color:#6b7280;display:flex;align-items:center;gap:6px;">
                    <x-icon name="clock" :size="14" stroke="#9ca3af" /> {{ $center->opening_time }} – {{ $center->closing_time }}
                </div>
            </div>

            @if($center->status === 'active')
                <span class="badge badge-green" style="margin-bottom:12px;"><x-icon name="check-circle" :size="12" /> Actif</span>
            @else
                <span class="badge badge-red" style="margin-bottom:12px;"><x-icon name="x-circle" :size="12" /> Inactif</span>
            @endif

            <div style="margin-top:4px;">
                <a href="{{ route('manager.center.edit', $center->id) }}" class="btn btn-sm"><x-icon name="edit" :size="13" /> Modifier</a>
            </div>
        </div>
    </div>
@empty
    <div class="card empty-state" style="grid-column:1/-1;">
        <div class="empty-state__icon"><x-icon name="building" :size="28" /></div>
        <h3>Aucun centre trouvé</h3>
        <p>Créez votre premier centre sportif pour commencer.</p>
        <a href="{{ route('manager.center.create') }}" class="btn"><x-icon name="plus" :size="15" /> Ajouter un centre</a>
    </div>
@endforelse
</div>

@endsection