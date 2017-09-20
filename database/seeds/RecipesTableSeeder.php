<?php

use Illuminate\Database\Seeder;
use App\Recipe;
use App\IngredientRecipeMapping;
use App\Ingredient;
use App\MeasurementType;
use App\CuisineType;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->delete();

        // bbc goodfood used for seeder recipes:
        Recipe::create(
            array(
                'id' => 1,
                'name' => 'Spaghetti Bolognese',
                'short_description' => 'Bolognese, like mama used to make!',
                'long_description' => 'Our best-ever spaghetti Bolognese is super easy and a true classic. An Italian pasta favourite with a meaty, chilli sauce, this ultimate recipe comes courtesy of BBC Good Food user, Andrew Balmer.',
                'method' => 'Put a large saucepan on a medium heat and add 1 tbsp olive oil. Add the bacon and fry for 10 mins until golden and crisp.;Reduce the heat and add the onion, carrot, celery, garlic and rosemary, then fry for 10 mins. Stir the veg often until it softens.;Increase the heat to medium-high, add the mince and cook stirring for 3-4 mins until the meat is browned all over.;Add the tinned tomatoes, chopped basil, oregano, bay leaves, tomato purée, stock cube, chilli, wine and cherry tomatoes. Stir with a wooden spoon, breaking up the plum tomatoes.;Bring to the boil, reduce to a gentle simmer and cover with a lid. Cook for 1 hr 15 mins stirring occasionally, until you have a rich, thick sauce. Add the Parmesan, check the seasoning and stir.;When the Bolognese is nearly finished cook the spaghetti following pack instructions. Drain the spaghetti and stir into the Bolognese sauce. Serve with grated Parmesan, the extra basil leaves and crusty bread.',
                'serving_size' => 6,
                'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id')
            )
        );
        Recipe::create(
            array(
                'id' => 2,
                'name' => 'Lettuce Salad',
                'short_description' => 'A salad with three ingredients. A good number for testing...',
                'long_description' => 'This brilliant salad is actually quite average.',
                'method' => 'Roughly chop lettuce;Slice onion;Dice cheese',
                'serving_size' => 2,
                'cuisine_type_id' => CuisineType::where('name', 'like', '%Mediterranean%')->value('id')
            )
        );
        Recipe::create(
            array(
                'id' => 3,
                'name' => 'Easy Pizza Sauce',
                'short_description' => 'Quick and easy pizza sauce.',
                'long_description' => 'This easy pizza sauce recipe gets cooked right on your stove top, and takes about 10 minutes from start to finish. You’ll love how delicious this is. MUCH better than anything you’ll find in a can.',
                'method' => 'Heat the olive oil over medium heat, and saute the garlic for 2 minutes.;Add the rest of the ingredients, stir, and simmer for 10-15 minutes.',
                'serving_size' => 4
            )
        );

        // Ingredient mappings should be seeded with recipes to ensure no recipes are unsearchable
        DB::table('ingredient_recipe_mappings')->delete();

        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 1,
                'ingredient_id' => Ingredient::where('name', '=', 'onion')->value('id'),
                'quantity' => 0.5,
                'description' => 'coarsely chopped',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 1,
                'ingredient_id' => Ingredient::where('name', 'celery')->value('id'),
                'quantity' => 150,
                'description' => 'coarsely chopped',
                'measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 2,
                'ingredient_id' => Ingredient::where('name', 'feta cheese')->value('id'),
                'quantity' => 50,
                'description' => 'crumbled',
                'measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),
                'quantity' => 3,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),
                'quantity' => 2,
                'description' => 'minced',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'tomato')->value('id'),
                'quantity' => 28,
                'description' => 'canned, crushed',
                'measurement_type_id' => MeasurementType::where('name', 'ounce')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'garlic powder')->value('id'),
                'quantity' => 0.5,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'onion powder')->value('id'),
                'quantity' => 0.5,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => 1,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),
                'quantity' => 0.5,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'chili flakes')->value('id'),
                'quantity' => 1,
                'description' => 'crushed',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'dried basil')->value('id'),
                'quantity' => 1,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'dried oregano')->value('id'),
                'quantity' => 1,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'dried parsley')->value('id'),
                'quantity' => 1,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 3,
                'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),
                'quantity' => 2,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
    }
}
