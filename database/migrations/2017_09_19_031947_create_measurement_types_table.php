<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // this column should give us a rough idea of what a given measures size is in relation to other measures.
            // Use approximate millilitre conversion where possible
            $table->integer('comparable_size');
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
        Schema::dropIfExists('measurement_types');
    }
}
