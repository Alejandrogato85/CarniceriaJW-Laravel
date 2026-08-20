<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel - Carnicería JW')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="admin">

        <aside class="admin-sidebar">

            <h2 class="admin-logo">
                Carnicería JW
            </h2>

            <nav class="admin-nav">

                <a href="{{ route('dashboard') }}">
                    Inicio
                </a>

                <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'activo' : '' }}">
                    Clientes
                </a>
                <a href="{{ route('categorias.index') }}"
                    class="{{ request()->routeIs('categorias.*') ? 'activo' : '' }}">
                    Categorías
                </a>
                <a href="#">
                    Productos
                </a>

                <a href="#">
                    Deudas
                </a>

                <a href="#">
                    Pagos
                </a>

                <a href="#">
                    Usuarios
                </a>

            </nav>

            <div class="admin-usuario">

                <p>
                    {{ auth()->user()->name }}
                </p>

                <span>
                    {{ auth()->user()->email }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="admin-logout">
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </aside>


        <main class="admin-contenido">

            @yield('content')

        </main>

    </div>

</body>

</html>
