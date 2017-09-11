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
        DB::table('ingredient_category')->insert([
            ['name' => 'Fruit'], //1
            ['name' => 'Vegetable'], //2
            ['name' => 'Dairy'], //3
            ['name' => 'Herb'], //4
            ['name' => 'Sprice'], //5
            ['name' => 'Meat'] //6
        ]);
    }
}
