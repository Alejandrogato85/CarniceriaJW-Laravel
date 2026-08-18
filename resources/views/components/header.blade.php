<header class="header">

    <div class="contendor-nav contenedor">

        <div class="logo" id="menu">
            <a href="{{ route('inicio') }}">
                <img
                    src="{{ asset('img/logo-carni.svg') }}"
                    alt="Logo Carnicería JW"
                >
            </a>
        </div>

        <nav class="nav-li">

            <ul class="enlaces">

                <li class="lista">
                    <a class="enlace" href="{{ route('inicio') }}">
                        Inicio
                    </a>
                </li>

                <li class="lista">
                    <a class="enlace" href="{{ route('nosotros') }}">
                        Nosotros
                    </a>
                </li>

                <li class="lista">
                    <a class="enlace" href="{{ route('cortes') }}">
                        Cortes
                    </a>
                </li>

                <li class="lista">
                    <a class="enlace" href="{{ route('contacto') }}">
                        Contacto
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</header>
