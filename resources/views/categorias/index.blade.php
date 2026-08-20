@extends('layouts.admin')


@section('title', 'Categorías - Carnicería JW')


@section('content')

    @php
        $editando = isset($categoriaEditar);
    @endphp


    {{-- Encabezado Categorias --}}

    <div class="categorias-encabezado">

        <span class="categorias-etiqueta">
            Módulo
        </span>

        <h1 class="categorias-titulo">
            Categorías
        </h1>

        <p class="categorias-descripcion">
            Organiza los productos de Carnicería JW por categorías.
        </p>

    </div>


    {{-- Mensaje Exito --}}

    @if(session('exito'))

        <div class="categorias-exito">

            {{ session('exito') }}

        </div>

    @endif


    {{-- Registrar o Editar Categoria --}}

    <section class="categorias-panel">

        <div class="categorias-panel-encabezado">

            <h2>

                @if($editando)

                    Editar categoría

                @else

                    Registrar categoría

                @endif

            </h2>


            <p>

                @if($editando)

                    Modifica los datos de la categoría.

                @else

                    Ingresa los datos de la categoría.

                @endif

            </p>

        </div>


        <form
            action="{{ $editando
                ? route('categorias.update', $categoriaEditar)
                : route('categorias.store') }}"
            method="POST"
            class="categorias-formulario"
        >

            @csrf


            {{-- Metodo PUT al Editar --}}

            @if($editando)

                @method('PUT')

            @endif


            {{-- Nombre --}}

            <div class="categorias-campo">

                <label for="nombre">
                    Nombre
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old(
                        'nombre',
                        $editando
                            ? $categoriaEditar->nombre
                            : ''
                    ) }}"
                    placeholder="Ej: Carne"
                >

                @error('nombre')

                    <p class="categorias-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Descripcion --}}

            <div class="categorias-campo">

                <label for="descripcion">
                    Descripción
                </label>

                <input
                    type="text"
                    id="descripcion"
                    name="descripcion"
                    value="{{ old(
                        'descripcion',
                        $editando
                            ? $categoriaEditar->descripcion
                            : ''
                    ) }}"
                    placeholder="Ej: Cortes y productos de res"
                >

                @error('descripcion')

                    <p class="categorias-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Estado solo al Editar --}}

            @if($editando)

                <div class="categorias-campo">

                    <label for="estado">
                        Estado
                    </label>

                    <select
                        id="estado"
                        name="estado"
                    >

                        <option
                            value="1"
                            @selected(
                                old(
                                    'estado',
                                    $categoriaEditar->estado
                                        ? '1'
                                        : '0'
                                ) == '1'
                            )
                        >
                            Activa
                        </option>


                        <option
                            value="0"
                            @selected(
                                old(
                                    'estado',
                                    $categoriaEditar->estado
                                        ? '1'
                                        : '0'
                                ) == '0'
                            )
                        >
                            Inactiva
                        </option>

                    </select>


                    @error('estado')

                        <p class="categorias-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            @endif


            {{-- Acciones Formulario --}}

            <div class="categorias-formulario-acciones">

                <button
                    type="submit"
                    class="categorias-boton"
                >

                    @if($editando)

                        Guardar cambios

                    @else

                        Registrar categoría

                    @endif

                </button>


                @if($editando)

                    <a
                        href="{{ route('categorias.index') }}"
                        class="categorias-cancelar"
                    >
                        Cancelar
                    </a>

                @endif

            </div>

        </form>

    </section>


    {{-- Lista Categorias --}}

    <section class="categorias-panel">

        <div class="categorias-lista-encabezado">

            <div>

                <h2>
                    Categorías registradas
                </h2>

                <p>
                    {{ $categorias->count() }} categoría(s)
                </p>

            </div>


            {{-- Buscador Categorias --}}

            <form
                action="{{ route('categorias.index') }}"
                method="GET"
                class="categorias-buscador"
            >

                <input
                    type="search"
                    name="buscar"
                    value="{{ $buscar ?? '' }}"
                    placeholder="Buscar categoría"
                >


                <button type="submit">
                    Buscar
                </button>


                @if(!empty($buscar))

                    <a href="{{ route('categorias.index') }}">
                        Limpiar
                    </a>

                @endif

            </form>

        </div>


        {{-- Sin Categorias --}}

        @if($categorias->isEmpty())

            <div class="categorias-vacio">

                @if(!empty($buscar))

                    No se encontraron categorías con

                    <strong>
                        "{{ $buscar }}"
                    </strong>.

                @else

                    Todavía no hay categorías registradas.

                @endif

            </div>

        @else


            {{-- Tabla Categorias --}}

            <div class="categorias-tabla-contenedor">

                <table class="categorias-tabla">

                    <thead>

                        <tr>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Descripción
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($categorias as $categoria)

                            <tr>

                                <td>
                                    {{ $categoria->nombre }}
                                </td>


                                <td>
                                    {{ $categoria->descripcion ?: 'Sin descripción' }}
                                </td>


                                <td>

                                    @if($categoria->estado)

                                        <span
                                            class="categorias-estado categorias-estado-activo"
                                        >
                                            Activa
                                        </span>

                                    @else

                                        <span
                                            class="categorias-estado categorias-estado-inactivo"
                                        >
                                            Inactiva
                                        </span>

                                    @endif

                                </td>


                                {{-- Acciones --}}

                                <td>

                                    <div class="categorias-acciones">


                                        {{-- Editar --}}

                                        <a
                                            href="{{ route(
                                                'categorias.edit',
                                                $categoria
                                            ) }}"
                                            class="categorias-editar"
                                        >
                                            Editar
                                        </a>


                                        {{-- Eliminar --}}

                                        <form
                                            action="{{ route(
                                                'categorias.destroy',
                                                $categoria
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                '¿Seguro que deseas eliminar esta categoría?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="categorias-eliminar"
                                            >
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </section>

@endsection
