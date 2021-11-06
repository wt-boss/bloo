<?php

use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
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
            'timeTest'    => null,
            'userTest' =>  null,
            'reduction' => null,

        ]);

        DB::table('offers')->insert([
            'intitule'     => 'Monthly',
            'payementCycle'     => null,
            'timeTest'    => null,
            'userTest' =>  null,
            'reduction' => null,

        ]);
    }
}
