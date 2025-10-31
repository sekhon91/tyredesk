<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'company_id',
    'name',
    'contact_name',
    'contact_email',
    'contact_phone',
    'street_1',
    'street_2',
    'county',
    'city',
    'postcode',
    'country',
  ];

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
