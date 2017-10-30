<?php

namespace Tests\Unit;

use App\Http\Requests\RecipeIngredientsFormRequest;
use App\Recipe;
use App\User;
use App\UserRecipeRating;
use App\UserRole;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class UserRecipeRatingModelTest extends BaseTestCase
{
    /**
     * Test user recipe rating to user relationship
     */
    public function testUserRelationship()
    {
        $rating = UserRecipeRating::find(1);
        $this->assertTrue($rating->user->name == 'Abigail');
        $this->assertTrue($rating->rating == 5);
    }


    /**
     * Test user recipe rating to recipe relationship
     */
    public function testRecipeRelationship()
    {
        $rating = UserRecipeRating::find(1);
        $this->assertTrue($rating->recipe->name == 'Lettuce Salad');
        $this->assertTrue($rating->rating == 5);
    }

    /**
     * Test user recipe ratings get_ratings_for_user function
     */
    public function testGetRatingsForUser()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $recipe1 = Recipe::find(1);
        $recipe2 = Recipe::find(2);
        $rating = UserRecipeRating::get_ratings_for_user([$recipe1,$recipe2]);
        $this->assertEquals(5, $rating[0]->rating);
        $this->assertEquals(3, $rating[1]->rating);
    }



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
                'serving_size' => 2,
            )
        );
        Recipe::create(
            array(
                'id' => 2,
                'name' => 'Easy Pizza Sauce',
                'short_description' => 'Quick and easy pizza sauce.',
                'long_description' => 'This easy pizza sauce recipe gets cooked right on your stove top, and takes about 10 minutes from start to finish. You’ll love how delicious this is. MUCH better than anything you’ll find in a can.',
                'serving_size' => 4,
            )
        );
        Recipe::create(
            array(
                'id' => 3,
                'name' => 'Spaghetti Bolognese',
                'short_description' => 'Bolognese, like mama used to make!',
                'long_description' => 'Our best-ever spaghetti Bolognese is super easy and a true classic. An Italian pasta favourite with a meaty, chilli sauce, this ultimate recipe comes courtesy of BBC Good Food user, Andrew Balmer.',
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

}
