<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnAuthorizeException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required'],
            'platform' => ['required', 'in:web,app'],
        ]);

        $user = User::where('email', $requestData['email'])->first();
        if (! $user) {
            throw new NotFoundException('Email not found.');
        }

        $oneTimePassword = $requestData['otp'];

        /**
         * Web OTP verification logic here
         * */
        if ($requestData['platform'] === 'web') {
            $result = $user->attemptLoginUsingOneTimePassword($oneTimePassword, remember: false);
            if ($result->isOk()) {
                // it is best practice to regenerate the session id after a login
                $request->session()->regenerate();

                /**
                 * Mark email as verified if not already verified
                 */
                if (! $user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
                }

                return response()->json([
                    'success' => true,
                ]);
            }
        }
        /**
         * App OTP verification logic here
         *
         * */ else {
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

                /**
                 * Mark email as verified if not already verified
                 */
                if (! $user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
                }

                return response()->json([
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'email' => $user->email,
                    ],
                ]);
            }
        }

        throw new UnAuthorizeException('The provided OTP is invalid or has expired.');
    }
}
