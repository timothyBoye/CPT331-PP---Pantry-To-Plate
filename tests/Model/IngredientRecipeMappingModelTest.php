<?php

namespace Tests\Unit;

use App\Ingredient;
use App\IngredientCategory;
use App\IngredientRecipeMapping;
use App\MeasurementType;
use App\Recipe;
use Illuminate\Support\Facades\DB;
use Tests\BaseTestCase;

class IngredientRecipeMappingModelTest extends BaseTestCase
{

    /**
     * Test the ingredient recipe mapping to recipes relationship
     */
    public function testRecipeRelationship()
    {
        $lettuce = Ingredient::where('name', '=', 'romaine lettuce')->value('id');
        $lettuceMapped = IngredientRecipeMapping::where('ingredient_id', '=', $lettuce)->get();
        $this->assertTrue($lettuceMapped->count() == 2);
        $this->assertTrue($lettuceMapped[0]->recipe->name == 'Lettuce Salad');
    }


    /**
     * Test the ingredient recipe mapping to ingredient relationship
     */
    public function testIngredientRelationship()
    {
        $lettuce = Ingredient::where('name', '=', 'romaine lettuce')->value('id');
        $lettuceMapped = IngredientRecipeMapping::where('ingredient_id', '=', $lettuce)->get();
        $this->assertTrue($lettuceMapped->count() == 2);
        $this->assertTrue($lettuceMapped[0]->ingredient->name == 'romaine lettuce');
    }


    /**
     * Test the ingredient recipe mapping to measurement type relationship
     */
    public function testMeasureRelationship()
    {
        $lettuce = Ingredient::where('name', '=', 'black olives')->value('id');
        $lettuceMapped = IngredientRecipeMapping::where('ingredient_id', '=', $lettuce)->get();
        $this->assertTrue($lettuceMapped->count() == 1);
        $this->assertTrue($lettuceMapped[0]->measure->name == 'cup');

        $lettuce = Ingredient::where('name', '=', 'romaine lettuce')->value('id');
        $lettuceMapped = IngredientRecipeMapping::where('ingredient_id', '=', $lettuce)->get();
        $this->assertTrue($lettuceMapped[0]->measure->name == '');
    }

    /**
     * Test plural ingredient_name()
     */
    public function testPluralNames()
    {
        $onion = Ingredient::where('name', '=', 'purple onion')->first();
        $onion->plural = 'purple onions';
        $onion->save();
        $lettuce = Ingredient::where('name', '=', 'romaine lettuce')->first();
        $onionmapping = IngredientRecipeMapping::where(['recipe_id' => 1, 'ingredient_id' => $onion->id])->first();
        $lettucemapping = IngredientRecipeMapping::where(['recipe_id' => 1, 'ingredient_id' => $lettuce->id])->first();

        $this->assertTrue($onionmapping->ingredient_name() == 'purple onions');
        $this->assertTrue($lettucemapping->ingredient_name() == 'romaine lettuce');
    }


    /**
     * Test plural get_matching_recipe_names()
     */
    public function testGetMatchingRecipeNames()
    {
        $names = ['lettuce', 'onion'];
        $ids = IngredientRecipeMapping::get_matching_recipe_names($names);
        $this->assertTrue(count($ids) == 2);
        $this->assertTrue($ids == [1,4]);
    }


    /**
     * Test plural get_matching_recipe_ids()
     */
    public function testGetMatchingRecipeIDs()
    {
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids([1,4], -1, -1, -1);
        $this->assertTrue($recipe_ids == [1,2,1]);
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids([1], -1, -1, -1);
        $this->assertTrue($recipe_ids == [1,2]);
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids([1], 1, -1, -1);
        $this->assertTrue($recipe_ids == [1]);
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids([1], 1, 5, -1);
        $this->assertTrue($recipe_ids == []);
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids([1,4], -1, -1, 3);
        $this->assertTrue($recipe_ids == [1,1]);
    }


    public function setUp()
    {
        parent::setUp();
        DB::table('ingredient_categories')->insert([
            ['id' => 1, 'name' => 'Fruit'], //1
            ['id' => 2, 'name' => 'Vegetable'], //2
            ['id' => 3, 'name' => 'Dairy'], //3
        ]);
        DB::table('ingredients')->insert([
            ['id' => 1, 'name' => 'romaine lettuce', 'ingredient_category_id'=> 2],
            ['id' => 2, 'name' => 'black olives', 'ingredient_category_id'=> 1],
            ['id' => 3, 'name' => 'pepper', 'ingredient_category_id' => 2],
            ['id' => 4, 'name' => 'purple onion', 'ingredient_category_id' => 1]
        ]);
        Recipe::create(
            array(
                'id' => 1,
                'name' => 'Lettuce Salad',
                'short_description' => 'A salad with three ingredients. A good number for testing...',
                'long_description' => 'This brilliant salad is actually quite average.',
                'serving_size' => 2,
                'cuisine_type_id' => 1
            )
        );
        Recipe::create(
            array(
                'id' => 2,
                'name' => 'Another recipe',
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
                'quantity' => 2,
                'description' => 'roughly chopped',
                'measurement_type_id' => MeasurementType::where('name', 'cup')->value('id')],
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
