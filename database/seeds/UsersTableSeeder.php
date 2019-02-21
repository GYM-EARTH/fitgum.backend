<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@fitgum.ru',
            'password' => bcrypt('123456'),
            'role_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
