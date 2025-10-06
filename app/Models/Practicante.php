<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practicante extends Model
{
     protected $table = 'practicante';
     protected $primaryKey = 'id_practicante';
    public $timestamps = false;
     protected $fillable = [
        'nombre',
        'edad',
        'telefono',
        'institucion',
        'carrera',
        'area'
    ];
}
