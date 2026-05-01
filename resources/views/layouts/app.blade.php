<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matchi — Réservation de terrains sportifs</title>
    <meta name="description" content="Matchi, la plateforme moderne de réservation de terrains sportifs. Football, padel, tennis et plus.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #059669;
            --primary-hover: #047857;
            --primary-light: #ecfdf5;
            --bg: #f9fafb;
            --surface: #ffffff;
            --border: #e5e7eb;
            --border-light: #f3f4f6;
            --text: #111827;
            --text-secondary: #6b7280;
            --text-tertiary: #9ca3af;
            --danger: #dc2626;
            --danger-hover: #b91c1c;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 56px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        @media (min-width: 769px) {
            .navbar { padding: 0 40px; }
        }

        .nav-left { display: flex; align-items: center; gap: 32px; }

        .nav-logo {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links { display: flex; align-items: center; gap: 4px; }

        .nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 6px;
            transition: color .15s, background .15s;
        }

        .nav-links a:hover {
            color: var(--text);
            background: var(--border-light);
        }

        .nav-right { display: flex; align-items: center; gap: 8px; }
        .nav-right a { text-decoration: none; font-size: 14px; font-weight: 500; }

        .nav-link-ghost {
            color: var(--text-secondary);
            padding: 6px 12px;
            border-radius: 6px;
            transition: color .15s;
        }
        .nav-link-ghost:hover { color: var(--text); }

        /* ─── BUTTONS ─── */
        .btn {
            background: var(--primary);
            color: #fff !important;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 14px;
            line-height: 1.4;
            transition: background .15s;
            white-space: nowrap;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn svg { flex-shrink: 0; }

        .btn-outline {
            background: #fff;
            color: var(--text) !important;
            border: 1px solid var(--border);
        }
        .btn-outline:hover { background: var(--border-light); }

        .btn-danger { background: var(--danger); }
        .btn-danger:hover { background: var(--danger-hover); }

        .btn-sm { padding: 6px 12px; font-size: 13px; }

        .btn-ghost {
            background: transparent;
            color: var(--text-secondary) !important;
        }
        .btn-ghost:hover { background: var(--border-light); color: var(--text) !important; }

        /* ─── LAYOUT ─── */
        .container {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
            padding: 28px 24px 48px;
            flex: 1;
        }

        @media (min-width: 769px) {
            .container { padding: 32px 40px 56px; }
        }

        /* ─── CARDS ─── */
        .card {
            background: var(--surface);
            padding: 20px 24px;
            border-radius: 10px;
            margin-bottom: 12px;
            border: 1px solid var(--border);
        }

        /* ─── TABLES ─── */
        .table-wrap {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrap th {
            text-align: left;
            padding: 10px 16px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-tertiary);
            text-transform: uppercase;
            letter-spacing: .5px;
            background: var(--border-light);
            border-bottom: 1px solid var(--border);
        }

        .table-wrap td {
            padding: 12px 16px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }

        .table-wrap tr:last-child td { border-bottom: none; }
        .table-wrap tr:hover td { background: #fafbfc; }

        .table-wrap .cell-name {
            font-weight: 600;
            color: var(--text);
        }

        .table-wrap .cell-sub {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .table-wrap .cell-actions {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
        }

        /* ─── TYPOGRAPHY ─── */
        h1 { font-size: 28px; font-weight: 800; letter-spacing: -.5px; margin-bottom: 8px; }
        h2 { font-size: 20px; font-weight: 700; margin-bottom: 12px; }
        h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; }
        p { color: var(--text-secondary); line-height: 1.6; }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .page-header h2 { margin-bottom: 0; }
        .page-subtitle { font-size: 14px; color: var(--text-secondary); margin-top: 2px; }

        /* ─── FORMS ─── */
        label {
            font-weight: 500;
            font-size: 14px;
            color: var(--text);
            display: block;
            margin-bottom: 4px;
        }

        input, select, textarea {
            width: 100%;
            padding: 9px 12px;
            margin-bottom: 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            background: #fff;
            color: var(--text);
            transition: border-color .15s, box-shadow .15s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(5,150,105,.12);
        }

        textarea { resize: vertical; min-height: 80px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 500px) {
            .form-row { grid-template-columns: 1fr; }
        }

        /* ─── ALERTS ─── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .alert-success { background: var(--primary-light); color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        .alert ul { margin: 4px 0 0 16px; }

        .success { background: var(--primary-light); color: #065f46; border: 1px solid #a7f3d0; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; display: flex; align-items: center; gap: 8px; }
        .error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
        .error ul { margin: 4px 0 0 16px; }

        /* ─── GRID ─── */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; }
        .grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }

        /* ─── BADGES ─── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge svg { flex-shrink: 0; }
        .badge-green  { background: #ecfdf5; color: #059669; }
        .badge-gray   { background: #f3f4f6; color: #6b7280; }
        .badge-blue   { background: #eff6ff; color: #2563eb; }
        .badge-orange { background: #fff7ed; color: #ea580c; }
        .badge-red    { background: #fef2f2; color: #dc2626; }
        .badge:not([class*="badge-"]) { background: #ecfdf5; color: #059669; }

        /* ─── STAT CARDS ─── */
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; margin-bottom: 20px; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 10px; padding: 16px 20px; }
        .stat-card__label { font-size: 13px; color: var(--text-secondary); margin-bottom: 4px; }
        .stat-card__value { font-size: 28px; font-weight: 700; color: var(--text); line-height: 1.2; }

        /* ─── DASHBOARD BACKGROUND ─── */
        .container.dashboard-bg {
            position: relative;
            overflow: hidden;
        }
        .container.dashboard-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: -24px;
            right: -24px;
            bottom: 0;
            background: url('/images/dashboards_img.jpg') center/cover no-repeat fixed;
            opacity: 0.65;
            pointer-events: none;
            z-index: 0;
        }
        .container.dashboard-bg > * {
            position: relative;
            z-index: 1;
        }

        /* ─── DIVIDER ─── */
        hr { border: none; border-top: 1px solid var(--border); margin: 16px 0; }

        /* ─── EMPTY STATE ─── */
        .empty { text-align: center; padding: 40px 20px; color: var(--text-secondary); }
        .empty svg { color: var(--text-tertiary); margin-bottom: 12px; }
        .empty h3 { color: var(--text); margin-bottom: 6px; }
        .empty p { margin-bottom: 16px; }

        /* ─── FOOTER ─── */
        footer {
            text-align: center;
            color: var(--text-tertiary);
            padding: 20px;
            font-size: 13px;
            border-top: 1px solid var(--border);
            background: #fff;
        }

        /* ─── MOBILE ─── */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            padding: 4px;
            border: none;
            background: none;
        }
        .nav-toggle span { display: block; width: 18px; height: 2px; background: var(--text); border-radius: 1px; }

        @media (max-width: 768px) {
            .nav-toggle { display: flex; }
            .nav-left .nav-links, .nav-right {
                display: none;
                position: absolute;
                top: 56px; left: 0; right: 0;
                background: #fff;
                padding: 12px 16px;
                flex-direction: column;
                align-items: stretch;
                gap: 4px;
                border-bottom: 1px solid var(--border);
                z-index: 99;
            }
            .nav-links.open, .nav-right.open { display: flex; }
            h1 { font-size: 24px; }
            .grid { grid-template-columns: 1fr; }
            .grid-2 { grid-template-columns: 1fr !important; }
            .table-wrap { font-size: 13px; }
            .table-wrap th, .table-wrap td { padding: 10px 12px; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>

<body>
    <nav class="navbar" id="main-nav">
        <div class="nav-left">
            <a href="/" class="nav-logo">
                <x-icon name="football" :size="20" stroke="#059669" />
                Matchi
            </a>
            <div class="nav-links" id="nav-links">
                <a href="/fields">Terrains</a>
                @if(session()->has('user_id'))
                    <a href="/dashboard">Dashboard</a>
                    @if(session('user_role') === 'manager')
                        <a href="{{ route('manager.center.index') }}">Centres</a>
                        <a href="{{ route('manager.fields.index') }}">Mes terrains</a>
                        <a href="{{ route('manager.reservations.index') }}">Réservations</a>
                    @endif
                    @if(session('user_role') === 'admin')
                        <a href="{{ route('admin.users.index') }}">Utilisateurs</a>
                        <a href="{{ route('admin.centers.index') }}">Centres</a>
                        <a href="{{ route('admin.sports.index') }}">Sports</a>
                        <a href="{{ route('admin.reservations.index') }}">Réservations</a>
                    @endif
                    @if(session('user_role') === 'user')
                        <a href="/my-reservations">Mes réservations</a>
                    @endif
                @endif
            </div>
        </div>

        <button class="nav-toggle" id="nav-toggle" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

        <div class="nav-right" id="nav-right">
            @if(session()->has('user_id'))
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm">Déconnexion</button>
                </form>
            @else
                <a href="/login" class="nav-link-ghost">Connexion</a>
                <a href="/register" class="btn btn-sm">Créer un compte</a>
            @endif
        </div>
    </nav>

    <div class="container @yield('container-class')">
        @if(session('success'))
            <div class="success"><x-icon name="check-circle" :size="16" /> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        @yield('content')
    </div>

    <footer>Matchi &copy; {{ date('Y') }}</footer>

    <script>
        const t = document.getElementById('nav-toggle');
        const l = document.getElementById('nav-links');
        const r = document.getElementById('nav-right');
        if (t) t.addEventListener('click', () => { l.classList.toggle('open'); r.classList.toggle('open'); });
    </script>
</body>
</html>