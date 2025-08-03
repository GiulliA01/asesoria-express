<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título dinámico de la página -->
    <title>@yield('title', 'ConsultaFlex')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Cargar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Cargar los estilos con Vite (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Personalización de Estilos -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f9; /* Fondo gris claro */
            margin: 0;
            padding: 0;
        }

        /* Barra de navegación */
        .navbar {
            background-color: #fff; /* Blanco para navbar */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Logo y título */
        .navbar-brand {
            font-weight: bold;
            color: #003566; /* Azul */
            display: flex;
            align-items: center;
            font-size: 1.8rem; /* Aumentar tamaño */
        }

        .navbar-brand img {
            width: 35px; /* Tamaño del logo */
            margin-right: 10px;
        }

        .navbar-brand span {
            color: #003566;
            font-weight: bold;
            font-size: 2rem; /* Hacer "C" y "F" más grandes */
        }

        .navbar-nav .nav-link {
            color: #6c757d; /* Gris oscuro */
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover {
            color: #003566;
        }

        .nav-link.active {
        color: #003566; /* Color personalizado para el enlace activo */
        font-weight: bold; /* O puedes hacer que se vea más destacado */
    }

        footer {
            background-color: #fff;
            padding: 1rem 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
            color: #003566;
        }

        /* Ajustes para el contenedor principal */
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        h1, h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #003566;
            border: none;
            font-size: 16px;
            padding: 12px 24px;
            text-transform: uppercase;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-primary:focus, .btn-primary:active {
            outline: none;
            box-shadow: none;
        }

        /* Diseño responsivo para pantallas pequeñas (móviles) */
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                font-size: 14px;
            }

            /* Establecer tamaño fijo para el botón de menú sin alterar el efecto */
            .navbar-toggler {
                background-color: #003566;
                width: 56px; /* Ancho de 56px */
                height: 40px; /* Alto de 40px */
                border-radius: 5px; /* Bordes redondeados */
                padding: 0; /* Eliminar relleno interno */
                display: flex;
                justify-content: center; /* Centrar el icono horizontalmente */
                align-items: center; /* Centrar el icono verticalmente */
                border: none; /* Eliminar borde del botón */
            }

            /* Establecer el tamaño y estilo del icono dentro del botón */
            .navbar-toggler-icon {
                width: 30px; /* Ancho de las barras */
                height: 3px; /* Grosor de las barras */
                background-color: white;
                border-radius: 2px; /* Bordes redondeados */
                position: relative; /* Para poder ajustar las barras */
            }

            /* Estilo para las tres barras de la hamburguesa (si es necesario) */
            .navbar-toggler-icon::before,
            .navbar-toggler-icon::after {
                content: "";
                display: block;
                position: absolute;
                width: 30px;
                height: 3px;
                background-color: white;
                border-radius: 2px;
            }

            /* Barra superior */
            .navbar-toggler-icon::before {
                top: -8px; /* Desplazar la barra superior hacia arriba */
            }

            /* Barra inferior */
            .navbar-toggler-icon::after {
                bottom: -8px; /* Desplazar la barra inferior hacia abajo */
            }

            footer p {
                font-size: 14px;
            }

            .container {
                padding: 1.5rem;
            }

            /* Ajustar el logo en móvil */
            .navbar-brand {
                font-size: 1.4rem; /* Reducir tamaño de la fuente en móvil */
            }

            /* Esconder el logo y título en el móvil */
            .navbar-brand span {
                font-size: 1.5rem; /* Tamaño del texto ajustado */
            }
        }

    </style>
</head>
<body>    
<!-- Contenedor principal -->
    <div class="min-h-screen d-flex flex-column">
        
        <!-- Barra de navegación -->
        <header>
            <!-- Barra de navegación -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <!-- Logo y Título de Navegación -->
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        <span>ConsultaFlex</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            @auth
                                @if (Auth::user()->rol == 'cliente')
                                    <!-- Opciones para 'cliente' -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Mis Consultas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('consultas.create') ? 'active' : '' }}" href="{{ route('consultas.create') }}">Crear Consulta</a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="nav-link btn btn-link text-decoration-none">
                                                <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                                            </button>
                                        </form>
                                    </li>

                                @elseif (Auth::user()->rol == 'operador')
                                    <!-- Opciones para 'operador' -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('operador.dashboard') ? 'active' : '' }}" href="{{ route('operador.dashboard') }}">Dashboard Operador</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('operador.consultas') ? 'active' : '' }}" href="{{ route('operador.consultas') }}">Gestión Consultas</a>
                                    </li>
                                    <!-- Opción de Cerrar Sesión -->
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="nav-link btn btn-link text-decoration-none">
                                                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Contenido principal -->
        <main class="flex-grow-1">
            @yield('content') <!-- Aquí se inserta el contenido específico de cada página -->
        </main>

        <!-- Pie de página -->
        <footer class="mt-auto">
            <div class="text-center">
                <p>&copy; 2025 <strong>Giullia Arias</strong>. Proyecto Técnico de Desarrollo Web.</p>
            </div>
        </footer>

    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
