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
            $table->integer('ingredient_id');
            $table->integer('recipe_id');
            $table->integer('measurement_type_id');
            $table->float('quantity');
            $table->string('description');
            $table->primary(['ingredient_id', 'recipe_id']);
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('measurement_type_id')->references('id')->on('measurement_types');
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
