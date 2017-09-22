<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageUrlToIngredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*  Wrong approach i.e. not creating a new table
        Schema::create('ingredientImage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        */

        //Adding a column to an existing table called ingredients
        Schema::table('ingredients', function($table) {
            $table->string('ingredient_image_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredients', function($table) {
            $table->dropColumn('ingredient_image_url');
        });    }
}
