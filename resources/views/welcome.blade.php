<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Poppins', sans-serif;
            color: #002244;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #003566;
            font-size: 2.5rem;
            font-weight: 600;
        }
        p {
            color: #555;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #003566;
            border-color: #003566;
        }
        .btn-primary:hover {
            background-color: #002244;
            border-color: #002244;
        }
        .text-center {
            text-align: center;
        }
        .welcome-msg {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @if($role == 'operador')
            <h1 class="text-center">¡Bienvenido, {{ Auth::user()->name }}!</h1>
            <p class="text-center">Aquí puedes gestionar las configuraciones y acceder a la información exclusiva de los operadores.</p>
        @elseif($role == 'cliente')
            <h1 class="text-center">¡Bienvenido, {{ Auth::user()->name }}!</h1>
            <p class="text-center">Aquí puedes ver y gestionar tus detalles y servicios como cliente.</p>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Comenzar Asesoría</a>
        </div>
    </div>
</body>
</html>
