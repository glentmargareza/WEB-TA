<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@jeepwukirsari.com'],
            [
                'name' => 'Admin Wukirsari',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );

        // Standard User Account
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Pengguna Wisata',
                'password' => bcrypt('user123'),
                'role' => 'user',
            ]
        );
    }
}
