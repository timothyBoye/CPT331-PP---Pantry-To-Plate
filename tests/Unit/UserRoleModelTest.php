<?php

namespace Tests\Unit;

use App\UserRole;
use Tests\BaseTestCase;
use App\User;

class UserRoleModelTest extends BaseTestCase
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
                'name' => 'Bob',
                'email' => 'test3@email.com',
                'password' => 'xyzde',
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
    }

    public function testUsersRelationship()
    {
        $userRole = UserRole::find(1);
        $this->assertTrue($userRole->users->count() == 2);
        $userRole = UserRole::find(2);
        $this->assertTrue($userRole->users->count() == 1);
    }
}
