<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateIngredientPantryMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_pantry_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pantry_id');
            $table->integer('ingredient_id');
            $table->foreign('pantry_id')->references('id')->on('pantries');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->date('best_before')->nullable();
            $table->date('date_added_to_pantry')->default(Carbon::now());

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
        Schema::dropIfExists('ingredient_pantry_mappings');
    }
}
