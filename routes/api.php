<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//nomenclaturas colocadas de forma errada:
Route::get('/produtos', [ProductsController::class, 'productsList']);
Route::delete('/produtos/{id}', [ProductsController::class, 'deleteProduct']);
Route::get('/products/check-title', [ProductsController::class, 'checkTitle']);
Route::get('/produtos/por-id/{id}', [ProductsController::class, 'getProductById']);
Route::post('/produtos/criar', [ProductsController::class, 'createProduct']);
