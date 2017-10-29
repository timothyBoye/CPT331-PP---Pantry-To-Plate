<?php

namespace Tests\Unit;

use App\CuisineType;
use App\Recipe;
use Tests\BaseTestCase;

class CuisineTypeModelTest extends BaseTestCase
{
    /**
     * Test the cuisine model to recipes relationships
     */
    public function testRecipesConnection()
    {
        $cuisine = CuisineType::where('name', '=', 'Italian')->first();
        $this->assertTrue($cuisine->recipes->count() == 2);
        $this->assertTrue($cuisine->recipes[0]->name == 'Spaghetti Bolognese');
        $this->assertTrue($cuisine->recipes[1]->name == 'Easy Pizza Sauce');

        $cuisine = CuisineType::where('name', '=', 'Mediterranean')->first();
        $this->assertTrue($cuisine->recipes->count() == 1);
        $this->assertTrue($cuisine->recipes[0]->name == 'Lettuce Salad');
    }


    public function setUp()
    {
        parent::setUp();
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
                'name' => 'Spaghetti Bolognese',
                'short_description' => 'Bolognese, like mama used to make!',
                'long_description' => 'Our best-ever spaghetti Bolognese is super easy and a true classic. An Italian pasta favourite with a meaty, chilli sauce, this ultimate recipe comes courtesy of BBC Good Food user, Andrew Balmer.',
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
                'serving_size' => 4,
                'cuisine_type_id' => CuisineType::where('name', 'like', '%Italian%')->value('id')
            )
        );
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
