<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name'     => 'Superadmin',
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
