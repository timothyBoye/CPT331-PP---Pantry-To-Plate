<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\UserRole;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(
            array(
                'name' => 'Amir Homayoon Ashrafzadeh',
                'email' => 'homy@admin.com',
                'password' => Hash::make('adminadmin'),
                'user_role_id' => UserRole::where('user_role_name', '=', 'Admin')->value('id')
            )
        );
        \App\User::create(
            array(
                'name' => 'Timothy Boye',
                'email' => 's3482043@student.rmit.edu.au',
                'password' => Hash::make('adminadmin'),
                'user_role_id' => UserRole::where('user_role_name', '=', 'Admin')->value('id')
            )
        );
    }
}
