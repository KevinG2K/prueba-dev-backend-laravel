<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Obtiene todos los productos.
     */
    public function index()
    {
        return response()->json(Producto::all(), 200);
    }

    /**
     * Crea un nuevo producto con los datos proporcionados en la solicitud.
     */
    public function store(Request $request)
    {
        // Si hay errores de validación, devuelve una respuesta JSON con los errores
        $datosValidados = $this->validateRequest($request);
        if (isset($datosValidados['status'])) {
            return response()->json($datosValidados);
        }

        $imagenPath = $this->saveImagen($request);
        $datosValidados['imagen'] = $imagenPath;
        $producto = Producto::create($datosValidados);

        return response()->json($producto, 201);
    }

    /**
     * Muestra un producto específico de acuerdo a su ID.
     */
    public function show($id)
    {
        // Si el producto no se encuentra, devuelve una respuesta de error
        $respuesta = $this->findProducto($id);
        if ($respuesta->getStatusCode() != 200) {
            return $respuesta;
        }

        $producto = Producto::find($id);
        return response()->json($producto, 200);
    }

    /**
     * Actualiza un producto existente de acuerdo a su ID.
     */
    public function update(Request $request, $id)
    {
        // Si el producto no se encuentra, devuelve una respuesta de error
        $respuesta = $this->findProducto($id);
        if ($respuesta->getStatusCode() != 200) {
            return $respuesta;
        }

        // Si hay errores de validación, devuelve una respuesta JSON con los errores
        $datosValidados = $this->validateRequest($request);
        if (isset($datosValidados['status'])) {
            return response()->json($datosValidados);
        }

        $producto = Producto::find($id);
        $imagenPath = $this->saveImagen($request, $producto->imagen);
        $datosValidados['imagen'] = $imagenPath;
        $producto->update($datosValidados);
        return response()->json($producto, 201);
    }

    /**
     * Elimina un producto específico de acuerdo a su ID.
     */
    public function destroy($id)
    {
        // Si el producto no se encuentra, devuelve una respuesta de error
        $respuesta = $this->findProducto($id);
        if ($respuesta->getStatusCode() != 200) {
            return $respuesta;
        }

        $producto = Producto::find($id);
        $producto->delete();

        return response()->json(['mensaje' => 'El producto fue eliminado correctamente']);
    }

    /**
     * Valida los datos de la solicitud para crear o actualizar un producto.
     */
    private function validateRequest(Request $request)
    {
        $regexNombre = 'regex:/^[a-zA-Z\s]+$/';
        $regexDescripcion = 'regex:/^[a-zA-Z0-9\s\-\.,]+$/';

        $validator = Validator::make($request->all(), [
            'nombre' => "required|string|max:30|$regexNombre",
            'descripcion' => "required|string|$regexDescripcion",
            'precio' => "required|numeric|max:999999.99",
            'cantidad' => "required|integer",
            'categoria_id' => "nullable|integer|exists:categorias,id",
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return [
                'message' => 'Los datos son inválidos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
        }
    
        return $validator->validated();
    }

    /**
     * Guarda la imagen en el directorio 'productos' dentro de la carpeta públic
     */
    private function saveImagen(Request $request, string $imagenPath = null)
    {
        if ($request->hasFile('imagen')) {
            $uuid = random_int(1, 100);
            $file = $request->file('imagen');
            $nombreArchivo = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $nuevoNombre = $nombreArchivo . '_' . $uuid . '.' . $extension;
            $imagenPath = $file->storeAs('productos', $nuevoNombre, 'public');
        }

        return $imagenPath;
    }

    /**
     * Busca un producto por su ID y devuelve una respuesta JSON si no se encuentra.
     * 
     * Caso contrario, devuelve un código de estado 200.
     */
    private function findProducto($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['mensaje' => 'El producto no fue encontrado'], 404);
        } 
        return response()->json(null, 200);
    }
}
