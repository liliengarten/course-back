<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/hello', function (Request $request) {
   return response()->json(['message' => 'nothing here']);
});

Route::get('/products', [ProductController::class, 'index']);

Route::post('/signup', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
   Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index']);
   Route::post('/cart/{product}', [\App\Http\Controllers\CartController::class, 'store']);
   Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'destroy']);

   Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store']);
   Route::get('/order', [\App\Http\Controllers\OrderController::class, 'index']);
   Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout']);
});



