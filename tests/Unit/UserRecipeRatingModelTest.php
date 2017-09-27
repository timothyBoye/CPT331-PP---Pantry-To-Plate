<?php

namespace Tests\Unit;

use App\Recipe;
use App\User;
use App\UserRecipeRating;
use App\UserRole;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRecipeRatingModelTest extends BaseTestCase
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
        Recipe::create(
            array(
                'id' => 1,
                'name' => 'Lettuce Salad',
                'short_description' => 'A salad with three ingredients. A good number for testing...',
                'long_description' => 'This brilliant salad is actually quite average.',
                'method' => 'Roughly chop lettuce;Slice onion;Dice cheese',
                'serving_size' => 2,
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
            )
        );
        DB::table('user_recipe_ratings')->insert([
            ['recipe_id' => 1, 'user_id' => 1, 'rating' => 5 ],
            ['recipe_id' => 2, 'user_id' => 1, 'rating' => 3 ],
            ['recipe_id' => 1, 'user_id' => 2, 'rating' => 3 ],
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testUserRelationship()
    {
        $rating = UserRecipeRating::find(1);
        $this->assertTrue($rating->user->name == 'Abigail');
        $this->assertTrue($rating->rating == 5);
    }

    public function testRecipeRelationship()
    {
        $rating = UserRecipeRating::find(1);
        $this->assertTrue($rating->recipe->name == 'Lettuce Salad');
        $this->assertTrue($rating->rating == 5);
    }
}
