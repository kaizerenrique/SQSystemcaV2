<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Valorbcv extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     */

     protected $fillable = [
        'valor'
    ];
}
