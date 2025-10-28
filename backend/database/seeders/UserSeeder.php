<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $company = Company::factory()->create([
      'name' => 'Create Inc',
    ]);

    $user = User::factory()->superAdmin()->create([
      'company_id' => $company->id,
    ]);

    /** Assign Role */
    $user->assignRole(RolesEnum::SUPERADMIN->value);
  }
}
