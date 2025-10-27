<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginOtpController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login-otp', LoginOtpController::class)->name('login-otp');
Route::post('/login', LoginController::class)->name('login');

/**
 * Authenticaticated  & Email verified Routes
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function (): void {

  /**
   * Logout Routes
   */
  Route::post('/logout', LogoutController::class)->name('logout');

  Route::get('/user', fn(Request $request) => response()->json($request->user()))->middleware('auth:sanctum');

});