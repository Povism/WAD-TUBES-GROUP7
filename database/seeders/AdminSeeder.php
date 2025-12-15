<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin1@gmail.com'],
            [
                'name' => 'Admin 1',
                'nim' => 'ADMIN001',
                'password' => Hash::make('admin1password'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ]
        );
    }
}
