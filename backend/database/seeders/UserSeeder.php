<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hash = Hash::make('password');

        $user = User::create([
            'name' => 'Harpreet Sekhon',
            'email' => 'harpreet@createinc.co.uk',
            'password' => $hash,
            'email_verified_at' => now(),
        ]);

        /** Assign Role */
        // $user->assignRole(RolesEnum::SUPERADMIN->value);
    }
}
