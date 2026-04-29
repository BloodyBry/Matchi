@extends('layouts.app')

@section('content')

{{-- ── Hero Image ── --}}
<div class="show-hero">
    @if($field->image)
        <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}" class="show-hero__img">
    @else
        <div class="show-hero__placeholder"><x-icon name="football" :size="72" /></div>
    @endif
    <div class="show-hero__overlay">
        <span class="badge badge-green" style="font-size:13px;">{{ $field->sport->name }}</span>
        <h1 class="show-hero__title">{{ $field->name }}</h1>
        <p class="show-hero__sub" style="display:flex;align-items:center;gap:6px;">
            <x-icon name="map-pin" :size="15" stroke="rgba(255,255,255,.8)" /> {{ $field->center->name }} — {{ $field->center->city }}
        </p>
    </div>
</div>

{{-- ── Info + Booking 2-col layout ── --}}
<div class="show-layout">

    {{-- Left: Info --}}
    <div class="show-main">

        {{-- Field Info Card --}}
        <div class="card">
            <p class="section-label"><x-icon name="stadium" :size="12" /> Informations</p>
            <h2 style="margin-bottom:20px;">{{ $field->name }}</h2>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-icon icon-box icon-box--sm icon-box--blue"><x-icon name="building" :size="16" /></span>
                    <div>
                        <div class="info-label">Centre</div>
                        <div class="info-value">{{ $field->center->name }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-icon icon-box icon-box--sm icon-box--green"><x-icon name="map-pin" :size="16" /></span>
                    <div>
                        <div class="info-label">Adresse</div>
                        <div class="info-value">{{ $field->center->address }}, {{ $field->center->city }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-icon icon-box icon-box--sm icon-box--amber"><x-icon name="football" :size="16" /></span>
                    <div>
                        <div class="info-label">Sport</div>
                        <div class="info-value">{{ $field->sport->name }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-icon icon-box icon-box--sm icon-box--green"><x-icon name="dollar" :size="16" /></span>
                    <div>
                        <div class="info-label">Tarif</div>
                        <div class="info-value" style="color:#16a34a;font-weight:800;font-size:18px;">{{ $field->price_per_hour }} MAD <span style="font-size:13px;font-weight:500;color:#6b7280;">/ heure</span></div>
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-icon icon-box icon-box--sm {{ $field->status === 'available' ? 'icon-box--green' : ($field->status === 'maintenance' ? 'icon-box--amber' : 'icon-box--red') }}">
                        <x-icon name="tag" :size="16" />
                    </span>
                    <div>
                        <div class="info-label">Statut</div>
                        <div>
                            @if($field->status === 'available')
                                <span class="badge badge-green"><x-icon name="check-circle" :size="12" /> Disponible</span>
                            @elseif($field->status === 'maintenance')
                                <span class="badge badge-orange"><x-icon name="wrench" :size="12" /> Maintenance</span>
                            @else
                                <span class="badge badge-red"><x-icon name="x-circle" :size="12" /> Indisponible</span>
                            @endif
                        </div>
                    </div>
                </div>
                @php $averageRating = $field->reviews->count() > 0 ? round($field->reviews->avg('rating'), 1) : null; @endphp
                <div class="info-item">
                    <span class="info-icon icon-box icon-box--sm icon-box--amber"><x-icon name="star" :size="16" /></span>
                    <div>
                        <div class="info-label">Note moyenne</div>
                        <div class="info-value">
                            @if($averageRating)
                                <span style="font-weight:800;color:#f59e0b;">{{ $averageRating }}</span>/5
                                ({{ $field->reviews->count() }} avis)
                            @else
                                Pas encore noté
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($field->description)
                <hr>
                <p class="info-label" style="margin-bottom:8px;">Description</p>
                <p>{{ $field->description }}</p>
            @endif
        </div>

        {{-- Schedules Card --}}
        <div class="card">
            <p class="section-label"><x-icon name="clock" :size="12" /> Horaires</p>
            <h3>Horaires du terrain</h3>
            <div class="schedule-list">
                @forelse($field->schedules as $schedule)
                    <div class="schedule-row {{ $schedule->is_open ? 'schedule-row--open' : 'schedule-row--closed' }}">
                        <span class="schedule-day">{{ ucfirst($schedule->day_of_week) }}</span>
                        <span class="schedule-time">
                            @if($schedule->is_open)
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}
                                –
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}
                            @else
                                Fermé
                            @endif
                        </span>
                        <span class="badge {{ $schedule->is_open ? 'badge-green' : 'badge-gray' }}">
                            {{ $schedule->is_open ? 'Ouvert' : 'Fermé' }}
                        </span>
                    </div>
                @empty
                    <p>Aucun horaire défini.</p>
                @endforelse
            </div>
        </div>

        {{-- Reviews List Card --}}
        <div class="card">
            <p class="section-label"><x-icon name="message" :size="12" /> Communauté</p>
            <h3>Avis des joueurs</h3>
            @forelse($field->reviews as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div class="review-avatar">{{ strtoupper(substr($review->user->first_name, 0, 1)) }}</div>
                        <div>
                            <div class="review-name">{{ $review->user->first_name }} {{ $review->user->last_name }}</div>
                            <div class="review-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color:{{ $i <= $review->rating ? '#f59e0b' : '#d1d5db' }}">★</span>
                                @endfor
                                <span style="font-size:12px;color:#6b7280;margin-left:4px;">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-comment">{{ $review->comment }}</p>
                    @if(session('user_id') == $review->user_id)
                        <div style="margin-top:14px;">
                            <form action="{{ route('reviews.update', $review->id) }}" method="POST" style="margin-bottom:10px;">
                                @csrf
                                <div class="grid-2">
                                    <div>
                                        <label>Modifier la note</label>
                                        <select name="rating">
                                            @for($i=1;$i<=5;$i++)
                                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}/5</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <label>Modifier le commentaire</label>
                                        <textarea name="comment">{{ $review->comment }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm"><x-icon name="save" :size="13" /> Modifier</button>
                            </form>
                            <form action="{{ route('reviews.delete', $review->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><x-icon name="trash" :size="13" /> Supprimer</button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div style="text-align:center;padding:28px;">
                    <div class="icon-box icon-box--lg icon-box--green" style="margin:0 auto 12px;"><x-icon name="message" :size="26" /></div>
                    <p>Aucun avis pour le moment. Soyez le premier !</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- Right: Booking Sidebar --}}
    <div class="show-sidebar">
        @if(session()->has('user_id') && session('user_role') === 'user')
        <div class="card" style="position:sticky;top:80px;">
            <p class="section-label"><x-icon name="calendar" :size="12" /> Réservation</p>
            <h3>Choisir une date</h3>
            @if($field->status !== 'available')
                <div class="alert alert-error">
                    <x-icon name="alert-triangle" :size="16" /> Ce terrain est actuellement <strong>indisponible</strong>.
                </div>
            @else
                @if(!empty($openDays))
                    <p style="font-size:13px;color:#6b7280;margin-bottom:8px;">Jours ouverts :</p>
                    <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:18px;">
                        @foreach($openDays as $day)
                            <span class="badge badge-green">{{ ucfirst($day) }}</span>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('fields.availableSlots', $field->id) }}" method="GET">
                    <label for="reservation_date"><x-icon name="calendar" :size="14" /> Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" min="{{ date('Y-m-d') }}" value="{{ $selectedDate ?? '' }}">
                    <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="search" :size="15" /> Voir les créneaux</button>
                </form>
            @endif
        </div>
        @elseif(!session()->has('user_id'))
        <div class="card" style="text-align:center;padding:32px 20px;">
            <div class="icon-box icon-box--lg icon-box--green" style="margin:0 auto 14px;"><x-icon name="lock" :size="26" /></div>
            <h3>Connectez-vous</h3>
            <p style="margin-bottom:20px;">Pour réserver ce terrain, vous devez être connecté.</p>
            <a href="/login" class="btn" style="width:100%;justify-content:center;">Se connecter</a>
            <a href="/register" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:10px;">Créer un compte</a>
        </div>
        @endif

        @if(session()->has('user_id'))
            @php $myReview = $field->reviews->where('user_id', session('user_id'))->first(); @endphp
            @if(!$myReview)
            <div class="card">
                <p class="section-label"><x-icon name="star" :size="12" /> Votre avis</p>
                <h3>Laisser un avis</h3>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                    <label for="rating">Note</label>
                    <select id="rating" name="rating">
                        @for($i=1;$i<=5;$i++)
                            <option value="{{ $i }}">{{ $i }}/5 {{ str_repeat('★',$i) }}</option>
                        @endfor
                    </select>
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment" placeholder="Partagez votre expérience..."></textarea>
                    <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="star" :size="15" /> Ajouter un avis</button>
                </form>
            </div>
            @else
            <div class="card" style="text-align:center;">
                <div class="icon-box icon-box--sm icon-box--green" style="margin:0 auto 10px;"><x-icon name="check-circle" :size="16" /></div>
                <p>Vous avez déjà laissé un avis sur ce terrain.</p>
            </div>
            @endif
        @endif
    </div>

