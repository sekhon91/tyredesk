<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\RolesEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    /** Define super admin permissions */
    Gate::before(fn($user, $ability): ?true => $user->hasRole(RolesEnum::SUPERADMIN->value) ? true : null);
    /** Don't wrap json respone inside data attribute */
    JsonResource::withoutWrapping();
  }
}
