<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);

        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::get('user', [AuthController::class, 'user']);
            Route::get('user', [AuthController::class, 'user']);
            Route::get('profile/{id}', [AuthController::class, 'profile']);
        });
        
    });

        //Post Routes
        Route::prefix('post')->group(function(){
        Route::get('posts', [PostController::class, 'index']);
        Route::get('post/{id}', [PostController::class, 'show']);
            
        Route::middleware('auth:api')->group(function () {
            Route::post('create', [PostController::class, 'store']);
            Route::put('update/{post}', [PostController::class, 'update']);
            Route::delete('posts/{post}', [PostController::class, 'destroy']);
            });
        });
});

