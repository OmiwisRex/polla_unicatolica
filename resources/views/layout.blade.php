<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Polla Unicatólica')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="header-content">
            <div>
                <a href="{{ route('index') }}" class="logo">Polla Unicatólica</a>
                <div class="logo-subtitle">Polla Mundial 2026 + Trivia</div>
            </div>

            <div class="controls">
                <a href="{{ route('index') }}" class="btn btn-secondary">Clasificación</a>
                <a href="{{ auth()->check() && auth()->user()->permiso_id === 2 ? route('partidos.jugador') : route('partidos.index') }}" class="btn btn-secondary">Partidos</a>
                @auth
                    @if(auth()->user()->permiso_id === 3)
                        <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">Preguntas</a>
                    @endif
                    @if(auth()->user()->permiso_id === 1)
                        <a href="{{ route('pagar') }}" class="btn btn-secondary">Pagar</a>
                    @endif
                @endauth
            </div>

            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('registro') }}" class="btn btn-secondary">Registro</a>
                @else
                    <span class="tag">Hola, {{ auth()->user()->nombre }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>