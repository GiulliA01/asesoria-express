<x-guest-layout>
    <!-- Mensaje informativo agradeciendo al usuario por registrarse y pidiéndole que verifique su correo -->
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¡Gracias por registrarte! Antes de empezar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar por correo electrónico? Si no has recibido el correo electrónico, estaremos encantados de enviarte otro.') }}
    </div>

    <!-- Si la sesión contiene el estado "verification-link-sent", significa que se ha enviado un nuevo enlace de verificación -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
        </div>
    @endif

    <!-- Sección con dos formularios: uno para reenviar el correo de verificación y otro para cerrar sesión -->
    <div class="mt-4 flex items-center justify-between">
        
        <!-- Formulario para reenviar el correo de verificación -->
        <form method="POST" action="{{ route('verification.send') }}">
            <!-- Se incluye el token CSRF para proteger el formulario -->
            @csrf

            <div>
                <!-- Botón para reenviar el correo de verificación -->
                <x-primary-button>
                    {{ __('Reenviar verificación') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Formulario para cerrar sesión -->
        <form method="POST" action="{{ route('logout') }}">
            <!-- Token CSRF para proteger la solicitud -->
            @csrf

            <!-- Botón para cerrar sesión -->
            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Salir') }}
            </button>
        </form>
    </div>
</x-guest-layout>
