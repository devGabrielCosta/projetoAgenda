<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\UBSController;
Use App\Http\Controllers\UserController;

Route::get('/ubs', [UBSController::class, 'index']);
Route::get('/ubs/{id}', [UBSController::class, 'show']);
Route::get('/ubs/{id}/doctors', [UBSController::class, 'showDoctors']);
Route::post('/ubs', [UBSController::class, 'store']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);