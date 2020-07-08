<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'superadmin@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 5,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);
    }
}
