<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

// No necesitamos especificar los metodos
// Route::resource('products', ProductController::class);

// Public Route
Route::post('/register', [AuthController::class, 'register'])->name('register');   
Route::post('/login', [AuthController::class, 'login'])->name('login'); 
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/search/{name}', [ProductController::class, 'search']);

// Protecte Route
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');   
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');  
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
