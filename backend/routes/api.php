<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginOtpController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\CompanyUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('register');
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

  Route::get('/user', fn(Request $request) => response()->json($request->user()));

  /**
   * Company Users Routes
   */
  Route::apiResource('/company-users', CompanyUserController::class);

  /**
   * Client Routes
   */
  Route::apiResource('/clients', ClientController::class);

});
