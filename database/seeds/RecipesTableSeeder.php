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
        // bbc goodfood used for seeder recipes:
        Recipe::create(array('id' => 1,'name' => 'Spaghetti Bolognese',
            'short_description' => 'Bolognese, like mama used to make!',
            'long_description' => 'Our best-ever spaghetti Bolognese is super easy and a true classic. An Italian pasta favourite with a meaty, chilli sauce, this ultimate recipe comes courtesy of BBC Good Food user, Andrew Balmer.',
            'serving_size' => 6,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id'),
            'image_url' => 'spaghetti.jpg',
            'recipe_source' => 'https://www.bbcgoodfood.com/recipes/1502640/the-best-spaghetti-bolognese'));
        IngredientRecipeMapping::create(array('recipe_id' => 1,'ingredient_id' => Ingredient::where('name', '=', 'onion')->value('id'),'quantity' => 0.5,'description' => 'coarsely chopped','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 1,'ingredient_id' => Ingredient::where('name', 'celery')->value('id'),'quantity' => 150,'description' => 'coarsely chopped','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'step_number' => 1, 'description' => 'Put a large saucepan on a medium heat and add 1 tbsp olive oil. Add the bacon and fry for 10 mins until golden and crisp.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'step_number' => 2, 'description' => 'Reduce the heat and add the onion, carrot, celery, garlic and rosemary, then fry for 10 mins. Stir the veg often until it softens.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'step_number' => 3, 'description' => 'Increase the heat to medium-high, add the mince and cook stirring for 3-4 mins until the meat is browned all over.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'step_number' => 4, 'description' => 'Add the tinned tomatoes, chopped basil, oregano, bay leaves, tomato purée, stock cube, chilli, wine and cherry tomatoes. Stir with a wooden spoon, breaking up the plum tomatoes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'step_number' => 5, 'description' => 'Bring to the boil, reduce to a gentle simmer and cover with a lid. Cook for 1 hr 15 mins stirring occasionally, until you have a rich, thick sauce. Add the Parmesan, check the seasoning and stir.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'step_number' => 6, 'description' => 'When the Bolognese is nearly finished cook the spaghetti following pack instructions. Drain the spaghetti and stir into the Bolognese sauce. Serve with grated Parmesan, the extra basil leaves and crusty bread.', 'image_url' => ''));


        \App\Recipe::create(array('id' => 2, 'name' => 'Lettuce Salad',
            'short_description' => 'A salad with just three ingredients.',
            'long_description' => 'This brilliant salad is super simple and quick to make',
            'serving_size' => '2',
            'cuisine_type_id' => CuisineType::where('name', '=', 'Mediterranean')->value('id'),
            'image_url' => 'lettuce-salad.jpg'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Lettuce Salad')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'feta cheese')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '50.0', 'description' => 'crumbled'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Lettuce Salad')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'romaine lettuce')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'head')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Lettuce Salad')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'grape tomatoes')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '100', 'description' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Lettuce Salad')->value('id'), 'step_number' => 1, 'description' => 'Roughly chop lettuce and halve tomatoes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Lettuce Salad')->value('id'), 'step_number' => 2, 'description' => 'Place lettuce and tomato into a bowl then crumble over the feta and serve.', 'image_url' => ''));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Lettuce Salad')->value('id'), 'gram_total_fat' => '25.0', 'gram_saturated_fat' => '10.0', 'gram_total_carbohydrates' => '58.0', 'gram_sugars' => '12.0', 'gram_fiber' => '6.0', 'mg_sodium' => '1600', 'gram_protein' => '35.0', 'calories' => '35'));


        Recipe::create(array('id' => 3,'name' => 'Easy Pizza Sauce',
            'short_description' => 'Quick and easy pizza sauce.',
            'long_description' => 'This easy pizza sauce recipe gets cooked right on your stove top, and takes about 10 minutes from start to finish. You’ll love how delicious this is. MUCH better than anything you’ll find in a can.',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id'),
            'image_url' => 'pizza-sauce.jpg',
            'recipe_source' => 'https://www.orwhateveryoudo.com/2017/05/easy-pizza-sauce-recipe-homemade.html'));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),'quantity' => 3,'description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),'quantity' => 2,'description' => 'minced','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'tomato')->value('id'),'quantity' => 28,'description' => 'canned, crushed','measurement_type_id' => MeasurementType::where('name', 'ounce')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'garlic powder')->value('id'),'quantity' => 0.5,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'onion powder')->value('id'),'quantity' => 0.5,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => 1,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => 0.5,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'chili flakes')->value('id'),'quantity' => 1,'description' => 'crushed','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'dried basil')->value('id'),'quantity' => 1,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'dried oregano')->value('id'),'quantity' => 1,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'dried parsley')->value('id'),'quantity' => 1,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 3,'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),'quantity' => 2,'description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Easy Pizza Sauce')->value('id'), 'step_number' => 1, 'description' => 'Heat the olive oil over medium heat, and saute the garlic for 2 minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Easy Pizza Sauce')->value('id'), 'step_number' => 2, 'description' => 'Add the rest of the ingredients, stir, and simmer for 10-15 minutes.', 'image_url' => ''));


        Recipe::create(array('id' => 4,'name' => 'Fresh Cherry Syrup',
            'short_description' => 'Cherry syrup for cocktails and pancakes.',
            'long_description' => 'Fresh Cherry Syrup is such a beautiful addition to any cocktail. You can even put it over pancakes if that’s your thing. You’re going to want to make a big batch of this today while the cherries are fresh.',
            'serving_size' => 10,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id'),
            'image_url' => 'cherry-syrup.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/T2BYWGQC/fresh-cherry-syrup'));
        IngredientRecipeMapping::create(array('recipe_id' => 4,'ingredient_id' => Ingredient::where('name', 'water')->value('id'),'quantity' => 2,'description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 4,'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),'quantity' => 2,'description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 4,'ingredient_id' => Ingredient::where('name', 'cherry')->value('id'),'quantity' => 3,'description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Fresh Cherry Syrup')->value('id'), 'step_number' => 1, 'description' => 'In a medium saucepan, combine all ingredients. You can pit the cherries or leave them with the pits if you\'d like. Either way is fine.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Fresh Cherry Syrup')->value('id'), 'step_number' => 2, 'description' => 'Use a potato masher to squish the cherries and release some juices.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Fresh Cherry Syrup')->value('id'), 'step_number' => 3, 'description' => 'Simmer over medium heat for 5-6 minutes. Mixture will be slightly thickened, all the sugar should be dissolved, and the syrup should be a deep red color.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Fresh Cherry Syrup')->value('id'), 'step_number' => 4, 'description' => 'Strain through a fine-mesh strainer, and store in the fridge for up to 2 weeks.', 'image_url' => ''));


        Recipe::create(array('id' => 5,'name' => 'Maple Sriracha Grilled Pork Chops',
            'short_description' => 'Sweet, spicy and absolutely delicious!',
            'long_description' => 'These Maple Sriracha Grilled Pork Chops are Sweet, spicy and absolutely delicious! They’re marinated in lime juice, Sriracha, pure maple syrup and fresh minced garlic, then grilled and on the table in less than 10 minutes!.',
            'serving_size' => 10,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Western%')->value('id'),
            'image_url' => 'Maple-Sriracha-Grilled-Bone-In-Pork-Chops-OT-chop-and-limes-3.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/5YYRT8D3/maple-sriracha-grilled-pork-chops'));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'pork chops')->value('id'),'quantity' => 6,'description' => 'one-inch thick, bone-in','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),'quantity' => 4,'description' => 'cloves minced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'sriracha sauce')->value('id'),'quantity' => 2,'description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'maple syrup')->value('id'),'quantity' => 3,'description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'lime')->value('id'),'quantity' => 0.5,'description' => 'juiced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 5,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Maple Sriracha Grilled Pork Chops')->value('id'), 'step_number' => 1, 'description' => 'Combine garlic, sriracha, maple syrup, and lime. Thoroughly coat the pork chops and marinate 1-8 hours.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Maple Sriracha Grilled Pork Chops')->value('id'), 'step_number' => 2, 'description' => 'When ready to grill, remove chops from marinade and sprinkle with salt and pepper. Spritz with cooking spray then grill on high heat for 4 minutes on the first side and 3-4 more minutes after flipping, until the internal temperature of the meat reaches at least 145 degrees F.', 'image_url' => ''));


        Recipe::create(array('id' => 6,'name' => 'Avocado Cucumber Salsa',
            'short_description' => 'Quick and easy salsa',
            'long_description' => 'This Avocado Cucumber Salsa tastes so good that it will become your favourite appetiser in no time.',
            'serving_size' => 10,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Mexican%')->value('id'),
            'image_url' => 'cucumber-avo.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/HMTJV3W2/avocado-cucumber-salsa'));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'avocado')->value('id'),'quantity' => '1','description' => 'mashed','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'black pepper')->value('id'),'quantity' => '1','description' => 'ground','measurement_type_id' => MeasurementType::where('name', 'dash')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'cucumber')->value('id'),'quantity' => '0.5','description' => 'grated','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'lemon')->value('id'),'quantity' => '1','description' => 'juiced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'scallion')->value('id'),'quantity' => '2','description' => 'small, finely chopped','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'sea salt')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'dash')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 6,'ingredient_id' => Ingredient::where('name', 'tomato')->value('id'),'quantity' => '2','description' => 'finely chopped','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Avocado Cucumber Salsa')->value('id'), 'step_number' => 1, 'description' => 'Add all the ingredients to a medium size bowl and mix it with a fork.', 'image_url' => ''));


        Recipe::create(array('id' => 7,'name' => 'Sourdough Bread with Avocado Spread',
            'short_description' => 'Simple, health & very very tasty!',
            'long_description' => 'Start your day with this mouth-watering toasted sourdough bread with avocado spread! Simple, healthy & very very tasty!',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%French%')->value('id'),
            'image_url' => 'sourdough-avo.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/CZBQTVCD/sourdough-bread-with-avocado-spread'));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'sourdough bread')->value('id'),'quantity' => '4','description' => '','measurement_type_id' => MeasurementType::where('name', 'slice')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'avocado')->value('id'),'quantity' => '2','description' => 'ripe','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'goat cheese')->value('id'),'quantity' => '8','description' => '','measurement_type_id' => MeasurementType::where('name', 'slice')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'rocket leaves')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'extra virgin olive oil')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'chia seeds')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'lemon juice')->value('id'),'quantity' => '1','description' => 'generous','measurement_type_id' => MeasurementType::where('name', 'splash')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 7,'ingredient_id' => Ingredient::where('name', 'black pepper')->value('id'),'quantity' => '','description' => 'optional','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Sourdough Bread with Avocado Spread')->value('id'), 'step_number' => 1, 'description' => 'Toast the bread in a toaster or in the oven.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Sourdough Bread with Avocado Spread')->value('id'), 'step_number' => 2, 'description' => 'Wash the avocados, cut them in half and remove the peck. Using fork take out the flesh and place in a bowl. Mash the flesh with fork to get a paste. Add chia seeds, olive oil, a generous splash of lemon juice (freshly squeezed) and mix all together.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Sourdough Bread with Avocado Spread')->value('id'), 'step_number' => 3, 'description' => 'Place the toasted bread onto a plate & spread the avocado mix over. Top with arugula leaves and a few slices of goat cheese.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Sourdough Bread with Avocado Spread')->value('id'), 'step_number' => 4, 'description' => 'Add some black pepper and an extra splash of olive oil, if desired.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Sourdough Bread with Avocado Spread')->value('id'), 'step_number' => 5, 'description' => 'Serve for breakfast or as a snack any time of the day!', 'image_url' => ''));


        Recipe::create(array('id' => 8,'name' => 'Chorizo Breakfast Tacos with Potato Hash and Eggs',
            'short_description' => 'The perfect meal anytime of day!',
            'long_description' => 'Chorizo Breakfast Tacos with Potato Hash and Eggs are ridiculously flavorful, quick and easy. The perfect meal anytime of day!',
            'serving_size' => 6,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Mexican%')->value('id'),
            'image_url' => 'breakfast-hash.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/F4KXJJG6/chorizo-breakfast-tacos-with-potato-hash-and-eggs'));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'vegetable oil')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'potato')->value('id'),'quantity' => '2','description' => 'baked, then chopped','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'onion')->value('id'),'quantity' => '0.5','description' => 'chopped','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'garlic powder')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'onion powder')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'pork chorizo sausage')->value('id'),'quantity' => '7','description' => 'fresh, casings removed if needed','measurement_type_id' => MeasurementType::where('name', 'ounce')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'egg')->value('id'),'quantity' => '5','description' => 'large','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'milk')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'cilantro')->value('id'),'quantity' => '3','description' => 'fresh, finely chopped, divided','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'corn tortillas')->value('id'),'quantity' => '6','description' => 'small','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'cheddar cheese')->value('id'),'quantity' => '0.5','description' => 'shredded','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 8,'ingredient_id' => Ingredient::where('name', 'hot sauce')->value('id'),'quantity' => '','description' => 'or salsa','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chorizo Breakfast Tacos with Potato Hash and Eggs')->value('id'), 'step_number' => 1, 'description' => 'In a large nonstick frying pan over medium high heat, add the oil and heat until shimmering. Add the potatoes, onion, garlic powder and onion powder to one side of the pan. Salt and pepper, if needed. Add the chorizo sausage to the other side and sauté until cooked through, breaking up with the back of a spoon, about 5 minutes. Turn over the potatoes after a couple of minutes so they get brown on both sides.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chorizo Breakfast Tacos with Potato Hash and Eggs')->value('id'), 'step_number' => 2, 'description' => 'In a medium bowl, combine the eggs, milk, 1 tablespoon of cilantro and season with a little salt and pepper. Reduce the heat of the frying pan to medium low and add the egg mixture. Stir the eggs until they are very softly set, about 3 minutes. Remove the pan from the heat.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chorizo Breakfast Tacos with Potato Hash and Eggs')->value('id'), 'step_number' => 3, 'description' => 'To assemble the tacos, take the heated tortillas and divide the egg, chorizo and potato mixture among them. Sprinkle with remaining cilantro, and then add the cheese and salsa on top.', 'image_url' => ''));


        Recipe::create(array('id' => 9,'name' => 'Kidney Bean Salad',
            'short_description' => 'An easy, healthy salad or side dish',
            'long_description' => 'Kidney bean salad recipe is an easy, healthy salad or side dish. This salad is delicious and makes a great lunch. This salad is gestational diabetes friendly as well. This salad is perfect for hot weather. So try this tasty kidney bean salad.',
            'serving_size' => 6,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Western%')->value('id'),
            'image_url' => 'Kidney-Bean-Salad.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/QRH3XW2K/kidney-bean-salad-recipe'));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'kidney beans')->value('id'),'quantity' => '3','description' => '','measurement_type_id' => MeasurementType::where('name', 'can')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'red pepper')->value('id'),'quantity' => '1','description' => 'diced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'yellow pepper')->value('id'),'quantity' => '1','description' => 'diced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'red onion')->value('id'),'quantity' => '0.5','description' => 'diced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'parsley')->value('id'),'quantity' => '1','description' => 'small, chopped','measurement_type_id' => MeasurementType::where('name', 'bunch')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'lemon')->value('id'),'quantity' => '2','description' => 'juiced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 9,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '','description' => 'to taste','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Kidney Bean Salad')->value('id'), 'step_number' => 1, 'description' => 'Start off with draining and rinsing the kidney beans, then toss them in a bowl or Tupperware.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Kidney Bean Salad')->value('id'), 'step_number' => 2, 'description' => 'Mix in your diced bell peppers, onion, and parsley.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Kidney Bean Salad')->value('id'), 'step_number' => 3, 'description' => 'Drizzle the olive oil and mix well.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Kidney Bean Salad')->value('id'), 'step_number' => 4, 'description' => 'Add desired amount of lemon. I love lemon so I will use two or more lemons.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Kidney Bean Salad')->value('id'), 'step_number' => 5, 'description' => 'Salt to taste.', 'image_url' => ''));


        Recipe::create(array('id' => 10,'name' => 'Roasted Parmesan Broccoli',
            'short_description' => 'This is a yummy, easy veggie dish.',
            'long_description' => 'Roasted Parmesan Broccoli - Roasted with olive oil & Parmesan cheese, and finished with lemon zest. Super simple & healthy, this is a yummy, easy veggie dish.',
            'serving_size' => 8,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Western%')->value('id'),
            'image_url' => 'Roasted-Parmesan-Broccoli.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/Y3QXVYPS/roasted-parmesan-broccoli'));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'broccoli')->value('id'),'quantity' => '1','description' => 'large, sliced into 1 inch thick steaks','measurement_type_id' => MeasurementType::where('name', 'head')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),'quantity' => '4','description' => 'cloves thinly sliced','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'chili flakes')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'parmesan cheese')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'lemon')->value('id'),'quantity' => '','description' => 'zest from half a lemon','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 10,'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),'quantity' => '3','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Roasted Parmesan Broccoli')->value('id'), 'step_number' => 1, 'description' => 'Preheat the oven to 425 degrees.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Roasted Parmesan Broccoli')->value('id'), 'step_number' => 2, 'description' => 'Add sliced broccoli to a parchment paper-lined baking sheet.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Roasted Parmesan Broccoli')->value('id'), 'step_number' => 3, 'description' => 'Sprinkle with salt, pepper, red pepper flakes, and olive oil, then toss gently.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Roasted Parmesan Broccoli')->value('id'), 'step_number' => 4, 'description' => 'Roast for 10 minutes, add the sliced garlic to the pan, and return to the oven.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Roasted Parmesan Broccoli')->value('id'), 'step_number' => 5, 'description' => 'Bake 6 more minutes, then sprinkle with parmesan and bake for 2 more minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Roasted Parmesan Broccoli')->value('id'), 'step_number' => 6, 'description' => 'Remove from the oven, dust with lemon zest and enjoy!', 'image_url' => ''));


        Recipe::create(array('id' => 11,'name' => 'Smoky Paprika Chicken',
            'short_description' => 'An easy, healthy salad or side dish',
            'long_description' => 'This quick and flavor-filled smoky paprika chicken seared with bell peppers makes a perfect 30-minute dinner!',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Spanish%')->value('id'),
            'image_url' => 'SmokyPaprika-Chicken.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/ZXRLGYRF/smoky-paprika-chicken'));
        IngredientRecipeMapping::create(array('recipe_id' => 11,'ingredient_id' => Ingredient::where('name', 'chicken thighs')->value('id'),'quantity' => '1','description' => 'boneless','measurement_type_id' => MeasurementType::where('name', 'lb')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 11,'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 11,'ingredient_id' => Ingredient::where('name', 'smoked paprika')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 11,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 11,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 11,'ingredient_id' => Ingredient::where('name', 'bell peppers')->value('id'),'quantity' => '2','description' => 'large, chopped into medium pieces','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Smoky Paprika Chicken')->value('id'), 'step_number' => 1, 'description' => 'Cut the chicken into small bite-sized pieces and place them in the mixing bowl. Add olive oil, paprika, salt and pepper and stir everything together.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Smoky Paprika Chicken')->value('id'), 'step_number' => 2, 'description' => 'Preheat a large non-stick griddle to medium-high heat. Add half of the chicken and fry it until well browned for about 4-5 minutes. At this point, the chicken doesn\'t need to be cooked through as it will be cooked with bell peppers in a later step. Transfer the chicken into a bowl, and fry the rest of the chicken.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Smoky Paprika Chicken')->value('id'), 'step_number' => 3, 'description' => 'Once the second batch of chicken is browned, remove the chicken from the pan.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Smoky Paprika Chicken')->value('id'), 'step_number' => 4, 'description' => 'To the same hot pan, with the oil leftover from the chicken, add the bell peppers. Saute the bell pepper until the char marks start appearing and then add the chicken, with the juices, on top. Place the lid on the pan.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Smoky Paprika Chicken')->value('id'), 'step_number' => 5, 'description' => 'Cook it for several minutes until the chicken is cooked fully. Then, remove the lid and keep cooking until the liquid is almost evaporated.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Smoky Paprika Chicken')->value('id'), 'step_number' => 6, 'description' => 'Sprinkle the chicken with some chopped parsley.', 'image_url' => ''));


        Recipe::create(array('id' => 12,'name' => 'Cumin Orange Cashew Salad',
            'short_description' => 'So delicious!',
            'long_description' => 'This Cumin Orange Cashew Salad only requires four ingredients and 10 minutes to make. So delicious!',
            'serving_size' => 2,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Mexican%')->value('id'),
            'image_url' => 'Cumin-Orange-Cashew-Salad.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/5YW6RQFQ/cumin-orange-cashew-salad'));
        IngredientRecipeMapping::create(array('recipe_id' => 12,'ingredient_id' => Ingredient::where('name', 'mixed greens')->value('id'),'quantity' => '3','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 12,'ingredient_id' => Ingredient::where('name', 'orange')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 12,'ingredient_id' => Ingredient::where('name', 'cashew nuts')->value('id'),'quantity' => '0.33','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 12,'ingredient_id' => Ingredient::where('name', 'cumin')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 12,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 12,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Cumin Orange Cashew Salad')->value('id'), 'step_number' => 1, 'description' => 'Cut or tear the mixed greens into small pieces. Put them in a bowl and set aside.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Cumin Orange Cashew Salad')->value('id'), 'step_number' => 2, 'description' => 'Peel the oranges and cut them into small bite size pieces. Roast them with cumin, salt and pepper on a dry frying pan over medium heat. No oil is required as the oranges contain enough juice to prevent them from sticking to the pan. Cook the oranges for about five minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Cumin Orange Cashew Salad')->value('id'), 'step_number' => 3, 'description' => 'Take the oranges off the pan and add them to your bowl of greens. Roast the cashew nuts on the same pan for 3-5 minutes or until they are slightly golden.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Cumin Orange Cashew Salad')->value('id'), 'step_number' => 4, 'description' => 'Take the cashew nuts off the heat and mix them with the oranges and greens. Serve immediately.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Cumin Orange Cashew Salad')->value('id'), 'step_number' => 5, 'description' => 'This salad doesn\'t keep well even if kept in the fridge.', 'image_url' => ''));


        Recipe::create(array('id' => 13,'name' => 'Halloumi, Blueberry & Spinach Salad',
            'short_description' => 'Bright colours and rich tastes combine for a hearty dish.',
            'long_description' => 'A vibrant Halloumi, blueberry and spinach salad that is a contrast of textures and flavours. Bright colours and rich tastes combine for a hearty dish.',
            'serving_size' => 2,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Mediterranean%')->value('id'),
            'image_url' => 'Halloumi-Blueberry-Spinach-Salad.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/X4N7FNX8/halloumi-blueberry-spinach-salad'));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'halloumi cheese')->value('id'),'quantity' => '250','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'blueberries')->value('id'),'quantity' => '100','description' => 'fresh','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'spinach')->value('id'),'quantity' => '1','description' => 'fresh','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),'quantity' => '2','description' => 'one for frying, one for dressing','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'lime juice')->value('id'),'quantity' => '','description' => 'from half a lime','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'balsamic vinegar')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '0.25','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'black pepper')->value('id'),'quantity' => '0.25','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 13,'ingredient_id' => Ingredient::where('name', 'sumac')->value('id'),'quantity' => '0.25','description' => 'for garnish, optional','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 1, 'description' => 'Cut the Halloumi cheese into slices or even cubes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 2, 'description' => 'Heat the olive oil in either a frying pan or a griddle pan.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 3, 'description' => 'Gently fry the Halloumi until golden on each side. You could also BBQ these slices.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 4, 'description' => 'Remove from the heat.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 5, 'description' => 'Mix the salad dressing ingredients.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 6, 'description' => 'Place the spinach in a bowl, put the Halloumi cheese pieces on top of the spinach.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 7, 'description' => 'Sprinkle the blueberries over the salad.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 8, 'description' => 'Drizzle the dressing over the salad.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 9, 'description' => 'Sprinkle about ¼ teaspoon sumac over the salad (optional)', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Halloumi, Blueberry & Spinach Salad')->value('id'), 'step_number' => 10, 'description' => 'Eat immediately.', 'image_url' => ''));


        Recipe::create(array('id' => 14,'name' => 'Homemade Marble Pound Cake',
            'short_description' => 'A great, dense, made-from-scratch cake.',
            'long_description' => 'Homemade marble pound cake is a great, dense, made-from-scratch cake that’ll take care of both your chocolate and vanilla cravings all at once.',
            'serving_size' => 6,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Western%')->value('id'),
            'image_url' => 'Homemade-Marble-Pound-Cake.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/68V3RN8C/homemade-marble-pound-cake'));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'salted butter')->value('id'),'quantity' => '2','description' => 'softened','measurement_type_id' => MeasurementType::where('name', 'stick')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),'quantity' => '1.33','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'egg')->value('id'),'quantity' => '4','description' => 'large','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'vanilla')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'sour cream')->value('id'),'quantity' => '0.125','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'all-purpose flour')->value('id'),'quantity' => '1.75','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'baking soda')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 14,'ingredient_id' => Ingredient::where('name', 'powdered chocolate milk mix')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Homemade Marble Pound Cake')->value('id'), 'step_number' => 1, 'description' => 'Preheat oven to 350.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Homemade Marble Pound Cake')->value('id'), 'step_number' => 2, 'description' => 'Cream together the butter and sugar until light and fluffy, about five minutes. Slowly add in the flour, and mix to combine. Don\'t over-mix!', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Homemade Marble Pound Cake')->value('id'), 'step_number' => 3, 'description' => 'In a separate bowl, whisk together the eggs, vanilla, and sour cream. Slowly add into batter and mix just until combined. Remove 1/3 of the batter from the bowl, and put into a separate bowl. Mix in the chocolate milk mix until well combined.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Homemade Marble Pound Cake')->value('id'), 'step_number' => 4, 'description' => 'Place the vanilla batter into a tube pan that\'s been prepared with baking spray. Spread out evenly in the pan. Place spoonfuls of the chocolate batter all around the top of the vanilla batter. Use a butter knife to swirl the chocolate into the vanilla. Tap the pan several times on the counter to distribute batter and eliminate any gaps.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Homemade Marble Pound Cake')->value('id'), 'step_number' => 5, 'description' => 'Bake for about 30 minutes, or until a toothpick comes out with moist crumbs. Let cool in pan for 10 minutes, and then invert onto serving tray.', 'image_url' => ''));


        Recipe::create(array('id' => 15,'name' => 'Chocolate Blackberry Pudding',
            'short_description' => 'A rich chocolate blackberry pudding baked with coconut flour.',
            'long_description' => 'A rich chocolate blackberry pudding baked with coconut flour. This low carb and gluten free pudding is easy to make and only takes 30 minutes to bake. Served with cream or a sugar free berry coulis, it makes a delicious dessert.',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Western%')->value('id'),
            'image_url' => 'Chocolate-Blackberry-Pudding.jpg',
            'recipe_source' => 'http://www.foodista.com/recipe/SXRJV6HH/chocolate-blackberry-pudding'));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'butter')->value('id'),'quantity' => '0.5','description' => 'softened','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'erythritol')->value('id'),'quantity' => '0.5','description' => 'or sugar substitute','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'egg')->value('id'),'quantity' => '4','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'coconut flour')->value('id'),'quantity' => '0.25','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'cocoa powder')->value('id'),'quantity' => '0.25','description' => 'unsweetened','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'blackberries')->value('id'),'quantity' => '18','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'coconut milk')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '0.25','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 15,'ingredient_id' => Ingredient::where('name', 'baking powder')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 1, 'description' => 'Preheat the oven to 190C/385F degrees.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 2, 'description' => 'In a bowl cream the butter and erythritol together until smooth.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 3, 'description' => 'Add the eggs and beat thoroughly.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 4, 'description' => 'Add the coconut flour, cocoa powder, salt and baking powder. Mix well.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 5, 'description' => 'Add the coconut milk and combine until smooth.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 6, 'description' => 'Grease/butter a pudding dish (the one I used was 6 inches x 10 inches).', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 7, 'description' => 'Spoon the pudding mixture into the dish and smooth evenly.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 8, 'description' => 'Poke the blackberries into the pudding mixture, evenly.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 9, 'description' => 'Bake for 30 minutes until firm.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chocolate Blackberry Pudding')->value('id'), 'step_number' => 10, 'description' => 'Serve and enjoy!', 'image_url' => ''));


        Recipe::create(array('id' => 16,'name' => 'Eggs on Toast',
            'short_description' => 'A classic breakfast staple.',
            'long_description' => 'Boiled to perfection eggs on sourdough bread',
            'serving_size' => 1,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Western%')->value('id'),
            'image_url' => 'Eggs-on-Toast.jpg',
            'recipe_source' => ''));
        IngredientRecipeMapping::create(array('recipe_id' => 16,'ingredient_id' => Ingredient::where('name', 'egg')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 16,'ingredient_id' => Ingredient::where('name', 'sourdough bread')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Eggs on Toast')->value('id'), 'step_number' => 1, 'description' => 'Boil Eggs', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Eggs on Toast')->value('id'), 'step_number' => 2, 'description' => 'Toast Bread', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Eggs on Toast')->value('id'), 'step_number' => 3, 'description' => 'Serve.', 'image_url' => ''));


        Recipe::create(array('id' => 17,'name' => 'Arugula Pesto Pasta Salad',
            'short_description' => 'Bow tie pasta salad with arugula pesto',
            'long_description' => 'A light salad with bow tie pasta, arugula and a variety of cheese',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id'),
            'image_url' => 'graysonpesto.jpg',
            'recipe_source' => 'https://www.cookingwithnonna.com/italian-cuisine/arugula-pesto-pasta-salad.html'));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'arugula')->value('id'),'quantity' => '140','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'lemon')->value('id'),'quantity' => '1','description' => 'zested','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'pecorino cheese')->value('id'),'quantity' => '0.5','description' => 'grated','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'parmigiano cheese')->value('id'),'quantity' => '0.5','description' => 'grated','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),'quantity' => '3','description' => 'cloves','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'pignoli nuts')->value('id'),'quantity' => '0.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'farfalle pasta')->value('id'),'quantity' => '450','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'mozzarella')->value('id'),'quantity' => '230','description' => 'balls','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 17,'ingredient_id' => Ingredient::where('name', 'grape tomatoes')->value('id'),'quantity' => '230','description' => 'halved','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Arugula Pesto Pasta Salad')->value('id'), 'step_number' => 1, 'description' => 'Cook the pasta in salted boiling water until al dente. Drain and rinse with cold water. Set aside.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Arugula Pesto Pasta Salad')->value('id'), 'step_number' => 2, 'description' => 'In a food processor combine the first 6 ingredients and process until smooth.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Arugula Pesto Pasta Salad')->value('id'), 'step_number' => 3, 'description' => 'Combine the cooked pasta with the pesto, tomatoes and mozzarella. Serve chilled.', 'image_url' => ''));


        Recipe::create(array('id' => 18,'name' => 'Creamy Two-Mushroom Risotto',
            'short_description' => 'Without fail, the best Risotto we have ever created',
            'long_description' => 'This decadent mushroom risotto is fool-proof. The trick is to cook the mushrooms in a hot pan first, then bake them in the oven so that their flavour intensifies. Tearing the mushrooms rather than slicing them not only saves time but gives a lovely, rustic aesthetic, so theres not mushroom for error!',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id'),
            'image_url' => 'graysonpesto.jpg',
            'recipe_source' => 'https://www.gousto.co.uk/cookbook/vegetarian-recipes/creamy-two-mushroom-risotto'));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'arborio rice')->value('id'),'quantity' => '160','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'vegetable stock cube')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'chives')->value('id'),'quantity' => '10','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),'quantity' => '3','description' => 'cloves','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'clotted cream')->value('id'),'quantity' => '40','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'shaoxing wine')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'mature cheddar cheese')->value('id'),'quantity' => '40','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'mushrooms')->value('id'),'quantity' => '160','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'spring onion')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'portobello mushrooms')->value('id'),'quantity' => '150','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'butter')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 18,'ingredient_id' => Ingredient::where('name', 'vegetable oil')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 1, 'description' => 'Preheat the oven to 150°C/140°C (fan) /300°F/Gas 2. Boil a kettle. Trim and finely slice the spring onion[s] and chop the chives finely. Peel and finely chop (or grate) the garlic. Dissolve the vegetable stock cube[s] in 700ml [1.4L] boiled water.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 2, 'description' => 'Heat a large, wide-based pan (preferably non-stick) with a drizzle of vegetable oil over a high heat. Once hot, tear and crumble both the portobello and white mushrooms directly into the pan with a big pinch of salt. Cook over a high heat for 3-5 min or until starting to brown and caramelise.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 3, 'description' => 'Once caramelised, transfer the mushrooms to a baking tray (use tin foil to avoid mess!), put it in the oven until step 7 and reserve the pan. Return the pan to a medium heat and add the sliced spring onion and half of the chopped chives (keep the rest for garnish) with a knob of butter. Cook for a few sec or until softened.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 4, 'description' => 'Add the arborio rice and chopped garlic to the pan and cook for 30 sec, stirring to coat the grains in the butter. Add the Shaoxing wine and cook for a further 30 sec or until its evaporated.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 5, 'description' => 'Add 1/3 of the stock and stir continuously with a wooden spoon until it has absorbed. Continue to add the stock, a little at a time, stirring more or less continuously for 20-25 min, until all the stock is absorbed and the rice is cooked - this is your risotto.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 6, 'description' => 'Meanwhile, grate the cheddar cheese.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 7, 'description' => 'Once cooked, remove the risotto from the heat and stir in the grated cheese, clotted cream and half of the mushrooms (keep the other half for garnish). Tip: add a little more boiled water if your risotto is too clumpy - a risotto should have an almost porridge-like consistency. Season with pepper.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Creamy Two-Mushroom Risotto')->value('id'), 'step_number' => 8, 'description' => 'Serve the risotto in bowls and top with the remaining mushrooms, a sprinkle of the remaining chives and a good grind of pepper. Enjoy!', 'image_url' => ''));



        // Chops With Minted Peas and Wedges
        \App\Recipe::create(array('id' => 19, 'name' => 'Chops With Minted Peas and Wedges',
             'short_description' => 'Quick and easy lamb with wedges and peas',
             'long_description' => 'This quick mid week meal of lamb chops potato wedges and minted peas will warm you up and you\'ll be stunned at how easy it is to make.',
             'serving_size' => '4',
             'cuisine_type_id' => CuisineType::where('name', '=', 'Western')->value('id'),
             'image_url' => 'chops-peas-wedges.jpg',
            'recipe_source' => 'Thomas Farms Kitchen'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'potato')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '8', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'olive oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '4', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'salt')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => 'to taste'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'black pepper')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => 'to taste'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mint')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'bunch')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'lemon')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'garlic')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '2', 'description' => 'minced'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'lamb chops')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '600', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'peas')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '400', 'description' => ''));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'gram_total_fat' => '26.5', 'gram_saturated_fat' => '6.7', 'gram_total_carbohydrates' => '25.7', 'gram_sugars' => '5.6', 'gram_fiber' => '', 'mg_sodium' => '185', 'gram_protein' => '80.2', 'calories' => '683'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'step_number' => 1, 'description' => 'Preheat oven to 180C. Meanwhile prick potatoes all over with a fork and place in microwave on high for 4-5 minutes or until they are soft on the outside but firm in the middle. When cool enough to handle, cut into wedges.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'step_number' => 2, 'description' => 'Place the wedges on a baking tray, drizzle with half the oil and season with salt and pepper. Toss to coat evenly and bake for 15-20 minutes or until crispy.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'step_number' => 3, 'description' => 'While the potatoes are cooking, bring a saucepan of salted water to boil. Next strip the mint leaves from the stalks and roughly chop, grate or crush the garlic, finely grate lemon zest and juice the flesh.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'step_number' => 4, 'description' => 'Place a frypan on medium heat with a drizzle of oil. Add the lamb and cook for 2-3 minutes each side, or until browned and cooked to your liking.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Chops With Minted Peas and Wedges')->value('id'), 'step_number' => 5, 'description' => 'Cook peas in boiling water for 2 minutes and drain. Add mint, garlic, lemon zest and juice to the peas. Season with salt and pepper and mix well.', 'image_url' => ''));


        // Pork and Mushroom Alfredo
        \App\Recipe::create(array('id' => 20, 'name' => 'Pork and Mushroom Alfredo',
             'short_description' => 'Pork, mushroom and pasta in a creamy garlic sauce',
             'long_description' => 'Diced pork and mushrooms with fettuccini in a creamy, garlic and parmesan rich Alfredo sauce',
             'serving_size' => '4',
             'cuisine_type_id' => CuisineType::where('name', '=', 'Italian')->value('id'),
             'image_url' => 'pork-mushroom-alfredo.jpg',
            'recipe_source' => 'Thomas Farms Kitchen'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'fettuccine')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '400', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'salt')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => 'to taste'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'purple onion')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mushrooms')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '300', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'garlic')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => 'minced'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'pork')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '800', 'description' => 'diced into 3cm cubes'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'olive oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '3', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'milk')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'ml')->value('id'), 'quantity' => '400', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'parmesan cheese')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '100', 'description' => 'grated'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'black pepper')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => 'to taste'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'baby spinach')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '150', 'description' => ''));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'gram_total_fat' => '39', 'gram_saturated_fat' => '15.7', 'gram_total_carbohydrates' => '39.3', 'gram_sugars' => '11.5', 'gram_fiber' => '', 'mg_sodium' => '954', 'gram_protein' => '85.2', 'calories' => '872'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'step_number' => 1, 'description' => 'Three quarter fill a saucepan with water and bring to a boil on high heat. Add fettuccine and a pinch of salt and cook for 10 minutes or until al dente.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'step_number' => 2, 'description' => 'Meanwhile, thinly slice the onion, slice the mushrooms and finely grate the garlic.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'step_number' => 3, 'description' => 'Place a large frypan on high heat. Add oil and pork and cook for 2 minutes or until golden brown. Transfer pork to a plate.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'step_number' => 4, 'description' => 'Return frypan to heat and add onion, mushroom and garlic and cook for 2 minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'step_number' => 5, 'description' => 'Add milk, parmesan and pork back to the frypan. Reduce to low heat and simmer for 2 minutes to melt the cheese. Meanwhile, drain fettuccine in a colander.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pork and Mushroom Alfredo')->value('id'), 'step_number' => 6, 'description' => 'Add spinach to the pan to wilt. Fold the creamy sauce through the pasta and serve immediately.', 'image_url' => ''));


        // Montreal Steak with Walnut & Cranberry Couscous
        \App\Recipe::create(array('id' => 21, 'name' => 'Montreal Steak with Walnut & Cranberry Couscous',
             'short_description' => 'Delicious seasoned steak on a bed of tangy couscous',
             'long_description' => 'Steak seasoned with a Montreal spice mix on a bed of tangy walnut and cranberry couscous.',
             'serving_size' => '4',
             'cuisine_type_id' => CuisineType::where('name', '=', 'Western')->value('id'),
             'image_url' => 'montreal-steak.jpg',
            'recipe_source' => 'Thomas Farms Kitchen'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'couscous')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '200', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'cranberry')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '45', 'description' => 'dried'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'water')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '1', 'description' => 'boiling'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'grape tomatoes')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '100', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'walnut')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '45', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'parsley')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'bunch')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mint')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'bunch')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'lemon')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'rump steak')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '600', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'olive oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '3', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'pepper')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '2', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mustard seed')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => 'ground'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'dill seed')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '0.5', 'description' => 'ground'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'coriander seed')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '0.5', 'description' => 'ground'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'garlic powder')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'salt')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'chili flakes')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '0.5', 'description' => ''));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'gram_total_fat' => '29.4', 'gram_saturated_fat' => '4.6', 'gram_total_carbohydrates' => '47.1', 'gram_sugars' => '11.2', 'gram_fiber' => '', 'mg_sodium' => '107', 'gram_protein' => '44.8', 'calories' => '650'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'step_number' => 1, 'description' => 'Combine couscous, cranberries, and a pinch of salt in a heatproof bowl and then cover with boiling water to approximately a centimetre above the level of the couscous. Cover with a plate and set aside.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'step_number' => 2, 'description' => 'Meanwhile, halve the tomatoes, chop the walnuts and parsley, shred the mint, finely grate the lemon zest and juice the lemon.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'step_number' => 3, 'description' => 'Combine pepper, salt, mustard, dill, coriander, garlic powder and chilli flakes to form the Montreal spice mix. Season the steaks with approximately 3 teaspoons of spice mix or to taste, coat all sides.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'step_number' => 4, 'description' => 'Place a large frypan on medium-high heat. Add the steaks to the pan and cook 2-3 minutes on each side or until cooked to your liking. Transfer steaks on a plate covered in foil to rest.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'step_number' => 5, 'description' => 'Fluff the couscous with a fork and add tomatoes, walnuts, parsley, mint and lemon zest and season with salt, pepper and lemon juice to taste.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Montreal Steak with Walnut & Cranberry Couscous')->value('id'), 'step_number' => 6, 'description' => 'Slice steak and serve on a bed of the couscous.', 'image_url' => ''));


        // Salmon and Mozzarella Taco
        \App\Recipe::create(array('id' => 22, 'name' => 'Salmon and Mozzarella Taco',
             'short_description' => 'Succulent salmon with a fresh salad in a corn tortilla',
             'long_description' => 'Fish tacos have become all the rage in recent years and are a specialty of the Pacific coast of Southern California and Mexico.',
             'serving_size' => '4',
             'cuisine_type_id' => CuisineType::where('name', '=', 'Mexican')->value('id'),
             'image_url' => 'salmon-taco.jpg',
            'recipe_source' => 'Thomas Farms Kitchen'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'purple onion')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'chili pepper')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'grape tomatoes')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '150', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'cabbage')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '360', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'radish')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '3', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'spring onion')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '3', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'coriander')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'bunch')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'lemon')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'salmon')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '600', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'olive oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '6', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'dried oregano')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'smoked paprika')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'corn tortillas')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '8', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mozzarella')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '90', 'description' => ''));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'gram_total_fat' => '37.7', 'gram_saturated_fat' => '10.7', 'gram_total_carbohydrates' => '20.8', 'gram_sugars' => '13', 'gram_fiber' => '', 'mg_sodium' => '398', 'gram_protein' => '50.3', 'calories' => '645'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'step_number' => 1, 'description' => 'Preheat the oven to 180C.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'step_number' => 2, 'description' => 'Thinly slice onion, cabbage, radish, spring onion and chilli, halve the tomatoes, finely chop the coriander, grate the lemon zest and juice the lemon.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'step_number' => 3, 'description' => 'Place a large frypan on medium heat and add some oil, Add onion to pan and cook for 2 minutes or until softened. Add chilli and diced salmon and cook for 2 minutes, turning to sear all sides. Stir in tomatoes, oregano, and paprika. Season well with salt and pepper, then transfer to a plate.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'step_number' => 4, 'description' => 'Lay tortillas flat on a baking tray and sprinkle with cheese. Bake in the oven for 4 minutes or until cheese is melted. Divide salmon mixture between tortillas, fold in half and return to the oven for a further 2 minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'step_number' => 5, 'description' => 'While the tortillas bake combine cabbage, radish, spring onion, coriander, lemon zest, lemon juice and remaining oil in a mixing bowl, toss then season with salt and pepper.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Salmon and Mozzarella Taco')->value('id'), 'step_number' => 6, 'description' => 'Serve tacos with salad.', 'image_url' => ''));


        // Kung Pao Chicken
        \App\Recipe::create(array('id' => 23, 'name' => 'Honey Walnut Shrimp',
            'short_description' => 'Healthy homemade Chinese chicken in savory and spicy Kung Pao sauce',
            'long_description' => 'Kung Pao Chicken recipe is easy, authentic and delicious. The Kung Pao sauce is a bit spicy so feel free to cut down the quantity of dried chilies in the recipe. The secret ingredient of Kung Pao chicken is the Chinese vinegar in the sauce. You may use rice vinegar, red wine vinegar or apple cider vinegar for equally delicious result.',
            'serving_size' => '2',
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Chinese%')->value('id'),
            'image_url' => 'honeywalnutshrimpwalnutprawns.jpg',
            'recipe_source' => 'RasaMalaysia    '));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'prawn')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'lb')->value('id'), 'quantity' => '1', 'description' => 'peeled and deveined'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'walnut')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '1/2', 'description' => 'halves'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mayonnaise')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '3', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'honey')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '1/2', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'condensed milk')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '1/2', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'lemon juice')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'egg')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '1', 'description' => 'white'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'corn starch')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '1/2', 'description' => 'for coating the shrimp'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '', 'description' => 'for deep frying'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'sugar')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '1/2', 'description' => 'for Caramel Glaze'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'water')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '1/2', 'description' => 'for Caramel Glaze'));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'gram_total_fat' => '37.7', 'gram_saturated_fat' => '10.7', 'gram_total_carbohydrates' => '20.8', 'gram_sugars' => '13', 'gram_fiber' => '', 'mg_sodium' => '398', 'gram_protein' => '50.3', 'calories' => '645'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'step_number' => 1, 'description' => 'Add the egg white to the shrimp, stir to combine well. Rinse the walnut halves with water, drain and set aside.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'step_number' => 2, 'description' => 'In a bowl, stir together the mayonnaise, honey, condensed milk and lemon juice. Mix well and set aside.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'step_number' => 3, 'description' => 'Prepare the Caramel Glaze by heating up 1/2 cup of water until it boils. Add in the sugar and keep stirring until it turns golden color. Add the walnut halves into the caramel. Lower the heat for another 1-2 minutes, then remove the walnuts and place them on a piece of parchment paper to dry. Make sure the walnuts are not sticking together. (DO NOT use regular paper towels as the walnut halves will stick to the paper.)', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Honey Walnut Shrimp')->value('id'), 'step_number' => 4, 'description' => 'Heat up the oil in a pan or wok. Once the oil is heated, coat the shrimp with the corn starch generously. Shake off the excess corn starch before frying the shrimp. When the shrimp is cooked, remove them from the oil and drain on paper towels. Add the shrimp and toss well with the mayonnaise sauce. Transfer the honey walnut shrimp to a serving platter and top the shrimp with the candied walnuts and serve immediately.', 'image_url' => ''));

        // Fried Rice
        \App\Recipe::create(array('id' => 24, 'name' => 'Fried Rice',
            'short_description' => 'Healthy homemade Chinese chicken in savory and spicy Kung Pao sauce',
            'long_description' => 'Kung Pao Chicken recipe is easy, authentic and delicious. The Kung Pao sauce is a bit spicy so feel free to cut down the quantity of dried chilies in the recipe. The secret ingredient of Kung Pao chicken is the Chinese vinegar in the sauce. You may use rice vinegar, red wine vinegar or apple cider vinegar for equally delicious result.',
            'serving_size' => '2',
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Chinese%')->value('id'),
            'image_url' => 'friedrice2-1.jpg',
            'recipe_source' => 'RasaMalaysia'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'garlic')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '2', 'description' => 'cloves minced'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'chicken breast')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '120', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'prawn')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '120', 'description' => 'peeled, shelled and deveined'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'mixed vegetables')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '1', 'description' => 'frozen thawed'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'rice')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '340', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'fish sauce')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'egg')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '2', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'soy sauce')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '2', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '2', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'oyster sauce')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'teaspoon')->value('id'), 'quantity' => '1/4', 'description' => 'for Caramel Glaze'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'white pepper')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'cup')->value('id'), 'quantity' => '3', 'description' => 'dashes'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'salt')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '', 'description' => 'to taste'));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'gram_total_fat' => '37.7', 'gram_saturated_fat' => '10.7', 'gram_total_carbohydrates' => '20.8', 'gram_sugars' => '13', 'gram_fiber' => '', 'mg_sodium' => '398', 'gram_protein' => '50.3', 'calories' => '645'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'step_number' => 1, 'description' => 'Heat up a wok or pan with two tablespoons of oil. Add the garlic and stir fry until aromatic, follow by chicken, shrimp, and mixed vegetables. Stir fry until the chicken and shrimp are half cooked. Add in the rice and stir well with the ingredients. Add the fish sauce, soy sauce, oyster sauce, white pepper and continue to stir the fried rice for a couple of minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Fried Rice')->value('id'), 'step_number' => 2, 'description' => 'Using the spatula, push the rice to the side of the wok and make a “well” in the middle of the fried rice. Pour the beaten eggs in the “well.” Wait for 30 seconds and then cover the eggs with the fried rice. Leave it for 30 seconds to 1 minute and continue to stir-fry so the eggs form into small pieces and mix well with the fried rice. Add in salt to taste and do some quick stirs, dish out and serve hot.', 'image_url' => ''));


        Recipe::create(array('id' => 25,'name' => 'German Onion Tart',
            'short_description' => 'Onion tart is served in the southern part of Germany at wine festivals.',
            'long_description' => 'Onion tart (zwiebelkuchen) is served in the southern part of Germany at wine festivals. To achieve the perfect flavour use smoked speck, rather than bacon.',
            'serving_size' => 4,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%German%')->value('id'),
            'image_url' => 'german_onion_tart.jpg',
            'recipe_source' => 'http://www.sbs.com.au/food/recipes/german-onion-tart-zwiebelkuchen'));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'butter')->value('id'),'quantity' => '80','description' => 'cold diced','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'plain flour')->value('id'),'quantity' => '175','description' => '','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'water')->value('id'),'quantity' => '40','description' => 'iced','measurement_type_id' => MeasurementType::where('name', 'ml')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '1','description' => 'half tsp for pastry, half tsp for filling','measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'onion')->value('id'),'quantity' => '350','description' => 'or 2 medium onions','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'speck')->value('id'),'quantity' => '70','description' => 'smoked, rind removed, cut into 5mm dice','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'cheese')->value('id'),'quantity' => '40','description' => 'such as Gruyere, grated','measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'milk')->value('id'),'quantity' => '100','description' => '','measurement_type_id' => MeasurementType::where('name', 'ml')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'cream')->value('id'),'quantity' => '100','description' => '','measurement_type_id' => MeasurementType::where('name', 'ml')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'egg')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', '')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'flour')->value('id'),'quantity' => '1.5','description' => '','measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'white pepper')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', 'pinch')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'nutmeg')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', 'pinch')->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => 25,'ingredient_id' => Ingredient::where('name', 'paprika')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', 'pinch')->value('id')));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 1, 'description' => 'To make the dough, combine butter and flour in a bowl. Use your hands to rub in the butter and lard into the flour until it resembles fine breadcrumbs.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 2, 'description' => 'Add water and salt, quickly knead until smooth.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 3, 'description' => 'Roll out dough on a lightly floured bench.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 4, 'description' => 'Grease a 24 cm round tart tin. Ease the pastry into the tin so it comes up the sides and press into corners. Trim pastry to top of tin and set aside in the fridge for 30 minutes.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 5, 'description' => 'To make the filling, preheat the oven to 190ºC.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 6, 'description' => 'Cut onions in half and then in 3 mm slices.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 7, 'description' => 'Fry the smoked speck in a non-stick pan over medium heat until lightly browned.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 8, 'description' => 'Add onions, reduce heat to low and fry until softened and fragrant.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 9, 'description' => 'Remove speck and onions from the pan and set aside to cool. Add cheese and mix well.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 10, 'description' => 'Pour the onion and speck mixture onto the pastry.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 11, 'description' => 'Combine milk, cream, egg and flour in a bowl. Stir with a whisk to combine, then add salt, white pepper, nutmeg and paprika.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'German Onion Tart')->value('id'), 'step_number' => 12, 'description' => 'Pour milk mixture over the onions and speck and bake for 40 minutes, or until cooked through.', 'image_url' => ''));

        // Crab Rangoon
        \App\Recipe::create(array('id' => 26, 'name' => 'Crab Rangoon',
            'short_description' => 'crab rangoon recipe with cream cheese and wonton wrapper',
            'long_description' => 'Crab Rangoon is an appetizer found in many Chinese restaurants in the United States. A classic American creation, crab rangoon is basically cream cheese wontons with tiny bits of crab meat, deep-fried to golden perfection.',
            'serving_size' => '20',
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Chinese%')->value('id'),
            'image_url' => 'crab_rangoon1.jpg',
            'recipe_source' => 'RasaMalaysia'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'cream cheese')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '230', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'crab')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'gram')->value('id'), 'quantity' => '60', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'sugar')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', 'tablespoon')->value('id'), 'quantity' => '1', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'wonton wrappers')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '20', 'description' => ''));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'oil')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '', 'description' => 'for deep frying'));
        \App\IngredientRecipeMapping::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'ingredient_id' => Ingredient::where('name', '=', 'salt')->value('id'), 'measurement_type_id' => MeasurementType::where('name', '=', '')->value('id'), 'quantity' => '', 'description' => 'pinch'));
        \App\NutritionalInfoPanel::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'gram_total_fat' => '37.7', 'gram_saturated_fat' => '10.7', 'gram_total_carbohydrates' => '20.8', 'gram_sugars' => '13', 'gram_fiber' => '', 'mg_sodium' => '398', 'gram_protein' => '50.3', 'calories' => '645'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'step_number' => 1, 'description' => 'Mix all the cream cheese, crab meat, sugar, and salt in a bowl. Stir to blend well. Place about 1 tablespoon of the cream cheese filling in the middle of a wonton wrapper. Dab some water on the outer edges of the wonton wrapper and fold the two ends of the wrapper together. Fold the other two ends to make a tiny parcel pictured below.  Pinch to seal tight and make sure that there is no leakage.', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Crab Rangoon')->value('id'), 'step_number' => 2, 'description' => 'Heat up a pot of oil for deep-frying and fry the crab rangoon until golden brown. Dish out with a strainer or slotted spoon, draining the excess oil by laying the crab rangoon on a dish lined with paper towels. Let the crab rangoon cools down a bit before serving them with sweet and sour sauce.', 'image_url' => ''));

        //Pulled Chicken Teriyaki Donburi Bowl
        /*Recipe::create(array('id' => 27,'name' => 'Pulled Chicken Teriyaki Donburi Bowl',
           'short_description' => 'Tasty Japanese Rich Bowl',
            'long_description' => 'Donburi is a Japanese rice bowl dish, where rice is topped with a variety of meats, fish and vegetables. We have kept it classic and topped ours with delicious pulled Chicken Teriyaki. You will pickle the ginger and radishes, to cut through the sweet and intense flavour of the teriyaki, which creates a perfectly balanced bowl. Chopsticks at the ready!',
            'serving_size' => 2,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Japanese%')->value('id'),
           'image_url' => '',
            'recipe_source' => 'https://www.gousto.co.uk/cookbook/chicken-recipes/pulled-chicken-teriyaki-donburi-bowl’));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'chicken thigh fillets')->value('id'),'quantity' => '4','description' => '','measurement_type_id' => MeasurementType::where('name', ‘’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'basmati rice')->value('id'),'quantity' => '150','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'carrot')->value('id'),'quantity' => '100','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'garlic')->value('id'),'quantity' => '1','description' => 'clove','measurement_type_id' => MeasurementType::where('name', ‘’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'mirin rice wine')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', ‘tbsp’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'soy sauce')->value('id'),'quantity' => '24','description' => '','measurement_type_id' => MeasurementType::where('name', ‘ml’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'spring onion')->value('id'),'quantity' => '1','description' => '','measurement_type_id' => MeasurementType::where('name', ‘’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'ginger')->value('id'),'quantity' => '15','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'radish')->value('id'),'quantity' => '150','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'sesame seeds')->value('id'),'quantity' => '10','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'honey')->value('id'),'quantity' => '28','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'red wine vinegar')->value('id'),'quantity' => '2','description' => '','measurement_type_id' => MeasurementType::where('name', ‘tbsp’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'mange tout')->value('id'),'quantity' => '80','description' => '','measurement_type_id' => MeasurementType::where('name', ‘gram’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', ‘’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', ‘’)->value(‘id’)));
        \App\IngredientRecipeMapping::create(array('recipe_id' => 27,'ingredient_id' => Ingredient::where('name', 'vegetable oil')->value('id'),'quantity' => '','description' => '','measurement_type_id' => MeasurementType::where('name', ‘’)->value(‘id’)));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 1, 'description' => 'Boil a kettle; Add the basmati rice, 350ml [700ml] cold water and a generous pinch of salt to a pot with a lid and bring to the boil over a high heat; Once boiling, reduce the heat to very low and cook, covered, for 10-15 min or until all the water has absorbed and the rice is cooked; Once cooked, remove from the heat and keep covered until serving;', 'image_url' => ‘'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 2, 'description' => 'Meanwhile, peel the ginger (scrape the skin off with a teaspoon) and chop into thin matchsticks; Slice the radishes as finely as you can!;
        ', 'image_url' => ‘'));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 3, 'description' => 'Combine 1 tbsp [2 tbsp] sugar with 100ml [200ml] boiled water in a heatproof bowl and stir until the sugar has dissolved; Add the red wine vinegar, ginger matchsticks and sliced radishes and set aside until serving - these are your pickled vegetables;
        ', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 4, 'description' => 'Meanwhile, heat a large, wide-based pan (preferably non-stick) with a matching lid, with a drizzle of vegetable oil over a medium-high heat; Once hot, add the chicken thigh fillets and season them with a pinch of salt; Cook for 3-4 min or until lightly browned on both sides; Meanwhile, peel and finely chop (or grate) the garlic;
        ', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 5, 'description' => 'Once the chicken has browned, reduce the heat to medium and add the chopped garlic, soy sauce, mirin, honey and 2 tbsp [4 tbsp] boiled water; Cook, covered, for 8-10 min or until the chicken is cooked through and the sauce is thick and sticky;
        ', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 6, 'description' => 'Meanwhile, top, tail, peel and grate the carrot[s]; Trim, then slice the spring onion[s] finely; Slice the mange tout in half lengthways; Add the sliced mange tout to a large bowl, cover with boiled water and set aside to cook;
        ', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'Pulled Chicken Teriyaki Donburi Bowl')->value('id'), 'step_number' => 7, 'description' => 'Once done, shred the chicken apart in the pan, using two forks - this technique is known as ‘pulling’; Once pulled, mix the chicken into the pan juices - this is your chicken teriyaki; Drain the pickled vegetables through a sieve; Drain the mange tout; Serve the chicken teriyaki over the cooked rice, with the grated carrot, pickled vegetables and mange tout to the side; Sprinkle the toasted sesame seeds over the chicken teriyaki and garnish with the chopped spring onion; Enjoy!;
        ', 'image_url' => ''));
        */


        // Three Vegetable Miso & Sesame Ramen ----> Beware smart quotes when adding
        /*
          Recipe::create(array('id' => 28,'name' => 'Three Vegetable Miso & Sesame Ramen',
            'short_description' => 'INSERT',
            'long_description' => 'INSERT',
            'serving_size' => XX,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Japanese%')->value('id'),
            'image_url' => 'INSERT',
            'recipe_source' => 'https://www.gousto.co.uk/cookbook/vegetarian-recipes/three-vegetable-miso-sesame-ramen'));

        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));

        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
         */


        // Miso-Glazed Aubergine With Noodles ----> Beware smart quotes when adding
        /*
          Recipe::create(array('id' => 29,'name' => 'Miso-Glazed Aubergine With Noodles',
            'short_description' => 'Yummy Japanese Noodles',
            'long_description' => 'Japanese flavours are often deep, salty, sweet and hot but always balanced. This dish elevates aubergine to the next level. Once scored, its spongy surface absorbs the miso marinade and turns it into a glaze when baked.',
            'serving_size' => XX,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Japanese%')->value('id'),
            'image_url' => 'INSERT',
            'recipe_source' => 'https://www.gousto.co.uk/cookbook/vegetarian-recipes/miso-glazed-aubergine-with-noodles'));

        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));

        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
         */

        // Nutty Peanut & Vegetable Noodles ----> Beware smart quotes when adding
        /*
          Recipe::create(array('id' => 30,'name' => 'Nutty Peanut & Vegetable Noodles',
            'short_description' => 'Tasty noodles',
            'long_description' => 'A healthy yet tasty dish with colourful vegetables and silky noodles: crunchy, nutty and a little bit spicy – a simple, satisfying number for your weekday noodle fix.',
            'serving_size' => XX,
            'cuisine_type_id' => CuisineType::where('name', 'like', '%Japanese%')->value('id'),
            'image_url' => 'INSERT',
            'recipe_source' => 'https://www.gousto.co.uk/cookbook/vegetarian-recipes/nutty-peanut-vegetable-noodles'));

        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));
        IngredientRecipeMapping::create(array('recipe_id' => XX,'ingredient_id' => Ingredient::where('name', 'INSERT')->value('id'),'quantity' => 'INSERT','description' => 'INSERT','measurement_type_id' => MeasurementType::where('name', ‘INSERT’)->value('id')));

        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
        \App\RecipeMethod::create(array('recipe_id' => Recipe::where('name', '=', 'TITLE')->value('id'), 'step_number' => XX, 'description' => 'INSERT', 'image_url' => ''));
         */


    }
}
