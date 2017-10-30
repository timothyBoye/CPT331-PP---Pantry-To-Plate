<?php

namespace Tests\Unit;

use App\Http\Requests\AdminRecipeFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;



class AdminRecipeFormRequestTest extends BaseTestCase
{

    /**
     * Test authorisation function
     */
    public function testAdminRecipeFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new AdminRecipeFormRequest();
        $request->setContainer($this->app);
        $attributes = ['name' => 'abcde', 'recipe_source' => 'abcde',
            'short_description' => 'abcde', 'long_description' => 'abcde',
            'serving_size' => 1, 'cuisine_type_id' => 1];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }


    /**
     * Tests the validation rules() function for the AdminRecipeFormRequest is correct
     */
    public function testAdminRecipeFormRequestRules()
    {
        // add some data to db for uniqueness rules etc
        DB::table('cuisine_types')->insert([['id' => 1, 'name' => 'French']]);
        DB::table('recipes')->insert([
            ['name' => 'creme brulee', 'recipe_source' => 'nowhere',
                'short_description' => 'abcde', 'long_description' => 'abcde',
                'serving_size' => 1, 'cuisine_type_id' => 1],
        ]);

        // simple valid data
        $attributes = ['name' => 'abcde', 'recipe_source' => 'abcde',
        'short_description' => 'abcde', 'long_description' => 'abcde',
            'serving_size' => 1, 'cuisine_type_id' => 1];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // max length valid data
        $attributes = ['name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'recipe_source' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'short_description' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'long_description' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'serving_size' => 1, 'cuisine_type_id' => 1];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // max length+1 invalid data
        $attributes = ['name' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'recipe_source' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'short_description' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'long_description' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'serving_size' => 1, 'cuisine_type_id' => 1];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid characters
        $attributes = ['name' => '123',
            'recipe_source' => '123',
            'short_description' => '123',
            'long_description' => '123',
            'serving_size' => 'abc', 'cuisine_type_id' => 1];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid cuisine doesn't exist
        $attributes = ['name' => 'abc',
            'recipe_source' => 'abc',
            'short_description' => 'abx',
            'long_description' => 'abc',
            'serving_size' => 12, 'cuisine_type_id' => 2];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);


        // invalid missing data
        $attributes = [];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // valid all data
        $attributes = ['name' => 'abc',
            'recipe_source' => 'abc',
            'short_description' => 'abx',
            'long_description' => 'abc',
            'serving_size' => 12, 'cuisine_type_id' => 1,
            'calories' => 12,
            'mg_sodium' => 1,
            'gram_total_fat' => 1.5,
            'gram_saturated_fat' => 1.5,
            'gram_fibre' => 1.5,
            'gram_total_carbohydrates' => 1.5,
            'gram_sugar' => 1.5,
            'gram_protein' => 1.5,
        ];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // invalid nutritional data
        $attributes = ['name' => 'abc',
            'recipe_source' => 'abc',
            'short_description' => 'abx',
            'long_description' => 'abc',
            'serving_size' => 12, 'cuisine_type_id' => 1,
            'calories' => 12.5,
            'mg_sodium' => 1.7,
            'gram_total_fat' => 1,
            'gram_saturated_fat' => 1,
            'gram_fibre' => 1,
            'gram_total_carbohydrates' => 1,
            'gram_sugar' => 1,
            'gram_protein' => 1,
        ];
        $request = new AdminRecipeFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);
    }
}
