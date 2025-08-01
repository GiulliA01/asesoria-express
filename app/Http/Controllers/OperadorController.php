<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\OperatorConsultation;
use App\Models\User;
use Illuminate\Http\Request;

class OperadorController extends Controller
{
    /**
     * Muestra las consultas asignadas y finalizadas al operador.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener consultas asignadas (pendientes y en proceso) al operador actual
        $consultas = Consulta::whereIn('estado', ['pendiente', 'en proceso'])
                             ->whereHas('operatorConsultations', function ($query) {
                                 $query->where('operator_id', auth()->id());
                             })
                             ->get();

        // Obtener consultas finalizadas
        $finalizadas = Consulta::where('estado', 'finalizada')
                               ->whereHas('operatorConsultations', function ($query) {
                                   $query->where('operator_id', auth()->id());
                               })
                               ->get();

        // Pasar los datos a la vista
        return view('operador.dashboard', compact('consultas', 'finalizadas'));
    }

    /**
     * Aceptar una consulta asignada.
     *
     * @param  int  $consulta_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept($consulta_id)
    {
        // Obtener la consulta
        $consulta = Consulta::findOrFail($consulta_id);

        // Cambiar el estado de la consulta a "en proceso"
        $consulta->update(['estado' => 'en proceso']);

        // Marcar la consulta como aceptada para este operador
        $operator_consultation = OperatorConsultation::where('consulta_id', $consulta_id)
                                                     ->where('operator_id', auth()->id())
                                                     ->first();
        $operator_consultation->update(['status' => 'accepted']);

        // Redirigir a la página de consultas
        return redirect()->route('operator.dashboard');
    }

    /**
     * Rechazar una consulta asignada y asignarla a otro operador.
     *
     * @param  int  $consulta_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($consulta_id)
    {
        // Obtener la consulta
        $consulta = Consulta::findOrFail($consulta_id);

        // Cambiar el estado de la consulta a "pendiente" (sin perder la consulta original)
        $consulta->update(['estado' => 'pendiente']); // Mantener el estado como pendiente

        // Cambiar el estado de la consulta a "rechazada" para este operador
        $operator_consultation = OperatorConsultation::where('consulta_id', $consulta_id)
                                                     ->where('operator_id', auth()->id())
                                                     ->first();
        $operator_consultation->update(['status' => 'rejected']); // Marcar la consulta como rechazada

        // Asignar la consulta a otro operador disponible (que no sea el mismo operador)
        $new_operator = User::where('rol', 'operador')->where('id', '!=', auth()->id())->inRandomOrder()->first(); // Excluir el operador que la rechazó
        OperatorConsultation::create([
            'consulta_id' => $consulta->id,
            'operator_id' => $new_operator->id,
            'status' => 'pending',
        ]);

        // Redirigir con mensaje de confirmación
        return redirect()->route('operator.dashboard')->with('message', 'Has rechazado esta consulta. Se te enviará una nueva consulta.');
    }

    /**
     * Mostrar la pantalla de mensajes con el cliente.
     *
     * @param  int  $consulta_id
     * @return \Illuminate\View\View
     */
    public function messages($consulta_id)
    {
        // Obtener la consulta
        $consulta = Consulta::findOrFail($consulta_id);

        // Verificar si el operador tiene acceso a esta consulta
        if ($consulta->operator_id != auth()->id()) {
            return redirect()->route('operator.dashboard')->with('error', 'No tienes acceso a esta consulta.');
        }

        // Obtener los mensajes de la consulta (respuestas)
        $responses = $consulta->responses;

        // Pasar los datos a la vista de mensajería
        return view('operador.messages', compact('consulta', 'responses'));
    }

    /**
     * Enviar un mensaje de respuesta al cliente.
     *
     * @param  Request  $request
     * @param  int  $consulta_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request, $consulta_id)
    {
        // Validar el mensaje
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // Crear la respuesta en la tabla "responses"
        $consulta = Consulta::findOrFail($consulta_id);
        $consulta->responses()->create([
            'user_id' => auth()->id(),
            'contenido' => $request->message,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        // Redirigir a la página de mensajería
        return redirect()->route('operator.messages', $consulta_id)->with('message', 'Tu respuesta fue enviada.');
    }
}
