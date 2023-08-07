<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('superadmin')->group(function () {
    Route::post('login', [SuperadminController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [SuperadminController::class, 'logout']);
        Route::get('admins', [SuperadminController::class, 'getAdmins']);
        Route::get('fournisseurs', [SuperadminController::class, 'getFournisseurs']);
        Route::get('clients/{adminId}', [SuperadminController::class, 'getClientByAdmin']);
    });
});