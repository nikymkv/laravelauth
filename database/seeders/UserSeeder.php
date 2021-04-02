<?php

namespace Database\Seeders;

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
        $user = \App\Models\User::create([
            'name' => 'User U. U.',
            'email' => 'user@mail.ru',
            'email_verified_at' => now(),
            'password' => \Hash::make('0000') , // password
            'remember_token' => \Str::random(10),
        ]);

        $user->assignRole('admin');

        $users = \App\Models\User::factory()->count(5)->create();
        foreach ($users as $user) {
            $user->assignRole('user');
        }
    }
}
