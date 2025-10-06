<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $table = 'control';
    protected $primaryKey = 'id_control';
    public $timestamps = false;
    protected $fillable = [
        'id_supervisor',
        'id_practicante',
        'fecha_control',
        'comentario',
    ];

}