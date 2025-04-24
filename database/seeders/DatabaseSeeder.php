<?php

namespace Database\Seeders;

use App\Models\GlobalUserRole;
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

        $user = User::factory()->create([
            'name' => 'Masum Billah',
            'email' => 'masum184e@gmail.com',
            'password' => Hash::make('masum184e@gmail.com'),
            'created_at' => now(),
            'profile_picture' => null,
        ]);

        GlobalUserRole::create([
            'user_id' => $user->id,
            'role' => 'advisor',
            'created_at' => now(),
        ]);
    }
}
