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
        Recipe::create(
            array(
                'id' => 8,
                'name' => 'Chorizo Breakfast Tacos with Potato Hash and Eggs',
                'short_description' => 'The perfect meal anytime of day!',
                'long_description' => 'Chorizo Breakfast Tacos with Potato Hash and Eggs are ridiculously flavorful, quick and easy. The perfect meal anytime of day!',
                'method' => 'In a large nonstick frying pan over medium high heat, add the oil and heat until shimmering. Add the potatoes, onion, garlic powder and onion powder to one side of the pan. Salt and pepper, if needed. Add the chorizo sausage to the other side and sauté until cooked through, breaking up with the back of a spoon, about 5 minutes. Turn over the potatoes after a couple of minutes so they get brown on both sides.;In a medium bowl, combine the eggs, milk, 1 tablespoon of cilantro and season with a little salt and pepper. Reduce the heat of the frying pan to medium low and add the egg mixture. Stir the eggs until they are very softly set, about 3 minutes. Remove the pan from the heat.;To assemble the tacos, take the heated tortillas and divide the egg, chorizo and potato mixture among them. Sprinkle with remaining cilantro, and then add the cheese and salsa on top.',
                'serving_size' => 6
            )
        );
        Recipe::create(
            array(
                'id' => 9,
                'name' => 'Kidney Bean Salad',
                'short_description' => 'An easy, healthy salad or side dish',
                'long_description' => 'Kidney bean salad recipe is an easy, healthy salad or side dish. This salad is delicious and makes a great lunch. This salad is gestational diabetes friendly as well. This salad is perfect for hot weather. So try this tasty kidney bean salad.',
                'method' => 'Start off with draining and rinsing the kidney beans, then toss them in a bowl or tupperware.;Mix in your diced bell peppers, onion, and parsley.;Drizzle the olive oil and mix well.;Add desired amount of lemon. I love lemon so I will use two or more lemons.;Salt to taste.',
                'serving_size' => 6
            )
        );
        Recipe::create(
            array(
                'id' => 10,
                'name' => 'Roasted Parmesan Broccoli',
                'short_description' => 'This is a yummy, easy veggie dish.',
                'long_description' => 'Roasted Parmesan Broccoli - Roasted with olive oil & Parmesan cheese, and finished with lemon zest. Super simple & healthy, this is a yummy, easy veggie dish.',
                'method' => 'Preheat the oven to 425 degrees.;Add sliced broccoli to a parchment paper-lined baking sheet.;Sprinkle with salt, pepper, red pepper flakes, and olive oil, then toss gently.;Roast for 10 minutes, add the sliced garlic to the pan, and return to the oven.;Bake 6 more minutes, then sprinkle with parmesan and bake for 2 more minutes.;Remove from the oven, dust with lemon zest and enjoy!',
                'serving_size' => 8
            )
        );
        Recipe::create(
            array(
                'id' => 11,
                'name' => 'Smoky Paprika Chicken',
                'short_description' => 'An easy, healthy salad or side dish',
                'long_description' => 'This quick and flavor-filled smoky paprika chicken seared with bell peppers makes a perfect 30-minute dinner!',
                'method' => 'Cut the chicken into small bite-sized pieces and place them in the mixing bowl. Add olive oil, paprika, salt and pepper and stir everything together.;Preheat a large non-stick griddle to medium-high heat. Add half of the chicken and fry it until well browned for about 4-5 minutes. At this point, the chicken doesn\'t need to be cooked through as it will be cooked with bell peppers in a later step. Transfer the chicken into a bowl, and fry the rest of the chicken.;Once the second batch of chicken is browned, remove the chicken from the pan.;To the same hot pan, with the oil leftover from the chicken, add the bell peppers. Saute the bell pepper until the char marks start appearing and then add the chicken, with the juices, on top. Place the lid on the pan.;Cook it for several minutes until the chicken is cooked fully. Then, remove the lid and keep cooking until the liquid is almost evaporated.;Sprinkle the chicken with some chopped parsley.',
                'serving_size' => 4
            )
        );
        Recipe::create(
            array(
                'id' => 12,
                'name' => 'Cumin Orange Cashew Salad',
                'short_description' => 'So delicious!',
                'long_description' => 'This Cumin Orange Cashew Salad only requires four ingredients and 10 minutes to make. So delicious!',
                'method' => 'Cut or tear the mixed greens into small pieces. Put them in a bowl and set aside.;Peel the oranges and cut them into small bite size pieces. Roast them with cumin, salt and pepper on a dry frying pan over medium heat. No oil is required as the oranges contain enough juice to prevent them from sticking to the pan. Cook the oranges for about five minutes.;Take the oranges off the pan and add them to your bowl of greens. Roast the cashew nuts on the same pan for 3-5 minutes or until they are slightly golden.;Take the cashew nuts off the heat and mix them with the oranges and greens. Serve immediately.;This salad doesn\'t keep well even if kept in the fridge.',
                'serving_size' => 2
            )
        );
        Recipe::create(
            array(
                'id' => 13,
                'name' => 'Halloumi, Blueberry & Spinach Salad',
                'short_description' => 'Bright colours and rich tastes combine for a hearty dish.',
                'long_description' => 'A vibrant Halloumi, blueberry and spinach salad that is a contrast of textures and flavours. Bright colours and rich tastes combine for a hearty dish.',
                'method' => 'Cut the Halloumi cheese into slices or even cubes.;Heat the olive oil in either a frying pan or a griddle pan.;Gently fry the Halloumi until golden on each side. You could also BBQ these slices.;Remove from the heat.;Mix the salad dressing ingredients.;Place the spinach in a bowl, put the Halloumi cheese pieces on top of the spinach.;Sprinkle the blueberries over the salad.;Drizzle the dressing over the salad.;Sprinkle about ¼ teaspoon sumac over the salad (optional);Eat immediately.',
                'serving_size' => 2
            )
        );
        Recipe::create(
            array(
                'id' => 14,
                'name' => 'Homemade Marble Pound Cake',
                'short_description' => 'A great, dense, made-from-scratch cake.',
                'long_description' => 'Homemade marble pound cake is a great, dense, made-from-scratch cake that’ll take care of both your chocolate and vanilla cravings all at once.',
                'method' => 'Preheat oven to 350.;Cream together the butter and sugar until light and fluffy, about five minutes. Slowly add in the flour, and mix to combine. Don\'t over-mix!;In a separate bowl, whisk together the eggs, vanilla, and sour cream. Slowly add into batter and mix just until combined. Remove 1/3 of the batter from the bowl, and put into a separate bowl. Mix in the chocolate milk mix until well combined.;Place the vanilla batter into a tube pan that\'s been prepared with baking spray. Spread out evenly in the pan. Place spoonfuls of the chocolate batter all around the top of the vanilla batter. Use a butter knife to swirl the chocolate into the vanilla. Tap the pan several times on the counter to distribute batter and eliminate any gaps.;Bake for about 30 minutes, or until a toothpick comes out with moist crumbs. Let cool in pan for 10 minutes, and then invert onto serving tray.',
                'serving_size' => 6
            )
        );
        Recipe::create(
            array(
                'id' => 15,
                'name' => 'Chocolate Blackberry Pudding',
                'short_description' => 'A rich chocolate blackberry pudding baked with coconut flour.',
                'long_description' => 'A rich chocolate blackberry pudding baked with coconut flour. This low carb and gluten free pudding is easy to make and only takes 30 minutes to bake. Served with cream or a sugar free berry coulis, it makes a delicious dessert.',
                'method' => 'Preheat the oven to 190C/385F degrees.;In a bowl cream the butter and erythritol together until smooth.;Add the eggs and beat thoroughly.;Add the coconut flour, cocoa powder, salt and baking powder. Mix well.;Add the coconut milk and combine until smooth.;Grease/butter a pudding dish (the one I used was 6 inches x 10 inches).;Spoon the pudding mixture into the dish and smooth evenly.;Poke the blackberries into the pudding mixture, evenly.;Bake for 30 minutes until firm.;Serve and enjoy!',
                'serving_size' => 4
            )
        );

        //Glenn attempt to create recipe here
        Recipe::create(
            array(
                'id' => 16,
                'name' => 'Eggs on Toast',
                'short_description' => 'A classic breakfast staple.',
                'long_description' => 'A rich chocolate blackberry pudding baked with coconut flour. This low carb and gluten free pudding is easy to make and only takes 30 minutes to bake. Served with cream or a sugar free berry coulis, it makes a delicious dessert.',
                'method' => 'Boil Eggs;Toast Bread;Serve.',
                'serving_size' => 1
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
                'quantity' => '1',
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
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'vegetable oil')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'potatoes')->value('id'),
                'quantity' => '2',
                'description' => 'baked, then chopped',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'onion')->value('id'),
                'quantity' => '0.5',
                'description' => 'chopped',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'garlic powder')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'onion powder')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'pork chorizo sausage')->value('id'),
                'quantity' => '7',
                'description' => 'fresh, casings removed if needed',
                'measurement_type_id' => MeasurementType::where('name', 'ounce')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'eggs')->value('id'),
                'quantity' => '5',
                'description' => 'large',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'milk')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'cilantro')->value('id'),
                'quantity' => '3',
                'description' => 'fresh, finely chopped, divided',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'corn tortillas')->value('id'),
                'quantity' => '6',
                'description' => 'small',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'cheddar cheese')->value('id'),
                'quantity' => '0.5',
                'description' => 'shredded',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 8,
                'ingredient_id' => Ingredient::where('name', 'hot sauce')->value('id'),
                'quantity' => '',
                'description' => 'or salsa',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'kidney beans')->value('id'),
                'quantity' => '3',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'can')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'red pepper')->value('id'),
                'quantity' => '1',
                'description' => 'diced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'yellow pepper')->value('id'),
                'quantity' => '1',
                'description' => 'diced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'red onion')->value('id'),
                'quantity' => '0.5',
                'description' => 'diced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'parsley')->value('id'),
                'quantity' => '1',
                'description' => 'small, chopped',
                'measurement_type_id' => MeasurementType::where('name', 'bunch')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'lemons')->value('id'),
                'quantity' => '2',
                'description' => 'juiced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 9,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '',
                'description' => 'to taste',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'broccoli')->value('id'),
                'quantity' => '1',
                'description' => 'large, sliced into 1 inch thick steaks',
                'measurement_type_id' => MeasurementType::where('name', 'head')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'garlic cloves')->value('id'),
                'quantity' => '4',
                'description' => 'thinly sliced',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'chili flakes')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'parmesan cheese')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'lemon zest')->value('id'),
                'quantity' => '',
                'description' => 'from half a lemon',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 10,
                'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),
                'quantity' => '3',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 11,
                'ingredient_id' => Ingredient::where('name', 'chicken thighs')->value('id'),
                'quantity' => '1',
                'description' => 'boneless',
                'measurement_type_id' => MeasurementType::where('name', 'lb')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 11,
                'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 11,
                'ingredient_id' => Ingredient::where('name', 'smoked paprika')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 11,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 11,
                'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 11,
                'ingredient_id' => Ingredient::where('name', 'bell peppers')->value('id'),
                'quantity' => '2',
                'description' => 'large, chopped into medium pieces',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 12,
                'ingredient_id' => Ingredient::where('name', 'mixed greens')->value('id'),
                'quantity' => '3',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 12,
                'ingredient_id' => Ingredient::where('name', 'oranges')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 12,
                'ingredient_id' => Ingredient::where('name', 'cashew nuts')->value('id'),
                'quantity' => '0.33',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 12,
                'ingredient_id' => Ingredient::where('name', 'cumin')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 12,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 12,
                'ingredient_id' => Ingredient::where('name', 'pepper')->value('id'),
                'quantity' => '',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'Halloumi cheese')->value('id'),
                'quantity' => '250',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'blueberries')->value('id'),
                'quantity' => '100',
                'description' => 'fresh',
                'measurement_type_id' => MeasurementType::where('name', 'gram')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'spinach')->value('id'),
                'quantity' => '1',
                'description' => 'fresh',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'olive oil')->value('id'),
                'quantity' => '2',
                'description' => 'one for frying, one for dressing',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'lime juice')->value('id'),
                'quantity' => '',
                'description' => 'from half a lime',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'balsamic vinegar')->value('id'),
                'quantity' => '1',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '0.25',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'black pepper')->value('id'),
                'quantity' => '0.25',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 13,
                'ingredient_id' => Ingredient::where('name', 'sumac')->value('id'),
                'quantity' => '0.25',
                'description' => 'for garnish, optional',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'salted butter')->value('id'),
                'quantity' => '2',
                'description' => 'softened',
                'measurement_type_id' => MeasurementType::where('name', 'stick')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'sugar')->value('id'),
                'quantity' => '1.33',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'eggs')->value('id'),
                'quantity' => '4',
                'description' => 'large',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'vanilla')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'sour cream')->value('id'),
                'quantity' => '0.125',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'all-purpose flour')->value('id'),
                'quantity' => '1.75',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
    IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'baking soda')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 14,
                'ingredient_id' => Ingredient::where('name', 'powdered chocolate milk mix')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'butter')->value('id'),
                'quantity' => '0.5',
                'description' => 'softened',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'Erythritol')->value('id'),
                'quantity' => '0.5',
                'description' => 'or sugar substitute',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'eggs')->value('id'),
                'quantity' => '4',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'coconut flour')->value('id'),
                'quantity' => '0.25',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'cocoa powder')->value('id'),
                'quantity' => '0.25',
                'description' => 'unsweetened',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'blackberries')->value('id'),
                'quantity' => '18',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'coconut milk')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'tablespoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'salt')->value('id'),
                'quantity' => '0.25',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 15,
                'ingredient_id' => Ingredient::where('name', 'baking powder')->value('id'),
                'quantity' => '0.5',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', 'teaspoon')->value('id')
            )
        );
        //Glenn attempt at putting in a recipe

        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 16,
                'ingredient_id' => Ingredient::where('name', 'egg')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );
        IngredientRecipeMapping::create(
            array(
                'recipe_id' => 16,
                'ingredient_id' => Ingredient::where('name', 'sourdough bread')->value('id'),
                'quantity' => '2',
                'description' => '',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')
            )
        );

    }
}
