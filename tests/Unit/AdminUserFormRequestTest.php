<?php

namespace Tests\Unit;

use App\Http\Requests\AdminUserFormRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tests\BaseTestCase;

class AdminUserFormRequestTest extends BaseTestCase
{
    /**
     * Test authorisation function
     */
    public function testAdminUserFormRequestAuth()
    {
        $user = factory(User::class)->create(['user_role_id' => 1]);
        $this->actingAs($user);
        $request = new AdminUserFormRequest();
        $request->setContainer($this->app);
        $attributes = ['name' => 'abcde', 'email' => 'test@test.com',
            'user_role_id' => 1, 'password' => 'test', 'password_confirmation' => 'test'];
        $request->initialize([], $attributes);
        $this->app->instance('request', $request);
        $authorized = $request->authorize();
        $this->assertEquals(true, $authorized);
    }

    /**
     * Tests the validation rules() function for the AdminUserFormRequest is correct
     */
    public function testAdminUserFormRequestRules()
    {
        DB::table('user_roles')->insert([
            ['id' => 1, 'user_role_name' => 'generic'], //1
            ['id' => 2, 'user_role_name' => 'admin'], //2
        ]);
        DB::table('users')->insert([
            ['name' => 'Herbert', 'email' => 'herbert@test.com', 'user_role_id' => 1, 'password' => 'Test1234@']
        ]);

        // simple valid data
        $attributes = ['name' => 'abcde', 'email' => 'test@test.com',
            'user_role_id' => 1, 'password' => 'Test1234@', 'password_confirmation' => 'Test1234@'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(false, $fails);

        // invalid password bad length
        $attributes = ['name' => 'abcde', 'email' => 'test@test.com',
            'user_role_id' => 1, 'password' => 'test', 'password_confirmation' => 'test'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid password not diverse enough
        $attributes = ['name' => 'abcde', 'email' => 'test@test.com',
            'user_role_id' => 1, 'password' => 'testtest', 'password_confirmation' => 'testtest'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid password doesn't match
        $attributes = ['name' => 'abcde', 'email' => 'test@test.com',
            'user_role_id' => 1, 'password' => 'Test1234@', 'password_confirmation' => 'test'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);


        // invalid user role
        $attributes = ['name' => 'abcde', 'email' => 'test@test.com',
            'user_role_id' => 50, 'password' => 'Test1234@', 'password_confirmation' => 'Test1234@'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid name
        $attributes = ['name' => '45345', 'email' => 'test@test.com',
            'user_role_id' => 50, 'password' => 'Test1234@', 'password_confirmation' => 'Test1234@'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);

        // invalid email taken
        $attributes = ['name' => '45345', 'email' => 'herbert@test.com',
            'user_role_id' => 50, 'password' => 'Test1234@', 'password_confirmation' => 'Test1234@'];
        $request = new AdminUserFormRequest();
        $rules = $request->rules();
        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();
        $this->assertEquals(true, $fails);
    }
}
