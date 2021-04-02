<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Admin::create([
            'name' => 'Admin Adminych',
            'email' => 'admin@mail.ru',
            'email_verified_at' => now(),
            'password' => \Hash::make('0000') , // password
            'remember_token' => \Str::random(10),
        ]);
    }
}
