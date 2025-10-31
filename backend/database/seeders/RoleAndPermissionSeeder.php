<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    /**
     * Create Roles
     */
    $superAdminRole = Role::firstOrCreate(['name' => RolesEnum::SUPERADMIN->value]);
    $companyAdminRole = Role::firstOrCreate(['name' => RolesEnum::COMPANYADMIN->value]);
    $serviceManagerRole = Role::firstOrCreate(['name' => RolesEnum::SERVICEMANAGER->value]);
    $technicianRole = Role::firstOrCreate(['name' => RolesEnum::TECHNICIAN->value]);
    $billingAdminRole = Role::firstOrCreate(['name' => RolesEnum::BILLINGADMIN->value]);

    /**
     * Create Permissions
     */
    $superAdminPermission = Permission::firstOrCreate(['name' => PermissionsEnum::SUPERADMIN->value]);
    $clientsViewPermission = Permission::firstOrCreate(['name' => PermissionsEnum::CLIENTS_VIEW->value]);
    $clientsManagePermission = Permission::firstOrCreate(['name' => PermissionsEnum::CLIENTS_MANAGE->value]);
    $jobsViewPermission = Permission::firstOrCreate(['name' => PermissionsEnum::JOBS_VIEW->value]);
    $jobsManagePermission = Permission::firstOrCreate(['name' => PermissionsEnum::JOBS_MANAGE->value]);
    $invoicesViewPermission = Permission::firstOrCreate(['name' => PermissionsEnum::INVOICES_VIEW->value]);
    $invoicesManagePermission = Permission::firstOrCreate(['name' => PermissionsEnum::INVOICES_MANAGE->value]);
    $vehiclesViewPermission = Permission::firstOrCreate(['name' => PermissionsEnum::VEHICLES_VIEW->value]);
    $vehiclesManagePermission = Permission::firstOrCreate(['name' => PermissionsEnum::VEHICLES_MANAGE->value]);
    $companyUsersManagePermission = Permission::firstOrCreate(['name' => PermissionsEnum::COMPANY_USERS_MANAGE->value]);


    /**
     * Assign Permissions to Roles
     */

    /* Super Admin */
    $superAdminRole->givePermissionTo([
      $superAdminPermission
    ]);

    /* Company Admin */
    $companyAdminRole->givePermissionTo([
      $clientsViewPermission,
      $clientsManagePermission,
      $jobsViewPermission,
      $jobsManagePermission,
      $invoicesViewPermission,
      $invoicesManagePermission,
      $vehiclesViewPermission,
      $vehiclesManagePermission,
      $companyUsersManagePermission,
    ]);

    /* Service Manager */
    $serviceManagerRole->givePermissionTo([
      $clientsViewPermission,
      $clientsManagePermission,
      $jobsViewPermission,
      $jobsManagePermission,
      $vehiclesViewPermission,
      $vehiclesManagePermission,
    ]);

    /* Technician */
    $technicianRole->givePermissionTo([
      $jobsViewPermission,
    ]);

    /* Billing Admin */
    $billingAdminRole->givePermissionTo([
      $invoicesViewPermission,
      $invoicesManagePermission,
    ]);
  }
}
