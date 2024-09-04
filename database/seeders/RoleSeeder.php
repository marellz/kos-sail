<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            ["name" => "super_admin", "label" => "SuperAdmin",],
            ["name" => "admin", "label" => "Admin",],
            ["name" => "client", "label" => "Client",],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
