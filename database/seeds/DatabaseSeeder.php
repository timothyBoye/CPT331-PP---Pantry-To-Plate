<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->delete();
        DB::table('recipe_methods')->delete();
        DB::table('ingredient_recipe_mappings')->delete();
        DB::table('cuisine_types')->delete();
        DB::table('flavours')->delete();
        DB::table('ingredient_categories')->delete();
        DB::table('ingredients')->delete();
        DB::table('measurement_types')->delete();
        DB::table('nutritional_info_panels')->delete();
        DB::table('user_recipe_ratings')->delete();
        DB::table('user_roles')->delete();
        DB::table('users')->delete();

        // $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(MeasurementTypeSeeder::class);
        $this->call(IngredientCategory::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(FlavoursTableSeeder::class);
        $this->call(CuisineTypesTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(NutritionalInfoPanelsTableSeeder::class);
        $this->call(UserSeeder::class);
    }
}
