@extends('layouts.app')

@section('content')
<div class="auth-layout">
    {{-- Left panel — Image --}}
    <div class="auth-image">
        <div class="auth-image__overlay"></div>
        <div class="auth-image__content">
            <div class="auth-image__logo">
                <x-icon name="football" :size="28" stroke="#fff" />
                <span>Matchi</span>
            </div>
            <div class="auth-image__text">
                <h2>Rejoignez la communauté Matchi</h2>
                <p>Créez votre compte et commencez à réserver des terrains de sport dans les meilleurs centres près de chez vous.</p>
            </div>
            <div class="auth-image__features">
                <div class="auth-feature">
                    <x-icon name="check-circle" :size="16" stroke="#a7f3d0" />
                    <span>Inscription gratuite</span>
                </div>
                <div class="auth-feature">
                    <x-icon name="zap" :size="16" stroke="#a7f3d0" />
                    <span>Réservation en quelques clics</span>
                </div>
                <div class="auth-feature">
                    <x-icon name="star" :size="16" stroke="#a7f3d0" />
                    <span>Accès aux meilleurs terrains</span>
                </div>
                <div class="auth-feature">
                    <x-icon name="smartphone" :size="16" stroke="#a7f3d0" />
                    <span>Accessible sur tous les appareils</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right panel — Form --}}
    <div class="auth-form-panel">
        <div class="auth-form-container" style="max-width:440px;">
            <div style="text-align:center;margin-bottom:28px;">
                <div class="auth-form-icon">
                    <x-icon name="user" :size="22" stroke="#059669" />
                </div>
                <h2 style="margin-bottom:4px;font-size:24px;">Créer un compte</h2>
                <p style="font-size:14px;color:var(--text-secondary);">Réservez vos terrains en quelques secondes</p>
            </div>

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div>
                        <label for="first_name">Prénom</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Yassine" value="{{ old('first_name') }}" required>
                    </div>
                    <div>
                        <label for="last_name">Nom</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Alami" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <label for="phone">Téléphone</label>
                <input type="text" id="phone" name="phone" placeholder="06XXXXXXXX" value="{{ old('phone') }}">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="vous@exemple.com" value="{{ old('email') }}" required>

                <div class="form-row">
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label for="password_confirmation">Confirmer</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn" style="width:100%;justify-content:center;padding:12px;font-size:15px;margin-top:4px;">
                    <x-icon name="arrow-right" :size="16" stroke="#fff" /> Créer mon compte
                </button>
            </form>

            <div class="auth-divider">
                <span>ou</span>
            </div>

            <p style="text-align:center;font-size:14px;">
                Déjà un compte ?
                <a href="/login" style="color:var(--primary);font-weight:600;text-decoration:none;">Se connecter</a>
            </p>
        </div>
    </div>
</div>

<style>
    /* Override container padding for auth pages */
    .container:has(.auth-layout) {
        max-width: 100%;
        padding: 0;
    }

    .auth-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: calc(100vh - 56px - 53px);
    }

    .auth-image {
        position: relative;
        background: url('/images/dashboards_img.jpg') center/cover no-repeat;
        display: flex;
        align-items: flex-end;
        padding: 48px;
    }

    .auth-image__overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.75) 0%, rgba(0,0,0,.3) 50%, rgba(5,150,105,.2) 100%);
    }

    .auth-image__content {
        position: relative;
        z-index: 1;
        color: #fff;
    }

    .auth-image__logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 24px;
    }

    .auth-image__text h2 {
        font-size: 28px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
    }

    .auth-image__text p {
        color: rgba(255,255,255,.8);
        font-size: 15px;
        line-height: 1.6;
        max-width: 380px;
    }

    .auth-image__features {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 24px;
    }

    .auth-feature {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: rgba(255,255,255,.9);
        font-weight: 500;
    }

    .auth-form-panel {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 32px;
        background: var(--bg);
    }

    .auth-form-container {
        width: 100%;
        max-width: 400px;
    }

    .auth-form-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #ecfdf5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .auth-divider {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 20px 0;
        color: var(--text-tertiary);
        font-size: 13px;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    @media (max-width: 768px) {
        .auth-layout { grid-template-columns: 1fr; }
        .auth-image {
            min-height: 200px;
            padding: 32px 24px;
        }
        .auth-image__text h2 { font-size: 22px; }
        .auth-form-panel { padding: 32px 24px; }
    }
</style>
@endsection