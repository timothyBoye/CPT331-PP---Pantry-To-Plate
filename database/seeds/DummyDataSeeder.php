<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DummyDataSeeder extends Seeder
{
    // Recipe variables
    var $recipes_per_cuisine = 100;
    var $max_steps_per_recipe = 10;
    var $max_ingredient_recipe_maps_per_cuisine = 10;

    // User variables
    var $number_of_users = 25;
    var $max_saved_recipes_per_user = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Run this seed file ONLY if we're in debugging mode as this is DUMMY DATA
        if (env('DUMMY_DATA', false) == true) {
            // Create the fake recipes
            $this->createRecipes();
            // Create a handful of fake users
            $this->createUsers();
            // Get every generic user to rate every recipe
            $this->rateRecipes();
            // Give each user a collection of saved recipes
            //$this->userSaveRecipes();
        }
    }

    private function createRecipes()
    {
        $faker = Faker::create();

        $cuisines = \App\CuisineType::all();
        $ingredients = \App\Ingredient::where('ingredient_image_url', '!=', '')->get();

        // Loop through all the cuisines so they all have lots of recipes
        foreach($cuisines as $cuisine) {
            // Add recipes and numerous steps to those recipes
            $next_id = DB::table('recipes')->max('id') + 1;
            $last_id = $next_id + $this->recipes_per_cuisine;
            for ($id = $next_id; $id <= $next_id + $this->recipes_per_cuisine; $id++) {
                \App\Recipe::create([
                    'id' => $id,
                    'name' => 'Fake Recipe ' . $id,
                    'short_description' => $faker->paragraph(1),
                    'long_description' => $faker->paragraph(3),
                    'serving_size' => $faker->numberBetween(1, 10),
                    'cuisine_type_id' => $cuisine->id,
                    'recipe_source' => $faker->name(),
                    'image_url' => 'dummy_data/recipe-' . $faker->numberBetween(1, 10) . '.jpg'
                ]);
                \App\NutritionalInfoPanel::create([
                    'recipe_id' => $id,
                    'gram_total_fat' => $faker->numberBetween(0, 100),
                    'gram_saturated_fat' => $faker->numberBetween(0, 100),
                    'gram_total_carbohydrates' => $faker->numberBetween(0, 100),
                    'gram_sugars' => $faker->numberBetween(0, 100),
                    'gram_fiber' => $faker->numberBetween(0, 100),
                    'mg_sodium' => $faker->numberBetween(100, 1000),
                    'gram_protein' => $faker->numberBetween(0, 100),
                    'calories' => $faker->numberBetween(100, 1000)
                ]);
                // Add a variable number of steps to each recipe
                for($step = 1; $step <= $faker->numberBetween(1, $this->max_steps_per_recipe); $step++)
                {
                    \App\RecipeMethod::create([
                        'recipe_id' => $id,
                        'step_number' => $step,
                        'description' => $faker->paragraph($faker->numberBetween(1, 5)),
                        'image_url' => 'dummy_data/recipe-' . $faker->numberBetween(1, 10) . '.jpg'
                    ]);
                }
            }
            // Now go through all the ingredients and make sure they appear in multiple recipes
            foreach ($ingredients as $ingredient) {
                $number_of_maps = $faker->numberBetween(1, $this->max_ingredient_recipe_maps_per_cuisine);
                for ($count = 1; $count < $number_of_maps; $count++) {
                    $recipe_id = $faker->numberBetween($next_id, $last_id);
                    $measurement = \App\MeasurementType::inRandomOrder()->first();
                    if (count(\App\IngredientRecipeMapping::where('recipe_id', '=', $recipe_id)->where('ingredient_id', '=', $ingredient->id)->first()) == 0) {
                        \App\IngredientRecipeMapping::create([
                            'recipe_id' => $recipe_id,
                            'ingredient_id' => $ingredient->id,
                            'measurement_type_id' => $measurement->id,
                            'quantity' => $faker->randomFloat(3, 1, 50),
                            'description' => $faker->word
                        ]);
                    }
                }
            }
        }
    }

    private function createUsers()
    {
        // create a variable number of users we can later use to seed the ratings
        $faker = Faker::create();
        foreach (range(1, $this->number_of_users) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'user_role_id' => \App\UserRole::where('user_role_name', '=', 'Generic')->first()->value('id')
            ]);
        }
    }

    private function rateRecipes()
    {
        // make every generic user randomly rate every recipe
        $faker = Faker::create();
        $users = \App\User::where('user_role_id', '=', 1)->get();
        foreach ($users as $user) {
            $recipes = \App\Recipe::all();
            foreach ($recipes as $recipe)
            {
                DB::table('user_recipe_ratings')->insert([
                    'user_id' => $user->id,
                    'recipe_id' => $recipe->id,
                    'rating' => $faker->numberBetween(1,5)
                ]);
            }
        }

        // Do the initial number crunching for the averages of each recipe rating
        $recipes = \App\Recipe::all();
        foreach ($recipes as $recipe)
        {
            $ratings = \App\UserRecipeRating::where('recipe_id', '=', $recipe->id)->get();
            $count = 0;
            $sum = 0;
            foreach($ratings as $rating)
            {
                $count++;
                $sum += $rating->rating;
            }
            $average = 0;
            if ($count > 0)
            {
                $average = $sum / $count;
            }
            $recipe->number_of_ratings = $count;
            $recipe->average_rating = $average;
            $recipe->save();
        }
    }

    private function userSaveRecipes()
    {
        // Make sure every fake user has a variable number of saved recipes
        $faker = Faker::create();

        $users = \App\User::where('user_role_id', '=', 1)->get();
        foreach ($users as $user) {
            for($saves = 1; $saves < $faker->numberBetween(0,$this->max_saved_recipes_per_user); $saves++)
            {
                $recipe_id = \App\Recipe::all()->random()->id;
                if (count(\App\RecipeUserMapping::where('recipe_id', '=', $recipe_id)->where('user_id', '=', $user->id)->first()) == 0) {
                    \App\RecipeUserMapping::create([
                        'recipe_id' => $recipe_id,
                        'user_id' => $user->id
                    ]);
                }
            }
        }
    }
}
