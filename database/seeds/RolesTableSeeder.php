<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'AdHoc', 'permissions' => '{}'],
            ['name' => 'Moderator', 'permissions' => '{}'],
            ['name' => 'Manager', 'permissions' => '{}'],
            ['name' => 'Admin', 'permissions' => '{}'],
            ['name' => 'SuperAdmin', 'permissions' => '{}'],
        ]);
    }
}
