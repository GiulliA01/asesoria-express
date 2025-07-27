<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_id')->constrained('consultas');  // Relación con consultas
            $table->foreignId('usuario_id')->constrained('usuarios');  // Relación con usuarios (quien responde)
            $table->text('contenido');  // Contenido de la respuesta
            $table->foreignId('created_by')->nullable()->constrained('usuarios'); // Usuario que creó la respuesta
            $table->foreignId('updated_by')->nullable()->constrained('usuarios'); // Usuario que actualizó la respuesta
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responses');
    }
};
