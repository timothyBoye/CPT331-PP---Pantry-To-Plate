<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientRecipeMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingredient_id')->unsigned()->nullable();
            $table->integer('recipe_id')->unsigned()->nullable();
            $table->integer('amount')->unsigned()->default(0);
            $table->integer('measurement_type_id')->unsigned()->nullable();
            $table->integer('ingredient_preparation_type_id')->unsigned()->nullable();

            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('measurement_type_id')->references('id')->on('measurement_types');
            $table->foreign('ingredient_preparation_type_id')->references('id')->on('ingredient_preparation_types');
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
        Schema::dropIfExists('ingredient_recipe_mappings');
    }
}
