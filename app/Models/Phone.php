<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_internacional',
        'codigo_operador',
        'nrotelefono',
        'whatsapp'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function telefono()
    {
        return $this->hasOne(Phone::class);
    }
}
