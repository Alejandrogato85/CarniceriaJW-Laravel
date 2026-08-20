@extends('layouts.autenticacion')

@section('title', 'Iniciar sesión')

@section('content')

<main class="auth-contenedor">

    <h1 class="auth-titulo">
        Iniciar sesión
    </h1>

    <p class="auth-descripcion">
        Ingresa tus datos para acceder al sistema.
    </p>


    {{-- Mensaje cuando el registro fue exitoso --}}
    @if (session('success'))
        <div class="mensaje-exito-auth">
            {{ session('success') }}
        </div>
    @endif


    <form
        action="{{ route('login.store') }}"
        method="POST"
        class="auth-formulario"
    >
        @csrf


        <!-- Correo -->
        <div class="campo-auth">

            <label for="email">
                Correo electrónico
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="correo@ejemplo.com"
                required
                autofocus
            >

            @error('email')
                <p class="error-auth">
                    {{ $message }}
                </p>
            @enderror

        </div>


        <!-- Contraseña -->
        <div class="campo-auth">

            <label for="password">
                Contraseña
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Ingresa tu contraseña"
                required
            >

            @error('password')
                <p class="error-auth">
                    {{ $message }}
                </p>
            @enderror

        </div>


        <!-- Recordarme -->
        <div class="recordar-auth">

            <input
                type="checkbox"
                id="remember"
                name="remember"
                value="1"
                {{ old('remember') ? 'checked' : '' }}
            >

            <label for="remember">
                Recordarme
            </label>

        </div>


        <!-- Botón -->
        <button
            type="submit"
            class="btn auth-boton"
        >
            Iniciar sesión
        </button>

    </form>


    <!-- Enlace al registro -->
    <div class="auth-enlace-login">

        <span>
            ¿No tienes una cuenta?
        </span>

        <a href="{{ route('register') }}">
            Crear cuenta
        </a>

    </div>

</main>

@endsection
