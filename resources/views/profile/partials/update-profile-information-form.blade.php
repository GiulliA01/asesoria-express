<section>
    <!-- Encabezado de la sección para actualizar la información del perfil -->
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del perfil') }}  <!-- Título de la sección -->
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información de tu cuenta y dirección de correo electrónico.") }}
        </p>
    </header>

    <!-- Formulario para enviar un nuevo enlace de verificación al correo del usuario -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf  <!-- Token de seguridad para proteger contra ataques CSRF -->
    </form>

    <!-- Formulario para actualizar la información del perfil -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf  <!-- Token de seguridad para evitar ataques CSRF -->
        @method('patch')  <!-- Usamos PATCH para actualizar parcialmente los datos -->

        <!-- Campo para el nombre del usuario -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />  <!-- Muestra errores si los hay en el campo nombre -->
        </div>

        <!-- Campo para el correo electrónico del usuario -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />  <!-- Muestra errores si los hay en el campo correo electrónico -->

            <!-- Si el usuario no ha verificado su correo electrónico, se muestra el siguiente mensaje -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Tu dirección de correo electrónico no está verificada.') }}

                        <!-- Botón para reenviar el correo de verificación -->
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    <!-- Mensaje de confirmación cuando se envía un nuevo enlace de verificación -->
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botones para guardar los cambios y confirmar si se actualizó el perfil -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>  <!-- Botón para guardar los cambios -->

            <!-- Mensaje que aparece cuando el perfil se actualiza correctamente -->
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"  <!-- El mensaje se muestra durante 2 segundos -->
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"  <!-- Se oculta el mensaje después de 2 segundos -->
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Guardado.') }}</p>  <!-- Mensaje de confirmación -->
            @endif
        </div>
    </form>
</section>
