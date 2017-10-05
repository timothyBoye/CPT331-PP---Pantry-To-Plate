<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\UserRole;

class UserRecipeRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $users = \App\User::all();
        foreach ($users as $user) {
            $recipes = \App\Recipe::all();
            foreach ($recipes as $recipe)
            {
                DB::table('user_recipe_ratings')->insert([
                    'user_id' => $user->id,
                    'recipe_id' => $recipe->id,
                    'rating' => $faker->numberBetween(3,5)
                ]);
            }
        }

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
}
