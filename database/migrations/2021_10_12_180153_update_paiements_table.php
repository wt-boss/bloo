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

//            DROPPING OLD COLUMNS
            #$table->dropPrimary('paiements_id_primary');
//            $table->dropColumn('id');
//            $table->dropColumn('paiement_id');
//            $table->dropColumn('user_id');
//            $table->dropColumn('offre_id');

//            ADDING NEW COLOUMNS

            $table->string('motif');
            $table->dateTime('date');
            $table->unsignedBigInteger('validity');
            $table->unsignedBigInteger('cost');
            $table->unsignedBigInteger('discount');
            $table->unsignedBigInteger('netRate');
            $table->unsignedBigInteger('susbcription_id');
            $table->foreign('susbcription_id')->references('id')->on('subscriptions');
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
//        Schema::table('paiements', function (Blueprint $table) {
////            DROPPING FK
//            $table->dropForeign('consomations_subscription_id_foreign');
////            DROPPING ALL CREATED COLUMNS
//            $table->dropColumn('motif');
//            $table->dropColumn('date');
//            $table->dropColumn('validity');
//            $table->dropColumn('cost');
//            $table->dropColumn('discount');
//            $table->dropColumn('netRate');
//            $table->dropColumn('subscription_id');
////              ADDING OLD COLUMNS
//            $table->bigIncrements('id');
//            $table->string('paiement_id');
//            $table->unsignedBigInteger('user_id');
//            $table->unsignedBigInteger('offre_id')->nullable();
//        });
    }
}
