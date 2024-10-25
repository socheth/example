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
        $this->createSuperAdminRole();
        $this->createAdminRole();
        $this->createManagerRole();
        $this->createAuthorRole();
        $this->createUserRole();
    }

    protected function createRole(RoleName $role, int $level, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value, 'level' => $level]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createSuperAdminRole(): void
    {
        $permissions = Permission::query()->pluck('id');

        $this->createRole(RoleName::SUPER_ADMIN, 99, $permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', '%.restore')
            ->where('name', 'not like', '%.forceDelete')
            ->pluck('id');

        $this->createRole(RoleName::ADMIN, 80, $permissions);
    }

    protected function createManagerRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', 'user.%')
            ->where('name', 'not like', 'company.%')
            ->pluck('id');

        $this->createRole(RoleName::MANAGER, 70, $permissions);
    }

    protected function createAuthorRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', 'user.%')
            ->where('name', 'not like', 'job.%')
            ->pluck('id');

        $this->createRole(RoleName::AUTHOR, 50, $permissions);
    }

    protected function createUserRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', 'user.%')
            ->where('name', 'not like', '%.restore')
            ->where('name', 'not like', '%.delete')
            ->where('name', 'not like', '%.forceDelete')
            ->pluck('id');

        $this->createRole(RoleName::USER, 10, $permissions);
    }
}