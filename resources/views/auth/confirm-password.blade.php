<x-guest-layout>
    <!-- Mensaje informativo que aparece en la vista -->
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Confirma tu contraseña para acceder.') }}
    </div>

    <!-- Formulario que se envía para confirmar la contraseña del usuario -->
    <form method="POST" action="{{ route('password.confirm') }}">
        <!-- Token CSRF para proteger el formulario contra ataques -->
        @csrf

        <!-- Campo para ingresar la contraseña -->
        <div>
            <!-- Etiqueta del campo de la contraseña -->
            <x-input-label for="password" :value="__('Password')" />

            <!-- Input para la contraseña -->
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"  <!-- Campo tipo password (oculta los caracteres) -->
                            name="password"  <!-- Nombre del campo -->
                            required autocomplete="current-password" />  <!-- Requiere y sugiere el valor de la contraseña actual -->

            <!-- Mensaje de error en caso de que no se valide correctamente -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botón para enviar el formulario -->
        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}  <!-- Texto del botón -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

