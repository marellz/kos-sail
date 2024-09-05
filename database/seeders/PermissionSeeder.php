<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = Role::all()->keyBy('id');

        $data = [
            "view-admin-dashboard" => [
                "label" => "View Admin dashboard",
                "description" => "Load admin dashboard",
                "roles" => [Role::ROLE_ADMIN, Role::ROLE_SUPERADMIN],
            ],
            "manage-users" => [
                "label" => "Manage users",
                "description" => "Create, update and delete users",
                "roles" => [Role::ROLE_SUPERADMIN],
            ],
            "manage-products" => [
                "label" => "Manage products",
                "description" => "Create, update and delete products",
                "roles" => [Role::ROLE_SUPERADMIN, Role::ROLE_ADMIN],
            ],
            "manage-categories" => [
                "label" => "Manage categories",
                "description" => "Create, update and delete categories",
                "roles" => [Role::ROLE_SUPERADMIN, Role::ROLE_ADMIN],
            ],
            "manage-contacts" => [
                "label" => "Manage contacts",
                "description" => "View, update and  contacts sent via contact form",
                "roles" => [Role::ROLE_SUPERADMIN, Role::ROLE_ADMIN],
            ],
            "manage-metadata" => [
                "label" => "Manage metadata",
                "description" => "Manage data that is used by admin to create more data",
                "roles" => [Role::ROLE_SUPERADMIN, Role::ROLE_ADMIN],
            ],
            "manage-sitedata" => [
                "label" => "Manage site data",
                "description" => "Manage the site content like contact urls, social url links etc",
                "roles" => [Role::ROLE_SUPERADMIN, Role::ROLE_ADMIN ],
            ],
            "view-other-profiles" => [
                "label" => "View other profiles",
                "description" => "View other user profiles other than yours",
                "roles" => [Role::ROLE_SUPERADMIN, Role::ROLE_ADMIN],
            ],
        ];

        foreach ($data as $name => $permission) {
            $created_permission = Permission::create([
                "name" => $name,
                "label" => $permission['label'],
                "description" => $permission['description'],
            ]);
            foreach ($permission['roles'] as $role) {
                $roles[$role]->permissions()->attach($created_permission);
            }
        }
    }
}
