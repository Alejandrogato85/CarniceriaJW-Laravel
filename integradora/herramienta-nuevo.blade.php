@extends('layouts.base')

@section('contenido')

    <h2>Registrar herramienta</h2>

    @if ($errors->any())
        <div style="
            background-color: #ffe4e4;
            border: 1px solid #cc4444;
            padding: 1rem;
            margin-bottom: 1.5rem;
        ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/herramientas/nuevo" method="POST">

        @csrf

        <div style="margin-bottom: 1rem;">
            <label for="nombre">
                Nombre de la herramienta
            </label>

            <br>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
                style="
                    width: 100%;
                    padding: 0.7rem;
                    margin-top: 0.4rem;
                "
            >
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="precio">
                Precio en Bs
            </label>

            <br>

            <input
                type="number"
                id="precio"
                name="precio"
                value="{{ old('precio') }}"
                style="
                    width: 100%;
                    padding: 0.7rem;
                    margin-top: 0.4rem;
                "
            >
        </div>

        <button type="submit" class="boton">
            Registrar herramienta
        </button>

    </form>

    <p style="margin-top: 1.5rem;">
        <a href="/herramientas">
            Volver al inventario
        </a>
    </p>

@endsection
