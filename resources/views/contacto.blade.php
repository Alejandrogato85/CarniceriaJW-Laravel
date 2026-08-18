@extends('layouts.carniceria')

@section('title', 'Contacto - Carnicería JW')

@section('content')
 <main class="contenedor contenedor-principal">
        <h2 class="text-center">contacto</h2>
        <form class="formulario" id="form-pedido" novalidate>
            <fieldset>
                <legend>Tus datos</legend>
                <div class="campo">
                    <label for="nombre">Nombre: </label>
                    <input type="text" placeholder="Tu nombre" id="nombre" required>
                </div>

                <div class="campo">
                    <label for="telefono">Teléfono: </label>
                    <input type="tel" placeholder="Tu teléfono" id="telefono" required>
                </div>

                <div class="campo">
                    <label for="correo">Email: </label>
                    <input type="email" placeholder="Tu email" id="correo" required>
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje: </label>
                    <textarea id="mensaje" rows="10" cols="20"></textarea>
                </div>

            </fieldset>

            <input type="submit" value="enviar formulario" class="btn btnm">

            <p id="error-pedido" class="aviso"></p>
        </form>

    </main>


@endsection
