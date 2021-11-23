<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->insert([
            'intitule'     => 'PayAsYouGo',
            'payementCycle'     => null,
            'montant' => 15000,
            'timeTest'    => null,
            'userTest' =>  10

        ]);

        DB::table('offers')->insert([
            'intitule'     => 'Monthly',
            'payementCycle'     => null,
            'montant' => 25000,
            'timeTest'    => 10,
            'userTest' =>  null
        ]);
    }
}
