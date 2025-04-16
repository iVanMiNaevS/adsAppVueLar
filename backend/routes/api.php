<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/registration', [AuthController::class, 'reg']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/user', [AuthController::class, 'getUser'])->middleware('auth:sanctum');

Route::post('/ad', [AdController::class, 'create'])->middleware('auth:sanctum');
Route::post('/ad/{id}', [AdController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/ad/{id}', [AdController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/ad', [AdController::class, 'all'])->middleware('auth:sanctum');
Route::get('/ad/by-user', [AdController::class, 'byUser'])->middleware('auth:sanctum');
Route::get('/ad/{id}', [AdController::class, 'one'])->middleware('auth:sanctum');
