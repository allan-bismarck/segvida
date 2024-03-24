<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::prefix('/clinics')->group(function () {
        Route::get('/', [ClinicController::class, 'index']);
        Route::post('/', [ClinicController::class, 'store']);
        Route::get('/{id}', [ClinicController::class, 'show']);
        Route::post('/{id}', [ClinicController::class, 'update']);
        Route::delete('/{id}', [ClinicController::class, 'destroy']);
    });

    Route::prefix('/specialists')->group(function () {
        Route::get('/', [SpecialistController::class, 'index']);
        Route::post('/', [SpecialistController::class, 'store']);
        Route::get('/{id}', [SpecialistController::class, 'show']);
        Route::post('/{id}', [SpecialistController::class, 'update']);
        Route::delete('/{id}', [SpecialistController::class, 'destroy']);
    });

    Route::prefix('/specialties')->group(function () {
        Route::get('/', [SpecialtyController::class, 'index']);
        Route::post('/', [SpecialtyController::class, 'store']);
        Route::get('/{id}', [SpecialtyController::class, 'show']);
        Route::post('/{id}', [SpecialtyController::class, 'update']);
        Route::delete('/{id}', [SpecialtyController::class, 'destroy']);
    });

    Route::prefix('/patients')->group(function () {
        Route::get('/', [PatientController::class, 'index']);
        Route::post('/', [PatientController::class, 'store']);
        Route::get('/{id}', [PatientController::class, 'show']);
        Route::post('/{id}', [PatientController::class, 'update']);
        Route::delete('/{id}', [PatientController::class, 'destroy']);
    });

    Route::prefix('/schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index']);
        Route::post('/', [ScheduleController::class, 'store']);
        Route::get('/{id}', [ScheduleController::class, 'show']);
        Route::put('/{id}', [ScheduleController::class, 'update']);
        Route::delete('/{id}', [ScheduleController::class, 'destroy']);
    });

    Route::prefix('/availabilities')->group(function () {
        Route::get('/', [AvailabilityController::class, 'index']);
        Route::post('/', [AvailabilityController::class, 'store']);
        Route::get('/{id}', [AvailabilityController::class, 'show']);
        Route::put('/{id}', [AvailabilityController::class, 'update']);
        Route::delete('/{id}', [AvailabilityController::class, 'destroy']);
    });

    Route::prefix('/images')->group(function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::get('/{id}', [ImageController::class, 'show']);
        Route::post('/upload', [ImageController::class, 'upload']);
        Route::get('/{id}/image', [ImageController::class, 'showImage']);
        Route::delete('/{id}', [ImageController::class, 'destroy']);
    });

    Route::prefix('/auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('/users')->group(function () {
        Route::post('/register', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show'])->middleware(JwtMiddleware::class);
        Route::put('/{id}', [UserController::class, 'update'])->middleware(JwtMiddleware::class);
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware(JwtMiddleware::class);
    });
});