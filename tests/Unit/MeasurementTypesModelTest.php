<?php

namespace Tests\Unit;

use App\Ingredient;
use App\MeasurementType;
use App\Recipe;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class MeasurementTypesModelTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        parent::setUp();
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
        Recipe::create(
            array(
                'name' => 'Lettuce Salad',
                'short_description' => 'A salad with three ingredients. A good number for testing...',
                'long_description' => 'This brilliant salad is actually quite average.',
                'method' => 'Roughly chop lettuce;Slice onion;Dice cheese',
                'serving_size' => 2,
            )
        );
        Recipe::create(
            array(
                'name' => 'Another recipe',
                'short_description' => 'A salad with three ingredients. A good number for testing...',
                'long_description' => 'This brilliant salad is actually quite average.',
                'method' => 'Roughly chop lettuce;Slice onion;Dice cheese',
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
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testIngredientsRelationship()
    {
        $cup = MeasurementType::where('name', '=', 'cup')->first();
        $this->assertTrue($cup->ingredients->count() == 2);
        $this->assertTrue($cup->ingredients[0]->description == 'roughly chopped');
    }
}
