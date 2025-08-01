@extends('layouts.app')

<!-- Título de la pestaña del navegador -->
@section('title', 'Home | ConsultaFlex')

@section('content')
    <!-- Contenedor principal con fondo y tipografía -->
    <div class="container-fluid" style="background-color: #ffffff; font-family: 'Poppins', sans-serif;">
        <div class="container">
            <!-- Título centrado -->
            <h2 class="text-center" style="color: #003566; padding-top: 30px;">Mis Consultas</h2>

            <!-- Filtros alineados en una sola fila -->
            <form method="GET" action="{{ route('dashboard') }}" class="row justify-content-between align-items-center">
                <div class="form-group col-12 col-md-3">
                    <label for="date_filter">Filtrar por Fecha:</label>
                    <input type="date" name="date_filter" id="date_filter" class="form-control" value="{{ request()->date_filter }}" placeholder="dd/mm/yyyy" title="Formato: dd/mm/yyyy">
                </div>

                <div class="form-group col-12 col-md-3">
                    <label for="operator_filter">Filtrar por Operador:</label>
                    <select name="operator_filter" id="operator_filter" class="form-control">
                        <option value="">Seleccione Operador</option>
                        @foreach($operators as $operator)
                            <option value="{{ $operator->id }}" {{ request()->operator_filter == $operator->id ? 'selected' : '' }}>
                                {{ $operator->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-12 col-md-3">
                    <label for="status_filter">Filtrar por Estado:</label>
                    <select name="status_filter" id="status_filter" class="form-control">
                        <option value="">Seleccione Estado</option>
                        <option value="pendiente" {{ request()->status_filter == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_proceso" {{ request()->status_filter == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="finalizado" {{ request()->status_filter == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                </div>

                <!-- Botón Filtrar, ahora más pequeño y elegante -->
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </form>

            <!-- Tabla de Consultas con desplazamiento horizontal y vertical -->
            <div class="table-responsive mt-4" style="max-height: 400px; overflow-x: auto; overflow-y: auto;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="background-color: #003566; color: white;">
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Título</th> <!-- Nueva columna: Título -->
                            <th class="text-center">Operador</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Si no hay resultados, mostrar un mensaje dentro de la tabla -->
                        @if($consultas->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No se han encontrado consultas con los criterios seleccionados.
                                </td>
                            </tr>
                        @else
                            @foreach($consultas as $consulta)
                                <tr>
                                    <td class="text-center">{{ $consulta->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $consulta->titulo }}</td> <!-- Mostrar el Título de la consulta -->
                                    <td class="text-center">{{ $consulta->operatorConsultations->first()->operator->name ?? 'Sin operador' }}</td>
                                    <td class="text-center">{{ ucfirst($consulta->estado) }}</td>
                                    <td class="text-center">
                                        <!-- Aquí puedes agregar el botón "Ir" en el futuro -->
                                        <button class="btn btn-info">
                                            <i class="fas fa-arrow-right"></i> Ir
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Agregar iconos de FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Agregar CSS personalizado -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
            color: #003566;
            font-weight: 600;
        }

        .table {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #003566;
            color: white;
        }

        .table th, .table td {
            text-align: center; /* Centrado de texto en los campos */
        }

        .btn-primary {
            background-color: #003566;
            border-color: #003566;
        }

        .btn-info {
            background-color: #034078;
            border-color: #034078;
        }

        .form-group label {
            font-weight: bold;
        }

        /* Responsividad para pantallas pequeñas (móviles y tabletas) */
        @media (max-width: 768px) {
            /* Asegurar que los filtros y el botón tengan más espacio entre ellos */
            .form-group {
                margin-bottom: 1rem; /* Agregar espacio entre los filtros */
            }

            /* Asegurarse de que los filtros ocupen todo el ancho disponible y estén separados */
            .col-md-3 {
                margin-bottom: 1rem; /* Espacio entre cada filtro */
                width: 100%; /* Hacer que cada filtro ocupe todo el ancho en móviles */
            }

            .col-md-2 {
                margin-top: 1rem; /* Espacio entre el último filtro y el botón */
                width: 100%; /* Asegurar que el botón ocupe todo el ancho disponible */
            }

            /* Reducir tamaño del botón para móviles */
            .btn {
                font-size: 14px; /* Botón más pequeño en móviles */
            }

            /* Ajustar la altura de los inputs y selects */
            .form-control {
                height: 38px; /* Ajustar la altura de los inputs y select */
            }

            /* Asegurar que los elementos del formulario no estén tan pegados */
            .row {
                gap: 1rem; /* Agregar separación entre los filtros */
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- Agregar script para responsividad (si es necesario) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endpush
