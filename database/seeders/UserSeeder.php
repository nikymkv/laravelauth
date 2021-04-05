<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $guard_name = 'admin';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'User U. U.',
            'email' => 'user@mail.ru',
            'email_verified_at' => now(),
            'password' => \Hash::make('0000') , // password
            'remember_token' => \Str::random(10),
        ]);

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
