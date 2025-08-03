<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Solo agregar la columna 'rol' si no existe
            $table->enum('rol', ['cliente', 'operador', 'gerente'])->default('cliente')->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la columna 'rol' si se revierte la migración
            $table->dropColumn('rol');
        });
    }
}
