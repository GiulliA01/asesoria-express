<x-app-layout>
    <!-- Header de la página, contiene el título principal de la página (en este caso, "Dashboard") -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}  <!-- Título de la página, "Dashboard" -->
        </h2>
    </x-slot>

    <!-- Contenido principal de la página -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal con fondo blanco o gris oscuro (modo oscuro) y sombra -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Sección que contiene el mensaje principal -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("¡Ya has iniciado sesión!") }}  <!-- Mensaje que muestra al usuario que está autenticado (conectado) -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

