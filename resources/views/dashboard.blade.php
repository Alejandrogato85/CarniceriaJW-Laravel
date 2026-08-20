@extends('layouts.admin')


@section('title', 'Dashboard')


@section('content')

    {{-- Encabezado Dashboard --}}

    <div class="dashboard-encabezado">

        <div>

            <span class="dashboard-etiqueta">
                Administración
            </span>

            <h1 class="dashboard-titulo">
                Panel de administración
            </h1>

            <p class="dashboard-bienvenida">
                Bienvenido, {{ auth()->user()->name }}.
            </p>

        </div>

    </div>


    {{-- Tarjetas Dashboard --}}

    <div class="dashboard-cards">

        <a
            href="{{ route('clientes.index') }}"
            class="dashboard-card dashboard-card-enlace"
        >

            <div class="dashboard-card-icono">
                CL
            </div>

            <div>

                <h3>
                    Clientes
                </h3>

                <p>
                    Administración de clientes.
                </p>

            </div>

        </a>


        <div class="dashboard-card">

            <div class="dashboard-card-icono">
                CA
            </div>

            <div>

                <h3>
                    Categorías
                </h3>

                <p>
                    Organización de categorías.
                </p>

            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-icono">
                PR
            </div>

            <div>

                <h3>
                    Productos
                </h3>

                <p>
                    Administración de productos.
                </p>

            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-icono">
                DE
            </div>

            <div>

                <h3>
                    Deudas
                </h3>

                <p>
                    Control de cuentas pendientes.
                </p>

            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-icono">
                PA
            </div>

            <div>

                <h3>
                    Pagos
                </h3>

                <p>
                    Registro de pagos realizados.
                </p>

            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-icono">
                US
            </div>

            <div>

                <h3>
                    Usuarios
                </h3>

                <p>
                    Administración de usuarios.
                </p>

            </div>

        </div>

    </div>

@endsection
