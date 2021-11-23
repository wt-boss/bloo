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
            'id' => 1,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'superadmin@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 6,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'first_name'     => 'Super1',
            'last_name'     => 'Admin1',
            'email'    => 'admin1@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 6,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'first_name'     => 'Super',
            'last_name'     => 'Admin2',
            'email'    => 'admin2@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 6,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client1@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client2@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client3@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client4@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 8,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client5@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client6@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 10,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client7@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);

        DB::table('users')->insert([
            'id' => 11,
            'first_name'     => 'Super',
            'last_name'     => 'Admin',
            'email'    => 'client8@fake.com',
            'password' =>  Hash::make('123456'),
            'api_token' => Str::random(80),
            'role'     => 4,
            'active'     => 1,
            'avatar'   => 'avatar1.jpg',
            'email_verified_at' => '2020-04-30 17:24:47',
        ]);
    }
}
