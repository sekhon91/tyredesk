<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnAuthorizeException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebOtpVerificationController extends Controller
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
        // $result is an instance of the ConsumeOneTimePasswordResult enum.
        $result = $user->attemptLoginUsingOneTimePassword($oneTimePassword, remember: false);

        if ($result->isOk()) {
            // it is best practice to regenerate the session id after a login
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
            ]);
        }

        throw new UnAuthorizeException('The provided OTP is invalid or has expired.');
    }
}
