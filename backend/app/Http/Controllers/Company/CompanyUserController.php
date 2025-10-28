<?php

namespace App\Http\Controllers\Company;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Exceptions\ForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyUserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if (!$request->user()->can(PermissionsEnum::COMPANY_USERS_MANAGE->value)) {
      throw new ForbiddenException('You do not have permission to manage company users.');
    }

    $company = $request->user()->company;
    $users = $company->users()->get();

    return CompanyUserResource::collection($users);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'roles' => ['required', 'array'], // the array of roles
      'roles.*' => ['string', Rule::exists('roles', 'name'), Rule::notIn([RolesEnum::SUPERADMIN->value])],  //], //
    ]);

    if (!$request->user()->can(PermissionsEnum::COMPANY_USERS_MANAGE->value)) {
      throw new ForbiddenException('You do not have permission to manage company users.');
    }

    $company = $request->user()->company;

    /**
     * Create User and attach to Company
     */
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'company_id' => $company->id,
    ]);

    $user->assignRole($validatedData['roles']);

    return new CompanyUserResource($user);

  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
