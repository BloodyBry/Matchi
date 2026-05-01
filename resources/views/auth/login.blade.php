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
                <h2>Bon retour parmi nous</h2>
                <p>Accédez à vos réservations, consultez vos terrains favoris et organisez vos prochains matchs.</p>
            </div>
            <div class="auth-image__features">
                <div class="auth-feature">
                    <x-icon name="zap" :size="16" stroke="#a7f3d0" />
                    <span>Réservation instantanée</span>
                </div>
                <div class="auth-feature">
                    <x-icon name="shield" :size="16" stroke="#a7f3d0" />
                    <span>Paiement sécurisé</span>
                </div>
                <div class="auth-feature">
                    <x-icon name="clock" :size="16" stroke="#a7f3d0" />
                    <span>Disponible 24/7</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right panel — Form --}}
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div style="text-align:center;margin-bottom:28px;">
                <div class="auth-form-icon">
                    <x-icon name="lock" :size="22" stroke="#059669" />
                </div>
                <h2 style="margin-bottom:4px;font-size:24px;">Connexion</h2>
                <p style="font-size:14px;color:var(--text-secondary);">Accédez à votre espace Matchi</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="vous@exemple.com" value="{{ old('email') }}" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>

                <button type="submit" class="btn" style="width:100%;justify-content:center;padding:12px;font-size:15px;margin-top:4px;">
                    <x-icon name="arrow-right" :size="16" stroke="#fff" /> Se connecter
                </button>
            </form>

            <div class="auth-divider">
                <span>ou</span>
            </div>

            <p style="text-align:center;font-size:14px;">
                Pas encore de compte ?
                <a href="/register" style="color:var(--primary);font-weight:600;text-decoration:none;">Créer un compte gratuitement</a>
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