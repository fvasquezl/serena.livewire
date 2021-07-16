<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'      => 'Admin',
            'display_name' => 'Administrador'
        ]);
        // Role::create([
        //     'name'=>'Consejeros',
        //     'display_name' =>'Consejeros'
        // ]);
        // Role::create([
        //     'name'=>'Director',
        //     'display_name' =>'Director General'
        // ]);
        // Role::create([
        //     'name'=>'Gerentes',
        //     'display_name' =>'Gerentes'
        // ]);
        // Role::create([
        //     'name'=>'Coordinadores',
        //     'display_name' =>'Coordinadores'
        // ]);
        // Role::create([
        //     'name'=>'Subcoordinadores',
        //     'display_name' =>'Subcoordinadores'
        // ]);
        // Role::create([
        //     'name'=>'Personal',
        //     'display_name' =>'personal de apoyo'
        // ]);
        Role::create([
            'name' => 'WareHouse',
            'display_name' => 'Almacenista'
        ]);
    }
}
