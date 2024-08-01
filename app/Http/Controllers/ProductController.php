<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Mostrar todos los productos
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    //Crear un nuevo producto
    public function store(Request $request)
    {
        //Validaciones de los campos en payload en lugar de usar JOI usamos Validator para no tener que instalar JOI y node.js
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        //Si falla la validación, se retorna un mensaje de error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'product' => $product
        ], 201);
    }

    //Actualizar un producto existente
    public function update(Request $request, $id)
    {
        //Validaciones de los campos en payload en lugar de usar JOI usamos Validator para no tener que instalar JOI y node.js
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        //Si falla la validación, se retorna un mensaje de error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Se busca el producto por el id
        $product = Product::findOrFail($id);
        //Se actualizan los campos del producto
        $product->update($request->all());

        return response()->json($product);
    }

    //Eliminar un producto
    public function destroy($id)
    {
        //Se busca el producto por el id
        $product = Product::find($id);

        //Si no se encuentra el producto, se retorna un mensaje de error
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        //Se elimina el producto
        $product->delete();
        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }
}
