<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    protected $guard_name = 'admin';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Super Admin Adminych',
            'email' => 'super_admin@mail.ru',
            'email_verified_at' => now(),
            'password' => '0000',
            'remember_token' => \Str::random(10),
        ]);

        $role = Role::where('name', 'admin')->get()->first();

        $permissions = Permission::pluck('id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);

        $admins = Admin::factory()->count(5)->create();

        foreach($admins as $admin) {
            $admin->assignRole('subadmin');
        }
    }
}
