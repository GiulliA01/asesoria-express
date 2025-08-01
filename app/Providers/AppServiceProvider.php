<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Consulta;
use App\Models\Response;
use App\Models\User;
use App\Observers\UserObserver;
use App\Observers\ConsultaObserver;
use App\Observers\ResponseObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Registrar el observer para el modelo User
        User::observe(UserObserver::class);  

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


