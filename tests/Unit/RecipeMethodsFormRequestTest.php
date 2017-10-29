<?php

namespace Tests\Unit;

use App\Http\Requests\RecipeMethodsFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class RecipeMethodsFormRequestTest extends BaseTestCase
{

    /**
     * Test authorisation function
     */
    public function testRecipeMethodsFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new RecipeMethodsFormRequest();
        $request->setContainer($this->app);
        $attributes = ['method_descriptions.0' => 'abcde'];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }

    /**
     * Tests the validation rules() function for the RecipeMethodsFormRequest is correct
     */
    public function testRecipeMethodsFormRequestRules()
    {
        // simple valid data
        $attributes = ['method_descriptions.0' => 'abcde'];
        $request = new RecipeMethodsFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // multiple valid data inputs
        $attributes = ['method_descriptions.0' => 'abcde',
            'method_descriptions.1' => 'abcde',
            'method_descriptions.2' => 'abcde',
            'method_descriptions.3' => 'abcde'];
        $request = new RecipeMethodsFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);
    }
}
