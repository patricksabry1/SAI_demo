<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This is the single entry point for all API routes for the file upload API.
|
|
*/

// house all current version endpoints in V1, allows for easier decoupling and extensibility for future versions
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login',            [AuthController::class, 'login']);
        Route::post('logout',           [AuthController::class, 'logout']);
        Route::post('refresh',          [AuthController::class, 'refresh']);
        Route::get('user',              [AuthController::class, 'me']);
    });

    // user CRUD endpoints
    Route::prefix('user')->group(function () {
        Route::post('create',           [UserController::class, 'createUser']);
    });

    // file handling
    Route::prefix('file')->group(function () {
        Route::post('{userId}/upload',  [FileController::class, 'uploadFile'])->where('userId', '[0-9]+');;
    });
});
