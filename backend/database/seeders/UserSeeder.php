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

    /** Create Super Admin */
    $superAdmin = User::factory()->create([
      'name' => 'Harpreet Sekhon',
      'email' => 'harpree@createinc.co.uk',
      'company_id' => $company->id,
    ]);

    /** Assign Role */
    $superAdmin->assignRole(RolesEnum::SUPERADMIN->value);

    /** 
     * Create Company Admin 
     * */
    $serviceAdmin = User::factory()->create([
      'name' => 'Company Admin',
      'email' => 'ca@createinc.co.uk',
      'company_id' => $company->id,
    ]);

    /** Assign Role */
    $serviceAdmin->assignRole(RolesEnum::SERVICEMANAGER->value);

    /** 
     * Create Service Admin 
     * */
    $serviceAdmin = User::factory()->create([
      'name' => 'Service Manager',
      'email' => 'sm@createinc.co.uk',
      'company_id' => $company->id,
    ]);

    /** Assign Role */
    $serviceAdmin->assignRole(RolesEnum::SERVICEMANAGER->value);

    /** 
     * Create Technician users 
     * */
    $technician1 = User::factory()->create([
      'name' => 'Technician One',
      'email' => 'tech1@createinc.co.uk',
      'company_id' => $company->id,
    ]);

    $technician1->assignRole(RolesEnum::TECHNICIAN->value);

    $technician2 = User::factory()->create([
      'name' => 'Technician Two',
      'email' => 'tech2@createinc.co.uk',
      'company_id' => $company->id,
    ]);

    $technician2->assignRole(RolesEnum::TECHNICIAN->value);

    /** Create Billing Admin */
    $billingAdmin = User::factory()->create([
      'name' => 'Billing Admin',
      'email' => 'ba@createinc.co.uk',
      'company_id' => $company->id,
    ]);

    /** Assign Role */
    $billingAdmin->assignRole(RolesEnum::BILLINGADMIN->value);
  }
}
