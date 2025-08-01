<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Definimos las constantes para los roles
    const ROLE_CLIENTE = 'cliente';
    const ROLE_OPERADOR = 'operador';

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',  // Asegúrate de incluir 'rol' aquí
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Método para verificar si el usuario es un cliente
    public function isCliente()
    {
        return $this->rol === self::ROLE_CLIENTE;
    }

    // Método para verificar si el usuario es un operador
    public function isOperador()
    {
        return $this->rol === self::ROLE_OPERADOR;
    }

    /**
     * Relación de muchos a muchos con consultas (a través de OperatorConsultation).
     */
    public function operatorConsultations()
    {
        return $this->belongsToMany(Consulta::class, 'operator_consultations', 'operator_id', 'consulta_id')
                    ->withPivot('status') // Incluye el campo 'status' que existe en la tabla pivot
                    ->whereIn('status', ['pending', 'in_process']); // Filtra por los estados deseados
    }
}
