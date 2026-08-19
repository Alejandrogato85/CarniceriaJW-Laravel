@extends('layouts.base')

@section('contenido')

    <h2>Inventario de herramientas</h2>

    <p>
        Ferretería El Tornillo ofrece herramientas para las necesidades
        del hogar y pequeños trabajos, manteniendo su inventario organizado.
    </p>

    <p>
        Hay {{ count($herramientas) }} herramientas en el inventario.
    </p>

    @foreach ($herramientas as $herramienta)
        <div style="border-bottom: 1px solid #ddd; padding: 1rem 0;">
            <strong>{{ $herramienta->nombre }}</strong>

            <span>
                - {{ $herramienta->precio }} Bs
            </span>
        </div>
    @endforeach

    <p>
        <strong>
            Inventario atendido por OSCAR ALEJANDRO TOCO CHIRI
        </strong>
    </p>

    <a href="/herramientas/nuevo" class="boton">
        Registrar nueva herramienta
    </a>

@endsection
