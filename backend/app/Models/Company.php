<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'name',
  ];

  /**
   * Get the users for the company.
   */
  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }

  /**
   * Get the clients for the company.
   */
  public function clients(): HasMany
  {
    return $this->hasMany(Client::class);
  }

  /**
   * Get the vehicles for the company.
   */
  public function vehicles(): HasMany
  {
    return $this->hasMany(Vehicle::class);
  }
}
