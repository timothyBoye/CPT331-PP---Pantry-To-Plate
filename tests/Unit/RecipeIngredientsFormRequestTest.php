<?php

namespace Tests\Unit;

use App\Http\Requests\RecipeIngredientsFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class RecipeIngredientsFormRequestTest extends BaseTestCase
{
    /**
     * Test authorisation function
     */
    public function testRecipeIngredientsFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new RecipeIngredientsFormRequest();
        $request->setContainer($this->app);
        $attributes = ['ingredient_quantities.0' => 122,
            'ingredient_measures.0' => 1,
            'ingredient_names.0' => 1,
            'ingredient_descriptions.0' => 'ghrthrthr'];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }

    /**
     * Tests the validation rules() function for the RecipeIngredientsFormRequest is correct
     */
    public function testRecipeIngredientsFormRequestRules()
    {
        // add some data to db for uniqueness rules etc
        DB::table('measurement_types')->insert([
            ['id' => 1, 'name' => 'cup', 'comparable_size'=> 2],
            ['id' => 2, 'name' => 'teaspoon', 'comparable_size'=> 1],
            ['id' => 3, 'name' => 'gram', 'comparable_size'=> 2],
        ]);
        DB::table('ingredient_categories')->insert([
            ['id' => 1, 'name' => 'Fruit'], //1
            ['id' => 2, 'name' => 'Vegetable'], //2
        ]);
        DB::table('ingredients')->insert([
            ['id' => 1, 'name' => 'romaine lettuce', 'ingredient_category_id'=> 2],
            ['id' => 2, 'name' => 'olives', 'ingredient_category_id'=> 1],
            ['id' => 3, 'name' => 'pepper', 'ingredient_category_id' => 2],

        ]);

        // simple valid data
        $attributes = ['ingredient_quantities.0' => 122,
            'ingredient_measures.0' => 1,
            'ingredient_names.0' => 1,
            'ingredient_descriptions.0' => 'ghrthrthr'];
        $request = new RecipeIngredientsFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // multiple valid data inputs
        $attributes = ['ingredient_quantities.0' => 122,
            'ingredient_measures.0' => 1,
            'ingredient_names.0' => 1,
            'ingredient_descriptions.0' => 'ghrthrthr',
            'ingredient_quantities.1' => 12.5,
            'ingredient_measures.1' => 2,
            'ingredient_names.1' => 2,
            'ingredient_descriptions.1' => '',
            'ingredient_quantities.2' => 12.5,
            'ingredient_measures.2' => 3,
            'ingredient_names.2' => 3,
            'ingredient_descriptions.2' => '',];
        $request = new RecipeIngredientsFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // invalid table data
        $attributes = ['ingredient_quantities.0' => 122,
            'ingredient_measures.0' => 50,
            'ingredient_names.0' => 50,
            'ingredient_descriptions.0' => 'ghrthrthr'];
        $request = new RecipeIngredientsFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);
    }
}
