<?php

use Illuminate\Database\Seeder;

class IngredientCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Allows us to run db:seed without having to re-do the migrations. If omitted, it will just
        // add new categories along with the existing ones.
        DB::table('ingredient_categories')->delete();

        DB::table('ingredient_categories')->insert([
            ['name' => 'Fruit'], //1
            ['name' => 'Vegetable'], //2
            ['name' => 'Dairy'], //3
            ['name' => 'Herb'], //4
            ['name' => 'Sprice'], //5
            ['name' => 'Meat'] //6
        ]);

    }
}
