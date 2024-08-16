<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    
    /**
     * Esta relación establece que una categoría puede tener muchos productos.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
