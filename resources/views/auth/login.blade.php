<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | ConsultaFlex</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <!-- Favicon -->
    <link rel="icon" href="images/logo.png" type="image/png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: row;
            width: 90%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: auto;
        }


        
       .image-container {
            flex: 1;
            background: url('https://via.placeholder.com/400x500?text=Imagen+Login') no-repeat center center;
            background-size: cover;
        }


        .form-container {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #003566;
        }

        .input-label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
            color: #777; /* Gris claro para etiquetas */
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 0.75rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 1rem;
            color: #333;
        }

        .input-field::placeholder {
            color: #aaa;
        }

        /* Aseguramos que el icono del ojo sea visible */
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            color: #aaa; /* Color oscuro para mayor visibilidad */
            cursor: pointer;
            font-size: 1.1rem;
        }

        .btn {
            background-color: #003566;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #002244;
        }

        .forgot-password,
        .register-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #4a4a4a;
        }

        .forgot-password a,
        .register-link a {
            color: #003566;
            text-decoration: none;
            font-weight: bold;
        }

        .forgot-password a:hover,
        .register-link a:hover {
            text-decoration: underline;
        }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding-left: 15px; /* Espacio lateral izquierdo */
            padding-right: 15px; /* Espacio lateral derecho */
            box-sizing: border-box; /* Asegura que el padding no rompa el diseño */
        }

        .form-container {
            width: 100%;
            padding: 1rem 0; /* Solo padding vertical aquí */
        }

        .input-field,
        .btn {
            width: 100%; /* Ya no necesitas calc aquí */
            margin-left: 0;
            margin-right: 0;
        }
    }


    @media (max-width: 400px) {
        .container {
            width: 100%;
            max-width: 320px; /* Limita el ancho máximo en celulares */
            margin: 0 auto;
            padding-left: 20px;
            padding-right: 20px;
            box-sizing: border-box;
        }

        .form-container {
            padding: 1rem 0;
        }

        .input-field,
        .btn {
            font-size: 0.95rem;
            padding: 0.65rem;
            width: 100%;
        }

        h2 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .forgot-password,
        .register-link {
            font-size: 0.85rem;
        }
    }
    </style>



</head>

<div class="container">    
    <div class="image-container" style="background-image: url('{{ asset('images/logo.png') }}');"></div>

    <div class="form-container">
        <h2>Iniciar Sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <x-input-label for="email" :value="__('Correo Electrónico')" class="input-label" />
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Ingresa tu correo" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <div class="input-group">
                <x-input-label for="password" :value="__('Contraseña')" class="input-label" />
                <input id="password" class="input-field" type="password" name="password" required autocomplete="current-password" placeholder="Ingresa tu contraseña" />
                <span class="eye-icon" id="toggle-password">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </span>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <div class="mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-[#777]">{{ __('Recordar') }}</span>
                </label>
            </div>

            <button type="submit" class="btn">{{ __('Iniciar Sesión') }}</button>

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
            </div>

            <div class="register-link">
                <span>{{ __('¿No tienes cuenta?') }}</span>
                <a href="{{ route('register') }}">{{ __('Regístrate aquí') }}</a>
            </div>
        </form>
    </div>
</div>

<script>
    const togglePassword = document.querySelector("#toggle-password");
    const passwordInput = document.querySelector("#password");
    const eyeIcon = document.querySelector("#eye-icon");

    togglePassword.addEventListener("click", function () {
        const type = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = type;
        eyeIcon.classList.toggle("fa-eye");
        eyeIcon.classList.toggle("fa-eye-slash");
    });
</script>
