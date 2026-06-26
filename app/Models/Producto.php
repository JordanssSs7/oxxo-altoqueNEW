<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = ['nombre', 'precio', 'stock', 'imagen', 'categoria_id'];

    public function categoria()
    {
        //belongsTo -> un producto prtenece a una categoria, busca por categoria_id, pero devuelve el nombre, no el ID
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
}
