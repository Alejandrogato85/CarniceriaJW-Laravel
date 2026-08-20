@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="dashboard-titulo">
        Panel de administración
    </h1>

    <p class="dashboard-bienvenida">
        Bienvenido, {{ auth()->user()->name }}.
    </p>

    <div class="dashboard-cards">

        <div class="dashboard-card">
            <h3>Clientes</h3>
            <p>Administración de clientes.</p>
        </div>

        <div class="dashboard-card">
            <h3>Productos</h3>
            <p>Administración de productos.</p>
        </div>

        <div class="dashboard-card">
            <h3>Deudas</h3>
            <p>Control de cuentas pendientes.</p>
        </div>

    </div>

@endsection
