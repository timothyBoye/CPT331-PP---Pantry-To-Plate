<?php

use Illuminate\Database\Seeder;
use App\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->delete();

        $ingredients = [
            'romaine lettuce',
            'black olives',
            'grape tomatoes',
            'garlic',
            'pepper',
            'purple onion',
            'salt',
            'beans',
            'feta cheese'
        ];

        for($i = 0; $i < count($ingredients); $i++){
            Ingredient::create(array(
               'name' => $ingredients[$i]
            ));
        }
    }
}
