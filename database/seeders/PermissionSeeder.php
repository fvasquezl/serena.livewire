<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User Permissions
        Permission::create([
            'name' => 'View users',
            'display_name' => 'Ver usuarios',
        ]);
        Permission::create([
            'name' => 'Create users',
            'display_name' => 'Crear usuarios',
        ]);
        Permission::create([
            'name' => 'Update users',
            'display_name' => 'Actualizar usuarios',
        ]);
        Permission::create([
            'name' => 'Delete users',
            'display_name' => 'Eliminar usuarios',
        ]);

        //Roles Permissions

        Permission::create([
            'name' => 'View roles',
            'display_name' => 'Ver roles',
        ]);
        Permission::create([
            'name' => 'Create roles',
            'display_name' => 'Crear roles',
        ]);
        Permission::create([
            'name' => 'Update roles',
            'display_name' => 'Actualizar roles',
        ]);
        Permission::create([
            'name' => 'Delete roles',
            'display_name' => 'Eliminar roles',
        ]);

        //Permissions Permissions

        Permission::create([
            'name' => 'View permissions',
            'display_name' => 'Ver permisos',
        ]);

        Permission::create([
            'name' => 'Update permissions',
            'display_name' => 'Actualizar permisos',
        ]);
    }
}
