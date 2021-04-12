<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'Sync Centre Admin User',
            'email' => 'desynccentre@gmail.com',
            'password' => Hash::make(str_random()),
        ]);

        $access = new \App\Access;
        $access->role_id = \App\Role::where('name', 'Admin')->first()->id;
        $user->access()->save($access);

    }
}
