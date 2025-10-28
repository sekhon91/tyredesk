<?php

declare(strict_types=1);

namespace App\Enums;

enum RolesEnum: string
{
  // case NAMEINAPP = 'name-in-database';

  case SUPERADMIN = 'super-admin';
  case COMPANYADMIN = 'company-admin';
  case SERVICEMANAGER = 'service-manager';
  case TECHNICIAN = 'technician';
  case BILLINGADMIN = 'billing-admin';

  // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
  public function label(): string
  {
    return match ($this) {
      self::SUPERADMIN => 'Super Admin',
      self::COMPANYADMIN => 'Company Admin',
      self::SERVICEMANAGER => 'Service Manager',
      self::TECHNICIAN => 'Technician',
      self::BILLINGADMIN => 'Billing Admin',
    };
  }
}
