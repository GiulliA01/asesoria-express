<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    // Método que se ejecuta al ejecutar la migración
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();  // Crea la columna id que será la clave primaria y auto-incremental
            $table->string('nombre');  // Crea la columna 'nombre' para almacenar el nombre del usuario
            $table->string('email')->unique()->nullable();  // Crea la columna 'email' que debe ser único (no puede repetirse) y es opcional
            $table->string('password');  // Crea la columna 'password' para almacenar la contraseña del usuario
            $table->enum('rol', ['cliente', 'operador']);  // Crea la columna 'rol' que puede tener los valores 'cliente' o 'operador'
            // Crea la columna 'created_by', que se refiere al usuario que creó el registro
            // Se establece como foreign key hacia la tabla 'usuarios' y se puede dejar nula en caso de no tener un creador asignado
            $table->foreignId('created_by')->nullable()->constrained('usuarios'); 

            // Crea la columna 'updated_by', que se refiere al usuario que actualizó el registro
            // Se establece como foreign key hacia la tabla 'usuarios' y se puede dejar nula en caso de no tener un actualizador asignado
            $table->foreignId('updated_by')->nullable()->constrained('usuarios');

            $table->timestamps();  // Crea las columnas 'created_at' y 'updated_at' para gestionar las fechas de creación y actualización
        });
    }

    // Método que se ejecuta al revertir la migración (borrar la tabla)
    public function down()
    {
        Schema::dropIfExists('usuarios');  // Elimina la tabla 'usuarios' si existe
    }
};

