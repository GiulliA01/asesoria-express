<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @if($role == 'operador')
            <h1 class="text-center">¡Bienvenido, Operador!</h1>
            <p class="text-center">Aquí puedes gestionar las configuraciones y acceder a la información exclusiva de los operadores.</p>
        @elseif($role == 'cliente')
            <h1 class="text-center">¡Bienvenido, Cliente!</h1>
            <p class="text-center">Aquí puedes ver y gestionar tus detalles y servicios como cliente.</p>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Ir al Dashboard</a>
        </div>
    </div>
</body>
</html>
