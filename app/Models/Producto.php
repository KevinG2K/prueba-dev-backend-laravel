<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'categoria_id',
        'imagen'
    ];

    /**
     * Esta relación establece que un producto puede pertenecer a una sola categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}