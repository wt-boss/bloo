<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->mediumInteger('country_id');
            $table->string('country_code',2);
            $table->string('fips_code',255);
            $table->string('iso2',255);
            $table->timestamps();
            $table->tinyInteger('flag');
            $table->string('wikiDataId',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
