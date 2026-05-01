@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Utilisateurs</h2>
</div>

@if($users->count())
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Téléphone</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div class="cell-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                    <div class="cell-sub">{{ $user->email }}</div>
                </td>
                <td>{{ $user->phone ?? '—' }}</td>
                <td>
                    @if($user->role === 'admin')
                        <span class="badge badge-blue">Admin</span>
                    @elseif($user->role === 'manager')
                        <span class="badge badge-orange">Manager</span>
                    @else
                        <span class="badge badge-gray">Utilisateur</span>
                    @endif
                </td>
                <td>
                    @if($user->status === 'active')
                        <span class="badge badge-green">Actif</span>
                    @else
                        <span class="badge badge-red">Bloqué</span>
                    @endif
                </td>
                <td>
                    @if($user->role !== 'admin')
                    <div class="cell-actions">
                        <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : '' }}">
                                {{ $user->status === 'active' ? 'Bloquer' : 'Activer' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')"><x-icon name="trash" :size="14" /></button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="card empty">
    <x-icon name="users" :size="32" />
    <h3>Aucun utilisateur</h3>
</div>
@endif

@endsection