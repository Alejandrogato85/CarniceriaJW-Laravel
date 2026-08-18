<section class="hero-grid contenedor">

    <div class="descripcion-header">

        <h1 class="text-center degradado-rojo">
            Carnicería JW
        </h1>

        <p>
            Tenemos todos los cortes que necesitas para un buen domingo
        </p>

    </div>

    <div class="imagen-hader">

        <picture>

            <source
                srcset="{{ asset('img/imagen-headercar.png') }}"
                type="image/png"
            >

            <img
                loading="lazy"
                decoding="async"
                src="{{ asset('img/imagen-headercar.png') }}"
                alt="Carnicería JW"
            >

        </picture>

    </div>

</section>
