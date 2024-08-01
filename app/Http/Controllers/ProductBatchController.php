<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProductBatchController extends Controller
{
    // OPERACIONES BATCH LAS SEPARE PARA MAYOR CLARIDAD Y ORGANIZACIÓN EN EL CÓDIGO
    // Crear productos en batch
    public function storeBatch(Request $request)
    {
        //Validaciones de los campos en payload en lugar de usar JOI usamos Validator para no tener que instalar JOI y node.js
        $validator = Validator::make($request->all(), [
            '*.name' => 'required|string|max:255',
            '*.description' => 'required|string',
            '*.height' => 'required|numeric',
            '*.length' => 'required|numeric',
            '*.width' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $products = Product::insert($request->all());
        return response()->json([
            'message' => 'Productos en batch creados exitosamente',
            'products' => $products
        ], 201);
    }

    // Actualizar productos en batch
    public function updateBatch(Request $request)
    {
        foreach ($request->all() as $data) {
            if (!isset($data['id'])) {
                continue;
            }

            $product = Product::find($data['id']);
            if ($product) {
                $product->update(array_filter($data));
            } else {
                return response()->json(['error' => 'Producto no encontrado para ID: ' . $data['id']], 404);
            }
        }

        return response()->json(['message' => 'Productos actualizados en batch exitosamente']);
    }

    // Eliminar productos en batch
    public function destroyBatch(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return response()->json(['error' => 'No IDs provided'], 400);
        }

        $deleted = Product::destroy($ids);

        if ($deleted) {
            return response()->json(['message' => 'Productos eliminados exitosamente']);
        } else {
            return response()->json(['error' => 'Productos no encontrados'], 404);
        }
    }
}
