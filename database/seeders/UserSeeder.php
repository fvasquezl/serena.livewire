<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();
        // User::truncate();


        $admin = User::factory()->create([
            'name' => 'Faustino Vasquez Limon',
            'email' => 'fvasquez@local.com'
        ]);
        $admin->assignRole(1);

        $employee = User::factory()->create([
            'name' => 'Sebastian Vasquez Tenorio',
            'email' => 'svasquez@local.com'
        ]);
        $employee->assignRole(2);
    }
}
