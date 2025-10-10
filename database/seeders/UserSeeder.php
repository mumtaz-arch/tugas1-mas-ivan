<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists, if not, create it
        $adminUser = User::where('username', 'admin')->first();
        if (!$adminUser) {
            User::create([
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 1,
            ]);
        }
        
        // Create 10 regular users with role = 0 (regular user)
        for ($i = 1; $i <= 10; $i++) {
            User::updateOrCreate(
                [
                    'username' => 'user' . $i,
                ],
                [
                    'name' => 'User ' . $i,
                    'email' => 'user' . $i . '@example.com',
                    'password' => bcrypt('password'),
                    'role' => 0, // Using 0 for regular user role
                    'photo' => null,
                ]
            );
        }
    }
}
