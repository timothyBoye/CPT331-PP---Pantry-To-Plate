<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRecipeAddColumnsToReplaceApiProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // sqlite won't accept a non null column in a migration unless it has a default value specified
        Schema::table('recipes', function($table){
            $table->string('name')->nullable(false)->default('');
            $table->string('short_description', 250)->nullable(false)->default('');
            $table->text('long_description')->nullable(false)->default('');
            // I feel like a comma separated string instead of another table for the method will be neater.
            // Thoughts?
            $table->text('method')->nullable(false)->default('');
            $table->integer('serving_size')->nullable(false)->default(0);
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
            $table->dropColumn('name');
            $table->dropColumn('short_description');
            $table->dropColumn('long_description');
            $table->dropColumn('method');
            $table->dropColumn('serving_size');
        });
    }
}
