<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    // Asegúrate de que los campos estén en el array $fillable
    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'cliente_id',
        'created_by',
    ];

    /**
     * Relación con la tabla operator_consultations (intermedia)
     * Esta relación se usa para obtener todos los operadores asignados a una consulta.
     */
    public function operatorConsultations()
    {
        return $this->hasMany(OperatorConsultation::class, 'consulta_id');
    }

    /**
     * Relación de muchos a muchos con usuarios (operadores) a través de la tabla intermedia.
     * Aquí estamos usando 'operador' como el nombre de la relación en vez de 'operators'.
     */
    public function operador()
    {
        return $this->belongsToMany(User::class, 'operator_consultations', 'consulta_id', 'operator_id')
                    ->withPivot('status') // Incluye el campo 'status' de la tabla pivot
                    ->whereIn('status', ['pending', 'in_process']); // Filtra por los estados deseados
    }
}
