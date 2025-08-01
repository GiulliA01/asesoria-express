<x-app-layout>
    <!-- Encabezado de la página, muestra el título "Profile" -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil') }}  <!-- Título de la página, "Perfil" -->
        </h2>
    </x-slot>

    <!-- Contenido principal de la página -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Sección para actualizar la información del perfil -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Incluir el formulario para actualizar la información del perfil -->
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Sección para cambiar la contraseña -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Incluir el formulario para actualizar la contraseña -->
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Sección para eliminar la cuenta de usuario -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Incluir el formulario para eliminar la cuenta del usuario -->
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
