<?php

use App\Auth\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
    // user CRUD endpoints
    Route::prefix('user')->group(function () {
        Route::post('create',       [UserController::class, 'createUser']);
        Route::post('login',        [UserController::class, 'loginUser']);
        Route::delete('delete',     [UserController::class, 'deleteUser']);
    });

    // get logged in user
    Route::get('me',                [UserController::class, 'showUser']);


//    // file system CRUD endpoints
//    Route::prefix('file')->group(function () {
//        Route::get('',      [FileController::class, 'index']);
//        Route::post('',     [FileController::class, 'create']);
//        Route::get('',      [FileController::class, 'read']);
//        Route::put('',      [FileController::class, 'update']);
//        Route::delete('',   [FileController::class, 'delete']);
//    });
});
