<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';

    protected $fillable = [
        'nombre', 'distrito', 'direccion',
        'horario', 'lat', 'lng', 'telefono', 'activo',
    ];
}
