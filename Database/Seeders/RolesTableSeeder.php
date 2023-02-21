<?php

/**
 * Made by CV. IRANDO
 * https://irando.co.id ©2023
 * info@irando.co.id
 */

namespace Modules\Pages\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'add page', 'module' => 'Pages']);
        Permission::create(['name' => 'edit page', 'module' => 'Pages']);
        Permission::create(['name' => 'delete page', 'module' => 'Pages']);

        $role = Role::firstOrCreate(['name' => 'staff']);
        $role->givePermissionTo([
            'add page',
            'edit page',
        ]);

        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
