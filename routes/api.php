<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('2fa-setup', [AuthController::class, 'setup2FA']);
    Route::post('2fa-verify', [AuthController::class, 'verify2FA']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('client')->group(function () {
        Route::post('provision-domain', [ClientController::class, 'provisionDomain']);
        Route::get('database-usage', [ClientController::class, 'getDatabaseUsage']);
        Route::post('request-ssl', [ClientController::class, 'requestSSL']);
    });

    Route::prefix('admin')->group(function () {
        Route::post('add-client', [AdminController::class, 'addClient']);
        Route::post('set-quota', [AdminController::class, 'setQuota']);
        Route::post('toggle-client', [AdminController::class, 'toggleClient']);
    });
});
