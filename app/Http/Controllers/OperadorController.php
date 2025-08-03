<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperadorController extends Controller
{
    /**
     * Mostrar las consultas asignadas al operador.
     */
    public function index(Request $request)
    {
        // Filtrar las consultas asignadas al operador
        $consultas = Consulta::whereHas('operatorConsultations', function ($query) {
            $query->where('operator_id', Auth::id());
        })->whereIn('estado', ['pendiente', 'en proceso'])->get();

        // Consultas finalizadas
        $finalizadas = Consulta::where('estado', 'finalizado')
            ->whereHas('operatorConsultations', function ($query) {
                $query->where('operator_id', Auth::id());
            })
            ->get();

        // Pasar las consultas a la vista
        return view('operador.dashboard', compact('consultas', 'finalizadas'));
    }

    /**
     * Aceptar una consulta asignada.
     */
    public function accept(Consulta $consulta)
    {
        // Verificar que la consulta está asignada al operador
        if ($consulta->operatorConsultations->contains('operator_id', Auth::id())) {
            $consulta->update(['estado' => 'en proceso']);
            return redirect()->route('operador.dashboard')->with('success', 'Consulta aceptada.');
        }

        return redirect()->route('operador.dashboard')->with('error', 'No está autorizado a aceptar esta consulta.');
    }

    /**
     * Rechazar una consulta asignada.
     */
    public function reject(Consulta $consulta)
    {
        // Verificar que la consulta está asignada al operador
        if ($consulta->operatorConsultations->contains('operator_id', Auth::id())) {
            $consulta->update(['estado' => 'rechazada']);
            return redirect()->route('operador.dashboard')->with('success', 'Consulta rechazada.');
        }

        return redirect()->route('operador.dashboard')->with('error', 'No está autorizado a rechazar esta consulta.');
    }

    /**
     * Ver los mensajes de una consulta en proceso.
     */
    public function messages(Consulta $consulta)
    {
        // Asegurarse de que el operador tiene acceso a la consulta en proceso
        if ($consulta->estado != 'en proceso' || !$consulta->operatorConsultations->contains('operator_id', Auth::id())) {
            return redirect()->route('operador.dashboard')->with('error', 'Acción no permitida.');
        }

        // Pasar los mensajes a la vista
        return view('operador.messages', compact('consulta'));
    }
}
