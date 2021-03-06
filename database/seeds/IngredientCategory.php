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

        DB::table('ingredient_categories')->insert([
            ['name' => 'Fruit', 'id' => Config::get('constants.fruit_category_id')], //1
            ['name' => 'Vegetable', 'id' => Config::get('constants.veg_category_id')], //2
            ['name' => 'Dairy', 'id' => Config::get('constants.dairy_category_id')], //3
            ['name' => 'Herb', 'id' => Config::get('constants.herb_category_id')], //4
            ['name' => 'Spice', 'id' => Config::get('constants.spice_category_id')], //5
            ['name' => 'Meat', 'id' => Config::get('constants.meat_category_id')], //6
            ['name' => 'Oil', 'id' => Config::get('constants.oil_category_id')], //7
            ['name' => 'Sweetener', 'id' => Config::get('constants.sweetener_category_id')], //8
            ['name' => 'Liquid', 'id' => Config::get('constants.liquid_category_id')], //9
            ['name' => 'Condiment', 'id' => Config::get('constants.condiment_category_id')], //10
            ['name' => 'Grain', 'id' => Config::get('constants.grain_category_id')], //11
            ['name' => 'Seeds', 'id' => Config::get('constants.seeds_category_id')], //12
            ['name' => 'Nuts', 'id' => Config::get('constants.nuts_category_id')], //13
            ['name' => 'Baking', 'id' => Config::get('constants.baking_category_id')], //14
            ['name' => 'Misc', 'id' => Config::get('constants.misc_category_id')] //15

        ]);
    }
}
