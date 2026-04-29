@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="building" :size="13" /> Administration</p>
        <h2>Gestion des centres sportifs</h2>
    </div>
</div>

@forelse($centers as $center)
    <div class="card data-row">

        {{-- Icon --}}
        <div class="icon-box icon-box--md icon-box--green">
            <x-icon name="building" :size="22" />
        </div>

        {{-- Name & Address --}}
        <div class="data-row__info">
            <div class="data-row__name">{{ $center->name }}</div>
            <div class="data-row__sub"><x-icon name="map-pin" :size="13" /> {{ $center->address }}, {{ $center->city }}</div>
        </div>

        {{-- Manager --}}
        <div class="data-row__meta">
            <div class="data-row__meta-label">Manager</div>
            <div class="data-row__meta-value">
                {{ $center->manager->first_name }} {{ $center->manager->last_name }}
            </div>
        </div>

        {{-- Phone --}}
        <div class="data-row__meta">
            <div class="data-row__meta-label">Téléphone</div>
            <div class="data-row__meta-value">{{ $center->phone ?? '—' }}</div>
        </div>

        {{-- Status --}}
        <div>
            @if($center->status === 'active')
                <span class="badge badge-green"><x-icon name="check-circle" :size="13" /> Actif</span>
            @else
                <span class="badge badge-red"><x-icon name="x-circle" :size="13" /> Inactif</span>
            @endif
        </div>

        {{-- Actions --}}
        <div class="data-row__actions">
            <form action="{{ route('admin.centers.status', $center->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline"><x-icon name="refresh" :size="13" /> Statut</button>
            </form>
            <form action="{{ route('admin.centers.delete', $center->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce centre ?')"><x-icon name="trash" :size="13" /></button>
            </form>
        </div>

    </div>
@empty
    <div class="card empty-state">
        <div class="empty-state__icon"><x-icon name="building" :size="28" /></div>
        <h3>Aucun centre sportif</h3>
        <p>Aucun centre n'a été créé pour le moment.</p>
    </div>
@endforelse

@endsection