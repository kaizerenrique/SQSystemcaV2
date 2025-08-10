<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombreArchivo',
        'url_simbol',
        'url_code',
        'url_documento'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }
}
