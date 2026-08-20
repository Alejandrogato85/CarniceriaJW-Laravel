@extends('layouts.admin')

@section('title', 'Productos - Carnicería JW')

@section('content')

    @php
        $editando = isset($productoEditar);
    @endphp


    {{-- =====================================================
         Encabezado Productos
         ===================================================== --}}

    <div class="productos-encabezado">

        <span class="productos-etiqueta">
            Módulo
        </span>

        <h1 class="productos-titulo">
            Productos
        </h1>

        <p class="productos-descripcion">
            Registra y administra los productos de Carnicería JW.
        </p>

    </div>


    {{-- =====================================================
         Mensaje Exito
         ===================================================== --}}

    @if(session('exito'))

        <div class="productos-exito">

            {{ session('exito') }}

        </div>

    @endif


    {{-- =====================================================
         Registrar o Editar Producto
         ===================================================== --}}

    <section class="productos-panel">

        <div class="productos-panel-encabezado">

            <h2>

                @if($editando)

                    Editar producto

                @else

                    Registrar producto

                @endif

            </h2>


            <p>

                @if($editando)

                    Modifica los datos del producto.

                @else

                    Ingresa los datos del producto.

                @endif

            </p>

        </div>


        <form
            action="{{ $editando
                ? route('productos.update', $productoEditar)
                : route('productos.store') }}"
            method="POST"
            class="productos-formulario"
        >

            @csrf


            {{-- Metodo PUT al Editar --}}

            @if($editando)

                @method('PUT')

            @endif


            {{-- =====================================================
                 Categoria
                 ===================================================== --}}

            <div class="productos-campo">

                <label for="categoria_id">
                    Categoría
                </label>

                <select
                    id="categoria_id"
                    name="categoria_id"
                >

                    <option value="">
                        Seleccionar categoría
                    </option>


                    @foreach($categorias as $categoria)

                        <option
                            value="{{ $categoria->id }}"
                            @selected(
                                old(
                                    'categoria_id',
                                    $editando
                                        ? $productoEditar->categoria_id
                                        : ''
                                ) == $categoria->id
                            )
                        >
                            {{ $categoria->nombre }}
                        </option>

                    @endforeach

                </select>


                @error('categoria_id')

                    <p class="productos-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =====================================================
                 Nombre
                 ===================================================== --}}

            <div class="productos-campo">

                <label for="nombre">
                    Nombre del producto
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old(
                        'nombre',
                        $editando
                            ? $productoEditar->nombre
                            : ''
                    ) }}"
                    placeholder="Ej: Carne normal"
                >


                @error('nombre')

                    <p class="productos-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =====================================================
                 Unidad de Medida
                 ===================================================== --}}

            <div class="productos-campo">

                <label for="unidad_medida">
                    Unidad
                </label>

                <select
                    id="unidad_medida"
                    name="unidad_medida"
                >

                    <option value="">
                        Seleccionar
                    </option>


                    <option
                        value="kg"
                        @selected(
                            old(
                                'unidad_medida',
                                $editando
                                    ? $productoEditar->unidad_medida
                                    : ''
                            ) == 'kg'
                        )
                    >
                        Kilogramo
                    </option>


                    <option
                        value="unidad"
                        @selected(
                            old(
                                'unidad_medida',
                                $editando
                                    ? $productoEditar->unidad_medida
                                    : ''
                            ) == 'unidad'
                        )
                    >
                        Unidad
                    </option>

                </select>


                @error('unidad_medida')

                    <p class="productos-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =====================================================
                 Precio Actual
                 ===================================================== --}}

            <div class="productos-campo">

                <label for="precio_actual">
                    Precio actual
                </label>

                <input
                    type="number"
                    id="precio_actual"
                    name="precio_actual"
                    step="0.01"
                    min="0"
                    value="{{ old(
                        'precio_actual',
                        $editando
                            ? $productoEditar->precio_actual
                            : ''
                    ) }}"
                    placeholder="Ej: 56.00"
                >


                @error('precio_actual')

                    <p class="productos-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =====================================================
                 Stock
                 ===================================================== --}}

            <div class="productos-campo">

                <label for="stock">
                    Stock
                </label>

                <input
                    type="number"
                    id="stock"
                    name="stock"
                    min="0"
                    step="1"
                    value="{{ old(
                        'stock',
                        $editando
                            ? $productoEditar->stock
                            : 0
                    ) }}"
                    placeholder="Ej: 10"
                >


                @error('stock')

                    <p class="productos-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =====================================================
                 Descripcion
                 ===================================================== --}}

            <div class="productos-campo">

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
                            ? $productoEditar->descripcion
                            : ''
                    ) }}"
                    placeholder="Ej: Precio por kilogramo"
                >


                @error('descripcion')

                    <p class="productos-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =====================================================
                 Estado solo al Editar
                 ===================================================== --}}

            @if($editando)

                <div class="productos-campo">

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
                                    $productoEditar->estado
                                        ? '1'
                                        : '0'
                                ) == '1'
                            )
                        >
                            Activo
                        </option>


                        <option
                            value="0"
                            @selected(
                                old(
                                    'estado',
                                    $productoEditar->estado
                                        ? '1'
                                        : '0'
                                ) == '0'
                            )
                        >
                            Inactivo
                        </option>

                    </select>


                    @error('estado')

                        <p class="productos-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            @endif


            {{-- =====================================================
                 Acciones Formulario
                 ===================================================== --}}

            <div class="productos-formulario-acciones">

                <button
                    type="submit"
                    class="productos-boton"
                >

                    @if($editando)

                        Guardar cambios

                    @else

                        Registrar producto

                    @endif

                </button>


                @if($editando)

                    <a
                        href="{{ route('productos.index') }}"
                        class="productos-cancelar"
                    >
                        Cancelar
                    </a>

                @endif

            </div>

        </form>

    </section>


    {{-- =====================================================
         Lista Productos
         ===================================================== --}}

    <section class="productos-panel">

        <div class="productos-lista-encabezado">

            <div>

                <h2>
                    Productos registrados
                </h2>

                <p>
                    {{ $productos->count() }} producto(s)
                </p>

            </div>


            {{-- Buscador Productos --}}

            <form
                action="{{ route('productos.index') }}"
                method="GET"
                class="productos-buscador"
            >

                <input
                    type="search"
                    name="buscar"
                    value="{{ $buscar ?? '' }}"
                    placeholder="Producto o categoría"
                >


                <button type="submit">
                    Buscar
                </button>


                @if(!empty($buscar))

                    <a href="{{ route('productos.index') }}">
                        Limpiar
                    </a>

                @endif

            </form>

        </div>


        {{-- =====================================================
             Sin Productos
             ===================================================== --}}

        @if($productos->isEmpty())

            <div class="productos-vacio">

                @if(!empty($buscar))

                    No se encontraron productos con

                    <strong>
                        "{{ $buscar }}"
                    </strong>.

                @else

                    Todavía no hay productos registrados.

                @endif

            </div>

        @else


            {{-- =====================================================
                 Tabla Productos
                 ===================================================== --}}

            <div class="productos-tabla-contenedor">

                <table class="productos-tabla">

                    <thead>

                        <tr>

                            <th>
                                Producto
                            </th>

                            <th>
                                Categoría
                            </th>

                            <th>
                                Unidad
                            </th>

                            <th>
                                Precio actual
                            </th>

                            <th>
                                Stock
                            </th>

                            <th>
                                Descripción
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                                Registrado por
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($productos as $producto)

                            <tr>

                                {{-- Producto --}}

                                <td>
                                    {{ $producto->nombre }}
                                </td>


                                {{-- Categoria --}}

                                <td>
                                    {{ $producto->categoria?->nombre ?? 'Sin categoría' }}
                                </td>


                                {{-- Unidad --}}

                                <td>

                                    @if($producto->unidad_medida === 'kg')

                                        Kilogramo

                                    @else

                                        Unidad

                                    @endif

                                </td>


                                {{-- Precio --}}

                                <td>

                                    <strong>
                                        Bs {{
                                            number_format(
                                                $producto->precio_actual,
                                                2
                                            )
                                        }}
                                    </strong>

                                    <span class="productos-precio-unidad">

                                        @if($producto->unidad_medida === 'kg')

                                            / kg

                                        @else

                                            / unidad

                                        @endif

                                    </span>

                                </td>


                                {{-- Stock --}}

                                <td>

                                    <strong>
                                        {{ $producto->stock }}
                                    </strong>

                                    <span class="productos-precio-unidad">

                                        @if($producto->unidad_medida === 'kg')

                                            kg

                                        @else

                                            unidades

                                        @endif

                                    </span>

                                </td>


                                {{-- Descripcion --}}

                                <td>

                                    {{
                                        $producto->descripcion
                                            ?: 'Sin descripción'
                                    }}

                                </td>


                                {{-- Estado --}}

                                <td>

                                    @if($producto->estado)

                                        <span
                                            class="
                                                productos-estado
                                                productos-estado-activo
                                            "
                                        >
                                            Activo
                                        </span>

                                    @else

                                        <span
                                            class="
                                                productos-estado
                                                productos-estado-inactivo
                                            "
                                        >
                                            Inactivo
                                        </span>

                                    @endif

                                </td>


                                {{-- Registrado por --}}

                                <td>

                                    {{
                                        $producto->user?->name
                                            ?? 'Usuario eliminado'
                                    }}

                                </td>


                                {{-- Acciones --}}

                                <td>

                                    <div class="productos-acciones">


                                        {{-- Editar --}}

                                        <a
                                            href="{{
                                                route(
                                                    'productos.edit',
                                                    $producto
                                                )
                                            }}"
                                            class="productos-editar"
                                        >
                                            Editar
                                        </a>


                                        {{-- Eliminar --}}

                                        <form
                                            action="{{
                                                route(
                                                    'productos.destroy',
                                                    $producto
                                                )
                                            }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                '¿Seguro que deseas eliminar este producto?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="productos-eliminar"
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