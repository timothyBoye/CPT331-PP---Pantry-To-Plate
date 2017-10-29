<?php

namespace Tests\Unit;

use App\Http\Requests\ContactFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class ContactFormRequestTest extends BaseTestCase
{

    /**
     * Test authorisation function
     */
    public function testContactFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new ContactFormRequest();
        $request->setContainer($this->app);
        $attributes = ['name' => 'abc',
            'email' => 'abc@test.com',
            'message' => 'required message'];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }

    /**
     * Tests the validation rules() function for the ContactFormRequest is correct
     */
    public function testContactFormRequestRules()
    {
        // simple valid data
        $attributes = ['name' => 'abc',
            'email' => 'abc@test.com',
            'message' => 'required message'];
        $request = new ContactFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // mac length valid data
        $attributes = ['name' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'email' => 'abc@test.com',
            'message' => 'lOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ'];
        $request = new ContactFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // mac length+1 invalid data
        $attributes = ['name' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ',
            'email' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVv@test.com',
            'message' => 'alOafAAlqpGKcekEcEYoMRqlxaQJcfTmcJdGqJwQYLUVDETbFYhNTGTEyydIBhLcTbMYJXlmqKUEPErQeBDbKwNfWvjERTGjAeprYiRVpmbOKlvHqzwplOYxsYCTYVGkZZItdbDTIcmGPyPRNjYoeoCpJqewJJkWiuTzObUcTbkyZAYuOyilwKJsAWvTUIWblIfIcpxygRfBjOLWBYMKKrvKRbmuvmfTosfQOVwmQaWTYLxrMktvaVvsGeoLzjgQ'];
        $request = new ContactFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid email
        $attributes = ['name' => 'abc',
            'email' => 'abcfhweiufh',
            'message' => 'required message'];
        $request = new ContactFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);
    }
}
