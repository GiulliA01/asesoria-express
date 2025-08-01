<section>
    <!-- Título de la sección para actualizar la contraseña -->
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Actualizar contraseña') }}  <!-- Título de la sección -->
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerla segura.') }}
        </p>
    </header>

    <!-- Formulario para actualizar la contraseña -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf  <!-- Token de seguridad para evitar ataques de CSRF -->
        @method('put')  <!-- Usamos el método PUT para actualizar los datos -->

        <!-- Campo para la contraseña actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña actual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Campo para la nueva contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva contraseña')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Campo para confirmar la nueva contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar nueva contraseña')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón para guardar la nueva contraseña -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>  <!-- Botón para guardar la nueva contraseña -->

            <!-- Mensaje de confirmación después de guardar -->
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"  <!-- Muestra el mensaje temporalmente -->
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"  <!-- Oculta el mensaje después de 2 segundos -->
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Guardado.') }}</p>  <!-- Mensaje que muestra que la contraseña fue guardada correctamente -->
            @endif
        </div>
    </form>
</section>
