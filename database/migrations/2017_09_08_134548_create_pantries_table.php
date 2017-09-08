<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePantriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pantries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::table('users', function($table){
           $table->integer('pantry_id')->unsigned()->nullable();
           $table->foreign('pantry_id')->references('id')->on('pantries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pantries');
        Schema::table('users', function($table){
           $table->dropColumn('pantry_id');
        });
    }
}
