@extends('layouts.app')

@section('content')

{{-- Hero --}}
<div class="show-hero">
    @if($field->image)
        <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}" class="show-hero__img">
    @else
        <div class="show-hero__placeholder"><x-icon name="football" :size="56" /></div>
    @endif
    <div class="show-hero__overlay">
        <span class="badge badge-green" style="font-size:13px;">{{ $field->sport->name }}</span>
        <h1 class="show-hero__title">{{ $field->name }}</h1>
        <p class="show-hero__sub">{{ $field->center->name }} — {{ $field->center->city }}</p>
    </div>
</div>

<div class="show-layout">
    <div class="show-main">
        {{-- Info --}}
        <div class="card">
            <h2 style="margin-bottom:16px;">Informations</h2>
            <div class="info-grid">
                <div class="info-item"><span class="info-label">Centre</span><span class="info-val">{{ $field->center->name }}</span></div>
                <div class="info-item"><span class="info-label">Adresse</span><span class="info-val">{{ $field->center->address }}, {{ $field->center->city }}</span></div>
                <div class="info-item"><span class="info-label">Sport</span><span class="info-val">{{ $field->sport->name }}</span></div>
                <div class="info-item">
                    <span class="info-label">Tarif</span>
                    <span class="info-val" style="color:var(--primary);font-weight:700;">{{ $field->price_per_hour }} MAD / heure</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Statut</span>
                    <span class="info-val">
                        @if($field->status === 'available')<span class="badge badge-green">Disponible</span>
                        @elseif($field->status === 'maintenance')<span class="badge badge-orange">Maintenance</span>
                        @else <span class="badge badge-red">Indisponible</span>@endif
                    </span>
                </div>
                @php $avg = $field->reviews->count() > 0 ? round($field->reviews->avg('rating'), 1) : null; @endphp
                <div class="info-item">
                    <span class="info-label">Note</span>
                    <span class="info-val">@if($avg)<strong style="color:#d97706;">{{ $avg }}</strong>/5 ({{ $field->reviews->count() }} avis)@else Pas encore noté @endif</span>
                </div>
            </div>
            @if($field->description)<hr><p>{{ $field->description }}</p>@endif
        </div>

        {{-- Schedules --}}
        <div class="card">
            <h3>Horaires</h3>
            @forelse($field->schedules as $s)
                <div class="sched-row {{ $s->is_open ? 'sched-row--open' : '' }}">
                    <span class="sched-day">{{ ucfirst($s->day_of_week) }}</span>
                    <span class="sched-time">@if($s->is_open){{ \Carbon\Carbon::createFromFormat('H:i:s', $s->start_time)->format('H:i') }} – {{ \Carbon\Carbon::createFromFormat('H:i:s', $s->end_time)->format('H:i') }}@else Fermé @endif</span>
                    <span class="badge {{ $s->is_open ? 'badge-green' : 'badge-gray' }}">{{ $s->is_open ? 'Ouvert' : 'Fermé' }}</span>
                </div>
            @empty <p>Aucun horaire défini.</p> @endforelse
        </div>

        {{-- Reviews --}}
        <div class="card">
            <h3>Avis ({{ $field->reviews->count() }})</h3>
            @forelse($field->reviews as $review)
                <div class="review">
                    <div class="review__header">
                        <div class="review__avatar">{{ strtoupper(substr($review->user->first_name, 0, 1)) }}</div>
                        <div>
                            <div style="font-weight:600;font-size:14px;">{{ $review->user->first_name }} {{ $review->user->last_name }}</div>
                            <div style="font-size:13px;color:#d97706;">@for($i=1;$i<=5;$i++)<span style="color:{{ $i <= $review->rating ? '#d97706' : '#d1d5db' }}">★</span>@endfor <span style="color:#6b7280;">{{ $review->rating }}/5</span></div>
                        </div>
                    </div>
                    <p style="font-size:14px;margin-top:8px;">{{ $review->comment }}</p>
                    @if(session('user_id') == $review->user_id)
                        <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f3f4f6;">
                            <form action="{{ route('reviews.update', $review->id) }}" method="POST" style="margin-bottom:8px;">
                                @csrf
                                <div class="form-row">
                                    <div><label>Note</label><select name="rating">@for($i=1;$i<=5;$i++)<option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}/5</option>@endfor</select></div>
                                    <div><label>Commentaire</label><textarea name="comment">{{ $review->comment }}</textarea></div>
                                </div>
                                <button type="submit" class="btn btn-sm">Modifier</button>
                            </form>
                            <form action="{{ route('reviews.delete', $review->id) }}" method="POST">@csrf<button type="submit" class="btn btn-danger btn-sm">Supprimer</button></form>
                        </div>
                    @endif
                </div>
            @empty <p style="text-align:center;padding:20px;">Aucun avis. Soyez le premier !</p> @endforelse
        </div>
    </div>

    <div class="show-sidebar">
        @if(session()->has('user_id') && session('user_role') === 'user')
        <div class="card" style="position:sticky;top:72px;">
            <h3>Réserver</h3>
            @if($field->status !== 'available')
                <div class="alert alert-error">Ce terrain est actuellement indisponible.</div>
            @else
                @if(!empty($openDays))
                    <p style="font-size:13px;color:#6b7280;margin-bottom:6px;">Jours ouverts :</p>
                    <div style="display:flex;flex-wrap:wrap;gap:4px;margin-bottom:14px;">@foreach($openDays as $d)<span class="badge badge-green">{{ ucfirst($d) }}</span>@endforeach</div>
                @endif
                <form action="{{ route('fields.availableSlots', $field->id) }}" method="GET">
                    <label for="reservation_date">Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" min="{{ date('Y-m-d') }}" value="{{ $selectedDate ?? '' }}">
                    <button type="submit" class="btn" style="width:100%;justify-content:center;">Voir les créneaux</button>
                </form>
            @endif
        </div>
        @elseif(!session()->has('user_id'))
        <div class="card" style="text-align:center;">
            <h3>Connectez-vous</h3>
            <p style="margin-bottom:16px;">Pour réserver, vous devez être connecté.</p>
            <a href="/login" class="btn" style="width:100%;justify-content:center;">Se connecter</a>
            <a href="/register" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:8px;">Créer un compte</a>
        </div>
        @endif

        @if(session()->has('user_id'))
            @php $myReview = $field->reviews->where('user_id', session('user_id'))->first(); @endphp
            @if(!$myReview)
            <div class="card">
                <h3>Laisser un avis</h3>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                    <label for="rating">Note</label>
                    <select id="rating" name="rating">@for($i=1;$i<=5;$i++)<option value="{{ $i }}">{{ $i }}/5</option>@endfor</select>
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment" placeholder="Votre expérience..."></textarea>
                    <button type="submit" class="btn" style="width:100%;justify-content:center;">Envoyer</button>
                </form>
            </div>
            @else
            <div class="card" style="text-align:center;"><p style="font-size:13px;">Vous avez déjà laissé un avis.</p></div>
            @endif
        @endif
    </div>
