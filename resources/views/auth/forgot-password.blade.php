<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña | ConsultaFlex</title>
    <!-- Favicon -->
    <link rel="icon" href="images/logo.png" type="image/png">
</head>

<x-guest-layout>
    <!-- Mensaje de información en español -->
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <strong>¿Olvidaste tu contraseña?</strong> No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña, lo que te permitirá elegir una nueva.
    </div>

    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Campo de correo electrónico -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Correo electrónico')" class="input-label" />
            <x-text-input id="email" class="block mt-1 w-full input-field" type="email" name="email" :value="old('email')" required autofocus placeholder="Ingresa tu correo electrónico" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botón de envío centrado -->
        <div class="flex justify-center mt-6">
            <x-primary-button class="primary-button">
                {{ __('Enviar enlace para restablecer contraseña') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<!-- Estilos para la coherencia visual -->
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f0f4f9;
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Alineación superior para acercar el contenido */
        min-height: 100vh; /* Usar min-height en lugar de height */
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .text-gray-600 {
        color: #777; /* Gris claro para los textos */
    }

    .dark\:text-gray-400 {
        color: #a1a1a1; /* Gris para el modo oscuro */
    }

    .input-label {
        font-weight: bold;
        color: #003566; /* Color azul para la etiqueta del correo */
        margin-bottom: 0.5rem;
        display: block;
    }

    .input-field {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        font-size: 1rem;
        color: #333;
        margin-top: 0.5rem;
        box-sizing: border-box;
    }

    .input-field:focus {
        border-color: #003566; /* Azul al enfocar */
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
    }

    .primary-button {
        background-color: #003566; /* Azul oscuro */
        color: white;
        padding: 0.5rem 1.5rem; /* Menos padding para hacerlo más pequeño */
        border: none;
        border-radius: 5px;
        font-size: 0.875rem; /* Tamaño de fuente reducido */
        cursor: pointer;
        width: auto;
        transition: background-color 0.3s ease;
    }

    .primary-button:hover {
        background-color: #002244; /* Azul más oscuro al pasar el mouse */
    }

    .flex.justify-center {
        display: flex;
        justify-content: center;
    }
</style>
