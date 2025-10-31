<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'name' => fake()->company(),
            'contact_name' => fake()->name(),
            'contact_email' => fake()->companyEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'street_1' => fake()->streetAddress(),
            'street_2' => fake()->optional()->secondaryAddress(),
            'county' => fake()->state(),
            'city' => fake()->city(),
            'postcode' => fake()->postcode(),
            'country' => fake()->country(),
        ];
    }
}
