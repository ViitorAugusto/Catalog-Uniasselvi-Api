<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
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



//cadastro
Route::post('/register', [UserController::class, 'register']);

//login
Route::post('/login', [UserController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [UserController::class, 'getUser']);
    //logout
    Route::post('/logout', [UserController::class, 'logout']);

    //

    //produtos
    Route::post('/products/new-product', [ProductsController::class, 'createProduct']);
    Route::delete('/products/{id}', [ProductsController::class, 'deleteProduct']);
});


//nomenclaturas colocadas de forma errada:
Route::get('/products', [ProductsController::class, 'productsList']);
Route::get('/products/check-title', [ProductsController::class, 'checkTitle']);
Route::get('/products/{slug}', [ProductsController::class, 'showBySlug']);


