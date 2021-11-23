<?php

use Illuminate\Database\Seeder;

class ExtraTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extras')->insert([
            'type' => 'Client',
            'offer_id' => 1,
            'cost' => 1000
        ]);

        DB::table('extras')->insert([
            'type' => 'Opérateur',
            'offer_id' => 1,
            'cost' => 1000
        ]);

        DB::table('extras')->insert([
            'type' => 'Client',
            'offer_id' => 2,
            'cost' => 1000
        ]);
    }
}
