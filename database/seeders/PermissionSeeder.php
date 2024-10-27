<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'viewAny',
            'view',
            'create',
            'update',
            'delete',
            'restore',
            'forceDelete',
        ];

        $resources = [
            'user',
            'post',
            'job',
            'company',
            'permission',
            'role',
            'product',
            'order',
        ];

        collect($resources)
            ->crossJoin($actions)
            ->map(function ($set) {
                return implode('.', $set);
            })->each(function ($permission) {
                $descriptions = explode('.', $permission);
                $descriptions = array_reverse($descriptions);
                $description = ucwords($descriptions[0] . ' ' . $descriptions[1]);
                Permission::create(['name' => $permission, 'description' => $description]);
            });

    }
}