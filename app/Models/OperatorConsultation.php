<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorConsultation extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si no es el plural del nombre del modelo
    protected $table = 'operator_consultations';

    // Los campos que se pueden asignar masivamente (método de inserción segura)
    protected $fillable = [
        'consulta_id', 
        'operator_id', 
        'status'
    ];

    // Relación con el modelo 'Consulta'
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }

    // Relación con el modelo 'User' (Operador)
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
