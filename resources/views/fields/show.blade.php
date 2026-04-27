@extends('layouts.app')

@section('content')
<div class="card">
    <h2>{{ $field->name }}</h2>
    <p><strong>Centre :</strong> {{ $field->center->name }}</p>
    <p><strong>Ville :</strong> {{ $field->center->city }}</p>
    <p><strong>Adresse :</strong> {{ $field->center->address }}</p>
    <p><strong>Sport :</strong> {{ $field->sport->name }}</p>
    <p><strong>Prix/heure :</strong> {{ $field->price_per_hour }} MAD</p>
    <p><strong>Description :</strong> {{ $field->description }}</p>
    <p><strong>Statut :</strong> {{ $field->status }}</p>

    @php
        $averageRating = $field->reviews->count() > 0 ? round($field->reviews->avg('rating'), 1) : null;
    @endphp

    <p>
        <strong>Note moyenne :</strong>
        {{ $averageRating ? $averageRating . '/5' : 'Pas encore noté' }}
    </p>
</div>

<div class="card">
    <h3>Horaires du terrain</h3>

    @forelse($field->schedules as $schedule)
        <p>
            <strong>{{ ucfirst($schedule->day_of_week) }}</strong> :
            {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}
            -
            {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}
            ({{ $schedule->is_open ? 'Ouvert' : 'Fermé' }})
        </p>
    @empty
        <p>Aucun horaire défini.</p>
    @endforelse
</div>

@if(session()->has('user_id') && session('user_role') === 'user')
<div class="card">
    <h3>Choisir une date</h3>

    @if($field->status !== 'available')
        <p style="color:red;">
            <strong>Ce terrain est actuellement indisponible.</strong>
        </p>
    @else
        <p>
            <strong>Jours disponibles :</strong>
            @if(!empty($openDays))
                @foreach($openDays as $day)
                    <span style="background:#2563eb;color:white;padding:5px 10px;border-radius:5px;margin-right:5px;">
                        {{ ucfirst($day) }}
                    </span>
                @endforeach
            @else
                Aucun jour disponible
            @endif
        </p>

        <form action="{{ route('fields.availableSlots', $field->id) }}" method="GET">
            <label>Date</label>
            <input
                type="date"
                id="reservation_date"
                name="reservation_date"
                min="{{ date('Y-m-d') }}"
                value="{{ $selectedDate ?? '' }}"
            >

            <button type="submit" class="btn">Voir les créneaux disponibles</button>
        </form>
    @endif
</div>
@endif

@if(isset($availableSlots))
<div class="card">
    <h3>Créneaux disponibles pour le {{ $selectedDate }}</h3>

    @if(count($availableSlots) > 0)
        @foreach($availableSlots as $slot)
            <div style="margin-bottom:15px; padding:10px; border:1px solid #ddd; border-radius:8px;">
                <p>
                    <button class="btn" style="margin-bottom:10px;">
                        {{ $slot['start_time'] }} - {{ $slot['end_time'] }}
                    </button>
                </p>

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                    <input type="hidden" name="reservation_date" value="{{ $selectedDate }}">
                    <input type="hidden" name="start_time" value="{{ $slot['start_time'] }}">
                    <input type="hidden" name="end_time" value="{{ $slot['end_time'] }}">

                    <label>Notes (optionnel)</label>
                    <textarea name="notes"></textarea>

                    <button type="submit" class="btn">Réserver ce créneau</button>
                </form>
            </div>
        @endforeach
    @else
        <p>Aucun créneau disponible pour cette date.</p>
    @endif
</div>
@endif

<div class="card">
    <h3>Avis</h3>

    @if(session()->has('user_id'))
        @php
            $myReview = $field->reviews->where('user_id', session('user_id'))->first();
        @endphp

        @if(!$myReview)
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf

                <input type="hidden" name="field_id" value="{{ $field->id }}">

                <label>Note</label>
                <select name="rating">
                    <option value="1">1/5</option>
                    <option value="2">2/5</option>
                    <option value="3">3/5</option>
                    <option value="4">4/5</option>
                    <option value="5">5/5</option>
                </select>

                <label>Commentaire</label>
                <textarea name="comment"></textarea>

                <button type="submit" class="btn">Ajouter un avis</button>
            </form>
        @else
            <p>Vous avez déjà laissé un avis sur ce terrain.</p>
        @endif
    @else
        <p>Connectez-vous pour laisser un avis.</p>
    @endif
</div>

<div class="card">
    <h3>Liste des avis</h3>

    @forelse($field->reviews as $review)
        <div style="margin-bottom:20px;">
            <p>
                <strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong>
                - Note : {{ $review->rating }}/5
            </p>

            <p>{{ $review->comment }}</p>

            @if(session('user_id') == $review->user_id)
                <form action="{{ route('reviews.update', $review->id) }}" method="POST" style="margin-bottom:10px;">
                    @csrf

                    <label>Modifier la note</label>
                    <select name="rating">
                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1/5</option>
                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2/5</option>
                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3/5</option>
                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4/5</option>
                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5/5</option>
                    </select>

                    <label>Modifier le commentaire</label>
                    <textarea name="comment">{{ $review->comment }}</textarea>

                    <button type="submit" class="btn">Modifier</button>
                </form>

                <form action="{{ route('reviews.delete', $review->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            @endif

            <hr>
        </div>
    @empty
        <p>Aucun avis pour le moment.</p>
    @endforelse
</div>

<script>
    const openDays = {!! json_encode($openDays ?? []) !!};

    const input = document.getElementById('reservation_date');

    if (input) {
        input.addEventListener('change', function () {
            const selectedDate = new Date(this.value);

            if (!this.value) {
                return;
            }

            const day = selectedDate
                .toLocaleDateString('en-US', { weekday: 'long' })
                .toLowerCase();

            if (!openDays.includes(day)) {
                alert("Ce terrain est fermé ce jour-là !");
                this.value = "";
            }
        });
    }
</script>
@endsection