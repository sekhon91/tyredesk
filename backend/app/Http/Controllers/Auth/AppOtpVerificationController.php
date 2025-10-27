<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnAuthorizeException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppOtpVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (! $user) {
            throw new NotFoundException('Email not found.');
        }

        $oneTimePassword = $credentials['otp'];

        /**
         * Verify the OTP
         */
        $result = $user->consumeOneTimePassword($oneTimePassword);

        if ($result->isOk()) {
            /**
             * Revoke existing tokens to enforce single sign-in
             * */
            // $user->tokens()->delete();

            /**
             * Issue a new token
             * */
            $token = $user->createToken('web')->plainTextToken;

            // Log::channel('stderr')->info(json_encode(($request)));
            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                ],
            ]);
        }

        throw new UnAuthorizeException('The provided OTP is invalid or has expired.');
    }
}
