<?php

use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert(array(
            'uuid'      => strtoupper( Uuid::generate()),
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin'),

        ));
    }
}

