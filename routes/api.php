<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Cardano;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v0'], function () {

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
            Route::get('/users', [AdminController::class, 'users']);
            Route::get('/user/{uuid}', [AdminController::class, 'user']);
            Route::delete('/user/{uuid}/revoke-tokens', [AdminController::class, 'revokeTokens']);
            Route::delete('/user/{uuid}/delete', [AdminController::class, 'deleteUser']);
        });

        Route::group(['prefix' => '/user', 'middleware' => ['verified']], function () {    
            Route::get('/info', [UserController::class, 'info']);
            Route::put('/update', [UserController::class, 'update']);
            Route::delete('/logout', [UserController::class, 'logout']);
        });

        Route::group(['prefix' => '/cardano'], function () {

            Route::get('{network}/accounts/{account}/{param1?}/{param2?}', [Cardano::class, 'accounts']);
            Route::get('{network}/addresses/{address}/{param1?}/{param2?}', [Cardano::class, 'addresses']);
            Route::get('{network}/assets/{asset?}/{param1?}', [Cardano::class, 'addresses']);
            Route::get('{network}/blocks/{param1?}/{param2?}', [Cardano::class, 'addresses']);
            Route::get('{network}/epochs/{epoch}/{param1?}/{param2?}', [Cardano::class, 'epochs']);
            Route::get('{network}/genesis', [Cardano::class, 'ledger']);
            Route::get('{network}/metadata/txs/labels/{label?}/{param1?}/{param2?}', [Cardano::class, 'metadata']);
            Route::get('{network}/info', [Cardano::class, 'network']);
            Route::get('{network}/pools/{pool?}/{param1?}', [Cardano::class, 'pools']);
            Route::get('{network}/scripts/{script?}/{param1?}', [Cardano::class, 'scripts']);
            Route::get('{network}/txs/{hash}/{param1?}/{param2?}', [Cardano::class, 'transactions']);
    
        });

    });

});