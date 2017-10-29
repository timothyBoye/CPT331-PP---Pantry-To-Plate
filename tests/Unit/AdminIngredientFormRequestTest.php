<?php

namespace Tests\Unit;

use App\Http\Requests\AdminIngredientFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class AdminIngredientFormRequestTest extends BaseTestCase
{
    /**
     * Test authorisation function
     */
    public function testAdminIngredientFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new AdminIngredientFormRequest();
        $request->setContainer($this->app);
        $attributes = ['name' => 'abcde', 'ingredient_category_id' => 1];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }


    /**
     * Tests the validation rules() function for the AdminIngredientFormRequest is correct
     */
    public function testAdminIngredientFormRequestRules()
    {
        // add some ingredients and categories to db for uniqueness rules etc
        DB::table('ingredient_categories')->insert([
            ['id' => 1, 'name' => 'Fruit'], //1
            ['id' => 2, 'name' => 'Vegetable'], //2
            ['id' => 3, 'name' => 'Dairy'], //3
        ]);
        DB::table('ingredients')->insert([
            ['id' => 1, 'name' => 'romaine lettuce', 'ingredient_category_id'=> 2, 'ingredient_image_url' => 'romaine-lettuce.jpg'],
            ['id' => 2, 'name' => 'olives', 'ingredient_category_id'=> 1, 'ingredient_image_url' => 'olives.jpg'],
            ['id' => 3, 'name' => 'tomatoes', 'ingredient_category_id'=> 2, 'ingredient_image_url' => 'tomatoes.jpg'],
        ]);

        // simple valid data
        $attributes = [
            'name' => 'abcde',
            'ingredient_category_id' => 1,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // simple invalid data
        $attributes = [
            'name' => '123abcde',
            'ingredient_category_id' => 1,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // complex accented valid data
        $attributes = [
            'name' => 'æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż',
            'ingredient_category_id' => 1,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);


        // valid max length name
        $attributes = [
            'name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'ingredient_category_id' => 1,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // invalid max length +1 name
        $attributes = [
            'name' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'ingredient_category_id' => 1,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid name taken
        $attributes = [
            'name' => 'tomatoes',
            'ingredient_category_id' => 1,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid category doesn't exist
        $attributes = [
            'name' => 'tomatoes',
            'ingredient_category_id' => 4,
        ];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid missing required data
        $attributes = [];
        $request = new AdminIngredientFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);
    }
}
