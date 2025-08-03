@extends('layouts.app')

@section('content')
<!-- Estilos CSS para la vista -->
<style>
    /* Diseño base y responsivo */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 650px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
        text-align: center;
        color: #003566;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 25px;
    }

    label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 14px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1em;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #003566;
        outline: none;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
    }

    button {
        width: 100%;
        padding: 14px;
        background-color: #002244;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 1.2em;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    button:hover {
        background-color: #003566;
        transform: translateY(-2px);
    }

    button:active {
        transform: translateY(0);
    }

    /* Estilos Responsivos para tablet y celular */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 1.6em;
        }

        .form-group label {
            font-size: 1.1em;
        }

        .form-control {
            font-size: 1.1em;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 15px;
        }

        h2 {
            font-size: 1.4em;
        }

        .form-group label {
            font-size: 1.2em;
        }

        .form-control {
            padding: 12px;
            font-size: 1em;
        }

        button {
            font-size: 1.1em;
        }
    }
</style>

<!-- Título de la pestaña del navegador -->
@section('title', 'Creación de Consulta | ConsultaFlex')

<!-- Contenido de la página -->
<div class="container">
    <h2>Crear Nueva Consulta</h2>

    <!-- Mostrar el mensaje de éxito si está presente -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar el mensaje de error si existe -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <!-- Formulario para crear consulta -->
    <form action="{{ route('consultas.store') }}" method="POST">
        @csrf

        <!-- Campo de Título (Asunto) -->
        <div class="form-group">
            <label for="titulo">Asunto</label>
            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Pregunta general + Nivel: Principiante, Intermedio, Experto" required>
        </div>

        <!-- Campo de Descripción -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="5" placeholder="Cuéntanos tu caso y haz hasta 2 preguntas" required></textarea>
        </div>

        <!-- Botón de Enviar -->
        <button type="submit">Enviar Consulta</button>
    </form>
</div>
@endsection
