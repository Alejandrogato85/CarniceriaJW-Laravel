@extends('layouts.carniceria')

@section('title', 'Inicio - Carnicería JW')

@section('content')

    @include('components.hero')
<section class="contenedor contenedor-iconos">
    <h2 class="text-center">Nuestros Servicios</h2>
    <div class="iconos">

        <div class="icono">
            <img src="img/trescar.png" alt="Icono de pedidos por WhatsApp">

            <h3>Pedidos por WhatsApp</h3>

            <p>
                Realiza tu pedido de forma rápida y sencilla por WhatsApp,
                y recógelo listo en nuestra carnicería.
            </p>
        </div>

        <div class="icono">
            <img src="img/unocar.png" alt="Icono de venta de carne al por mayor">

            <h3>Venta al por mayor</h3>

            <p>
                Ofrecemos carne por mayor para restaurantes, negocios y eventos,
                con cortes frescos, buenos precios y atención personalizada.
            </p>
        </div>

        <div class="icono">
            <img src="img/doscar.png" alt="Icono de cortes personalizados">

            <h3>Cortes personalizados</h3>

            <p>
                Preparamos la carne según el grosor, tamaño y cantidad que necesites
                para tus comidas, parrilladas o negocio.
            </p>
        </div>

    </div>
</section>



<main>

    <section class="productos contenedor" id="cortes">

        <h2 class="text-center">Nuestros cortes</h2>

        <p class="descripcion-productos">
            Contamos con diferentes cortes de carne para tus comidas,
            parrilladas y eventos.
        </p>

        <div class="grid-cortes">

            <div class="corte">
                <img src="img/corte1.png" alt="Punta de S">

                <div class="informacion-corte">
                    <h3>Punta de S</h3>

                    <p>
                        Corte jugoso y sabroso, recomendado para preparar
                        a la parrilla.
                    </p>

                    <a href="#contacto" class="boton-corte">
                        Consultar
                    </a>
                </div>
            </div>

            <div class="corte">
                <img src="img/corte2.png" alt="Bife chorizo">

                <div class="informacion-corte">
                    <h3>Bife Chorizo</h3>

                    <p>
                        Carne tierna con buen sabor, ideal para cocinar
                        a la plancha o a la parrilla.
                    </p>

                    <a href="#contacto" class="boton-corte">
                        Consultar
                    </a>
                </div>
            </div>

            <div class="corte">
                <img src="img/corte3.png" alt="Costilla de res">

                <div class="informacion-corte">
                    <h3>Costilla</h3>

                    <p>
                        Corte con hueso y bastante sabor, perfecto para
                        compartir en una parrillada.
                    </p>

                    <a href="#contacto" class="boton-corte">
                        Consultar
                    </a>
                </div>
            </div>

            <div class="corte">
                <img src="img/corte4.png" alt="Lomito de res">

                <div class="informacion-corte">
                    <h3>Lomito</h3>

                    <p>
                        Uno de los cortes más suaves de la res, recomendado
                        para bistecs y medallones.
                    </p>

                    <a href="#contacto" class="boton-corte">
                        Consultar
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
