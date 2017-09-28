<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuisineTypeMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuisine_type_mappings', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('cuisine_type_id');
            $table->integer('rating');

            $table->primary(array('user_id', 'cuisine_type_id'));

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cuisine_type_id')->references('id')->on('cuisine_types');

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
        Schema::dropIfExists('user_cuisine_type_mappings');
    }
}
