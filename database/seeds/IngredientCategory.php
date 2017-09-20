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
            ['name' => 'Fruit', 'id' => Config::get('constants.fruit_category_id')], //1
            ['name' => 'Vegetable', 'id' => Config::get('constants.veg_category_id')], //2
            ['name' => 'Dairy', 'id' => Config::get('constants.dairy_category_id')], //3
            ['name' => 'Herb', 'id' => Config::get('constants.herb_category_id')], //4
            ['name' => 'Spice', 'id' => Config::get('constants.spice_category_id')], //5
            ['name' => 'Meat', 'id' => Config::get('constants.meat_category_id')], //6
            ['name' => 'Oil', 'id' => Config::get('constants.oil_category_id')], //7
            ['name' => 'Sweetener', 'id' => Config::get('constants.sweetener_category_id')] //8
        ]);

    }
}
