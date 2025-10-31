<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissionsEnum: string
{
  case SUPERADMIN = 'super-admin';

  case CLIENTS_VIEW = 'projects.view';
  case CLIENTS_MANAGE = 'clients.manage';
  case JOBS_VIEW = 'jobs.view';
  case JOBS_MANAGE = 'jobs.manage';
  case INVOICES_VIEW = 'invoices.view';
  case INVOICES_MANAGE = 'invoices.manage';
  case VEHICLES_VIEW = 'vehicles.view';
  case VEHICLES_MANAGE = 'vehicles.manage';
  case COMPANY_USERS_MANAGE = 'company-users.manage';



  // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
  public function label(): string
  {
    return match ($this) {
      self::SUPERADMIN => 'Super Admin',
      self::CLIENTS_VIEW => 'View Clients',
      self::CLIENTS_MANAGE => 'Manage Clients',
      self::JOBS_VIEW => 'View Jobs',
      self::JOBS_MANAGE => 'Manage Jobs',
      self::INVOICES_VIEW => 'View Invoices',
      self::INVOICES_MANAGE => 'Manage Invoices',
      self::VEHICLES_VIEW => 'View Vehicles',
      self::VEHICLES_MANAGE => 'Manage Vehicles',
      self::COMPANY_USERS_MANAGE => 'Manage Company Users',
    };
  }
}
