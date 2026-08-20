@extends('layouts.autenticacion')

@section('title', 'Registrarse')

@section('content')

<main class="auth-contenedor">

    <h1 class="auth-titulo">
        Crear cuenta
    </h1>

    <p class="auth-descripcion">
        Ingresa tus datos para registrarte.
    </p>

    <form
        action="{{ route('register.store') }}"
        method="POST"
        class="auth-formulario"
    >
        @csrf

        <!-- Nombre -->
        <div class="campo-auth">
            <label for="name">
                Nombre completo
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Ingresa tu nombre completo"
                maxlength="255"
                required
                autofocus
            >

            @error('name')
                <p class="error-auth">
                    {{ $message }}
                </p>
            @enderror
        </div>


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
            >

            @error('email')
                <p class="error-auth">
                    {{ $message }}
                </p>
            @enderror
        </div>


        <!-- Teléfono -->
        <div class="campo-auth">
            <label for="telefono">
                Teléfono
            </label>

            <input
                type="tel"
                id="telefono"
                name="telefono"
                value="{{ old('telefono') }}"
                placeholder="Ej: 71234567"
                maxlength="20"
                required
            >

            @error('telefono')
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
                placeholder="Mínimo 8 caracteres"
                required
            >

            @error('password')
                <p class="error-auth">
                    {{ $message }}
                </p>
            @enderror
        </div>


        <!-- Confirmar contraseña -->
        <div class="campo-auth">
            <label for="password_confirmation">
                Confirmar contraseña
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Repite tu contraseña"
                required
            >
        </div>


        <button
            type="submit"
            class="btn auth-boton"
        >
            Crear cuenta
        </button>

    </form>


    <div class="auth-enlace-login">
        <span>
            ¿Ya tienes una cuenta?
        </span>

        <a href="{{ route('login') }}">
            Iniciar sesión
        </a>
    </div>

</main>

@endsection
