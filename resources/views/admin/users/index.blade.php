@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <p class="section-label"><x-icon name="users" :size="13" /> Administration</p>
        <h2>Gestion des utilisateurs</h2>
    </div>
</div>

@forelse($users as $user)
    <div class="card data-row">

        {{-- Avatar --}}
        <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#16a34a,#22c55e);color:#fff;font-size:17px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            {{ strtoupper(substr($user->first_name, 0, 1)) }}
        </div>

        {{-- Name & Email --}}
        <div class="data-row__info">
            <div class="data-row__name">{{ $user->first_name }} {{ $user->last_name }}</div>
            <div class="data-row__sub">{{ $user->email }}</div>
        </div>

        {{-- Phone --}}
        <div class="data-row__meta">
            <div class="data-row__meta-label">Téléphone</div>
            <div class="data-row__meta-value">{{ $user->phone ?? '—' }}</div>
        </div>

        {{-- Role --}}
        <div>
            @if($user->role === 'admin')
                <span class="badge badge-blue"><x-icon name="shield" :size="12" /> Admin</span>
            @elseif($user->role === 'manager')
                <span class="badge badge-orange"><x-icon name="building" :size="12" /> Manager</span>
            @else
                <span class="badge badge-gray"><x-icon name="user" :size="12" /> Utilisateur</span>
            @endif
        </div>

        {{-- Status --}}
        <div>
            @if($user->status === 'active')
                <span class="badge badge-green"><x-icon name="check-circle" :size="12" /> Actif</span>
            @else
                <span class="badge badge-red"><x-icon name="ban" :size="12" /> Bloqué</span>
            @endif
        </div>

        {{-- Actions --}}
        @if($user->role !== 'admin')
        <div class="data-row__actions">
            <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : '' }}">
                    @if($user->status === 'active')
                        <x-icon name="ban" :size="13" /> Bloquer
                    @else
                        <x-icon name="check-circle" :size="13" /> Activer
                    @endif
                </button>
            </form>
            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet utilisateur ?')"><x-icon name="trash" :size="13" /></button>
            </form>
        </div>
        @endif
    </div>
@empty
    <div class="card empty-state">
        <div class="empty-state__icon"><x-icon name="users" :size="28" /></div>
        <h3>Aucun utilisateur</h3>
        <p>Aucun utilisateur inscrit pour le moment.</p>
    </div>
@endforelse

@endsection