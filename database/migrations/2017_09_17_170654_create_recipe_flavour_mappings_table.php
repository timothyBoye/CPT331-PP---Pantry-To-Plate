<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeFlavourMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_flavour_mappings', function (Blueprint $table) {
            $table->integer('recipe_id');
            $table->integer('flavour_id');
            $table->primary(['recipe_id', 'flavour_id']);
            $table->float('flavour_intensity'); // Between 0 and 1
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('flavour_id')->references('id')->on('flavours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_flavour_mappings');
    }
}
