<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use App\Enums\RoleName;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'email' => 'super-admin@example.com',
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

        User::factory(count: 1)->create();

        DB::table('role_user')->insert([
            'user_id' => 2,
            'role_id' => 5,
        ]);

        // Add permissions for Super Admin roles
        DB::statement("INSERT INTO permission_user (SELECT permission_id, 1 FROM permission_role WHERE role_id = 1)");
        // Add permissions for user roles
        DB::statement("INSERT INTO permission_user (SELECT permission_id, 2 FROM permission_role WHERE role_id = 5)");

    }
}