<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/signin', [UserController::class, 'signin']);

Route::post('/register', [UserController::class, 'create']);

Route::get('/verify', [UserController::class, 'verify'])->middleware(EnsureTokenIsValid::class);

Route::get('/bcrypt', function () {
    return response()->json(Hash::make('162867'));
});