</div>

{{-- ── Available Slots ── --}}
@if(isset($availableSlots))
<div class="card">
    <p class="section-label"><x-icon name="clock" :size="12" /> Créneaux</p>
    <h3>Créneaux disponibles — {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l d F Y') }}</h3>
    @if(count($availableSlots) > 0)
        <div class="slots-grid">
            @foreach($availableSlots as $slot)
            <div class="slot-item">
                <div class="slot-time" style="display:flex;align-items:center;justify-content:center;gap:6px;">
                    <x-icon name="clock" :size="16" stroke="#15803d" /> {{ $slot['start_time'] }} – {{ $slot['end_time'] }}
                </div>
                <form action="{{ route('reservations.store') }}" method="POST" style="margin-top:12px;">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                    <input type="hidden" name="reservation_date" value="{{ $selectedDate }}">
                    <input type="hidden" name="start_time" value="{{ $slot['start_time'] }}">
                    <input type="hidden" name="end_time" value="{{ $slot['end_time'] }}">
                    <label for="notes_{{ $loop->index }}">Notes (optionnel)</label>
                    <textarea id="notes_{{ $loop->index }}" name="notes" placeholder="Ex: terrain 5v5, avec vestiaires..."></textarea>
                    <button type="submit" class="btn" style="width:100%;justify-content:center;"><x-icon name="check-circle" :size="15" /> Réserver</button>
                </form>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:28px;">
            <div class="icon-box icon-box--lg icon-box--red" style="margin:0 auto 12px;"><x-icon name="sad" :size="26" /></div>
            <p>Aucun créneau disponible pour cette date. Essayez une autre date.</p>
        </div>
    @endif
</div>
@endif

<style>
.show-hero { position:relative; height:340px; border-radius:20px; overflow:hidden; margin-bottom:24px; box-shadow:0 4px 20px rgba(0,0,0,.1); }
.show-hero__img { width:100%; height:100%; object-fit:cover; }
.show-hero__placeholder { width:100%; height:100%; background:linear-gradient(135deg,#f0fdf4,#dcfce7); display:flex; align-items:center; justify-content:center; color:#16a34a; }
.show-hero__overlay { position:absolute; bottom:0; left:0; right:0; padding:28px 32px; background:linear-gradient(to top,rgba(0,0,0,.65) 0%,transparent 100%); }
.show-hero__title { font-size:30px; font-weight:800; color:#fff; letter-spacing:-.5px; margin:8px 0 4px; text-shadow:0 2px 8px rgba(0,0,0,.25); }
.show-hero__sub { color:rgba(255,255,255,.85); font-size:14.5px; font-weight:500; }
.show-layout { display:grid; grid-template-columns:1fr 360px; gap:20px; align-items:start; }
.show-main { display:flex; flex-direction:column; gap:0; }
.show-sidebar { display:flex; flex-direction:column; gap:0; }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:4px; }
.info-item { display:flex; align-items:flex-start; gap:12px; }
.info-icon { margin-top:2px; }
.info-label { font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:.8px; margin-bottom:2px; }
.info-value { font-size:14px; font-weight:600; color:#111827; }
.schedule-list { display:flex; flex-direction:column; gap:6px; }
.schedule-row { display:flex; align-items:center; gap:12px; padding:10px 14px; border-radius:10px; border:1px solid #e5e7eb; }
.schedule-row--open { background:#f0fdf4; border-color:#bbf7d0; }
.schedule-row--closed { background:#f9fafb; }
.schedule-day { font-weight:700; font-size:13.5px; flex:1; color:#111827; }
.schedule-time { font-size:13.5px; color:#4b5563; }
.review-item { padding:18px 0; border-bottom:1px solid #f3f4f6; }
.review-item:last-child { border-bottom:none; }
.review-header { display:flex; align-items:center; gap:12px; margin-bottom:10px; }
.review-avatar { width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-weight:700; font-size:15px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.review-name { font-weight:700; font-size:13.5px; color:#111827; }
.review-stars { font-size:15px; margin-top:2px; }
.review-comment { font-size:14px; color:#4b5563; line-height:1.6; }
.slots-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:16px; margin-top:16px; }
.slot-item { background:#f0fdf4; border:1.5px solid #bbf7d0; border-radius:14px; padding:18px; transition:border-color .18s,box-shadow .18s; }
.slot-item:hover { border-color:#16a34a; box-shadow:0 4px 12px rgba(22,163,74,.12); }
.slot-time { font-size:15px; font-weight:800; color:#15803d; text-align:center; }
@media (max-width:900px) {
    .show-layout { grid-template-columns:1fr; }
    .show-sidebar { order:-1; }
    .show-hero { height:220px; }
    .show-hero__title { font-size:24px; }
    .info-grid { grid-template-columns:1fr; }
}
</style>

<script>
    const openDays = {!! json_encode($openDays ?? []) !!};
    const input = document.getElementById('reservation_date');
    if (input) {
        input.addEventListener('change', function () {
            if (!this.value) return;
            const day = new Date(this.value)
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