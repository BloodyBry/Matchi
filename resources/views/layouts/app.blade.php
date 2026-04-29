<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matchi — Réservation de terrains sportifs</title>
    <meta name="description" content="Matchi, la plateforme moderne de réservation de terrains sportifs. Football, padel, tennis et plus.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --green:       #16a34a;
            --green-hover: #15803d;
            --green-light: #dcfce7;
            --green-xlight:#f0fdf4;
            --bg:          #f8faf9;
            --surface:     #ffffff;
            --border:      #e5e7eb;
            --text:        #111827;
            --text-muted:  #6b7280;
            --text-light:  #9ca3af;
            --shadow-sm:   0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:   0 4px 16px rgba(0,0,0,.06), 0 1px 4px rgba(0,0,0,.04);
            --shadow-lg:   0 10px 30px rgba(0,0,0,.08), 0 4px 12px rgba(0,0,0,.05);
            --radius-sm:   8px;
            --radius-md:   12px;
            --radius-lg:   16px;
            --radius-xl:   20px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ─── SVG ICON UTILITY ─── */
        .icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            vertical-align: middle;
        }

        .icon svg {
            display: block;
        }

        .icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-md);
            flex-shrink: 0;
        }

        .icon-box--sm {
            width: 36px;
            height: 36px;
        }

        .icon-box--md {
            width: 44px;
            height: 44px;
        }

        .icon-box--lg {
            width: 52px;
            height: 52px;
        }

        .icon-box--green {
            background: linear-gradient(135deg, var(--green-xlight), var(--green-light));
            color: var(--green);
        }

        .icon-box--green-solid {
            background: linear-gradient(135deg, var(--green), var(--green-hover));
            color: #fff;
        }

        .icon-box--red {
            background: #fef2f2;
            color: #dc2626;
        }

        .icon-box--amber {
            background: #fffbeb;
            color: #d97706;
        }

        .icon-box--blue {
            background: #eff6ff;
            color: #2563eb;
        }

        /* ─── NAVBAR ─── */
        nav {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 0 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
            position: sticky;
            top: 0;
            z-index: 200;
            backdrop-filter: blur(12px);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 36px;
        }

        .nav-logo {
            font-size: 21px;
            font-weight: 900;
            color: var(--green) !important;
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 9px;
            transition: opacity .15s;
        }

        .nav-logo:hover { opacity: .85; }

        .nav-logo .nav-logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--green), #22c55e);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 13.5px;
            padding: 7px 13px;
            border-radius: var(--radius-sm);
            transition: all .15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-links a:hover {
            color: var(--green);
            background: var(--green-xlight);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-right a {
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
        }

        .nav-link-ghost {
            color: var(--text-muted);
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            transition: color .15s;
        }

        .nav-link-ghost:hover { color: var(--green); }

        /* ─── BUTTONS ─── */
        .btn {
            background: var(--green);
            color: #fff !important;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-weight: 600;
            font-size: 13.5px;
            transition: all .15s ease;
            box-shadow: 0 1px 3px rgba(22,163,74,.2), 0 1px 2px rgba(22,163,74,.12);
            line-height: 1;
            white-space: nowrap;
        }

        .btn:hover {
            background: var(--green-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(22,163,74,.28);
        }

        .btn:active { transform: translateY(0); }

        .btn svg { flex-shrink: 0; }

        .btn-outline {
            background: transparent;
            color: var(--green) !important;
            border: 1.5px solid #d1d5db;
            box-shadow: none;
        }

        .btn-outline:hover {
            background: var(--green-xlight);
            border-color: var(--green);
            box-shadow: none;
        }

        .btn-dark {
            background: var(--text);
            box-shadow: 0 1px 3px rgba(0,0,0,.15);
        }

        .btn-dark:hover { background: #374151; }

        .btn-danger {
            background: #dc2626;
            box-shadow: 0 1px 3px rgba(220,38,38,.2);
        }

        .btn-danger:hover {
            background: #b91c1c;
            box-shadow: 0 4px 12px rgba(220,38,38,.28);
        }

        .btn-sm {
            padding: 7px 14px;
            font-size: 12.5px;
            border-radius: 9px;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted) !important;
            box-shadow: none;
            padding: 7px 12px;
        }

        .btn-ghost:hover {
            background: #f3f4f6;
            color: var(--text) !important;
            transform: none;
            box-shadow: none;
        }

        /* ─── LAYOUT ─── */
        .container {
            width: 92%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 32px 0 56px;
            flex: 1;
        }

        /* ─── CARDS ─── */
        .card {
            background: var(--surface);
            padding: 24px 28px;
            border-radius: var(--radius-lg);
            margin-bottom: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: box-shadow .2s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        /* ─── TYPOGRAPHY ─── */
        h1 {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -1.2px;
            color: var(--text);
            margin-bottom: 12px;
            line-height: 1.15;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 14px;
            letter-spacing: -.4px;
        }

        h3 {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 12px;
        }

        p { color: var(--text-muted); line-height: 1.65; }

        /* ─── FORMS ─── */
        label {
            font-weight: 600;
            font-size: 13px;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        label svg { color: var(--text-muted); }

        input, select, textarea {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 18px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-size: 14px;
            font-family: inherit;
            outline: none;
            background: #fafbfc;
            color: var(--text);
            transition: border-color .15s, box-shadow .15s, background .15s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(22,163,74,.1);
        }

        textarea { resize: vertical; min-height: 90px; }

        /* ─── ALERTS ─── */
        .alert {
            padding: 14px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success {
            background: var(--green-light);
            color: #14532d;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert ul { margin: 6px 0 0 18px; }

        /* Keep old class names working */
        .success { background: var(--green-light); color: #14532d; border: 1px solid #bbf7d0; padding: 14px 18px; border-radius: var(--radius-md); margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .error    { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 14px 18px; border-radius: var(--radius-md); margin-bottom: 20px; font-size: 14px; }
        .error ul { margin: 6px 0 0 18px; }

        /* ─── GRID ─── */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        /* ─── BADGES ─── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            margin: 2px;
            letter-spacing: .01em;
        }

        .badge svg { flex-shrink: 0; }

        .badge-green  { background: var(--green-light); color: #15803d; }
        .badge-gray   { background: #f3f4f6; color: #4b5563; }
        .badge-blue   { background: #eff6ff; color: #1d4ed8; }
        .badge-orange { background: #fff7ed; color: #c2410c; }
        .badge-red    { background: #fef2f2; color: #991b1b; }

        /* legacy .badge → green style */
        .badge:not([class*="badge-"]) { background: var(--green-light); color: #15803d; }

        /* ─── DIVIDER ─── */
        hr { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

        /* ─── PAGE TITLE BAR ─── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h1, .page-header h2 { margin-bottom: 0; }

        /* ─── SECTION LABEL ─── */
        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--green);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .section-label svg { opacity: .7; }

        /* ─── FOOTER ─── */
        footer {
            text-align: center;
            color: var(--text-muted);
            padding: 24px 20px;
            font-size: 13px;
            border-top: 1px solid var(--border);
            background: #fff;
        }

        footer a { color: var(--green); text-decoration: none; font-weight: 600; }

        /* ─── MOBILE HAMBURGER ─── */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            border: none;
            background: none;
        }

        .nav-toggle span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: .2s;
        }

        /* ─── DATA ROW CARD (List items) ─── */
        .data-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 20px;
            padding: 18px 24px;
        }

        .data-row__info {
            flex: 1;
            min-width: 160px;
        }

        .data-row__name {
            font-weight: 700;
            font-size: 14.5px;
            color: var(--text);
            margin-bottom: 2px;
        }

        .data-row__sub {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .data-row__meta {
            min-width: 110px;
        }

        .data-row__meta-label {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 2px;
        }

        .data-row__meta-value {
            font-size: 13px;
            color: var(--text);
            font-weight: 600;
        }

        .data-row__actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
        }

        .empty-state__icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            background: var(--green-xlight);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
        }

        .empty-state h3 { margin-bottom: 8px; }
        .empty-state p { margin-bottom: 20px; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            nav { padding: 0 4%; height: 58px; }

            .nav-toggle { display: flex; }

            .nav-left .nav-links,
            .nav-right {
                display: none;
                position: absolute;
                top: 58px;
                left: 0;
                right: 0;
                background: #fff;
                padding: 16px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
                border-bottom: 1px solid var(--border);
                box-shadow: 0 8px 20px rgba(0,0,0,.06);
                z-index: 199;
            }

            .nav-links.open, .nav-right.open { display: flex; }

            .nav-right { top: auto; left: 0; }

            h1 { font-size: 28px; }
            h2 { font-size: 21px; }
            .container { padding: 20px 0 36px; }
            .card { padding: 18px 20px; }
            .data-row { padding: 16px 20px; gap: 14px; }
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <nav id="main-nav">
        <div class="nav-left">
            <a href="/" class="nav-logo">
                <span class="nav-logo-icon"><x-icon name="football" :size="18" stroke="#fff" /></span>
                Matchi
            </a>
            <div class="nav-links" id="nav-links">
                <a href="/fields"><x-icon name="compass" :size="15" /> Terrains</a>

                @if(session()->has('user_id'))
                    <a href="/dashboard"><x-icon name="layout-grid" :size="15" /> Dashboard</a>

                    @if(session('user_role') === 'manager')
                        <a href="{{ route('manager.center.index') }}"><x-icon name="building" :size="15" /> Centres</a>
                        <a href="{{ route('manager.fields.index') }}"><x-icon name="stadium" :size="15" /> Mes terrains</a>
                        <a href="{{ route('manager.reservations.index') }}"><x-icon name="clipboard" :size="15" /> Réservations</a>
                    @endif

                    @if(session('user_role') === 'admin')
                        <a href="{{ route('admin.users.index') }}"><x-icon name="users" :size="15" /> Utilisateurs</a>
                        <a href="{{ route('admin.centers.index') }}"><x-icon name="building" :size="15" /> Centres</a>
                        <a href="{{ route('admin.sports.index') }}"><x-icon name="football" :size="15" /> Sports</a>
                        <a href="{{ route('admin.reservations.index') }}"><x-icon name="clipboard" :size="15" /> Réservations</a>
                    @endif

                    @if(session('user_role') === 'user')
                        <a href="/my-reservations"><x-icon name="calendar" :size="15" /> Mes réservations</a>
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
                    <button type="submit" class="btn btn-outline btn-sm"><x-icon name="log-out" :size="14" /> Déconnexion</button>
                </form>
            @else
                <a href="/login" class="nav-link-ghost">Connexion</a>
                <a href="/register" class="btn btn-sm">Créer un compte</a>
            @endif
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="success"><x-icon name="check-circle" :size="18" stroke="#15803d" /> {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <footer>
        <p>Matchi © {{ date('Y') }} — Réservation moderne de terrains sportifs</p>
    </footer>

    <script>
        const toggle = document.getElementById('nav-toggle');
        const links  = document.getElementById('nav-links');
        const right  = document.getElementById('nav-right');
        if (toggle) {
            toggle.addEventListener('click', () => {
                links.classList.toggle('open');
                right.classList.toggle('open');
            });
        }
    </script>
</body>
</html>