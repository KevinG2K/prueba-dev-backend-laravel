<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra un listado de todos los productos.
     */
    public function index()
    {
        $title = "Listado de Productos";
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('title', 'productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $title = "Crear Producto";
        $categorias = Categoria::all();
        return view('productos.create', compact('title', 'categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $datosValidados = $this->validateRequest($request);
        Producto::create($datosValidados);
        return redirect()->route('productos.index');
    }

    /**
     * Muestra los detalles de un producto específico.
     */
    public function show(Producto $producto)
    {
        $title = "Ver Producto";
        return view('productos.show', compact('title', 'producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Producto $producto)
    {
        $title = "Editar Producto";
        $categorias = Categoria::all();
        return view('productos.edit', compact('title', 'producto', 'categorias'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, Producto $producto)
    {
        $datosValidados = $this->validateRequest($request);
        $producto->update($datosValidados);
        return redirect()->route('productos.index');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }

    /**
     * Valida los datos del formulario de productos.
     */
    private function validateRequest(Request $request)
    {
        // Expresión regular para permitir solo letras y espacios
        $regexNombre = 'regex:/^[a-zA-Z\s]+$/';
        // Expresión regular para permitir letras, números, espacios, guiones, puntos y comas
        $regexDescripcion = 'regex:/^[a-zA-Z0-9\s\-\.,]+$/';

        $datosValidados = $request->validate([
            'nombre' => "required|string|max:30|$regexNombre",
            'descripcion' => "required|string|$regexDescripcion",
            'precio' => "required|numeric|max:999999.99",
            'cantidad' => "required|integer",
            'categoria_id' => "nullable|integer",
        ]);
        return $datosValidados;
    }
}
