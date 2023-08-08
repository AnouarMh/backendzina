<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminController;

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
    Route::middleware('auth:superadmin')->group(function () {
        Route::post('logout', [SuperadminController::class, 'logout']);
         Route::post('update/{admin}', [SuperadminController::class, 'updateSuperadmin']);
         Route::post('restemail', [SuperadminController::class, 'resetEmail']);

         Route::post('resetpwd', [SuperadminController::class, 'resetPassword']);
         Route::post('logout', [SuperadminController::class, 'logout']);

        Route::get('admins', [SuperadminController::class, 'getAdmins']);
        Route::get('clients/{centerId}', [SuperadminController::class, 'getClientByCenter']);
        Route::get('fournisseurs', [SuperadminController::class, 'getFournisseurs']);
        Route::get('clients/{adminId}', [SuperadminController::class, 'getClientByAdmin']);
    });
});

Route::prefix('admin')->group(function () {
    Route::post('create', [AdminController::class, 'createCenter']);
    Route::post('login', [AdminController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::post('createClient', [AdminController::class, 'createClient']);
        Route::get('manage-clients', [AdminController::class, 'getClients']);
        Route::get('manage-reservations', [AdminController::class, 'manageReservations']);
        Route::get('manage-services', [AdminController::class, 'manageServices']);
        Route::post('order-products', [AdminController::class, 'orderProductsFromFournisseur']);
    });
});