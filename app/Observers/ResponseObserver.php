<?php

namespace App\Observers;

use App\Models\Response;

class ResponseObserver

{
    public function creating(Response $response)
    {
        if (auth()->check()) {
            $response->created_by = auth()->id();  // Asigna quien creó la respuesta
        }
    }

    
    public function updating(Response $response)
    {
        if (auth()->check()) {
            $response->updated_by = auth()->id();  // Asigna quien actualizó la respuesta
        }
    }
}

