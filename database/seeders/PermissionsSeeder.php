<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    private $data = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin' => [
                'admin-list',
                'admin-create',
                'admin-edit',
                'admin-delete',
            ],
            'subadmin' => [
                'admin-list',
            ]
         ];

         foreach($permissions as $role => $permission) {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'admin',
            ]);
            $this->seedRolePermissions($role, $permission);
         }
    }

    public function seedRolePermissions(Role $role, array $rolePermisssions)
    {
        foreach($rolePermisssions as $item) {
            Permission::findOrCreate($item, 'admin');
        }
        $role->givePermissionTo($rolePermisssions);
    }
}
