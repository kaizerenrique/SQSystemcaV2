<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'rif',
        'nombre'
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
}
