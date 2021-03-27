<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFormResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_responses', function (Blueprint $table) {
            $table->string('respondent_site')->nullable();
            $table->string('respondent_country')->nullable();
            $table->string('respondent_city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_responses', function (Blueprint $table) {
            //
        });
    }
}
