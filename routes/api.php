<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductcategoriesController;
use App\Http\Controllers\AuthController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {*/
/*return $request->user();*/
/*});*/


Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('products-categories', [ProductcategoriesController::class, "index"]);
Route::get("get-products", [ProductController::class, "index"]);
Route::get("get-product/{id}", [ProductController::class, "getProduct"]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);
});
