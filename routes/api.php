<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductBatchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*RUTAS DE LOGIN */

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

/*RUTAS DE PRODUCTOS */
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});
//RUTAS DEL BATCH SEPARADAS PARA EVITAR CONFUCIONES AL MOMENTO DE TESTEAR
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product/batch', [ProductBatchController::class, 'storeBatch']);
    Route::put('/product/batch', [ProductBatchController::class, 'updateBatch']);
    Route::delete('/product/batch', [ProductBatchController::class, 'destroyBatch']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
