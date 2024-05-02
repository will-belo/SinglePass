<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/signin', [UserController::class, 'signin']);
Route::post('/register', [UserController::class, 'create']);
Route::post('/verify', [UserController::class, 'verify'])->middleware(EnsureTokenIsValid::class);