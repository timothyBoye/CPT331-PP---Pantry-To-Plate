<?php

namespace Tests\Unit;

use App\CuisineType;
use App\Flavour;
use App\Recipe;
use App\RecipeFlavourMapping;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class RecipeFlavourMappingModelTest extends BaseTestCase
{
    /**
     * Test recipe flavour mapping to recipe relationship
     */
    public function testRecipeRelationship()
    {
        $savouryPizza = RecipeFlavourMapping::where(['recipe_id' => 3, 'flavour_id' => 5])->first();
        $this->assertTrue($savouryPizza->recipe->name == 'Easy Pizza Sauce');
    }


    /**
     * Test recipe flavour mapping to flavour relationship
     */
    public function testFlavourRelationship()
    {
        $savouryPizza = RecipeFlavourMapping::where(['recipe_id' => 3, 'flavour_id' => 5])->first();
        $this->assertTrue($savouryPizza->flavour->name == 'savoury');
    }


    public function setUp()
    {
        parent::setUp();

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

        $flavours = [
            'sweet', 'spicy', 'bitter', 'sour', 'savoury'
        ];
        foreach($flavours as $flavour) {
            Flavour::create(array('name' => $flavour));
        }

        DB::table('recipe_flavour_mappings')->insert([
            ['recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'flavour_id' => Flavour::where('name', '=', 'spicy')->value('id'), 'flavour_intensity' => '3'],
            ['recipe_id' => Recipe::where('name', '=', 'Spaghetti Bolognese')->value('id'), 'flavour_id' => Flavour::where('name', '=', 'savoury')->value('id'), 'flavour_intensity' => '10'],
            ['recipe_id' => Recipe::where('name', '=', 'Easy Pizza Sauce')->value('id'), 'flavour_id' => Flavour::where('name', '=', 'savoury')->value('id'), 'flavour_intensity' => '3']
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
