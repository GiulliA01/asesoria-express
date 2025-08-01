@extends('layouts.app')

@section('title', 'Consultas Asignadas | ConsultaFlex')

@section('content')
<div class="container">
    <h3 class="text-center">Consultas Asignadas</h3>

    <!-- Tabla de consultas asignadas (pendientes y en proceso) -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre del Cliente</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Envío</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->cliente->name }}</td>
                    <td>{{ $consulta->titulo }}</td>
                    <td>{{ $consulta->descripcion }}</td>
                    <td>{{ ucfirst($consulta->estado) }}</td>
                    <td>{{ $consulta->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($consulta->estado == 'pendiente')
                            <!-- Botón Visto (aceptar consulta) -->
                            <form action="{{ route('operator.accept', $consulta->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> <!-- Icono de check (Visto) -->
                                </button>
                            </form>

                            <!-- Botón X (rechazar consulta) -->
                            <form action="{{ route('operator.reject', $consulta->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times"></i> <!-- Icono de X -->
                                </button>
                            </form>
                        @elseif($consulta->estado == 'en proceso')
                            <!-- Botón "Ver Mensajes" para consultas en proceso -->
                            <a href="{{ route('operator.messages', $consulta->id) }}" class="btn btn-primary">
                                Ver Mensajes
                            </a>
                        @else
                            <!-- No acción disponible para consultas finalizadas -->
                            <button class="btn btn-secondary" disabled>Consulta Finalizada</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón para ver consultas finalizadas -->
    <button class="btn btn-info" data-toggle="collapse" data-target="#finalizadas">Ver Consultas Finalizadas</button>

    <!-- Sección de consultas finalizadas (por defecto oculta) -->
    <div id="finalizadas" class="collapse mt-3">
        <h4>Consultas Finalizadas</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha de Cierre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($finalizadas as $consulta)
                    <tr>
                        <td>{{ $consulta->titulo }}</td>
                        <td>{{ $consulta->descripcion }}</td>
                        <td>{{ $consulta->cliente->name }}</td>
                        <td>{{ ucfirst($consulta->estado) }}</td>
                        <td>{{ $consulta->updated_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
