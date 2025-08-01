<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | ConsultaFlex</title>
    <!-- Incluyendo Font Awesome para los iconos de ojo -->
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
            flex-direction: row-reverse; /* Imagen a la derecha */
            width: 90%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: auto;
        }

        .image-container {
            flex: 0.7; /* Aumentamos al 70% del contenedor para hacer la imagen más grande */
            background: url('https://via.placeholder.com/400x500?text=Imagen+Login') no-repeat center center;
            background-size: contain; /* Asegura que la imagen se ajuste sin distorsionarse */
            background-position: center;
            min-width: 300px; /* Aumentamos el tamaño mínimo para asegurar que la imagen no sea demasiado pequeña */
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

        /* Estilos para el icono de ojo */
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
            font-size: 1.3rem; /* Aumento el tamaño del icono */
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
            color: #777; /* Gris */
        }

        .forgot-password a,
        .register-link a {
            color: #003566; /* Color azul para los enlaces */
            text-decoration: none;
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
                padding-left: 15px; 
                padding-right: 15px;
                box-sizing: border-box;
            }

            .form-container {
                width: 100%;
                padding: 1rem 0;
            }

            .input-field,
            .btn {
                width: 100%;
                margin-left: 0;
                margin-right: 0;
            }
        }

        @media (max-width: 400px) {
            .container {
                width: 100%;
                max-width: 320px;
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

<body>

    <div class="container">
        <!-- Imagen de fondo a la derecha -->
        <div class="image-container" style="background-image: url('{{ asset('images/logo.png') }}');"></div>

        <div class="form-container">
            <h2>Crear Cuenta</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="input-group">
                    <label for="name" class="input-label">{{ __('Nombre') }}</label>
                    <input id="name" class="input-field" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ingresa tu nombre" />
                    @error('name') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <!-- Correo electrónico -->
                <div class="input-group">
                    <label for="email" class="input-label">{{ __('Correo electrónico') }}</label>
                    <input id="email" class="input-field" type="email" name="email" value="{{ old('email') }}" required placeholder="Ingresa tu correo electrónico" />
                    @error('email') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <!-- Contraseña -->
                <div class="input-group">
                    <label for="password" class="input-label">{{ __('Contraseña') }}</label>
                    <input id="password" class="input-field" type="password" name="password" required placeholder="Ingresa una contraseña" />
                    <span class="eye-icon" onclick="togglePassword('password')"><i class="fas fa-eye" id="eye-icon"></i></span>
                    @error('password') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="input-group">
                    <label for="password_confirmation" class="input-label">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required placeholder="Repite tu contraseña" />
                    <span class="eye-icon" onclick="togglePassword('password_confirmation')"><i class="fas fa-eye" id="eye-icon"></i></span>
                    @error('password_confirmation') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <!-- Rol (Selector) -->
                <div class="input-group">
                    <label for="rol" class="input-label">{{ __('Seleccionar Rol') }}</label>
                    <select name="rol" id="rol" class="input-field">
                        <option value="cliente" {{ old('rol', 'cliente') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                        <option value="operador" {{ old('rol') == 'operador' ? 'selected' : '' }}>Operador</option>
                    </select>
                    @error('rol') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <!-- Enlace para redirección al login y botón de registro -->
                <div class="form-footer">
                    <!-- Texto de enlace "¿Ya tienes cuenta?" en gris -->
                    <span class="register-link" style="color: #4a4a4a; font-size: 0.9rem; text-align: center; margin-top: 1rem;">¿Ya tienes cuenta?</span> 

                    <!-- Enlace "Iniciar sesión" en azul y subrayado al pasar el mouse -->
                    <a href="{{ route('login') }}" class="login-link" style="color: #003566; font-weight: bold; font-size: 0.9rem; text-decoration: none; margin-left: 5px;">
                        Iniciar sesión
                    </a>

                    <!-- Botón de registro -->
                    <button type="submit" class="btn">{{ __('Registrarse') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar la contraseña
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            var type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;
            var icon = document.getElementById("eye-icon");
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }
    </script>


