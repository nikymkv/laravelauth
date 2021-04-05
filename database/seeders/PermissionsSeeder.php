<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $this->loadData();
        $this->seedsRoles();
    }

    private function loadData() : void
    {
        $this->data = require_once \database_path('data/permissions_roles.php');
    }

    private function seedsRoles() : void
    {
        Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);

        foreach ($this->data as $roleName => $perms) {
            $role = Role::create(['name' => $roleName, 'guard_name' => 'admin']);
            $this->seedRolePermissions($role, $perms);
        }
    }

    private function seedRolePermissions(Role $role, array $modelPermissions) : void
    {
        foreach ($modelPermissions as $model => $perms) {
            $buildedPerms = collect($perms)
                ->crossJoin($model)
                ->map(function ($item) use ($role){
                    $perm = implode('-', $item);
                    Permission::findOrCreate($perm, 'admin');

                    return $perm;
                })->toArray();

                $role->givePermissionTo($buildedPerms);
        }
    }
}
