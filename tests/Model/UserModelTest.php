<?php

namespace Tests\Unit;
// http://blog.mauriziobonani.com/laravel-sql-memory-database-for-unit-tests/
use App\Recipe;
use App\UserRole;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;
use App\User;

class UserModelTest extends BaseTestCase
{
    /**
     * test user to user role relationship
     */
    public function testUserRoleRelationship()
    {
        $user = User::find(1);
        $this->assertTrue($user->role->user_role_name == 'Generic');
        $user = User::find(2);
        $this->assertTrue($user->role->user_role_name == 'Admin');
    }


    /**
     * test user to saved recipes relationship
     */
    public function testUsersSavedRecipes()
    {
        $user = User::find(1);
        $this->assertTrue($user->savedRecipes->count() == 2);
    }


    /**
     * test user to user ratings relationship
     */
    public function testRatingsRelationship()
    {
        $abigail = User::find(1);
        $john = User::find(2);
        $this->assertTrue($abigail->ratings->count() == 2);
        $this->assertTrue($abigail->ratings[0]->rating == 5);
        $this->assertTrue($john->ratings->count() == 1);
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
        DB::table('recipe_user_mappings')->insert([
            ['recipe_id' => 1, 'user_id' => 1],
            ['recipe_id' => 2, 'user_id' => 1],
            ['recipe_id' => 2, 'user_id' => 2],
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
