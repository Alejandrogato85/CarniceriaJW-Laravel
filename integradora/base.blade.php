<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ferretería El Tornillo</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            color: #222;
        }

        header {
            background-color: #333;
            color: white;
            padding: 2rem 1rem;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .contenedor {
            width: 90%;
            max-width: 900px;
            margin: 2rem auto;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
        }

        .boton {
            display: inline-block;
            padding: 0.8rem 1.2rem;
            background-color: #333;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .boton:hover {
            background-color: #555;
        }

        footer {
            margin-top: 2rem;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        @media (max-width: 600px) {
            .contenedor {
                width: 95%;
                padding: 1rem;
            }

            header h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>Ferretería El Tornillo</h1>
    </header>

    <main class="contenedor">
        @yield('contenido')
    </main>

    <footer>
        Integradora - TU NOMBRE COMPLETO - 18 de agosto de 2026
    </footer>

</body>

</html>
