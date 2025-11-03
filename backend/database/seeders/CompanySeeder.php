<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    /** Create Super Company for COmpany ID= 1 */
    Company::factory()->create([
      'name' => 'Create Inc',
    ]);

    /** Create 10 Companies */
    Company::factory()->count(10)->create();
  }
}
