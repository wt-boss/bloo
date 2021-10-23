<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionalFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditional_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conditional_id');
            $table->unsignedInteger('field_id');
            $table->foreign('conditional_id')->references('id')->on("conditionals");
            $table->foreign('field_id')->references('id')->on('form_fields');
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
        Schema::dropIfExists('conditional_fields');
    }
}
