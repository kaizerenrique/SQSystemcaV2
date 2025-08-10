<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nacionalidad',
        'cedula',
        'nombres',
        'apellidos',
        'fnacimiento',
        'sexo'
    ];

    /**
     * Relación con tabla de user.
     * Persona pertenece a un usuario. 
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
