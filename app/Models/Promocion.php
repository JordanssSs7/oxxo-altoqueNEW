<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promociones';

    protected $fillable = ['producto_id','producto_id_2', 'precio_oferta', 'descripcion'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }

    public function producto2()
    {
        return $this->belongsTo(Producto::class, 'producto_id_2', 'id');
    }
}