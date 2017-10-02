<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutritionalInfoPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritional_info_panels', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('calories');
            $table->double('gram_total_fat')->nullable();
            $table->double('gram_saturated_fat')->nullable(); // Not bothering with mono/poly fats
            $table->double('gram_fiber')->nullable();
            $table->double('gram_total_carbohydrates')->nullable();
            $table->double('gram_sugars')->nullable();
            $table->double('gram_protein')->nullable();
            $table->integer('mg_sodium')->nullable();

            $table->integer('recipe_id');
            $table->foreign('recipe_id')->references('id')->on('recipes');

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
        Schema::dropIfExists('nutritional_info_panels');
    }
}
