<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
  protected $fillable = [
    'company_id',
    'reg_number',
    'axel_type',
  ];

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
