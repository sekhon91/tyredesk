<?php

namespace App\Http\Resources\Vehicle;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleSingleResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'reg_number' => $this->reg_number,
      'axel_type' => $this->axel_type,
      'company_id' => $this->company_id,
      'created_at' => $this->created_at,
    ];
  }
}
