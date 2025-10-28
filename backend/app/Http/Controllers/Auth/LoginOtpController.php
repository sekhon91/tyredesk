<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginOtpController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
    ]);

    $user = User::where('email', $credentials['email'])->first();

    /**
     * If user not found throw error
     */
    if (!$user) {
      throw new NotFoundException('Email not found.');
    }

    $user->sendOneTimePassword();

    return response()->json([
      'success' => true,
    ]);

  }
}
