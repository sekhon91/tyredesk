<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "name" => ["required", "string", "max:255"],
      "contact_name" => ["nullable", "string", "max:255"],
      "contact_email" => ["nullable", "string", "email", "max:255"],
      "contact_phone" => ["nullable", "string", "max:20"],
      "street_1" => ["nullable", "string", "max:255"],
      "street_2" => ["nullable", "string", "max:255"],
      "county" => ["nullable", "string", "max:255"],
      "city" => ["nullable", "string", "max:255"],
      "postcode" => ["nullable", "string", "max:20"],
      "country" => ["nullable", "string", "max:255"],
    ];
  }
}
