<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorConsultationsTable extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla 'operator_consultations'.
     *
     * La tabla 'operator_consultations' gestionará la relación entre los operadores y las consultas asignadas.
     * Cada registro representa una consulta asignada a un operador específico, con su estado.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_consultations', function (Blueprint $table) {
            $table->id(); // ID único para cada asignación de consulta a un operador.
            
            // Relación con la tabla 'consultas'.
            $table->foreignId('consulta_id')
                ->constrained('consultas') // Establece que 'consulta_id' hace referencia a la tabla 'consultas'.
                ->onDelete('cascade'); // Si la consulta es eliminada, también se elimina esta asignación.
            
            // Relación con la tabla 'users' para saber qué operador está asignado.
            $table->foreignId('operator_id')
                ->constrained('users') // Establece que 'operator_id' hace referencia a la tabla 'users'.
                ->onDelete('cascade'); // Si el operador es eliminado, también se elimina esta asignación.
            
            // Estado de la consulta: pendiente, aceptada o rechazada.
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                ->default('pending'); // El valor por defecto es 'pending' (pendiente).
            
            $table->timestamps(); // Añade los campos 'created_at' y 'updated_at' automáticamente.
        });
    }

    /**
     * Revierte la migración (elimina la tabla 'operator_consultations').
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_consultations'); // Elimina la tabla 'operator_consultations' si existe.
    }
}
