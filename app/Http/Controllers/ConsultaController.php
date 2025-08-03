<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Muestra el formulario de creación de consulta.
     */
    public function create()
    {
        return view('cliente.crear_consulta');
    }

    /**
     * Almacena la nueva consulta en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Verificar si ya existe una consulta con el mismo título y descripción para el usuario autenticado
        $existingConsulta = Consulta::where('titulo', $request->titulo)
                                    ->where('descripcion', $request->descripcion)
                                    ->where('cliente_id', auth()->id()) // Solo para el cliente autenticado
                                    ->first();

        if ($existingConsulta) {
            // Si la consulta ya existe, redirigir con un mensaje de error
            return back()->withErrors(['error' => 'Ya existe una consulta con este título y descripción.']);
        }

        // Crear la consulta en la base de datos
        $consulta = new Consulta();
        $consulta->titulo = $request->titulo; // Título de la consulta
        $consulta->descripcion = $request->descripcion; // Descripción de la consulta
        $consulta->estado = 'pendiente'; // Estado inicial
        $consulta->cliente_id = auth()->id(); // Asignamos el ID del cliente autenticado
        $consulta->created_by = auth()->id(); // Quien creó la consulta
        $consulta->save();

        // Asignar la consulta al operador disponible
        $this->assignConsultaToOperator($consulta->id);

        // Redirigir con mensaje de éxito
        return back()->with('success', 'Consulta enviada correctamente.');
    }

    /**
     * Asigna una consulta a un operador disponible con menos consultas pendientes.
     *
     * @param  int  $consulta_id
     * @return \Illuminate\Http\Response
     */
    public function assignConsultaToOperator($consulta_id)
    {
        // Verificar si la consulta existe
        $consulta = Consulta::find($consulta_id);
        
        if (!$consulta) {
            // Si no se encuentra la consulta, retornamos un error
            return response()->json(['message' => 'La consulta no existe.'], 404);
        }

        // Buscar todos los operadores con el menor número de consultas pendientes o en proceso
        $operators = User::where('rol', 'operador') // Usamos 'rol' en minúsculas, no 'ROL'
                        ->whereHas('operatorConsultations', function($query) {
                            $query->whereIn('status', ['pending', 'in_process']);
                        })
                        ->withCount('operatorConsultations') // Contamos las consultas del operador
                        ->get();

        // Ordenar en memoria por el número de consultas pendientes o en proceso
        $operator = $operators->sortBy('operatorConsultations_count')->first(); // Operador con menos consultas

        // Si encontramos un operador disponible
        if ($operator) {
            // Asignar la consulta al operador usando el modelo Eloquent
            $operator->operatorConsultations()->attach($consulta_id, ['status' => 'pending']); // Relación de muchos a muchos

            return response()->json(['message' => 'Consulta asignada correctamente al operador.']);
        } else {
            // Si no hay operadores disponibles
            return response()->json(['message' => 'No hay operadores disponibles.'], 404);
        }
    }

    /**
     * Muestra el dashboard con las consultas y los operadores.
     */
    public function index(Request $request)
    {
        // Obtener las consultas del usuario autenticado
        $consultas = Consulta::where('cliente_id', auth()->id()); // Filtrar por el cliente autenticado

        // Filtro por fecha si existe
        if ($request->date_filter) {
            $consultas->whereDate('created_at', $request->date_filter);
        }

        // Filtro por operador (usando el 'operator_id' de la tabla 'operator_consultations')
        if ($request->operator_filter) {
            $consultas->whereHas('operatorConsultations', function ($query) use ($request) {
                $query->where('operator_id', $request->operator_filter);
            });
        }

        // Filtro por estado de la consulta
        if ($request->status_filter) {
            $consultas->where('estado', $request->status_filter);
        }

        // Obtener las consultas filtradas
        $consultas = $consultas->with(['operatorConsultations.operator'])->get();

        // Obtener los operadores únicos que están asociados con las consultas del cliente
        $operators = User::whereIn('id', $consultas->pluck('operator_id')->unique())->get();

        // Asegúrate de pasar la variable 'operators' a la vista
        return view('cliente.dashboard', compact('consultas', 'operators'));
    }
}
