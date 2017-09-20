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
        Recipe::create(
            array(
                'id' => 4,
                'name' => 'Fresh Cherry Syrup',
                'short_description' => 'Cherry syrup for cocktails and pancakes.',
                'long_description' => 'Fresh Cherry Syrup is such a beautiful addition to any cocktail. You can even put it over pancakes if that’s your thing. You’re going to want to make a big batch of this today while the cherries are fresh.',
                'method' => 'In a medium saucepan, combine all ingredients. You can pit the cherries or leave them with the pits if you\'d like. Either way is fine.;Use a potato masher to squish the cherries and release some juices.;Simmer over medium heat for 5-6 minutes. Mixture will be slightly thickened, all the sugar should be dissolved, and the syrup should be a deep red color.;Strain through a fine-mesh strainer, and store in the fridge for up to 2 weeks.',
                'serving_size' => 10
            )
        );
        Recipe::create(
            array(
                'id' => 5,
                'name' => 'Maple Sriracha Grilled Pork Chops',
                'short_description' => 'Sweet, spicy and absolutely delicious!',
                'long_description' => 'These Maple Sriracha Grilled Pork Chops are Sweet, spicy and absolutely delicious! They’re marinated in lime juice, Sriracha, pure maple syrup and fresh minced garlic, then grilled and on the table in less than 10 minutes!.',
                'method' => 'Combine garlic, sriracha, maple syrup, and lime. Thoroughly coat the pork chops and marinate 1-8 hours.;When ready to grill, remove chops from marinade and sprinkle with salt and pepper. Spritz with cooking spray then grill on high heat for 4 minutes on the first side and 3-4 more minutes after flipping, until the internal temperature of the meat reaches at least 145 degrees F.',
                'serving_size' => 10
            )
        );
        Recipe::create(
            array(
                'id' => 6,
                'name' => 'Avocado Cucumber Salsa',
                'short_description' => 'Quick and easy salsa',
                'long_description' => 'This Avocado Cucumber Salsa tastes so good that it will become your favourite appetiser in no time.',
                'method' => 'Add all the ingredients to a medium size bowl and mix it with a fork.',
                'serving_size' => 10
            )
        );
        Recipe::create(
            array(
                'id' => 7,
                'name' => 'Sourdough Bread with Avocado Spread',
                'short_description' => 'Simple, health & very very tasty!',
                'long_description' => 'Start your day with this mouth-watering toasted sourdough bread with avocado spread! Simple, healthy & very very tasty!',
                'method' => 'Toast the bread in a toaster or in the oven.;Wash the avocados, cut them in half and remove the peck. Using fork take out the flesh and place in a bowl. Mash the flesh with fork to get a paste. Add chia seeds, olive oil, a generous splash of lemon juice (freshly squeezed) and mix all together.;Place the toasted bread onto a plate & spread the avocado mix over. Top with arugula leaves and a few slices of goat cheese.;Add some black pepper and an extra splash of olive oil, if desired.;Serve for breakfast or as a snack any time of the day!;Enjoy!',
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
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 4,
                'ingredient_id' => Ingredient::where('name', 'water')->value('id'),
                'quantity' => 2,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 4,
                'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),
                'quantity' => 2,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 4,
                'ingredient_id' => Ingredient::where('name', 'cherries')->value('id'),
                'quantity' => 3,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'pork chops')->value('id'),
                'quantity' => 6,
                'description' => 'one-inch thick, bone-in',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'garlic cloves')->value('id'),
                'quantity' => 4,
                'description' => 'minced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'Sriracha sauce')->value('id'),
                'quantity' => 2,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'maple syrup')->value('id'),
                'quantity' => 3,
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'lime')->value('id'),
                'quantity' => 0.5,
                'description' => 'juiced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 5,
                'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'avocado')->value('id'),
                'quantity' => '1',
                'description' => 'mashed',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'black pepper')->value('id'),
                'quantity' => '1',
                'description' => 'ground',
                'measurement_type_id' => MeasurementType::where('name', 'dash')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'cucumber')->value('id'),
                'quantity' => '0.5',
                'description' => 'grated',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'lemon')->value('id'),
                'quantity' => '1',
                'description' => 'juiced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'scallion')->value('id'),
                'quantity' => '2',
                'description' => 'small, finely chopped',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'sea salt')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'dash')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 6,
                'ingredient_id' => Ingredient::where('name', 'tomato')->value('id'),
                'quantity' => '2',
                'description' => 'finely chopped',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'sourdough bread')->value('id'),
                'quantity' => '4',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'slice')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'avocado')->value('id'),
                'quantity' => '2',
                'description' => 'ripe',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'goat cheese')->value('id'),
                'quantity' => '8',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'slice')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'rocket leaves')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'extra virgin olive oil')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'chia seeds')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'lemon juice')->value('id'),
                'quantity' => '',
                'description' => 'generous',
                'measurement_type_id' => MeasurementType::where('name', 'splash')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 7,
                'ingredient_id' => Ingredient::where('name', 'black pepper')->value('id'),
                'quantity' => '',
                'description' => 'optional',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
    }
}
