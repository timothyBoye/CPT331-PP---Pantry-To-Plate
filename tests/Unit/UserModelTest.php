<?php

namespace Tests\Unit;
// http://blog.mauriziobonani.com/laravel-sql-memory-database-for-unit-tests/
use App\UserRole;
use Tests\BaseTestCase;
use App\User;

class UserModelTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        UserRole::create(
            array(
                'user_role_name' => 'Generic'
            )
        );
        UserRole::create(
            array(
                'user_role_name' => 'Admin'
            )
        );
        User::create(
            array(
                'name' => 'Abigail',
                'email' => 'test@email.com',
                'password' => 'x',
                'user_role_id' => 1
            )
        );
        User::create(
            array(
                'name' => 'John',
                'email' => 'test2@email.com',
                'password' => 'xyz',
                'user_role_id' => 2
            )
        );
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testUserInsertion()
    {
        $this->assertDatabaseHas('user_roles', [
            'id' => 1,
            'user_role_name' => 'Generic'
        ]);
        $this->assertDatabaseHas('user_roles', [
            'id' => 2,
            'user_role_name' => 'Admin'
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'Abigail',
            'email' => 'test@email.com',
            'password' => 'x',
            'user_role_id' => 1
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'email' => 'test2@email.com',
            'password' => 'xyz',
            'user_role_id' => 2
        ]);
    }

    public function testUserRoleRelationship()
    {
        $user = User::find(1);
        $this->assertTrue($user->role->user_role_name == 'Generic');
        $user = User::find(2);
        $this->assertTrue($user->role->user_role_name == 'Admin');
    }

    public function testUsersSavedRecipes()
    {
        // TODO
    }

}
