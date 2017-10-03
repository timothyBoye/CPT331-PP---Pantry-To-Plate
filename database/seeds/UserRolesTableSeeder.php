<?php

use Illuminate\Database\Seeder;
use App\UserRole;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        UserRole::create(array(
            'id' => 1, 'user_role_name' => 'Generic'
        ));

        UserRole::create(array(
           'id' => 2, 'user_role_name' => 'Admin'
        ));
    }
}
