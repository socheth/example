<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use App\Enums\RoleName;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
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
            'is_admin' => true,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ])->roles()->sync(Role::where('name', RoleName::SUPER_ADMIN->value)->first());

        User::factory(10)->create();
    }
}