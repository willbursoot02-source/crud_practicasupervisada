<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
     protected $table = 'supervisor';
     protected $primaryKey = 'id_supervisor';
    public $timestamps = false;
     protected $fillable = [
        'nombre',
        'cui',
        'telefono',
        'correo',
        'cargo',
        'sexo'
    ];
    

    
}