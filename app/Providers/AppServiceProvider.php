<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Usuario;
use App\Models\Consulta;
use App\Models\Response;
use App\Observers\UsuarioObserver;
use App\Observers\ConsultaObserver;
use App\Observers\ResponseObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Registrar el observador para el modelo Usuario
        Usuario::observe(UsuarioObserver::class);

        // Registrar el observador para el modelo Consulta
        Consulta::observe(ConsultaObserver::class);

        // Registrar el observador para el modelo Response
        Response::observe(ResponseObserver::class);
    }

    public function register()
    {
        //
    }
}


