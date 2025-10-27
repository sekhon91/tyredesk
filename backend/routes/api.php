<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AppLogoutController;
use App\Http\Controllers\Auth\AppOtpVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\WebLogoutController;
use App\Http\Controllers\Auth\WebOtpVerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');
Route::post('/app-otp-verification', AppOtpVerificationController::class)->name('app-otp-verification');
Route::post('/web-otp-verification', WebOtpVerificationController::class)->name('web-otp-verification');
Route::post('/web-logout', WebLogoutController::class)->name('logout');
Route::post('/app-logout', AppLogoutController::class)->name('app-logout');

Route::get('/user', fn (Request $request) => response()->json($request->user()))->middleware('auth:sanctum');
