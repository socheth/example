<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call(PostSeeder::class);
        $this->call(JobSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'phone' => '+1234567890',
            'phone_verified_at' => now(),
            'address' => '123 Main St',
            'gender' => 'male',
            'photo' => 'https://avatar.iran.liara.run/username?username=Me',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}