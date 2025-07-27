<?php

namespace App\Observers;

use App\Models\Consulta;

class ConsultaObserver
{
    public function creating(Consulta $consulta)
    {
        if (auth()->check()) {
            $consulta->created_by = auth()->id();  // Asigna quien creó la consulta
        }
    }

    public function updating(Consulta $consulta)
    {
        if (auth()->check()) {
            $consulta->updated_by = auth()->id();  // Asigna quien actualizó la consulta
        }
    }
}
