<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConsultaController; // Importar el controlador de consultas
use Illuminate\Support\Facades\Route;

// Ruta principal (home) de la aplicación
Route::get('/', function () {
    return redirect()->route('welcome');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Ruta para la pantalla de bienvenida con redirección basada en el rol
    Route::get('/welcome', function () {
        $user = auth()->user(); // Obtener el usuario autenticado
        
        // Redirigir dependiendo del rol del usuario
        if ($user->rol === 'operador') {
            return view('welcome', ['role' => 'operador']); // Vista de bienvenida para el operador
        }
        
        return view('welcome', ['role' => 'cliente']); // Vista de bienvenida para el cliente
    })->name('welcome');

    // Dashboard del usuario autenticado
    Route::get('/dashboard', function () {
        $user = auth()->user(); // Obtener el usuario autenticado

        // Redirigir según el rol
        if ($user->rol === 'operador') {
            return view('operador.dashboard'); // Vista para operador
        }

        return view('cliente.dashboard'); // Vista para cliente
    })->middleware(['auth'])->name('dashboard');

    // Rutas para el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para las consultas
    Route::get('/crear-consulta', [ConsultaController::class, 'create'])->name('consultas.create');
    Route::post('/crear-consulta', [ConsultaController::class, 'store'])->name('consultas.store');

    // En routes/web.php
    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');

    Route::get('/dashboard', [ConsultaController::class, 'index'])->name('dashboard');

    // Nueva ruta para asignar consultas a operadores
    Route::post('/assign-consulta/{consulta_id}', [ConsultaController::class, 'assignConsultaToOperator']);
    Route::get('/operador/dashboard', [OperadorController::class, 'index'])->name('operator.dashboard');

});

require __DIR__.'/auth.php'; // Cargar las rutas de autenticación
