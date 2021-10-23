<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('form_id');
            $table->unsignedInteger('field_id');
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('field_id')->references('id')->on('form_fields');
            $table->string('field_name');
            $table->string('value');
            $table->string('display');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conditionals');
    }
}
