<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCuisineTypeIdToRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function($table){
            $table->integer('cuisine_type_id')->unsigned()->nullable();
            $table->foreign('cuisine_type_id')->references('id')->on('cuisine_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function($table){
            $table->dropForeign('recipes_cuisine_type_id_foreign');
            $table->dropColumn('cuisine_type_id');
        });
    }
}
