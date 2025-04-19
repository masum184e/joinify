<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Masum Billah',
            'email' => 'masum184e@gmail.com',
            'role' => 'advisor',
            'password' => Hash::make('masum184e@gmail.com'), // 🔐 Use a secure password
            'created_at' => now(),
            'profile_picture' => null, // or use a default path if you want
        ]);
    }
}
