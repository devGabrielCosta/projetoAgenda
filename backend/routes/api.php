<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\UBSController;
Use App\Http\Controllers\UserController;
Use App\Http\Controllers\ScheduleController;

Route::get('/ubs', [UBSController::class, 'index']);
Route::get('/ubs/{id}', [UBSController::class, 'show']);
Route::get('/ubs/{id}/doctors', [UBSController::class, 'showDoctors']);
Route::get('/ubs/{id}/schedules', [UBSController::class, 'showSchedules']);
Route::post('/ubs', [UBSController::class, 'store']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);

Route::get('/schedule', [ScheduleController::class, 'index']);
Route::get('/schedule/{id}', [ScheduleController::class, 'show']);
Route::post('/schedule', [ScheduleController::class, 'store']);
Route::delete('/schedule/{id}', [ScheduleController::class, 'delete']);