<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientSingleResource extends JsonResource
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
      'name' => $this->name,
      'contact_name' => $this->contact_name,
      'contact_email' => $this->contact_email,
      'contact_phone' => $this->contact_phone,
      'street_1' => $this->street_1,
      'street_2' => $this->street_2,
      'county' => $this->county,
      'city' => $this->city,
      'postcode' => $this->postcode,
      'country' => $this->country,
      'created_at' => $this->created_at,
    ];
  }
}
