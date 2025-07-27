<?php
namespace App\Observers;

use App\Models\Usuario;

class UsuarioObserver
{
    // Se ejecuta cuando se crea un nuevo registro
    public function creating(Usuario $usuario)
    {
        // Asigna el ID del usuario que está creando el registro
        if (auth()->check()) {
            $usuario->created_by = auth()->id();  // Almacena el ID del usuario autenticado
        }
    }

    // Se ejecuta cuando un registro es actualizado
    public function updating(Usuario $usuario)
    {
        // Asigna el ID del usuario que está actualizando el registro
        if (auth()->check()) {
            $usuario->updated_by = auth()->id();  // Almacena el ID del usuario autenticado
        }
    }
}
