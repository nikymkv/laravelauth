<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $super_admin = \App\Models\Admin::create([
            'name' => 'Super Admin Adminych',
            'email' => 'super_admin@mail.ru',
            'email_verified_at' => now(),
            'password' => \Hash::make('0000') , // password
            'remember_token' => \Str::random(10),
        ]);

        $super_admin->assignRole('super-admin');

        $admins = \App\Models\Admin::factory()->count(5)->create();
        foreach ($admins as $admin) {
            $admin->assignRole('admin');
        }
    }
}
