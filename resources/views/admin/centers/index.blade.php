@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Centres sportifs</h2>
</div>

@if($centers->count())
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Centre</th>
                <th>Manager</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centers as $center)
            <tr>
                <td>
                    <div class="cell-name">{{ $center->name }}</div>
                    <div class="cell-sub">{{ $center->address }}, {{ $center->city }}</div>
                </td>
                <td>{{ $center->manager->first_name }} {{ $center->manager->last_name }}</td>
                <td>{{ $center->phone ?? '—' }}</td>
                <td>
                    @if($center->status === 'active')
                        <span class="badge badge-green">Actif</span>
                    @else
                        <span class="badge badge-red">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="cell-actions">
                        <form action="{{ route('admin.centers.status', $center->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm">Changer statut</button>
                        </form>
                        <form action="{{ route('admin.centers.delete', $center->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce centre ?')"><x-icon name="trash" :size="14" /></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="card empty">
    <x-icon name="building" :size="32" />
    <h3>Aucun centre sportif</h3>
    <p>Aucun centre n'a été créé pour le moment.</p>
</div>
@endif

@endsection