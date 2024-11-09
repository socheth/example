<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

Route::middleware(['auth:sanctum', 'valid_user'])->group(function () {
    Route::get('auth.check', function (Request $request) {
        return response()->json($request->header());
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::get('auth/profile', 'profile');
    Route::put('auth/profile', 'update_profile');
    Route::post('auth/login', 'login');
    Route::post('auth/register', 'register');
    Route::post('auth/forgot', 'forgot_password');
    Route::post('auth/verify', 'verify_code');
    Route::patch('auth/password', 'reset_password');
    Route::put('auth/password', 'change_password');
    Route::delete('auth/logout', 'logout');
});

Route::get('test', function (Request $request) {
    return response()->json($request->header());
});