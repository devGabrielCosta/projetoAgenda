<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\UBSController;

Route::get('/ubs', [UBSController::class, 'index']);
Route::get('/ubs/{id}', [UBSController::class, 'show']);
Route::post('/ubs', [UBSController::class, 'store']);