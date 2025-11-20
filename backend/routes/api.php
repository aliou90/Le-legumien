<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VegetableController;

Route::get('/vegetables', [VegetableController::class, 'index']);
Route::post('/vegetables', [VegetableController::class, 'store']);
Route::get('/vegetables/{vegetable}', [VegetableController::class, 'show']);
Route::put('/vegetables/{vegetable}', [VegetableController::class, 'update']);
Route::delete('/vegetables/{vegetable}', [VegetableController::class, 'destroy']);

// Nouvelle route pour les likes
Route::post('/vegetables/{vegetable}/like', [VegetableController::class, 'like']);
