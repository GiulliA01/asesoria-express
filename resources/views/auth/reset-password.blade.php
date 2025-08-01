<x-guest-layout>
    <!-- Formulario para el restablecimiento de contraseña -->
    <form method="POST" action="{{ route('password.store') }}">
        <!-- Se incluye un token CSRF para proteger el formulario contra ataques -->
        @csrf

        <!-- Token de restablecimiento de contraseña, se obtiene de la URL de la solicitud -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Campo para ingresar el correo electrónico del usuario -->
        <div>
            <!-- Etiqueta para el campo de correo electrónico -->
            <x-input-label for="email" :value="__('Email')" />

            <!-- Campo de entrada de correo electrónico -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />

            <!-- Mensaje de error si el campo de correo electrónico no es válido -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo para ingresar la nueva contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de contraseña -->
            <x-input-label for="password" :value="__('Password')" />

            <!-- Campo de entrada de la nueva contraseña -->
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <!-- Mensaje de error si la contraseña no es válida -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Campo para confirmar la nueva contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de confirmación de contraseña -->
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <!-- Campo de entrada para confirmar la nueva contraseña -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <!-- Mensaje de error si la confirmación de contraseña no coincide -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón para enviar el formulario y restablecer la contraseña -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}  <!-- Texto del botón -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
