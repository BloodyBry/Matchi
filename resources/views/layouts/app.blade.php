<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Matchi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5f5f5; }
        nav { background: #111827; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-right: 15px; }
        .container { width: 90%; max-width: 1100px; margin: 30px auto; }
        .card { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        .btn { background: #2563eb; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-danger { background: #dc2626; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 6px; margin-bottom: 15px; }
        .error { color: red; margin-bottom: 15px; }
        .success { color: green; margin-bottom: 15px; }
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
                    <a href="{{ route('manager.center.index') }}">Mes centres</a>
                    <a href="{{ route('manager.fields.index') }}">Mes terrains</a>
                    <a href="{{ route('manager.reservations.index') }}">Réservations</a>
                @endif

                <a href="/my-reservations">Mes réservations</a>

                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            @else
                <a href="/login">Login</a>
                <a href="/register">Register</a>
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
</body>
</html>