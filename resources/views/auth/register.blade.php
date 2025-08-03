<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | ConsultaFlex</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
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
            flex-direction: row-reverse; 
            width: 90%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: auto;
        }

        .image-container {
            flex: 0.7;
            background: url('https://via.placeholder.com/400x500?text=Imagen+Login') no-repeat center center;
            background-size: contain;
            background-position: center;
            min-width: 300px;
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
            color: #777;
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

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
            font-size: 1.3rem;
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
            color: #777;
        }

        .forgot-password a,
        .register-link a {
            color: #003566;
            text-decoration: none;
        }

        .forgot-password a:hover,
        .register-link a:hover {
            text-decoration: underline;
        }

        /* Mejoras en los mensajes de éxito y error */
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-success {
            background-color: #4CAF50;
        }

        .alert-error {
            background-color: #f44336;
        }

        .alert .icon {
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .alert .close-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #fff;
            cursor: pointer;
        }

        .alert .close-btn:hover {
            color: #ddd;
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
        <div class="image-container" style="background-image: url('{{ asset('images/logo.png') }}');"></div>

        <div class="form-container">
            <h2>Crear Cuenta</h2>

            <!-- Mostrar el mensaje de éxito (si existe) -->
            @if(session('success'))
                <div class="alert alert-success">
                    <span class="icon"><i class="fas fa-check-circle"></i></span>
                    {{ session('success') }}
                    <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif

            <!-- Mostrar los errores generales de validación -->
            @if($errors->any())
                <div class="alert alert-error">
                    <span class="icon"><i class="fas fa-exclamation-circle"></i></span>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <label for="name" class="input-label">{{ __('Nombre') }}</label>
                    <input id="name" class="input-field" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ingresa tu nombre y apellido" />
                    @error('name') <p class="error-message" style="color: red;">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="email" class="input-label">{{ __('Correo electrónico') }}</label>
                    <input id="email" class="input-field" type="email" name="email" value="{{ old('email') }}" required placeholder="Ingresa tu correo electrónico" />
                    @error('email') <p class="error-message" style="color: red;">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="password" class="input-label">{{ __('Contraseña') }}</label>
                    <input id="password" class="input-field" type="password" name="password" required placeholder="Ingresa una contraseña" />
                    <span class="eye-icon" onclick="togglePassword('password')"><i class="fas fa-eye" id="eye-icon"></i></span>
                    @error('password') <p class="error-message" style="color: red;">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="password_confirmation" class="input-label">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required placeholder="Repite tu contraseña" />
                    <span class="eye-icon" onclick="togglePassword('password_confirmation')"><i class="fas fa-eye" id="eye-icon"></i></span>
                    @error('password_confirmation') <p class="error-message" style="color: red;">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="rol" class="input-label">{{ __('Seleccionar Rol') }}</label>
                    <select name="rol" id="rol" class="input-field">
                        <option value="cliente" {{ old('rol', 'cliente') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                        <option value="admin" {{ old('rol', 'cliente') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <button type="submit" class="btn">{{ __('Registrarse') }}</button>

                <div class="forgot-password">
                    <a href="{{ route('login') }}">{{ __('¿Ya tienes cuenta? Iniciar sesión') }}</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para mostrar y ocultar la contraseña
        function togglePassword(id) {
            const passwordField = document.getElementById(id);
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
