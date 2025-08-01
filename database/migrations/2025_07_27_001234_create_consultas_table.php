<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    public function up()
    {
        // Crear la tabla 'consultas' en la base de datos
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();  // Crea una columna 'id' que será la clave primaria y auto-incremental
            // Relación con la tabla 'usuarios' para almacenar quién es el cliente que hizo la consulta
            $table->foreignId('cliente_id')->constrained('users');  
            // Relación con la tabla 'usuarios' para almacenar quién es el operador que atenderá la consulta
            $table->foreignId('operador_id')->nullable()->constrained('users');  
            // Crea la columna 'titulo' para almacenar el título de la consulta
            $table->string('titulo');  
            // Crea la columna 'descripcion' para almacenar la descripción detallada de la consulta
            $table->text('descripcion');  
            // Crea la columna 'estado' para almacenar el estado de la consulta: 'pendiente', 'en proceso', o 'finalizada'
            $table->enum('estado', ['pendiente', 'en proceso', 'finalizada']);  
            // Relación con la tabla 'usuarios' para almacenar quién creó la consulta
            $table->foreignId('created_by')->nullable()->constrained('users');  
            // Relación con la tabla 'usuarios' para almacenar quién actualizó la consulta
            $table->foreignId('updated_by')->nullable()->constrained('users');  
            // Crea las columnas 'created_at' y 'updated_at' para gestionar las fechas de creación y actualización de la consulta
            $table->timestamps();  
        });
    }

    public function down()
    {
        // Si la migración se revierte, eliminará la tabla 'consultas'
        Schema::dropIfExists('consultas');  
    }
};

