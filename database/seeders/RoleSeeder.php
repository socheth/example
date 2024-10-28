<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\Role as RoleEnum;
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

    protected function createRole(RoleEnum $role, int $level, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value, 'level' => $level]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createSuperAdminRole(): void
    {
        $permissions = Permission::query()->pluck('id');

        $this->createRole(RoleEnum::SUPER_ADMIN, 99, $permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', '%.restore')
            ->where('name', 'not like', '%.forceDelete')
            ->pluck('id');

        $this->createRole(RoleEnum::ADMIN, 80, $permissions);
    }

    protected function createManagerRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', 'user.%')
            ->where('name', 'not like', 'company.%')
            ->pluck('id');

        $this->createRole(RoleEnum::MANAGER, 70, $permissions);
    }

    protected function createAuthorRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'not like', 'user.%')
            ->where('name', 'not like', 'job.%')
            ->where('name', 'not like', 'company.%')
            ->pluck('id');

        $this->createRole(RoleEnum::AUTHOR, 50, $permissions);
    }

    protected function createUserRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'post.%')
            ->orWhere('name', 'like', 'product.%')
            ->orWhere('name', 'like', 'order.%')
            ->pluck('id');

        $this->createRole(RoleEnum::USER, 10, $permissions);
    }
}
