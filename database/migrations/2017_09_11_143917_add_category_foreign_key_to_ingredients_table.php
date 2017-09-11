<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryForeignKeyToIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredients', function($table){
           $table->integer('ingredient_category_id')->unsigned()->nullable();
           $table->foreign('ingredient_category_id')->references('id')->on('ingredient_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredients', function($table){
            $table->dropColumn('ingredient_category_id');
        });
    }
}
