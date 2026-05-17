@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Mes centres sportifs</h2>
    <a href="{{ route('manager.center.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Nouveau centre</a>
</div>

@if($centers->count())
<div class="grid" style="grid-template-columns:repeat(auto-fill,minmax(320px,1fr));">
    @foreach($centers as $center)
    <div class="card" style="padding:0;overflow:hidden;">
        {{-- Center image --}}
        <div style="position:relative;height:180px;background:var(--border-light);">
            @if($center->image)
                <img src="{{ asset('storage/' . $center->image) }}" alt="{{ $center->name }}" style="width:100%;height:100%;object-fit:cover;display:block;">
            @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#ecfdf5,#d1fae5);">
                    <x-icon name="building" :size="40" stroke="#059669" />
                </div>
            @endif
            @if($center->status === 'active')
                <span class="badge badge-green" style="position:absolute;top:12px;right:12px;">Actif</span>
            @elseif($center->status === 'pending')
                <span class="badge badge-orange" style="position:absolute;top:12px;right:12px;">En attente</span>
            @endif
        </div>

        {{-- Center info --}}
        <div style="padding:20px;">
            <h3 style="margin-bottom:4px;font-size:17px;">{{ $center->name }}</h3>
            <p style="font-size:13px;color:var(--text-secondary);margin-bottom:12px;display:flex;align-items:center;gap:4px;">
                <x-icon name="map-pin" :size="13" stroke="#9ca3af" /> {{ $center->city }} · {{ $center->address }}
            </p>

            <div style="display:flex;gap:16px;margin-bottom:16px;font-size:13px;color:var(--text-secondary);">
                @if($center->phone)
                <span style="display:flex;align-items:center;gap:4px;">
                    <x-icon name="phone" :size="13" stroke="#9ca3af" /> {{ $center->phone }}
                </span>
                @endif
                <span style="display:flex;align-items:center;gap:4px;">
                    <x-icon name="clock" :size="13" stroke="#9ca3af" /> {{ $center->opening_time }} – {{ $center->closing_time }}
                </span>
            </div>

            <div style="display:flex;gap:8px;">
                <a href="{{ route('manager.center.edit', $center->id) }}" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">
                    <x-icon name="edit" :size="13" /> Modifier
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card empty">
    <x-icon name="building" :size="32" />
    <h3>Aucun centre</h3>
    <p>Créez votre premier centre sportif.</p>
    <a href="{{ route('manager.center.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Nouveau centre</a>
</div>
@endif

@endsection