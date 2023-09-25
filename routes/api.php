<?php

use App\Http\Controllers\AnnonceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout/{user}', [AuthController::class, 'logout'])->name('logout');

    Route::apiResource('users', UserController::class)->except('store', 'index');

    Route::post('users/avatar', [UserController::class, 'uploadAvatar'])->name('users.avatar');

    Route::apiResource('annonces', AnnonceController::class);
});

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::post('users', [UserController::class, 'store'])->name('users.store');

Route::put('update-password/{user}', [UserController::class, 'updatePassword'])->name('updatePassword');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('send-email', [UserController::class, 'sendEmail'])->name('sendEmail');

Route::get('update-verification-email/{user}', [UserController::class, 'verification'])->name('verification');



