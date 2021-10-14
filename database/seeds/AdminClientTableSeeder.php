<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin__clients')->insert([
            'admin_id'     => 2,
            'client_id' => 4
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 2,
            'client_id' => 5
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 2,
            'client_id' => 6
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 2,
            'client_id' => 7
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 3,
            'client_id' => 8
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 3,
            'client_id' => 9
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 3,
            'client_id' => 10
        ]);

        DB::table('admin__clients')->insert([
            'admin_id'     => 3,
            'client_id' => 11
        ]);
    }
}
