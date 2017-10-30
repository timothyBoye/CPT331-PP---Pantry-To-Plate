<?php

namespace Tests\Unit;

use App\Http\Requests\AdminCuisinesFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class AdminCuisinesFormRequestTest extends BaseTestCase
{
    /**
     * Test authorisation function
     */
    public function testAdminCuisineFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new AdminCuisinesFormRequest();
        $request->setContainer($this->app);
        $attributes = ['name' => 'abcde'];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }

    /**
     * Tests the validation rules() function for the AdminCuisinesFormRequest is correct
     */
    public function testAdminCuisineFormRequestRules()
    {
        // Add some cuisines to the database to test uniqueness rules
        DB::table('cuisine_types')->insert([
            ['id' => 1, 'name' => 'French'],
        ]);

        // simple valid data
        $attributes = ['name' => 'abcde'];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // simple invalid data
        $attributes = ['name' => '12345'];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // longer valid data using accented characters
        $attributes = ['name' => 'æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż'];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // valid max length string
        $attributes = ['name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ'];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // invalid over max length string
        $attributes = ['name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQx'];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid cuisine exists
        $attributes = ['name' => 'French'];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid no name
        $attributes = [];
        $request = new AdminCuisinesFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);
    }
}
