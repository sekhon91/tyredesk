<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken\Models\PersonalAccessToken;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $user = $request->user();

    /**
     * If user not found throw error
     */
    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'Not authenticated.',
      ]);
    }

    /**
     * Determine logout method based on presence of XSRF token
     */
    $hasXSRFToken = $request->hasHeader('X-XSRF-TOKEN');

    if ($hasXSRFToken) {
      // Session cookie logout (SPAs)
      if (Auth::check()) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
      }
    } else {
      // API Token logout (mobile apps / token-based)
      /**
       * Revoke all tokens to enforce single sign-out
       * */
      // $user->tokens()->delete();

      /**
       * Delete current token only
       * */
      if ($user->currentAccessToken()) {
        $user->currentAccessToken()->delete();
      }
    }


    return response()->json([
      'success' => true,
      'message' => 'Logged out successfully.',
    ], Response::HTTP_OK);
  }
}
