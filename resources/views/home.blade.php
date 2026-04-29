@extends('layouts.app')

@section('content')

{{-- ── Hero ── --}}
<div class="home-hero card" style="background:linear-gradient(135deg,#f0fdf4 0%,#dcfce7 60%,#bbf7d0 100%);border:1.5px solid #bbf7d0;margin-bottom:32px;">
    <div class="home-hero__inner">
        <p class="section-label"><x-icon name="football" :size="13" /> Plateforme de réservation</p>
        <h1 class="home-hero__title">Réservez votre terrain<br><span style="color:#16a34a;">en quelques clics</span></h1>
        <p class="home-hero__sub">
            Matchi vous connecte aux meilleurs terrains sportifs près de chez vous.
            Football, padel, tennis et plus encore.
        </p>
        <div class="home-hero__actions">
            <a href="/fields" class="btn" style="font-size:15px;padding:13px 28px;"><x-icon name="compass" :size="17" /> Explorer les terrains</a>
            @if(!session()->has('user_id'))
                <a href="/register" class="btn btn-outline" style="font-size:15px;padding:13px 28px;">Créer un compte</a>
            @endif
        </div>
    </div>
    <div class="home-hero__graphic">
        <x-icon name="stadium" :size="120" stroke="#16a34a" />
    </div>
</div>

{{-- ── Features ── --}}
<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
    <div class="card feature-card">
        <div class="feature-icon icon-box icon-box--lg icon-box--green">
            <x-icon name="zap" :size="26" />
        </div>
        <h3>Réservation rapide</h3>
        <p>Choisissez une date, consultez les créneaux disponibles et réservez instantanément.</p>
    </div>
    <div class="card feature-card">
        <div class="feature-icon icon-box icon-box--lg icon-box--green">
            <x-icon name="building" :size="26" />
        </div>
        <h3>Centres sportifs</h3>
        <p>Les gestionnaires gèrent leurs terrains, horaires et réservations en toute simplicité.</p>
    </div>
    <div class="card feature-card">
        <div class="feature-icon icon-box icon-box--lg icon-box--green">
            <x-icon name="smartphone" :size="26" />
        </div>
        <h3>100% Responsive</h3>
        <p>Une interface pensée pour ordinateur, tablette et smartphone. Jouez partout.</p>
    </div>
</div>

<style>
.home-hero { padding: 52px 48px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
.home-hero__inner { flex: 1; }
.home-hero__title { font-size: 42px; font-weight: 800; letter-spacing: -1.8px; color: #111827; line-height: 1.15; margin-bottom: 16px; }
.home-hero__sub   { font-size: 15.5px; color: #4b5563; max-width: 480px; margin-bottom: 28px; line-height: 1.7; }
.home-hero__actions { display: flex; gap: 14px; flex-wrap: wrap; }
.home-hero__graphic { opacity: .12; flex-shrink: 0; user-select: none; }
.feature-card { text-align: center; padding: 36px 28px; }
.feature-card .feature-icon { margin: 0 auto 18px; }
.feature-card h3 { margin-bottom: 10px; }
@media (max-width: 700px) {
    .home-hero { flex-direction: column; padding: 32px 24px; }
    .home-hero__title { font-size: 30px; }
    .home-hero__graphic { display: none; }
}
</style>

@endsection