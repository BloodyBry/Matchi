<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Matchi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #f4f7fb;
            color: #111827;
        }

        nav {
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 18px;
            font-weight: 600;
            font-size: 14px;
        }

        nav a:first-child {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .container {
            width: 90%;
            max-width: 1150px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 24px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid #eef2f7;
        }

        h1, h2, h3 {
            margin-top: 0;
            color: #0f172a;
        }

        h1 {
            font-size: 42px;
            letter-spacing: -1.5px;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 21px;
        }

        p {
            line-height: 1.6;
            color: #4b5563;
        }

        .btn {
            background: #2563eb;
            color: white !important;
            border: none;
            padding: 11px 18px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 700;
            transition: 0.2s ease;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            margin-top: 7px;
            margin-bottom: 17px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            background: #f9fafb;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        label {
            font-weight: 700;
            font-size: 14px;
            color: #374151;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
        }

        .badge {
            display: inline-block;
            background: #e0ecff;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            margin: 4px;
        }

        footer {
            text-align: center;
            color: #6b7280;
            padding: 30px;
            font-size: 14px;
        }

        .card:hover {
            transform: translateY(-3px);
            transition: 0.2s;
        }

        @media (max-width: 700px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            nav a {
                display: inline-block;
                margin-bottom: 8px;
            }

            h1 {
                font-size: 32px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div>
            <a href="/">Matchi</a>
            <a href="/fields">Terrains</a>
        </div>

        <div>
            @if(session()->has('user_id'))
                <a href="/dashboard">Dashboard</a>

                @if(session('user_role') === 'manager')
                    <a href="{{ route('manager.center.index') }}">Centres</a>
                    <a href="{{ route('manager.fields.index') }}">Terrains</a>
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

                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn">Déconnexion</button>
                </form>
            @else
                <a href="/login">Connexion</a>
                <a href="/register" class="btn">Créer un compte</a>
            @endif
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">
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
        Matchi © {{ date('Y') }} — Réservation moderne de terrains sportifs
    </footer>
</body>
</html>