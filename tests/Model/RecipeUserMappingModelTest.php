<?php

namespace Tests\Unit;

use App\Recipe;
use App\RecipeUserMapping;
use App\User;
use App\UserRole;
use Tests\BaseTestCase;

class RecipeUserMappingModelTest extends BaseTestCase
{
    /**
     * Test recipe user mapping to user relationship
     */
    public function testUserRelationship()
    {
        $lettuceAbigail = RecipeUserMapping::where(['recipe_id' => 1, 'user_id' => 1])->first();
        $this->assertTrue($lettuceAbigail->user->name == 'Abigail');
    }


    /**
     * Test recipe user mapping to recipe relationship
     */
    public function testRecipeRelationship()
    {
        $pizzaJohn = RecipeUserMapping::where(['recipe_id' => 2, 'user_id' => 2])->first();
        $this->assertTrue($pizzaJohn->recipe->name == 'Easy Pizza Sauce');
    }


    public function setUp()
    {
        parent::setUp();
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
        UserRole::create(
            array(
                'id' => 1,
                'user_role_name' => 'Generic'
            )
        );
        UserRole::create(
            array(
                'id' => 2,
                'user_role_name' => 'Admin'
            )
        );
        User::create(
            array(
                'id' => 1,
                'name' => 'Abigail',
                'email' => 'test@email.com',
                'password' => 'x',
                'user_role_id' => 1
            )
        );
        User::create(
            array(
                'id' => 2,
                'name' => 'John',
                'email' => 'test2@email.com',
                'password' => 'xyz',
                'user_role_id' => 2
            )
        );
        RecipeUserMapping::create(
            array(
                'recipe_id' => 1,
                'user_id' => 1
            )
        );
        RecipeUserMapping::create(
            array(
                'recipe_id' => 2,
                'user_id' => 1
            )
        );
        RecipeUserMapping::create(
            array(
                'recipe_id' => 2,
                'user_id' => 2
            )
        );
    }

    public function tearDown()
    {
        parent::tearDown();
    }


}
