<?php

namespace Tests\Unit;

use App\CuisineType;
use App\Ingredient;
use App\IngredientCategory;
use App\IngredientRecipeMapping;
use App\MeasurementType;
use App\Recipe;
use App\User;
use App\UserRole;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class RecipeModelTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        UserRole::create(
            array(
                'user_role_name' => 'Generic'
            )
        );
        UserRole::create(
            array(
                'user_role_name' => 'Admin'
            )
        );
        User::create(
            array(
                'name' => 'Abigail',
                'email' => 'test@email.com',
                'password' => 'x',
                'user_role_id' => 1
            )
        );
        User::create(
            array(
                'name' => 'John',
                'email' => 'test2@email.com',
                'password' => 'xyz',
                'user_role_id' => 2
            )
        );
        DB::table('ingredient_categories')->insert([
            ['name' => 'Fruit'], //1
            ['name' => 'Vegetable'], //2
            ['name' => 'Dairy'], //3
        ]);
        DB::table('ingredients')->insert([
            ['name' => 'romaine lettuce', 'ingredient_category_id'=> 2],
            ['name' => 'black olives', 'ingredient_category_id'=> 1],
            ['name' => 'grape tomatoes', 'ingredient_category_id'=> 2],
            ['name' => 'pepper', 'ingredient_category_id' => 2],
            ['name' => 'purple onion', 'ingredient_category_id' => 1],
            ['name' => 'beans', 'ingredient_category_id' => 2],
            ['name' => 'bell peppers', 'ingredient_category_id' => 2],
            ['name' => 'apple', 'ingredient_category_id' => 1]
        ]);
        $cuisine_types = array(
            'German', 'French', 'Italian', 'Spanish', 'American', 'Mediterranean','Mexican','Chinese','Japanese','Indian','Thai'
        );

        foreach($cuisine_types as $type){
            CuisineType::create(array(
                'name' => $type
            ));
        }

        Recipe::create(
            array(
                'id' => 1,
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
                'id' => 2,
                'name' => 'Easy Pizza Sauce',
                'short_description' => 'Quick and easy pizza sauce.',
                'long_description' => 'This easy pizza sauce recipe gets cooked right on your stove top, and takes about 10 minutes from start to finish. You’ll love how delicious this is. MUCH better than anything you’ll find in a can.',
                'method' => 'Heat the olive oil over medium heat, and saute the garlic for 2 minutes.;Add the rest of the ingredients, stir, and simmer for 10-15 minutes.',
                'serving_size' => 4,
                'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id')
            )
        );
        Recipe::create(
            array(
                'id' => 3,
                'name' => 'Spaghetti Bolognese',
                'short_description' => 'Bolognese, like mama used to make!',
                'long_description' => 'Our best-ever spaghetti Bolognese is super easy and a true classic. An Italian pasta favourite with a meaty, chilli sauce, this ultimate recipe comes courtesy of BBC Good Food user, Andrew Balmer.',
                'method' => 'Put a large saucepan on a medium heat and add 1 tbsp olive oil. Add the bacon and fry for 10 mins until golden and crisp.;Reduce the heat and add the onion, carrot, celery, garlic and rosemary, then fry for 10 mins. Stir the veg often until it softens.;Increase the heat to medium-high, add the mince and cook stirring for 3-4 mins until the meat is browned all over.;Add the tinned tomatoes, chopped basil, oregano, bay leaves, tomato purée, stock cube, chilli, wine and cherry tomatoes. Stir with a wooden spoon, breaking up the plum tomatoes.;Bring to the boil, reduce to a gentle simmer and cover with a lid. Cook for 1 hr 15 mins stirring occasionally, until you have a rich, thick sauce. Add the Parmesan, check the seasoning and stir.;When the Bolognese is nearly finished cook the spaghetti following pack instructions. Drain the spaghetti and stir into the Bolognese sauce. Serve with grated Parmesan, the extra basil leaves and crusty bread.',
                'serving_size' => 6,
                'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id')
            )
        );
        $measures = array(
            array('name' => '', 'comparable_size' => 100), // Currently used when there is no measure i.e. 1 onion
            array('name' => 'cup', 'comparable_size' => 240)
        );
        foreach ($measures as $measure) {
            MeasurementType::create(
                array('name' => $measure['name'],
                    'comparable_size' => $measure['comparable_size'])
            );
        }
        DB::table('ingredient_recipe_mappings')->insert([
            ['recipe_id' => 1,
                'ingredient_id' => Ingredient::where('name', '=', 'romaine lettuce')->value('id'),
                'quantity' => 1,
                'description' => 'roughly chopped',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')],
            ['recipe_id' => 2,
                'ingredient_id' => Ingredient::where('name', '=', 'romaine lettuce')->value('id'),
                'quantity' => 1,
                'description' => 'roughly chopped',
                'measurement_type_id' => MeasurementType::where('name', '')->value('id')],
            ['recipe_id' => 1,
                'ingredient_id' => Ingredient::where('name', '=', 'black olives')->value('id'),
                'quantity' => 0.250,
                'description' => 'roughly chopped',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')],
            ['recipe_id' => 1,
                'ingredient_id' => Ingredient::where('name', '=', 'purple onion')->value('id'),
                'quantity' => 0.250,
                'description' => 'roughly chopped',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')],
        ]);
        DB::table('user_recipe_ratings')->insert([
            ['recipe_id' => 1, 'user_id' => 1, 'rating' => 5 ],
            ['recipe_id' => 2, 'user_id' => 1, 'rating' => 3 ],
            ['recipe_id' => 1, 'user_id' => 2, 'rating' => 3 ],
            ['recipe_id' => 2, 'user_id' => 2, 'rating' => 3 ],
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testIngredientsRelationship()
    {
        $lettuceSalad = Recipe::find(1);
        $this->assertTrue($lettuceSalad->ingredients->count() == 3);
        $this->assertTrue($lettuceSalad->ingredients[0]->description == 'roughly chopped');
    }

    public function testCuisineTypeRelationship()
    {
        $lettuceSalad = Recipe::find(1);
        $this->assertTrue($lettuceSalad->cuisine_type->name == 'Mediterranean');
    }

    public function testRatingsRelationship()
    {
        $lettuceSalad = Recipe::find(1);
        $pizza = Recipe::find(2);
        $spag = Recipe::find(3);

        $this->assertTrue($lettuceSalad->ratings->count() == 2);
        $this->assertTrue($pizza->ratings->count() == 2);
        $this->assertTrue($spag->ratings->count() == 0);
        $this->assertTrue($pizza->ratings[1]->rating == 3);

    }

}
