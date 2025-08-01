<section class="space-y-6">
    <!-- Encabezado de la sección para eliminar la cuenta -->
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Eliminar cuenta') }}  <!-- Título: Eliminar cuenta -->
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
        </p>
    </header>

    <!-- Botón para abrir el modal de confirmación de eliminación -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Eliminar cuenta') }}</x-danger-button>

    <!-- Modal de confirmación de eliminación de cuenta -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <!-- Formulario dentro del modal -->
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <!-- Título del modal: ¿Estás seguro de que deseas eliminar tu cuenta? -->
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Por favor ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de manera permanente.') }}
            </p>

            <!-- Campo para ingresar la contraseña para confirmar la eliminación -->
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Contraseña') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Botones dentro del modal para cancelar o confirmar la eliminación -->
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}  <!-- Botón para cancelar -->
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Eliminar cuenta') }}  <!-- Botón para confirmar eliminación de cuenta -->
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
