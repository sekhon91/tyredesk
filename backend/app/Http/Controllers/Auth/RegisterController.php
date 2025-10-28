<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(RegisterRequest $request): JsonResponse
  {
    /**
     * Use transaction to ensure data integrity
     */
    DB::transaction(function () use ($request) {

      /**
       * Create Company
       */
      $company = Company::create([
        'name' => $request->company_name,
      ]);

      /**
       * Create User and attach to Company
       */
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'company_id' => $company->id,
      ]);

      $user->assignRole(RolesEnum::COMPANYADMIN->value);
    });

    /**
     * Return success response
     */
    return response()->json([
      'message' => 'Registration successful',
    ], 201);
  }
}
