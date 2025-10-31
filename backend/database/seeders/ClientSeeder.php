<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $companies = Company::all();

    foreach ($companies as $company) {
      $clientCount = rand(5, 10);

      Client::factory()
        ->count($clientCount)
        ->create([
          'company_id' => $company->id,
        ]);
    }
  }
}