</div>

@if(isset($availableSlots))
<div class="card" style="margin-top:8px;">
    <h3>Créneaux — {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l d F Y') }}</h3>
    @if(count($availableSlots) > 0)
    <div class="slots-grid">
        @foreach($availableSlots as $slot)
        <div class="slot">
            <div style="font-size:15px;font-weight:600;color:var(--primary);text-align:center;margin-bottom:10px;">{{ $slot['start_time'] }} – {{ $slot['end_time'] }}</div>
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="field_id" value="{{ $field->id }}">
                <input type="hidden" name="reservation_date" value="{{ $selectedDate }}">
                <input type="hidden" name="start_time" value="{{ $slot['start_time'] }}">
                <input type="hidden" name="end_time" value="{{ $slot['end_time'] }}">
                <label for="notes_{{ $loop->index }}">Notes</label>
                <textarea id="notes_{{ $loop->index }}" name="notes" placeholder="Optionnel..."></textarea>
                <button type="submit" class="btn" style="width:100%;justify-content:center;">Réserver</button>
            </form>
        </div>
        @endforeach
    </div>
    @else <p style="text-align:center;padding:20px;">Aucun créneau disponible pour cette date.</p> @endif
</div>
@endif

<style>
.show-hero { position:relative; height:300px; border-radius:10px; overflow:hidden; margin-bottom:20px; }
.show-hero__img { width:100%; height:100%; object-fit:cover; }
.show-hero__placeholder { width:100%; height:100%; background:#f3f4f6; display:flex; align-items:center; justify-content:center; color:#d1d5db; }
.show-hero__overlay { position:absolute; bottom:0; left:0; right:0; padding:24px; background:linear-gradient(to top,rgba(0,0,0,.6),transparent); }
.show-hero__title { font-size:26px; font-weight:800; color:#fff; margin:6px 0 2px; }
.show-hero__sub { color:rgba(255,255,255,.8); font-size:14px; }
.show-layout { display:grid; grid-template-columns:1fr 340px; gap:16px; align-items:start; }
.show-main { display:flex; flex-direction:column; }
.show-sidebar { display:flex; flex-direction:column; }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.info-item { display:flex; flex-direction:column; gap:2px; }
.info-label { font-size:12px; color:#9ca3af; font-weight:500; text-transform:uppercase; letter-spacing:.3px; }
.info-val { font-size:14px; font-weight:500; color:#111827; }
.sched-row { display:flex; align-items:center; gap:12px; padding:8px 12px; border-radius:8px; margin-bottom:4px; border:1px solid #f3f4f6; }
.sched-row--open { background:#fafbfc; }
.sched-day { font-weight:600; font-size:14px; flex:1; }
.sched-time { font-size:14px; color:#6b7280; }
.review { padding:14px 0; border-bottom:1px solid #f3f4f6; }
.review:last-child { border-bottom:none; }
.review__header { display:flex; align-items:center; gap:10px; }
.review__avatar { width:34px; height:34px; border-radius:50%; background:var(--primary); color:#fff; font-weight:700; font-size:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.slots-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:12px; margin-top:12px; }
.slot { border:1px solid #e5e7eb; border-radius:10px; padding:16px; }
@media (max-width:900px) {
    .show-layout { grid-template-columns:1fr; }
    .show-sidebar { order:-1; }
    .show-hero { height:200px; }
    .show-hero__title { font-size:22px; }
    .info-grid { grid-template-columns:1fr; }
}
</style>

<script>
const openDays = {!! json_encode($openDays ?? []) !!};
const inp = document.getElementById('reservation_date');
if (inp) inp.addEventListener('change', function() {
    if (!this.value) return;
    const d = new Date(this.value).toLocaleDateString('en-US',{weekday:'long'}).toLowerCase();
    if (!openDays.includes(d)) { alert("Fermé ce jour-là !"); this.value = ""; }
});
</script>

@endsection