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

        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'user_role_id' => UserRole::where('user_role_name', '=', 'Generic')->first()->value('id')
            ]);
        }

        \App\User::create(
            array(
                'name' => 'Amir Homayoon Ashrafzadeh',
                'email' => 'homy@admin.com',
                'password' => Hash::make('adminadmin'),
                'user_role_id' => UserRole::where('user_role_name', '=', 'Admin')->first()->id
            )
        );
    }
}
