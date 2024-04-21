<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    Route::prefix('/todos')->group(function () {
        Route::get('/', [TodosController::class, 'index']);
        
        Route::post('/', [TodosController::class, 'store']);
        
        Route::get('/{id}', [TodosController::class, 'show']);
        
        Route::put('/{id}', [TodosController::class, 'update']);
        
        Route::delete('/{id}', [TodosController::class, 'destroy']);
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

