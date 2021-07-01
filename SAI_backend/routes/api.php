<?php

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
    // user CRUD endpoints
    Route::prefix('user')->group(function () {
        Route::post('create',       [UserController::class, 'createUser']);
        Route::post('login',        [UserController::class, 'loginUser']);
        Route::delete('delete',     [UserController::class, 'deleteUser']);
    });

    // get logged in user
    Route::get('me',                [UserController::class, 'showUser']);

    // file system CRUD endpoints
    Route::prefix('file')->group(function () {
        Route::post('{userId}/upload',       [FileController::class, 'uploadFile'])->where('userId', '[0-9]+');;
        Route::get('{objectId}',    [FileController::class, 'fetchFileInformation'])->where('objectId', '[0-9]+');
    });
});
