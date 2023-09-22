<?php

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

Route::apiResource('users', UserController::class);

Route::put('update-password/{user}', [UserController::class, 'updatePassword'])->name('updatePassword');

Route::post('send-email', [UserController::class, 'sendEmail'])->name('sendEmail');

Route::post('send-code', [UserController::class, 'sendCode'])->name('sendCode');

Route::put('update-password/{user}', [UserController::class, 'updatePassword'])->name('updatePassword');

Route::get('update-verification-email/{user}', [UserController::class, 'verification'])->name('verification');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout/{user}', [AuthController::class, 'logout'])->name('logout');