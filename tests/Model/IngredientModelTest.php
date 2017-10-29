<?php

namespace Tests\Unit;

use App\Ingredient;
use App\IngredientCategory;
use App\MeasurementType;
use App\Recipe;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class IngredientModelTest extends BaseTestCase
{

    /**
     * Test the ingredient to recipes relationship
     */
    public function testRecipesRelationship()
    {
        $lettuce = Ingredient::where('name', '=', 'romaine lettuce')->first();
        $beans = Ingredient::where('name', '=', 'beans')->first();

        $this->assertTrue($lettuce->recipes->count() == 1);
        $this->assertTrue($beans->recipes->count() == 0);
    }


    /**
     * Test the ingredient to category relationship
     */
    public function testCategoriesRelationship()
    {
        $lettuce = Ingredient::where('name', '=', 'romaine lettuce')->first();
        $beans = Ingredient::where('name', '=', 'beans')->first();

        $this->assertTrue($lettuce->category->name == 'Vegetable');
        $this->assertTrue($beans->category->name == 'Vegetable');
    }


    /**
     * Test the ingredient image name function
     */
    public function testImageName()
    {
        $ingredient = Ingredient::where('name', '=', 'black olives')->first();
        $this->assertTrue($ingredient->image_name() == 'default.jpg');

        $ingredient->ingredient_image_url = 'test.jpg';
        $ingredient->save();
        $this->assertTrue($ingredient->image_name() == 'test.jpg');
    }


    public function setUp()
    {
        parent::setUp();
        DB::table('ingredient_categories')->insert([
            ['name' => 'Fruit'], //1
            ['name' => 'Vegetable'], //2
            ['name' => 'Dairy'], //3
        ]);
        DB::table('ingredients')->insert([
            ['name' => 'romaine lettuce', 'ingredient_category_id'=> 2, 'ingredient_image_url' => ''],
            ['name' => 'black olives', 'ingredient_category_id'=> 1, 'ingredient_image_url' => ''],
            ['name' => 'grape tomatoes', 'ingredient_category_id'=> 2, 'ingredient_image_url' => ''],
            ['name' => 'pepper', 'ingredient_category_id' => 2, 'ingredient_image_url' => ''],
            ['name' => 'purple onion', 'ingredient_category_id' => 1, 'ingredient_image_url' => ''],
            ['name' => 'beans', 'ingredient_category_id' => 2, 'ingredient_image_url' => ''],
            ['name' => 'bell peppers', 'ingredient_category_id' => 2, 'ingredient_image_url' => ''],
            ['name' => 'apple', 'ingredient_category_id' => 1, 'ingredient_image_url' => '']
        ]);
        Recipe::create(
            array(
                'name' => 'Lettuce Salad',
                'short_description' => 'A salad with three ingredients. A good number for testing...',
                'long_description' => 'This brilliant salad is actually quite average.',
                'serving_size' => 2,
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
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
