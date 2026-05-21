<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MisterQuiz — @yield('title', 'Главная')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600&display=swap');

        :root {
            --bg:      #0e0e14;
            --surface: #17171f;
            --border:  #2a2a3a;
            --accent:  #f5c542;
            --text:    #e8e8f0;
            --muted:   #6b6b80;
            --success: #4ade80;
            --danger:  #f87171;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 2px;
        }

        .nav-links { display: flex; gap: 1rem; align-items: center; }

        .nav-links a, .nav-links button {
            background: none;
            border: 1px solid var(--border);
            color: var(--text);
            padding: 0.4rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, color 0.2s;
        }

        .nav-links a:hover, .nav-links button:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        main { max-width: 900px; margin: 3rem auto; padding: 0 1.5rem; }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
        }

        h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            letter-spacing: 2px;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            letter-spacing: 1px;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: opacity 0.2s, transform 0.1s;
        }

        .btn:active { transform: scale(0.98); }

        .btn-primary {
            background: var(--accent);
            color: #0e0e14;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
        }

        .btn-outline:hover { border-color: var(--accent); color: var(--accent); }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .alert {
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-error { background: rgba(248,113,113,0.12); border: 1px solid var(--danger); color: var(--danger); }
        .alert-success { background: rgba(74,222,128,0.12); border: 1px solid var(--success); color: var(--success); }

        label { display: block; font-size: 0.85rem; color: var(--muted); margin-bottom: 0.4rem; }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            padding: 0.65rem 1rem;
            font-size: 0.95rem;
            margin-bottom: 1.2rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }

        input:focus { outline: none; border-color: var(--accent); }

        table { width: 100%; border-collapse: collapse; }

        th, td {
            padding: 0.8rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th { color: var(--muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

        tr:last-child td { border-bottom: none; }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(245,197,66,0.15);
            color: var(--accent);
            border: 1px solid rgba(245,197,66,0.3);
        }
    </style>
</head>
<body>

<nav>
    <a class="nav-logo" href="{{ route('home') }}">MisterQuiz</a>
    <div class="nav-links">
        @auth
            <a href="{{ route('profile') }}">Профиль</a>
            <a href="{{ route('leaderboard') }}">Таблица лидеров</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}">Войти</a>
            <a href="{{ route('leaderboard') }}">Таблица лидеров</a>
        @endauth
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>