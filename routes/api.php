<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::get('/users',[UserController::class,'getUser']);
Route::get('/users/{id}',[UserController::class,'getUserById']);
Route::post('/addUser',[UserController::class,'addUser']);
Route::put('/updateUser/{id}',[UserController::class,'updateUser']);
Route::delete('/deleteUser/{id}',[UserController::class,'deleteUser']);

Route::get('/products',[ProductController::class,'getProducts']);
Route::get('/products/{id}',[ProductController::class,'getProductById']);
Route::post('/addProduct',[ProductController::class,'addProduct']);
Route::put('/updateProduct/{id}',[ProductController::class,'updateProduct']);
Route::delete('/deleteProduct/{id}',[ProductController::class,'deleteProduct']);