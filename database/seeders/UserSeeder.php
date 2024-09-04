<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(10)->create([
            'password' => 'secret'
        ]);

        User::factory()->create([
            'name' => 'Dave Super',
            'email' => 'test@example.com',
            'password' => 'secret',
            'role_id' => Role::ROLE_SUPERADMIN,
        ]);

        User::factory()->create([
            'name' => 'Dave the Manager',
            'email' => 'manager@example.com',
            'password' => 'secret',
            'role_id' => Role::ROLE_ADMIN,
        ]);
    }
}
