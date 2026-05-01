@extends('layouts.app')

@section('content')

<div class="page-header">
    <h2>Sports</h2>
    <a href="{{ route('admin.sports.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Ajouter</a>
</div>

@if($sports->count())
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sports as $sport)
            <tr>
                <td class="cell-name">{{ $sport->name }}</td>
                <td class="cell-sub">{{ $sport->description ?? '—' }}</td>
                <td>
                    <div class="cell-actions">
                        <a href="{{ route('admin.sports.edit', $sport->id) }}" class="btn btn-outline btn-sm">Modifier</a>
                        <form action="{{ route('admin.sports.delete', $sport->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')"><x-icon name="trash" :size="14" /></button>
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
    <x-icon name="football" :size="32" />
    <h3>Aucun sport</h3>
    <p>Ajoutez votre premier sport pour commencer.</p>
    <a href="{{ route('admin.sports.create') }}" class="btn btn-sm"><x-icon name="plus" :size="14" /> Ajouter</a>
</div>
@endif

@endsection