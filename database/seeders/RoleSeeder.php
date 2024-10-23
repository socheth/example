<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\RoleName;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();
        Role::create(['name' => RoleName::ADMIN->value]);
        Role::create(['name' => RoleName::MANAGER->value]);
        Role::create(['name' => RoleName::AUTHOR->value]);
        Role::create(['name' => RoleName::USER->value]);
    }
    protected function createRole(RoleName $role, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'user.%')
            ->orWhere('name', 'like', 'company.%')
            ->orWhere('name', 'like', 'post.%')
            ->orWhere('name', 'like', 'job.%')
            ->pluck('id');

        $this->createRole(RoleName::SUPER_ADMIN, $permissions);
    }
}
