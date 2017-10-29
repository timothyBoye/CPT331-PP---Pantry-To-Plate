<?php

namespace Tests\Unit;

use App\Http\Requests\AdminMeasurementFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class AdminMeasurementFormRequestTest extends BaseTestCase
{
    /**
     * Test authorisation function
     */
    public function testAdminIngredientFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new AdminMeasurementFormRequest();
        $request->setContainer($this->app);
        $attributes = ['name' => 'abcde', 'comparable_size' => 1];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }


    /**
     * Tests the validation rules() function for the AdminMeasurementFormRequest is correct
     */
    public function testAdminMeasurementFormRequestRules()
    {
        // add some data to db for uniqueness rules etc
        DB::table('measurement_types')->insert([
            ['id' => 1, 'name' => 'cup', 'comparable_size'=> 2],
            ['id' => 2, 'name' => 'teaspoon', 'comparable_size'=> 1],
            ['id' => 3, 'name' => 'gram', 'comparable_size'=> 2],
        ]);

        // simple valid data
        $attributes = ['name' => 'abcde', 'comparable_size' => 100];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // simple invalid data
        $attributes = ['name' => '12345', 'comparable_size' => 100];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // longer valid data using accented characters
        $attributes = ['name' => 'æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż', 'comparable_size' => 100];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // valid max length string
        $attributes = ['name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ', 'comparable_size' => 100];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // invalid over max length string
        $attributes = ['name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQx', 'comparable_size' => 100];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid already exists
        $attributes = ['name' => 'cup', 'comparable_size' => 100];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid size
        $attributes = ['name' => 'cup', 'comparable_size' => 'abc'];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid size
        $attributes = ['name' => 'cup', 'comparable_size' => 12.2];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid missing data
        $attributes = [];
        $request = new AdminMeasurementFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);
    }

}
