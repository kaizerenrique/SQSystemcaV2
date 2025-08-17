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
        'sexo',
        'user_id'
    ];

    /**
     * Relación con tabla de user.
     * Persona pertenece a un usuario. 
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function telefono()
    {
        return $this->hasOne(Phone::class);
    }

    public function historial()
    {
        return $this->hasMany(Historial::class);
    }
}
