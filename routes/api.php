<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

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



Route::middleware('auth:sanctum')->group(function () {

    // GET all categories
    Route::get('/categories', [CategoryController::class, 'index']);

    // CREATE category
    Route::post('/categories', [CategoryController::class, 'store']);

    // GET single category 
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    // UPDATE category
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    // Route::patch('/categories/{category}', [CategoryController::class, 'update']);

    // DELETE category
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

});

