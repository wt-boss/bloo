<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('paiements');
        Schema::table('paiements', function (Blueprint $table) {


//
//            $table->string('motif');
//            $table->dateTime('date');
//            $table->unsignedBigInteger('validity');
//            $table->unsignedBigInteger('cost');
//            $table->unsignedBigInteger('discount');
//            $table->unsignedBigInteger('netRate');
//            $table->unsignedBigInteger('susbcription_id');
//            $table->foreign('susbcription_id')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');

    }
}
