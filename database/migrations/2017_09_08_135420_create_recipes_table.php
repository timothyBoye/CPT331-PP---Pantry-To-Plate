<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false)->default('');
            $table->string('short_description', 250)->nullable(false)->default('');
            $table->text('long_description')->nullable(false)->default('');
            // I feel like a comma separated string instead of another table for the method will be neater.
            // Thoughts?
            $table->text('method')->nullable(false)->default('');
            $table->integer('serving_size')->nullable(false)->default(0);
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
        Schema::dropIfExists('recipes');
    }
}
