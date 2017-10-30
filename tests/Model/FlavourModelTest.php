<?php

namespace Tests\Unit;

use App\CuisineType;
use App\Flavour;
use App\Recipe;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class FlavourModelTest extends BaseTestCase
{

    /**
     * Test the Flavour model to recipes relationships
     */
    public function testRecipesRelationship()
    {
        $savoury = Flavour::where('name', '=', 'savoury')->first();
        $spicy = Flavour::where('name', '=', 'spicy')->first();
        $sweet = Flavour::where('name', '=', 'sweet')->first();

        $this->assertTrue($savoury->recipes->count() == 2);
        $this->assertTrue($spicy->recipes->count() == 1);
        $this->assertTrue($sweet->recipes->count() == 0);

        $this->assertTrue($savoury->recipes[0]->flavour_intensity == 10);
        $this->assertTrue($savoury->recipes[1]->recipe->name == 'Easy Pizza Sauce');
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
